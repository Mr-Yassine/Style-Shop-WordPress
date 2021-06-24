<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Perfect_Portfolio
 */
    /**
     * Doctype Hook
     * 
     * @hooked perfect_portfolio_doctype
    */
    do_action( 'perfect_portfolio_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked perfect_portfolio_head
    */
    do_action( 'perfect_portfolio_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();

    /**
     * Before Header
     * 
     * @hooked perfect_portfolio_page_start - 20 
    */
    do_action( 'perfect_portfolio_before_header' );
    
    /**
     * Header
     * 
     * @hooked perfect_portfolio_header - 20     
    */
    do_action( 'perfect_portfolio_header' );
        
    /**
     * Content
     * 
     * @hooked perfect_portfolio_content_start
    */
    do_action( 'perfect_portfolio_content' );