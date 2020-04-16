<?php
/**
 *	Register routes 
 */
add_filter( 'etc/add/components', 'etc_routes' );
function etc_routes( $routes ) {

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'Customizer@hooks',
		'model' 		=> 'Customizer',
		'view' 			=> '',
		'config' 		=> '',
	);

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'Post_Types@hooks',
		'model' 		=> 'Post_Types',
		'view' 			=> 'Post_Types',
		'config' 		=> 'post-type',
	);

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'Shortcodes@hooks',
		'model' 		=> '',
		'view' 			=> '',
		'config' 		=> 'shortcodes',
	);	

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'VC@hooks',
		'model' 		=> '',
		'view' 			=> '',
		'config' 		=> 'vc',
	);

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'Widgets@hooks',
		'model' 		=> '',
		'view' 			=> '',
		'config' 		=> 'widgets',
	);

	if ( ! defined( 'IMPORT_DEBUG' ) ) {
		$routes[] = array(
			'type' 			=> 'admin',
			'controller' 	=> 'Import@hooks',
			'model' 		=> '',
			'view' 			=> '',
			'config' 		=> '',
		);
	}

	$routes[] = array(
		'type' 			=> 'admin',
		'controller' 	=> 'Admin@hooks',
		'model' 		=> '',
		'view' 			=> '',
		'config' 		=> '',
	);

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'General@hooks',
		'model' 		=> '',
		'view' 			=> '',
		'config' 		=> '',
	);

	$routes[] = array(
		'type' 			=> 'any',
		'controller' 	=> 'Elementor',
		'model' 		=> '',
		'view' 			=> 'Elementor',
		'config' 		=> 'elementor', 
	);

	return $routes;
}
