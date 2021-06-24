<?php
/**
 * Perfect Portfolio Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Perfect_Portfolio
 */

if( ! function_exists( 'perfect_portfolio_doctype' ) ) :
/**
 * Doctype Declaration
*/
function perfect_portfolio_doctype(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'perfect_portfolio_doctype', 'perfect_portfolio_doctype' );

if( ! function_exists( 'perfect_portfolio_head' ) ) :
/**
 * Before wp_head 
*/
function perfect_portfolio_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'perfect_portfolio_before_wp_head', 'perfect_portfolio_head' );

if( ! function_exists( 'perfect_portfolio_page_start' ) ) :
/**
 * Page Start
*/
function perfect_portfolio_page_start(){
    ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#main-content-area"><?php esc_html_e( 'Skip to content (Press Enter)', 'perfect-portfolio' ); ?></a>
        
    <?php
}
endif;
add_action( 'perfect_portfolio_before_header', 'perfect_portfolio_page_start', 20 );

if( ! function_exists( 'perfect_portfolio_header' ) ) :
/**
 * Header Start
*/
function perfect_portfolio_header(){ 
       
    $ed_cart = get_theme_mod( 'ed_shopping_cart', false ); 
    $ed_header_search = get_theme_mod( 'ed_header_search', false ); 
    $menu_description = get_theme_mod( 'menu_description', '' );
    $site_title = get_bloginfo( 'name' );
    $description = get_bloginfo( 'description', 'display' );
    $header_text = get_theme_mod( 'header_text', true );
    
    if( has_custom_logo() && ( $site_title || $description ) && $header_text ) {
        $add_class = ' logo-text';
    }else{
        $add_class = '';
    } ?>
    <header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
        <div class="tc-wrapper">
            <?php if( has_custom_logo() || $site_title || $description ) : ?>
                
                <div class="site-branding<?php echo esc_attr( $add_class ); ?>" itemscope itemtype="https://schema.org/Organization">
                    <?php if( has_custom_logo() ) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if( $site_title || $description ) { ?>
                        <div class="site-title-wrap">
                            <?php if( $site_title ) : ?>
                                <?php if ( is_front_page() ) : ?>
                                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                                <?php endif;
                            endif; 
                            if( $description || is_customize_preview() ) : ?>
                                <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                </div><!-- .site-branding -->
            <?php endif; ?>
    		<div class="header-r">
                <?php if( perfect_portfolio_is_woocommerce_activated() && $ed_cart ) perfect_portfolio_wc_cart_count(); ?>
                <?php if( $ed_header_search ) : ?>
    				<div class="header-search">
                        <button type="button" class="search-toggle-btn" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field">
                            <i class="fa fa-search"></i>
                        </button type="button">
                        <div class="head-search-form search header-searh-wrap header-search-modal cover-modal" data-modal-target-string=".header-search-modal">
    				        <?php get_search_form(); ?>
                            <button class="btn-form-close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal">  </button>
                        </div>
    				</div>
                <?php endif; ?>
                <button type="button" class="toggle-btn mobile-menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle"><i class="fa fa-bars"></i></button>	

                <div class="menu-wrap">      
                    <nav id="site-navigation" class="main-navigation">        
                        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'perfect-portfolio' ); ?>">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'primary',
                                        'menu_id'        => 'primary-menu',
                                        'menu_class'     => 'nav-menu main-menu-modal',
                                        'fallback_cb'    => 'perfect_portfolio_primary_menu_fallback',
                                    ) );
                                ?>
                                <ul class="menu-search">
                                    <?php get_search_form(); ?>
                                </ul>
                                <?php if( !empty( $menu_description ) ) : ?>
                                    <ul class="menu-text">
                                        <?php echo wpautop( wp_kses_post( $menu_description ) ); ?>
                                    </ul>
                                <?php endif; ?>
                                <ul class="menu-social">
                                    <?php perfect_portfolio_social_links(); ?>
                                </ul>
                            </div>
                        </div>
                    </nav><!-- #mobile-site-navigation -->
                    <!-- <button type="button" class="toggle-button">
                        <span class="toggle-bar"></span>
                        <span class="toggle-bar"></span>
                        <span class="toggle-bar"></span>
                    </button>  -->        
                </div>
    		</div>
        </div>		
	</header>
    <?php 
}
endif;
add_action( 'perfect_portfolio_header', 'perfect_portfolio_header', 20 );

