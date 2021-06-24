<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://raratheme.com
 * @since      1.0.0
 *
 * @package    Rara_Theme_Toolkit_Pro
 * @subpackage Rara_Theme_Toolkit_Pro/includes
 */
class RaraTheme_Companion_Functions {


	/**
     * List out font awesome icon list
    */
    function raratheme_companion_get_icon_list(){
        require RARATC_BASE_PATH . '/includes/assets/fontawesome.php';
        ?>
        <input type="text" class="rrtc-search-icon" placeholder="<?php _e('Search Icon','raratheme-companion');?>">
        <div class="rara-font-awesome-list">
    <?php
        echo '<ul class="rara-font-group">';
        foreach( $fontawesome as $font ){
            echo '<li><i class="' . esc_attr( $font ) . '"></i></li>';
        }
        echo '</ul></div>';
    }

    function rtc_icon_list(){
        $fontawesome = array(  
          '500px',
          'accessible-icon',
          'accusoft',
          'acquisitions-incorporated',
          'adn',
          'adobe',
          'adversal',
          'affiliatetheme',
          'algolia',
          'alipay',
          'amazon',
          'amazon-pay',
          'amilia',
          'android',
          'angellist',
          'angrycreative',
          'angular',
          'app-store',
          'app-store-ios',
          'apper',
          'apple',
          'apple-pay',
          'artstation',
          'asymmetrik',
          'atlassian',
          'audible',
          'autoprefixer',
          'avianex',
          'aviato',
          'aws',
          'bandcamp',
          'behance',
          'behance-square',
          'bimobject',
          'bitbucket',
          'bitcoin',
          'bity',
          'black-tie',
          'blackberry',
          'blogger',
          'blogger-b',
          'bluetooth',
          'bluetooth-b',
          'btc',
          'buromobelexperte',
          'buysellads',
          'canadian-maple-leaf',
          'cc-amazon-pay',
          'cc-amex',
          'cc-apple-pay',
          'cc-diners-club',
          'cc-discover',
          'cc-jcb',
          'cc-mastercard',
          'cc-paypal',
          'cc-stripe',
          'cc-visa',
          'centercode',
          'centos',
          'chrome',
          'cloudscale',
          'cloudsmith',
          'cloudversify',
          'codepen',
          'codiepie',
          'confluence',
          'connectdevelop',
          'contao',
          'cpanel',
          'creative-commons',
          'creative-commons-by',
          'creative-commons-nc',
          'creative-commons-nc-eu',
          'creative-commons-nc-jp',
          'creative-commons-nd',
          'creative-commons-pd',
          'creative-commons-pd-alt',
          'creative-commons-remix',
          'creative-commons-sa',
          'creative-commons-sampling',
          'creative-commons-sampling-plus',
          'creative-commons-share',
          'creative-commons-zero',
          'critical-role',
          'css3',
          'css3-alt',
          'cuttlefish',
          'd-and-d',
          'd-and-d-beyond',
          'dashcube',
          'delicious',
          'deploydog',
          'deskpro',
          'dev',
          'deviantart',
          'dhl',
          'diaspora',
          'digg',
          'digital-ocean',
          'discord',
          'discourse',
          'dochub',
          'docker',
          'draft2digital',
          'dribbble',
          'dribbble-square',
          'dropbox',
          'drupal',
          'dyalog',
          'earlybirds',
          'ebay',
          'edge',
          'elementor',
          'ello',
          'ember',
          'empire',
          'envira',
          'erlang',
          'ethereum',
          'etsy',
          'expeditedssl',
          'facebook',
          'facebook-f',
          'facebook-messenger',
          'facebook-square',
          'fantasy-flight-games',
          'fedex',
          'fedora',
          'figma',
          'firefox',
          'first-order',
          'first-order-alt',
          'firstdraft',
          'flickr',
          'flipboard',
          'fly',
          'font-awesome',
          'font-awesome-alt',
          'font-awesome-flag',
          'fonticons',
          'fonticons-fi',
          'fort-awesome',
          'fort-awesome-alt',
          'forumbee',
          'foursquare',
          'free-code-camp',
          'freebsd',
          'fulcrum',
          'galactic-republic',
          'galactic-senate',
          'get-pocket',
          'gg',
          'gg-circle',
          'git',
          'git-square',
          'github',
          'github-alt',
          'github-square',
          'gitkraken',
          'gitlab',
          'gitter',
          'glide',
          'glide-g',
          'gofore',
          'goodreads',
          'goodreads-g',
          'google',
          'google-drive',
          'google-play',
          'google-plus',
          'google-plus-g',
          'google-plus-square',
          'google-wallet',
          'gratipay',
          'grav',
          'gripfire',
          'grunt',
          'gulp',
          'hacker-news',
          'hacker-news-square',
          'hackerrank',
          'hips',
          'hire-a-helper',
          'hooli',
          'hornbill',
          'hotjar',
          'houzz',
          'html5',
          'hubspot',
          'imdb',
          'instagram',
          'intercom',
          'internet-explorer',
          'invision',
          'ioxhost',
          'itunes',
          'itunes-note',
          'java',
          'jedi-order',
          'jenkins',
          'jira',
          'joget',
          'joomla',
          'js',
          'js-square',
          'jsfiddle',
          'kaggle',
          'keybase',
          'keycdn',
          'kickstarter',
          'kickstarter-k',
          'korvue',
          'laravel',
          'lastfm',
          'lastfm-square',
          'leanpub',
          'less',
          'line',
          'linkedin',
          'linkedin-in',
          'linode',
          'linux',
          'lyft',
          'magento',
          'mailchimp',
          'mandalorian',
          'markdown',
          'mastodon',
          'maxcdn',
          'medapps',
          'medium',
          'medium-m',
          'medrt',
          'meetup',
          'megaport',
          'mendeley',
          'microsoft',
          'mix',
          'mixcloud',
          'mizuni',
          'modx',
          'monero',
          'napster',
          'neos',
          'nimblr',
          'nintendo-switch',
          'node',
          'node-js',
          'npm',
          'ns8',
          'nutritionix',
          'odnoklassniki',
          'odnoklassniki-square',
          'old-republic',
          'opencart',
          'openid',
          'opera',
          'optin-monster',
          'osi',
          'page4',
          'pagelines',
          'palfed',
          'patreon',
          'paypal',
          'penny-arcade',
          'periscope',
          'phabricator',
          'phoenix-framework',
          'phoenix-squadron',
          'php',
          'pied-piper',
          'pied-piper-alt',
          'pied-piper-hat',
          'pied-piper-pp',
          'pinterest',
          'pinterest-p',
          'pinterest-square',
          'playstation',
          'product-hunt',
          'pushed',
          'python',
          'qq',
          'quinscape',
          'quora',
          'r-project',
          'raspberry-pi',
          'ravelry',
          'react',
          'reacteurope',
          'readme',
          'rebel',
          'red-river',
          'reddit',
          'reddit-alien',
          'reddit-square',
          'redhat',
          'renren',
          'replyd',
          'researchgate',
          'resolving',
          'rev',
          'rocketchat',
          'rockrms',
          'safari',
          'sass',
          'schlix',
          'scribd',
          'searchengin',
          'sellcast',
          'sellsy',
          'servicestack',
          'shirtsinbulk',
          'shopware',
          'simplybuilt',
          'sistrix',
          'sith',
          'sketch',
          'skyatlas',
          'skype',
          'slack',
          'slack-hash',
          'slideshare',
          'snapchat',
          'snapchat-ghost',
          'snapchat-square',
          'soundcloud',
          'sourcetree',
          'speakap',
          'spotify',
          'squarespace',
          'stack-exchange',
          'stack-overflow',
          'staylinked',
          'steam',
          'steam-square',
          'steam-symbol',
          'sticker-mule',
          'strava',
          'stripe',
          'stripe-s',
          'studiovinari',
          'stumbleupon',
          'stumbleupon-circle',
          'superpowers',
          'supple',
          'suse',
          'teamspeak',
          'telegram',
          'telegram-plane',
          'tencent-weibo',
          'the-red-yeti',
          'themeco',
          'themeisle',
          'think-peaks',
          'trade-federation',
          'trello',
          'tripadvisor',
          'tumblr',
          'tumblr-square',
          'twitch',
          'twitter',
          'twitter-square',
          'typo3',
          'uber',
          'ubuntu',
          'uikit',
          'uniregistry',
          'untappd',
          'ups',
          'usb',
          'usps',
          'ussunnah',
          'vaadin',
          'viacoin',
          'viadeo',
          'viadeo-square',
          'viber',
          'vimeo',
          'vimeo-square',
          'vimeo-v',
          'vine',
          'vk',
          'vnv',
          'vuejs',
          'weebly',
          'weibo',
          'weixin',
          'whatsapp',
          'whatsapp-square',
          'whmcs',
          'wikipedia-w',
          'windows',
          'wix',
          'wizards-of-the-coast',
          'wolf-pack-battalion',
          'wordpress',
          'wordpress-simple',
          'wpbeginner',
          'wpexplorer',
          'wpforms',
          'wpressr',
          'xbox',
          'xing',
          'xing-square',
          'y-combinator',
          'yahoo',
          'yandex',
          'yandex-international',
          'yarn',
          'yelp',
          'yoast',
          'youtube',
          'youtube-square',
          'zhihu',
          'rss',
        );
        return $fontawesome;
    }
    function rrtc_minify_js( $input ) {
      if(trim($input) === "") return $input;
      return preg_replace(
          array(
              // Remove comment(s)
              '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
              // Remove white-space(s) outside the string and regex
              '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
              // Remove the last semicolon
              '#;+\}#',
              // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
              '#([\{,])([\'])(\d+|[a-z_]\w*)\2(?=\:)#i',
              // --ibid. From `foo['bar']` to `foo.bar`
              '#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i',
              // Replace `true` with `!0`
              '#(?<=return |[=:,\(\[])true\b#',
              // Replace `false` with `!1`
              '#(?<=return |[=:,\(\[])false\b#',
              // Clean up ...
              '#\s*(\/\*|\*\/)\s*#'
          ),
          array(
              '$1',
              '$1$2',
              '}',
              '$1$3',
              '$1.$3',
              '!0',
              '!1',
              '$1'
          ),
      $input);
  }


