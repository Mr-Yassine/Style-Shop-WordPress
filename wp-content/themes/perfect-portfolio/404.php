<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Perfect_Portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="tc-wrapper">
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><span><?php esc_html_e( '404.', 'perfect-portfolio' ); ?></span></h1>
					</header><!-- .page-header -->
					<div class="page-content">
						<h3><?php esc_html_e( 'Sorry, The Page is Not Found.', 'perfect-portfolio' ); ?></h3>					
						<p><?php esc_html_e( 'Can not find what you need? Take a moment and do a search below or start from our Homepage.', 'perfect-portfolio' ); ?></p>
						<?php get_search_form(); ?>					
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

				<?php
			    /**
			     * @see perfect_portfolio_latest_posts
			    */
			    do_action( 'perfect_portfolio_latest_posts' ); ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php 
get_footer();