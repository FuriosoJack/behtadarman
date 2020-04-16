<?php
/**
 *	Register routes 
 */
add_filter( 'etc/add/elementor/widgets', 'etc_elementor_widgets_routes' );
function etc_elementor_widgets_routes( $routes ) {

	// let's make it in alphabetical sorting 

	$check_function = function_exists( 'etheme_get_option' );

	$routes[] = array(
		'ETC\App\Controllers\Elementor\General\Banner', // +
		// 'ETC\App\Controllers\Elementor\General\Blog',
		'ETC\App\Controllers\Elementor\General\Blog_Carousel', // +
		// 'ETC\App\Controllers\Elementor\General\Blog_List',
		// 'ETC\App\Controllers\Elementor\General\Blog_Timeline',
	);

	if( $check_function ){

		if ( etheme_get_option( 'enable_brands' ) ) {
			$routes[] = array(
				'ETC\App\Controllers\Elementor\General\Brands',
				// 'ETC\App\Controllers\Elementor\General\Brands_List',
			);
		}

	}

	$routes[] = array(
		// 'ETC\App\Controllers\Elementor\General\Carousel', //
		// 'ETC\App\Controllers\Elementor\General\Categories',
		// 'ETC\App\Controllers\Elementor\General\Categories_lists',
		// 'ETC\App\Controllers\Elementor\General\Category',
		'ETC\App\Controllers\Elementor\General\Contact_Form_7',
		// 'ETC\App\Controllers\Elementor\General\Countdown',
		// 'ETC\App\Controllers\Elementor\General\Fancy_Button',
		'ETC\App\Controllers\Elementor\General\Follow', // +
		'ETC\App\Controllers\Elementor\General\Google_Map',
		// 'ETC\App\Controllers\Elementor\General\Icon_Box',
		'ETC\App\Controllers\Elementor\General\Instagram', // +-
		// 'ETC\App\Controllers\Elementor\General\Looks',
		// 'ETC\App\Controllers\Elementor\General\Menu',
		// 'ETC\App\Controllers\Elementor\General\Mail_Chimp',
		'ETC\App\Controllers\Elementor\General\Menu_List', // +
		// 'ETC\App\Controllers\Elementor\General\Portfolio',
		// 'ETC\App\Controllers\Elementor\General\Portfolio_Recent',
		'ETC\App\Controllers\Elementor\General\Products', // +
		// 'ETC\App\Controllers\Elementor\General\Scroll_Text',
		'ETC\App\Controllers\Elementor\General\Slider', // +
		// 'ETC\App\Controllers\Elementor\General\Special_Offer',
		'ETC\App\Controllers\Elementor\General\Team_Member', // +
	);

	if ( $check_function ) {
		// if ( etheme_get_option( 'testimonials_type' ) ) {
			// $routes[] = array(
			// 	'ETC\App\Controllers\Elementor\General\Testimonials',
			// );
		// }
	}

	$routes[] = array(
		// 'ETC\App\Controllers\Elementor\General\Title',
		// 'ETC\App\Controllers\Elementor\General\Twitter',
	);

	return $routes;
}

/**
 *	Register modules 
 */
add_filter( 'etc/add/elementor/modules', 'etc_elementor_modules' );
function etc_elementor_modules( $modules ) {

	$modules['general'] = array(
		'class'	=>	'ETC\App\Controllers\Elementor\Modules\General',
		'class'	=>	'ETC\App\Controllers\Elementor\Modules\CSS',
	);

	return $modules;
}

/**
 *	Register controls 
 */
add_filter( 'etc/add/elementor/controls', 'etc_elementor_controls' );
function etc_elementor_controls( $controls ) {

	$controls['etheme-icon-control'] = array(
		'class'	=>	'ETC\App\Controllers\Elementor\Controls\Icon_Control',
	);

	return $controls;
}

/**
 *	Icon control
 */
add_filter( 'etc/add/elementor/control/icon', 'etc_elementor_icon_control' );
function etc_elementor_icon_control( $icon ) {

	$new_icon = array(
		'7-stroke'			=>	 '7 Stroke',
		'eicons'			=>	 'Eicons',
		'linea'				=>	 'Linea',
		'simple-line'		=>	 'Simple Line',
		'xstore-icons'		=>	 'XStore Icons',
	);


	return array_merge( $new_icon, $icon );
}
