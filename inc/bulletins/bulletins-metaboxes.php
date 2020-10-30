<?php
function ba_register_bulletin_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'bulletin_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Bulletin Info', 'cmb2' ),
		'object_types'  => array( 'bulletins' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );	

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Date', 'cmb2' ),
		'desc' => esc_html__( '', 'cmb2' ),
		'id'   => $prefix . 'date',
		'type' => 'text_date',
		'date_format' => 'Y-m-d',
	) );
	
    $cmb_demo->add_field( array(
		'name' => __( 'Bulletin', 'cmb' ),
		'desc' => __( '', 'cmb' ),
		'id'   => $prefix . 'file',
		'type' => 'file',
    ) );

}
add_action( 'cmb2_admin_init', 'ba_register_bulletin_metabox' );
?>