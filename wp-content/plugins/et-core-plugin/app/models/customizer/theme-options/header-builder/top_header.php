<?php  
	/**
	 * The template created for displaying top header options
	 *
	 * @version 1.0.2
	 * @since 1.4.0
	 * last changes in 1.5.5
	 */

	// section top_header
	Kirki::add_section( 'top_header', array(
	    'title'          => esc_html__( 'Top header', 'xstore-core' ),	    
	    'panel'          => 'header-builder',
	    'icon' => 'dashicons-arrow-up-alt'
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'top_header_content_separator',
			'section'     => 'top_header',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// top_header_wide
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'top_header_wide_et-desktop',
			'label'       => $strings['label']['wide_header'],
			'section'     => 'top_header',
			'default'     => '0',
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.header-top-wrapper .header-top > .et-row-container',
					'function' => 'toggleClass',
					'class' => 'et-container',
					'value' => false
				),
			),
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'top_header_style_separator',
			'section'     => 'top_header',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// top_header_height_desktop
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'top_header_height_et-desktop',
			'label'       => $strings['label']['min_height'],
			'section'     => 'top_header',
			'default'     => 40,
			'choices'     => array(
				'min'  => '0',
				'max'  => '300',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.header-top .et-wrap-columns, .header-top .widget_nav_menu .menu > li > a',
					'property' => 'min-height',
					'units' => 'px'
				),
				array(
					'element' => '.header-top .widget_nav_menu .menu > li > a, .header-top #lang_sel a.lang_sel_sel, .header-top .wcml-dropdown a.wcml-cs-item-toggle',
					'property' => 'line-height',
					'units' => 'px'
				)
			),
		) );

		// top_header_height_desktop
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'top_header_height_et-mobile',
			'label'       => $strings['label']['min_height'],
			'section'     => 'top_header',
			'default'     => 40,
			'choices'     => array(
				'min'  => '0',
				'max'  => '300',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-header-wrapper .header-top .et-wrap-columns, .mobile-header-wrapper .header-top .widget_nav_menu .menu > li > a',
					'property' => 'min-height',
					'units' => 'px'
				),
				array(
					'element' => '.mobile-header-wrapper .header-top .widget_nav_menu .menu > li > a, .mobile-header-wrapper .header-top #lang_sel a.lang_sel_sel, .mobile-header-wrapper .header-top .wcml-dropdown a.wcml-cs-item-toggle',
					'property' => 'line-height',
					'units' => 'px'
				)
			),
		) );

		// top_header_font_size
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'top_header_fonts_et-desktop',
			'label'       => $strings['label']['fonts'],
			'section'     => 'top_header',
			'default'     => array(
				// 'font-family'    => '',
				// 'variant'        => 'regular',
				// 'font-size'      => '15px',
				// 'line-height'    => '1.5',
				// 'letter-spacing' => '0',
				// 'color'          => '#555',
				'text-transform' => 'none',
				// 'text-align'     => 'left',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.header-top',
				),
			),
		) );

		// top_header_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'top_header_zoom_et-desktop',
			'label'       => $strings['label']['content_zoom'],
			'section'     => 'top_header',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-top',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// top_header_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'top_header_zoom_et-mobile',
			'label'       => $strings['label']['content_zoom'],
			'section'     => 'top_header',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .header-top',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// top_header_background
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'top_header_background_et-desktop',
			'label'       => $strings['label']['wcag_bg_color'],
			'description' => $strings['description']['wcag_bg_color'],
			'section'     => 'top_header',
			'default'     => array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'center center',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.header-top',
				),
			),
		) );

		// top_header_background
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'top_header_background_et-mobile',
			'label'       => $strings['label']['wcag_bg_color'],
			'description' => $strings['description']['wcag_bg_color'],
			'section'     => 'top_header',
			'default'     => array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => 'no-repeat',
				'background-position'   => 'center center',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-header-wrapper .header-top',
				),
			),
		) );

		// top_header_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'top_header_color_et-desktop',
			'label'       => $strings['label']['wcag_color'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'top_header',
			'default'     => '#000000',
			'choices'     => array(
				'setting' => 'top_header_background_et-desktop[background-color]',
				// 'maxHueDiff'          => 60,   // Optional.
				// 'stepHue'             => 15,   // Optional.
				// 'maxSaturation'       => 0.5,  // Optional.
				// 'stepSaturation'      => 0.1,  // Optional.
				// 'stepLightness'       => 0.05, // Optional.
				// 'precissionThreshold' => 6,    // Optional.
				// 'contrastThreshold'   => 4.5   // Optional.	
				'show'    => array(
					// 'auto'        => false,
					// 'custom'      => false,
					'recommended' => false,
				),	
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.header-top',
					'property' => 'color'
				)
			)
		) );

		// top_header_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'top_header_color_et-mobile',
			'label'       => $strings['label']['wcag_color'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'top_header',
			'default'     => '#000000',
			'choices'     => array(
				'setting' => 'top_header_background_et-mobile[background-color]',
				// 'maxHueDiff'          => 60,   // Optional.
				// 'stepHue'             => 15,   // Optional.
				// 'maxSaturation'       => 0.5,  // Optional.
				// 'stepSaturation'      => 0.1,  // Optional.
				// 'stepLightness'       => 0.05, // Optional.
				// 'precissionThreshold' => 6,    // Optional.
				// 'contrastThreshold'   => 4.5   // Optional.	
				'show'    => array(
					// 'auto'        => false,
					// 'custom'      => false,
					'recommended' => false,
				),	
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.mobile-header-wrapper .header-top',
					'property' => 'color'
				)
			)
		) );

		// top_header_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'top_header_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'top_header',
			'default'     => $box_models['empty'],
			'output'	  => array(
				array(
					'element' => '.header-top',
				),
				array(
					'choice' => 'margin-left',
					'element' => '.sticky-on .header-top',
					'property' => '--sticky-on-space-fix',
					'value_pattern' => 'calc(var(--sticky-on-space-fix2, 0px) + $)',
				),
				array(
					'choice' => 'margin-right',
					'element' => '.sticky-on .header-top',
					'property' => 'max-width',
					'value_pattern' => 'calc(100% - var(--sticky-on-space-fix, 0px) - $)'
				)
			), 
			'transport' => 'postMessage',
	        'js_vars'   => array_merge(
	        	box_model_output('.header-top'),
	        	array(
	        		array(
						'choice' => 'margin-left',
						'element' => '.sticky-on .header-top',
						'property' => '--sticky-on-space-fix',
						'type'     => 'css',
						'value_pattern' => 'calc(var(--sticky-on-space-fix2, 0px) + $)',
					),
					array(
						'choice' => 'margin-right',
						'element' => '.sticky-on .header-top',
						'property' => 'max-width',
						'type'     => 'css',
						'value_pattern' => 'calc(100% - var(--sticky-on-space-fix, 0px) - $)'
					)
	        	)
	        ),
		) );

		// top_header_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'top_header_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'top_header',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.header-top',
					'property' => 'border-style'
				)
			)
		) );

		// top_header_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'top_header_border_color_custom_et-desktop',
			'label'       => $strings['label']['border_color'],
			'description' => $strings['description']['border_color'],
			'section'     => 'top_header',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-top',
					'property' => 'border-color',
				),
			),
		) );
?>