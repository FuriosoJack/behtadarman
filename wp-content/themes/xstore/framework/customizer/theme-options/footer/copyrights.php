<?php  
	/**
	 * The template created for displaying copyright styling options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section copyright-styling
	Kirki::add_section( 'copyright-styling', array(
	    'title'          => esc_html__( 'Copyrights styling', 'xstore' ),
	    'panel' => 'footer',
	    'icon' => 'dashicons-nametag'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'copyrights_color',
			'label'       => esc_html__( 'Copyrights text color scheme', 'xstore' ),
			'description' => esc_html__( 'Choose copyrights text color scheme.', 'xstore' ),
			'section'     => 'copyright-styling',
			'default'     => 'dark',
			'choices'     => $text_color_scheme,
			// 'transport' => 'postMessage',
			// 'js_vars'     => array(
			// 	array(
			// 		'element'  => '.footer-bottom',
			// 		'function' => 'toggleClass',
			// 		'class' => 'text-color-dark',
			// 		'value' => 'dark'
			// 	),
			// 	array(
			// 		'element'  => '.footer-bottom',
			// 		'function' => 'toggleClass',
			// 		'class' => 'text-color-white',
			// 		'value' => 'white'
			// 	),
			// ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
		    'type'        => 'multicolor',
		    'settings'    => 'copyrights-links',
		    'label'       => esc_html__( 'Copyrights Links', 'xstore' ),
		    'description' => esc_html__( 'Choose copyrights links colors.', 'xstore' ),
		    'section'     => 'copyright-styling',
		    'choices'     => array(
		        'regular'    => esc_html__( 'Regular', 'xstore' ),
		        'hover'   => esc_html__( 'Hover', 'xstore' ),
		        'active'  => esc_html__( 'Active', 'xstore' ),
		    ),
		    'default'     => array(
		        'regular'    => '',
		        'hover'   => '',
		        'active'  => '',
		    ),
		    'transport' => 'auto',
		    'output'    => array(
			    array(
			      'choice'    => 'regular',
			      'element'   => '.footer-bottom.text-color-light a, .footer-bottom.text-color-dark a, .footer-bottom a',
			      'property'  => 'color',
			    ),
			    array(
			      'choice'    => 'hover',
			      'element'   => '.footer-bottom.text-color-light a:hover, .footer-bottom.text-color-dark a:hover, .footer-bottom a:hover',
			      'property'  => 'color',
			    ),
			    array(
			      'choice'    => 'active',
			      'element'   => '.footer-bottom.text-color-light a:active, .footer-bottom.text-color-dark a:active, .footer-bottom a:active',
			      'property'  => 'color',
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'copyrights_bg_color',
			'label'       => esc_html__( 'Copyrights Background Color', 'xstore' ),
			'description' => esc_html__( 'Controls the the copyrights background color.', 'xstore' ),
			'section'     => 'copyright-styling',
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
					'element' => '.footer-bottom, [data-mode="dark"] .footer-bottom',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'copyrights_padding',
			'label'       => esc_html__( 'Copyrights paddings', 'xstore' ),
			'description' => esc_html__( 'Controls the paddings for the copyright area. Leave empty to use default values.', 'xstore' ),
			'section'     => 'copyright-styling',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'choice'   => 'padding-top',
					'element'  => '.footer-bottom',
					'property' => 'padding-top'
				),
				array(
					'choice'   => 'padding-bottom',
					'element'  => '.footer-bottom',
					'property' => 'padding-bottom'
				),
				array(
					'choice'   => 'padding-left',
					'element'  => '.footer-bottom',
					'property' => 'padding-left'
				),
				array(
					'choice'   => 'padding-right',
					'element'  => '.footer-bottom',
					'property' => 'padding-right'
				),
			),
		) );

?>