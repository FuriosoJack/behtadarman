<?php  
	/**
	 * The template created for displaying single product price options 
	 *
	 * @version 1.0.1
	 * @since 1.5
	 * last changes in 1.5.5
	 */

	// section product_price
	Kirki::add_section( 'product_price', array(
	    'title'          => esc_html__( 'Price', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-tag',
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_price_style_separator',
			'section'     => 'product_price',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// product_price_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_price_align_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'product_price',
			'default'     => 'inherit',
			'choices'     => $choices['alignment_with_inherit'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_product-block > .price, .et_product-block .et_connect-block > .price',
					'property' => 'text-align',
				),
			),
		) );

		// product_price_proportion
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_price_proportion_et-desktop',
			'label'       => $strings['label']['size_proportion'],
			'section'     => 'product_price',
			'default'     => 1.4,
			'choices'     => array(
				'min'  => '0',
				'max'  => '5',
				'step' => '.1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'body',
					'property' => '--single-product-price-proportion',
				),
			),
		) );

		// product_price_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_price_color_custom_et-desktop',
			'label'		  => esc_html__('Color', 'xstore-core'),
			'section'     => 'product_price',
			'default'	  => '#555555',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block > .price, .et_product-block .et_connect-block > .price, .et_product-block form.cart .price, .et_product-block .group_table .woocommerce-Price-amount',
					'property' => 'color',
				),
			),
		) );

		// product_price_sale_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_price_sale_color_custom_et-desktop',
			'label'		  => esc_html__('Sale Color', 'xstore-core'),
			'section'     => 'product_price',
			'default'	  => '#c62828',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block > .price ins .amount, .et_product-block .et_connect-block > .price ins .amount, .et_product-block form.cart ins .amount',
					'property' => 'color',
				),
			),
		) );

		// product_price_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_price_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'product_price',
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
					'element' => '.et_product-block > .price, .et_product-block .et_connect-block > .price',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_product-block > .price, .et_product-block .et_connect-block > .price')
		) );

		// product_price_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_price_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'product_price',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block > .price, .et_product-block .et_connect-block > .price',
					'property' => 'border-style'
				),
			),
		) );

		// product_price_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_price_border_color_custom_et-desktop',
			'label'		  => $strings['label']['border_color'],
			'section'     => 'product_price',
			'default'	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block > .price, .et_product-block .et_connect-block > .price',
					'property' => 'border-color',
				),
			),
		) );

?>