<?php
// Register Custom Post Type
function custom_post_type_sermons() {

	$labels = array(
		'name'                  => _x( 'Sermons', 'Post Type General Name', 'prescottorthodox' ),
		'singular_name'         => _x( 'Sermon', 'Post Type Singular Name', 'prescottorthodox' ),
		'menu_name'             => __( 'Sermons', 'prescottorthodox' ),
		'name_admin_bar'        => __( 'Sermons', 'prescottorthodox' ),
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
		'label'                 => __( 'Sermon', 'prescottorthodox' ),
		'description'           => __( 'Post Type Description', 'prescottorthodox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'thumbnail'),
		'taxonomies'            => array( 'services' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-controls-volumeon',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'sermons', $args );

}
add_action( 'init', 'custom_post_type_sermons', 0 );

// Register Custom Taxonomy
function custom_taxonomy_service_types() {

	$labels = array(
		'name'                       => _x( 'Services', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Service', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Service', 'text_domain' ),
		'all_items'                  => __( 'All Services', 'text_domain' ),
		'parent_item'                => __( 'Parent Service', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Service:', 'text_domain' ),
		'new_item_name'              => __( 'New Service Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Service', 'text_domain' ),
		'edit_item'                  => __( 'Edit Service', 'text_domain' ),
		'update_item'                => __( 'Update Service', 'text_domain' ),
		'view_item'                  => __( 'View Service', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Service', 'text_domain' ),
		'search_items'               => __( 'Search Service', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No service', 'text_domain' ),
		'items_list'                 => __( 'Service list', 'text_domain' ),
		'items_list_navigation'      => __( 'Services list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'services', array( 'sermons' ), $args );

	wp_insert_term( 'Divine Liturgy', 'services');
	wp_insert_term( 'Vespers', 'services');

}
add_action( 'init', 'custom_taxonomy_service_types', 0 );
?>