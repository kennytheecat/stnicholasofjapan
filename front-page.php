<?php
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
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <?php
            get_template_part('template-parts/frontpage/hero'); 
            get_template_part('template-parts/frontpage/services'); 
            get_template_part('template-parts/frontpage/welcome'); 
            get_template_part('template-parts/frontpage/videos'); 
            get_template_part('template-parts/frontpage/engage'); 
            get_template_part('template-parts/frontpage/latest'); 
            get_template_part('template-parts/frontpage/events'); 
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