if( ! function_exists( 'perfect_portfolio_content_start' ) ) :
/**
 * Content Start
*/
function perfect_portfolio_content_start(){ 

    $home_sections = perfect_portfolio_get_home_sections();
    $sidebar = perfect_portfolio_sidebar( true );
    echo '<div id="main-content-area">';
    if( !( is_front_page() && ! is_home() && $home_sections ) ){ ?>
    <div id="content" class="site-content">
        <?php if( ! is_singular() ) : 
            $add_class_name = ( is_home() ) ? 'description' : 'header';
            $add_tag_name = ( is_home() ) ? 'div' : 'header'; ?>
            <<?php echo $add_tag_name; ?> class="page-<?php echo esc_attr( $add_class_name ); ?>">
                <div class="tc-wrapper">                
                <?php        
                    if ( is_home() ) : 
                        echo '<h1 class="page-title">';
                        esc_html_e( 'Blog','perfect-portfolio' );
                        echo '</h1>';
                        $blog_description = get_theme_mod( 'blog_description', '' );
                        if( ! empty( $blog_description ) ) :
                            echo wpautop( wp_kses_post( $blog_description ) );
                        endif;
                    endif;

                    if( is_archive() ) :
                        if( is_author() ){
                            $author_title = get_the_author_meta( 'display_name' );
                            $author_description = get_the_author_meta( 'description' );
                             ?>
                            <div class="about-author">
                                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 230 ); ?></figure>
                                <div class="author-info-wrap">
                                    <?php 
                                        echo '<span class="sub-title">' . esc_html__( 'All Posts by','perfect-portfolio' ) . '</span>';
                                        echo '<h3 class="name">' . esc_html( $author_title ) . '</h3>';
                                        if( $author_description ) echo '<div class="author-info">' . wpautop( wp_kses_post( $author_description ) ) . '</div>';
                                    ?>      
                                </div>
                            </div>
                            <?php 
                        }
                        elseif( is_category() ){
                            echo '<span class="sub-title">'. esc_html__( 'Category','perfect-portfolio' ) . '</span>';
                            echo '<h1 class="page-title"><span>' . esc_html( single_cat_title( '', false ) ) . '</span></h1>';
                            the_archive_description( '<div class="archive-description">', '</div>' );
                        }
                        elseif( is_tag() ){
                            echo '<span class="sub-title">'. esc_html__( 'Tag','perfect-portfolio' ) . '</span>';
                            echo '<h1 class="page-title"><span>' . esc_html( single_tag_title( '', false ) ) . '</span></h1>';
                            the_archive_description( '<div class="archive-description">', '</div>' );

                        }
                        elseif( is_tax( 'rara_portfolio_categories' ) ){
                            echo '<span class="sub-title">'. esc_html__( 'Portfolio Category','perfect-portfolio' ) . '</span>';
                            echo '<h1 class="page-title"><span>' . esc_html( single_term_title( '', false ) ) . '</span></h1>';
                             the_archive_description( '<div class="archive-description">', '</div>' );
                        }
                        else{
                            the_archive_description( '<div class="archive-description">', '</div>' );
                            the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' );
                        }
                    endif;
                    
                    if( is_search() ) : 
                        echo '<h1 class="page-title">' . esc_html__( 'Search Results', 'perfect-portfolio' ) . '</h1>';
                        get_search_form();
                    endif;
                ?>
                </div>
            </<?php echo $add_tag_name; ?>>
        <?php endif; 
    }        
}
endif;
add_action( 'perfect_portfolio_content', 'perfect_portfolio_content_start' );

