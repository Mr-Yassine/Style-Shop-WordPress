<?php
/**
 * Perfect Portfolio Customizer
 *
 * @package Perfect_Portfolio
 */
if ( ! function_exists( 'perfect_portfolio_customize_register' ) ) :

function perfect_portfolio_customize_register( $wp_customize ) {
	
    /** Add postMessage support for site title and description */
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
	
    if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'perfect_portfolio_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'perfect_portfolio_customize_partial_blogdescription',
		) );
	}
    
    /** Site Title Font */
    $wp_customize->add_setting( 
        'site_title_font', 
        array(
            'default'           => 'Poppins',
            'sanitize_callback' => 'perfect_portfolio_sanitize_select'
        ) 
    );

	$wp_customize->add_control( 
        new Perfect_Portfolio_Select_Control( 
            $wp_customize, 
            'site_title_font', 
            array(
                'label'       => __( 'Site Title Font', 'perfect-portfolio' ),
                'description' => __( 'Site title and tagline font.', 'perfect-portfolio' ),
                'section'     => 'title_tagline',
                'priority'    => 60,
                'choices'     => perfect_portfolio_get_all_fonts(), 
            ) 
        ) 
    );    
}
endif;
add_action( 'customize_register', 'perfect_portfolio_customize_register' );