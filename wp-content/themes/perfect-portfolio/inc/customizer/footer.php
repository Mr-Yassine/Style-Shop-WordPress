<?php
/**
 * Perfect Portfolio Footer Setting
 *
 * @package Perfect_Portfolio
 */
if ( ! function_exists( 'perfect_portfolio_customize_register_footer' ) ) :

function perfect_portfolio_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'perfect-portfolio' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'         => __( 'Footer Copyright Text', 'perfect-portfolio' ),
            'description'   => esc_html__( 'Add Copyright Text Here.', 'perfect-portfolio' ),
            'section'       => 'footer_settings',
            'type'          => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.bottom-footer .tc-wrapper .copyright .copyright-text',
        'render_callback' => 'perfect_portfolio_get_footer_copyright',
    ) );
        
}
endif;
add_action( 'customize_register', 'perfect_portfolio_customize_register_footer' );