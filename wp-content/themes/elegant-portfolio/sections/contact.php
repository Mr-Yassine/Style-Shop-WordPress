<?php
/**
 * Contact Section
 * 
 * @package Elegant_Portfolio
 */

if ( is_active_sidebar( 'contact' ) ) { ?>
	<section id="contact_section" class="contact-section">
		<div class="tc-wrapper">
            <div class="contact-holder">
			    <?php dynamic_sidebar( 'contact' ); ?>
            </div>
		</div>
	</section> <!-- .contact-section -->
<?php }