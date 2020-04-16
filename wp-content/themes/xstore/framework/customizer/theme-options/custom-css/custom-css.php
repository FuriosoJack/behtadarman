<?php  
	/**
	 * The template created for displaying custom css options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section style-custom_css
	Kirki::add_section( 'style-custom_css', array(
	    'title'          => esc_html__( 'Theme Custom CSS', 'xstore' ),
	    'description' => esc_html__( 'Once you\'ve isolated a part of theme that you\'d like to change, enter your CSS code to the fields below. Do not add JS or HTML to the fields. Custom CSS, entered here, will override a theme CSS. In some cases, the !important tag may be needed.', 'xstore' ),
	    'icon' => 'dashicons-admin-customizer',
	    'priority' => $priorities['custom-css']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'code',
			'settings'    => 'custom_css_global',
			'label'       => esc_html__( 'Global Custom CSS', 'xstore' ),
			'section'     => 'style-custom_css',
			'default'     => '',
			'choices'     => array(
				'language' => 'css',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'code',
			'settings'    => 'custom_css_desktop',
			'label'       => esc_html__( 'Custom CSS for desktop (992px+)', 'xstore' ),
			'section'     => 'style-custom_css',
			'default'     => '',
			'choices'     => array(
				'language' => 'css',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'code',
			'settings'    => 'custom_css_tablet',
			'label'       => esc_html__( 'Custom CSS for tablet (768px - 991px)', 'xstore' ),
			'section'     => 'style-custom_css',
			'default'     => '',
			'choices'     => array(
				'language' => 'css',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'code',
			'settings'    => 'custom_css_wide_mobile',
			'label'       => esc_html__( 'Custom CSS for mobile landscape (481px - 767px)', 'xstore' ),
			'section'     => 'style-custom_css',
			'default'     => '',
			'choices'     => array(
				'language' => 'css',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'code',
			'settings'    => 'custom_css_mobile',
			'label'       => esc_html__( 'Custom CSS for mobile (0 - 480px)', 'xstore' ),
			'section'     => 'style-custom_css',
			'default'     => '',
			'choices'     => array(
				'language' => 'css',
			),
		) );

?>