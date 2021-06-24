<?php
/**
 * Perfect Portfolio Theme Customizer
 *
 * @package Perfect_Portfolio
 */

/**
 * Requiring customizer panels & sections
*/
$perfect_portfolio_panels = array( 'info', 'site', 'appearance', 'layout', 'general', 'frontpage', 'footer' );

foreach( $perfect_portfolio_panels as $p ){
    require get_template_directory() . '/inc/customizer/' . $p . '.php';
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function perfect_portfolio_customize_preview_js() {
	wp_enqueue_script( 'perfect-portfolio-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), PERFECT_PORTFOLIO_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'perfect_portfolio_customize_preview_js' );

function perfect_portfolio_customize_script(){
    wp_enqueue_style( 'perfect-portfolio-customize', get_template_directory_uri() . '/inc/css/customize-controls.css', array(), false , 'screen' );
    wp_enqueue_script( 'perfect-portfolio-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), PERFECT_PORTFOLIO_THEME_VERSION, true );

    wp_localize_script( 'perfect-portfolio-repeater', 'perfect_portfolio_customize',
        array(
            'nonce' => wp_create_nonce( 'perfect_portfolio_customize_nonce' )
        )
    );
}
add_action( 'customize_controls_enqueue_scripts', 'perfect_portfolio_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

$config_customizer = array(
    'recommended_plugins' => array( 
        'raratheme-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'perfect-portfolio' ), '<strong>RaraTheme Companion</strong>' 
            ),
        ),
    ),
    'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'perfect-portfolio' ),
    'install_button_label'      => esc_html__( 'Install and Activate', 'perfect-portfolio' ),
    'activate_button_label'     => esc_html__( 'Activate', 'perfect-portfolio' ),
    'deactivate_button_label'   => esc_html__( 'Deactivate', 'perfect-portfolio' ),
);
Perfect_Portfolio_Customizer_Notice::init( apply_filters( 'perfect_portfolio_customizer_notice_array', $config_customizer ) );