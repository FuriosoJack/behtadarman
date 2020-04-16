<?php  
	/**
	 * The template created for displaying logo section
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section logo
	Kirki::add_section( 'logo', array(
	    'title'       => esc_html__( 'Logo', 'xstore' ),
	    'panel' => 'header',
	    'icon'		  => 'dashicons-format-image',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'logo',
			'label'       => esc_html__( 'Logo image', 'xstore' ),
			'description' => esc_html__( 'Upload logo image for the main header area.', 'xstore' ),
			'section'     => 'logo',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'logo_fixed',
			'label'       => esc_html__( 'Logo image for fixed header', 'xstore' ),
			'description' => esc_html__( 'Upload logo image for the fixed header.', 'xstore' ),
			'section'     => 'logo',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'logo_width',
			'label'       => esc_html__( 'Logo max width', 'xstore' ),
			'description' => esc_html__( 'Controls the max width of the logo. In pixels.', 'xstore' ),
			'section'     => 'logo',
			'default'     => 200,
			'choices'     => array(
				'min'  => 50,
				'max'  => 500,
				'step' => 1,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-logo img',
					'property' => 'max-width',
					'units' => 'px'
				)
			)
		) );
?>