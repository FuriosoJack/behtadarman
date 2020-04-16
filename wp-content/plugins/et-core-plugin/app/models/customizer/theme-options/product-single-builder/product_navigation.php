<?php  
	/**
	 * The template created for displaying single product navigation options 
	 *
	 * @version 1.0.0
	 * @since 0.0.1
	 */

	// section product_navigation
	Kirki::add_section( 'product_navigation', array(
	    'title'          => esc_html__( 'Navigation', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-sort',
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_navigation_content_separator',
			'section'     => 'product_navigation',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// product_navigation
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
	        'settings'    => 'product_navigation_et-desktop',
	        'label'       => esc_html__( 'Show navigation', 'xstore-core' ),
	        'section'     => 'product_navigation',
	        'default'     => 1,
		) );

		// product_navigation_box_shadow
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'settings'    => 'product_navigation_box_shadow_et-desktop',
		// 	'label'       => esc_html__( 'Box shadow', 'xstore-core' ),
		// 	'description' => esc_html__( 'Box-Shadow Options.', 'xstore-core' ),
		// 	'type'        => 'kirki-box-shadow',
		// 	'section'     => 'product_navigation',
		// 	'default'     => '0px 0px 0px 0px #000000',
		// 	'active_callback' => array(
		// 		array(
		// 			'setting'  => 'product_navigation_et-desktop',
		// 			'operator' => '==',
		// 			'value'    => 1,
		// 		),
		// 	),		
		// 	'transport' => 'refresh',
		// 	'output'      => array(
		// 		array(
		// 			'element'  => '.products-nav-btn',
		// 			'property' => 'box-shadow',
		// 		),
		// 	),
		// ) );
?>