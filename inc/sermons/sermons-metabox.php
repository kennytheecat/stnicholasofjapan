<?php
function podox_register_sermon_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_podox_sermon_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Sermon Info', 'cmb2' ),
		'object_types'  => array( 'sermons' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Sermon Date', 'cmb' ),
		'desc' => __( '', 'cmb' ),
		'id'   => $prefix . 'date',
		'type' => 'text_date',
	) );	

	$cmb_demo->add_field( array(
		'name' => __( 'Intro Text', 'cmb' ),
		'desc' => __( 'Enter Intro Text', 'cmb' ),
		'id'   => $prefix . 'intro_text',
		'type' => 'wysiwyg',
	) );		

	$cmb_demo->add_field( array(
		'name' => __( 'Audio', 'cmb' ),
		'desc' => __( 'Upload audio link', 'cmb' ),
		'id'   => $prefix . 'audio',
		'type' => 'oembed',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Video', 'cmb' ),
		'desc' => __( 'Upload video link', 'cmb' ),
		'id'   => $prefix . 'video',
		'type' => 'oembed',
	) );	

	$cmb_demo->add_field( array(
		'name' => __( 'Transcript', 'cmb' ),
		'desc' => __( 'Enter Transcript', 'cmb' ),
		'id'   => $prefix . 'transcript',
		'type' => 'wysiwyg',
	) );	

	$cmb_demo->add_field( array(
		'name' => __( 'Epistle Verse', 'cmb' ),
		'desc' => __( 'Enter Epistle Verse', 'cmb' ),
		'id'   => $prefix . 'epistle_verse',
		'type' => 'text',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Epistle Text', 'cmb' ),
		'desc' => __( 'Enter Epistle Text', 'cmb' ),
		'id'   => $prefix . 'epistle_text',
		'type' => 'wysiwyg',
	) );	

	$cmb_demo->add_field( array(
		'name' => __( 'Gospel Verse', 'cmb' ),
		'desc' => __( 'Enter Gospel Verse', 'cmb' ),
		'id'   => $prefix . 'gospel_verse',
		'type' => 'text',
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Gospel Text', 'cmb' ),
		'desc' => __( 'Enter Gospel Text', 'cmb' ),
		'id'   => $prefix . 'gospel_text',
		'type' => 'wysiwyg',
	) );		

}
add_action( 'cmb2_admin_init', 'podox_register_sermon_metabox' );
?>