if( ! function_exists( 'perfect_portfolio_single_entry_header' ) ) :
/**
 * Entry Header
*/
function perfect_portfolio_single_entry_header(){ ?>
    <header class="entry-header">
		<?php 
            $ed_post_date  = get_theme_mod( 'ed_post_date', false );
            
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
endif;
add_action( 'perfect_portfolio_before_single_article', 'perfect_portfolio_single_entry_header' );

if ( ! function_exists( 'perfect_portfolio_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function perfect_portfolio_post_thumbnail() {
	global $wp_query;
    $image_size  = 'thumbnail';
    $blog_page_layout = get_theme_mod( 'blog_page_layout', 'with-masonry-description grid' );
    $ed_featured = get_theme_mod( 'ed_featured_image', false );
    $sidebar     = perfect_portfolio_sidebar();
    
    if( is_front_page() && is_home() ){

        if( $blog_page_layout == 'normal-grid-first-large' && $wp_query->current_post === 0 ) {
            $image_size = 'perfect-portfolio-fullwidth';
        }else{
            $image_size = 'perfect-portfolio-blog';
        }
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" itemprop="thumbnailUrl">';            
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            perfect_portfolio_get_fallback_svg( $image_size );    
        }        
        echo '</a></figure>';
    }elseif( is_home() ){ 

        if( $blog_page_layout == 'normal-grid-first-large' && $wp_query->current_post === 0 ) {
            $image_size = 'perfect-portfolio-fullwidth';
        }else{
            $image_size = 'perfect-portfolio-blog';
        }       
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" itemprop="thumbnailUrl">';
        if( has_post_thumbnail() ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }else{
            perfect_portfolio_get_fallback_svg( $image_size );      
        }        
        echo '</a></figure>';
    }elseif( is_archive() || is_search() ){
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" itemprop="thumbnailUrl">';
        if( has_post_thumbnail() ){
            the_post_thumbnail( 'perfect-portfolio-blog', array( 'itemprop' => 'image' ) );    
        }else{
            perfect_portfolio_get_fallback_svg( $image_size );  
        }
        echo '</a></figure>';
    }elseif( is_singular() ){
        $image_size = ( $sidebar ) ? 'perfect-portfolio-with-sidebar' : 'perfect-portfolio-fullwidth';
        if( is_single() && ( !$ed_featured ) ){
            if( has_post_thumbnail() ) {
                echo '<figure class="post-thumbnail">';
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                echo '</figure>';
            }
        }elseif( is_page() ){
            if( has_post_thumbnail() ) {
                echo '<figure class="post-thumbnail">';
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                echo '</figure>';
            }
        }
    }
}
endif;
add_action( 'perfect_portfolio_before_single_header', 'perfect_portfolio_post_thumbnail' );
add_action( 'perfect_portfolio_before_post_entry_content', 'perfect_portfolio_post_thumbnail', 20 );

if( ! function_exists( 'perfect_portfolio_entry_post_content' ) ) :
/**
 * Entry Content
*/
function perfect_portfolio_entry_post_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true );
    ?>
    <div class="post-content-wrap">
        <header class="entry-header">
            <h2 class="entry-title" itemprop="headline">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="entry-meta">
                <?php perfect_portfolio_posted_on(); ?>
            </div>
        </header>
        <div class="entry-content">
            <?php
            if( $ed_excerpt ) {
                the_excerpt();
            } else{
                the_content();
            }
            ?>
        </div>
    </div>
    <?php
}
endif;
add_action( 'perfect_portfolio_post_entry_content', 'perfect_portfolio_entry_post_content', 10 );

if( ! function_exists( 'perfect_portfolio_single_entry_content' ) ) :
/**
 * Entry Content
*/
function perfect_portfolio_single_entry_content(){ ?>
    <div class="entry-content" itemprop="text">
        <?php perfect_portfolio_tc_wrapper();
        the_content();    
		
        wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'perfect-portfolio' ),
			'after'  => '</div>',
		) );
		perfect_portfolio_tc_wrapper_end(); ?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'perfect_portfolio_single_article', 'perfect_portfolio_single_entry_content', 10 );

if( ! function_exists( 'perfect_portfolio_tc_wrapper' ) ) :
/**
 * Author Section
*/
function perfect_portfolio_tc_wrapper() { 
    $sidebar = perfect_portfolio_sidebar( true );

    if( $sidebar != 'rightsidebar' && $sidebar != 'leftsidebar' ) { 
        echo '<div class="tc-wrapper">';    
    }
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_tc_wrapper', 10 );

if( ! function_exists( 'perfect_portfolio_navigation' ) ) :
/**
 * Navigation
*/
function perfect_portfolio_navigation(){
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Previous Article', 'perfect-portfolio' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Article', 'perfect-portfolio' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	); 
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'perfect-portfolio' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'perfect-portfolio' ),
            'next_text'          => __( 'Next', 'perfect-portfolio' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'perfect-portfolio' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_navigation', 15 );
add_action( 'perfect_portfolio_after_posts_content', 'perfect_portfolio_navigation' );

if( ! function_exists( 'perfect_portfolio_entry_footer' ) ) :
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
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'perfect-portfolio' ),
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
                perfect_portfolio_category();
            }
        ?>
    </div><!-- .entry-footer -->
    <?php 
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_entry_footer', 13 );

