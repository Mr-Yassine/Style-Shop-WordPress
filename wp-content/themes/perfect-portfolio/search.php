<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Perfect_Portfolio
 */
global $wp_query;
get_header(); ?>
	<div class="tc-wrapper">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
			<?php
            echo '<div class="post-count">' . sprintf( esc_html__( 'Showing %1$s Result(s)', 'perfect-portfolio' ), number_format_i18n( $wp_query->found_posts  ) ). '</div>';
			if ( have_posts() ) : ?>
				<div class="article-wrap normal-grid-description">
					<?php
	        
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
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
