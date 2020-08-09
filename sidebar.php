<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tabula_Rasa
 */
?>

<aside id="secondary" class="widget-area">
	<div class="wrapper">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>

		<?php get_template_part('template-parts/sidebar/sidebar-buttons');  ?>

		<?php get_template_part('template-parts/sidebar/sidebar-image');  ?>
		
	</div>
</aside><!-- #secondary -->
