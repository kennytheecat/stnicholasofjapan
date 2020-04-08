<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function register_settings_metabox() {
	/**
	 * Registers main options page menu item and form.
	 */
	$args = array(
		'id'           => 'settings',
		'title'        => 'Settings',
		'object_types' => array( 'options-page' ),
		'option_key'   => 'settings',
	);
	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		//$args['display_cb'] = 'cop_options_display_with_tabs';
    }
    $cmb = new_cmb2_box( $args );

    $cmb->add_field( array(
        'name' => __( 'Basic Info Section', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info',
        'type' => 'title',
    ) );     

    $cmb->add_field( array(
        'name' => __( 'Church Name', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_name',
        'type' => 'text',
    ) );     

    $cmb->add_field( array(
        'name' => __( 'Church Street Address', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_adress_street',
        'type' => 'text',
    ) );  
    
    $cmb->add_field( array(
        'name' => __( 'Church City', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_adress_city',
        'type' => 'text',
    ) );      
    
    $cmb->add_field( array(
        'name' => __( 'Church State', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_adress_state',
        'type' => 'text',
    ) );  

    $cmb->add_field( array(
        'name' => __( 'Church Zip Code', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_adress_zip',
        'type' => 'text',
    ) ); 

    $cmb->add_field( array(
        'name' => __( 'Phone', 'bothand' ),
        'desc' => __( '999-999-9999', 'bothand' ),
        'id'   => 'basic_info_phone',
        'type' => 'text',
    ) );     

    $cmb->add_field( array(
        'name' => __( 'Email', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_email',
        'type' => 'text_email',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Facebook Page', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_facebook',
        'type' => 'text_url',
    ) );    

    
    $cmb->add_field( array(
        'name' => __( 'Instagram', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_instagram',
        'type' => 'text_url',
    ) );  

    
    $cmb->add_field( array(
        'name' => __( 'Youtube', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_youtube',
        'type' => 'text_url',
    ) );  

    
    $cmb->add_field( array(
        'name' => esc_html__( 'Default Images Section', 'cmb2' ),
        'desc' => esc_html__( 'Every post type has a default image in case a featured image is not uploaded', 'cmb2' ),
        'id'   => 'default_images_section',
        'type' => 'title',        
    ) );
    
    $default = array(
        'Article' => 'articles',
        'Bulletin' => 'bulletins',
        'Gallery' => 'gallerys',
        'Event' => 'events',
        'Sermon' => 'sermons',
    );

    foreach ( $default as $key => $value ) {

        $cmb->add_field( array(
            'name' => __( $key . ' Default Image', 'bothand' ),
            'desc' => __( '', 'bothand' ),
            'id'   => 'default_image_' . $value,
            'type' => 'file',
            // Optional:
            'options' => array(
              'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
              'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
            ),
            // query_args are passed to wp.media's library query.
            'query_args' => array(
              //'type' => 'application/pdf', // Make library only display PDFs.
              // Or only allow gif, jpg, or png images
               'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
               ),
            ),
            'preview_size' => 'medium', // Image size to use when previewing in the admin.
        ) ); 

    }


    $cmb->add_field( array(
        'name' => __( 'Video #1 for 404 pages', 'bothand' ),
        'desc' => __( 'Upload video link', 'bothand' ),
        'id'   => 'video-404-1',
        'type' => 'oembed',
    ) );    
    
    $cmb->add_field( array(
        'name' => __( 'Video #2 for 404 pages', 'bothand' ),
        'desc' => __( 'Upload video link', 'bothand' ),
        'id'   => 'video-404-2',
        'type' => 'oembed',
    ) );    
	
}
add_action( 'cmb2_admin_init', 'register_settings_metabox' );
?>