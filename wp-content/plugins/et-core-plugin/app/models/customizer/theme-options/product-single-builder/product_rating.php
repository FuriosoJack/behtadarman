<?php  
	/**
	 * The template created for displaying single product rating options 
	 *
	 * @version 1.0.1
	 * @since 1.5
	 * last changes in 1.5.5
	 */

	// section product_rating
	Kirki::add_section( 'product_rating', array(
	    'title'          => esc_html__( 'Rating', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-star-filled',
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_rating_content_separator',
			'section'     => 'product_rating',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// product_rating_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_rating_align_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'product_rating',
			'default'     => 'inherit',
			'choices'     => $choices['alignment_with_inherit'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.woocommerce-product-rating',
					'property' => 'text-align',
				),
			),
		) );

		// product_rating_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_rating_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'product_rating',
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
					'element' => '.woocommerce-product-rating',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.woocommerce-product-rating')
		) );

		// product_rating_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_rating_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'product_rating',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.woocommerce-product-rating',
					'property' => 'border-style'
				),
			),
		) );

		// product_rating_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_rating_border_color_custom_et-desktop',
			'label'		  => $strings['label']['border_color'],
			'section'     => 'product_rating',
			'default'	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.woocommerce-product-rating',
					'property' => 'border-color',
				),
			),
		) );