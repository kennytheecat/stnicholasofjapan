<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function register_frontpage_metabox() {
	/**
	 * Registers main options page menu item and form.
	 */
	$args = array(
		'id'           => 'frontpage',
		'title'        => 'Front Page',
		'object_types' => array( 'options-page' ),
		'option_key'   => 'frontpage',
	);
	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		//$args['display_cb'] = 'cop_options_display_with_tabs';
    }
    $cmb = new_cmb2_box( $args );

    $cmb->add_field( array(
        'name' => esc_html__( 'Hero Section', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Hero Section of the Front Page', 'cmb2' ),
        'id'   => 'hero_section',
        'type' => 'title',        
    ) );
    
    $cmb->add_field( array(
        'name' => __( 'Hero Section Image', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'hero_image',
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
        'name' => __( 'Hero Section Slogan', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'hero_slogan',
        'type' => 'text',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Button #1 Text ', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'hero_button_1_text',
        'type' => 'text',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Button #1 Link ', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'hero_button_1_url',
        'type' => 'post_search_text',
        'post_type'   => array('post', 'page', 'sermons'),
        // Default is 'checkbox', used in the modal view to select the post type
        'select_type' => 'radio',
        // Will replace any selection with selection from modal. Default is 'add'
        'select_behavior' => 'replace',        
    ) );  
    
    $cmb->add_field( array(
        'name' => __( 'Button #2 Text ', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'hero_button_2_text',
        'type' => 'text',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Button #2 Link ', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'hero_button_2_url',
        'type' => 'post_search_text',
        'post_type'   => array('post', 'page', 'sermons'),
        // Default is 'checkbox', used in the modal view to select the post type
        'select_type' => 'radio',
        // Will replace any selection with selection from modal. Default is 'add'
        'select_behavior' => 'replace',  
    ) );      

    $cmb->add_field( array(
        'name' => esc_html__( 'Services Section', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Services Section of the Front Page', 'cmb2' ),
        'id'   => 'services_intro',
        'type' => 'title',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Service Section Content', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'content',
        'type' => 'wysiwyg',
    ) ); 

    $cmb->add_field( array(
        'name' => __( 'Google Map Link', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'map_embed',
        'type' => 'textarea_code',
    ) );
    

    $cmb->add_field( array(
        'name' => esc_html__( 'Welcome Message', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Welcome Message Section of the Front Page', 'cmb2' ),
        'id'   => 'welcome_section',
        'type' => 'title',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Welcome Message Heading', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'welcome_heading',
        'type' => 'text',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Welcome Message Content', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'welcome_content',
        'type' => 'wysiwyg',
    ) );    
    
    $cmb->add_field( array(
        'name' => __( 'Welcome Message Image', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'welcome_image',
        'type' => 'file',
    ) );     

    $cmb->add_field( array(
        'name' => __( 'Welcome Message Video', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'welcome_video',
        'type' => 'oembed',
    ) );        
   

    $cmb->add_field( array(
        'name' => esc_html__( 'Videos Section', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Videos Section of the Front Page', 'cmb2' ),
        'id'   => 'video_section',
        'type' => 'title',        
    ) );
   
    for ( $i = 1; $i <= 4; $i++ ) {

        $cmb->add_field( array(
            'name' => __( 'Video #' . $i . ' Title', 'bothand' ),
            'desc' => __( '', 'bothand' ),
            'id'   => 'videos_video_' . $i . '_title',
            'type' => 'text',
        ) );    

        $cmb->add_field( array(
            'name' => __( 'Video #' . $i, 'bothand' ),
            'desc' => __( '', 'bothand' ),
            'id'   => 'videos_video_' . $i,
            'type' => 'oembed',
        ) );    
    }
    
    $cmb->add_field( array(
        'name' => esc_html__( 'Prayer Request', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Prayer Request Section of the Front Page', 'cmb2' ),
        'id'   => 'prayer_section',
        'type' => 'title',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Prayer Request Heading', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'prayer_heading',
        'type' => 'text',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Prayer Request Content', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'prayer_content',
        'type' => 'wysiwyg',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Prayer Request Button Text', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'prayer_button',
        'type' => 'text',
    ) );        

    $cmb->add_field( array(
        'name' => __( 'Prayer Request Button Url', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'prayer_button_url',
        'type' => 'post_search_text',
        'post_type'   => array('post', 'page', 'sermons'),
        // Default is 'checkbox', used in the modal view to select the post type
        'select_type' => 'radio',
        // Will replace any selection with selection from modal. Default is 'add'
        'select_behavior' => 'replace',  
    ) );          

    $cmb->add_field( array(
        'name' => esc_html__( 'Ask the Priest', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Ask the Priest Section of the Front Page', 'cmb2' ),
        'id'   => 'ask_section',
        'type' => 'title',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Ask the Priest Heading', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'ask_heading',
        'type' => 'text',
    ) );    

    $cmb->add_field( array(
        'name' => __( 'Ask the Priest Content', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'ask_content',
        'type' => 'wysiwyg',
    ) );    
    
    $cmb->add_field( array(
        'name' => __( 'Ask the Priest Button Text', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'ask_button',
        'type' => 'text',
    ) );   
    
    $cmb->add_field( array(
        'name' => __( 'Ask the Priest Button Url', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'ask_button_url',
        'type' => 'post_search_text',
        'post_type'   => array('post', 'page', 'sermons'),
        // Default is 'checkbox', used in the modal view to select the post type
        'select_type' => 'radio',
        // Will replace any selection with selection from modal. Default is 'add'
        'select_behavior' => 'replace',  
    ) );      
    
    // $group_field_id is the field id string, so in this case: $prefix . 'demo'
    $group_field_id = $cmb->add_field( array(
        'id'          => 'spotlight_front_page',
        'type'        => 'group',
        'description' => __( '', 'cmb2' ),
        'options'     => array(
            'group_title'   => __( 'Spotlight {#}', 'cmb2' ), // {#} gets replaced by row number
            'add_button'    => __( 'Add Another Entry', 'cmb2' ),
            'remove_button' => __( 'Remove Entry', 'cmb2' ),
            'sortable'      => true, // beta
            // 'closed'     => true, // true to have the groups closed by default
        ),
    ) );			
	
}
add_action( 'cmb2_admin_init', 'register_frontpage_metabox' );
?>