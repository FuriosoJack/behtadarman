<?php 
	/**
	 * The template created for displaying header all departments element options
	 *
	 * @version 1.0.2
	 * @since 1.4.0
 	 * last changes in 1.5.5
	 */

	// section all departments
	Kirki::add_section( 'secondary_menu', array(
	    'title'          => esc_html__( 'All departments', 'xstore-core' ),
	    'panel'          => 'header-builder',
	    'icon' => 'dashicons-menu'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'secondary_menu_content_separator',
			'section'     => 'secondary_menu',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary_menu_visibility',
			'label'       => esc_html__( 'All departments visibility', 'xstore-core' ),
			'description' => esc_html__( 'Choose the way to show the all departments.', 'xstore-core' ),
			'section'     => 'secondary_menu',
			'default'     => 'on_hover',
			'choices'     => array(
				'opened' => esc_html__( 'Opened', 'xstore-core' ),
                'on_click' => esc_html__( 'Opened by click', 'xstore-core' ),
                'on_hover' => esc_html__( 'Opened on hover', 'xstore-core' ),
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et-secondary-visibility-opened',
					'value' => 'opened'
				),
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et-secondary-visibility-on_click',
					'value' => 'on_click'
				),
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et-secondary-visibility-on_hover',
					'value' => 'on_hover'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'secondary_menu_home',
			'label'       => esc_html__( 'For home page only', 'xstore-core' ),
			'description' => esc_html__( 'Turn on to keep the all departments opened only for the home page.', 'xstore-core' ),
			'section'     => 'secondary_menu',
			'default'     => '1',
			'active_callback' => array(
				array(
					'setting'  => 'secondary_menu_visibility',
					'operator' => '==',
					'value'    => 'opened',
				),
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et-secondary-on-home',
					'value' => true
				),
			)
		) );

		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'toggle',
		// 	'settings'    => 'secondary_menu_darkening',
		// 	'label'       => esc_html__( 'Darkening', 'xstore-core' ),
		// 	'description' => esc_html__( 'Turn on to show the semi-transparent dark veil over the content and highlight the menu only.', 'xstore-core' ),
		// 	'section'     => 'secondary_menu',
		// 	'default'     => 1,
		// 	'active_callback' => array(
		// 		array(
		// 			'setting'  => 'secondary_menu_visibility',
		// 			'operator' => 'in',
		// 			'value'    => array('on_click', 'on_hover'),
		// 		),
		// 	)
		// ) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'all_departments_text',
			'label'    => esc_html__( 'All departments text', 'xstore-core' ),
			'description' => esc_html__( 'This text will be displayed instead of the default "All departments" title for the all departments.', 'xstore-core' ),
			'section'  => 'secondary_menu',
			'default'  => esc_html__( 'All departments', 'xstore-core' ),
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.secondary-title > span',
					'function' => 'html',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary_menu_term',
			'label'       => $strings['label']['select_menu'],
			'section'     => 'secondary_menu',
			'choices'     => $post_types['menus'],
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'secondary_menu_term' => array(
					'selector'  => '.header-secondary-menu',
					'render_callback' => 'all_departments_menu_callback'
				),
			),
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'secondary_menu_title_style_separator',
			'section'     => 'secondary_menu',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-admin-customizer"></span> <span style="padding-left: 3px;">' . esc_html__( 'Title', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// secondary_title_fonts
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'secondary_title_fonts_et-desktop',
			'section'     => 'secondary_menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => 'regular',
				// 'font-size'      => '15px',
				// 'line-height'    => '1.5',
				'letter-spacing' => '0',
				// 'color'          => '#555',
				'text-transform' => 'inherit',
				// 'text-align'     => 'left',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
				),
			),
		) );

		// secondary_title_background_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary_title_background_color_custom_et-desktop',
			'label' 	  =>  esc_html__('Background color of the title', 'xstore-core'),
			'section'     => 'secondary_menu',
			'choices' 	  => array (
				'alpha' => true
			),
			'default' => '#ffffff',
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
					'property' => 'background-color',
				),
			),
		) );

		// secondary_title_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'secondary_title_color_et-desktop',
			'label'       => esc_html__( 'Title WCAG Color', 'xstore-core' ),
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'secondary_menu',
			'default' => '#000000',
			'choices'     => array(
				'setting' => 'secondary_title_background_color_custom_et-desktop',
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
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
					'property' => 'color'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'secondary_title_border_radius_et-desktop',
			'label'       => esc_html__( 'Title border radius', 'xstore-core' ),
			'description' => esc_html__( 'Controls the border radius of title.', 'xstore-core' ),
			'section'     => 'secondary_menu',
			'default'     => 0,
			'choices'     => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
					'property' => 'border-radius',
					'units' => 'px'
				)
			)
		) );

		// secondary_title_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'secondary_title_box_model_et-desktop',
			'label'       => esc_html__( 'Title сomputed box', 'xstore-core' ),
			'description' => esc_html__( 'You can select the margin, border-width and padding for title element.', 'xstore-core' ),
			'type'        => 'kirki-box-model',
			'section'     => 'secondary_menu',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '0px',
				'margin-left'         => '0px',
				'border-top-width'    => '0px',
				'border-right-width'  => '0px',
				'border-bottom-width' => '0px',
				'border-left-width'   => '0px',
				'padding-top'         => '15px',
				'padding-right'       => '10px',
				'padding-bottom'      => '15px',
				'padding-left'        => '10px',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
				),
			),
		) );

		// secondary_title_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary_title_border_et-desktop',
			'label'       => esc_html__( 'Title border style', 'xstore-core' ),
			'section'     => 'secondary_menu',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
					'property' => 'border-style'
				),
			),
		) );

		// secondary_title_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary_title_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Title border color', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'secondary_menu',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .secondary-title',
					'property' => 'border-color',
				),
			),
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'secondary_menu_content_dropdown_separator',
			'section'     => 'secondary_menu',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-editor-outdent"></span> <span style="padding-left: 3px;">' . esc_html__( 'Menu Dropdown', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// secondary_menu_content_fonts 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'secondary_menu_content_fonts_et-desktop',
			'section'     => 'secondary_menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => 'regular',
				// 'font-size'      => '15px',
				// 'line-height'    => '1.5',
				'letter-spacing' => '0',
				// 'color'          => '#555',
				'text-transform' => 'inherit',
				// 'text-align'     => 'left',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu > li > a',
				),
			),
		) );

		// secondary_menu_content_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'secondary_menu_content_zoom_et-desktop',
			'label'       => esc_html__( 'Dropdown content zoom (%)', 'xstore-core' ),
			'section'     => 'secondary_menu',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// secondary_menu_content_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'secondary_menu_content_box_model_et-desktop',
			'label'       => esc_html__( 'Dropdown computed box', 'xstore-core' ),
			'description' => esc_html__( 'You can select the margin, border-width and padding for dropdown element.', 'xstore-core' ),
			'type'        => 'kirki-box-model',
			'section'     => 'secondary_menu',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '0px',
				'margin-left'         => '0px',
				'border-top-width'    => '0px',
				'border-right-width'  => '1px',
				'border-bottom-width' => '1px',
				'border-left-width'   => '1px',
				'padding-top'         => '15px',
				'padding-right'       => '30px',
				'padding-bottom'      => '15px',
				'padding-left'        => '30px',
			),
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu',
				),
				array(
					'choice' => 'padding-left',
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu > li',
					'property' => 'padding-left'
				),
				array(
					'choice' => 'padding-right',
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu > li',
					'property' => 'padding-right'
				),
				array(
					'choice' => 'border-top-width',
					'element' => '.secondary-menu-wrapper .menu > .item-design-mega-menu .nav-sublist-dropdown, .secondary-menu-wrapper .menu .item-design-dropdown.menu-item-has-children:first-child .nav-sublist-dropdown',
					'property' => 'top',
					'value_pattern' => '-$'
				),
				array(
					'choice' => 'margin-right',
					'element' => '.et_column > .et_b_header-menu .secondary-menu-wrapper .menu',
					'property' => 'width',
					'value_pattern' => 'calc(100% - $)'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => array_merge(
	        	box_model_output('.et_b_header-menu .secondary-menu-wrapper .menu'),
	        	array(
	        		array(
						'choice' => 'padding-left',
						'element' => '.et_b_header-menu .secondary-menu-wrapper .menu > li',
						'type'     => 'css',
						'property' => 'padding-left'
					),
					array(
						'choice' => 'padding-right',
						'element' => '.et_b_header-menu .secondary-menu-wrapper .menu > li',
						'type'     => 'css',
						'property' => 'padding-right'
					),
					array(
						'choice' => 'border-top-width',
						'element' => '.secondary-menu-wrapper .menu > .item-design-mega-menu .nav-sublist-dropdown, .secondary-menu-wrapper .menu .item-design-dropdown.menu-item-has-children:first-child .nav-sublist-dropdown',
						'type'     => 'css',
						'property' => 'top',
						'value_pattern' => '-$'
					),
					array(
						'choice' => 'margin-right',
						'element' => '.et_column > .et_b_header-menu .secondary-menu-wrapper .menu',
						'type'     => 'css',
						'property' => 'width',
						'value_pattern' => 'calc(100% - $)'
					)
	        	)
	        ),
		) );

		// secondary_menu_content_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary_menu_content_border_et-desktop',
			'label'       => esc_html__( 'Dropdown border style', 'xstore-core' ),
			'section'     => 'secondary_menu',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu',
					'property' => 'border-style',
				),
			),
		) );

		// secondary_menu_content_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary_menu_content_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Dropdown border color', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'secondary_menu',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'default' => '#e1e1e1',
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-menu .secondary-menu-wrapper .menu',
					'property' => 'border-color',
				),
			),
		) );


?>