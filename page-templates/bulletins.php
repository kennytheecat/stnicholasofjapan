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
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        <?php
			wp_nav_menu( array(
				'menu'     => 'Main Nav',
				'sub_menu' => true,
				'container_class' => 'submenu',
				'menu_section'		=>	'media'
				) );


        $terms = get_terms( array(
            'hide_empty' => 0,
            'taxonomy' => 'bulletin_types',
        ) );
    
        
        $args = array( 
            'posts_per_page'    => -1, 
            'post_status'       => array( 'publish', 'future' ),
            'post_type'         => 'bulletins',
            'tax_query' => array(
               /* array(
                    'taxonomy' => 'bulletin_types',
                    'field' => 'id',
                    'terms' => $term->term_id,
                ),*/
            ), 
            'orderby'       => 'date',
            'order'         => 'ASC',
        );
        $bulletins = get_posts( $args );
        $list = array();
        if ( $bulletins ) {
            foreach ( $bulletins as $bulletin ) {
                $terms = get_the_terms( $bulletin->ID, 'bulletin_types' );
                $slug = $terms[0]->name;
                // get bulletin type - add to $list - remove term for each - make so term type is listed
                //$dates = explode( ' ', $bulletin->post_date ); 
                $dates = get_post_meta( $bulletin->ID, '_bulletin_date', true);
                $dates = explode( '-', $dates );
                $list[$dates[0]][$dates[1]][$slug][] = $bulletin;
            }
        }
        
        foreach ( $list as $year => $item ) {
            echo '<section class="year">';
            echo '<h2>';
            echo $year;
            echo '</h2>';
            echo '<div  class="calendar-year">'; 

            krsort($item);

            foreach ( $item as $month => $type ) {
                echo '<ul class="month">';
                echo '<span class="title">';
                echo date("F", mktime(0, 0, 0, $month, 10));
                echo '</span>';

                krsort($type);


                foreach ( $type as $key => $item ) {
                    if ( $item[0] ) {
                        echo '<span class="type">' . $key . '</span>';
                        echo '<hr />';
                    }
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
