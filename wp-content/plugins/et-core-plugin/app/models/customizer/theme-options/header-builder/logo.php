<?php 
	/**
	 * The template created for displaying header logo element options
	 *
	 * @version 1.0.2
	 * @since 1.4.0
	 * last changes in 1.5.5
	 */

	// section logo
	Kirki::add_section( 'logo', array(
	    'title'          => esc_html__( 'Logo', 'xstore-core' ),	    
	    'panel'          => 'header-builder',
	    'icon' => 'dashicons-format-image'
	    //'priority'       => 160,
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'logo_content_separator',
			'section'     => 'logo',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// logo_img
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'logo_img_et-desktop',
			'label'       => esc_html__( 'Site logo', 'xstore-core' ),
			'description' => esc_html__( 'Upload logo image for the main header area.', 'xstore-core' ),
			'section'     => 'logo',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
		) );

		// retina_logo_img
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'retina_logo_img_et-desktop',
			'label'       => esc_html__( 'Retina logo', 'xstore-core' ),
			'description' => esc_html__( 'Upload retina logo image for the main header area.', 'xstore-core' ),
			'section'     => 'logo',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
		) );

		// go_to_sticky_logo 
		Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'custom',
	        'label'       => $strings['label']['sticky_logo'],
	        'description' => $strings['description']['sticky_logo'],
	        'settings'    => 'go_to_section'.$index++,
	        'section'     => 'logo',
	        'default'     => '<span class="et_edit" data-section="header_sticky_content_separator" style="padding: 5px 7px; border-radius: var(--sm-border-radius); background: #222; color: #fff; ">' . $strings['label']['sticky_logo'] . '</span>',
	    ) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'logo_style_separator',
			'section'     => 'logo',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// logo_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'logo_align_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'logo',
			'default'     => 'center',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-logo.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'align-start',
					'value' => 'start'
				),
				array(
					'element'  => '.et_b_header-logo.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'align-center',
					'value' => 'center'
				),
				array(
					'element'  => '.et_b_header-logo.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'align-end',
					'value' => 'end'
				),
			)
		) );

		// logo_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'logo_align_et-mobile',
			'label'       => $strings['label']['alignment'],
			'section'     => 'logo',
			'default'     => 'center',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-logo.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'mob-align-start',
					'value' => 'start'
				),
				array(
					'element'  => '.et_b_header-logo.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'mob-align-center',
					'value' => 'center'
				),
				array(
					'element'  => '.et_b_header-logo.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'mob-align-end',
					'value' => 'end'
				),
			)
		) );

		// logo_width
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'logo_width_et-desktop',
			'label'       => esc_html__( 'Logo width (px)', 'xstore-core' ),
			'section'     => 'logo',
			'default'     => 320,
			'choices'     => array(
				'min'  => '20',
				'max'  => '1000',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-logo.et_element-top-level img',
					'property' => 'width',
					'units' => 'px'
				)
			)
		) );

		// logo_width
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'logo_width_et-mobile',
			'label'       => esc_html__( 'Logo width (px)', 'xstore-core' ),
			'section'     => 'logo',
			'default'     => 320,
			'choices'     => array(
				'min'  => '20',
				'max'  => '1000',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-logo.et_element-top-level img',
					'property' => 'width',
					'units' => 'px'
				)
			)
		) );

		// logo_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'logo_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'logo',
			'default'     => $box_models['empty'],
			'output' => array(
				array(
					'element' => '.et_b_header-logo.et_element-top-level'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_b_header-logo.et_element-top-level')
		) );

		// logo_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'logo_box_model_et-mobile',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'logo',
			'default'     => $box_models['empty'],
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-logo.et_element-top-level'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.mobile-header-wrapper .et_b_header-logo.et_element-top-level')
		) );

		// logo_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'logo_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'logo',
			'default'     => 'none',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-logo.et_element-top-level',
					'property' => 'border-style'
				)
			)
		) );

		// logo_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'logo_border_color_custom_et-desktop',
			'label'       => $strings['label']['border_color'],
			'description' => $strings['description']['border_color'],
			'section'     => 'logo',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-logo.et_element-top-level',
					'property' => 'border-color',
				),
			),
		) );
?>