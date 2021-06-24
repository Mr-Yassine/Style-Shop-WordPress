<?php
/**
 * Perfect Portfolio Front Page Settings
 *
 * @package Perfect_Portfolio
 */
if ( ! function_exists( 'perfect_portfolio_customize_register_frontpage' ) ) :

function perfect_portfolio_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'perfect-portfolio' ),
            'description' => __( 'Customize About, Gallery, Services, Call To Action, Latest Posts, settings.', 'perfect-portfolio' ),
        ) 
    );

    /** Gallery Section */
    $wp_customize->add_section(
        'gallery_section',
        array(
            'title'    => __( 'Portfolio Section', 'perfect-portfolio' ),
            'priority' => 25,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Gallery Options */
    $wp_customize->add_setting(
        'ed_gallery_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Perfect_Portfolio_Toggle_Control(
            $wp_customize,
            'ed_gallery_section',
            array(
                'label'       => __( 'Enable Portfolio Section', 'perfect-portfolio' ),
                'description' => __( 'Enable to show Portfolio section.', 'perfect-portfolio' ),
                'section'     => 'gallery_section',
            )            
        )
    );
    
    /** Number of portfolio Excerpt */
    $wp_customize->add_setting( 
        'no_of_portfolio', 
        array(
            'default'           => 9,
            'sanitize_callback' => 'perfect_portfolio_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
        new Perfect_Portfolio_Slider_Control( 
            $wp_customize,
            'no_of_portfolio',
            array(
                'section'     => 'gallery_section',
                'label'       => __( 'Number Of Portfolio', 'perfect-portfolio' ),
                'description' => __( 'Set number of latest portfolios to show in portfolio section.', 'perfect-portfolio' ),
                'choices'     => array(
                    'min'           => 6,
                    'max'           => 12,
                    'step'          => 3,
                ),  
            )
        )
    );
    /** Portfolio Settings Ends */
  
    /** View All Label */
    $wp_customize->add_setting(
        'gallery_view_all',
        array(
            'default'           => __( 'View More', 'perfect-portfolio' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'gallery_view_all',
        array(
            'label'           => __( 'View More Label', 'perfect-portfolio' ),
            'section'         => 'gallery_section',
            'type'            => 'text',
            'active_callback' => 'perfect_portfolio_gallery_view_all_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'gallery_view_all', array(
        'selector' => '.gallery-section .tc-wrapper .btn-readmore',
        'render_callback' => 'perfect_portfolio_get_gallery_view_all_btn',
    ) ); 

    /** View All Url */
    $wp_customize->add_setting(
        'gallery_view_all_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'gallery_view_all_url',
        array(
            'label'           => __( 'View More Label Url', 'perfect-portfolio' ),
            'section'         => 'gallery_section',
            'type'            => 'url',
            'active_callback' => 'perfect_portfolio_gallery_view_all_ac'
        )
    );
    /** Gallery Section Ends */    
     
    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'perfect-portfolio' ),
            'priority' => 77,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Blog Options */
    $wp_customize->add_setting(
        'ed_blog_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'perfect_portfolio_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Perfect_Portfolio_Toggle_Control(
            $wp_customize,
            'ed_blog_section',
            array(
                'label'       => __( 'Enable Blog Section', 'perfect-portfolio' ),
                'description' => __( 'Enable to show blog section.', 'perfect-portfolio' ),
                'section'     => 'blog_section',
            )            
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Articles', 'perfect-portfolio' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section' => 'blog_section',
            'label'   => __( 'Blog Title', 'perfect-portfolio' ),
            'type'    => 'text',
            'priority' => 60,
        )
    );

    // Selective refresh for blog title.
    $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector'            => '.article-section .tc-wrapper h2.section-title',
        'render_callback'     => 'perfect_portfolio_blog_section_title_selective_refresh',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );
    
    /** View All Label */
    $wp_customize->add_setting(
        'blog_view_all',
        array(
            'default'           => __( 'View All', 'perfect-portfolio' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_view_all',
        array(
            'label'           => __( 'View All Label', 'perfect-portfolio' ),
            'section'         => 'blog_section',
            'type'            => 'text',
            'active_callback' => 'perfect_portfolio_blog_view_all_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'blog_view_all', array(
        'selector' => '.article-section .tc-wrapper .btn-readmore',
        'render_callback' => 'perfect_portfolio_get_blog_view_all_btn',
    ) ); 
    /** Blog Section Ends **/
        
}
endif;
add_action( 'customize_register', 'perfect_portfolio_customize_register_frontpage' );