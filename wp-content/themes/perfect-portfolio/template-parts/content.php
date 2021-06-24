<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Blog">
	<?php 
        /** 
         * @hooked perfect_portfolio_post_thumbnail - 20
        */
        do_action( 'perfect_portfolio_before_post_entry_content' );
    
        /**
         * @hooked perfect_portfolio_entry_post_content   - 10
        */
        do_action( 'perfect_portfolio_post_entry_content' );
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
