<?php
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function register_info_metabox() {
	/**
	 * Registers main options page menu item and form.
	 */
	$args = array(
		'id'           => 'infobox',
		'title'        => 'Information Sections',
        'object_types' => array( 'page' ),
        'show_on'      => array( 'key' => 'page-template', 'value' => 'page-info.php' ),
		'option_key'   => 'visit',
	);
	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		//$args['display_cb'] = 'cop_options_display_with_tabs';
    }
    $cmb = new_cmb2_box( $args );


    $cmb->add_field( array(
        'name' => esc_html__( 'Info Section', 'cmb2' ),
        'desc' => esc_html__( 'The following options apply to the Services Section of the Front Page', 'cmb2' ),
        'id'   => '_intro',
        'type' => 'title',
    ) );


    // $group_field_id is the field id string, so in this case: $prefix . 'demo'
    $group_field_id = $cmb->add_field( array(
        'id'          => 'info',
        'type'        => 'group',
        'description' => __( '', 'cmb2' ),
        'options'     => array(
            'group_title'   => __( 'Info Box {#}', 'cmb2' ), // {#} gets replaced by row number
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
        'name'       => __( 'Title', 'cmb2' ),
        'id'         => 'title',
        'type'       => 'text',
    ) );

    $cmb->add_group_field( $group_field_id, array(
        'name' => __( 'Link', 'cmb2' ),
        'desc' => __( '', 'cmb2' ),
        'id'   => 'url',
        'type' => 'post_search_text',
        'post_type'   => array('post', 'page', 'sermons'),
    ) );	
			
	
}
add_action( 'cmb2_admin_init', 'register_info_metabox' );
?>