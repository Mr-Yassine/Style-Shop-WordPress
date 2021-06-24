<?php
/**
 * Filter to modify functionality of RaraTheme Companion plugin.
 *
 * @package Perfect_Portfolio
 */

if( ! function_exists( 'perfect_portfolio_cta_section_bgcolor_filter' ) ){
	/**
	 * Filter to add bg color of cta section widget
	 */    
	function perfect_portfolio_cta_section_bgcolor_filter(){
		return '#05d584';
	}
}
add_filter( 'rrtc_cta_bg_color', 'perfect_portfolio_cta_section_bgcolor_filter' );

if( ! function_exists( 'perfect_portfolio_cta_btn_alignment_filter' ) ){
	/**
	 * Filter to add btn alignment of cta section widget
	 */    
	function perfect_portfolio_cta_btn_alignment_filter(){
		return 'centered';
	}
}
add_filter( 'rrtc_cta_btn_alignment', 'perfect_portfolio_cta_btn_alignment_filter' );

