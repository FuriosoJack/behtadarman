<?php

// **********************************************************************// 
// ! Define base constants
// **********************************************************************//

define('ETHEME_FW', '1.0');
define('ETHEME_BASE', get_template_directory() .'/');
define('ETHEME_CHILD', get_stylesheet_directory() .'/');
define('ETHEME_BASE_URI', get_template_directory_uri() .'/');

define('ETHEME_CODE', 'framework/');
define('ETHEME_CODE_DIR', ETHEME_BASE.'framework/');
define('ETHEME_TEMPLATES', ETHEME_CODE . 'templates/');
define('ETHEME_THEME', 'theme/');
define('ETHEME_THEME_DIR', ETHEME_BASE . 'theme/');
define('ETHEME_TEMPLATES_THEME', ETHEME_THEME . 'templates/');
define('ETHEME_CODE_3D', ETHEME_CODE .'thirdparty/');
define('ETHEME_CODE_3D_URI', ETHEME_BASE_URI.ETHEME_CODE .'thirdparty/');
define('ETHEME_CODE_WIDGETS', ETHEME_CODE .'widgets/');
define('ETHEME_CODE_POST_TYPES', ETHEME_CODE .'post-types/');
define('ETHEME_CODE_SHORTCODES', ETHEME_CODE .'shortcodes/');
define('ETHEME_CODE_CSS', ETHEME_BASE_URI . ETHEME_CODE .'assets/admin-css/');
define('ETHEME_CODE_JS', ETHEME_BASE_URI . ETHEME_CODE .'assets/js/');
define('ETHEME_CODE_IMAGES', ETHEME_BASE_URI . ETHEME_THEME .'assets/images/');
define('ETHEME_CODE_CUSTOMIZER_IMAGES', ETHEME_BASE_URI . ETHEME_CODE . 'customizer/images/theme-options');
define('ETHEME_API', 'https://www.8theme.com/themes/api/');

define('ETHEME_PREFIX', '_et_');

define( 'ETHEME_CORE_MIN_VERSION', '2.2.3' );

// **********************************************************************// 
// ! Helper Framework functions
// **********************************************************************//
require_once( ETHEME_BASE . ETHEME_CODE . 'helpers.php' );

/*
* Theme f-ns
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'theme-functions.php') );

/*
* Theme template elements
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'template-elements.php') );

/*
* Menu walkers
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'walkers.php') );

// **********************************************************************// 
// ! Framework setup
// **********************************************************************//
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'theme-init.php') );

// **********************************************************************// 
// ! Set up plugin
// **********************************************************************//
require_once( apply_filters('etheme_file_url', ETHEME_CODE_3D . 'envato_setup/envato_setup.php') );

/*
* Post types
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE_POST_TYPES . 'static-blocks.php') );
require_once( apply_filters('etheme_file_url', ETHEME_CODE_POST_TYPES . 'portfolio.php') );

/*
* Configure Visual Composer
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'vc.php') );

/*
* Plugins activation
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE_3D . 'tgm-plugin-activation/class-tgm-plugin-activation.php') );


/*
* Video parse from url
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE_3D . 'parse-video/VideoUrlParser.class.php') );

/*
* Composer autoloader
* ******************************************************************* */
require_once apply_filters('etheme_file_url', ETHEME_CODE_3D . 'vendor/autoload.php');

/*
* Taxonomy metadat
* ******************************************************************* */
require_once apply_filters('etheme_file_url', ETHEME_CODE_3D . 'cmb2-taxonomy/init.php');

/*
* WooCommerce f-ns
* ******************************************************************* */
if(etheme_woocommerce_installed() && current_theme_supports('woocommerce') ) {
	require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'woo.php') );
	require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'woo/video.php') );
}

/* 
*
* Theme Options 
* ******************************************************************* */

require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'class-kirki-installer-section.php') );

require_once( apply_filters('etheme_file_url',ETHEME_CODE . 'customizer/search/class-customize-search.php' ) );

