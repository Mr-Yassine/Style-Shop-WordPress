<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Perfect_Portfolio
 */

global $wp_query, $post;
?>
<section class="no-results not-found">
	<header class="page-header">
		<?php if( is_home() && $wp_query->found_posts == 0 && $post ){ ?>
            <h1 class="page-title"><?php esc_html_e( 'Add More Posts', 'perfect-portfolio' ); ?></h1>		  
		<?php }else{ ?>
            <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'perfect-portfolio' ); ?></h1>
        <?php } ?>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'perfect-portfolio' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>

		<?php		
        elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'perfect-portfolio' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'perfect-portfolio' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
