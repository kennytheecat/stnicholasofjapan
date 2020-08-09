<?php
// Register Custom Post Type
function custom_post_type_bulletins() {

	$labels = array(
		'name'                  => _x( 'Bulletin', 'Post Type General Name', 'prescottorthodox' ),
		'singular_name'         => _x( 'Bulletin', 'Post Type Singular Name', 'prescottorthodox' ),
		'menu_name'             => __( 'Bulletins', 'prescottorthodox' ),
		'name_admin_bar'        => __( 'Bulletins', 'prescottorthodox' ),
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
		'label'                 => __( 'Bulletins', 'prescottorthodox' ),
		'description'           => __( 'Post Type Description', 'prescottorthodox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'thumbnail'  ),
		//'taxonomies'            => array( 'services' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
        'capability_type'    => 'bulletin',
        'map_meta_cap'       => true,
		'show_in_rest' => true,
	);
	register_post_type( 'bulletins', $args );

}
add_action( 'init', 'custom_post_type_bulletins', 0 );

// Register Custom Taxonomy
function custom_taxonomy_bulletin_types() {

	$labels = array(
		'name'                       => _x( 'Bulletin Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Bulletin Types', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Bulletin Types', 'text_domain' ),
		'all_items'                  => __( 'All Bulletin Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Bulletin Types', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Bulletin Types:', 'text_domain' ),
		'new_item_name'              => __( 'New Bulletin Types Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Bulletin Types', 'text_domain' ),
		'edit_item'                  => __( 'Edit Bulletin Types', 'text_domain' ),
		'update_item'                => __( 'Update Bulletin Types', 'text_domain' ),
		'view_item'                  => __( 'View Bulletin Types', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Bulletin Types', 'text_domain' ),
		'search_items'               => __( 'Search Bulletin Types', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No bulletin type', 'text_domain' ),
		'items_list'                 => __( 'Bulletin Types list', 'text_domain' ),
		'items_list_navigation'      => __( 'Bulletin Types list navigation', 'text_domain' ),
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
			'manage_terms' => 'manage_bulletin_types',
			'edit_terms' => 'edit_bulletin_types',
			'delete_terms' => 'delete_bulletin_types',
			'assign_terms' => 'assign_bulletin_types',
		),
	);
	register_taxonomy( 'bulletin_types', array( 'bulletins' ), $args );

}
add_action( 'init', 'custom_taxonomy_bulletin_types', 0 );

function create_bulletin_roles () {
	$cap = array(
		'delete_bulletins' => true,
		'delete_published_bulletins' => true,
		'edit_bulletins' => true,
		'edit_published_bulletins' => true,
		'publish_bulletins' => true,

		//taxonomomy
		'manage_bulletin_types'	=> true,
		'edit_bulletin_types'	=> true,
		'delete_bulletin_types'	=> true,
		'assign_bulletin_types'	=> true,

	);

	add_role( 'bulletin_author', 'Bulletin Author', $cap );

	// add the custom capabilities to the desired user roles 
$roles = array( 'editor','administrator' );

foreach( $roles as $the_role ) {      
    
    $role = get_role($the_role);
            
            $role->add_cap( 'read_private_bulletins' );
            $role->add_cap( 'edit_bulletins' );
			$role->add_cap( 'edit_others_bulletins' );
			$role->add_cap( 'edit_private_bulletins' );
            $role->add_cap( 'edit_published_bulletins' );
			$role->add_cap( 'publish_bulletins' );
			$role->add_cap( 'delete_bulletins' );
            $role->add_cap( 'delete_others_bulletins' );
            $role->add_cap( 'delete_private_bulletins' );
			$role->add_cap( 'delete_published_bulletins' );
			
			//taxonomy
			$role->add_cap( 'manage_bulletin_types' );
			$role->add_cap( 'edit_bulletin_types' );
			$role->add_cap( 'delete_bulletin_types' );
			$role->add_cap( 'assign_bulletin_types' );
}
}
add_action('after_switch_theme', 'create_bulletin_roles');
?>