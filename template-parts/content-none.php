<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tabula_Rasa
 */

?>
<section class="no-results error404 not-found">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'He is not here. He has risen, just as He said.', 'tabula_rasa_tabularasa' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php esc_html_e( ' Maybe try one of the links below or a search?', 'tabula_rasa_tabularasa' ); ?></p>

		<?php
		get_search_form();

		get_template_part('template-parts/frontpage/videos'); 
		
		get_template_part('template-parts/frontpage/latest'); 
		?>

	</div><!-- .page-content -->

</section><!-- .error-404 -->