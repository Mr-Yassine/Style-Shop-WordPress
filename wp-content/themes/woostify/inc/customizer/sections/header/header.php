<?php
/**
 * Header
 *
 * @package woostify
 */

// Default values.
$defaults = woostify_options();

// Header layout.
$wp_customize->add_setting(
	'woostify_setting[header_layout]',
	array(
		'default'           => $defaults['header_layout'],
		'sanitize_callback' => 'woostify_sanitize_choices',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Woostify_Radio_Image_Control(
		$wp_customize,
		'woostify_setting[header_layout]',
		array(
			'label'    => __( 'Header Layout', 'woostify' ),
			'section'  => 'woostify_header',
			'settings' => 'woostify_setting[header_layout]',
			'choices'  => apply_filters(
				'woostify_setting_header_layout_choices',
				array(
					'layout-1' => WOOSTIFY_THEME_URI . 'assets/images/customizer/header/woostify-header-1.jpg',
				)
			),
		)
	)
);

// Background color.
$wp_customize->add_setting(
	'woostify_setting[header_background_color]',
	array(
		'default'           => $defaults['header_background_color'],
		'sanitize_callback' => 'woostify_sanitize_rgba_color',
		'type'              => 'option',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Woostify_Color_Control(
		$wp_customize,
		'woostify_setting[header_background_color]',
		array(
			'priority' => 30,
			'label'    => __( 'Header Background', 'woostify' ),
			'section'  => 'woostify_header',
			'settings' => 'woostify_setting[header_background_color]',
		)
	)
);

// After background color divider.
$wp_customize->add_setting(
	'header_after_background_color_divider',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Woostify_Divider_Control(
		$wp_customize,
		'header_after_background_color_divider',
		array(
			'priority' => 40,
			'section'  => 'woostify_header',
			'settings' => 'header_after_background_color_divider',
			'type'     => 'divider',
		)
	)
);

// Header element title.
$wp_customize->add_setting(
	'header_element_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Woostify_Divider_Control(
		$wp_customize,
		'header_element_title',
		array(
			'priority' => 50,
			'section'  => 'woostify_header',
			'settings' => 'header_element_title',
			'type'     => 'heading',
			'label'    => __( 'Elements', 'woostify' ),
		)
	)
);

// HEADER ELEMENT.
// Header menu.
$wp_customize->add_setting(
	'woostify_setting[header_primary_menu]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_primary_menu'],
		'sanitize_callback' => 'woostify_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Woostify_Switch_Control(
		$wp_customize,
		'woostify_setting[header_primary_menu]',
		array(
			'priority' => 70,
			'label'    => __( 'Header Menu', 'woostify' ),
			'section'  => 'woostify_header',
			'settings' => 'woostify_setting[header_primary_menu]',
		)
	)
);

// Menu Breakpoint.
$wp_customize->add_setting(
	'woostify_setting[header_menu_breakpoint]',
	array(
		'default'           => $defaults['header_menu_breakpoint'],
		'sanitize_callback' => 'absint',
		'type'              => 'option',
	)
);
$wp_customize->add_control(
	new Woostify_Range_Slider_Control(
		$wp_customize,
		'woostify_setting[header_menu_breakpoint]',
		array(
			'priority' => 46,
			'label'    => __( 'Menu Breakpoint', 'woostify' ),
			'section'  => 'woostify_header',
			'settings' => array(
				'desktop' => 'woostify_setting[header_menu_breakpoint]',
			),
			'choices'  => array(
				'desktop' => array(
					'min'  => apply_filters( 'woostify_header_menu_breakpoint_min_step', 0 ),
					'max'  => apply_filters( 'woostify_header_menu_breakpoint_max_step', 6000 ),
					'step' => 1,
					'edit' => true,
					'unit' => 'px',
				),
			),
		)
	)
);

