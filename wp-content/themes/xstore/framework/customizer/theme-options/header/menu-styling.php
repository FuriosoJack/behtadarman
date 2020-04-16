<?php  
	/**
	 * The template created for displaying menu styling options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section menu-styling
	Kirki::add_section( 'menu-styling', array(
	    'title'          => esc_html__( 'Menu styling', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-admin-customizer'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu_align',
			'label'       => esc_html__( 'Menu links align', 'xstore' ),
			'description' => esc_html__( 'Choose the alignment of the menu', 'xstore'),
			'section'     => 'menu-styling',
			'default'     => 'center',
			'choices'     => array(
				'center' => esc_html__( 'Center', 'xstore' ),
                'left'   => esc_html__( 'Left', 'xstore' ),
                'right'  => esc_html__( 'Right', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'nav-menu-bg',
			'label'       => esc_html__( 'Menu background color', 'xstore' ),
			'description' => esc_html__( 'Controls the background color of the menu.', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_type',
					'operator' => 'in',
					'value'    => array( 'center3', 'standard', 'advanced' ),
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.header-wrapper .navigation-wrapper, .header-wrapper.header-center3 .navigation-wrapper, .header-wrapper.header-advanced .navigation-wrapper, .header-advanced .navigation-wrapper:before',
					'property' => 'background-color',
				),
				array(
					'element'  => '.header-wrapper.header-center3 .navigation-wrapper .menu-inner, .header-wrapper.header-center3.header-color-white .navigation-wrapper .menu-inner, .header-wrapper .navigation-wrapper .menu-inner',
					'property' => 'border-color',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'menu-background',
		    'label'       => esc_html__( 'Menu items background color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover/Active', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'  => '.menu-wrapper > .menu-main-container > .menu > li, .menu-wrapper > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li',
					'property' => 'background-color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'  => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .menu-wrapper .menu .header-search:hover, .menu-wrapper>.menu-main-container>.menu>li.current-menu-item',
					'property' => 'background-color',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu-border-style',
			'label'       => esc_html__( 'Menu items border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'none',
			'choices'     => $border_styles,
			'transport'	  => 'auto',
			'output' 	  => array(
				array(
					'element' => '.menu-wrapper  > .menu-main-container > .menu > li, .menu-wrapper  > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
					'property' => 'border-style'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'menu-border-width',
			'label'       => esc_html__( 'Menu items border width', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'border-top',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li, .menu-wrapper > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-top-width',
			    ),
			    array(
			      	'choice'      => 'border-bottom',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li, .menu-wrapper > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-bottom-width',
			    ),
			    array(
			      	'choice'      => 'border-left',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li, .menu-wrapper > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-left-width',
			    ),
			    array(
			      	'choice'      => 'border-right',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li, .menu-wrapper > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-right-width',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'menu-border-color',
		    'label'       => esc_html__( 'Menu items border color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'  => '.menu-wrapper > .menu-main-container > .menu > li, .menu-wrapper > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li',
					'property' => 'border-color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'  => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .menu-wrapper .menu .header-search:hover',
					'property' => 'border-color',
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'menu-links-border-radius',
			'label'       => esc_html__( 'Menu items border radius', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $border_radius,
			'choices'     => array(
				'labels' => $border_radius_labels,
			),
			'output'      => array(
				array(
			      	'choice'      => 'border-top-left-radius',
			      	'element'     => '.menu-wrapper  > .menu-main-container > .menu > li, .menu-wrapper  > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-top-left-radius',
			    ),
			    array(
			      	'choice'      => 'border-top-right-radius',
			      	'element'     => '.menu-wrapper  > .menu-main-container > .menu > li, .menu-wrapper  > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-top-right-radius',
			    ),
			    array(
			      	'choice'      => 'border-bottom-right-radius',
			      	'element'     => '.menu-wrapper  > .menu-main-container > .menu > li, .menu-wrapper  > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-bottom-right-radius',
			    ),
			    array(
			      	'choice'      => 'border-bottom-left-radius',
			      	'element'     => '.menu-wrapper  > .menu-main-container > .menu > li, .menu-wrapper  > .menu-main-container > .menu > .header-search, .fullscreen-menu .menu > li',
			      	'property'    => 'border-bottom-left-radius',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'menu-links-padding',
			'label'       => esc_html__( 'Menu items paddings', 'xstore' ),
			'description' => esc_html__( 'Controls the paddings of the menu items.', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'output'      => array(
				array(
			      	'choice'      => 'padding-top',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li > a, .menu-wrapper > .menu-main-container > .menu > .header-search a, .menu-inner .menu-wrapper > .menu-main-container .menu > li > a',
			      	'property'    => 'padding-top',
			    ),
			    array(
			      	'choice'      => 'padding-bottom',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li > a, .menu-wrapper > .menu-main-container > .menu > .header-search a, .menu-inner .menu-wrapper > .menu-main-container .menu > li > a',
			      	'property'    => 'padding-bottom',
			    ),
			    array(
			      	'choice'      => 'padding-left',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li > a, .menu-wrapper > .menu-main-container > .menu > .header-search a, .menu-inner .menu-wrapper > .menu-main-container .menu > li > a',
			      	'property'    => 'padding-left',
			    ),
			    array(
			      	'choice'      => 'padding-right',
					'element'     => '.menu-wrapper > .menu-main-container > .menu > li > a, .menu-wrapper > .menu-main-container > .menu > .header-search a, .menu-inner .menu-wrapper > .menu-main-container .menu > li > a',
					'property'    => 'padding-right',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu-border-style-hover',
			'label'       => esc_html__( 'Menu items border style (hover)', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'none',
			'choices'     => $border_styles,
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover',
					'property' => 'border-style',
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'menu-border-width-hover',
			'label'       => esc_html__( 'Menu items border width (hover)', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'border-top',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover',
			      	'property'    => 'border-top-width',
			    ),
			    array(
			      	'choice'      => 'border-bottom',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover',
			      	'property'    => 'border-bottom-width',
			    ),
			    array(
			      	'choice'      => 'border-left',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover',
			      	'property'    => 'border-left-width',
			    ),
			    array(
			      	'choice'      => 'border-right',
			      	'element'     => '.menu-wrapper > .menu-main-container > .menu > li:hover, .menu-wrapper > .menu-main-container > .menu > .header-search:hover, .fullscreen-menu .menu > li:hover',
			      	'property'    => 'border-right-width',
			    ),
			),
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu-styling',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Fixed header menu', 'xstore' ) . '</div>',
		) );

		// fixed header links 

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'f_menu-background',
		    'label'       => esc_html__( 'Menu items background color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'  => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
					'property' => 'background-color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'  => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .menu > .header-search:hover',
					'property' => 'background-color',
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'f_menu-border-style',
			'label'       => esc_html__( 'Menu items border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'none',
			'choices'     => $border_styles,
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
					'property' => 'border-style'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'f_menu-border-width',
			'label'       => esc_html__( 'Menu items border width', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
					'property' => 'border-width',
					'units' => 'px'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'f_menu-border-width',
			'label'       => esc_html__( 'Menu items border width', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'border-top',
			      	'element' => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-top-width',
			    ),
			    array(
			      	'choice'      => 'border-bottom',
			      	'element' => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-bottom-width',
			    ),
			    array(
			      	'choice'      => 'border-left',
			      	'element' => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-left-width',
			    ),
			    array(
			      	'choice'      => 'border-right',
			      	'element' => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-right-width',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'f_menu-border-color',
		    'label'       => esc_html__( 'Menu items border color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'  => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
					'property' => 'border-color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'  => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .header-search:hover',
					'property' => 'border-color',
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'f_menu-links-border-radius',
			'label'       => esc_html__( 'Menu items border radius', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $border_radius,
			'choices'     => array(
				'labels' => $border_radius_labels,
			),
			'output'      => array(
				array(
			      	'choice'      => 'border-top-left-radius',
			      	'element'     => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-top-left-radius',
			    ),
			    array(
			      	'choice'      => 'border-top-right-radius',
			      	'element'     => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-top-right-radius',
			    ),
			    array(
			      	'choice'      => 'border-bottom-right-radius',
			      	'element'     => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
			      	'property'    => 'border-bottom-right-radius',
			    ),
			    array(
			      	'choice'      => 'border-bottom-left-radius',
					'element'     => '.fixed-header .menu-wrapper .menu > li, .fixed-header .menu-wrapper .menu > .header-search, .fixed-header .menu-wrapper .header-search',
					'property'    => 'border-bottom-left-radius',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'f_menu-links-padding',
			'label'       => esc_html__( 'Menu items paddings', 'xstore' ),
			'description' => esc_html__( 'Controls the paddings of the menu items.', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'output'      => array(
				array(
			      	'choice'      => 'padding-top',
			      	'element'     => '.fixed-header .menu-wrapper > .menu-main-container > .menu > li > a, .fixed-header .menu-wrapper > .menu-main-container > .menu > li > .header-search a',
			      	'property'    => 'padding-top',
			    ),
			    array(
			      	'choice'      => 'padding-bottom',
			      	'element'     => '.fixed-header .menu-wrapper > .menu-main-container > .menu > li > a, .fixed-header .menu-wrapper > .menu-main-container > .menu > li > .header-search a',
			      	'property'    => 'padding-bottom',
			    ),
			    array(
			      	'choice'      => 'padding-left',
			      	'element'     => '.fixed-header .menu-wrapper > .menu-main-container > .menu > li > a, .fixed-header .menu-wrapper > .menu-main-container > .menu > li > .header-search a',
			      	'property'    => 'padding-left',
			    ),
			    array(
			      	'choice'      => 'padding-right',
					'element'     => '.fixed-header .menu-wrapper > .menu-main-container > .menu > li > a, .fixed-header .menu-wrapper > .menu-main-container > .menu > li > .header-search a',
					'property'    => 'padding-right',
			    ),
			),
		) );

		// hover styles 

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'f_menu-border-style-hover',
			'label'       => esc_html__( 'Menu items border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'none',
			'choices'     => $border_styles,
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .header-search:hover',
					'property' => 'border-style',
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'f_menu-border-width-hover',
			'label'       => esc_html__( 'Menu items border width (hover)', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'border-top',
			      	'element' => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .header-search:hover',
			      	'property'    => 'border-top-width',
			    ),
			    array(
			      	'choice'      => 'border-bottom',
			      	'element' => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .header-search:hover',
			      	'property'    => 'border-bottom-width',
			    ),
			    array(
			      	'choice'      => 'border-left',
			      	'element' => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .header-search:hover',
			      	'property'    => 'border-left-width',
			    ),
			    array(
			      	'choice'      => 'border-right',
			      	'element' => '.fixed-header .menu-wrapper .menu > li:hover, .fixed-header .menu-wrapper .header-search:hover',
			      	'property'    => 'border-right-width',
			    ),
			),
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu-styling',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Dropdown menus', 'xstore' ) . '</div>',
		) );

		// dropdown menus
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_dropdown_bg',
			'label'       => esc_html__( 'Dropdown background', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => '',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.nav-sublist-dropdown, .item-design-dropdown .nav-sublist-dropdown ul > li .nav-sublist ul',
					'property' => 'background-color',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_dropdown_border_color',
			'label'       => esc_html__( 'Dropdown border color', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => '',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.nav-sublist-dropdown, .secondary-menu-wrapper .nav-sublist-dropdown, .secondary-menu-wrapper .menu',
					'property' => 'border-color',
					'suffix' => '!important'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'menu_dropdown_links_bg',
		    'label'       => esc_html__( 'Dropdown links background color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover/Active', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'  => '.item-design-mega-menu .nav-sublist-dropdown .nav-sublist li, .item-design-dropdown .nav-sublist-dropdown ul > li, .header-vertical .item-design-mega-menu .nav-sublist-dropdown ul > li',
					'property' => 'background-color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'  => '.item-design-mega-menu .nav-sublist-dropdown .nav-sublist li:hover, .item-design-dropdown .nav-sublist-dropdown ul > li:hover, .header-vertical .item-design-mega-menu .nav-sublist-dropdown ul > li:hover, .item-design-dropdown .nav-sublist-dropdown ul > li.current-menu-item > a',
					'property' => 'background-color',
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_dropdown_divider',
			'label'       => esc_html__( 'Divider color', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => '',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.item-design-mega-menu .nav-sublist-dropdown .item-level-1.menu-item-has-children',
					'property' => 'border-color',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'menu_dropdown_links_padding',
			'label'       => esc_html__( 'Menu items paddings', 'xstore' ),
			'description' => esc_html__( 'Controls the paddings of the menu items in dropdown.', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'padding-top',
			      	'element'  => '.item-design-mega-menu .nav-sublist-dropdown > .container > ul',
			      	'property'    => 'padding-top',
			    ),
			    array(
			      	'choice'      => 'padding-bottom',
			      	'element'  => '.item-design-mega-menu .nav-sublist-dropdown > .container > ul',
			      	'property'    => 'padding-bottom',
			    ),
			    array(
			      	'choice'      => 'padding-left',
			      	'element'  => '.item-design-mega-menu .nav-sublist-dropdown > .container > ul',
			      	'property'    => 'padding-left',
			    ),
			    array(
			      	'choice'      => 'padding-right',
					'element'  => '.item-design-mega-menu .nav-sublist-dropdown > .container > ul',
					'property'    => 'padding-right',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu_dropdown_border_style',
			'label'       => esc_html__( 'Dropdown border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'solid',
			'choices'     => $border_styles,
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.nav-sublist-dropdown',
					'property' => 'border-style'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'menu_dropdown_border_width',
			'label'       => esc_html__( 'Dropdown border width', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'choice' => 'border-top',
					'element' => '.nav-sublist-dropdown',
					'property' => 'border-top-width',
				),
				array(
					'choice' => 'border-right',
					'element' => '.nav-sublist-dropdown',
					'property' => 'border-right-width',
				),
				array(
					'choice' => 'border-bottom',
					'element' => '.nav-sublist-dropdown',
					'property' => 'border-bottom-width',
				),
				array(
					'choice' => 'border-left',
					'element' => '.nav-sublist-dropdown',
					'property' => 'border-left-width',
				),
			)
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu-styling',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Mobile menu', 'xstore' ) . '</div>',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_bg',
			'label'       => esc_html__( 'Mobile menu items background color', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper, .mobile-menu-wrapper .menu > li .sub-menu',
					'property' => 'background-color'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_search_input_bg',
			'label'       => esc_html__( 'Background color for search button', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper .header-search [role="searchform"] .btn',
					'property' => 'background-color'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_search_input_active_bg',
			'label'       => esc_html__( 'Background color for search input', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper .header-search.act-default input[type="text"]',
					'property' => 'background-color'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_search_input_border_style',
			'label'       => esc_html__( 'Border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'solid',
			'choices' 	  =>  $border_styles,
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper .header-search.act-default .search-btn, .mobile-menu-wrapper .header-search.act-default input[type="text"]',
					'property' => 'border-style',
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'mobile_search_input_border_width',
			'label'       => esc_html__( 'Border width (px)', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper .header-search.act-default .search-btn, .mobile-menu-wrapper .header-search.act-default input[type="text"]',
					'property' => 'border-width',
					'units' => 'px'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_search_input_border_color',
			'label'       => esc_html__( 'Border color for search input', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper .header-search.act-default .search-btn, .mobile-menu-wrapper .header-search.act-default input[type="text"]',
					'property' => 'border-color'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_divider_bg',
			'label'       => esc_html__( 'Divider color', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.mobile-menu-wrapper .menu .menu-back a',
					'property' => 'border-color'
				),
			)
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu-styling',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Secondary menu', 'xstore' ) . '</div>',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary-title-background-color',
			'label'       => esc_html__( 'Title background color (default active color)', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.secondary-menu-wrapper .secondary-title',
					'property' => 'background-color'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary-title-border-color',
			'label'       => esc_html__( 'Title border color (default active color)', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.secondary-menu-wrapper .secondary-title',
					'property' => 'border-color'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'secondary-menu-background-image',
			'label'       => esc_html__( 'Secondary menu background', 'xstore' ),
			'description' => esc_html__( 'Background conrols are pretty complex - but extremely useful if properly used.', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => array(
				'background-color' => '',
				'background-image'      => '',
				'background-repeat'     => '',
				'background-position'   => '',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.secondary-menu-wrapper .menu',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary-menu-border-style',
			'label'       => esc_html__( 'Border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'solid',
			'choices'     => $border_styles,
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.secondary-menu-wrapper .menu',
					'property' => 'border-bottom-style',
				),
				array(
					'element' => '.secondary-menu-wrapper .menu, .secondary-title',
					'property' => 'border-left-style'
				),
				array(
					'element' => '.secondary-menu-wrapper .menu, .secondary-title',
					'property' => 'border-right-style'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'secondary-menu-border-width',
			'label'       => esc_html__( 'Border width', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $borders_empty,
			'choices'     => array(
				'labels' => $border_labels,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'choice' => 'border-top',
					'element' => '.secondary-menu-wrapper .menu, .secondary-title',
					'property' => 'border-top-width',
					'suffix' => '!important'
				),
				array(
					'choice' => 'border-right',
					'element' => '.secondary-menu-wrapper .menu, .secondary-title',
					'property' => 'border-right-width',
					'suffix' => '!important'
				),
				array(
					'choice' => 'border-bottom',
					'element' => '.secondary-menu-wrapper .menu, .secondary-title',
					'property' => 'border-bottom-width',
					'suffix' => '!important'
				),
				array(
					'choice' => 'border-left',
					'element' => '.secondary-menu-wrapper .menu, .secondary-title',
					'property' => 'border-left-width',
					'suffix' => '!important'
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary-menu-border-color',
			'label'       => esc_html__( 'Border color', 'xstore' ),
			'section'     => 'menu-styling',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.secondary-menu-wrapper .menu',
					'property' => 'border-color',
					'suffix' => '!important',
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'secondary-menu-padding',
			'label'       => esc_html__( 'Menu paddings', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'padding-top',
			      	'element' => '.secondary-menu-wrapper .menu',
			      	'property'    => 'padding-top',
			    ),
			    array(
			      	'choice'      => 'padding-bottom',
			      	'element' => '.secondary-menu-wrapper .menu',
			      	'property'    => 'padding-bottom',
			    ),
			    array(
			      	'choice'      => 'padding-left',
			      	'element' => '.secondary-menu-wrapper .menu',
			      	'property'    => 'padding-left',
			    ),
			    array(
			      	'choice'      => 'padding-right',
					'element' => '.secondary-menu-wrapper .menu',
					'property'    => 'padding-right',
			    ),
			),
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu-styling',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Secondary menu links', 'xstore' ) . '</div>',
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'secondary-links-background',
		    'label'       => esc_html__( 'Secondary links background color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element' => '.secondary-menu-wrapper .menu > li',
					'property' => 'background-color'
			    ),
			    array(
			      'choice'    => 'hover',
			      'element' => '.secondary-menu-wrapper .menu > li:hover',
					'property' => 'background-color'
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary-links-border-style',
			'label'       => esc_html__( 'Secondary links  border style', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 'solid',
			'choices'     => $border_styles,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'secondary-links-border-width',
			'label'       => esc_html__( 'Secondary links border width', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => 0,
			'choices'     => array(
				'min'  => 0,
				'max'  => 5,
				'step' => 1,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.secondary-menu-wrapper .menu > li > a',
					'property' => 'border-bottom-width',
					'units' => 'px'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'secondary-links-border-color',
		    'label'       => esc_html__( 'Secondary links border color', 'xstore' ),
		    'section'     => 'menu-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      	'choice'    => 'regular',
			      	'element' => '.secondary-menu-wrapper .menu > li > a',
					'property' => 'border-bottom-color'
			    ),
			    array(
			      	'choice'    => 'hover',
			      	'element' => '.secondary-menu-wrapper .menu > li:hover > a',
					'property' => 'border-bottom-color'
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'secondary-links-padding',
			'label'       => esc_html__( 'Secondary links paddings', 'xstore' ),
			'section'     => 'menu-styling',
			'default'     => $paddings_top_bottom_empty,
			'choices'     => array(
				'labels' => $padding_top_bottom_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      	'choice'      => 'padding-top',
			      	'element' 	  => '.secondary-menu-wrapper .menu > li > a',
			      	'property'    => 'padding-top',
			    ),
			    array(
			      	'choice'      => 'padding-bottom',
			      	'element' 	  => '.secondary-menu-wrapper .menu > li > a',
			      	'property'    => 'padding-bottom',
			    ),
			),
		) );


?>