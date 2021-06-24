( function( api ) {

    // Extends our custom "example-1" section.
    api.sectionConstructor['pro-section'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );
jQuery(document).ready(function($){
    /* Move widgets to their respective sections */
	wp.customize.section( 'sidebar-widgets-about' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-about' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-services' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-services' ).priority( '30' );
    wp.customize.section( 'sidebar-widgets-cta' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-cta' ).priority( '35' );
    
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });    
});

function scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-sidebar-widgets-about':
        preview_section_id = "about_section";
        break;
        
        case 'accordion-section-gallery_section':
        preview_section_id = "gallery_section";
        break;

        case 'accordion-section-sidebar-widgets-cta':
        preview_section_id = "cta_section";
        break;
                
        case 'accordion-section-sidebar-widgets-services':
        preview_section_id = "service_section";
        break;
        
        case 'accordion-section-blog_section':
        preview_section_id = "article_section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}