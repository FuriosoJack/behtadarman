<?php 
	/**
	 * The template created for displaying header sharing options
	 *
	 * @since   1.5.0
	 * @version 1.0.1
	 * last changes in 1.5.5
	 */

	// section product_sharing
	Kirki::add_section( 'product_sharing', array(
	    'title'          => esc_html__( 'Sharing', 'xstore-core' ),
	    'panel' => 'single_product_builder',
	    'icon' => 'dashicons-share'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_sharing_content_separator',
			'section'     => 'product_sharing',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// product_sharing_type
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'product_sharing_type_et-desktop',
			'label'       => $strings['label']['type'],
			'section'     => 'product_sharing',
			'default'     => 'type1',
			'multiple'    => 1,
			'choices'     => array(
				'type1' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/header_socials/Social-icon-1.svg',
				'type2' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/header_socials/Social-icon-2.svg'
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'product_sharing_type_et-desktop' => array(
					'selector' => '.single-product-socials',
					'render_callback' => function() {
						return product_sharing_callback(0);
					}
				)
			)
		) );

		// mobile_menu_content
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'sortable',
			'label'       => $strings['label']['elements'],
			'section'     => 'product_sharing',
			'priority'    => 10,
			'settings'     => 'product_sharing_package_et-desktop',
			'default'	  => array(
				'facebook',
				'twitter',
				'tumblr',
				'linkedin',
			),
			'choices'      => array(
				'facebook' => esc_html__( 'Facebook', 'xstore-core' ),
				'twitter' => esc_html__( 'Twitter', 'xstore-core' ),
				'linkedin' => esc_html__( 'Linkedin', 'xstore-core' ),
				'houzz' => esc_html__( 'Houzz', 'xstore-core' ),
				'pinterest' => esc_html__( 'Pinterest', 'xstore-core' ),
				'tumblr' => esc_html__( 'Tumblr', 'xstore-core' ),
				'vk' => esc_html__( 'Vk', 'xstore-core' ),
				'whatsapp' => esc_html__( 'Whatsapp', 'xstore-core' ),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'product_sharing_package_et-desktop' => array(
					'selector' => '.single-product-socials',
					'render_callback' => function() {
						return product_sharing_callback(0);
					}
				)
			)
		) );

		// product_socials_label
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'product_socials_label_et-desktop',
			'label'       => $strings['label']['show_title'],
			'section'     => 'product_sharing',
			'default'     => 1,
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'product_socials_label_et-desktop' => array(
					'selector' => '.single-product-socials',
					'render_callback' => function() {
						return product_sharing_callback(0);
					}
				)
			)
		) );

		// product_socials_label_text
		Kirki::add_field( 'et_kirki_options', array (
			'type'     => 'text',
			'settings' => 'product_socials_label_text_et-desktop',
			'label'    => esc_html__( 'Share title', 'xstore-core' ),
			'section'  => 'product_sharing',
			'default'  => esc_html__( 'Share:', 'xstore-core' ),
			'active_callback' => array(
				array(
					'setting' => 'product_socials_label_et-desktop',
					'operator' => '==',
					'value' => '1'
				),
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => '.single-product-socials .socials-title',
					'function' => 'html',
				),
			)
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_sharing_style_separator',
			'section'     => 'product_sharing',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// product_sharing_content_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_sharing_content_alignment_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'product_sharing',
			'default'     => 'start',
			'choices'     => $choices['alignment_with_inherit'],
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => '.single-product-socials',
					'function' => 'toggleClass',
					'class' => 'justify-content-start',
					'value' => 'start'
				),
				array(
					'element'  => '.single-product-socials',
					'function' => 'toggleClass',
					'class' => 'justify-content-center',
					'value' => 'center'
				),
				array(
					'element'  => '.single-product-socials',
					'function' => 'toggleClass',
					'class' => 'justify-content-end',
					'value' => 'end'
				),
				array(
					'element'  => '.single-product-socials',
					'function' => 'toggleClass',
					'class' => 'justify-content-inherit',
					'value' => 'inherit'
				),
			),
		) );

		// product_sharing_label_proportion 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_sharing_label_proportion_et-desktop',
			'label'       => $strings['label']['size_proportion'],
			'section'     => 'product_sharing',
			'default'     => 1.1,
			'choices'     => array(
				'min'  => '0',
				'max'  => '5',
				'step' => '.1',
			),
			'active_callback' => array(
				array(
					'setting' => 'product_socials_label_et-desktop',
					'operator' => '==',
					'value' => '1'
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'body',
					'property' => '--single-product-socials-label-proportion',
				),
			),
		) );

		// product_sharing_elements_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_sharing_elements_zoom_et-desktop',
			'label'       => esc_html__( 'Icons zoom (%)', 'xstore-core' ),
			'section'     => 'product_sharing',
			'default'     => 80,
			'choices'     => array(
				'min'  => '30',
				'max'  => '250',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array (
				array(
					'element' => '.single-product-socials a',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				)
			)
		) );

		// product_sharing_color
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'select',
		// 	'settings'    => 'product_sharing_color_et-desktop',
		// 	'label'       => esc_html__( 'Color', 'xstore-core' ),
		// 	'section'     => 'product_sharing',
		// 	'default'     => 'current',
		// 	'choices'     => $choices['colors'],
		// 	'transport' => 'auto',
		// 	'output'      => array(
		// 		array(
		// 			'element' => '.single-product-socials a',
		// 			'property' => 'color',
		// 			'value_pattern' => 'var(--$-color)'
		// 		),
		// 	),
		// ) );

		// product_sharing_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_sharing_color_custom_et-desktop',
			'label'       => esc_html__( 'Color', 'xstore-core' ),
			'section'     => 'product_sharing',
			'choices' 	  => array (
				'alpha' => true
			),
			'default' => '#000',
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.single-product-socials a',
					'property' => 'color'
				),
			),
		) );

		// product_sharing_elements_spacing
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_sharing_elements_spacing_et-desktop',
			'label'       => esc_html__( 'Margin between elements (px)', 'xstore-core' ),
			'section'     => 'product_sharing',
			'default'     => 5,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.single-product-socials a',
					'property' => 'margin',
					'value_pattern' => '0 $px'
				)
			)
		) );

		// product_sharing_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_sharing_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'product_sharing',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '10px',
				'margin-left'         => '0px',
				'border-top-width'    => '0px',
				'border-right-width'  => '0px',
				'border-bottom-width' => '0px',
				'border-left-width'   => '0px',
				'padding-top'         => '0px',
				'padding-right'       => '0px',
				'padding-bottom'      => '0px',
				'padding-left'        => '0px',
			),
			'output'      => array(
				array(
					'element' => '.single-product-socials',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.single-product-socials')
		) );

		// product_sharing_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_sharing_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'product_sharing',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.single-product-socials',
					'property' => 'border-style'
				),
			),
		) );

		// product_sharing_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_sharing_border_color_custom_et-desktop',
			'label'		  => $strings['label']['border_color'],
			'section'     => 'product_sharing',
			'default'	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.single-product-socials',
					'property' => 'border-color',
				),
			),
		) );

		// advanced separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_sharing_advanced_separator',
			'section'     => 'product_sharing',
			'default'     => $separators['advanced'],
			'priority'    => 10,
		) );

		// product_sharing_target
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'product_sharing_target_et-desktop',
			'label'       => $strings['label']['target_blank'],
			'section'     => 'product_sharing',
			'default'     => 0,
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'product_sharing_target_et-desktop' => array(
					'selector' => '.single-product-socials',
					'render_callback' => function() {
						return product_sharing_callback(0);
					}
				)
			)
		) );

		// product_sharing_no_follow
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'product_sharing_no_follow_et-desktop',
			'label'       => $strings['label']['rel_no_follow'],
			'section'     => 'product_sharing',
			'default'     => 0,
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'product_sharing_no_follow_et-desktop' => array(
					'selector' => '.single-product-socials',
					'render_callback' => function() {
						return product_sharing_callback(0);
					}
				)
			)
		) );
?>