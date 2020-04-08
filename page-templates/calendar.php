<?php
/**
 * Template Name: Calendar template
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

// Email from the admin section
$email = get_option( 'admin_email');

// Email chosen from the calendar template
$email2 = get_post_meta( $post->ID, 'email', true );
if ( $email2 ) { $email = $email2; }


$email = str_replace( '@', '%40', $email);

$code = get_post_meta( $post->ID, 'code', true );
if ( $code ) {
    $code_desktop = $code;
    $code_mobile = str_replace( 'embed?', 'embed?mode=AGENDA&amp;', $code );
}
?>

	<div id="primary" class="content-area full-width">
		<main id="main" class="site-main">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

            <!-- Start Mobile Version of Calendar -->
            <div class="responsive-iframe-container mobile-cal">
            <?php if ( $code ) {  echo $code_mobile; } else { ?>

            <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=<?php echo $email; ?>&amp;color=%23A32929&amp;ctz=America%2FPhoenix" style=" border-width:0 " width="600" height="600" frameborder="0" scrolling="no"></iframe>

            <?php } ?>
            </div>
            <!-- End Mobile Version of Calendar -->

            <!-- Start Desktop Version of Calendar -->
            <div class="responsive-iframe-container desktop-cal">
                
            <?php if ( $code ) {  echo $code_desktop; } else { ?>
                
            <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=<?php echo $email; ?>&amp;color=%23A32929&amp;ctz=America%2FPhoenix" style=" border-width:0 " width="1000" height="600" frameborder="0" scrolling="no"></iframe>

            <?php } ?>
            </div>
            <!-- End Desktop Version of Calendar -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
