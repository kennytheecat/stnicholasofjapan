<?php
/* Template Name: Info Hub */ 
/**
 * The template for displaying all pages
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

$meta = get_post_meta( $post->ID, 'info', true);
?>

	<div id="primary" class="content-area full-width">
		<main id="main" class="site-main">

        <header class="page-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); 
				?>
			</header><!-- .page-header -->

        <!-- <section class="spotlights">
            <div class="spotlights-wrapper">  -->
                <?php
                			wp_nav_menu( array( 
                                'theme_location' => 'infohub', 
                                'menu_class' => 'info-menu', 
                                'depth' => 1, 
                                'before' => '<div class="button"><p>', 
                                'after' => '</p></div>' 
                                ) 
                            ) ; 
               /*
                foreach ( $meta as $item ) {
                    $new_url = get_the_permalink($item['url'] );
                    echo '<div class="button"><h4><a href="' . $new_url. '">' . $item['title'] . '</a></h4></div>';
                }
                */
                ?>
            <!--
                </div>
        </section>
            -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
