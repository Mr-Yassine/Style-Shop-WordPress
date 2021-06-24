<?php
/**
 * Template Name: Portfolio Template
 *
 * @package Perfect_Portfolio
 */
get_header(); ?>
	
	<div class="tc-wrapper">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php
                perfect_portfolio_get_portfolio_buttons( false );
	        	perfect_portfolio_get_portfolios( -1 );
		        ?>
	        </main>
		</div><!-- #primary -->
	</div>

<?php
get_footer();
