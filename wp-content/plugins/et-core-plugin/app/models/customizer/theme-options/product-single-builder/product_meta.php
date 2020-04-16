<?php  
	/**
	 * The template created for displaying single product meta options 
	 *
	 * @since   1.5.0
	 * @version 1.0.1
	 * last changes in 1.5.5
	 */

	// section product_meta
	Kirki::add_section( 'product_meta', array(
	    'title'          => esc_html__( 'Product meta', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-format-aside',
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_meta_content_separator',
			'section'     => 'product_meta',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// product_meta_content
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'sortable',
			'label'       => $strings['label']['elements'],
			'description' => esc_html__('On/Off elements you need. Drag&Drop to change order.', 'xstore-core'),
			'section'     => 'product_meta',
			'priority'    => 10,
			'settings'     => 'product_meta_content',
			'default'	  => array(
				'sku',
				'categories',
				'tags',
			),
			'choices'      => array(
				'sku' => esc_html__( 'SKU', 'xstore-core' ),
				'categories' => esc_html__( 'Categories', 'xstore-core' ),
				'tags' => esc_html__( 'Tags', 'xstore-core' ),
			),
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_meta_style_separator',
			'section'     => 'product_meta',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );


		// product_title_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_meta_align_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'product_meta',
			'default'     => 'inherit',
			'choices'     => $choices['alignment2_with_inherit'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product .product_meta',
					'property' => 'justify-content',
				),
			),
		) );

		// product_meta_direction 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_meta_direction_et-desktop',
			'label'       => $strings['label']['direction'],
			'section'     => 'product_meta',
			'default'     => 'column',
			'choices'     => $choices['direction']['type2'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product .product_meta',
					'property' => 'flex-direction',
				),
			),
		) );

		// product_title_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_meta_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'product_meta',
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
					'element' => '.single-product .product_meta',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.single-product .product_meta')
		) );

		// product_title_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_meta_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'product_meta',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.single-product .product_meta',
					'property' => 'border-style'
				),
			),
		) );

		// product_title_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_meta_border_color_custom_et-desktop',
			'label'		  => $strings['label']['border_color'],
			'section'     => 'product_meta',
			'default'	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.single-product .product_meta',
					'property' => 'border-color',
				),
			),
		) );

?>