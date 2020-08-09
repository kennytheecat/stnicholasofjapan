<?php
/**
 * Template Name: Contact Pages
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
get_header();
?>
 
     <div id="primary" class="content-area">
         <main id="main" class="site-main">

         <?php
         while ( have_posts() ) :
             the_post(); ?>
 
             <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
                <?php
                wp_nav_menu( array(
                    'menu'     => 'Main Nav',
                    'sub_menu' => true,
                    'container_class' => 'submenu'
                    ) );
                ?>
                <div class="block">
                    <div class="wrapper"></div>
                </div>
                
                <div class="entry-content">

                    <?php get_template_part('template-parts/contact-buttons');  ?>

                    <?php the_content(); ?>
                </div><!-- .entry-content -->
            
            </article><!-- #post-<?php the_ID(); ?> -->
 
        <?php
         endwhile; // End of the loop.
         ?>
 
         </main><!-- #main -->
     </div><!-- #primary -->
 
<?php
get_sidebar();
get_footer();
 