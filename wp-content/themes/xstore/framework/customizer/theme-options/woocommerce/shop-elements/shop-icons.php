<?php  
	/**
	 * The template created for displaying shop icons options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section shop-icons
	Kirki::add_section( 'shop-icons', array(
	    'title'          => esc_html__( 'Sale & Out of Stock', 'xstore' ),
	    'panel' => 'shop-elements',
	    'icon' => 'dashicons-tag'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'out_of_icon',
			'label'       => esc_html__( 'Enable "Out of stock" label', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the "Out of stock" label.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sale_icon',
			'label'       => esc_html__( 'Enable "Sale" label', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the "Sale" label.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'sale_icon_text',
			'label'    => esc_html__( '"Sale" Label Text', 'xstore' ),
			'description' => esc_html__( 'Use to change the sale text.', 'xstore' ),
			'section'  => 'shop-icons',
			'default'  => esc_html__( 'Sale', 'xstore' ),
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'sale_icon_color',
			'label'       => esc_html__( 'Sale label color', 'xstore' ),
			'description' => esc_html__( 'Choose the sale label color.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => '#ffffff',
			'choices'     => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.onsale',
					'property' => 'color'
				)
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'sale_icon_bg_color',
			'label'       => esc_html__( 'Sale label background color', 'xstore' ),
			'description' => esc_html__( 'Choose the sale label background color.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => '#c62828',
			'choices'     => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.onsale',
					'property' => 'background-color'
				)
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'sale_br_radius',
			'label'       => esc_html__( 'Sale label border radius (%)', 'xstore' ),
			'description' => esc_html__( 'Controls the border radius of the sale label.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => 0,
			'choices'     => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			),
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.onsale',
					'property' => 'border-radius',
					'units' => '%'
				)
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'sale_icon_size',
			'label'    => esc_html__( 'Sale label size', 'xstore' ),
			'description' => esc_html__( 'Controls the size of the sale label. In em, for example, 3.75x3.75.', 'xstore' ),
			'section'  => 'shop-icons',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sale_percentage',
			'label'       => esc_html__( 'Show sale percentage', 'xstore' ),
			'description' => esc_html__( 'Turn on to calculate the percentage discount for the products.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sale_percentage_variable',
			'label'       => esc_html__( 'Show sale percentage for variable products', 'xstore' ),
			'description' => esc_html__( 'Turn on to calculate the percentage discount for the variable products.', 'xstore' ),
			'section'     => 'shop-icons',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'sale_icon',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'sale_percentage',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

?>