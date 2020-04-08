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
		<button>Plan a Visit</button>
		<button>What is Orthodoxy</button>
		<button>Submit a Prayer Request</button>
		<button>Ask a Question</button>

		<div class="tree">
			<div class="wrapper"></div>
		</div>		
	</div>
</aside><!-- #secondary -->
