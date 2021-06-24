jQuery(document).ready(function($){
    /* Move widgets to their respective sections */
    wp.customize.section( 'sidebar-widgets-contact' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-contact' ).priority( '100' );
    
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });    
});