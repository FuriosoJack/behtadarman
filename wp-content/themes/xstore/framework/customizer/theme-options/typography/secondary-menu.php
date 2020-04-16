<?php  
	/**
	 * The template created for displaying secondary menu options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section secondary-menu
	Kirki::add_section( 'secondary-menu', array(
	    'title'          => esc_html__( 'Secondary menu', 'xstore' ),
	    'panel' => 'typography',
	    'icon' => 'dashicons-editor-indent'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'secondary_title',
			'label'       => esc_html__( 'Secondary title color', 'xstore' ),
			'description' => esc_html__( 'Controls the font of the secondary menu title.', 'xstore' ),
			'section'     => 'secondary-menu',
			'default'     => '',
			'choices'     => array(
				'alpha' => true,
			),
			'output'    => array(
			    array(
			    	'element' => '.secondary-menu-wrapper .secondary-title',
			    	'property' => 'color'
			    )
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'secondary-menu_level_1',
			'label'       => esc_html__( 'Menu first level font', 'xstore' ),
			'description' => esc_html__( 'Controls the font of the first level of the secondary menu.', 'xstore' ),
			'section'     => 'secondary-menu',
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
					'element' => '.secondary-menu-wrapper .menu > li > a',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'secondary-menu_level_2',
			'label'       => esc_html__( 'Menu second level font', 'xstore' ),
			'description' => esc_html__( 'Controls the font of the second level of the secondary menu.', 'xstore' ),
			'section'     => 'secondary-menu',
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
					'element' => 'body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown .item-level-1 > a, body .secondary-menu-wrapper .nav-sublist-dropdown .menu-item-has-children.item-level-1 > a, body .secondary-menu-wrapper .nav-sublist-dropdown .menu-widgets .widget-title, body .secondary-menu-wrapper .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li a, body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown > .container > ul .item-level-1 > a',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'secondary-menu_level_3',
			'label'       => esc_html__( 'Menu third level', 'xstore' ),
			'description' => esc_html__( 'Controls the font of the third level of the secondary menu.', 'xstore' ),
			'section'     => 'secondary-menu',
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
					'element' => 'body .secondary-menu-wrapper .item-design-dropdown .nav-sublist-dropdown ul > li > a, body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown .item-link, body .secondary-menu-wrapper .nav-sublist-dropdown .menu-item-has-children .nav-sublist ul > li > a, body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown .nav-sublist a, body .secondary-menu-wrapper .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown ul > li > a',
				),
			),
		) );
		
?>