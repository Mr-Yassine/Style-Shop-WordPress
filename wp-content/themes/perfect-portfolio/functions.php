<?php
/**
 * Perfect Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Perfect_Portfolio
 */

$perfect_portfolio_theme_data = wp_get_theme();
if( ! defined( 'PERFECT_PORTFOLIO_THEME_VERSION' ) ) define( 'PERFECT_PORTFOLIO_THEME_VERSION', $perfect_portfolio_theme_data->get( 'Version' ) );
if( ! defined( 'PERFECT_PORTFOLIO_THEME_NAME' ) ) define( 'PERFECT_PORTFOLIO_THEME_NAME', $perfect_portfolio_theme_data->get( 'Name' ) );
if( ! defined( 'PERFECT_PORTFOLIO_THEME_TEXTDOMAIN' ) ) define( 'PERFECT_PORTFOLIO_THEME_TEXTDOMAIN', $perfect_portfolio_theme_data->get( 'TextDomain' ) );

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Fontawesome
 */
require get_template_directory() . '/inc/fontawesome.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography.php';

/**
 * Raratheme companion Functions
 */
if( perfect_portfolio_is_rtc_activated() ) {
	require get_template_directory() . '/inc/rtc-filters.php';
}
/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( perfect_portfolio_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}