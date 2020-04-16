<?php  
	/**
	 * The template created for displaying back to top options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section back-2-top
	Kirki::add_section( 'back-2-top', array(
	    'title'          => esc_html__( 'Back to top button', 'xstore' ),
	    'panel' => 'footer',
	    'icon' => 'dashicons-admin-collapse dashicons-rotate90'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'to_top',
			'label'       => esc_html__( '"Back To Top" button', 'xstore' ),
			'description' => esc_html__( 'Turn on to have back to top button at the right bottom of the page.', 'xstore' ),
			'section'     => 'back-2-top',
			'default'     => 1,
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.back-top',
					'function' => 'toggleClass',
					'class' => 'dt-hide',
					'value' => false
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'to_top_mobile',
			'label'       => esc_html__( '"Back To Top" button on mobile', 'xstore' ),
			'description' => esc_html__( 'Turn on to have back to top button on mobile.', 'xstore' ),
			'section'     => 'back-2-top',
			'default'     => 1,
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.back-top',
					'function' => 'toggleClass',
					'class' => 'mob-hide',
					'value' => false
				),
			),
		) );

?>