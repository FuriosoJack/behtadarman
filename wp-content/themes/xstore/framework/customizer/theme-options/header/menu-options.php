<?php  
	/**
	 * The template created for displaying menu options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section menu-options
	Kirki::add_section( 'menu-options', array(
	    'title'          => esc_html__( 'Menu', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-menu'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'smart_header_menu',
			'label'       => esc_html__( 'Smart menu', 'xstore' ),
			'description' => esc_html__( 'Controls the appearance of the toggle icon instead of the last menu items when there is no space to show the links in one line. Do not use if your menu is not too long.', 'xstore' ),
			'section'     => 'menu-options',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'hamburger-icon',
				),
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'vertical',
				),
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'vertical2',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'menu_full_width',
			'label'       => esc_html__( 'Mega menu full width', 'xstore' ),
			'description' => esc_html__( 'Turn on to make the mega menu wrapper full width and keep mega menu columns container in the middle of the screen.', 'xstore' ),
			'section'     => 'menu-options',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'hamburger-icon',
				),
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'vertical',
				),
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'vertical2',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'secondary_menu',
			'label'       => esc_html__( 'Secondary menu', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the additional vertical menu before the first menu item.', 'xstore'),
			'section'     => 'menu-options',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'secondary_menu_visibility',
			'label'       => esc_html__( 'Secondary menu visibility', 'xstore' ),
			'description' => esc_html__( 'Choose the way to show the secondary menu.', 'xstore' ),
			'section'     => 'menu-options',
			'default'     => 'on_hover',
			'choices'     => array(
				'opened' => esc_html__( 'Opened', 'xstore' ),
                'on_click' => esc_html__( 'Opened by click', 'xstore' ),
                'on_hover' => esc_html__( 'Opened on hover', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'secondary_menu',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'secondary_menu_home',
			'label'       => esc_html__( 'For home page only', 'xstore' ),
			'description' => esc_html__( 'Turn on to keep the secondary menu opened only for the home page.', 'xstore' ),
			'section'     => 'menu-options',
			'default'     => '1',
			'active_callback' => array(
				array(
					'setting'  => 'secondary_menu',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'secondary_menu_visibility',
					'operator' => '==',
					'value'    => 'opened',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'secondary_menu_darkening',
			'label'       => esc_html__( 'Darkening', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the semi-transparent dark veil over the content and highlight the menu only.', 'xstore' ),
			'section'     => 'menu-options',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'secondary_menu',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'secondary_menu_visibility',
					'operator' => 'in',
					'value'    => array('on_click', 'on_hover'),
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'all_departments_text',
			'label'    => esc_html__( 'All departments text', 'xstore' ),
			'description' => esc_html__( 'This text will be displayed instead of the default "All departments" title for the secondary menu.', 'xstore' ),
			'section'  => 'menu-options',
			'default'  => esc_html__( 'All departments', 'xstore' ),
			'active_callback' => array(
				array(
					'setting'  => 'secondary_menu',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );
		
?>