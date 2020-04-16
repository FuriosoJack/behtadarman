<?php
/**
 * Zhaket Smart Updater
 *
 * Plugin Name:  Zhaket Smart Updater
 * Description:  Zhaket Smart Updater, an unique tool for instant update product purchases from zhaket.com. Zhaket is difference...
 * Version:      1.2.4
 * Plugin URI:   https://landing.zhaket.com/festival/zhaket-smart-updater/
 * Author:       zhaket
 * Author URI:   https://zhaket.com
 * Requires at least: 4.6
 * Tested up to: 5.3.2
 * Text Domain:  zhaket-updater
 * Domain Path:  /languages/
 * Requires PHP: 5.6
 */


defined('ABSPATH') || exit ("no access");

define('ZhUpClient_plugin_dir', plugin_dir_path(__FILE__));
define('ZhUpClient_plugin_url', plugin_dir_url(__FILE__));
define('ZhUpClient_plugin_name', plugin_basename(__DIR__));
define('ZhUpClient_plugin_admin_style', ZhUpClient_plugin_url . 'assets/css/');
define('ZhUpClient_plugin_admin_js', ZhUpClient_plugin_url . 'assets/js/');
define('zhaket_a_link','<a href="https://zhaket.com">zhaket.com</a>');
define('help_video','<script type="text/JavaScript" src="https://hwp.ir/zhkupdater"></script>');

spl_autoload_register(function ($class){
    $file=ZhUpClient_plugin_dir.'inc/'.strtolower($class).'.php';
    if (file_exists($file)) require_once($file);
},false);

add_action('in_admin_header', array('Admin_Notice', 'general_notice'), 2);

if (Admin_Notice::php_version_status() && Admin_Notice::ionCube_active()){
    ZhUpClient::instance();
//    ZhUp_installer::get_instance();
    Zhaket_options::instance();

    register_activation_hook(__FILE__, array('ZhUpClient', 'install'));
    register_deactivation_hook(__FILE__, array('ZhUpClient', 'deactivate'));

    if(!get_option('zhupclient_correct_install',false)){
        if (!get_option('zhupclient_ver',false))
            ZhUpClient::install();
        update_option('zhupclient_correct_install',true);
    }
}