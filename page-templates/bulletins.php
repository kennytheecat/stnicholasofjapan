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
/*
global $wpdb;
$results = $wpdb->get_results( "SELECT * FROM bulletins ORDER BY date DESC", ARRAY_A );

foreach ($results as $result ) {
    $dates = explode( '-', $result['date']);
    $list[$dates[0]][$dates[1]][] = $result;
}
*/
/*
$terms = get_terms( array(
    'hide_empty' => 0,
    'taxonomy' => 'bulletin_types',
) );
foreach ( $terms as $term ) {
    
    $args = array( 
        'posts_per_page'    => -1, 
        'post_status'       => array( 'publish', 'future' ),
        'post_type'         => 'bulletins',
        'tax_query' => array(
            array(
                'taxonomy' => 'bulletin_types',
                'field' => 'id',
                'terms' => $term->term_id,
            ),
        ), 
        'orderby'       => 'date',
        'order'         => 'DESC',
    );
    $bulletins = get_posts( $args );

    if ( $bulletins ) {

        foreach ( $bulletins as $bulletin ) {
            $dates = explode( ' ', $bulletin->post_date ); 
            $dates = explode( '-', $dates[0] );
            $list[$dates[0]][$dates[1]][] = $bulletin;
        }
    }
}
*/
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        
		<?php
    $terms = get_terms( array(
        'hide_empty' => 0,
        'taxonomy' => 'bulletin_types',
    ) );
    foreach ( $terms as $term ) {
        
        $args = array( 
            'posts_per_page'    => -1, 
            'post_status'       => array( 'publish', 'future' ),
            'post_type'         => 'bulletins',
            'tax_query' => array(
                array(
                    'taxonomy' => 'bulletin_types',
                    'field' => 'id',
                    'terms' => $term->term_id,
                ),
            ), 
            'orderby'       => 'date',
            'order'         => 'ASC',
        );
        $bulletins = get_posts( $args );
        $list = array();
        if ( $bulletins ) {

            foreach ( $bulletins as $bulletin ) {
                $dates = explode( ' ', $bulletin->post_date ); 
                $dates = explode( '-', $dates[0] );
                $list[$dates[0]][$dates[1]][] = $bulletin;
            }
        }
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
                    if ( $entry->post_name ) {
                        $name = $entry->post_title;
                    } else {
                        $bulletin_naming = get_option( 'bulletin_naming');
                        $name = date( $bulletin_naming, strtotime( $entry->post_date ) );
                    }
                    $link = get_post_meta( $entry->ID, '_bulletin_file', true );
                    echo '<li class="entry"><a href="' . $link . '">' . $name . '</a></li>';
                }
                echo '</ul>';
            }
            echo '</div> <!-- end .calendar-year -->';
            echo '</section>';            
        }

    }        
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
