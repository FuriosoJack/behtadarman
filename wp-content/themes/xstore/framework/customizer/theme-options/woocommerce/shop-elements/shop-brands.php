<?php  
	/**
	 * The template created for displaying shop brands options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section shop-brands
	Kirki::add_section( 'shop-brands', array(
	    'title'          => esc_html__( 'Brands', 'xstore' ),
	    'panel' => 'shop-elements',
	    'icon' => 'dashicons-tickets'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'enable_brands',
			'label'       => esc_html__( 'Enable Brands', 'xstore' ),
			'description' => esc_html__( 'Turn on to use brands for the products.', 'xstore' ),
			'section'     => 'shop-brands',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'product_page_brands',
			'label'       => esc_html__( 'Show product brands on grid/list', 'xstore' ),
			'section'     => 'shop-brands',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'product_view',
					'operator' => '!=',
					'value'    => 'custom',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'show_brand',
			'label'       => esc_html__( 'Show product brands on single product page', 'xstore' ),
			'description' => esc_html__( 'Turn on to enable brand on the single product page.', 'xstore' ),
			'section'     => 'shop-brands',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'brands_location',
			'label'       => esc_html__( 'Choose the location for brands', 'xstore' ),
			'description' => esc_html__( 'Choose brands position on the single product page.', 'xstore' ),
			'section'     => 'shop-brands',
			'default'     => 'sidebar',
			'choices'     => array(
				'sidebar' => esc_html__( 'Sidebar', 'xstore' ),
                'content' => esc_html__( 'Above short description', 'xstore' ),
                'under_content' => esc_html__( 'In product meta', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'show_brand',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'show_brand_image',
			'label'       => esc_html__( 'Show brand image', 'xstore' ),
			'description' => esc_html__( 'Turn on to show brand image on the single product page. Choose brand image by uploading thumbnails for the brand while create/edit brand.', 'xstore'),
			'section'     => 'shop-brands',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'show_brand',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'brands_location',
					'operator' => '==',
					'value'    => 'sidebar',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'show_brand_title',
			'label'       => esc_html__( 'Show brand title', 'xstore' ),
			'description' => esc_html__( 'Turn on to show brand title on the single product page. ', 'xstore'),
			'section'     => 'shop-brands',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'show_brand',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'brands_location',
					'operator' => '==',
					'value'    => 'sidebar',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'show_brand_desc',
			'label'       => esc_html__( 'Show brand description', 'xstore' ),
			'description' => esc_html__( 'Turn on to show brand description on the single product page.', 'xstore' ),
			'section'     => 'shop-brands',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'show_brand',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'brands_location',
					'operator' => '==',
					'value'    => 'sidebar',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'brand_title',
			'label'       => esc_html__( 'Show \'Brand\' word', 'xstore' ),
			'description' => esc_html__( 'Turn on to show \'Brand\' word before the brand image.', 'xstore'),
			'section'     => 'shop-brands',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'enable_brands',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'show_brand',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'brands_location',
					'operator' => '!=',
					'value'    => 'sidebar',
				),
			)
		) );

?>