require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'theme-options.php') );

// move to admin 
if ( get_option('et_options') ) {

	if (!get_option( 'xstore_theme_migrated', false ) || isset($_GET['xstore_theme_migrate_options'])) {

		if ( class_exists('Kirki') ) {
			if (isset($_GET['xstore_theme_migrate_options'])) {
				require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'migrator.php') );
				new Etheme_Xstore_Options_Migrator();
			}
			else {
				add_action( 'admin_notices', function() {

					$admin_url = admin_url( 'admin.php?page=et-panel-welcome' ); 
					echo '<div class="wrap">
			                <div class="et-message et-error notice">
			                    '.sprintf(esc_html__('%1s %2s To finish migration from Redux Framework (old Theme Options) to Kirki Customizer Framework (new Theme Options via Customizer) we have to update your database to the newest version. Before this process please make backup of database and files. %3s %4s', 'xstore'), '<strong>'.esc_html__('XStore database update required.', 'xstore').'</strong><br/>', '<p>', '</p>', '<a href="'.add_query_arg( 'xstore_theme_migrate_options', 'true',  $admin_url ) . '" class="etheme-migrator button button-primary">' . esc_html__('Update now', 'xstore') . '
				                    	<span class="et-loader">
						                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
						                </span>
					                </a>') . '
			                </div>
			            </div>
			        ';
				}, 10 );
			}
		}
		else {
			add_action( 'admin_notices', function() {
				echo '<div class="wrap">
					<div class="et-message et-error error">
						<p>'.sprintf(esc_html__('%1s Install and activate %2s plugin to use Theme Options.', 'xstore'), '<b>'.esc_html__('IMPORTANT:', 'xstore').'</b>', '<a href="'.admin_url( 'themes.php?page=install-required-plugins&plugin_status=install' ).'"><b>'.esc_html__('XStore Core', 'xstore').'</b></a>') . '</p>
					</div>
				</div>';
			}, 10);
		}
	}	
	if ( get_option( 'xstore_theme_migrated', false ) && !get_option( 'disable_notice_et_deactivate_redux', false ) ) {
		add_action( 'admin_notices', function() {
			echo '<div class="wrap">
				<div class="et-message et-info notice">
					<a class="et-message-close notice-dismiss" href="'.admin_url('plugins.php?plugin_status=active&disable_notice_et_deactivate_redux=1').'">'.esc_html__('Dismiss', 'xstore').'</a>
					<p>'.sprintf(esc_html__('Important: %1s plugin is not required for XStore 6.0 and upper and we would recommend you to remove it and speed up the site!', 'xstore'), '<a href="'.admin_url( 'plugins.php?plugin_status=active' ).'"><b>'.esc_html__('Redux Framework', 'xstore').'</b></a>') . '</p>
				</div>
			</div>';
		}, 10);
	}

	if ( isset($_GET['disable_notice_et_deactivate_redux']) ) {
		update_option( 'disable_notice_et_deactivate_redux', true );
	}
}

// customizer Kirki loader style  
if ( is_customize_preview()) {
	add_action( 'wp_head', 'etheme_head_config_customizer', 99);
}

add_action('init', function(){
	if ( is_customize_preview() ) {
		// dequeue WooZone style 
		add_action( "admin_print_styles", function() {
			wp_dequeue_style('WooZone-main-style');
		} );
	}

}, 10);

function etheme_head_config_customizer () {
	if ( !class_exists('Kirki') ) return; 
		?>
		<style>
			.kirki-customizer-loading-wrapper {
				background-image: none !important;
			}
			.kirki-customizer-loading-wrapper .kirki-customizer-loading {
			    background: #555 !important;
			    width: 30px !important;
			    height: 30px !important;
			    margin: -15px !important;
			}
		</style>
	<?php
}

