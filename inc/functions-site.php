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


// Filter video output
/**
 * src: https://wordpress.stackexchange.com/questions/110625/add-parameters-vimeo-videos-using-wordpress-embeds
 */
add_filter( 'oembed_result', function ( $html, $url, $args ) {
  $doc = new DOMDocument();
  $doc->loadHTML( $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
  $tags = $doc->getElementsByTagName( 'iframe' );

  foreach ( $tags as $tag ) {
      $iframe_src = $tag->attributes->getNamedItem('src')->value;

      if ( false !== strpos( $iframe_src, 'youtube.com' ) ) {
          // https://developers.google.com/youtube/player_parameters
          $url = add_query_arg( array(
              'autohide' => 1,
              //'autoplay' => 1,
              'controls' => 2,
              'feature' => null,
              'modestbranding' => 1,
              'playsinline' => 1,
              'rel' => 0,
              'showinfo' => 0,
          ), $iframe_src );
      }

      if ( false !== strpos( $iframe_src, 'vimeo.com' ) ) {
          // https://developer.vimeo.com/player/embedding
          $url = add_query_arg( array(
              //'autoplay' => 1,
              'badge' => 0,
              'byline' => 0,
              'portrait' => 0,
              'title' => 0,
          ), $iframe_src );
      }

      $tag->setAttribute( 'src', '' );
      $tag->setAttribute( 'data-src', $url );

      $html = $doc->saveHTML();
  }

  return $html; 
}, 10, 3 );

// Mod media menu
function your_custom_menu_item ( $items, $args ) {

	$media_array = check_media_array();

    if (  $args->menu_section == 'media') {

		foreach ( $media_array as $posttype ) {

            if ( $posttype == 'post') {
                $posttype = 'articles';
            }
            $link = str_replace( ' ', '-', $posttype);
            $title = ucwords($posttype);
            if ( $posttype == 'bulletins') {
                $link = 'bulletins-newsletters';
                $title = 'Bulletins/Newsletters';
			}    
						
			$items .= '<li><a href="' . home_url() . '/' . $link . '">' . $title . '</a></li>';
		}
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );

// Check which media categories acctually have items
function check_media_array() {
	$media_array = array( 'post', 'events', 'galleries', 'sermons', 'bulletins', 'links' );
	$media_array_checked = array();

	foreach ( $media_array as $posttype ) {
		$args = array(
			'post_type' => $posttype,
		);
		
		$hasposts = get_posts( $args );

		if ( $hasposts ) {
			$media_array_checked[] = $posttype;
		}
		
	}
	
	return $media_array_checked;
}
?>