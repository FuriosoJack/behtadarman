<?php  
	/**
	 * The template created for displaying fixed header options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section fixed-header
	Kirki::add_section( 'fixed-header', array(
	    'title'          => esc_html__( 'Fixed header', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-paperclip'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'fixed_header',
			'label'       => esc_html__( 'Fixed header type', 'xstore' ),
			'description' => esc_html__( 'Choose the type of the fixed header appearance or disable it. Fixed - display fixed header once you scroll down, Smart - display fixed header once you scroll up.', 'xstore' ),
			'section'     => 'fixed-header',
			'default'     => '',
			'choices'     => array(
				'fixed' => esc_html__( 'Fixed', 'xstore' ),
	            'smart' => esc_html__( 'Smart', 'xstore' ),
	            ''      => esc_html__( 'Disable', 'xstore' ),
			),
		) );
		
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'fixed_header_color',
			'label'       => esc_html__( 'Fixed header text color', 'xstore' ),
			'description' => esc_html__( 'Controls the fixed header text/icons color scheme.', 'xstore' ),
			'section'     => 'fixed-header',
			'default'     => 'dark',
			'choices'     => $text_color_scheme,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'fixed_header_bg',
			'label'       => esc_html__( 'Fixed header background', 'xstore' ),
			'description' => esc_html__( 'Controls the fixed header background.', 'xstore' ),
			'section'     => 'fixed-header',
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
					'element' => '.fixed-header',
				),
			),
		) );
?>