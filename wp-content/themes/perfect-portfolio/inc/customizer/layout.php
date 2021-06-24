<?php
/**
 * Perfect Portfolio Layout Settings
 *
 * @package Perfect_Portfolio
 */
if ( ! function_exists( 'perfect_portfolio_customize_register_layout' ) ) :

function perfect_portfolio_customize_register_layout( $wp_customize ) {
	
    /** Layout Settings */
    $wp_customize->add_panel(
        'layout_settings',
        array(
            'title'    => __( 'Layout Settings', 'perfect-portfolio' ),
            'priority' => 55,
        )
    );
    
    /** Blog Layout */
    $wp_customize->add_section(
        'blog_layout',
        array(
            'title'    => __( 'Blog Layout', 'perfect-portfolio' ),
            'panel'    => 'layout_settings',
            'priority' => 10,
        )
    );
    
    /** Blog Page layout */
    $wp_customize->add_setting( 
        'blog_page_layout', 
        array(
            'default'           => 'with-masonry-description grid',
            'sanitize_callback' => 'perfect_portfolio_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Radio_Image_Control(
			$wp_customize,
			'blog_page_layout',
			array(
				'section'	  => 'blog_layout',
				'label'		  => __( 'Blog Page Layout', 'perfect-portfolio' ),
				'description' => __( 'This is the layout for blog index page.', 'perfect-portfolio' ),
				'choices'	  => array(
                    'with-masonry-description grid' => get_template_directory_uri() . '/images/masonry.jpg',
                    'normal-grid-description'    => get_template_directory_uri() . '/images/normal.jpg',
                    'normal-grid-first-large' => get_template_directory_uri() . '/images/first-large.jpg',
				)
			)
		)
	);
    
    /** General Sidebar Layout */
    $wp_customize->add_section(
        'general_layout',
        array(
            'title'    => __( 'General Sidebar Layout', 'perfect-portfolio' ),
            'panel'    => 'layout_settings',
            'priority' => 20,
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'perfect_portfolio_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Page Sidebar Layout', 'perfect-portfolio' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in repective page.', 'perfect-portfolio' ),
				'choices'	  => array(
					'no-sidebar'       => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'         => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'     => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar'    => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'perfect_portfolio_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Perfect_Portfolio_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Post Sidebar Layout', 'perfect-portfolio' ),
				'description' => __( 'This is the general sidebar layout for posts. You can override the sidebar layout for individual post in repective post.', 'perfect-portfolio' ),
				'choices'	  => array(
					'no-sidebar'       => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'         => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'     => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar'    => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);    
}
endif;
add_action( 'customize_register', 'perfect_portfolio_customize_register_layout' );