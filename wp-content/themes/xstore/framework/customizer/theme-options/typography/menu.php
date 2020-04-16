<?php  
	/**
	 * The template created for displaying menu options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section menu
	Kirki::add_section( 'menu', array(
	    'title'          => esc_html__( 'Menu', 'xstore' ),
	    'panel' => 'typography',
	    'icon' => 'dashicons-menu'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'menu_level_1',
			'label'       => esc_html__( 'Menu 1 level', 'xstore' ),
			'description' => esc_html__( 'Controls the hover color of the links of the first menu level.', 'xstore' ),
			'section'     => 'menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => '',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'color'          => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.menu-wrapper > .menu-main-container .menu > li > a, .mobile-menu-wrapper .menu li > a, .mobile-menu-wrapper .links li a, .secondary-title, .header-vertical .menu-wrapper > .menu-main-container .menu > li > a, .fullscreen-menu .menu > li > a, .fullscreen-menu .menu > li .inside > a, .menu-wrapper .menu > .header-search a, .mobile-menu-wrapper .my-account-link > a, .mobile-menu-wrapper .login-link > a',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_level_1_hover',
			'label'       => esc_html__( 'Menu 1 level (hover, active)', 'xstore' ),
			'description' => esc_html__( 'Controls the hover color of the links of the first menu level.', 'xstore' ),
			'section'     => 'menu',
			'default'     => '',
			'output'      => array(
				array(
					'element' => '.menu-wrapper .menu > li:hover > a, .menu-wrapper > .menu-main-container .menu > .current-menu-item > a, .header-vertical .menu-wrapper > .menu-main-container .menu > li:hover > a, .mobile-menu-wrapper .menu > li.current-menu-item > a, .fullscreen-menu .menu > li:hover > a, .fullscreen-menu .menu > li .inside > a:hover, .fullscreen-menu .menu > li.current-menu-item > a, .fullscreen-menu .menu > li.current-menu-item > .inside > a, .menu-wrapper .menu > .header-search:hover > a',
					'property' => 'color'
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'f_menu_level_1',
		    'label'       => esc_html__( 'Fixed menu links colors', 'xstore' ),
		    'section'     => 'menu',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover/Active', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
	    	'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'   => '.fixed-header .menu-wrapper .menu > li > a, .fixed-header .menu-wrapper .menu > .header-search a',
			      'property'  => 'color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'   => '.fixed-header .menu-wrapper .menu > li > a:hover, .fixed-header .menu-wrapper .menu > .current-menu-item > a, fixed-header .menu-wrapper .menu > .header-search a',
			      'property'  => 'color',
			    ),
			)
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Menu level 2', 'xstore' ) . '</div>',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'menu_level_2',
			// 'label'       => esc_html__( 'Menu 2 level', 'xstore' ),
			// 'description' => esc_html__( 'Controls the font of the second level of the main menu.', 'xstore'),
			'section'     => 'menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => '',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'color'          => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.menu-item-has-children .nav-sublist-dropdown .item-level-1 > a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li a, .secondary-menu-wrapper .item-design-dropdown.menu-item-has-children ul .item-level-1 a, .header-vertical .menu-wrapper .menu-main-container ul .item-level-1 > a',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_level_2_hover',
			'label'       => esc_html__( 'Color (hover)', 'xstore' ),
			'description' => esc_html__( 'Controls the hover color of the of the second menu level links.', 'xstore' ),
			'section'     => 'menu',
			'default'     => '',
			'output'      => array(
				array(
					'element' => '.fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li a:hover, .secondary-menu-wrapper .item-design-dropdown.menu-item-has-children ul .item-level-1 a:hover, .header-vertical .menu-wrapper .menu-main-container ul .item-level-1:hover > a',
					'property' => 'color'
				),
			),
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Menu level 3 / Dropdown', 'xstore' ) . '</div>',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'menu_level_3',
			// 'label'       => esc_html__( 'Menu 3 level and drop-downs hover (active)', 'xstore', 'xstore' ),
			// 'description' => esc_html__( 'Controls the hover and active color of the links of the third menu level and drop-downs.', 'xstore'),
			'section'     => 'menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => '',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'color'          => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.menu-item-has-children .nav-sublist-dropdown .item-level-2 > a, .menu-item-has-children .nav-sublist-dropdown .item-level-2 li > a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown .item-level-2 a, .header-vertical .menu-wrapper .menu-main-container ul .item-level-2 > a, .item-design-mega-menu .nav-sublist-dropdown .nav-sublist li, .item-design-dropdown .nav-sublist-dropdown ul > li, .header-vertical .item-design-mega-menu .nav-sublist-dropdown ul > li',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_level_3_hover',
			'label'       => esc_html__( 'Menu 3 level and drop-downs hover (active)', 'xstore' ),
			'description' => esc_html__( 'Controls the hover and active color of the links of the third menu level and drop-downs.', 'xstore' ),
			'section'     => 'menu',
			'default'     => '',
			'output'      => array(
				array(
					'element' => '.menu-item-has-children .nav-sublist-dropdown .item-level-1 > a:hover, .menu-item-has-children .nav-sublist-dropdown .item-level-2 > a:hover, .menu-item-has-children .nav-sublist-dropdown .item-level-2.current-menu-item > a, .menu-item-has-children .nav-sublist-dropdown .item-level-2 li > a:hover, .menu-item-has-children .nav-sublist-dropdown .item-level-2 .current-menu-item > a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown .item-level-2 a:hover, .header-vertical .menu-wrapper .menu-main-container ul .item-level-2:hover > a, .item-design-mega-menu .nav-sublist-dropdown .nav-sublist li:hover, .item-design-dropdown .nav-sublist-dropdown ul > li:hover, .header-vertical .item-design-mega-menu .nav-sublist-dropdown ul > li:hover, .item-design-dropdown .nav-sublist-dropdown ul > li.current-menu-item > a',
					'property' => 'color'
				),
			),
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'separator'.$sep++,
			'section'     => 'menu',
			'default'     => '<div style="'.$sep_style.'">' . esc_html__( 'Mobile menu', 'xstore' ) . '</div>',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'mobile-links-fonts',
			'label'       => esc_html__( 'Typography for mobile links', 'xstore' ),
			'section'     => 'menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => '',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'text-transform' => 'none',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-menu-wrapper .menu li > a, .mobile-menu-wrapper .menu > li .sub-menu li a, .mobile-menu-wrapper .links li a, .mobile-menu-wrapper .my-account-link > a, .mobile-menu-wrapper .login-link > a',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'mobile-links-colors',
		    'label'       => esc_html__( 'Mobile links colors', 'xstore' ),
		    'section'     => 'menu',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover/Active', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		    ),
	    	'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'   => '.mobile-menu-wrapper .menu li > a, 
                        .mobile-menu-wrapper .menu > li > .open-child, 
                        .mobile-menu-wrapper .menu > li .sub-menu li a, 
                        .mobile-menu-wrapper .links li a, 
                        .mobile-menu-wrapper .menu-back a,
                        .mobile-menu-wrapper .mobile-sidebar-widget.etheme_widget_socials a, 
                        .mobile-menu-wrapper .menu > li .open-child:before, 
                        .mobile-menu-wrapper .my-account-link > a, 
                        .mobile-menu-wrapper .login-link > a',
			      'property'  => 'color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'   => '.mobile-menu-wrapper .container .menu > li:hover > .open-child,
                        .mobile-menu-wrapper .menu > li.current_page_item > a, 
                        .mobile-menu-wrapper .menu > li .sub-menu li.current_page_item > a, 
                        .mobile-menu-wrapper .links li.current_page_item > a, 
                        .mobile-menu-wrapper .menu > li .sub-menu .menu-show-all a,
                        .mobile-menu-wrapper .menu li.current_page_item > .open-child:before, 
                        .mobile-menu-wrapper .menu li.current-menu-item > a, 
                        .mobile-menu-wrapper .menu > li .sub-menu .current-menu-item > a',
			      'property'  => 'color',
			    ),
		  	),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile-search-colors',
			'label'       => esc_html__( 'Search color', 'xstore' ),
			'section'     => 'menu',
			'default'     => '',
			'output'      => array(
				array(
					'element' => '.mobile-menu-wrapper .header-search.act-default .search-btn,
                        .mobile-menu-wrapper .header-search [role="searchform"] .btn,
                        .mobile-menu-wrapper .header-search.act-default input[type="text"],
                        .mobile-menu-wrapper .header-search.act-default input[type="text"]::-webkit-input-placeholder',
					'property' => 'color'
				),
			),
		) );

		
?>