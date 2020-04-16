<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Script, styles, fonts
// **********************************************************************//  
if(!function_exists('etheme_theme_styles')) {
    function etheme_theme_styles() {
        if ( !is_admin() ) {
        	$theme = wp_get_theme();
        	$options_parent = array("parent-style");
        	if ( etheme_get_option('fa_icons') ) {
            	wp_enqueue_style("fa",get_template_directory_uri().'/css/font-awesome.min.css', array(), $theme->version);
        	}

            if ( etheme_get_option( 'et_optimize_css' ) ) {
            	wp_enqueue_style( 'parent-style',get_template_directory_uri() . '/xstore.css', array(), $theme->version );
            } else {
	            wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $theme->version );
            	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ), $theme->version );
	        }

	        if ( etheme_get_option('secondary_menu') || get_option( 'etheme_header_builder', false ) ) {
	        	wp_enqueue_style("secondary-style",get_template_directory_uri().'/css/secondary-menu.css', array("parent-style"), $theme->version);
	        }
	        if (class_exists('bbPress') && is_bbpress()) {
	        	wp_enqueue_style("forum-style",get_template_directory_uri().'/css/forum.css', array("parent-style"), $theme->version);
	        }
	        if ( class_exists('WC_LikeToDiscounts_Tab') ) {
	        	wp_enqueue_style("like2discount-style",get_template_directory_uri().'/css/like2discount.css', array("parent-style"), $theme->version);
	        }
	        if (class_exists('WeDevs_Dokan') || class_exists('Dokan_Pro') ) {
	        	wp_enqueue_style("et-dokan-style",get_template_directory_uri().'/css/dokan.css', array("parent-style"), $theme->version);
	        }
            wp_enqueue_style( 'js_composer_front');

            if ( class_exists('Woocommerce') && is_product() ) {
            	$product_id = get_the_ID();
                $slider_vertical = ( etheme_get_option('thumbs_slider_vertical') || etheme_get_custom_field('slider_direction', $product_id) == 'vertical') || ( get_query_var('etheme_single_product_builder') && etheme_get_option('product_gallery_type_et-desktop') == 'thumbnails_left' );
            	if ( $slider_vertical ) {
            		wp_enqueue_style("etheme-slick",get_template_directory_uri().'/css/slick.css', array(), $theme->version);
            	}
            }
            
        	if ( is_rtl() ) {
		    	wp_enqueue_style( 'rtl-style', get_template_directory_uri() . '/rtl.css', array(), $theme->version);
		    	$options_parent[] = 'rtl-style';
		    }

		    if ( ! defined( 'ET_CORE_VERSION' ) ) {
		    	wp_enqueue_style( 'plugin-off', get_template_directory_uri() . '/css/plugin-off.css', array(), $theme->version);
		    }

        	$icons_type = ( etheme_get_option('bold_icons') ) ? 'bold' : 'light';

        	wp_register_style( 'xstore-icons-font', false );
            wp_enqueue_style( 'xstore-icons-font' );
            wp_add_inline_style( 'xstore-icons-font', 
	            "@font-face {
				  font-family: 'xstore-icons';
				  src:
				    url('".get_template_directory_uri()."/fonts/xstore-icons-".$icons_type.".ttf') format('truetype'),
				    url('".get_template_directory_uri()."/fonts/xstore-icons-".$icons_type.".woff2') format('woff2'),
				    url('".get_template_directory_uri()."/fonts/xstore-icons-".$icons_type.".woff') format('woff'),
				    url('".get_template_directory_uri()."/fonts/xstore-icons-".$icons_type.".svg#xstore-icons') format('svg');
				  font-weight: normal;
				  font-style: normal;
				}"
			);

			if( etheme_get_option('dark_styles') ) {
            	wp_enqueue_style("dark-style",get_template_directory_uri().'/css/dark.css', array(), $theme->version);
            	$options_parent[] = 'dark-style';
        	}
		    
        	$upload_dir = wp_upload_dir();
        	if ( !is_xstore_migrated() && is_file($upload_dir['basedir'].'/xstore/options-style.min.css') && filesize($upload_dir['basedir'].'/xstore/options-style.min.css') > 0 && !is_customize_preview() ) {
        		$custom_css = $upload_dir['baseurl'] . '/xstore/options-style.min.css';
        		$custom_css = str_replace( array( 'https://', 'http://',), '//', $custom_css );
            	wp_enqueue_style("options-style",$custom_css, $options_parent, $theme->version);
            }

            wp_register_style( 'xstore-inline-css', false );
            wp_register_style( 'xstore-inline-desktop-css', false );
            wp_register_style( 'xstore-inline-tablet-css', false );
            // tweak for media queries (start)
            wp_add_inline_style( 'xstore-inline-tablet-css', '@media only screen and (max-width: 992px) {' );
            wp_register_style( 'xstore-inline-mobile-css', false );
            // tweak for media queries (start)
            wp_add_inline_style( 'xstore-inline-mobile-css', '@media only screen and (max-width: 767px) {' );

        }
    }
}

