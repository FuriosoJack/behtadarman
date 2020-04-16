<?php
/**
* Plugin Name: Persian xstore
* Plugin URI: https://ariawp.com
* Description: Persian settings for xstoreCore
* Version: 1.2
* Author: AriaWP
* Author URI: https://ariawp.com
* Text Domain: persian-xstore
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'kirki_fonts_standard_fonts', 'xstore_filter_standard_fonts', 99 );
function xstore_filter_standard_fonts( $standard_fonts ) {
  $standard_fonts = array(          
        	'iransans'  => array(
				'label' => 'IRANSans',
				'stack' => 'IRANSans, sans-serif, serif',
			),
			'iransansdn'  => array(
				'label' => 'iransansdn',
				'stack' => 'iransansdn, sans-serif, serif',
			),
		
			'iranyekan'  => array(
				'label' => 'iranyekan',
				'stack' => 'iranyekan, sans-serif, serif',
			),
			'Yekan'  => array(
				'label' => 'Yekan',
				'stack' => 'Yekan, sans-serif, serif',
			),
			'droidarabicnaskh'  => array(
				'label' => 'droidarabicnaskh',
				'stack' => 'droidarabicnaskh, sans-serif, serif',
			),
			'droidarabickufi'  => array(
				'label' => 'droidarabickufi',
				'stack' => 'droidarabickufi, sans-serif, serif',
			),
			'serif'      => array(
				'label' => 'Serif',
				'stack' => 'Georgia,Times,"Times New Roman",serif',
			),
			'sans-serif' => array(
				'label' => 'Sans Serif',
				'stack' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
			),
			'monospace'  => array(
				'label' => 'Monospace',
				'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
			),
  );

  return $standard_fonts;
}



include('inc/panel.php');
$options = get_option('ariafontxstore_font_settings');

$i = 1;
$activate = 0;
while ($i < 5){
	$fontnamecount = 'fontname' . $i;
	if(!empty($options[$fontnamecount])){
		$activate = $i;
	}
	if ($activate == 1) {
	function ariafontxstore_fa_scripts1() {
		global $options;
    	wp_enqueue_style( 'ariawp-font1', plugins_url( 'assets/css/' . esc_html( $options['fontname1'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontxstore_fa_scripts1', 999999);
	}
	if ($activate == 2) {
	function ariafontxstore_fa_scripts2() {
		global $options;
    	wp_enqueue_style( 'ariawp-font2', plugins_url( 'assets/css/' . esc_html( $options['fontname2'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontxstore_fa_scripts2', 999998);
	}
	if ($activate == 3) {
	function ariafontxstore_fa_scripts3() {
		global $options;
    	wp_enqueue_style( 'ariawp-font3', plugins_url( 'assets/css/' . esc_html( $options['fontname3'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontxstore_fa_scripts3', 999997);
	}
	if ($activate == 4) {
	function ariafontxstore_fa_scripts4() {
		global $options;
    	wp_enqueue_style( 'ariawp-font4', plugins_url( 'assets/css/' . esc_html( $options['fontname4'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontxstore_fa_scripts4', 999996);
	}
	$i++;
	$activate = 0;
}




?>