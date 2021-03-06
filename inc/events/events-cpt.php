<?php
// Register Custom Post Type
function custom_post_type_events() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'prescottorthodox' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'prescottorthodox' ),
		'menu_name'             => __( 'Events', 'prescottorthodox' ),
		'name_admin_bar'        => __( 'Events', 'prescottorthodox' ),
		'archives'              => __( 'Item Archives', 'prescottorthodox' ),
		'parent_item_colon'     => __( 'Parent Item:', 'prescottorthodox' ),
		'all_items'             => __( 'All Items', 'prescottorthodox' ),
		'add_new_item'          => __( 'Add New Item', 'prescottorthodox' ),
		'add_new'               => __( 'Add New', 'prescottorthodox' ),
		'new_item'              => __( 'New Item', 'prescottorthodox' ),
		'edit_item'             => __( 'Edit Item', 'prescottorthodox' ),
		'update_item'           => __( 'Update Item', 'prescottorthodox' ),
		'view_item'             => __( 'View Item', 'prescottorthodox' ),
		'search_items'          => __( 'Search Item', 'prescottorthodox' ),
		'not_found'             => __( 'Not found', 'prescottorthodox' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'prescottorthodox' ),
		'featured_image'        => __( 'Featured Image', 'prescottorthodox' ),
		'set_featured_image'    => __( 'Set featured image', 'prescottorthodox' ),
		'remove_featured_image' => __( 'Remove featured image', 'prescottorthodox' ),
		'use_featured_image'    => __( 'Use as featured image', 'prescottorthodox' ),
		'insert_into_item'      => __( 'Insert into item', 'prescottorthodox' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'prescottorthodox' ),
		'items_list'            => __( 'Items list', 'prescottorthodox' ),
		'items_list_navigation' => __( 'Items list navigation', 'prescottorthodox' ),
		'filter_items_list'     => __( 'Filter items list', 'prescottorthodox' ),
	);
	$args = array(
		'label'                 => __( 'Event', 'prescottorthodox' ),
		'description'           => __( 'Post Type Description', 'prescottorthodox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'thumbnail', 'editor' ),
		//'taxonomies'            => array( 'locations' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
        'capability_type'    => 'event',
        'map_meta_cap'       => true,
		'show_in_rest' => true, 
	);
	register_post_type( 'events', $args );

}
add_action( 'init', 'custom_post_type_events', 0 );

// Register Custom Taxonomy
function custom_taxonomy_location_types() {

	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Location', 'text_domain' ),
		'all_items'                  => __( 'All Locations', 'text_domain' ),
		'parent_item'                => __( 'Parent Location', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Location:', 'text_domain' ),
		'new_item_name'              => __( 'New Location Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Location', 'text_domain' ),
		'edit_item'                  => __( 'Edit Location', 'text_domain' ),
		'update_item'                => __( 'Update Location', 'text_domain' ),
		'view_item'                  => __( 'View Location', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Location', 'text_domain' ),
		'search_items'               => __( 'Search Location', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No location', 'text_domain' ),
		'items_list'                 => __( 'Location list', 'text_domain' ),
		'items_list_navigation'      => __( 'Locations list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'capabilities' => array(
			'manage_terms' => 'manage_locations',
			'edit_terms' => 'edit_locations',
			'delete_terms' => 'delete_locations',
			'assign_terms' => 'assign_locations',
		),
	);
	register_taxonomy( 'locations', array( 'events' ), $args );

}
add_action( 'init', 'custom_taxonomy_location_types', 0 );


function create_event_roles () {
	
	remove_role( 'event_author' );

	$cap = array(
		'read'				=>	true,
		'delete_events' => true,
		'delete_published_events' => true,
		'edit_events' => true,
		'edit_published_events' => true,
		'publish_events' => true,

		//taxonomomy
		'manage_locations'	=> true,
		'edit_locations'	=> true,
		'delete_locations'	=> true,
		'assign_locations'	=> true,
	);

	add_role( 'event_author', 'Event Author', $cap );

	// add the custom capabilities to the desired user roles 
$roles = array( 'editor','administrator' );

foreach( $roles as $the_role ) {      
    
    $role = get_role($the_role);
            
            $role->add_cap( 'read_private_events' );
            $role->add_cap( 'edit_events' );
			$role->add_cap( 'edit_others_events' );
			$role->add_cap( 'edit_private_events' );
            $role->add_cap( 'edit_published_events' );
			$role->add_cap( 'publish_events' );
			$role->add_cap( 'delete_events' );
            $role->add_cap( 'delete_others_events' );
            $role->add_cap( 'delete_private_events' );
			$role->add_cap( 'delete_published_events' );
			
			//taxonomy
			$role->add_cap( 'manage_locations' );
			$role->add_cap( 'edit_locations' );
			$role->add_cap( 'delete_locations' );
			$role->add_cap( 'assign_locations' );			
}
}
add_action('after_switch_theme', 'create_event_roles');

$location_meta = array( 'address', 'city', 'state');

// May need this on install
/*
function location_register_meta() {
	foreach ( $location_meta as $meta ) {
		register_meta( 'locations', $meta );
	}
}
*/
//add_action( 'init', 'location_register_meta' );


add_action( 'locations_add_form_fields', 'location_address_field' );

function location_address_field() { 

	echo '<div class="form-field location-wrap">';

	global $location_meta;  
	foreach ( $location_meta as $meta ) { 

	wp_nonce_field( basename( __FILE__ ), 'location_' . $meta . '_nonce' ); ?>
		
        <label for="<?php echo $meta; ?>"><?php echo ucwords($meta); ?></label>
        <input type="text" name="<?php echo $meta; ?>" id="<?php echo $meta; ?>" value="" class="<?php echo $meta; ?>"  />
	<?php }  ?>	
    </div>
<?php }



add_action( 'locations_edit_form_fields', 'edit_location_address_field' );

function edit_location_address_field( $term ) {

	global $location_meta;  
	foreach ( $location_meta as $meta ) { 

    $value = get_term_meta( $term->term_id, $meta, true );

    if ( ! $value )
        $value = ''; ?>

    <tr class="form-field <?php echo $meta; ?>-wrap">
        <th scope="row"><label for="<?php echo $meta; ?>"><?php echo ucwords($meta); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'location_' . $meta . '_nonce' ); ?>
            <input type="text" name="<?php echo $meta; ?>" id="<?php echo $meta; ?>" value="<?php echo esc_attr( $value ); ?>" class="<?php echo $meta; ?>-field" />
        </td>
    </tr>
	<?php }  ?>
<?php }


add_action( 'edit_locations',   'save_location_meta' );
add_action( 'create_locations', 'save_location_meta' );

function save_location_meta( $term_id ) {

	global $location_meta;  
	foreach ( $location_meta as $meta ) { 

		if ( ! isset( $_POST['location_' . $meta . '_nonce'] ) || ! wp_verify_nonce( $_POST['location_' . $meta . '_nonce'], basename( __FILE__ ) ) )
			return;

		$old_value = get_term_meta( $term_id, $meta, true );
		$new_value = isset( $_POST['' . $meta .''] ) ? $_POST['' . $meta .'']  : '';

		if ( $old_value && '' === $new_value )
			delete_term_meta( $term_id, $meta );

		else if ( $old_value !== $new_value )
			update_term_meta( $term_id, $meta, $new_value );
	}
}
?>