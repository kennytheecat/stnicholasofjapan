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

                <?php
                			wp_nav_menu( array( 
                                'theme_location' => 'infohub', 
                                'menu_class' => 'info-menu', 
                                'depth' => 1, 
                                'before' => '<div class="button"><p>', 
                                'after' => '</p></div>' 
                                ) 
                            ) ; 

                ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
