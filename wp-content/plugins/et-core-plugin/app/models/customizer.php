<?php
namespace ETC\App\Models;

use ETC\App\Models\Base_Model;

/**
 * Create customizer builder setup.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models
 */
class Customizer extends Base_Model {

    /**
     * Constructor
     */
    protected function __construct() {}

    function _run(){

    	if ( !class_exists('Kirki') ) return;

		/**
		 * Load customize-builder icons.
		 * 
		 * @since 1.0.0
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/icons.php' );

		/**
		 * Load customize-builder options callbacks.
		 * 
		 * @since 1.5
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/theme-options/global/callbacks.php' );

		if ( ! defined('ETHEME_CODE_CUSTOMIZER_IMAGES') ) return;

		/**
		 * Load customize-builder options.
		 * 
		 * @since 1.5
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/theme-options/global/global.php' );

		/**
		 * Load customize-builder options.
		 * 
		 * @since 1.0.0
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/theme-options/header-builder/global.php' );

		/**
		 * Load customize-builder options.
		 * 
		 * @since 1.5
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/theme-options/product-single-builder/global.php' );

		/**
		 * Load customize-builder options.
		 * 
		 * @since 1.4.4+
		 */
		// require_once( 'theme-options/product-archive-builder/global.php' );

		/**
		 * Load customize-builder.
		 * 
		 * @since 1.0.0
		 */
		require_once( ET_CORE_DIR . 'app/models/customizer/builder/class-customize-builder.php' );

    }
}