<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Perfect_Portfolio
 */
    
    /**
     * After Content
     * 
     * @hooked perfect_portfolio_content_end - 20
     * @hooked perfect_portfolio_call_to_action - 25
    */
    do_action( 'perfect_portfolio_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked perfect_portfolio_footer_start  - 20
     * @hooked perfect_portfolio_footer_top    - 30
     * @hooked perfect_portfolio_footer_bottom - 40
     * @hooked perfect_portfolio_back_to_top   - 50
     * @hooked perfect_portfolio_footer_end    - 60
    */
    do_action( 'perfect_portfolio_footer' );
    
    /**
     * After Footer
     * 
     * @hooked perfect_portfolio_page_end - 20
    */
    do_action( 'perfect_portfolio_after_footer' );

    wp_footer(); ?>

</body>
</html>
