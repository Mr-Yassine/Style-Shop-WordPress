<?php
/**
 * Perfect Portfolio Appearance Settings
 *
 * @package Perfect_Portfolio
 */
if ( ! function_exists( 'perfect_portfolio_customize_register_appearance' ) ) :

function perfect_portfolio_customize_register_appearance( $wp_customize ) {
    
    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'perfect-portfolio' ),
            'description' => __( 'Customize Typography, Header Image & Background Image', 'perfect-portfolio' ),
        ) 
    );
    
    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'perfect-portfolio' ),
            'priority' => 10,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Poppins',
			'sanitize_callback' => 'perfect_portfolio_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Perfect_Portfolio_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'perfect-portfolio' ),
                'description' => __( 'Primary font of the site.', 'perfect-portfolio' ),
    			'section'     => 'typography_settings',
    			'choices'     => perfect_portfolio_get_all_fonts(),	
     		)
		)
	);
    
    /** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 30;
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 35;
}
endif;
add_action( 'customize_register', 'perfect_portfolio_customize_register_appearance' );