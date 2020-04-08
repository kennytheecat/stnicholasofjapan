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

        <section class="spotlights">
            <div class="spotlights-wrapper"> 
                <?php
                foreach ( $meta as $item ) {
                    $new_url = get_the_permalink($item['url'] );
                    echo '<div class="button"><h4><a href="' . $new_url. '">' . $item['title'] . '</a></h4></div>';
                }
                ?>
            </div>
        </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
