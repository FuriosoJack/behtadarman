<?php  
	/**
	 * The template created for displaying shop page options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section shop-page
	Kirki::add_section( 'shop-page', array(
	    'title'          => esc_html__( 'Shop page Layout', 'xstore' ),
	    'panel' => 'shop',
	    'icon' => 'dashicons-schedule'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'products_per_page',
			'label'       => esc_html__( 'Products per page', 'xstore' ),
			'description' => esc_html__( 'Add the number of products to show per page before pagination appears. Use -1 to show "All"', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 12,
			'choices'     => array(
				'min'  => '-1',
				'max'  => 100,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'et_ppp_options',
			'label'    => esc_html__( 'Per page variants separated by commas', 'xstore' ),
			'description' => esc_html__( 'Add variants and allow the customer to choose the products quantity shown per page. For ex.: 9,12,24,36,-1. Use -1 to show "All".', 'xstore' ),
			'section'  => 'shop-page',
			'default'  => '12,24,36,-1',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'grid_sidebar',
			'label'       => esc_html__( 'Sidebar position', 'xstore' ),
			'description' => esc_html__( 'Choose the position of the sidebar for the shop page and product categories.', 'xstore'), 
			'section'     => 'shop-page',
			'default'     => 'left',
			'choices'     => $sidebars,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'category_sidebar',
			'label'       => esc_html__( 'Sidebar position on category page', 'xstore' ),
			'description' => esc_html__( 'Choose the position of the sidebar for the product category page.', 'xstore'), 
			'section'     => 'shop-page',
			'default'     => 'left',
			'choices'     => $sidebars,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'category_page_columns',
			'label'       => esc_html__( 'Products per row on category page', 'xstore' ),
			'description' => esc_html__( 'Choose the number of product per row on category pages or inherit it from the WooCommerce options for the shop page (Appearance > Customize > WooCommerce > Product catalog).', 'xstore'),
			'section'     => 'shop-page',
			'default'     => 'inherit',
			'choices'     => array(
				'inherit'    => esc_html__( 'Inherit from shop settings', 'xstore' ),
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'shop_sticky_sidebar',
			'label'       => esc_html__( 'Enable sticky sidebar', 'xstore' ),
			'description' => esc_html__( 'Turn on to make the sidebar permanently visible while scrolling at the shop page.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'sidebar_for_mobile',
			'label'       => esc_html__( 'Sidebar position for mobile', 'xstore' ),
			'description' => esc_html__('Choose the sidebar position for the mobile devices.', 'xstore'),
			'section'     => 'shop-page',
			'default'     => 'off_canvas',
			'choices'     => array(
				'top'    => esc_html__( 'Top', 'xstore' ),
                'bottom' => esc_html__( 'Bottom', 'xstore' ),
                'off_canvas' => esc_html__( 'Off-Canvas', 'xstore' )
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'shop_sidebar_hide_mobile',
			'label'       => esc_html__( 'Hide sidebar for mobile devices', 'xstore' ),
			'description' => esc_html__( 'Turn on to hide sidebar on the mobile devices.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sidebar_widgets_scroll',
			'label'       => esc_html__( 'Sidebar widgets with scrollable content', 'xstore' ),
			'description' => esc_html__( 'Turn on to limit height of the sidebar widgets', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'sidebar_widgets_height',
			'label'       => esc_html__( 'Sidebar widgets height', 'xstore' ),
			'description' => esc_html__( 'Add the max-height of the sidebar widgets before scroll appears. In pixels.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 250,
			'choices'     => array(
				'min'  => 50,
				'max'  => 800,
				'step' => 1,
			),
			'active_callback' => array(
				array(
					'setting'  => 'sidebar_widgets_scroll',
					'operator' => '==',
					'value'    => true,
				),
			),
			'output' => array(
				array(
					'element' => '.archive.woocommerce-page.s_widgets-with-scroll .sidebar .sidebar-widget:not(.sidebar-slider):not(.etheme_widget_satick_block) > ul, .archive.woocommerce-page.s_widgets-with-scroll .shop-filters .sidebar-widget:not(.sidebar-slider):not(.etheme_widget_satick_block) > ul, .archive.woocommerce-page.s_widgets-with-scroll .sidebar .sidebar-widget:not(.sidebar-slider):not(.etheme_widget_satick_block) > div, .archive.woocommerce-page.s_widgets-with-scroll .shop-filters .sidebar-widget:not(.sidebar-slider):not(.etheme_widget_satick_block) > div',
					'property' => 'max-height',
					'units' => 'px'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sidebar_widgets_open_close',
			'label'       => esc_html__( 'Sidebar widgets toggle', 'xstore' ),
			'description' => esc_html__( 'Turn on to enable toggle for the sidebar widget title to open/close widget content.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'sidebar_widgets_open_close_type',
			'label'       => esc_html__( 'Sidebar widgets content', 'xstore' ),
			'description' => esc_html__('Type of widget content.', 'xstore'),
			'section'     => 'shop-page',
			'default'     => 'open',
			'choices'     => array(
				'open' => esc_html__( 'Open always', 'xstore' ),
                'closed' => esc_html__( 'Collapsed always', 'xstore' ),
                'closed_mobile' => esc_html__( 'Collapsed on mobile', 'xstore' ),
			),			
			'active_callback' => array(
				array(
					'setting'  => 'sidebar_widgets_open_close',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'shop_full_width',
			'label'       => esc_html__( 'Full width', 'xstore' ),
			'description' => esc_html__( 'Turn on to stretch shop page container.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'products_masonry',
			'label'       => esc_html__( 'Products masonry', 'xstore' ),
			'description' => esc_html__( 'Turn on placing products in optimal position based on available vertical space.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'view_mode',
			'label'       => esc_html__( 'Products view mode', 'xstore' ),
			'description' => esc_html__('Choose the view mode for the shop page.', 'xstore'),
			'section'     => 'shop-page',
			'default'     => 'grid_list',
			'choices'     => array(
				'grid_list' => esc_html__( 'Grid/List', 'xstore' ),
                'list_grid' => esc_html__( 'List/Grid', 'xstore' ),
                'grid'      => esc_html__( 'Only Grid', 'xstore' ),
                'list'      => esc_html__( 'Only List', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_bage_banner_pos',
			'label'       => esc_html__( 'Shop Page Banner position', 'xstore' ),
			'description' => esc_html__('Controls the position of the shop page banner.', 'xstore'),
			'section'     => 'shop-page',
			'default'     => 1,
			'choices'     => array(
				1 => esc_html__( 'At the top of the page', 'xstore' ),
                2 => esc_html__( 'At the bottom of the page', 'xstore' ),
                3 => esc_html__( 'Above all the shop content', 'xstore' ),
                4 => esc_html__( 'Above all the shop content (full-width)', 'xstore' ),
                0 => esc_html__( 'Disable', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'product_bage_banner',
			'label'       => esc_html__( 'Shop Page Banner content', 'xstore' ),
			'description' => esc_html__( 'This is an editor control.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'product_bage_banner_pos',
					'operator' => '!=',
					'value'    => 0,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'top_toolbar',
			'label'       => esc_html__( 'Show products toolbar on the shop page', 'xstore' ),
			'description' => esc_html__( 'Controls the shop page banner content. Use HTML, static block or slider shortcode. Do not include JS in the field.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'filter_opened',
			'label'       => esc_html__( 'Open filter by default', 'xstore' ),
			'description' => esc_html__( 'Turn on if you use filters widget area to display "Filters" button in the shop toolbar and want to keep this area opened at start.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'filters_columns',
			'label'       => esc_html__( 'Widgets columns for filters area', 'xstore' ),
			'description' => esc_html__( 'Controls the number of columns for the filters widget area content.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 3,
			'choices'     => array(
				'min'  => 2,
				'max'  => 5,
				'step' => 1,
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'ajax_product_filter',
			'label'       => esc_html__( 'Ajax product filters', 'xstore' ),
			'description' => esc_html__( 'Turn on to use Ajax for product filters.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'ajax_product_pagination',
			'label'       => esc_html__( 'Ajax product pagination', 'xstore' ),
			'description' => esc_html__( 'Turn on to use Ajax for product pagination.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'ajax_added_product_notify',
			'label'       => esc_html__( 'Product added notification', 'xstore' ),
			'description' => esc_html__( 'Turn on to use Ajax notification on after product added to cart.', 'xstore' ),
			'section'     => 'shop-page',
			'default'     => 1,
		) );

?>