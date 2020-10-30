<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('archive_entry', 'archive_entry_article' )); ?>>
	<header class="entry-header">
    <?php 
    echo '<div class="image">';
    echo '<a href="' . esc_url( get_permalink() ) . '">';

    if  ( has_post_thumbnail() ) {
        the_post_thumbnail('thumbnail');
    } else {
        $image_id = get_image_id('Article Default Image');
        echo wp_get_attachment_image($image_id, 'thumbnail', false );
    }
    
    echo '</a>';
    echo '</div>';

        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		?>
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->