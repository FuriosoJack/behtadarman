<?php  
	/**
	 * The template created for displaying products style options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section products-style

	Kirki::add_section( 'products-style', array(
	    'title'          => esc_html__( 'Products style', 'xstore' ),
	    'panel' => 'shop',
	    'icon' => 'dashicons-admin-generic'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_view',
			'label'       => esc_html__( 'Product content effect', 'xstore' ),
			'description' => esc_html__('Choose the design type for the products on the shop page. Custom type allows you to choose the design created using', 'xstore' ) . ' <a href="https://kb.wpbakery.com/docs/learning-more/grid-builder/" target="blank" rel="nofollow">' . esc_html__( 'WPBakery Grid builder', 'xstore' ) . '</a>',
			'section'     => 'products-style',
			'default'  => 'disable',
			'choices'     => array(
				'disable' => esc_html__( 'Disable', 'xstore' ),
                'default' => esc_html__( 'Default', 'xstore' ),
                'mask3'   => esc_html__( 'Buttons on hover middle', 'xstore' ),
                'mask'    => esc_html__( 'Buttons on hover bottom', 'xstore' ),
                'mask2'   => esc_html__( 'Buttons on hover right', 'xstore' ),
                'info'    => esc_html__( 'Information mask', 'xstore' ),
                'booking' => esc_html__( 'Booking', 'xstore' ),
                'light'   => esc_html__( 'Light', 'xstore' ),
                'custom'  => esc_html__( 'Custom', 'xstore' )
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'custom_product_template',
			'label'       => esc_html__( 'Product content effect', 'xstore' ),
			'description' => sprintf( esc_html__( '
                    Choose the design created using %1s. Find the Video tutorials for builder usage %2s', 'xstore' ), '<a href="https://wpbakery.com/video-academy/category/grid/" target="_blank">' . esc_html__( 'WPBakery Grid builder', 'xstore' ) . '</a>', '<a href="https://wpbakery.com/video-academy/category/grid/" target="_blank">' . esc_html__( 'here', 'xstore' ) . '</a>' ),
			'section'     => 'products-style',
			'default'  	  => 'disable',
			'choices'     => $product_templates,
			'active_callback' => array(
				array(
					'setting'  => 'product_view',
					'operator' => '==',
					'value'    => 'custom',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_view_color',
			'label'       => esc_html__( 'Hover Color Scheme', 'xstore' ),
			'description' => esc_html__( 'Choose the color scheme for the product design with buttons on hover.', 'xstore' ),
			'section'     => 'products-style',
			'default'     => 'white',
			'choices'     => array(
				'white'       => esc_html__( 'White', 'xstore' ),
                'dark'        => esc_html__( 'Dark', 'xstore' ),
                'transparent' => esc_html__( 'Transparent', 'xstore' )
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_view',
					'operator' => 'in',
					'value'    => array('default', 'info', 'mask', 'mask2', 'mask3'),
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_img_hover',
			'label'       => esc_html__( 'Image hover effect', 'xstore' ),
			'description' => esc_html__( 'Choose the type of the hover effect for the image or disable it at all.', 'xstore' ),
			'section'     => 'products-style',
			'default'     => 'slider',
			'choices'     => array(
				'disable' => esc_html__( 'Disable', 'xstore' ),
                'swap'    => esc_html__( 'Swap', 'xstore' ),
                'slider'  => esc_html__( 'Images Slider', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_view',
					'operator' => '!=',
					'value'    => 'custom',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_title_limit',
			'label'       => esc_html__( 'Product title chars limit', 'xstore' ),
			'description' => esc_html__( 'Controls the length of the product title for the products at grid/list, related products, prev/next product navigation.', 'xstore'),
			'section'     => 'products-style',
			'default'     => 0,
			'choices'     => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'star-rating-color',
			'label'       => esc_html__( 'Star rating color', 'xstore' ),
			'description' => esc_html__( 'Choose the color of the stars for the product rating.', 'xstore' ),
			'section'     => 'products-style',
			'default'     => '#fdd835',
			'choices'     => array(
				'alpha' => true,
			),
			'output' => array(
				array(
					'element' => '.star-rating span:before, #review_form .stars a.active:before, #review_form .stars a:hover:before',
					'property' => 'color'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'multicheck',
			'settings'    => 'product_page_switchers',
			'label'       => esc_html__( 'Product content elements', 'xstore' ),
			'description' => esc_html__( 'Enable/disable element that you do/do not want to show at grid/list.', 'xstore' ),
			'section'     => 'products-style',
			'default'     => array('product_page_productname', 'product_page_cats', 'product_page_price', 'product_page_addtocart', 'hide_buttons_mobile'),
			'choices'     => array(
				'product_page_productname' => esc_html__( 'Product name', 'xstore' ),
                'product_page_cats'        => esc_html__( 'Product categories', 'xstore' ),
                'product_page_price'       => esc_html__( 'Price', 'xstore' ),
                'product_page_addtocart'   => esc_html__( 'Add to cart button', 'xstore' ),
                'hide_buttons_mobile' => esc_html__( 'Hover buttons on mobile', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'product_view',
					'operator' => '!=',
					'value'    => 'custom',
				),
			)
		) );

?>