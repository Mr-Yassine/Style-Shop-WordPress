<?php
/**
 * Help Panel.
 *
 * @package Perfect_Portfolio
 */
?>
<!-- Updates panel -->
<div id="plugins-panel" class="panel-left visible">
	<h4><?php esc_html_e( 'Recommended Plugins', 'perfect-portfolio' ); ?></h4>

	<p><?php printf( esc_html__( 'Here is a list of recommended plugins you should install to get most out of the %1$s. Though every plugin is optional, we recommend you to at least install %2$sRaraTheme Companion%3$s, %2$sRara One Click Demo Import%3$s & %2$sContact Form 7%3$s to create a website similar to the %1$s demo and also to ensure every feature of the theme works correctly.', 'perfect-portfolio' ), PERFECT_PORTFOLIO_THEME_NAME,'<strong>','</strong>' ); ?></p>

	<hr/>

	<?php 
	$free_plugins = array(
		'raratheme-companion' => array(
			'slug'     	=> 'raratheme-companion',
			'filename' 	=> 'raratheme-companion.php',
		),                
		'contact-form-7' => array(
			'slug' 		=> 'contact-form-7',
			'filename' 	=> 'wp-contact-form-7.php',
		),                
		'rara-one-click-demo-import' => array(
			'slug' 	 	=> 'rara-one-click-demo-import',
			'filename'  => 'rara-one-click-demo-import.php',
		),                
	);

	if( $free_plugins ){ ?>
		<h4 class="recomplug-title"><?php esc_html_e( 'Free Plugins', 'perfect-portfolio' ); ?></h4>
		<p><?php esc_html_e( 'These Free Plugins might be handy for you.', 'perfect-portfolio' ); ?></p>
		<div class="recomended-plugin-wrap">
    		<?php
    		foreach( $free_plugins as $plugin ) {
    			$info     = perfect_portfolio_call_plugin_api( $plugin['slug'] );
    			$icon_url = perfect_portfolio_check_for_icon( $info->icons ); ?>    
    			<div class="recom-plugin-wrap">
    				<div class="plugin-img-wrap">
    					<img src="<?php echo esc_url( $icon_url ); ?>" />
    					<div class="version-author-info">
    						<span class="version"><?php printf( esc_html__( 'Version %s', 'perfect-portfolio' ), $info->version ); ?></span>
    						<span class="seperator">|</span>
    						<span class="author"><?php echo esc_html( strip_tags( $info->author ) ); ?></span>
    					</div>
    				</div>
    				<div class="plugin-title-install clearfix">
    					<span class="title" title="<?php echo esc_attr( $info->name ); ?>">
    						<?php echo esc_html( $info->name ); ?>	
    					</span>
                        <div class="button-wrap">
    					   <?php echo Perfect_Portfolio_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $plugin['slug'], $plugin['filename'] ); ?>
                        </div>
    				</div>
    			</div>
    			<?php
    		} 
            ?>
		</div>
	<?php
	} 
?>
</div><!-- .panel-left -->