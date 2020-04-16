<?php  
	/**
	 * The template created for displaying header cart options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section header-cart
	Kirki::add_section( 'header-cart', array(
	    'title'          => esc_html__( 'Cart/Wishlist', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-cart'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'cart_widget',
			'label' 	  =>  esc_html__('Cart widget position', 'xstore'),
 			'description'  => esc_html__( 'Choose the area where you want to display cart widget in header or disable it at all.', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => 'header',
			'choices'     => array(
				'header'   => esc_html__( 'Header', 'xstore' ),
                'tb-left'  => esc_html__( 'Top bar left', 'xstore' ),
                'tb-right' => esc_html__( 'Top bar right', 'xstore' ),
                false      => esc_html__( 'Disable', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'shopping_cart_icon',
			'label'       => esc_html__( 'Shopping cart icon', 'xstore' ),
			'description' => esc_html__( 'Choose the icon that you like to use for the cart widget in your header.', 'xstore'),
			'section'     => 'header-cart',
			'default'     => 1,
			'choices'     => $shopping_carts,
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mini-cart-items-count',
			'label'       => esc_html__( 'Number of products in mini cart', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => 3,
			'choices'     => array(
				'min'  => 1,
				'max'  => 15,
				'step' => 1,
			),
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'cart_popup_banner',
			'label'       => esc_html__( 'Mini cart banner content', 'xstore' ),
			'description' => esc_html__( 'Controls content that appears at the bottom of the cart widget drop-down. Do not include JS in the field.', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'shopping_cart_total',
			'label'       => esc_html__( 'Show cart total', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the cart total amount next to the cart icon.', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'favicon_label_zero',
			'label'       => esc_html__( 'Show zero number of cart items on label', 'xstore' ),
			'description' => esc_html__( 'Turn on to show label with zero when the cart is empty.', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'cart_icon_label',
			'label'       => esc_html__( 'Label position', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => 'top',
			'choices'     => array(
				'top'    => esc_html__( 'Top', 'xstore' ),
                'bottom' => esc_html__( 'Bottom', 'xstore' ),
                'right'  => esc_html__('Right', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'cart_badge_color',
			'label'       => esc_html__( 'Regular for cart/wishlist number label', 'xstore' ),
			'description' => esc_html__( 'Controls the text color  of the label with the number of items in the cart.', 'xstore' ),
			'section'     => 'header-cart',
			'choices'     => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.navbar-header .shopping-container .cart-bag .badge-number, .navbar-header .et-wishlist-widget .wishlist-count',
					'property' => 'color',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'cart_badge_bg',
			'label'       => esc_html__( 'Background color for cart/wishlist number label', 'xstore' ),
			'description' => esc_html__( 'Controls the text color  of the label with the number of items in the cart.', 'xstore' ),
			'section'     => 'header-cart',
			'choices'     => array(
				'alpha' => true,
			),
			'active_callback' => array(
				array(
					'setting'  => 'cart_widget',
					'operator' => '!=',
					'value'    => false,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.navbar-header .shopping-container .cart-bag .badge-number, .navbar-header .et-wishlist-widget .wishlist-count',
					'property' => 'background-color',
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'top_wishlist_widget',
			'label'       => esc_html__( 'Wishlist icon position', 'xstore' ),
			'description' => esc_html__( 'Choose the area where you want to display wishlist icon in the header or disable it at all. Works only if YITH Wishlist plugin is enabled.', 'xstore' ),
			'section'     => 'header-cart',
			'default'     => 'header',
			'choices'     => array(
				'header'   => esc_html__( 'Header', 'xstore' ),
                'tb-left'  => esc_html__( 'Top bar left', 'xstore' ),
                'tb-right' => esc_html__( 'Top bar right', 'xstore' ),
                false      => esc_html__( 'Disable', 'xstore' ),
			),
		) );
		
?>