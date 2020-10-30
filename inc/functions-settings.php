<?php
/*************************************************************
functions-base is for functions that rarely get changed
	-not stuff you switch on and off
functions-options is for functions that are commonly used
	-stuff you switch on and off
functions-site file should be the specific functions for the website

**************************************************************/

/*************************************************************
ALL CAPS CASE
**************************************************************/

/** Proper Case
**************************************************************/

/** Proper Case **/

/*
Comments Single Line
or Multiple Line
*/

/*************************************************************
>>>TABLE OF CONTENTS
**************************************************************/
/*
SITE SPECIFIC FUNCTIONS
	- set content width
	- tr_site_specific_support()
	- tr_excerpt_more()
		// This removes the annoying [�] to a Read More link
	- tr_register_site_specific_sidebars()
	- tr_entry_meta()
COMMENT LAYOUT 
	- tr_comment()
MISC
	 - remove_default_post_formats()
	 - Google Analytics
**********************************************************/

/** Site Specific Functions
**************************************************************/

/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function tr_scripts_and_styles() {
	global $post;
	
	// FONTS
  //wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700|Open+Sans+Condensed:700&display=swap' );
  //wp_enqueue_style( 'local-font-awesome', get_stylesheet_directory_uri() . '/css/fontawesome/css/all.min.css' );
  	
  
	if (!is_admin()) {

		/**
 * Move jQuery to the footer. 
 * src: https://wordpress.stackexchange.com/questions/173601/enqueue-core-jquery-in-the-footer
 */
		wp_scripts()->add_data( 'jquery', 'group', 1 );
		wp_scripts()->add_data( 'jquery-core', 'group', 1 );
		wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

    // register main stylesheet
		wp_enqueue_style( 'tabula-rasa-style', get_stylesheet_directory_uri() . '/css/style.min.css' );
		
    // ie-only style sheet
		global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
		$wp_styles->add_data( 'tabula_rasa-ie-only', 'conditional', 'lte IE 9' ); // add conditional wrapper around ie stylesheet		
    wp_enqueue_style( 'tabula_rasa-ie-only', get_stylesheet_directory_uri() . '/css/ie.css', array(), '' );
//wp_enqueue_style( 'mmenu-css', get_template_directory_uri() . '/css/jquery.mmenu.css' );

//wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );
//wp_enqueue_style( 'mmenu-css', get_template_directory_uri() . '/css/mmenu.css' );

		//wp_enqueue_script( 'hide-search', get_template_directory_uri() . '/js/mmenu.js', array( 'jquery' ), '20140703', true );
		
		//adding scripts file in the footer
		wp_enqueue_script( 'tabula_rasa-js_custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'tabula_rasa-js_vendor', get_stylesheet_directory_uri() . '/js/vendor.js', array( 'jquery' ), '', true );
		/*
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '20140703', true );
		wp_enqueue_script( 'superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('superfish'), '20140703', true );
		
		wp_enqueue_script( 'prefix-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_script( 'mmenu-js', get_template_directory_uri() . '/js/jquery.mmenu.min.js', array( 'jquery' ), '20140703', true );
		wp_enqueue_script( 'mmenu-settings', get_template_directory_uri() . '/js/mmenu-settings.js', array('mmenu-js'), '20140703', true );
		
     
		wp_enqueue_script( 'hide-search', get_template_directory_uri() . '/js/hide-search.js', array( 'jquery' ), '20140703', true );
		
    wp_enqueue_script( 'tabula_rasa-js' );
		*/
  }
	//if( is_page('my-page') ) {}
  // if( is_single() )
  // if( is_home() )
  // if( 'cpt-name' == get_post_type() )
	// For shortcodes
	//if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'custom-shortcode') ) {}
	
	/*if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
	*/
	 
	// I recommend using a plugin to call jQuery using the google cdn. That way it stays cached and your site will load faster.
	//wp_enqueue_script( 'jquery' );	
}
add_action( 'wp_enqueue_scripts', 'tr_scripts_and_styles' );

/*
function my_style_loader_tag_filter($html, $handle) {

  if($handle === 'font-awesome') {

return str_replace("rel='stylesheet'", "media='print' onload='this.media='all';this.onload=null;'", $html);

  }
  
  return $html;

}
add_filter('style_loader_tag', 'my_style_loader_tag_filter', 10, 2);
*/
/**************************************************************
INCLUDES
**************************************************************/
/** Custom Post Types
**************************************************************/
//require_once('custom-post-type.php'); 

/** Widgets
**************************************************************/
//require_once('functions-widgets.php'); 

/** Meta Boxes
**************************************************************/
//require_once('metabox/metabox-functions.php'); 

/************************************************
EXCERPTS
*************************************************/
// This removes the annoying [�] to a Read More link
function tr_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'tabula_rasa') . get_the_title($post->ID).'">'. __('Read more &raquo;', 'tabula_rasa') .'</a>';
}	
add_filter('excerpt_more', 'tr_excerpt_more');

