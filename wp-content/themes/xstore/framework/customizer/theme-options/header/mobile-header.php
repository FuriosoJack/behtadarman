<?php  
	/**
	 * The template created for displaying mobile header options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section mobile-header
	Kirki::add_section( 'mobile-header', array(
	    'title'          => esc_html__( 'Mobile header', 'xstore' ),
	    'description' => esc_html__( 'Check settings only on real device.', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-smartphone'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_header_color',
			'label'       => esc_html__( 'Mobile header text color', 'xstore' ),
			'description' => esc_html__( 'Controls the mobile header text/icons color scheme.', 'xstore'),
			'section'     => 'mobile-header',
			'default'     => 'dark',
			'choices'     => $text_color_scheme,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'mobile_header_bg',
			'label'       => esc_html__( 'Mobile header background', 'xstore' ),
			'description' => esc_html__( 'Controls the mobile header background. Check it only on real device.', 'xstore' ),
			'section'     => 'mobile-header',
			'default'     => array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => '',
				'background-position'   => '',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-device .header-bg-block',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'mobile_header_padding',
			'label'       => esc_html__( 'Mobile header paddings', 'xstore' ),
			'description' => esc_html__( 'Controls the paddings of the mobile header area.', 'xstore' ),
			'section'     => 'mobile-header',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'output'      => array(
				array(
			      	'choice'      => 'padding-top',
			      	'element'     => '.mobile-device .header-wrapper header .container-wrapper, .mobile-device .header-wrapper.header-center2 .top-bar',
			      	'property'    => 'padding-top',
			    ),
			    array(
			      	'choice'      => 'padding-bottom',
			      	'element'     => '.mobile-device .header-wrapper header .container-wrapper, .mobile-device .header-wrapper.header-center2 .top-bar',
			      	'property'    => 'padding-bottom',
			    ),
			    array(
			      	'choice'      => 'padding-left',
			      	'element'     => '.mobile-device .header-wrapper header .container-wrapper, .mobile-device .header-wrapper.header-center2 .top-bar',
			      	'property'    => 'padding-left',
			    ),
			    array(
			      	'choice'      => 'padding-right',
					'element'     => '.mobile-device .header-wrapper header .container-wrapper, .mobile-device .header-wrapper.header-center2 .top-bar',
			      	'property'    => 'padding-right',
			    ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'mobile_account',
			'label'       => esc_html__( 'My account in mobile menu', 'xstore' ),
			'description' => esc_html__( 'Turn on to show my account link in the mobile menu area below the mobile menu links.', 'xstore'),
			'section'     => 'mobile-header',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'mobile_menu_logo_switcher',
			'label'       => esc_html__( 'Logo in mobile menu', 'xstore' ),
			'description' => esc_html__( 'Turn on to show site logo in the mobile menu area above the mobile menu links.', 'xstore'),
			'section'     => 'mobile-header',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'mobile_menu_logo',
			'label'       => esc_html__( 'Logo image', 'xstore' ),
			'description' => esc_html__( 'Upload logo image for the mobile menu header area.', 'xstore' ),
			'section'     => 'mobile-header',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_logo_switcher',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'mobile_promo_popup',
			'label'       => esc_html__( 'Promo popup in mobile menu', 'xstore' ),
			'description' => esc_html__( 'Turn on to show my Promo popup link in the mobile menu area below the mobile menu links.', 'xstore'),
			'section'     => 'mobile-header',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );
		
?>