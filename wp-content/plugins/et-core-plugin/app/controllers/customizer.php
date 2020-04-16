<?php
namespace ETC\App\Controllers;

use ETC\App\Controllers\Base_Controller;

/**
 * Create customizer controller.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models
 */
final class Customizer extends Base_Controller{

	/**
	 * Construct the class.
	 *
	 * @since 1.4.4
	 */
	public function hooks() {

		// Include files
		require_once ET_CORE_DIR . 'packages/kirki/kirki.php';

		/**
		 * Load customize-builder.
		 * 
		 * @since 1.4.3
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/class-ajax-search.php' );

		/**
		 * Load builder functions.
		 * 
		 * @since 1.0.0
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/functions.php' );

		/**
		 * Load customizer addons.
		 * 
		 * @since 1.0.0
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/addons.php' );

		/**
		 * Customizer import/export plugin
		 * 
		 * @since 2.1.4
		 */
		if ( !defined('CEI_PLUGIN_DIR') ){
			require_once( ET_CORE_DIR . 'packages/customizer-export-import/customizer-export-import.php' );
		}

		// Enqueue frontend builder scripts
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts' ), 40);

		add_action( 'init', array( $this, 'customizer_init' ) );
	}

	/**
	 * Enqueue styles and scripts.
	 *
	 * @since 1.4.4
	 */
	public function enqueue_scripts() {

		wp_enqueue_style( 'etheme_customizer_frontend_css', ET_CORE_URL.'app/models/customizer/frontend/css/etheme_builder-styles.css' );

		if ( get_option( 'etheme_single_product_builder', false ) ) {
			wp_enqueue_style( 'etheme_customizer_frontend_single_product_css', ET_CORE_URL.'app/models/customizer/frontend/css/etheme_global-single-styles.css' );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'etheme_customizer_frontend_rtl_css', ET_CORE_URL.'app/models/customizer/frontend/css/etheme_builder-rtl-styles.css' );
		}

		// Register the script
		wp_register_script( 'etheme_customizer_frontend_js', ET_CORE_URL.'app/models/customizer/frontend/js/frontend-script.min.js' );

		// Localize the script with new data
		$core = array(
			'ajaxurl' 			 	 =>	admin_url( 'admin-ajax.php' ),
			'noSuggestionNotice' 	 =>	__( 'No results were found.', 'xstore-core' ),
			'woocommerce' 		 	 =>	class_exists('WooCommerce'),
			'header_builder' 	 	 =>	get_option( 'etheme_header_builder', false ),
			'single_product_builder' =>	get_option('etheme_single_product_builder', false)
		);

		wp_localize_script( 'etheme_customizer_frontend_js', 'etCoreConfig', $core );

		// Enqueued script with localized data.
		wp_enqueue_script( 'etheme_customizer_frontend_js', array('etheme') );


	}

	/**
	 * Construct the class.
	 *
	 * @since 1.4.4
	 */
	public function customizer_init() {

		// Include files
		// if ( ! is_customize_preview() ) {
		// 	return;
		// }

		// Run builder
		$this->get_model()->_run();
	}

}
