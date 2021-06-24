<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */
    /**
     * Entry Header
     * 
     * @hooked perfect_portfolio_single_entry_header
    */
    do_action( 'perfect_portfolio_before_single_article' );

    /**
     * Post Thumbnail
     * 
     * @hooked perfect_portfolio_post_thumbnail
    */
    do_action( 'perfect_portfolio_before_single_header' );
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
