<?php
function raratheme_snapcode_scripts() {

	// Don't bother if p3 active
	include_once (ABSPATH.'wp-admin/includes/plugin.php');
	if (is_plugin_active('p3/p3.php')) {
		return;
	}
	
}
add_action('admin_enqueue_scripts', 'raratheme_snapcode_scripts');


class raratheme_snapcode_widget extends WP_Widget {

	// Holds widget settings defaults, populated in constructor.
	protected $defaults;

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'snapcode' => '',
			'snapchat_account' => '',
		);

		$widget_ops = array(
			'classname' => 'raratheme_snapcode_widget',
			'description' => __('Display your Snapchat Snapcode.', 'raratheme-companion'),
		);

		$control_ops = array(
			'id_base' => 'raratheme_snapcode_widget',
			'width'   => 200,
			'height'  => 250,
		);

		parent::__construct('raratheme_snapcode_widget', 'Rara: Snapchat', $widget_ops, $control_ops);

	}

	// The widget content.
	function widget($args, $instance) {

		//* Merge with defaults
		$instance = wp_parse_args((array) $instance, $this->defaults);

		echo $args['before_widget'];
		ob_start();
			if (empty($instance['snapcode'])) {
				if ( current_user_can( 'manage_options' ) ) {
					_e('Please upload your Snapchat image.','raratheme-companion');
					return;
				}
			}

			if (! empty($instance['title']))
				echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];
			
			echo '<div style="text-align:center">';
			
			$link_open = $link_close = '';
			if (!empty($instance['snapchat_account'])) {
				$link_open = '<a href="'.esc_url('https://www.snapchat.com/add/'.trim($instance['snapchat_account'])).'" target="_blank" rel="nofollow">';
				$link_close = '</a>';
			}

			if (!empty($instance['snapcode'])) {
				echo $link_open.'<img src="'.esc_url($instance['snapcode']).'" alt="Snapchat" style="min-width: 1.3in; max-width: 1.7in; height: auto;"  />'.$link_close;
				if (!empty($instance['snapchat_account'])) {
					echo '<p>'.sprintf( __('Follow <b>%s</b> on Snapchat!', 'raratheme-companion'), strip_tags($instance['snapchat_account']) ).'</p>';
				}
			}
			
			echo '</div>';
		$html = ob_get_clean();
        echo apply_filters( 'raratheme_snapchat_widget_filter', $html, $args, $instance );	
		echo $args['after_widget'];

	}

	// Update a particular instance.
	function update($new_instance, $old_instance) {

		$new_instance['title'] = strip_tags($new_instance['title']);
		$new_instance['snapcode'] = strip_tags($new_instance['snapcode']);
		$new_instance['snapchat_account'] = strip_tags($new_instance['snapchat_account']);

		return $new_instance;

	}

	// The settings update form.
	function form($instance) {

		// Merge with defaults
		$instance = wp_parse_args((array) $instance, $this->defaults);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'raratheme-companion'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		
		<p><?php _e('Step 1. Download your Snapcode PNG image from','raratheme-companion');?> <a href="https://accounts.snapchat.com/accounts/snapcodes?type=png" rel="nofollow" target="_blank"><?php _e('this link','raratheme-companion');?></a>.</p>
		<p><?php _e('Step 2. Upload your Snapcode PNG image using the button below.','raratheme-companion');?></p>

		<p>
			<div class="raratheme-media-container">
				<div class="raratheme-media-inner">
					<?php $img_style = ($instance[ 'snapcode' ] != '') ? '' : 'display:none;'; ?>
					<img id="<?php echo $this->get_field_id('snapcode'); ?>-preview" src="<?php echo esc_attr($instance['snapcode']); ?>" style="margin:5px 0;padding:0;max-width:180px;height:auto;<?php echo $img_style; ?>" />
					<?php $no_img_style = ($instance[ 'snapcode' ] != '') ? 'style="display:none;"' : ''; ?>
				</div>
			
				<input type="text" id="<?php echo $this->get_field_id('snapcode'); ?>" name="<?php echo $this->get_field_name('snapcode'); ?>" value="<?php echo esc_attr($instance['snapcode']); ?>" class="raratheme-media-url" style="display: none" />

				<input type="button" value="<?php echo esc_attr(__('Upload Snapchat Image', 'raratheme-companion')); ?>" class="button raratheme-media-upload" id="<?php echo $this->get_field_id('snapcode'); ?>-button" />
				<br class="clear">
			</div>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('snapchat_account'); ?>"><?php _e('Snapchat Account Name:', 'raratheme-companion'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('snapchat_account'); ?>" name="<?php echo $this->get_field_name('snapchat_account'); ?>" value="<?php if (isset($instance['snapchat_account'])) echo esc_attr($instance['snapchat_account']); ?>" class="widefat" placeholder="<?php _e("For example:", 'raratheme-companion'); ?> mileyxxcyrus" />
		</p>

		<?php

	}

}

function register_raratheme_snapchat_widget() { 
	register_widget('raratheme_snapcode_widget');
}
add_action('widgets_init', 'register_raratheme_snapchat_widget');
