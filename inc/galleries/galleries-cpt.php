<?php
// Register Custom Post Type
function custom_post_type_galleries() {

	$labels = array(
		'name'                  => _x( 'Galleries', 'Post Type General Name', 'prescottorthodox' ),
		'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'prescottorthodox' ),
		'menu_name'             => __( 'Galleries', 'prescottorthodox' ),
		'name_admin_bar'        => __( 'Galleries', 'prescottorthodox' ),
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
		'label'                 => __( 'Gallery', 'prescottorthodox' ),
		'description'           => __( 'Post Type Description', 'prescottorthodox' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'thumbnail', 'editor' ),
		//'taxonomies'            => array( 'services' ),
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
		'show_in_rest' => true,
	);
	register_post_type( 'galleries', $args );

}
add_action( 'init', 'custom_post_type_galleries', 0 );
?>