add_action( 'wp_enqueue_scripts', 'etheme_theme_styles', 40);

 if ( ! function_exists( 'etheme_theme_styles_after' ) ) {
	function etheme_theme_styles_after() {
		wp_enqueue_style( 'xstore-inline-css' );
		// tweak for media queries (end)
		wp_add_inline_style( 'xstore-inline-tablet-css', '}' );
		wp_enqueue_style( 'xstore-inline-tablet-css' );
		// tweak for media queries (end)
		wp_add_inline_style( 'xstore-inline-mobile-css', '}' );
		wp_enqueue_style( 'xstore-inline-mobile-css' );

		if ( function_exists('vc_build_safe_css_class') ) {

		    $et_fonts = get_option( 'etheme-fonts', false );

		    // remove custom fonts from vc_google_fonts wp_enqueue_style to prevent site speed falling  
			if ( $et_fonts ) {
			    foreach ( $et_fonts as $value ) {
			    	wp_dequeue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $value['name'] ) );
			    }
			}
		}
	}
}

add_action( 'wp_footer', 'etheme_theme_styles_after', 10 );

// **********************************************************************// 
// ! Plugins activation
// **********************************************************************// 
if(!function_exists('etheme_register_required_plugins')) {
	add_action('tgmpa_register', 'etheme_register_required_plugins');
	function etheme_register_required_plugins() {
		if( ! etheme_is_activated() ) return;

		$activated_data = get_option( 'etheme_activated_data' );

		$key = $activated_data['api_key'];

		if( ! $key || empty( $key ) ) return;

		$plugins_dir = 'https://dl.ariawp.com/themes/xstore/updates/';
		$token = '?token=' . $key;
		$plugins = array(
			array(
				'name'     				=> '8theme Core', // The plugin name
				'slug'     				=> 'et-core-plugin', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'et-core-plugin.zip',
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '2.2.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'WooCommerce', // The plugin name
				'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
				//'source'   				=> get_template_directory_uri() . '/framework/plugins/screets-chat.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'woocommerce', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://wordpress.org/plugins/woocommerce/', 
			),
			array(
				'name'     				=> 'WPBakery Page Builder', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'js_composer.zip' . $token, // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431', 
			),
			array(
				'name'     				=> 'Revolution Slider', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'revslider.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380', 
			),
			array(
				'name'     				=> 'Massive Addons', // The plugin name
				'slug'     				=> 'mpc-massive', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'mpc-massive.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/massive-addons-for-visual-composer/14429839', 
			),
			array(
				'name'     				=> 'Google map', // The plugin name
				'slug'     				=> 'wwp-vc-gmaps', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'wwp-vc-gmaps.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/gmaps-for-visual-composer/16393566', 
			),
			array(
				'name'     				=> '360 smart view', // The plugin name
				'slug'     				=> 'smart-product-viewer', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'smart-product-viewer.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/smart-product-viewer-360-animation-plugin/6277697', 
			),
			array(
				'name'     				=> 'Infinite scroll', // The plugin name
				'slug'     				=> 'sb-woocommerce-infinite-scroll', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'sb-woocommerce-infinite-scroll.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/woocommerce-infinite-scroll-and-ajax-pagination/10192075', 
			),
			array(
				'name'     				=> 'WooCommerce subscriptions', // The plugin name
				'slug'     				=> 'subscriptio', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'subscriptio.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/subscriptio-woocommerce-subscriptions/8754068', 
			),
			array(
				'name'     				=> 'WooCommerce Amazon', // The plugin name
				'slug'     				=> 'woozone', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'woozone.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/woocommerce-amazon-affiliates-wordpress-plugin/3057503', 
			),
			array(
				'name'     				=> 'Wishlist', // The plugin name
				'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'yith-woocommerce-wishlist', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-wishlist/', 
			),
			array(
				'name'     				=> 'Compare', // The plugin name
				'slug'     				=> 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'yith-woocommerce-compare', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-compare/', 
			),
			array(
				'name'     				=> 'Contact form 7', // The plugin name
				'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/contact-form-7/', 
			),
			array(
				'name'     				=> 'Mailchimp', // The plugin name
				'slug'     				=> 'mailchimp-for-wp', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/mailchimp-for-wp/', 
			),
			array(
				'name'     				=> 'Cookie Notice', // The plugin name
				'slug'     				=> 'cookie-notice', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/cookie-notice/', 
			),
			array(
				'name'     				=> 'Quform - WordPress Form Builder', // The plugin name
				'slug'     				=> 'quform', // The plugin slug (typically the folder name)
				// 'source'   				=> get_template_directory_uri() . '/theme/plugins/et-core-plugin.zip', // The plugin source
				'source'   				=> $plugins_dir . 'quform.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'YellowPencil Pro', // The plugin name
				'slug'     				=> 'waspthemes-yellow-pencil', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'waspthemes-yellow-pencil.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/yellow-pencil-visual-css-style-editor/11322180', 
			),
		);

		// Change this to your theme text domain, used for internationalising strings

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> 'xstore',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> esc_html__( 'Install Required Plugins', 'xstore'),
				'menu_title'                       			=> esc_html__( 'Install Plugins', 'xstore' ),
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'xstore' ), // %1$s = plugin name
				'downloading_package'                       => esc_html__( 'Downloading the install package&#8230;', 'xstore' ), // %1$s = plugin name
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'xstore' ), // %1$s = plugin name
				'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'xstore' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'xstore' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'xstore' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'xstore' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'xstore' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'xstore' ),
				'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'xstore' ),
				'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'xstore' ),
				'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'xstore' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa($plugins, $config);
	}
}

// **********************************************************************// 
// ! Footer Demo Widgets
// **********************************************************************// 

if(!function_exists('etheme_footer_demo')) {
    function etheme_footer_demo($position){
        switch ($position) {
            case 'footer-copyrights':
                ?>
					© Created by <a href="#"><i class="fa fa-heart"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.
                <?php
            break;
        }
    }
}