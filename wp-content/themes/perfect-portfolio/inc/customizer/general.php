<?php
/**
 * Perfect Portfolio General Settings
 *
 * @package Perfect_Portfolio
 */
if ( ! function_exists( 'perfect_portfolio_customize_register_general' ) ) :

function perfect_portfolio_customize_register_general( $wp_customize ) {
	
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 85,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'perfect-portfolio' ),
        ) 
    );
    
    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'perfect-portfolio' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Cart */
    $wp_customize->add_setting( 
        'ed_shopping_cart', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Perfect_Portfolio_Toggle_Control( 
            $wp_customize,
            'ed_shopping_cart',
            array(
                'section'     => 'header_settings',
                'label'       => __( 'Enable Cart', 'perfect-portfolio' ),
                'description' => __( 'Enable to show cart in header.', 'perfect-portfolio' ),
                'active_callback' => 'perfect_portfolio_is_woocommerce_activated',
            )
        )
    );

    /** Enable Header Search */
    $wp_customize->add_setting( 
        'ed_header_search', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_header_search',
			array(
				'section'     => 'header_settings',
				'label'	      => __( 'Enable Header Search', 'perfect-portfolio' ),
                'description' => __( 'Enable to show Search button in header.', 'perfect-portfolio' ),
			)
		)
	);

    /** Menu Description */
    $wp_customize->add_setting( 
        'menu_description', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field'
        ) 
    );
    
    $wp_customize->add_control(
        'menu_description',
        array(
            'section'     => 'header_settings',
            'label'       => __( 'Menu Description', 'perfect-portfolio' ),
            'description' => __( 'Add short description on menu.', 'perfect-portfolio' ),
            'type'        => 'textarea'
        )
    );
    
    /** Header Settings Ends */
    
    /** Social Media Settings */
    $wp_customize->add_section(
        'social_media_settings',
        array(
            'title'    => __( 'Social Media Settings', 'perfect-portfolio' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'     => 'social_media_settings',
				'label'	      => __( 'Enable Social Links', 'perfect-portfolio' ),
                'description' => __( 'Enable to show social links at header.', 'perfect-portfolio' ),
			)
		)
	);
    
    $wp_customize->add_setting( 
        new Perfect_Portfolio_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Perfect_Portfolio_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_media_settings',				
				'label'	  => __( 'Social Links', 'perfect-portfolio' ),
				'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'perfect-portfolio' ),
                        'description' => __( 'Example: fa-bell', 'perfect-portfolio' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'perfect-portfolio' ),
                        'description' => __( 'Example: http://facebook.com', 'perfect-portfolio' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'perfect-portfolio' ),
                    'field' => 'link'
                )                        
			)
		)
	);
    /** Social Media Settings Ends */
    
    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => __( 'SEO Settings', 'perfect-portfolio' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_post_update_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_post_update_date',
			array(
				'section'     => 'seo_settings',
				'label'	      => __( 'Enable Last Update Post Date', 'perfect-portfolio' ),
                'description' => __( 'Enable to show last updated post date on listing as well as in single post.', 'perfect-portfolio' ),
			)
		)
	);
    
    /** SEO Settings Ends */
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'perfect-portfolio' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'perfect-portfolio' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'perfect-portfolio' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 55,
            'sanitize_callback' => 'perfect_portfolio_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'perfect-portfolio' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'perfect-portfolio' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				)                 
			)
		)
	);
    /** Read More Text */
    $wp_customize->add_setting(
        'blog_description',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );
    
    $wp_customize->add_control(
        'blog_description',
        array(
            'type'    => 'textarea',
            'section' => 'post_page_settings',
            'label'   => __( 'Blog Desciption', 'perfect-portfolio' ),
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Perfect_Portfolio_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
				'description' => __( '<hr/>These options affect your individual posts.', 'perfect-portfolio' ),
			)
		)
    );
    
    /** Hide Author */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author', 'perfect-portfolio' ),
                'description' => __( 'Enable to hide author section.', 'perfect-portfolio' ),
			)
		)
	);
        
    /** Show Popular Posts */
    $wp_customize->add_setting( 
        'ed_popular', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_popular',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Popular Posts', 'perfect-portfolio' ),
                'description' => __( 'Enable to show popular posts in single page.', 'perfect-portfolio' ),
			)
		)
	);
    
    /** Popular Posts section title */
    $wp_customize->add_setting(
        'popular_post_title',
        array(
            'default'           => __( 'Popular Posts', 'perfect-portfolio' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'popular_post_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Popular Posts Section Title', 'perfect-portfolio' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'popular_post_title', array(
        'selector' => '.popular-posts .title',
        'render_callback' => 'perfect_portfolio_get_popular_title',
    ) );
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Perfect_Portfolio_Toggle_Control( 
            $wp_customize,
            'ed_related',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Show Related Posts', 'perfect-portfolio' ),
                'description' => __( 'Enable to show related posts in single page.', 'perfect-portfolio' ),
            )
        )
    );
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'You may also like...', 'perfect-portfolio' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Related Posts Section Title', 'perfect-portfolio' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.related-posts .title',
        'render_callback' => 'perfect_portfolio_get_related_title',
    ) );
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'perfect-portfolio' ),
                'description' => __( 'Enable to hide posted date.', 'perfect-portfolio' ),
			)
		)
	);
    
    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => false,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Featured Image', 'perfect-portfolio' ),
                'description' => __( 'Enable to hide featured image in post detail (single post page).', 'perfect-portfolio' ),
			)
		)
	);
}
endif;
add_action( 'customize_register', 'perfect_portfolio_customize_register_general' );