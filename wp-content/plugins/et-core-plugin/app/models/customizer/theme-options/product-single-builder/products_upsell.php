<?php  
	/**
	 * The template created for displaying product upsels product options
	 *
	 * @version 1.0.0
	 * @since 0.0.1
	 */

	// section products_upsell
	Kirki::add_section( 'products_upsell', array(
	    'title'          => esc_html__( 'Upsell products', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-tag',
		) );

		// content separator 
    	Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'products_upsell_content_separator',
			'section'     => 'products_upsell',
			'default'     => $separators['content'],
		) );

    	// products_upsell_type
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'products_upsell_type_et-desktop',
			'label'       => $strings['label']['type'],
			'section'     => 'products_upsell',
			'default'     => 'slider',
			'multiple'    => 1,
			'choices'     => $choices['product_types']
		) );

		// products_upsell_per_view
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_per_view_et-desktop',
			'label'       => esc_html__( 'Upsell products per view', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 4,
			'choices'     => array(
				'min'  => '1',
				'max'  => '6',
				'step' => '1',
			),
		) );

		// products_upsell_limit
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_limit_et-desktop',
			'label'       => esc_html__( 'Upsell products limit', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 7,
			'choices'     => array(
				'min'  => '1',
				'max'  => '30',
				'step' => '1',
			),
		) );

		// style separator
    	Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'products_upsell_style_separator',
			'section'     => 'products_upsell',
			'default'     => $separators['style'],
		) );

		// products_upsell_zoom
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'slider',
		// 	'settings'    => 'products_upsell_zoom_et-desktop',
		// 	'label'       => $strings['label']['content_zoom']
		// 	'section'     => 'products_upsell',
		// 	'default'     => 100,
		// 	'choices'     => array(
		// 		'min'  => '0',
		// 		'max'  => '200',
		// 		'step' => '1',
		// 	),
		// 	'transport' => 'auto',
		// 	'output' => array(
		// 		array(
		// 			'element' => '.upsells ul.products li',
		// 			'property' => '--content-zoom',
		// 			'value_pattern' => 'calc($em * .01)'
		// 		),
		// 	),
		// ) );

		// products_upsell_cols_gap
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_cols_gap_et-desktop',
			'label'       => $strings['label']['cols_gap'],
			'section'     => 'products_upsell',
			'default'     => 15,
			'choices'     => array(
				'min'  => '0',
				'max'  => '80',
				'step' => '1',
			),
			'output' => array(
				array(
					'element' => '.upsell-products',
					'property' => '--cols-gap',
    				'units' => 'px'
				),
			),
		) );

		// products_upsell_rows_gap
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_rows_gap_et-desktop',
			'label'       => esc_html__( 'Rows gap (px)', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 15,
			'choices'     => array(
				'min'  => '0',
				'max'  => '80',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '!=',
					'value'    => 'slider',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products',
					'property' => '--rows-gap',
    				'units' => 'px'
				),
			),
		) );

		// product_gallery_arrow_size
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_arrow_size',
			'label'       => esc_html__( 'Arrows size (px)', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 50,
			'choices'     => array(
				'min'  => '20',
				'max'  => '90',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '==',
					'value'    => 'slider',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products',
					'property' => '--arrow-size',
					'units' => 'px'
				),
			)
		) );

		// products_upsell_title_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'products_upsell_title_align_et-desktop',
			'label'       => esc_html__( 'Title align', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 'start',
			'choices'     => $choices['alignment_with_inherit'],
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '!=',
					'value'    => 'widget',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products-title',
					'property' => 'text-align',
				),
			),
		) );

		// products_upsell_title_sizes
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'products_upsell_title_sizes_et-desktop',
			'label'       => $strings['label']['title_sizes'],
			'section'     => 'products_upsell',
			'default'     => 'inherit',
			'choices'     => array(
				'inherit' => esc_html__('Inherit', 'xstore-core'),
				'custom' => esc_html__('Custom', 'xstore-core')
			),
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '!=',
					'value'    => 'widget',
				),
			),
		) );

		// products_upsells_title_size_proportion
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_title_size_proportion_et-desktop',
			'label'       => $strings['label']['title_size_proportion'],
			'section'     => 'products_upsell',
			'default'     => 1.71,
			'choices'     => array(
				'min'  => '0',
				'max'  => '5',
				'step' => '.1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '!=',
					'value'    => 'widget',
				),
				array(
					'setting'  => 'products_upsell_title_sizes_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products-title',
					'property' => '--h2-size-proportion',
				),
			),
		) );

		// products_upsells_title_line_height
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_title_line_height_et-desktop',
			'label'       => esc_html__( 'Title line height', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 1.5,
			'choices'     => array(
				'min'  => '0',
				'max'  => '3',
				'step' => '.1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '!=',
					'value'    => 'widget',
				),
				array(
					'setting'  => 'products_upsell_title_sizes_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products-title',
					'property' => '--h2-line-height',
				),
			),
		) );

		// products_upsell_title_margin_bottom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_upsell_title_margin_bottom_et-desktop',
			'label'       => esc_html__( 'Title bottom space', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 20,
			'choices'     => array(
				'min'  => '0',
				'max'  => '50',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'products_upsell_type_et-desktop',
					'operator' => '!=',
					'value'    => 'widget',
				),
				array(
					'setting'  => 'products_upsell_title_sizes_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products-title',
					'property' => 'margin-bottom',
					'units' => 'px'
				),
			),
		) );

	    // products_upsell_content_align
	    // Kirki::add_field( 'et_kirki_options', array(
	    //     'type'        => 'radio-buttonset',
	    //     'settings'    => 'products_upsell_content_align_et-desktop',
	    //     'label'       => $strings['label']['alignment'],
	    //     'section'     => 'products_upsell',
	    //     'default'     => 'inherit',
	    //     'choices'     => $choices['alignment_with_inherit'],           
	    // ) );

	    // products_upsell_content_align_custom 
	    // Kirki::add_field( 'et_kirki_options', array(
	    //     'type'        => 'slider',
	    //     'settings'    => 'products_upsell_content_align_custom_et-desktop',
	    //     'label'       => esc_html__( 'Offset align content', 'xstore-core' ),
	    //     'section'     => 'products_upsell',
	    //     'default'     => 0,
	    //     'choices'     => array(
	    //         'min'  => 0,
	    //         'max'  => 70,
	    //         'step' => 1,
	    //     ),
	    //     'active_callback' => array(
	    //         array(
	    //             'setting'  => 'products_upsell_content_align_et-desktop',
	    //             'operator' => '!=',
	    //             'value'    => 'center',
	    //         ),
	    //     ),
	    //     'transport' => 'auto',
	    //     'output'      => array(
	    //         array(
	    //             'element' => '.upsells ul.products .product.align-start .product-content',
	    //             'property' => 'padding-left',
	    //             'value_pattern' => 'calc(var(--separate-elements-space-inside) + $px)'
	    //         ),
	    //         array(
	    //             'element' => '.upsells ul.products  .product.align-start .product-image-wrap',
	    //             'property' => 'margin-left',
	    //             'value_pattern' => '-$px'
	    //         ),
	    //         array(
	    //             'element' => '.upsells ul.products  .product.align-end .product-content',
	    //             'property' => 'padding-right',
	    //             'value_pattern' => 'calc(var(--separate-elements-space-inside) + $px)'
	    //         ),
	    //         array(
	    //             'element' => '.upsells ul.products  .product.align-end .product-image-wrap',
	    //             'property' => 'margin-right',
	    //             'value_pattern' => '-$px'
	    //         ),
	    //     ),
	    // ) );

		// products_upsells_sale_label
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'products_upsells_sale_label_et-desktop',
			'label'       => esc_html__( 'Hide sale label', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 0,
		) );

		// products_upsell_view 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'products_upsell_view_et-desktop',
			'label'       => esc_html__( 'Hide buttons on hover', 'xstore-core' ),
			'section'     => 'products_upsell',
			'default'     => 0,
		) );

		// products_upsell_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'products_upsell_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'products_upsell',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '30px',
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
			'output' => array(
				array(
					'element' => '.upsell-products-wrapper',
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.upsell-products-wrapper')
		) );

		// products_upsell_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'products_upsell_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'products_upsell',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products-wrapper',
					'property' => 'border-style'
				)
			)
		) );

		// products_upsell_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'products_upsell_border_color_custom_et-desktop',
			'label'		  => $strings['label']['border_color'],
			'section'     => 'products_upsell',
			'default'	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.upsell-products-wrapper',
					'property' => 'border-color',
				),
			),
		) );

?>