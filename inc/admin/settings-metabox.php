<?php
function create_settings_access_cap() {

    $roles = array( 'editor','administrator' );

    foreach( $roles as $the_role ) {      
        
        $role = get_role($the_role);
        $role->add_cap( 'settings_access' );		
    }
}
add_action('after_switch_theme', 'create_settings_access_cap');
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
        'capability' => 'settings_access',
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
        'id'   => 'basic_info_address_street',
        'type' => 'text',
    ) );  
    
    $cmb->add_field( array(
        'name' => __( 'Church City', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_address_city',
        'type' => 'text',
    ) );      
    
    $cmb->add_field( array(
        'name' => __( 'Church State', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_address_state',
        'type' => 'text',
    ) );  

    $cmb->add_field( array(
        'name' => __( 'Church Zip Code', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_address_zip',
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
        'name' => __( 'Default Contact Title', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_contact_title',
        'type'       => 'text',   
    ) );

    $cmb->add_field( array(
        'name' => __( 'Default Contact Page', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'basic_info_contact_url',
        'type'       => 'select',
		'show_option_none' => true,
        'options_cb' => 'cmb2_get_post_options',      
    ) );

    $cmb->add_field( array(
        'name' => __( 'Generate Map', 'bothand' ),
        'desc' => __( 'Before "Generating Map Image", save the page after inserting location details. Then Click "Generate Map Image". Save and Upload the image.', 'bothand' ),
        'id'   => 'map_image',
        'type' => 'title',
    ) );   

    $settings = get_option( 'settings', true);
    $name = $settings['basic_info_name'];
    $street = $settings['basic_info_address_street'];
    $city = $settings['basic_info_address_city'];
    $state = $settings['basic_info_address_state'];
    $zip = $settings['basic_info_address_zip'];
    $location_full = $name . ' ' . $street . ', ' . $city . ', ' . $state . '  ' . $zip;
    $location_full_map = str_replace( ' ', '%20', $location_full );

    $cmb->add_field( array(
        'name' => __( 'Upload Map Image', 'bothand' ),
        'desc' => __( '<a href="https://maps.googleapis.com/maps/api/staticmap?center=' . $location_full_map . '&zoom=17&scale=1&size=500x300&maptype=roadmap&key=AIzaSyBDk7Q9l3Czfcz7Tz7cBI4F2qqozEWDEug&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:%7C' . $location_full_map . '" target="_blank">Generate Map Image</a>', 'bothand' ),
        'id'   => 'basic_info_map_image',
        'type'       => 'file',   
    ) );

    $cmb->add_field( array(
        'name' => __( 'Sidebar Section', 'bothand' ),
        'desc' => __( 'Buttons', 'bothand' ),
        'id'   => 'sidebar',
        'type' => 'title',
    ) );   

    $group_field_id = $cmb->add_field( array(
		'id'          => 'sidebar_buttons',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add Another Entry', 'cmb2' ),
			'remove_button'  => esc_html__( 'Remove Entry', 'cmb2' ),
			'sortable'       => true,
			// 'closed'      => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );  


    $cmb->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Entry Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text'
    ) );    
    
    $cmb->add_group_field( $group_field_id, array(
        'name' => __( 'Button #1 Link ', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'url',
        'type'       => 'select',
		'show_option_none' => true,
        'options_cb' => 'cmb2_get_post_options',      
    ) );

    $cmb->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button #1 Link(Custom URL)', 'cmb2' ),
		'desc' => esc_html__( 'If filled in, will override the above link', 'cmb2' ),
		'id'   => 'url_override',
		'type' => 'text_url',   
    ) );
    
    $cmb->add_field( array(
        'name' => __( 'Sidebar Image', 'bothand' ),
        'desc' => __( 'Long vertical images work best', 'bothand' ),
        'id'   => 'sidebar_image',
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

    $cmb->add_field( array(
        'name' => __( 'Footer Section', 'bothand' ),
        'desc' => __( 'Service Times', 'bothand' ),
        'id'   => 'footer',
        'type' => 'title',
    ) );   

    for ( $i=1; $i <= 4; $i++ ) {

        $cmb->add_field( array(
            'name' => __( 'Line #' . $i, 'bothand' ),
            'desc' => __( '', 'bothand' ),
            'id'   => 'footer_line_' . $i,
            'type' => 'text',
        ) );    

    }

    $sm_array = $sm_array = get_sm_array();

    foreach ( $sm_array as $key => $value ) {

        $cmb->add_field( array(
            'name' => __( $key . ' Page', 'bothand' ),
            'desc' => __( '', 'bothand' ),
            'id'   => 'basic_info_' . $value,
            'type' => 'text_url',
        ) );    
    
    } 

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
        'name' => __( 'Conact Page Buttons', 'bothand' ),
        'desc' => __( 'Buttons', 'bothand' ),
        'id'   => 'contact',
        'type' => 'title',
    ) );   

    $group_field_id = $cmb->add_field( array(
		'id'          => 'contact_buttons',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add Another Entry', 'cmb2' ),
			'remove_button'  => esc_html__( 'Remove Entry', 'cmb2' ),
			'sortable'       => true,
			// 'closed'      => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );  

    $cmb->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Button Description', 'cmb2' ),
		'id'         => 'desc',
		'type'       => 'text'
    ) );   

    $cmb->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Button Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text'
    ) );    
    
    $cmb->add_group_field( $group_field_id, array(
        'name' => __( 'Button #1 Link ', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'url',
        'type'       => 'select',
		'show_option_none' => true,
        'options_cb' => 'cmb2_get_post_options',      
    ) );

    $cmb->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button #1 Link(Custom URL)', 'cmb2' ),
		'desc' => esc_html__( 'If filled in, will override the above link', 'cmb2' ),
		'id'   => 'url_override',
		'type' => 'text_url',   
    ) );    

    $cmb->add_field( array(
        'name' => __( '404 Page Videos', 'bothand' ),
        'desc' => __( 'The 404 page dynaimcally pulls form the fist two videos on the home page. If you would like to override those videos, fill out the section below.', 'bothand' ),
        'id'   => '404-videos',
        'type' => 'title',
    ) );

    for ( $i=1; $i <= 2; $i++ ) {

        $cmb->add_field( array(
            'name' => __( 'Video #' . $i . ' Title for 404 pages', 'bothand' ),
            'desc' => __( 'Video Title', 'bothand' ),
            'id'   => 'video-404-' . $i . '-override-title',
            'type' => 'text',
        ) );           

        $cmb->add_field( array(
            'name' => __( 'Video #' . $i . ' for 404 pages', 'bothand' ),
            'desc' => __( 'Upload video link', 'bothand' ),
            'id'   => 'video-404-' . $i . '-override',
            'type' => 'oembed',
        ) );    

    }

    $cmb->add_field( array(
        'name' => __( 'Alert', 'bothand' ),
        'desc' => __( 'If you need to relay an important message, this will create a red bar at the top of yoour website with your message. If it a long message, you can create a link to the content.', 'bothand' ),
        'id'   => 'alert',
        'type' => 'title',
    ) );   
    
    $cmb->add_field( array(
        'name' => __( 'Alert Message', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'alert-message',
        'type' => 'wysiwyg',
    ) ); 

    $cmb->add_field( array(
        'name' => __( 'End Date', 'bothand' ),
        'desc' => __( 'Date to stop displaying message.', 'bothand' ),
        'id'   => 'alert-date',
        'type' => 'text_date',
    ) ); 

    $cmb->add_field( array(
        'name' => __( 'Google Analytics', 'bothand' ),
        'desc' => __( 'If you haev a tracking id for Google Analytics, add it here. If you do not and would like to, let me know. Otherwsie you can leave this blank.', 'bothand' ),
        'id'   => 'google',
        'type' => 'title',
    ) );   

    $cmb->add_field( array(
        'name' => __( 'Tracking ID', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'gid',
        'type' => 'text',
    ) );  
	
}
add_action( 'cmb2_admin_init', 'register_settings_metabox' );
?>