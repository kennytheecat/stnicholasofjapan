<?php
function ba_register_gallery_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_gallery_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Gallery Info', 'cmb2' ),
		'object_types'  => array( 'galleries' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );


	$cmb_demo->add_field( array(
		'name' => __( 'Intro Text', 'cmb' ),
		'desc' => __( 'Enter Intro Text', 'cmb' ),
		'id'   => $prefix . 'intro_text',
		'type' => 'wysiwyg',
	) );		

    $cmb_demo->add_field( array(
		'name' => __( 'Gallery Link', 'cmb' ),
		'desc' => __( 'Enter Gallery Link', 'cmb' ),
		'id'   => $prefix . 'link',
		'type' => 'text_url',
    ) );
    
	$cmb_demo->add_field( array(
		'name' => __( 'Outro Text', 'cmb' ),
		'desc' => __( 'Enter Outro Text', 'cmb' ),
		'id'   => $prefix . 'outro_text',
		'type' => 'wysiwyg',
	) );	

		

}
add_action( 'cmb2_admin_init', 'ba_register_gallery_metabox' );
?>