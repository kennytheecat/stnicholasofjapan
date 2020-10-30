<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package tabula-rasa
 */
?>
<!DOCTYPE html>
<!-- language_attributes section replaced with Bones -->
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Not sure what this does -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- Not sure if this is needed  -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>

	<!-- Inlined Google Font loading -->
<style>
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v17/mem8YaGs126MiZpBA-UFVZ0b.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  font-display: swap;
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 700;
  src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v17/mem5YaGs126MiZpBA-UN7rgOUuhp.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  font-display: swap;
}
@font-face {
  font-family: 'Open Sans Condensed';
  font-style: normal;
  font-weight: 700;
  src: local('Open Sans Condensed Bold'), local('OpenSansCondensed-Bold'), url(https://fonts.gstatic.com/s/opensanscondensed/v14/z7NFdQDnbTkabZAIOl9il_O6KJj73e7Ff0GmDuXMRw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  font-display: swap;
}
</style>
<link rel="preload" href="/wp-content/themes/tabula-rasa_nicholas-of-japan/css/fontawesome/webfonts/fa-brands-400.woff2" as="font" crossorigin="anonymous">
<link rel="preload" href="/wp-content/themes/tabula-rasa_nicholas-of-japan/css/fontawesome/webfonts/fa-solid-900.woff2" as="font" crossorigin="anonymous">
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site site-canvas">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'tabula-rasa' ); ?></a>

	<?php get_template_part('template-parts/alerts/top'); ?>

	<header id="masthead" class="site-header" role="banner">
		
		<div class="wrapper">
		
		<div class="header-top">
		<div class="wrapper">

        <!-- Mobile Only -->
		<div class="mobile-menu">
				<i class="fa fa-bars"></i>
				<a href="#menu-container" class="screen-reader-text"><?php _e( 'Menu', 'tabula-rasa' ); ?></a>
		</div>
		
        <!-- Both Mobile and Desktop -->
		<div class="site-branding">	
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
        
        <!-- Mobile Only -->
		<div class="search-mobile">
			<i class="fa fa-search"></i>
			<a href="" class="screen-reader-text"><?php _e( 'Search', 'tabula-rasa' ); ?></a>		
		</div>
        
        <!-- Print Only -->
		<div class="QRprintonly">
			<?php
			$permalink = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			// QR code url
			$qr_code_url = 'http://chart.apis.google.com/chart?chs=100x100&cht=qr&chld=|0&chl='.urlencode($permalink);
			?>
			<p>Scan to visit this page:</p>
			<img src="<?php echo $qr_code_url; ?>
			" />
		</div>	

		</div><!-- end .wrapper --> 
		</div><!-- end . header-top -->
		
		<!-- Both Mobile and Desktop -->
		<nav id="site-navigation" class="main-navigation" role="navigation">

        <!-- Desktop Only -->
		<div id="search-container" class="search-box-wrapper">
			<div class="wrapper">

				<div class="search-box">
					<?php get_search_form(); ?>
				</div>

			</div><!-- end .wrapper --> 
		</div>
				
		<div class="wrapper">

			<!-- used to use tr_main_nav() from bones. switched back to _s. unneeded arguments -->
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'nav-menu', 'after' => '<span class="mobile-button"></span>') ); ?>
			<div class="search-not-mobile">
			<i class="fa fa-search"></i>
			<a href="" class="screen-reader-text"><?php _e( 'Search', 'tabula-rasa' ); ?></a>
			</div>				
			<?php //tr_social_menu(); ?>

		</div><!-- end .wrapper --> 

		</nav><!-- #site-navigation -->
		
		</div><!-- end .wrapper --> 
	</header><!-- #masthead -->

	<div id="content" class="site-content">