add_action( 'customize_controls_print_footer_scripts', 'etheme_load_admin_styles_customizer' );
function etheme_load_admin_styles_customizer() {
 	if(class_exists('Kirki') ) {
    	wp_dequeue_style( 'woocommerce_admin_styles' );
    }
    wp_enqueue_style('etheme_customizer_css', ETHEME_BASE_URI . ETHEME_CODE.'customizer/css/admin.css');

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
}

function etheme_customizer_live_preview() {

    wp_enqueue_style( 'etheme-customizer-preview-css', ETHEME_BASE_URI . ETHEME_CODE . 'customizer/css/preview.css', null, '0.1', 'all' );
    wp_enqueue_script( 'etheme-customizer-frontend-js', ETHEME_BASE_URI . ETHEME_CODE . 'customizer/js/preview.js', array('jquery'), '0.1', 'all' ); 
}

add_action( 'customize_controls_print_styles', 'etheme_customizer_css', 99 );

function etheme_customizer_css() { ?>
	<style>
    	.wp-customizer:not(.ready) #customize-controls:before,
    	.wp-customizer.et-preload #customize-controls:before {
		    position: absolute;
		    left: 0;
		    top: 0;
		    right: 0;
		    bottom: 0;
		    background: #fff;
		    content: '';
		    z-index: 500002;
		}

		.wp-customizer.et-preload #customize-controls:before {
			opacity: .5;
		}

		.wp-customizer:not(.ready) #customize-controls:after,
		.wp-customizer.et-preload #customize-controls:after {
		    content: '';
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    width: 30px;
		    height: 30px;
		    background: #555;
		    margin: -15px;
		    border-radius: 50%;
		    -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
		    animation: sk-scaleout 1.0s infinite ease-in-out;
		    z-index: 500002;
		}
		@-webkit-keyframes sk-scaleout {
		    0% { -webkit-transform: scale(0) }
		    100% {
		        -webkit-transform: scale(1.0);
		        opacity: 0;
		    }
		}
		@keyframes sk-scaleout {
		    0% {
		        -webkit-transform: scale(0);
		        transform: scale(0);
		    }
		    100% {
		        -webkit-transform: scale(1.0);
		        transform: scale(1.0);
		        opacity: 0;
		    }
		}
		
		@media only screen and (max-width: 1666px) {
			.wp-customizer .wp-full-overlay.expanded {
			    margin-left: 250px;
			}
		    .wp-customizer .wp-full-overlay.collapsed .wp-full-overlay-sidebar {
		        margin-left: -250px;
		    }
		    #available-menu-items, #available-widgets {
		    	left: -251px;
		    }
		    #available-menu-items, #available-widgets {
		    	width: 250px;
		    }
		}

		.wp-customizer .wp-full-overlay-sidebar, .wp-customizer #customize-footer-actions .devices-wrapper {
		    min-width: 250px;
		}
		@media only screen and (max-width: 1250px) {
		    .wp-customizer .wp-full-overlay.expanded {
		        margin-left: 200px;
		    }

		    .wp-customizer .wp-full-overlay.collapsed .wp-full-overlay-sidebar {
		        margin-left: -200px;
		    }

		    .wp-customizer .wp-full-overlay-sidebar, .wp-customizer #customize-footer-actions .devices-wrapper {
		        min-width: 200px;
		    }
		}
	</style>
	<?php
}

add_action( 'customize_preview_init', 'etheme_customizer_live_preview' );
	

/*
* Sidebars
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'sidebars.php') );

/*
* Custom Metaboxes for pages
* ******************************************************************* */
require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'custom-metaboxes.php') );

/*
* Admin panel setup
* ******************************************************************* */

if ( is_admin() ) {
	require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'system-requirements.php') );

	// require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'thirdparty/fonts_uploader/etheme_fonts_uploader.php') );
	
	require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'admin.php') );

	require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'panel/panel.php') );

	require_once( apply_filters('etheme_file_url', ETHEME_CODE_3D . 'menu-images/nav-menu-images.php'));
	
	/*
	* Check theme version
	* ******************************************************************* */
	require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'version-check.php') );

}