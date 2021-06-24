<?php
/**
 * Perfect Portfolio Customizer Partials
 *
 * @package Perfect_Portfolio
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function perfect_portfolio_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function perfect_portfolio_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'perfect_portfolio_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function perfect_portfolio_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You may also like...', 'perfect-portfolio' ) ) );
}
endif;

if( ! function_exists( 'perfect_portfolio_get_popular_title' ) ) :
/**
 * Display blog readmore button
*/
function perfect_portfolio_get_popular_title(){
    return esc_html( get_theme_mod( 'popular_post_title', __( 'Popular Posts', 'perfect-portfolio' ) ) );
}
endif;

if( ! function_exists( 'perfect_portfolio_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function perfect_portfolio_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    
    if( $copyright ){
        echo '<span class="copyright-text">' . wp_kses_post( $copyright ) . '</span>';
    }else{
        esc_html_e( '&copy; Copyright ', 'perfect-portfolio' );
        echo date_i18n( esc_html__( 'Y', 'perfect-portfolio' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
    } 
}
endif;

if( ! function_exists( 'perfect_portfolio_blog_section_title_selective_refresh' ) ) :
/**
 * Display blog title button
*/
function perfect_portfolio_blog_section_title_selective_refresh(){
    return esc_html( get_theme_mod( 'blog_section_title', __( 'Articles', 'perfect-portfolio' ) ) );    
}
endif;

if( ! function_exists( 'perfect_portfolio_get_blog_view_all_btn' ) ) :
/**
 * Display blog readmore button
*/
function perfect_portfolio_get_blog_view_all_btn(){
    return esc_html( get_theme_mod( 'blog_view_all', __( 'View All', 'perfect-portfolio' ) ) );    
}
endif;

if( ! function_exists( 'perfect_portfolio_get_gallery_view_all_btn' ) ) :
/**
 * Display gallery readmore button
*/
function perfect_portfolio_get_gallery_view_all_btn(){
    return esc_html( get_theme_mod( 'gallery_view_all', __( 'View More', 'perfect-portfolio' ) ) );    
}
endif;