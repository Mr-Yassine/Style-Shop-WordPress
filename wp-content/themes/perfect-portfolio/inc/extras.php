<?php
/**
 * Perfect Portfolio Standalone Functions.
 *
 * @package Perfect_Portfolio
 */

if ( ! function_exists( 'perfect_portfolio_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function perfect_portfolio_posted_on() {
	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', false );
    $on = __( 'on ', 'perfect-portfolio' );
    
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time></time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
            $on = __( 'updated on ', 'perfect-portfolio' );		  
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    
    $posted_on = sprintf( '%1$s %2$s', esc_html( $on ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
	
	echo '<span class="posted-on" itemprop="datePublished dateModified">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'perfect_portfolio_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function perfect_portfolio_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'By %s', 'post author', 'perfect-portfolio' ),
		'<a class="url fn" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url">' . esc_html( get_the_author() ) . '</a>' 
    );
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"><span class="author" itemprop="name">' . $byline . '</span></span>';
}
endif;

if( ! function_exists( 'perfect_portfolio_comment_count' ) ) :
/**
 * Comment Count
*/
function perfect_portfolio_comment_count(){
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments"><i class="fa fa-comment-o"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'perfect-portfolio' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}    
}
endif;

if ( ! function_exists( 'perfect_portfolio_category' ) ) :
/**
 * Prints categories
 */
function perfect_portfolio_category(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'perfect-portfolio' ) );
		if ( $categories_list ) {
			echo '<div class="cat-links" itemprop="about">' . $categories_list . '</div>';
		}
	}
}
endif;

if ( ! function_exists( 'perfect_portfolio_tag' ) ) :
/**
 * Prints tags
 */
function perfect_portfolio_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			echo '<div class="tags" itemprop="about"><b>' . esc_html__('Tags :','perfect-portfolio') .'</b>'. $tags_list . '</div>';
		}
	}
}
endif;

if( ! function_exists( 'perfect_portfolio_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function perfect_portfolio_get_posts_list( $status ){
    global $post;

    $post_type = ( $status == 'portfolio-related' ) ? 'rara-portfolio' : 'post';
    
    $args = array(
        'post_type'           => $post_type,
        'posts_status'        => 'publish',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 6;
        $title                  = __( 'Recent Posts', 'perfect-portfolio' );
        $class                  = 'recent-posts';
        $image_size             = 'perfect-portfolio-article';
        break;
        
        case 'related':
        $args['posts_per_page'] = 6;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'You may also like...', 'perfect-portfolio' ) );
        $class                  = 'related-posts';
        $image_size             = 'perfect-portfolio-article';

        $category_ids           = get_the_category( $post->ID );
        foreach( $category_ids as $category_id ){
            $cat_id[] = $category_id->term_id; 
        }
        $args['category__in']  = $cat_id; 
        break;       
        
        case 'popular':
        $args['posts_per_page'] = 6;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'comment_count';
        $title                  = get_theme_mod( 'popular_post_title', __( 'Popular Posts', 'perfect-portfolio' ) );
        $class                  = 'popular-posts';
        $image_size             = 'perfect-portfolio-article';
        break;

        case 'portfolio-related':
        $args['posts_per_page'] = 3;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = __( 'Related Projects', 'perfect-portfolio' );
        $class                  = 'portfolio-related';
        $image_size             = 'perfect-portfolio-article';
        $category_ids           = get_the_terms( $post->ID, 'rara_portfolio_categories' );
        if( ! empty( $category_ids ) ) {
            foreach( $category_ids as $category_id ){
                $cat_id[] = $category_id->term_id; 
            }
            $args['tax_query']  = array( 
                array( 
                    'taxonomy'  => 'rara_portfolio_categories',
                    'terms'     => $cat_id,
                ),
            );
        }  

        break;        
    }

    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>    
        <div class="additional-posts <?php echo esc_attr( $class ); ?>">
    		<?php if( $title ) echo '<h2 class="title">' . esc_html( $title ) . '</h2>'; ?>
            <div class="block-wrap">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <div class="block">
                    <figure class="post-thumbnail">
        				<a href="<?php the_permalink(); ?>">
                            <?php
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                                }else{ 
                                    perfect_portfolio_get_fallback_svg($image_size);
                                }
                            ?>
                        </a>
                    </figure>
    				<?php the_title( '<h3 class="block-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 
                    if( is_single() ){ ?> 
                            <div class="entry-meta">
                                <span class="posted-on" itemprop="datePublished dateModified">
                                    <a href="<?php the_permalink(); ?>">
                                        <time class="entry-date published"><?php echo esc_html( get_the_date() ); ?></time>
                                    </a>
                                </span>
                            </div>
                        <?php 
                    }else{ ?>
                        <div class="entry-meta">
                            <span class="posted-on" itemprop="datePublished dateModified">
                                <a href="<?php the_permalink(); ?>">
                                    <time class="entry-date published"><?php echo esc_html( get_the_date() ); ?></time>
                                </a>
                            </span>
                        </div>
                    <?php } ?>            
    			</div>
    			<?php } ?>
    		</div>
    	</div>
        <?php
        wp_reset_postdata();
    }
}
endif;

