<?php
/**
 * Template part for displaying page content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */

    /**
     * Post Thumbnail
     * 
     * @hooked perfect_portfolio_post_thumbnail
    */
    do_action( 'perfect_portfolio_before_single_header' );

    /**
     * Entry Header
     * 
     * @hooked perfect_portfolio_single_entry_header
    */
    do_action( 'perfect_portfolio_before_single_article' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
        /**
         * Entry Content
         *
         * @hooked perfect_portfolio_single_entry_content - 10
        */
        do_action( 'perfect_portfolio_single_article' );    
    ?>
</article><!-- #post-<?php the_ID(); ?> -->