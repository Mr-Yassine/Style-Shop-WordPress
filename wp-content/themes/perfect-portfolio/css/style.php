<?php
/**
 * Perfect Portfolio Dynamic Styles
 * 
 * @package Perfect_Portfolio
*/

function perfect_portfolio_dynamic_css(){
    
    $primary_font     = get_theme_mod( 'primary_font', 'Poppins' );
    $primary_fonts    = perfect_portfolio_get_fonts( $primary_font, 'regular' );
    $site_title_font  = get_theme_mod( 'site_title_font', 'Poppins' );
    $site_title_fonts = perfect_portfolio_get_fonts( $site_title_font, 'regular' );
    
    echo "<style type='text/css' media='all'>"; ?>
    
    /*Typography*/
    body,
    button,
    input,
    select,
    optgroup,
    textarea{
        font-family : <?php echo wp_kses_post( $primary_fonts['font'] ); ?>;
    }
    
    .site-branding .site-title,
    .site-branding .site-description{
        font-family : <?php echo wp_kses_post( $site_title_fonts['font'] ); ?>;
    }
           
    <?php echo "</style>";
}
add_action( 'wp_head', 'perfect_portfolio_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function perfect_portfolio_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function perfect_portfolio_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}