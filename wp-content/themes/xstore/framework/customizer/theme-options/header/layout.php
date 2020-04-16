<?php  
	/**
	 * The template created for displaying header layout options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section header-layout
	Kirki::add_section( 'header-content', array(
	    'title'          => esc_html__( 'Header layout', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-schedule',
	    'priority' => $priorities['header']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'header_type',
			'label'       => esc_html__( 'Header Type', 'xstore' ),
			'description' => esc_html__( 'Choose the most suitable header design for you. Some of the headers have Custom area where you can use HTML or static block shortcode to display custom content in the header. The position of the Custom HTML area depends on header design.', 'xstore'),
			'section'     => 'header-content',
			'default'     => 'xstore',
			'choices'     => array(
				'xstore'   => ETHEME_CODE_IMAGES . 'headers/xstore.jpg',
				'xstore2'   => ETHEME_CODE_IMAGES . 'headers/xstore2.jpg',
				'center2'   => ETHEME_CODE_IMAGES . 'headers/center2.jpg',
				'center3'   => ETHEME_CODE_IMAGES . 'headers/center3.jpg',
				'standard'   => ETHEME_CODE_IMAGES . 'headers/standard.jpg',
				'double-menu'   => ETHEME_CODE_IMAGES . 'headers/double-menu.jpg',
				'advanced'   => ETHEME_CODE_IMAGES . 'headers/advanced.jpg',
				'hamburger-icon'   => ETHEME_CODE_IMAGES . 'headers/hamburger-icon.jpg',
				'vertical'   => ETHEME_CODE_IMAGES . 'headers/vertical-icon.jpg',
				'vertical2'   => ETHEME_CODE_IMAGES . 'headers/vertical-icon-2.jpg',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'header_custom_block',
			'label'       => esc_html__( 'Header custom HTML', 'xstore' ),
			'description' => esc_html__( 'You can add text, HTML or static block shortcode to display additional content in the header. The position of the Custom HTML depends on header design. Do not include JS in the field.', 'xstore' ),
			'section'     => 'header-content',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'header_type',
					'operator' => 'in',
					'value'    => array( 'standard', 'advanced', 'double-menu' ),
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'header_banner_pos',
			'label' => esc_html__('Header banner position', 'xstore'),
 			'description'       => esc_html__( 'Controls position of the Header banner widget area where you can add some promo information.', 'xstore' ),
			'section'     => 'header-content',
			'default'     => 'disable',
			'choices'     => array(
				'top'    => esc_html__( 'Above header', 'xstore' ),
                'bottom' => esc_html__( 'Under header', 'xstore' ),
                'disable' => esc_html__( 'Disable', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_type',
					'operator' => '!=',
					'value'    => 'vertical',
				),
			)
		) );
	
?>