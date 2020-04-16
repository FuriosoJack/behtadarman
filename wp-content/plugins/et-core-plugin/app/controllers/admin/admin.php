<?php
namespace ETC\App\Controllers\Admin;

use ETC\App\Controllers\Admin\Base_Controller;

/**
 * Admin controller.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models/Admin
 */
class Admin extends Base_Controller{

	/**
	 * Construct the class.
	 *
	 * @since   1.4.4
     * @version 1.0.1
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'product_meta_boxes' ) );
		add_action( 'admin_head', array( $this, 'add_mce_button' ) );
        add_action( 'admin_init', array( $this, 'pages_import' ) );
        add_action( 'admin_init', array( $this, 'fonts_uploader' ) );
	}

    function product_meta_boxes() {
        add_meta_box( 'woocommerce-product-videos', esc_html__( 'Product Video', 'xstore-core' ), 'etheme_woocommerce_product_video_box', 'product', 'side' );
    }

    /**
     * Require pages import.
     *
     * @since   2.0.1
     * @version 1.0.0
     */
    function pages_import() {
        require_once( ET_CORE_DIR . 'app/models/pages-import/import.php' );
    }

    /**
     * Require pages import.
     *
     * @since   2.2.3
     * @version 1.0.0
     */
    function fonts_uploader() {
        require_once( ET_CORE_DIR . 'app/models/fonts-uploader/etheme_fonts_uploader.php' );
    }

    function add_mce_button() {

        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) || ! defined( 'ETHEME_CODE_JS' ) ) {
            return;
        }

        if ( 'true' == get_user_option( 'rich_editing' ) ) {
            add_filter( 'mce_external_plugins', array( $this, 'etheme_add_tinymce_plugin' ) );
            add_filter( 'mce_buttons', array( $this, 'etheme_register_mce_button' ) );
        }
    }

    // Declare script for new button
    function etheme_add_tinymce_plugin($plugin_array ) {
        $plugin_array['et_mce_button'] = ETHEME_CODE_JS . 'mce.js';
        return $plugin_array;
    }

    // Register new button in the editor
    function etheme_register_mce_button( $buttons ) {
    	array_push( $buttons, 'et_mce_button' );
    	return $buttons;
    }
}
