<?php
/**
 * Template Name: Media Archive
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

$args = array( 
    'status'            => 'publish',
    'post_type'         => array('post', 'sermons', 'events', 'galleries', 'documents', 'links' ),
);

$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$the_query = new WP_Query( $args ); 
?> 
 
	<div id="primary" class="content-area">
		<main id="main" class="site-main">



		<?php if ( $the_query->have_posts() ) : ?>

			<header class="page-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); 
				?>
			</header><!-- .page-header -->

			<?php
			wp_nav_menu( array( 
				'menu'     => 'Main Nav',
				'sub_menu' => true,
				'container_class' => 'submenu'
				) );
			?>

			<div class="block">
				<div class="wrapper"></div>
			</div>

			<div class="entry-content">

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
        // Reset postdata
        wp_reset_postdata();
        
		// Custom query loop pagination
?>
		<div class="paging-navigation">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $the_query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'list',
            'end_size'     => 3,
            'mid_size'     => 2,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
            'add_args'     => false,
			'add_fragment' => '',
        ) );
    ?>
</div>

		
			</div> <!-- .entry-content --> 
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
