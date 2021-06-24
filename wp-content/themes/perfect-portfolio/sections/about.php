<?php
/**
 * About Section
 * 
 * @package Perfect_Portfolio
 */

if ( is_active_sidebar( 'about' ) ) { ?>
	<section id="about_section" class="about-section">
		<div class="tc-wrapper">
			<?php dynamic_sidebar( 'about' ); ?>
		</div>
	</section> <!-- .about-section -->
<?php }