if( ! function_exists( 'perfect_portfolio_author' ) ) :
/**
 * Author Section
*/
function perfect_portfolio_author(){ 
    $ed_author    = get_theme_mod( 'ed_author', false );
    $author_title = get_the_author_meta( 'display_name' );
    $author_description = get_the_author_meta( 'description' );

    if( ! $ed_author && $author_title && $author_description ){ ?>
        <div class="about-author">
    		<figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 230 ); ?></figure>
    		<div class="author-info-wrap">
    			<?php 
                    if( is_author() ) echo '<span class="sub-title">' . esc_html__( 'All Posts by','perfect-portfolio' ) . '</span>';
                    echo '<h3 class="name">' . esc_html( $author_title ) . '</h3>';
                    echo '<div class="author-info">' . wpautop( wp_kses_post( $author_description ) ) . '</div>';
                ?>		
    		</div>
        </div>
    <?php }
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_author', 20 );

if( ! function_exists( 'perfect_portfolio_related_posts' ) ) :
/**
 * Related Posts 
*/
function perfect_portfolio_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', false );
    if( $ed_related_post ){
        perfect_portfolio_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_related_posts', 35 );

if( ! function_exists( 'perfect_portfolio_popular_posts' ) ) :
/**
 * Popular Posts
*/
function perfect_portfolio_popular_posts(){ 
    $ed_popular_post = get_theme_mod( 'ed_popular', false );
    if( $ed_popular_post ){
        perfect_portfolio_get_posts_list( 'popular' );  
    }
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_popular_posts', 30 );

if( ! function_exists( 'perfect_portfolio_latest_posts' ) ) :
/**
 * Latest Posts
*/
function perfect_portfolio_latest_posts(){ 
    perfect_portfolio_get_posts_list( 'latest' );
}
endif;
add_action( 'perfect_portfolio_latest_posts', 'perfect_portfolio_latest_posts' );

if( ! function_exists( 'perfect_portfolio_tc_wrapper_end' ) ) :
/**
 * Comments Template 
*/
function perfect_portfolio_tc_wrapper_end(){
    $sidebar = perfect_portfolio_sidebar( true );

    if( $sidebar != 'rightsidebar' && $sidebar != 'leftsidebar' ) { 
        echo '</div>';    
    }
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_tc_wrapper_end', 40 );

if( ! function_exists( 'perfect_portfolio_comment' ) ) :
/**
 * Comments Template 
*/
function perfect_portfolio_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
endif;
add_action( 'perfect_portfolio_after_post_content', 'perfect_portfolio_comment', 45 );
add_action( 'perfect_portfolio_after_page_content', 'perfect_portfolio_comment' );

if( ! function_exists( 'perfect_portfolio_content_end' ) ) :
/**
 * Content End
*/
function perfect_portfolio_content_end(){ 
    $home_sections = perfect_portfolio_get_home_sections();
    
    if( !( is_front_page() && ! is_home() && $home_sections ) ){ ?>       
    </div><!-- .site-content -->
    <?php
    }
}
endif;
add_action( 'perfect_portfolio_before_footer', 'perfect_portfolio_content_end', 20 );

if( ! function_exists( 'perfect_portfolio_single_portfolio_thumbnail' ) ) :
/**
 * Portfolio gallery
*/
function perfect_portfolio_single_portfolio_thumbnail(){ 
    
    if( is_singular( 'rara-portfolio' ) ){
        if( has_post_thumbnail() ) {
            echo '<figure class="post-thumbnail">';
            the_post_thumbnail( 'perfect-portfolio-fullwidth', array( 'itemprop' => 'image' ) );
            echo '</figure>';
        }
    }
}
endif;                                                                               
add_action( 'perfect_portfolio_before_single_portfolio_content', 'perfect_portfolio_single_portfolio_thumbnail' );

if( ! function_exists( 'perfect_portfolio_single_portfolio_content' ) ) :
/**
 * Portfolio content 
*/
function perfect_portfolio_single_portfolio_content(){ 
    global $post; ?>
    <div class="content-wrap-box">
        <header class="page-header">
            <?php $category_ids = get_the_terms( $post, 'rara_portfolio_categories');
            if( ! empty( $category_ids ) ) { ?>
            <span class="sub-title">
                <?php foreach( $category_ids as $category_id ){
                    echo '<a href="' . get_term_link($category_id->slug, 'rara_portfolio_categories' ) . '">';
                    echo '<span>' . esc_html( $category_id->name ) . '</span>'; 
                    echo '</a>';
                } ?>
            </span>
            <?php } ?>
            <h1 class="page-title"><span><?php the_title();?></span></h1>
        </header>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    </div>    
<?php }
endif;                                                                               
add_action( 'perfect_portfolio_single_portfolio_content', 'perfect_portfolio_single_portfolio_content' );

if( ! function_exists( 'perfect_portfolio_single_portfolio_related_posts' ) ) :
/**
 * Related Posts 
*/
function perfect_portfolio_single_portfolio_related_posts(){ 
    perfect_portfolio_get_posts_list( 'portfolio-related' );    
}
endif;                                                                               
add_action( 'perfect_portfolio_after_portfolio_content', 'perfect_portfolio_single_portfolio_related_posts', 10 );

if( ! function_exists( 'perfect_portfolio_call_to_action' ) ) :
/**
 * Content End
*/
function perfect_portfolio_call_to_action(){ 

    if( is_singular( 'rara-portfolio' ) ) {    
        if ( is_active_sidebar( 'cta-footer' ) ) { ?>
            <section id="cta_section" class="cta-section">
                <div class="v-center-inner">
                    <div class="tc-wrapper">
                        <?php dynamic_sidebar( 'cta-footer' ); ?>
                    </div>
                </div>
            </section> <!-- .cta-section -->
    <?php }
    }
}
endif;
add_action( 'perfect_portfolio_before_footer', 'perfect_portfolio_call_to_action', 25 );

if( ! function_exists( 'perfect_portfolio_footer_start' ) ) :
/**
 * Footer Start
*/
function perfect_portfolio_footer_start(){
    ?>
</div><!-- #main-content-area -->
    <div class="overlay"></div>
    <footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'perfect_portfolio_footer', 'perfect_portfolio_footer_start', 20 );

if( ! function_exists( 'perfect_portfolio_footer_top' ) ) :
/**
 * Footer Top
*/
function perfect_portfolio_footer_top(){    
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){ ?>
    <div class="top-footer">
		<div class="tc-wrapper">
            <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
				<div class="col">
				   <?php dynamic_sidebar( 'footer-one' ); ?>	
				</div>
            <?php } ?>
			
            <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                <div class="col">
				   <?php dynamic_sidebar( 'footer-two' ); ?>	
				</div>
            <?php } ?>
            
            <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                <div class="col">
				   <?php dynamic_sidebar( 'footer-three' ); ?>	
				</div>
            <?php } ?>
		</div>
	</div>
    <?php 
    }   
}
endif;
add_action( 'perfect_portfolio_footer', 'perfect_portfolio_footer_top', 30 );

