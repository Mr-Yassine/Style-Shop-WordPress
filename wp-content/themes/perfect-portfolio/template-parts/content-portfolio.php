<?php
/**
 * Template part for displaying page content in single-portfolio.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */

/**
 * Post Gallery
 * 
 * @hooked perfect_portfolio_single_portfolio_thumbnail
*/
do_action( 'perfect_portfolio_before_single_portfolio_content' );

/**
 * Entry Content
 * 
 * @hooked perfect_portfolio_single_portfolio_content
*/
do_action( 'perfect_portfolio_single_portfolio_content' );