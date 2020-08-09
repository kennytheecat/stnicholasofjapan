<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */
$date = get_post_meta( $post->ID, '_podox_sermon_date', true);
if ( $date ) {
    $month = date("M", strtotime($date));
    $day = date("d", strtotime($date));
    $year = date("Y", strtotime($date));
}
$location = get_the_terms( $post->ID, 'services' );
$location = $location[0]->name;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('archive_entry', 'archive_entry_sermon' ) ); ?>>
	<header class="entry-header">
        <div class="date-wrapper">
            <div class="date">
            <?php if ( $date ) { ?>
                <p class="month"><?php echo $month; ?></p>
                <p class="day"><?php echo $day; ?></p>
                <p class="year"><?php echo $year; ?></p>
            <?php } ?>
            </div>
        </div>
		<?php 
        the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' );
        echo '<ul>';

        echo '<li>';
		

		if ( $location ) {
			echo '<span class="location">' . $location . '</span>';
        }
        
        echo '</li>';
        


        echo '</ul>';
		?>
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
