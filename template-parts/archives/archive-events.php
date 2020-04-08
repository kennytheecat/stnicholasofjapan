<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

$start_date = get_post_meta( $post->ID, '_event_start_date', true);
$end_date = get_post_meta( $post->ID, '_event_end_date', true);
$duration = get_post_meta( $post->ID, '_event_link', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive_entry_event'); ?>>
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