  function rrtc_minify_css( $input ) {
      if(trim($input) === "") return $input;
      // Force white-space(s) in `calc()`
      if(strpos($input, 'calc(') !== false) {
          $input = preg_replace_callback('#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function($matches) {
              return 'calc(' . preg_replace('#\s+#', "\x1A", $matches[1]) . ')';
          }, $input);
      }
      return preg_replace(
          array(
              // Remove comment(s)
              '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
              // Remove unused white-space(s)
              '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
              // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
              '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
              // Replace `:0 0 0 0` with `:0`
              '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
              // Replace `background-position:0` with `background-position:0 0`
              '#(background-position):0(?=[;\}])#si',
              // Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
              '#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
              // Minify string value
              '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
              '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
              // Minify HEX color code
              '#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
              // Replace `(border|outline):none` with `(border|outline):0`
              '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
              // Remove empty selector(s)
              '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
              '#\x1A#'
          ),
          array(
              '$1',
              '$1$2$3$4$5$6$7',
              '$1',
              ':0',
              '$1:0 0',
              '.$1',
              '$1$3',
              '$1$2$4$5',
              '$1$2$3',
              '$1:0',
              '$1$2',
              ' '
          ),
      $input);
  }
    /**
     * List out font awesome icon list
    */
    function rtc_get_icon_list(){
        require RARATC_BASE_PATH . '/includes/assets/fontawesome.php';
        ?>
        <div class="rara-font-awesome-list">
    <?php
        $fontawesome = $this->rtc_icon_list();
        echo '<ul class="rara-font-group">';
        foreach( $fontawesome as $font ){
            echo '<li><i class="fa ' . esc_attr( $font ) . '"></i></li>';
        }
        echo '</ul></div>';
    }
    /**
     * Get an attachment ID given a URL.
     * 
     * @param string $url
     *
     * @return int Attachment ID on success, 0 on failure
     */
    function raratheme_companion_get_attachment_id( $url ) {
        $attachment_id = 0;
        $dir = wp_upload_dir();
        if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
            $file = basename( $url );
            $query_args = array(
                'post_type'   => 'attachment',
                'post_status' => 'inherit',
                'fields'      => 'ids',
                'meta_query'  => array(
                    array(
                        'value'   => $file,
                        'compare' => 'LIKE',
                        'key'     => '_wp_attachment_metadata',
                    ),
                )
            );
            $query = new WP_Query( $query_args );
            if ( $query->have_posts() ) {
                foreach ( $query->posts as $post_id ) {
                    $meta = wp_get_attachment_metadata( $post_id );
                    $original_file       = basename( $meta['file'] );
                    $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
                    if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                        $attachment_id = $post_id;
                        break;
                    }
                }
            }
        }
        return $attachment_id;
    }

    /**
     * Retrieves the image field.
     *  
     * @link https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
     */
    function raratheme_companion_get_image_field( $id, $name, $image, $label ){
        $output = '';
        $output .= '<div class="widget-upload">';
        $output .= '<label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label><br/>';
        $output .= '<input id="' . esc_attr( $id ) . '" class="rara-upload" type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( $image ) . '" placeholder="' . __('No file chosen', 'raratheme-companion') . '" />' . "\n";
        if ( function_exists( 'wp_enqueue_media' ) ) {
            if ( $image == '' ) {
                $output .= '<input id="upload-' . esc_attr( $id ) . '" class="rara-upload-button button" type="button" value="' . __('Upload', 'raratheme-companion') . '" />' . "\n";
            } else {
                $output .= '<input id="upload-' . esc_attr( $id ) . '" class="rara-upload-button button" type="button" value="' . __('Change', 'raratheme-companion') . '" />' . "\n";
            }
        } else {
            $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'raratheme-companion') . '</i></p>';
        }

        $output .= '<div class="rara-screenshot" id="' . esc_attr( $id ) . '-image">' . "\n";

        if ( $image != '' ) {
            $remove = '<a class="rara-remove-image">'.__('Remove Image','raratheme-companion').'</a>';
            $attachment_id = $image;
            $image_url = wp_get_attachment_image_url( $attachment_id, 'full');
            $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_url);
            if ( $image ) {
                $output .= '<img src="' . esc_url( $image_url ) . '" alt="" />' . $remove;
            } else {
                // Standard generic output if it's not an image.
                $output .= '<small>' . __( 'Please upload valid image file.', 'raratheme-companion' ) . '</small>';
            }     
        }
        $output .= '</div></div>' . "\n";
        
        echo $output;
    }

	/**
	 * Get all the registered image sizes along with their dimensions
	 *
	 * @global array $_wp_additional_image_sizes
	 *
	 * @link http://core.trac.wordpress.org/ticket/18947 Reference ticket
	 * @return array $image_sizes The image sizes
	 */
	function raratheme_get_all_image_sizes() {
		global $_wp_additional_image_sizes;
		$default_image_sizes = array( 'thumbnail', 'medium', 'large', 'full' );
		 
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[$size]['width']	= intval( get_option( "{$size}_size_w") );
			$image_sizes[$size]['height'] = intval( get_option( "{$size}_size_h") );
			$image_sizes[$size]['crop']	= get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}
		
		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) )
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
			
		return $image_sizes;
	}

    function raratheme_posted_on( $icon = false ) {
    
        echo '<span class="posted-on">';
        
        if( $icon ) echo '<i class="fa fa-calendar" aria-hidden="true"></i>';
        
        printf( '<a href="%1$s" rel="bookmark"><time class="entry-date published updated" datetime="%2$s">%3$s</time></a>', esc_url( get_permalink() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
        
        echo '</span>';

    }

    /**
     * Get Fallback SVG
     */
    function raratheme_get_fallback_svg( $post_thumbnail ) {

        if( ! $post_thumbnail ){
            return;
        }

        $image_size = $this->raratheme_get_image_sizes( $post_thumbnail );
        $svg_fill   = apply_filters('raratheme_fallback_svg_fill', 'fill:#f2f2f2;');
        
        if( $image_size ){ ?>
        <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
            <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="<?php echo $svg_fill;?>"></rect>
        </svg>
        <?php
        }
    }

    /**
     * Get information about available image sizes
     */
    function raratheme_get_image_sizes( $size = '' ) {
    
        global $_wp_additional_image_sizes;
    
        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();
    
        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {
            if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
                $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
                $sizes[ $_size ] = array( 
                    'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                );
            }
        } 
        // Get only 1 size if found
        if ( $size ) {
            if( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            } else {
                return false;
            }
        }
        return $sizes;
    }
}
new RaraTheme_Companion_Functions;