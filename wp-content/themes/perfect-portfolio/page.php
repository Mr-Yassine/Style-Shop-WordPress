<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */
get_header(); 
perfect_portfolio_tc_wrapper_start(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			
			perfect_portfolio_entry_footer();

			/**
             * Comment Template
             * 
             * @hooked perfect_portfolio_comment
            */
            do_action( 'perfect_portfolio_after_page_content' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
perfect_portfolio_tc_wrapper_ends();
get_footer();
