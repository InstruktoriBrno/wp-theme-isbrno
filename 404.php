<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Instruktoři Brno
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Jejda! Tak tohle tady nemáme...', 'instruktori' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Omlouváme se, ale stránka, na kterou jste se chtěli dostat tu již není. Buďto máte špatný odkaz nebo již byla odstraněna.<br/><strong>Ale nezoufejte!</strong> <a href="/">Koukněte se na úvodní stránku</a> a zjistíte, že toho děláme spoustu zajímavého...', 'instruktori' ); ?></p>
				</div><!-- .entry-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
