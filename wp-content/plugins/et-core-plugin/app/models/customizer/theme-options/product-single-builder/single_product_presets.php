<?php  
	/**
	 * The template created for displaying single product presets
	 *
	 * @version 1.0.0
	 * @since 0.0.1
	 */

	// section single_product_presets
	Kirki::add_section( 'single_product_presets', array(
	    'title'          => esc_html__( 'Presets', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-schedule',
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'single_product_presets_content_separator',
			'section'     => 'single_product_presets',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// single_product_presets_package
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'single_product_presets_package_et-desktop',
			'label'       => esc_html__( 'Presets', 'xstore-core' ),
			'section'     => 'single_product_presets',
			'default'     => 'default',
			'priority'    => 10,
			'choices'     => array(
				'default'   => 'http://dev.8theme.com/stas/new/wp-content/themes/flatsome/inc/admin/options/header/img/header-default.svg',
				'default2' => 'http://dev.8theme.com/stas/new/wp-content/themes/flatsome/inc/admin/options/header/img/header-wide-nav.svg',
			),
		));
?>