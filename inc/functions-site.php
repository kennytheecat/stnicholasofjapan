<?php
function get_image_id ($image_title) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title='%s';", $image_title));
    return $attachment[0];
}

// register new taxonomy which applies to attachments
function wptp_add_media_type_taxonomy() {
    $labels = array(
        'name'              => 'Media Types',
        'singular_name'     => 'Media Type',
        'search_items'      => 'Search Media Types',
        'all_items'         => 'All Media Types',
        'parent_item'       => 'Parent Media Type',
        'parent_item_colon' => 'Parent Media Type:',
        'edit_item'         => 'Edit Media Type',
        'update_item'       => 'Update Media Type',
        'add_new_item'      => 'Add New Media Type',
        'new_item_name'     => 'New Media Type Name',
        'menu_name'         => 'Media Type',
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'query_var' => 'true',
        'rewrite' => 'true',
        'show_admin_column' => 'true',
    );
 
    register_taxonomy( 'media_type', 'attachment', $args );
}
//add_action( 'init', 'wptp_add_media_type_taxonomy' );

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }
    
    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {
          if ( $menu_item->ID == $prev_root_id ) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          } 
        }
      }
    }

    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}


//** Social Media Array
///////////////////////////////////////////////////////
function get_sm_array() {
  return $sm_array = array( 'Facebook' => 'facebook', 'Instagram' => 'instagram',  'YouTube' => 'youtube', 'LinkedIn' => 'linkedin', 'Flickr' => 'flickr', 'SnapChat' => 'snapchat');
}
?>