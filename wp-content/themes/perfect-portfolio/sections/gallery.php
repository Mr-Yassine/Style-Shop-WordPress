<?php
/**
 * Gallery Section
 * 
 * @package Perfect_Portfolio
 */

$no_of_portfolio = absint( get_theme_mod( 'no_of_portfolio', 9 ) );
$view_all        = get_theme_mod( 'gallery_view_all', __( 'View More', 'perfect-portfolio' ) );
$view_all_url    = get_theme_mod( 'gallery_view_all_url', '#' );
$portfolio_qry   = new WP_Query( array( 'post_type' => 'rara-portfolio', 'post_status' => 'publish', 'posts_per_page' => $no_of_portfolio ) );

if( $portfolio_qry->have_posts() && $no_of_portfolio > 0 && perfect_portfolio_is_rtc_activated() ){
?>
<section id="gallery_section" class="gallery-section style1">
	<div class="tc-wrapper">
		<?php
			perfect_portfolio_get_portfolio_buttons( true );
	        perfect_portfolio_get_portfolios( $no_of_portfolio ); 
			
			if( $view_all && $view_all_url ) {
				echo '<a href="' . esc_url( $view_all_url ) . '" class="btn-readmore">' . esc_html( $view_all ) . '</a>';
        	}
        ?>
	</div>
</section> <!-- .gallery-section -->
<?php }