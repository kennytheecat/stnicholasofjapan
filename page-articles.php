<?php
/* Template Name: Articles */ 
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

get_header();
?> 
 
 <?php 
 $args = array(
     'post_type' => 'post',
     'post_status' => 'publish',
     'posts_per_page' => -1,  
 );
// the query
$the_query = new WP_Query( $args ); 
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
		<?php
		wp_nav_menu( array(
			'menu'     => 'Main Nav',
			'sub_menu' => true,
			'container_class' => 'submenu'
			) );
		?>

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( $the_query->have_posts() ) : ?>

			<header class="page-header">
				<?php
				post_type_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<div class="block">
				<div class="wrapper"></div>
			</div>

			<div class="entry-content archive">

<?php
			/* Start the Loop */
			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/archives/archive', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
			</div> <!-- .entry-content --> 
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