if( ! function_exists( 'perfect_portfolio_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function perfect_portfolio_footer_bottom(){ ?>
    <div class="bottom-footer">
		<div class="tc-wrapper">
            <div class="copyright">           
                <?php if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
                } 
                perfect_portfolio_get_footer_copyright();
                esc_html_e( 'Perfect Portfolio | Developed By ', 'perfect-portfolio' );
                echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'perfect-portfolio' ) . '</a>.';
                
                printf( esc_html__( ' Powered by %s', 'perfect-portfolio' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'perfect-portfolio' ) ) .'" target="_blank">WordPress</a>.' );
            ?>               
            </div>
            <div class="foot-social">
                <?php perfect_portfolio_social_links(); ?>
            </div>
		</div>
	</div>
    <?php
}
endif;
add_action( 'perfect_portfolio_footer', 'perfect_portfolio_footer_bottom', 40 );

if( ! function_exists( 'perfect_portfolio_back_to_top' ) ) :
/**
 * Footer End 
*/
function perfect_portfolio_back_to_top(){ ?>
    <button class="back-to-top">
        <i class="fa fa-long-arrow-up"></i>
    </button>
    <?php
}
endif;
add_action( 'perfect_portfolio_footer', 'perfect_portfolio_back_to_top', 50 );

if( ! function_exists( 'perfect_portfolio_footer_end' ) ) :
/**
 * Footer End 
*/
function perfect_portfolio_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'perfect_portfolio_footer', 'perfect_portfolio_footer_end', 60 );

if( ! function_exists( 'perfect_portfolio_page_end' ) ) :
/**
 * Page End
*/
function perfect_portfolio_page_end(){ ?>
        </div><!-- #page -->

    <?php
}
endif;
add_action( 'perfect_portfolio_after_footer', 'perfect_portfolio_page_end', 20 );
