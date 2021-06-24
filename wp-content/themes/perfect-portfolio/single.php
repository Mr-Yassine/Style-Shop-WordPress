<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Perfect_Portfolio
 */
get_header(); 
perfect_portfolio_tc_wrapper_start(); ?>

	<div id="primary" class="content-area">
	    <main id="main" class="site-main">

    		<?php
    		while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', 'single' );

    		endwhile; // End of the loop.

            /**
             * @hooked perfect_portfolio_tc_wrapper    - 10
             * @hooked perfect_portfolio_entry_footer  - 13
             * @hooked perfect_portfolio_navigation    - 15 
             * @hooked perfect_portfolio_author        - 20
             * @hooked perfect_portfolio_popular_posts - 30
             * @hooked perfect_portfolio_related_posts - 35
             * @hooked perfect_portfolio_tc_wrapper_end- 40
             * @hooked perfect_portfolio_comment       - 45
            */
            do_action( 'perfect_portfolio_after_post_content' );
            ?>            
    	</main><!-- #main -->
	</div><!-- #primary -->
<?php 
get_sidebar();
perfect_portfolio_tc_wrapper_ends();
get_footer();
