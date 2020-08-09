<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tabula_Rasa
 */

$settings = get_option( 'settings', true);
$name = $settings['basic_info_name'];
$street = $settings['basic_info_address_street'];
$city = $settings['basic_info_address_city'];
$state = $settings['basic_info_address_state'];
$zip = $settings['basic_info_address_zip'];

if ( $name || $street ) { 
$location_full = $name . ' ' . $street . ', ' . $city . ', ' . $state . '  ' . $zip;
$location_google = 'http://maps.google.com/?q=' . str_replace( array( ', ', '  ', ' '), '+', $location_full);
} else {
	$location_full = '';
	$location_google = '';
}

$phone = $settings['basic_info_phone'];

$sm_array = get_sm_array();

$contact_title = isset($settings['basic_info_contact_title']) ? $settings['basic_info_contact_title'] : '';
$contact_url = isset($settings['basic_info_contact_url']) ? $settings['basic_info_contact_url'] : '';

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="wrapper">

		<div class="line">
			<div class="wrapper"></div>
		</div>
		
			<div class="footer-top">
				<div class="wrapper">

					<div class="social-media">
						<ul>
						<?php
						
						foreach ( $sm_array as $value ) {

							if ( isset($settings['basic_info_' . $value] ) ) {
								echo '<li><a href="' . $settings['basic_info_' . $value] . '"></a></li>';
							}		
						}		
													
						?>			
						</ul>
					</div>				

					<div class="site-info">
						<ul>
							<li class="address"><a href="<?php echo $location_google; ?>"><?php echo $location_full; ?></a></li>
							<li class="phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></li>
							<li class="email"><a href="<?php echo $contact_url; ?>"><?php echo $contact_title; ?></a></li>
						</ul>
					</div><!-- .site-info -->

				</div><!-- end .wrapper -->
			</div><!-- end .footer-top -->

			<div class="footer-bottom">
				<div class="wrapper">

					<div class="footer-services">
						<?php 
						$count = 0;
						for( $i = 1; $i <= 4; $i++ ) {
							if ( isset( $settings['footer_line_' . $i] )) {
							${'line' . $i} = $settings['footer_line_' . $i];
							if ( ${'line' . $i} ) { $count = $i; }			
							}
						}
						
						echo '<ul>';
						for( $i = 1; $i <= $count; $i++ ) { 
							echo '<li>' . ${'line' . $i} . '</li>';	

							if ( $i != $count ) {
								echo '<span class="sep"> | </span>';	
							}
											
						}
						echo '</ul>';
						?>
					</div>

					<div class="both-and">
						<p>Site design by <a href="www.bothanddesign.com">BOTH/AND</a></p>
					</div>
				</div><!-- end .wrapper -->
			</div><!-- end .footer-bottom -->
			
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
