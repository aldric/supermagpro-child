<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AcmeThemes
 * @subpackage SuperMag
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'supermag' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'supermag' ); ?></p>

					<?php get_search_form(); ?>
					<div class="list-group">
					  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="list-group-item">
					    Retourner &agrave; l'accueil
					  </a>
					  <a href="<?php echo esc_url( home_url( '/banque-en-ligne/' ) ); ?>" class="list-group-item">Comparer les banques, et trouver celle qui vous convient</a>
					  <a href="<?php echo esc_url( home_url( '/contactez-nos-experts/' ) ); ?>" class="list-group-item">Contacter notre &eacute;quipe</a>
					</div>
					<div style="padding-bottom:50px;"><img src="<?php echo get_stylesheet_directory_uri().'/404.png'; ?>"></img></div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
