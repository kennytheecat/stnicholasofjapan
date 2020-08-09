<?php
function ba_register_link_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_link_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Link Info', 'cmb2' ),
		'object_types'  => array( 'links' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );	

	
    $cmb_demo->add_field( array(
		'name' => __( 'Link', 'cmb' ),
		'desc' => __( '', 'cmb' ),
		'id'   => $prefix . 'file',
		'type' => 'file',
	) );
	
	$cmb_demo->add_field( array(
		'name' => __( 'Description(Optional)', 'cmb' ),
		'desc' => __( 'Leave blank unless you want to provode a short description about the link', 'cmb' ),
		'id'   => $prefix . 'desc',
		'type' => 'textarea',
    ) );

}
add_action( 'cmb2_admin_init', 'ba_register_link_metabox' );
?>