if( ! function_exists( 'perfect_portfolio_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function perfect_portfolio_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'perfect-portfolio' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'perfect_portfolio_social_links' ) ) :
/**
 * Social Links 
*/
function perfect_portfolio_social_links( $echo = true ){ 

    $social_links = get_theme_mod( 'social_links' );
    $ed_social    = get_theme_mod( 'ed_social_links', false ); 
        
    if( $ed_social && $social_links && $echo ){ ?>
    <ul class="social-icons">
    	<?php 
        foreach( $social_links as $link ){
    	   if( $link['link'] ){ ?>
            <li><a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank" rel="nofollow"><i class="<?php echo esc_attr( $link['font'] ); ?>"></i></a></li>    	   
            <?php
            } 
        } 
        ?>
	</ul>
    <?php    
    }elseif( $ed_social && $social_links ){
        return true;
    }else{
        return false;
    }
    ?>
    <?php                                
}
endif;

if( ! function_exists( 'perfect_portfolio_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function perfect_portfolio_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        	</div><!-- .comment-author vcard -->
        </footer>
        
        <div class="text-holder">
        	<div class="top">
                <div class="left">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'perfect-portfolio' ); ?></em>
                		<br />
                	<?php endif; ?>
                    <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b> <span class="says">says:</span>', 'perfect-portfolio' ), get_comment_author_link() ); ?>
                	<div class="comment-metadata commentmetadata">
                        <?php esc_html_e( 'Posted on', 'perfect-portfolio' );?>
                        <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    		<time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'perfect-portfolio' ), get_comment_date(),  get_comment_time() ); ?></time>
                        </a>
                	</div>
                </div>
                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            	</div>
            </div>            
            <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>        
        </div><!-- .text-holder -->
        
	<?php if ( 'div' != $args['style'] ) : ?>
    </div><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

if( ! function_exists( 'perfect_portfolio_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function perfect_portfolio_sidebar( $class = false ){
    global $post;
    $return = false;
    $page_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Pages
    $post_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Default Layout Style for Posts
    $front_page  = get_option( 'page_on_front' );
    
    if( is_singular( array( 'page', 'post' ) ) ){         
        if( get_post_meta( $post->ID, '_perfect_portfolio_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_perfect_portfolio_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            
            if( is_page_template( 'templates/portfolio.php' ) ) {
                $return = $class ? 'full-width' : false;
            }elseif( is_active_sidebar( 'sidebar' ) && $front_page != $post->ID ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width single-centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                } 
            }else{
                if( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                    $return = $class ? 'full-width single-centered' : false;
                }else{
                    $return = $class ? 'full-width' : false;
                }
            }
        }elseif( is_single() ){
            if( is_active_sidebar( 'sidebar' ) ){
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width single-centered' : false;
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
                    $return = $class ? 'rightsidebar' : 'sidebar';
                }elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
                    $return = $class ? 'leftsidebar' : 'sidebar';
                }
            }else{
                if( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width single-centered' : false;
                }else{
                    $return = $class ? 'full-width' : false;
                }
            }
        }
    }elseif( perfect_portfolio_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || get_post_type() == 'product' ) ){
        if( is_active_sidebar( 'shop-sidebar' ) ){            
            $return = $class ? 'rightsidebar' : false;         
        }else{
            $return = $class ? 'full-width' : false;
        } 
    }else{
        $return = $class ? 'full-width' : false;
    }     
    return $return;

}
endif;

