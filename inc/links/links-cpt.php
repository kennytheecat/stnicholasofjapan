<?php
// Register Custom Post Type
function custom_post_type_links() {

	$labels = array(
		'name'                  => _x( 'Links', 'Post Type General Name', 'prescottorthodox' ),
		'singular_name'         => _x( 'Link', 'Post Type Singular Name', 'prescottorthodox' ),
		'menu_name'             => __( 'Links', 'prescottorthodox' ),
		'name_admin_bar'        => __( 'Links', 'prescottorthodox' ),
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
		'label'                 => __( 'Link', 'prescottorthodox' ),
		'description'           => __( 'Post Type Description', 'prescottorthodox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'thumbnail'  ),
		//'taxonomies'            => array( 'link-typess' ),
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
        'capability_type'    => 'link',
        'map_meta_cap'       => true,
		'show_in_rest' => true,
	);
	register_post_type( 'links', $args );

}
add_action( 'init', 'custom_post_type_links', 0 );

// Register Custom Taxonomy
function custom_taxonomy_link_types() {

	$labels = array(
		'name'                       => _x( 'Link Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Link Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Link Type', 'text_domain' ),
		'all_items'                  => __( 'All Link Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Link Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Link Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Link Type Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Link Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Link Type', 'text_domain' ),
		'update_item'                => __( 'Update Link Type', 'text_domain' ),
		'view_item'                  => __( 'View Link Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Link Type', 'text_domain' ),
		'search_items'               => __( 'Search Link Type', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No link-types', 'text_domain' ),
		'items_list'                 => __( 'Link Type list', 'text_domain' ),
		'items_list_navigation'      => __( 'Link Types list navigation', 'text_domain' ),
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
			'manage_terms' => 'manage_link_types',
			'edit_terms' => 'edit_link_types',
			'delete_terms' => 'delete_link_types',
			'assign_terms' => 'assign_link_types',
		),
	);
	register_taxonomy( 'link_types', array( 'links' ), $args );

}
add_action( 'init', 'custom_taxonomy_link_types', 0 );

function create_link_roles () {
	$cap = array(
		'delete_links' => true,
		'delete_published_links' => true,
		'edit_links' => true,
		'edit_published_links' => true,
		'publish_links' => true,

		//taxonomomy
		'manage_link_types'	=> true,
		'edit_link_types'	=> true,
		'delete_link_types'	=> true,
		'assign_link_types'	=> true,		
	);

	add_role( 'link_author', 'Link Author', $cap );
/*
	$role = get_role('link_author');
				
	$role->add_cap( 'manage_link_types' );
	$role->add_cap( 'edit_link_types' );
	$role->add_cap( 'delete_link_types' );
	$role->add_cap( 'assign_link_types' );

	*/

	// add the custom capabilities to the desired user roles 
$roles = array( 'editor','administrator' );

foreach( $roles as $the_role ) {      
    
    $role = get_role($the_role);
            
            $role->add_cap( 'read_private_links' );
            $role->add_cap( 'edit_links' );
			$role->add_cap( 'edit_others_links' );
			$role->add_cap( 'edit_private_links' );
            $role->add_cap( 'edit_published_links' );
			$role->add_cap( 'publish_links' );
			$role->add_cap( 'delete_links' );
            $role->add_cap( 'delete_others_links' );
            $role->add_cap( 'delete_private_links' );
			$role->add_cap( 'delete_published_links' );
			
			//taxonomy
			$role->add_cap( 'manage_link_types' );
			$role->add_cap( 'edit_link_types' );
			$role->add_cap( 'delete_link_types' );
			$role->add_cap( 'assign_link_types' );	

}
}
add_action('after_switch_theme', 'create_link_roles');
?>