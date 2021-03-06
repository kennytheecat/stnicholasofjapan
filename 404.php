<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Tabula_Rasa
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error404 not-found">
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

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
