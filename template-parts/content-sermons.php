<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */
$intro_text = apply_filters('the_content', get_post_meta( $post->ID, '_podox_sermon_intro_text', true) );

$video = get_post_meta( $post->ID, '_podox_sermon_video', true);
$audio = get_post_meta( $post->ID, '_podox_sermon_audio', true);
$transcript = apply_filters('the_content', get_post_meta( $post->ID, '_podox_sermon_transcript', true) );
$date = get_post_meta( $post->ID, '_podox_sermon_date', true);
if ( $date ) {
	$date = date("F, d Y", strtotime($date));
}
$location = get_the_terms( $post->ID, 'services' );
$location = $location[0]->name;

$epistle_verse = get_post_meta( $post->ID, '_podox_sermon_epistle_verse', true);
$epistle_text = apply_filters('the_content', get_post_meta( $post->ID, '_podox_sermon_epistle_text', true) );
$gospel_verse = get_post_meta( $post->ID, '_podox_sermon_gospel_verse', true);
$gospel_text = apply_filters('the_content', get_post_meta( $post->ID, '_podox_sermon_gospel_text', true) );
$readings = array( $epistle_verse, $epistle_text, $gospel_verse, $gospel_text);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		the_title( '<h1 class="entry-title">', '</h1>' ); 
		
		if ( $date && !$location ) {
			echo '<p class="postmeta"><span class="date">' .  $date . '</span></p>';
		}
		if ( $date && $location ) {
			echo '<p class="postmeta"><span class="date">' .  $date . '</span> during <span class="location">' . $location . '</span></p>';
		}
		?>
	</header><!-- .entry-header -->

	<div class="block">
		<div class="wrapper"></div>
	</div>

	<div class="entry-content">

	<?php tabula_rasa_tabularasa_post_thumbnail(); ?>
	
	<?php
		if ( $intro_text ) {
			echo '<div class="intro_text">';
			echo $intro_text;
			echo '</div>';
		}
	?>

		<div class="media-section">
			<?php 
			if ( $audio ) {
				echo '<div class="audio">';
				echo wp_oembed_get( $audio );
				echo '</div>';
			}

			if ( $video ) {
				echo '<div class="video">';
				echo wp_oembed_get( $video );
				echo '</div>';
			}

			?>
		</div>

		<?php if ( array_filter($readings) ) { ?>

			<div class="reading-of-the-day accordion">

				<?php if ( $readings[0] && $readings[1] ) { ?>
				<div class="epistle">
					<input type="checkbox" name="panel" id="panel-1">
					<label for="panel-1">Epistle Reading</label>
					<div class="accordion__content">
					<p class="accordion__body">
						<?php echo $epistle_verse; ?>
						<?php echo $epistle_text; ?>
					</p>
					</div>
				</div>
				<?php } ?>

				<?php if ( $readings[2] && $readings[3] ) { ?>
				<div class="gospel"> 
					<input type="checkbox" name="panel" id="panel-2">
					<label for="panel-2">Gospel Reading</label>
					<div class="accordion__content">
					<p class="accordion__body">
						<?php echo $gospel_verse; ?>
						<?php echo $gospel_text; ?>
					</p>
					</div>
					</div>
				<?php } ?>

				<?php if ( $transcript ) {?>
				<div class="transcript"> 
					<input type="checkbox" name="panel" id="panel-3">
					<label for="panel-3">Transcript</label>
					<div class="accordion__content">
					<p class="accordion__body"><?php echo $transcript; ?></p>
					</div>
					</div>
				<?php } ?>				

			</div>

		<?php } ?>		

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tabula_rasa_tabularasa' ),
			'after'  => '</div>',
		) );
		?>
		
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'tabula_rasa_tabularasa' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
