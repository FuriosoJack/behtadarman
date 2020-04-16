<?php  
	/**
	 * The template created for displaying shop quick view options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section shop-quick-view
	Kirki::add_section( 'shop-quick-view', array(
	    'title'          => esc_html__( 'Quick view', 'xstore' ),
	    'panel' => 'shop-elements',
	    'icon' => 'dashicons-external' 
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'quick_view',
			'label'       => esc_html__( 'Enable quick view', 'xstore' ),
			'description' => esc_html__( 'Turn on to allow customers a quick preview of the product right from its respective category listing.', 'xstore' ),
			'section'     => 'shop-quick-view',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'quick_dimentions',
			'label'       => esc_html__( 'Quick view dimensions (width and height)', 'xstore' ),
			'description' => esc_html__( 'Set height and width of the quick view lightbox.', 'xstore' ),
			'section'     => 'shop-quick-view',
			'default'     => array(
				'width'  => '',
				'height' => '',
			),
			'choices'     => array(
				'labels' => array(
					'width'  => esc_html__( 'Width', 'xstore' ),
					'height' => esc_html__( 'Height', 'xstore' ),
				),
			),
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'quick_images',
			'label'       => esc_html__( 'Product images', 'xstore' ),
			'description' => esc_html__( 'Choose the way to display product image in the quick view window.', 'xstore'),
			'section'     => 'shop-quick-view',
			'default'     => 'slider',
			'choices'     => array(
				'slider' => esc_html__( 'Slider', 'xstore' ),
                'single' => esc_html__( 'Single', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'quick_image_height',
			'label'    => esc_html__( 'Images height', 'xstore' ),
			'description' => esc_html__( 'Minimum height for the images', 'xstore' ),
			'section'  => 'shop-quick-view',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'quick_view_layout',
			'label'       => esc_html__( 'Quick view layout', 'xstore' ),
			'description' => esc_html__( 'Choose the design of the quick view window.', 'xstore'),
			'section'     => 'shop-quick-view',
			'default'     => 'default',
			'choices'     => array(
				'default' => esc_html__( 'Default', 'xstore' ),
                'centered' => esc_html__( 'Centered', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'multicheck',
			'settings'    => 'quick_view_switcher',
			'label'       => esc_html__( 'Quick view content', 'xstore' ),
			'description' => esc_html__( 'Enable elements that you want to display in quick view window.', 'xstore' ),
			'section'     => 'shop-quick-view',
			'default'     => array(
				'quick_product_name',
				'quick_price',
				'quick_rating',
				'quick_short_descr',
				'quick_add_to_cart',
				'quick_categories',
				'quick_share',
				'product_link' ),
			'priority'    => 10,
			'choices'     => array(
				'quick_product_name' => esc_html__( 'Product name', 'xstore' ),
                'quick_price'        => esc_html__( 'Price', 'xstore' ),
                'quick_rating'       => esc_html__( 'Product star rating', 'xstore' ),
                'quick_short_descr'  => esc_html__( 'Product short description', 'xstore' ),
                'quick_add_to_cart'  => esc_html__( 'Add to cart', 'xstore' ),                            
                'quick_categories'   => esc_html__( 'Product categories', 'xstore' ),
                'quick_share'        => esc_html__( 'Share icons', 'xstore' ),
                'product_link'       => esc_html__( 'Details link', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'quick_descr',
			'label'       => esc_html__( 'Product details toggle', 'xstore' ),
			'description' => esc_html__( 'Enable details toggle for product', 'xstore' ),
			'section'     => 'shop-quick-view',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'quick_descr_length',
			'label'    => esc_html__( 'Details length', 'xstore' ),
			'description' => esc_html__( 'Controls the length of the product details', 'xstore' ),
			'section'  => 'shop-quick-view',
			'default'  => 120,
			'active_callback' => array(
				array(
					'setting'  => 'quick_view',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

?>