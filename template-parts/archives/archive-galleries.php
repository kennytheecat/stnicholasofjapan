<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

$gallery_link = get_post_meta( $post->ID, '_gallery_link', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('archive_entry', 'archive_entry_gallery' )) ; ?>>
	<header class="entry-header">
    <?php 
    echo '<div class="image">';
    echo '<a href="' . esc_url( $gallery_link ) . '">';
        the_post_thumbnail('archive');
    echo '</a>';
    echo '</div>';

        the_title( '<h2 class="entry-title"><a href="' . esc_url( $gallery_link ) . '">', '</a></h2>' );
		?>
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->