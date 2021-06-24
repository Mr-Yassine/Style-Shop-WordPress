<?php
/**
 * Perfect Portfolio Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Perfect_Portfolio
 */

function perfect_portfolio_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'perfect-portfolio' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'perfect-portfolio' ),
        ),
        'about'   => array(
            'name'        => __( 'About Section', 'perfect-portfolio' ),
            'id'          => 'about', 
            'description' => __( 'Add "Rara:Icon Text" widget for about section.', 'perfect-portfolio' ),
        ),
        'cta' => array(
            'name'        => __( 'Call To Action Section', 'perfect-portfolio' ),
            'id'          => 'cta', 
            'description' => __( 'Add "Rara:Call To Action" widget for Call to Action section.', 'perfect-portfolio' ),
        ),
        'services' => array(
            'name'        => __( 'Services Section', 'perfect-portfolio' ),
            'id'          => 'services', 
            'description' => __( 'Add "Rara:Icon Text" widget for service section.', 'perfect-portfolio' ),
        ),
        'cta-footer' => array(
            'name'        => __( 'Call To Action Footer', 'perfect-portfolio' ),
            'id'          => 'cta-footer', 
            'description' => __( 'Add "Rara:Call To Action" widget in footer of specific pages.', 'perfect-portfolio' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'perfect-portfolio' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'perfect-portfolio' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'perfect-portfolio' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'perfect-portfolio' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'perfect-portfolio' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'perfect-portfolio' ),
        ),
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
}
add_action( 'widgets_init', 'perfect_portfolio_widgets_init' );