<?php  
	/**
	 * The template created for displaying header sign in options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section header-sign-in
	Kirki::add_section( 'header-sign-in', array(
	    'title'          => esc_html__( 'Sign in', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-admin-users'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'top_links',
			'label'       => esc_html__( 'Sign In link position', 'xstore' ),
			'description' => esc_html__( 'Choose the area where you want to display “Sign In” in the header or disable it at all.', 'xstore'),
			'section'     => 'header-sign-in',
			'default'     => 'header',
			'choices'     => array(
				'header'   => esc_html__( 'Header', 'xstore' ),
                'tb-left'  => esc_html__( 'Top bar left', 'xstore' ),
                'tb-right' => esc_html__( 'Top bar right', 'xstore' ),
                false      => esc_html__( 'Disable', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'sign_in_type',
			'label'       => esc_html__( 'Sign In type', 'xstore' ),
			'description' => esc_html__( 'Choose the area where you want to display “Sign In” in the header or disable it at all.', 'xstore'),
			'section'     => 'header-sign-in',
			'default'     => 'text',
			'choices'     => array(
				'text'      => esc_html__( 'Text', 'xstore' ),
                'text_icon' => esc_html__( 'Icon with text', 'xstore' ),
                'icon'      => esc_html__( 'Icon', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'top_links',
					'operator' => '!=',
					'value'    => false,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'sign_in_text',
			'label'    => esc_html__( 'Custom text for sign in', 'xstore' ),
			'description' => esc_html__( 'Text to display instead of the default one for the Sign In link. Default - "Sign In or create an account". Visible only if a user is not logged in. For logged in users the text is changed to "My Account" by default.', 'xstore'),
			'section'  => 'header-sign-in',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'top_links',
					'operator' => '!=',
					'value'    => false,
				),
				array(
					'setting'  => 'sign_in_type',
					'operator' => '!=',
					'value'    => 'icon',
				),
			),
		) );
		
?>