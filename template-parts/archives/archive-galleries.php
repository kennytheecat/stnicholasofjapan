<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive_entry_gallery' ); ?>>
	<header class="entry-header">
    <?php 
    echo '<div class="image">';
    echo '<a href="' . esc_url( get_permalink() ) . '">';
        the_post_thumbnail('archive');
    echo '</a>';
    echo '</div>';

        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		?>
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->