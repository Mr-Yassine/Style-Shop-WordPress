<?php
/**
 * Active Callback
 * 
 * @package Perfect_Portfolio
*/

function perfect_portfolio_blog_view_all_ac(){
    $blog = get_option( 'page_for_posts' );
    if( $blog ) return true;
    
    return false; 
}

function perfect_portfolio_gallery_view_all_ac( $control ){

    $control_id         = $control->id;
    $enable_gallery      = $control->manager->get_setting( 'ed_gallery_section' )->value();

    if ( $control_id == 'gallery_view_all' && $enable_gallery ) return true;
    if ( $control_id == 'gallery_view_all_url' && $enable_gallery ) return true;
  	
  	return false; 
}