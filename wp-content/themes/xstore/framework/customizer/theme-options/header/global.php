<?php  
	/**
	 * The template created for enqueueing all files for header panel 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */

	$elements = array(
		'panel',
		'logo',
		'layout',
		'styles',
		'cart',
		'sign-in',
		'search',
		'menu-options',
		'menu-styling',
		'top-bar',
		'fixed-header',
		'mobile-header',
	);

	foreach ($elements as $key) {
		require_once apply_filters('etheme_file_url', ETHEME_CODE . 'customizer/theme-options/header/'.$key.'.php' );
	}

?>