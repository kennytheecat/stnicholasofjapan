<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function register_calendar_metabox() {
	/**
	 * Registers main options page menu item and form.
	 */
	$args = array(
		'id'           => 'calendarbox',
        'title'        => 'Override Calendar Settings',       
        'object_types' => array( 'page' ),
        'show_on'      => array( 'key' => 'page-template', 'value' => 'page-templates/calendar.php' ),
		'option_key'   => 'visit',
	);
    $cmb = new_cmb2_box( $args );


    $cmb->add_field( array(
        'name' => esc_html__( 'Instructions:', 'cmb2' ),
        'desc' => 'The calendar displayed is based on the admin email provided. If you want to change the calender to be displayed on a differnet email, enter it the email field. <br /> If you need to display a specific view of the calendar, <a href="https://support.google.com/calendar/answer/41207" target="_blank">follow these instructions</a>, and enter it in the code section below.',
        'id'   => '_intro',
        'type' => 'title',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Email', 'cmb2' ),
        'id'         => 'email',
        'type'       => 'text_email',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Code', 'cmb2' ),
        'id'         => 'code',
        'type'       => 'textarea',
    ) );			
	
}
add_action( 'cmb2_admin_init', 'register_calendar_metabox' );

function cmb2_sanitize_textarea_callback( $override_value, $value, $object_id, $field_args ) {

    if ( $field_args['id'] == 'code' ) {
        return htmlspecialchars_decode( stripslashes( $value ) );
    }
}
add_filter( 'cmb2_sanitize_textarea', 'cmb2_sanitize_textarea_callback', 10, 4 );
?>