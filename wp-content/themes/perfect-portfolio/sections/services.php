<?php
/**
 * Services Section
 * 
 * @package Perfect_Portfolio
 */
if ( is_active_sidebar( 'services' ) ) { ?>
	<section id="service_section" class="service-section">
		<div class="tc-wrapper">
			<div class="widgets-holder">
				<?php dynamic_sidebar( 'services' ); ?>
			</div>
		</div>
	</section> <!-- .service-section -->
<?php }