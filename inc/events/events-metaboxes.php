<?php
function ba_register_event_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_event_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
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


	$cmb_demo->add_field( array(
		'name' => __( 'Event Start Date', 'cmb' ),
		'desc' => __( 'Enter Event Start Date', 'cmb' ),
		'id'   => $prefix . 'start_date',
		'type' => 'text_date',
	) );
	
	$cmb_demo->add_field( array(
		'name' => __( 'Event End Date', 'cmb' ),
		'desc' => __( 'Enter Event End Date', 'cmb' ),
		'id'   => $prefix . 'end_date',
		'type' => 'text_date',
		'date_format' => 'Y-m-d',
	) );

    $cmb_demo->add_field( array(
		'name' => __( 'Duration Description', 'cmb' ),
		'desc' => __( 'Enter Durration Description', 'cmb' ),
		'id'   => $prefix . 'duration',
		'type' => 'text',
    ) );
    
	$cmb_demo->add_field( array(
		'name' => __( 'Outro Text', 'cmb' ),
		'desc' => __( 'Enter Outro Text', 'cmb' ),
		'id'   => $prefix . 'outro_text',
		'type'     => 'taxonomy_select', // Or `taxonomy_select_hierarchical`
		'taxonomy' => 'locations', // Taxonomy Slug
	) );	

		

}
add_action( 'cmb2_admin_init', 'ba_register_event_metabox' );
?>