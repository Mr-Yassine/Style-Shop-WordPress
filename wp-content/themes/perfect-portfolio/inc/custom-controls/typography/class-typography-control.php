<?php
/**
 * Perfect Portfolio Customizer Typography Control
 *
 * @package Perfect_Portfolio
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Perfect_Portfolio_Typography_Control' ) ) {
    
    class Perfect_Portfolio_Typography_Control extends WP_Customize_Control{
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'perfect_portfolio_il8n_strings', array(
    			'on'                 => esc_attr__( 'ON', 'perfect-portfolio' ),
    			'off'                => esc_attr__( 'OFF', 'perfect-portfolio' ),
    			'all'                => esc_attr__( 'All', 'perfect-portfolio' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'perfect-portfolio' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'perfect-portfolio' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'perfect-portfolio' ),
    			'greek'              => esc_attr__( 'Greek', 'perfect-portfolio' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'perfect-portfolio' ),
    			'khmer'              => esc_attr__( 'Khmer', 'perfect-portfolio' ),
    			'latin'              => esc_attr__( 'Latin', 'perfect-portfolio' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'perfect-portfolio' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'perfect-portfolio' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'perfect-portfolio' ),
    			'arabic'             => esc_attr__( 'Arabic', 'perfect-portfolio' ),
    			'bengali'            => esc_attr__( 'Bengali', 'perfect-portfolio' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'perfect-portfolio' ),
    			'tamil'              => esc_attr__( 'Tamil', 'perfect-portfolio' ),
    			'telugu'             => esc_attr__( 'Telugu', 'perfect-portfolio' ),
    			'thai'               => esc_attr__( 'Thai', 'perfect-portfolio' ),
    			'serif'              => _x( 'Serif', 'font style', 'perfect-portfolio' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'perfect-portfolio' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'perfect-portfolio' ),
    			'font-family'        => esc_attr__( 'Font Family', 'perfect-portfolio' ),
    			'font-size'          => esc_attr__( 'Font Size', 'perfect-portfolio' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'perfect-portfolio' ),
    			'line-height'        => esc_attr__( 'Line Height', 'perfect-portfolio' ),
    			'font-style'         => esc_attr__( 'Font Style', 'perfect-portfolio' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'perfect-portfolio' ),
    			'text-align'         => esc_attr__( 'Text Align', 'perfect-portfolio' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'perfect-portfolio' ),
    			'none'               => esc_attr__( 'None', 'perfect-portfolio' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'perfect-portfolio' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'perfect-portfolio' ),
    			'top'                => esc_attr__( 'Top', 'perfect-portfolio' ),
    			'bottom'             => esc_attr__( 'Bottom', 'perfect-portfolio' ),
    			'left'               => esc_attr__( 'Left', 'perfect-portfolio' ),
    			'right'              => esc_attr__( 'Right', 'perfect-portfolio' ),
    			'center'             => esc_attr__( 'Center', 'perfect-portfolio' ),
    			'justify'            => esc_attr__( 'Justify', 'perfect-portfolio' ),
    			'color'              => esc_attr__( 'Color', 'perfect-portfolio' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'perfect-portfolio' ),
    			'variant'            => esc_attr__( 'Variant', 'perfect-portfolio' ),
    			'style'              => esc_attr__( 'Style', 'perfect-portfolio' ),
    			'size'               => esc_attr__( 'Size', 'perfect-portfolio' ),
    			'height'             => esc_attr__( 'Height', 'perfect-portfolio' ),
    			'spacing'            => esc_attr__( 'Spacing', 'perfect-portfolio' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'perfect-portfolio' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'perfect-portfolio' ),
    			'light'              => esc_attr__( 'Light 200', 'perfect-portfolio' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'perfect-portfolio' ),
    			'book'               => esc_attr__( 'Book 300', 'perfect-portfolio' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'perfect-portfolio' ),
    			'regular'            => esc_attr__( 'Normal 400', 'perfect-portfolio' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'perfect-portfolio' ),
    			'medium'             => esc_attr__( 'Medium 500', 'perfect-portfolio' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'perfect-portfolio' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'perfect-portfolio' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'perfect-portfolio' ),
    			'bold'               => esc_attr__( 'Bold 700', 'perfect-portfolio' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'perfect-portfolio' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'perfect-portfolio' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'perfect-portfolio' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'perfect-portfolio' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'perfect-portfolio' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'perfect-portfolio' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'perfect-portfolio-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.css', null );
            
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		wp_enqueue_script( 'selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    		wp_enqueue_script( 'perfect-portfolio-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.js', array( 'jquery', 'selectize' ), false, true );
    
    		$google_fonts   = Perfect_Portfolio_Fonts::get_google_fonts();
    		$standard_fonts = Perfect_Portfolio_Fonts::get_standard_fonts();
    		$all_variants   = Perfect_Portfolio_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $value['stack'],
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'perfect-portfolio-typography', 'all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template(){ ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="rara-typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant rara-variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="rara-typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}    

        protected function render_content(){
            
        }
    }
}