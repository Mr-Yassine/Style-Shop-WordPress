<?php
/**
 * Blog Section
 * 
 * @package Perfect_Portfolio
 */

$btitle     = get_theme_mod( 'blog_section_title', __( 'Articles', 'perfect-portfolio' ) );
$blog       = get_option( 'page_for_posts' );
$label      = get_theme_mod( 'blog_view_all', __( 'View All', 'perfect-portfolio' ) );
$image_size = 'perfect-portfolio-article';

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query( $args );

if( $btitle || $qry->have_posts() ){ ?>

    <section id="article_section" class="article-section">
    	<div class="tc-wrapper">        
            <?php if( $btitle ){
                if( $btitle ) echo '<h2 class="section-title"><span>' . esc_html( $btitle ) . '</span></h2>'; 
            } 

            if( $qry->have_posts() ){ ?>
                <div class="article-holder">
        			<?php 
                    while( $qry->have_posts() ){
                        $qry->the_post(); ?>
                        <div class="article-block">
            				<figure class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                                    }else{ 
                                        perfect_portfolio_get_fallback_svg( $image_size );
                                    }                            
                                ?>                        
                                </a>
                            </figure>
        					<header class="entry-header">
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="entry-meta">
                                    <span class="posted-on"><a href="<?php the_permalink(); ?>"><time><?php echo esc_html( get_the_date() ); ?></time></a></span>
                                </div>                        
                            </header>
            			</div>			
            			<?php 
                    }
                    wp_reset_postdata();
                    ?>
        		</div>        		
                <?php if( $blog && $label ){ ?>
            		<a href="<?php the_permalink( $blog ); ?>" class="btn-readmore"><i class="fa fa-archive"></i><?php echo esc_html( $label ); ?></a>
                <?php } 
            } ?>
    	</div>
    </section>
<?php }