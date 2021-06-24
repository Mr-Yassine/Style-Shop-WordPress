<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */

get_header(); 
$blog_page_layout = get_theme_mod( 'blog_page_layout', 'with-masonry-description grid' );
?>
	<div class="tc-wrapper">
		<div id="primary" class="content-area">        
	        <main id="main" class="site-main">

				<?php
				if ( have_posts() ) : ?>
					<div class="article-wrap <?php echo esc_attr( $blog_page_layout ); ?>">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile; ?> 
					</div>
				<?php 
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</main><!-- #main -->
	        
	        <?php
	        /**
	         * After Posts hook
	         * @hooked perfect_portfolio_navigation - 15
	        */
	        do_action( 'perfect_portfolio_after_posts_content' );
	        ?>
	        
		</div><!-- #primary -->
	</div>

<?php
get_footer();