// Search icon.
$wp_customize->add_setting(
	'woostify_setting[header_search_icon]',
	array(
		'type'              => 'option',
		'default'           => $defaults['header_search_icon'],
		'sanitize_callback' => 'woostify_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Woostify_Switch_Control(
		$wp_customize,
		'woostify_setting[header_search_icon]',
		array(
			'priority' => 90,
			'label'    => __( 'Search', 'woostify' ),
			'section'  => 'woostify_header',
			'settings' => 'woostify_setting[header_search_icon]',
		)
	)
);

// Woocommerce.
if ( class_exists( 'woocommerce' ) ) {
	// Search product only.
	$wp_customize->add_setting(
		'woostify_setting[header_search_only_product]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_search_only_product'],
			'sanitize_callback' => 'woostify_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Woostify_Switch_Control(
			$wp_customize,
			'woostify_setting[header_search_only_product]',
			array(
				'priority' => 110,
				'label'    => __( 'Search Only Product', 'woostify' ),
				'section'  => 'woostify_header',
				'settings' => 'woostify_setting[header_search_only_product]',
			)
		)
	);

	// Wishlist icon.
	if ( woostify_support_wishlist_plugin() ) {
		$wp_customize->add_setting(
			'woostify_setting[header_wishlist_icon]',
			array(
				'type'              => 'option',
				'default'           => $defaults['header_wishlist_icon'],
				'sanitize_callback' => 'woostify_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			new Woostify_Switch_Control(
				$wp_customize,
				'woostify_setting[header_wishlist_icon]',
				array(
					'priority' => 130,
					'label'    => __( 'Wishlist Icon', 'woostify' ),
					'section'  => 'woostify_header',
					'settings' => 'woostify_setting[header_wishlist_icon]',
				)
			)
		);
	}

	// Account icon.
	$wp_customize->add_setting(
		'woostify_setting[header_account_icon]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_account_icon'],
			'sanitize_callback' => 'woostify_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Woostify_Switch_Control(
			$wp_customize,
			'woostify_setting[header_account_icon]',
			array(
				'priority' => 150,
				'label'    => __( 'Account/Dashboard', 'woostify' ),
				'section'  => 'woostify_header',
				'settings' => 'woostify_setting[header_account_icon]',
			)
		)
	);

	// Shopping bag icon.
	$wp_customize->add_setting(
		'woostify_setting[header_shop_cart_icon]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_shop_cart_icon'],
			'sanitize_callback' => 'woostify_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Woostify_Switch_Control(
			$wp_customize,
			'woostify_setting[header_shop_cart_icon]',
			array(
				'priority' => 170,
				'label'    => __( 'Shopping Cart Icon', 'woostify' ),
				'section'  => 'woostify_header',
				'settings' => 'woostify_setting[header_shop_cart_icon]',
			)
		)
	);

	// Show subtotal.
	$wp_customize->add_setting(
		'woostify_setting[header_shop_cart_price]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_shop_cart_price'],
			'sanitize_callback' => 'woostify_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Woostify_Switch_Control(
			$wp_customize,
			'woostify_setting[header_shop_cart_price]',
			array(
				'priority' => 190,
				'label'    => __( 'Show Subtotal', 'woostify' ),
				'section'  => 'woostify_header',
				'settings' => 'woostify_setting[header_shop_cart_price]',
			)
		)
	);

	// Hide zero value cart count.
	$wp_customize->add_setting(
		'woostify_setting[header_shop_hide_zero_value_cart_count]',
		array(
			'type'              => 'option',
			'default'           => $defaults['header_shop_hide_zero_value_cart_count'],
			'sanitize_callback' => 'woostify_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Woostify_Switch_Control(
			$wp_customize,
			'woostify_setting[header_shop_hide_zero_value_cart_count]',
			array(
				'priority' => 170,
				'label'    => __( 'Hide Zero Value', 'woostify' ),
				'section'  => 'woostify_header',
				'settings' => 'woostify_setting[header_shop_hide_zero_value_cart_count]',
			)
		)
	);
}
