<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

 
$start_date = get_post_meta( $post->ID, '_event_start_date', true);
$end_date = get_post_meta( $post->ID, '_event_end_date', true);
$duration = get_post_meta( $post->ID, '_event_duration', true);

$locations = get_the_terms( $post->ID, 'locations' );
$term_id = $locations[0]->term_id;
$location_name = $locations[0]->name;
$address = get_term_meta( $term_id, 'address', true );
$city = get_term_meta( $term_id, 'city', true );
$state = get_term_meta( $term_id, 'state', true );
$location_full = $location_name . ' ' . $address . ', ' . $city . ', ' . $state;
$location_full_map = str_replace( ' ', '%20', $location_full );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				tabula_rasa_tabularasa_posted_on();
				tabula_rasa_tabularasa_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="block">
		<div class="wrapper"></div>
	</div>
		
	<div class="entry-content">

	<?php tabula_rasa_tabularasa_post_thumbnail(); ?>

    <div class="details">
	<?php  
	if ( $start_date ) {
		 $dates = date( 'F d, Y', strtotime( $start_date ) );
	}
	if ( $end_date ) {
		$dates = $dates . ' to ' . date( 'F d, Y', strtotime( $end_date ) );
	}
	if ( $dates || $duration || $location_full ) { 
		echo '<h3>Event Details</h3>';
		echo '<ul>';
		if ( $dates ) {
			echo '<li><span>Date(s): </span>' . $dates . '</li>';
		}
		if ( $duration ) {
			echo '<li><span>Timeframe: </span>' . $duration . '</li>';
		}
		if ( $location_full ) {
			echo '<li><span>Location: </span>' . $location_full . '</li>';
		}
		echo '</ul>';
	}
	?>

	</div>
	
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tabula_rasa_tabularasa' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>

		<div class="location">
			<iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q='<?php echo $location_full_map; ?>'&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tabula_rasa_tabularasa' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php tabula_rasa_tabularasa_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->