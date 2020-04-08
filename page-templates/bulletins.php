<?php
/**
 * Template Name: Bulletins template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

get_header();

global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM bulletins ORDER BY date DESC", ARRAY_A );

foreach ($results as $result ) {
    $dates = explode( '-', $result['date']);
    $list[$dates[0]][$dates[1]][] = $result;
}

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        
		<?php
        foreach ( $list as $year => $item ) {
            echo '<section class="year">';
            echo '<h2>';
            echo $year;
            echo '</h2>';
            echo '<div  class="calendar-year">'; 

            arsort($item);

            foreach ( $item as $month => $item ) {
                echo '<ul class="month">';
                echo '<span>';
                echo date("F", mktime(0, 0, 0, $month, 10));
                echo '</span>';

                krsort($item);
                foreach ( $item as $entry ) {
                    if ( $entry['name'] ) {
                        $name = $entry['name'];
                    } else {
                        $bulletin_naming = get_option( 'bulletin_naming');
                        $name = date( $bulletin_naming, strtotime($entry['date'] ) );
                    }
                    echo '<li class="entry"><a href="' . home_url() . '' . $entry['file'] . '">' . $name. '</a></li>';
                }
                echo '</ul>';
            }
            echo '</div> <!-- end .calendar-year -->';
            echo '</section>';            
        }

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
