<?php
/**
 * Template Name: Live Streaming template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

 /* make the API call */

get_header();

//page id
//175899995815558

// app id
//1140975389287212

// secret
//9d88cfe6e715b99e4a04c1af09a5067d
?>
<div id="fb-root"></div><script src="https://connect.facebook.net/en_US/sdk.js"></script><script>
          FB.init({
            appId   : 1140975389287212,
            status  : true,
            xfbml   : true,
            version : 'v2.9'
          });
          </script>
<script>
FB.api(
    "/175899995815558/videos",
    function (response) {
      if (response && !response.error) {
        console.log('Welcome!  Fetching your information.... ');
      }
    }
);
</script>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        
        <div id="demo">kenny</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
