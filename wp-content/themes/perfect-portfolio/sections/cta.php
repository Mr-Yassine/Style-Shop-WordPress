<?php
/**
 * CTA Section
 * 
 * @package Perfect_Portfolio
 */

if ( is_active_sidebar( 'cta' ) ) { ?>
	<section id="cta_section" class="cta-section">
		<div class="v-center-inner">
			<div class="tc-wrapper">
				<?php dynamic_sidebar( 'cta' ); ?>
			</div>
		</div>
	</section> <!-- .cta-section -->
<?php }