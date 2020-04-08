<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function register_visit_metabox() {
	/**
	 * Registers main options page menu item and form.
	 */
	$args = array(
		'id'           => 'visit',
		'title'        => 'Visitor Sections',
		'object_types' => array( 'page' ),
		'option_key'   => 'visit',
	);
	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		//$args['display_cb'] = 'cop_options_display_with_tabs';
    }
    $cmb = new_cmb2_box( $args );


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
        'name' => __( 'Prayer Request Image', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'prayer_image',
        'type' => 'file',
    ) );     

    $cmb->add_field( array(
        'name' => __( 'Prayer Request Button Text', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'prayer_button',
        'type' => 'text',
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
        'name' => __( 'Ask the Priest Image', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'ask_image',
        'type' => 'file',
    ) );     

    $cmb->add_field( array(
        'name' => __( 'Ask the Priest Button Text', 'bothand' ),
        'desc' => __( '', 'bothand' ),
        'id'   => 'ask_button',
        'type' => 'text',
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

    /** 
     * Group fields works the same, except ids only need
     * to be unique to the group. Prefix is not needed.
     *
     * The parent field's id needs to be passed as the first argument.
     */
    $cmb->add_group_field( $group_field_id, array(
        'name'       => __( 'Spotlight Title', 'cmb2' ),
        'id'         => 'title',
        'type'       => 'text',
    ) );

    $cmb->add_group_field( $group_field_id, array(
        'name' => __( 'Spotlight Link', 'cmb2' ),
        'desc' => __( '', 'cmb2' ),
        'id'   => 'url',
        'type' => 'text_url',
    ) );	


    $cmb->add_group_field( $group_field_id, array(
        'name'       => __( 'Upload Image', 'cmb2' ),
        'id'         => 'image',
        'type'       => 'file',
    ) );				
	
}
add_action( 'cmb2_admin_init', 'register_visit_metabox' );
?>