if( ! function_exists( 'perfect_portfolio_get_posts' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function perfect_portfolio_get_posts( $post_type = 'post' ){    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'perfect-portfolio' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            $post_options[ $posts->ID ] = $posts->post_title;
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'perfect_portfolio_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function perfect_portfolio_get_home_sections(){
    $sections = array( 
        'about'       => array( 'sidebar' => 'about' ),
        'gallery'     => array( 'section' => 'gallery' ),
        'services'    => array( 'sidebar' => 'services' ),
        'cta'         => array( 'sidebar' => 'cta' ),
        'blog'        => array( 'section' => 'blog' ) 
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
endif;

if( ! function_exists( 'perfect_portfolio_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function perfect_portfolio_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

/**
 * Is RaraTheme Companion active or not
*/
function perfect_portfolio_is_rtc_activated(){
    return class_exists( 'RaraTheme_Companion' ) ? true : false;        
}

/**
 * Query WooCommerce activation
 */
function perfect_portfolio_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}


if( ! function_exists( 'perfect_portfolio_get_portfolio_buttons' ) ) :
/**
 * Query for Portfolio Buttons
*/
function perfect_portfolio_get_portfolio_buttons( $home = false ){
    if( taxonomy_exists( 'rara_portfolio_categories' ) ){
        if( $home ){
            $no_of_portfolio = get_theme_mod( 'no_of_portfolio', 9 );
            $s = '';
            $i = 0;
            $portfolio_posts = get_posts( array( 'post_type' => 'rara-portfolio', 'post_status' => 'publish', 'posts_per_page' => $no_of_portfolio ) );
            foreach( $portfolio_posts as $portfolio ){
                $terms = get_the_terms( $portfolio->ID, 'rara_portfolio_categories' );
                if( $terms ){
                    foreach( $terms as $term ){
                        $i++;
                        $s .= $term->term_id;
                        $s .= ', ';    
                    }
                }
            }
            $term_ids = explode( ', ', $s );
            $term_ids = array_diff( array_unique( $term_ids ), array('') );
            wp_reset_postdata();//Reseting get_posts            
        }
        
        $args = array(
            'taxonomy'      => 'rara_portfolio_categories',
            'orderby'       => 'name', 
            'order'         => 'ASC',
        );                
        $terms = get_terms( $args );
        if( $terms ){
        ?>
        <div class="button-group filter-button-group">        
            <button data-filter="*" class="is-checked"><?php esc_html_e( 'All', 'perfect-portfolio' ); ?></button>
            <?php
                foreach( $terms as $t ){
                    if( $home ){
                        if( in_array( $t->term_id, $term_ids ) )
                        echo '<button data-filter=".' . esc_attr( $t->term_id . '_portfolio_categories' ) .  '">' . esc_html( $t->name ) . '</button>';
                    }else{
                        echo '<button data-filter=".' . esc_attr( $t->term_id . '_portfolio_categories' ) .  '">' . esc_html( $t->name ) . '</button>';    
                    } 
                    
                } 
            ?>
        </div>            
        <?php
        }
    }
}
endif;

if( ! function_exists( 'perfect_portfolio_get_portfolios' ) ) :
/**
 * Query for portfolios 
*/
function perfect_portfolio_get_portfolios( $no_of_portfolio = -1 ){

    global $post;
    $portfolio_qry = new WP_Query( array( 'post_type' => 'rara-portfolio', 'post_status' => 'publish', 'posts_per_page' => $no_of_portfolio ) );
    if( taxonomy_exists( 'rara_portfolio_categories' ) && $portfolio_qry->have_posts() ){ ?>
                        
        <div class="gallery-wrap">
            <?php
            while( $portfolio_qry->have_posts() ){
                $portfolio_qry->the_post();
                $terms = get_the_terms( get_the_ID(), 'rara_portfolio_categories' );
                $s = '';
                $i = 0;
                if( $terms ){
                    foreach( $terms as $t ){
                        $i++;
                        $s .= $t->term_id . '_portfolio_categories';
                        if( count( $terms ) > $i ){
                            $s .= ' ';
                        }
                    }
                } ?>                   
                <div class="gallery-img <?php echo esc_attr( $s ); ?>">
                    <?php if( has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'perfect-portfolio-square', array( 'itemprop' => 'image' ) ); ?></a>
                    <?php }else {
                        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/perfect-portfolio-square.jpg'  ) . '" alt="' . esc_attr( get_the_title() ) . '" itemprop="image" />';
                    } ?>
                    <div class="text-holder">
                        <div class="text-holder-inner">
                            <h2 class="gal-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php $category_ids = get_the_terms( $post, 'rara_portfolio_categories');
                            if( ! empty( $category_ids ) ) { ?>
                                <span class="sub-title">
                                    <?php 
                                    foreach( $category_ids as $category_id ){
                                       echo '<a href="' . get_term_link($category_id->slug, 'rara_portfolio_categories' ) . '">';
                                        echo '<span>' . esc_html( $category_id->name ) . '</span>'; 
                                        echo '</a>';
                                    } ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div><!-- .row .grid -->
        <?php
        wp_reset_postdata(); 
    } 
}
endif;

if( !function_exists( 'perfect_portfolio_cpt_has_archive' ) ) :
/**
 * Check if post type supports an archive
 *
 * @param string $post_type post type name
 * @uses get_post_type
 * @global object $post
 * @returns boolean
 * @link https://joshuadnelson.com/code/check-if-post-type-supports-archives/
 */
function perfect_portfolio_cpt_has_archive( $post_type ) {
    if( !is_string( $post_type ) || !isset( $post_type ) )
        return false;
    
    // find custom post types with archvies
    $args = array(
        'has_archive'   => true,
        '_builtin'      => false,
    );
    $output = 'names';
    $archived_custom_post_types = get_post_types( $args, $output );
    
    // if there are no custom post types, then the current post can't be one
    if( empty( $archived_custom_post_types ) )
        return false;
    
    // check if post type is a supports archives
    if ( in_array( $post_type, $archived_custom_post_types ) ) {
            return true;
    } else {
            return false;
    }
    
    // if all else fails, return false
    return false;   
    
}
endif;

if( !function_exists( 'perfect_portfolio_tc_wrapper_start' ) ) :
    /**
     * Check if sidebar class is rightsidebar or leftsidebar
     *
     */
    function perfect_portfolio_tc_wrapper_start() {
        $sidebar = perfect_portfolio_sidebar( true );

        if( $sidebar == 'rightsidebar' || $sidebar == 'leftsidebar' ) { 
            echo '<div class="tc-wrapper">';    
        }
    }
endif;

if( !function_exists( 'perfect_portfolio_tc_wrapper_ends' ) ) :
    /**
     * Check if sidebar class is rightsidebar or leftsidebar
     *
     */
    function perfect_portfolio_tc_wrapper_ends() {
        $sidebar = perfect_portfolio_sidebar( true );

        if( $sidebar == 'rightsidebar' || $sidebar == 'leftsidebar' ) { 
            echo '</div>';    
        }
    }
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'perfect_portfolio_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function perfect_portfolio_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'perfect_portfolio_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function perfect_portfolio_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = perfect_portfolio_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#f2f2f2;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;