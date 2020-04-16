<?php  
	/**
	 * The template created for displaying top bar options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section top-bar
	Kirki::add_section( 'top-bar', array(
	    'title'          => esc_html__( 'Top bar', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-arrow-up-alt'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'top_bar',
			'label'       => esc_html__( 'Enable top bar', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the top bar.', 'xstore' ),
			'section'     => 'top-bar',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'top_bar_bg',
			'label'       => esc_html__( 'Top bar background', 'xstore' ),
			'description' => esc_html__( 'Controls the top bar background.', 'xstore' ),
			'section'     => 'top-bar',
			'default'     => array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => '',
				'background-position'   => '',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.top-bar',
				),
			),
			'active_callback' => array(
				array(
					'setting'  => 'top_bar',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'top_bar_color',
			'label'       => esc_html__( 'Top bar text color', 'xstore' ),
			'description' => esc_html__( 'Controls the top text color scheme.', 'xstore'),
			'section'     => 'top-bar',
			'default'     => 'dark',
			'choices'     => $text_color_scheme,
			'active_callback' => array(
				array(
					'setting'  => 'top_bar',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'top_panel',
			'label'       => esc_html__( 'Enable top panel', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the top panel opened by click on an arrow at the middle of the top bar. You can add the Top panel content at the Appearance > Widgets > Top panel.', 'xstore' ),
			'section'     => 'top-bar',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'top_bar',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );
?>