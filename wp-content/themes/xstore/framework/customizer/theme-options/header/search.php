<?php  
	/**
	 * The template created for displaying search options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section search
	Kirki::add_section( 'search', array(
	    'title'          => esc_html__( 'Search', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-search'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'search_form',
			'label'       => esc_html__( 'Search widget position', 'xstore' ),
			'description' => esc_html__( 'Choose the area where you want to display Search widget in the header or disable it at all. Design of the search widget depends on the header type.', 'xstore' ),
			'section'     => 'search',
			'default'     => 'header',
			'choices'     => array(
				'header'   => esc_html__( 'Header', 'xstore' ),
                'tb-left'  => esc_html__( 'Top bar left', 'xstore' ),
                'tb-right' => esc_html__( 'Top bar right', 'xstore' ),
                'menu'     => esc_html__( 'Menu', 'xstore' ),
                false      => esc_html__( 'Disable', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_ajax',
			'label'       => esc_html__( 'AJAX Search', 'xstore' ),
			'description' => esc_html__( 'Turn on to deliver users instant and changing results in the dropdown as they type in the search field. Users can click through from the dropdown to the ‘View All’ search page.', 'xstore'),
			'section'     => 'search',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'search_form',
					'operator' => 'in',
					'value'    => array( 'header', 'tb-left', 'tb-right', 'menu' ),
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_ajax_post',
			'label'       => esc_html__( 'Search by posts', 'xstore' ),
			'description' => esc_html__( 'Turn on to include posts in the search results.', 'xstore' ),
			'section'     => 'search',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'search_ajax',
					'operator' => '==',
					'value'    => 1,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_ajax_page',
			'label'       => esc_html__( 'Search by pages', 'xstore' ),
			'description' => esc_html__( 'Turn on to include pages in the search results.', 'xstore' ),
			'section'     => 'search',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'search_ajax',
					'operator' => '==',
					'value'    => 1,
				),
				array(
					'setting'  => 'search_ajax_post',
					'operator' => '==',
					'value'    => 1,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_ajax_product',
			'label'       => esc_html__( 'Search by products', 'xstore' ),
			'description' => esc_html__( 'Turn on to include products in the search results.', 'xstore' ),
			'section'     => 'search',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'search_ajax',
					'operator' => '==',
					'value'    => 1,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_by_sku',
			'label'       => esc_html__( 'Search by SKU', 'xstore' ),
			'description' => esc_html__( 'Turn on to search products by SKU.', 'xstore'),
			'section'     => 'search',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'search_form',
					'operator' => 'in',
					'value'    => array( 'header', 'tb-left', 'tb-right', 'menu' ),
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_page_sidebar',
			'label'       => esc_html__( 'Search results page sidebar', 'xstore' ),
			'description' => esc_html__( 'Turn on to disable sidebar on search results page.', 'xstore'),
			'section'     => 'search',
			'default'     => 0,
		) );
?>