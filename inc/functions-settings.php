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
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700|Open+Sans+Condensed:700&display=swap' );

	wp_enqueue_style( 'local-font-awesome', get_stylesheet_directory_uri() . '/css/fontawesome/css/all.min.css' );
  	
  
	if (!is_admin()) {

    // register main stylesheet
	wp_enqueue_style( 'tabula-rasa-style', get_stylesheet_directory_uri() . '/css/style.min.css' );
		
    // ie-only style sheet
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	$wp_styles->add_data( 'tabula_rasa-ie-only', 'conditional', 'lte IE 9' ); // add conditional wrapper around ie stylesheet		
	wp_enqueue_style( 'tabula_rasa-ie-only', get_stylesheet_directory_uri() . '/css/ie.css', array(), '' );

		
	//adding scripts file in the footer
	wp_enqueue_script( 'tabula_rasa-js_custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'tabula_rasa-js_vendor', get_stylesheet_directory_uri() . '/js/vendor.js', array( 'jquery' ), '', true );
		
  }
  	
}
add_action( 'wp_enqueue_scripts', 'tr_scripts_and_styles' );


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
?>