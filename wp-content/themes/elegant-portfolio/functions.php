<?php
/**
 * After setup theme hook
 */
function elegant_portfolio_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'elegant-portfolio', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'elegant_portfolio_theme_setup', 100 );

function elegant_portfolio_styles() {
	$my_theme = wp_get_theme();
	$version = $my_theme['Version'];

    if( perfect_portfolio_is_woocommerce_activated() ){
        //dependency call when woocommerce is activated
        $array_style = array( 'perfect-portfolio-woocommerce-style','perfect-portfolio-style' );
    }else{
        $array_style = array( 'perfect-portfolio-style' );
    }
    
    wp_enqueue_style( 'perfect-portfolio-style', get_template_directory_uri()  . '/style.css', array() );
    
    wp_enqueue_style( 'elegant-portfolio', get_stylesheet_directory_uri() . '/style.css', $array_style, $version );
}
add_action( 'wp_enqueue_scripts', 'elegant_portfolio_styles', 10 );

function perfect_portfolio_customize_register_appearance( $wp_customize ) {
    
    /** Appearance Settings */
    $wp_customize->add_panel( 
        'appearance_settings',
         array(
            'priority'    => 50,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Appearance Settings', 'elegant-portfolio' ),
            'description' => __( 'Customize Typography, Header Image & Background Image', 'elegant-portfolio' ),
        ) 
    );
    
    /** Typography */
    $wp_customize->add_section(
        'typography_settings',
        array(
            'title'    => __( 'Typography', 'elegant-portfolio' ),
            'priority' => 10,
            'panel'    => 'appearance_settings',
        )
    );
    
    /** Primary Font */
    $wp_customize->add_setting(
        'elegant_primary_font',
        array(
            'default'           => 'Nunito',
            'sanitize_callback' => 'perfect_portfolio_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Perfect_Portfolio_Select_Control(
            $wp_customize,
            'elegant_primary_font',
            array(
                'label'       => __( 'Primary Font', 'elegant-portfolio' ),
                'description' => __( 'Primary font of the site.', 'elegant-portfolio' ),
                'section'     => 'typography_settings',
                'choices'     => perfect_portfolio_get_all_fonts(), 
            )
        )
    );

    /** Secondary Font */
    $wp_customize->add_setting(
        'secondary_font',
        array(
            'default'           => 'Playfair Display',
            'sanitize_callback' => 'perfect_portfolio_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Perfect_Portfolio_Select_Control(
            $wp_customize,
            'secondary_font',
            array(
                'label'       => __( 'Secondary Font', 'elegant-portfolio' ),
                'description' => __( 'Secondary font of the site.', 'elegant-portfolio' ),
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

function perfect_portfolio_customizer_theme_info( $wp_customize ) {
        
    $wp_customize->add_section( 'theme_info', array(
        'title'       => __( 'Demo & Documentation' , 'elegant-portfolio' ),
        'priority'    => 6,
    ) );
    
    /** Important Links */
    $wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<p>';
    $theme_info .= sprintf( __( 'Demo Link: %1$sClick here.%2$s', 'elegant-portfolio' ),  '<a href="' . esc_url( 'https://rarathemes.com/previews/?theme=elegant-portfolio/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p><p>';
    $theme_info .= sprintf( __( 'Documentation Link: %1$sClick here.%2$s', 'elegant-portfolio' ),  '<a href="' . esc_url( 'https://docs.rarathemes.com/docs/elegant-portfolio/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</p>';

    $wp_customize->add_control( new Perfect_Portfolio_Note_Control( $wp_customize,
        'theme_info_theme', 
            array(
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    ); 
}

function perfect_portfolio_footer_bottom(){ ?>
    <div class="bottom-footer">
        <div class="tc-wrapper">
            <div class="copyright">           
                <?php if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
                } 
                perfect_portfolio_get_footer_copyright();
                esc_html_e( 'Elegant Portfolio | Developed By ', 'elegant-portfolio' );
                echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'elegant-portfolio' ) . '</a>.';
                
                printf( esc_html__( ' Powered by %s', 'elegant-portfolio' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'elegant-portfolio' ) ) .'" target="_blank">WordPress</a>.' );
            ?>               
            </div>
            <div class="foot-social">
                <?php perfect_portfolio_social_links(); ?>
            </div>
        </div>
    </div>
    <?php
}

function perfect_portfolio_get_home_sections(){
    $sections = array( 
        'about'       => array( 'sidebar' => 'about' ),
        'gallery'     => array( 'section' => 'gallery' ),
        'services'    => array( 'sidebar' => 'services' ),
        'cta'         => array( 'sidebar' => 'cta' ),
        'blog'        => array( 'section' => 'blog' ),
        'contact'     => array( 'section' => 'contact' )
    );
    
    $enabled_section = array();
    
    foreach( $sections as $k => $v ){
        if( array_key_exists( 'sidebar', $v ) ){
            if( is_active_sidebar( $v['sidebar'] ) ) array_push( $enabled_section, $v['sidebar'] );
        }else{
            if( get_theme_mod( 'ed_' . $v['section'] . '_section', true ) ) array_push( $enabled_section, $v['section'] );
        }
    }  
    
    return apply_filters( 'perfect_portfolio_home_sections', $enabled_section );
}

function elegant_portfolio_widgets_init(){  
    register_sidebar( array(
        'name'          => __( 'Contact Section', 'elegant-portfolio' ),
        'id'            => esc_attr( 'contact' ),
        'description'   => __( 'Add Text Widget for contact form and "Rara:Contact Widget" for contact details.', 'elegant-portfolio' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title" itemprop="name">',
        'after_title'   => '</h2>',
    ) );
} 
add_action( 'widgets_init', 'elegant_portfolio_widgets_init',20 );

function elegant_portfolio_customize_script(){
    wp_enqueue_script( 'elegant-portfolio-customize', get_stylesheet_directory_uri() . '/js/customize.js', array( 'jquery', 'customize-controls' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'elegant_portfolio_customize_script', 20 );

function elegant_portfolio_get_icontext_image_id(){
    $image_id = false;
    if ( is_active_sidebar( 'about' ) ) {
        $sidebar  = get_option( 'sidebars_widgets' );
        $icontext = get_option( 'widget_rrtc_icon_text_widget' );
        if( array_key_exists( 'about', $sidebar ) ){
            $sidebar_about = $sidebar['about'];
            if( strpos( $sidebar_about[0], 'rrtc_icon_text_widget' ) !== false ){
                $key = substr( $sidebar_about[0], 22 );
                if( array_key_exists( $key, $icontext ) ){
                    $image_id = $icontext[$key]['image'];
                }
            }
        }
    }
    return $image_id;
}


function perfect_portfolio_category(){
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( ' ' );
        if ( $categories_list ) {
            echo '<div class="cat-links" itemprop="about">' . $categories_list . '</div>';
        }
    }
}

/**
 * Single Entry Header
*/
function perfect_portfolio_single_entry_header(){ ?>
    <header class="entry-header">
        <?php 
            $ed_post_date  = get_theme_mod( 'ed_post_date', false );

            if( is_single() ) {
                perfect_portfolio_category();
            }
            
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif; 
        
            if( 'post' === get_post_type() ){
                echo '<div class="entry-meta">';
                if( is_single() ){
                    if( ! $ed_post_date ) perfect_portfolio_posted_on();
                }else{
                    perfect_portfolio_posted_on();
                }
                perfect_portfolio_posted_by();
                echo '</div>';
            }       
        ?>
    </header>         
    <?php    
}
/**
 * Entry Footer
*/
function perfect_portfolio_entry_footer(){ ?>
    <div class="entry-footer">
        <?php
                        
            if( get_edit_post_link() ){
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'elegant-portfolio' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }
            if( is_single() ) {
                perfect_portfolio_tag();
            }
        ?>
    </div><!-- .entry-footer -->
    <?php 
}

function perfect_portfolio_fonts_url(){
    $fonts_url               = '';
    $elegant_primary_font    = get_theme_mod( 'elegant_primary_font', 'Nunito' );
    $ig_elegant_primary_font = perfect_portfolio_is_google_font( $elegant_primary_font );    
    $secondary_font          = get_theme_mod( 'secondary_font', 'Playfair Display' );
    $ig_secondary_font       = perfect_portfolio_is_google_font( $secondary_font );    
    $site_title_font         = get_theme_mod( 'site_title_font', 'Poppins' );
    $ig_site_title_font      = perfect_portfolio_is_google_font( $site_title_font );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'elegant-portfolio' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'elegant-portfolio' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'elegant-portfolio' );
    
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title ) {
        
        $font_families = array();
     
        if ( 'off' !== $primary && $ig_elegant_primary_font ) {
            $primary_variant = perfect_portfolio_check_varient( $elegant_primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $elegant_primary_font . $primary_var;
        }
         
        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = perfect_portfolio_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            $site_title_var = perfect_portfolio_check_varient( $site_title_font, 'regular', true );
            if( $site_title_var ) {
                $site_title_var = ':' . $site_title_var;    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font . $site_title_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
     
    return esc_url( $fonts_url );
}

function elegant_portfolio_dynamic_css(){
    
    $elegant_primary_font  = get_theme_mod( 'elegant_primary_font', 'Nunito' );
    $elegant_primary_fonts = perfect_portfolio_get_fonts( $elegant_primary_font, 'regular' );
    $secondary_font        = get_theme_mod( 'secondary_font', 'Playfair Display' );
    $secondary_fonts       = perfect_portfolio_get_fonts( $secondary_font, 'regular' );
    $site_title_font       = get_theme_mod( 'site_title_font', 'Poppins' );
    $site_title_fonts      = perfect_portfolio_get_fonts( $site_title_font, 'regular' );
    
    echo "<style type='text/css' media='all'>"; ?>
    
    /*Typography*/
    body,
    button,
    input,
    select,
    optgroup,
    textarea{
        font-family : <?php echo wp_kses_post( $elegant_primary_fonts['font'] ); ?>;
    }
    
    section[class*="-section"] .widget-title,
    section[class*="-section"] .widget-title span, .section-title span,
    .related .related-title, 
    .additional-posts .title,
    .top-footer .widget .widget-title{
        font-family : <?php echo wp_kses_post( $secondary_fonts['font'] ); ?>;
    }

    .site-branding .site-title,
    .site-branding .site-description{
        font-family : <?php echo wp_kses_post( $site_title_fonts['font'] ); ?>;
    }
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'elegant_portfolio_dynamic_css', 100 );