<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ariafontxstore_settings_page() {
include ('font-setting.php');
}

function ariafontxstore_font_settings_page() {
//Aria Font Setting Functions
}
function ariafontxstore_create_menu() {
add_menu_page( __("آریا فونت", 'awp'), __("آریا فونت", 'awp'), 'manage_options',"ariafontxstore-settings", "ariafontxstore_settings_page" ,'dashicons-admin-customizer' );
add_submenu_page("ariafontxstore-settings", __("فونت آنکد", 'awp'), __("فونت آنکد", 'awp'), 'manage_options', "ariafontxstore-settings","ariafontxstore_settings_page");
add_action('admin_init', 'register_ariafontxstore_settings');
}
add_action('admin_menu', 'ariafontxstore_create_menu');
function register_ariafontxstore_settings(){
// Register our settings
register_setting('ariafontxstore_font_settings', 'ariafontxstore_font_settings');
}