//Excerpt length
function tr_excerpt_length( $length ) {
	if ( is_archive() || is_page('recent-articles') ) {
		return 50;	
	} else {
		return 55;
	}
}
add_filter( 'excerpt_length', 'tr_excerpt_length' );

/*************************************************************
POST THUMBNAILS
**************************************************************/
//add_image_size( $name, $width, $height, $crop );
add_image_size( 'hero', 2500 );
//add_image_size( 'content', 1000  );
add_image_size( 'content-mobile', 800 );
//add_image_size( 'archive', 200, 150, true );

/*
* src: https://perishablepress.com/disable-wordpress-generated-images/
*
// disable generated image sizes
function shapeSpace_disable_image_sizes($sizes) {
	
	unset($sizes['thumbnail']);    // disable thumbnail size
	unset($sizes['medium']);       // disable medium size
	unset($sizes['large']);        // disable large size
	unset($sizes['medium_large']); // disable medium-large size
	unset($sizes['1536x1536']);    // disable 2x medium-large size
	unset($sizes['2048x2048']);    // disable 2x large size
	
	return $sizes;
	
}
add_action('intermediate_image_sizes_advanced', 'shapeSpace_disable_image_sizes');

// disable scaled image size
add_filter('big_image_size_threshold', '__return_false');

// disable other image sizes
function shapeSpace_disable_other_image_sizes() {
	
	remove_image_size('post-thumbnail'); // disable images added via set_post_thumbnail_size() 
	remove_image_size('thumbnail');   
	remove_image_size('medium');
	remove_image_size('large');
	remove_image_size('medium_large');
	remove_image_size('1536x1536');
	remove_image_size('2048x2048');
	remove_image_size('content');
	remove_image_size('content-mobile');
	remove_image_size('archive');
	
}
add_action('init', 'shapeSpace_disable_other_image_sizes');
*/
/*************************************************************
MISC
**************************************************************/
/*
 * Social media icon menu as per http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */

function tr_social_menu() {
  if ( has_nav_menu( 'social' ) ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'container'       => 'div',
				'container_id'    => 'menu-social',
				'container_class' => 'menu-social',
				'menu_id'         => 'menu-social-items',
				'menu_class'      => 'menu-items',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',			
				'fallback_cb'     => '',
			)
		);
  }
}


/** Google Analytics
**************************************************************/
function google_analytics_tracking_code(){ 
	$settings = get_option( 'settings');

	if ( $settings['gid'] ) {
	?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $settings['gid']; ?>"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '<?php echo $settings['gid']; ?>');
	</script>

<?php }	
}
add_action('wp_head', 'google_analytics_tracking_code');

// Add defer to javascript for page speed
// Src: https://kinsta.com/blog/defer-parsing-of-javascript/
function defer_parsing_of_js( $url ) {
    if ( is_user_logged_in() ) return $url; //don't break WP Admin
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    //if ( strpos( $url, 'jquery.js' ) ) return $url;
    return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );


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
			//'date_query' => array(
			//	'after' => date('c', strtotime( '-4 months' )),
			//),
		);
		
		$hasposts = get_posts( $args );

		if ( $hasposts ) {
			$media_array_checked[] = $posttype;
		}
		
	}
	
	return $media_array_checked;
}
?>