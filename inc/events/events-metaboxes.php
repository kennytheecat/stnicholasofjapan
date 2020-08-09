<?php
function ba_register_event_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_event_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Event Info', 'cmb2' ),
		'object_types'  => array( 'events' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );


	$cmb->add_field( array(
		'name' => __( 'Event Start Date', 'cmb' ),
		'desc' => __( 'Enter Event Start Date', 'cmb' ),
		'id'   => $prefix . 'start_date',
		'type' => 'text_date',
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Event End Date', 'cmb' ),
		'desc' => __( 'Enter Event End Date', 'cmb' ),
		'id'   => $prefix . 'end_date',
		'type' => 'text_date',
	) );

    $cmb->add_field( array(
		'name' => __( 'Duration Description', 'cmb' ),
		'desc' => __( 'Enter Duration Description', 'cmb' ),
		'id'   => $prefix . 'duration',
		'type' => 'text',
    ) );
    
	$cmb->add_field( array(
		'name' => __( 'Location', 'cmb' ),
		'desc' => __( 'Enter Location', 'cmb' ),
		'id'   => $prefix . 'location',
		'show_option_none' => true,
		'type'     => 'taxonomy_select', // Or `taxonomy_select_hierarchical`
		'taxonomy' => 'locations', // Taxonomy Slug
	) );	

	$cmb->add_field( array(
		'name'         => esc_html__( 'Documents', 'cmb2' ),
		'desc'         => esc_html__( 'Upload or add multiple documents.', 'cmb2' ),
		'id'           => $prefix . 'docs',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

		

}
add_action( 'cmb2_admin_init', 'ba_register_event_metabox' );
?>