<?php  
	/**
	 * The template created for displaying header search element options
	 *
	 * @version 1.0.7
	 * @since 1.4.0
	 * last changes in 2.2.1
	 */

	// section search
	Kirki::add_section( 'search', array(
	    'title'          => esc_html__( 'Search', 'xstore-core' ),
	    'panel' => 'header-builder',
	    'icon' => 'dashicons-search'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'search_content_separator',
			'section'     => 'search',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// search_type
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'search_type_et-desktop',
			'label'       => $strings['label']['type'],
			'section'     => 'search',
			'default'     => 'input',
			'multiple'    => 1,
			'choices'     => array(
				'icon' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/search/Style-search-icon-1.svg',
				'input' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/search/Style-search-icon-2.svg',
			),
		) );

		// search_type
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'search_type_et-mobile',
			'label'       => $strings['label']['type'],
			'section'     => 'search',
			'default'     => 'icon',
			'multiple'    => 1,
			'choices'     => array(
				'icon' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/search/Style-search-icon-1.svg',
				'input' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/search/Style-search-icon-2.svg',
			),
		) );

		// search_ajax
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_ajax_et-desktop',
			'label'       => esc_html__( 'Ajax search', 'xstore-core' ),
			'section'     => 'search',
			'default'     => '1',
		) );

		// search_ajax_min_symbols
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_ajax_min_symbols_et-desktop',
			'label'       => esc_html__( 'Do Ajax Search after ... characters', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 3,
			'choices'     => array(
				'min'  => '2',
				'max'  => '10',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'search_ajax_et-desktop',
					'operator' => '==',
					'value'    => 1,
				),
			),
		) );

		// search_placeholder
		Kirki::add_field( 'et_kirki_options', array (
			'type'     => 'text',
			'settings' => 'search_placeholder_et-desktop',
			'label'    => esc_html__( 'Placeholder text', 'xstore-core' ),
			'section'  => 'search',
			'default'  => esc_html__( 'Search for...', 'xstore-core' ),
			'priority' => 10,
			'transport'   => 'postMessage',
		    'js_vars'     => array(
		        array(
		            'element'  => '.et_b_header-search .input-row input[type="text"]',
		            'function' => 'html',
		            'attr'     => 'placeholder',
		        ),
		    )
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'search_results_content_separator',
			'section'     => 'search',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-admin-settings"></span> <span style="padding-left: 3px;">' . esc_html__( 'Search results', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// search_results_content
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'sortable',
			'label'       => esc_html__( 'Results sorting', 'xstore-core' ),
			'description' => esc_html__('On/Off post types you need. Drag&Drop to change order.', 'xstore-core'),
			'section'     => 'search',
			'settings'     => 'search_results_content_et-desktop',
			'default'	  => array(
				'products',
				'posts',
			),
			'choices'      => array(
				'products' => esc_html__( 'Products', 'xstore-core' ),
				'posts' => esc_html__( 'Posts', 'xstore-core' ),
				'pages' => esc_html__( 'Pages', 'xstore-core' ),
				'portfolio' => esc_html__( 'Portfolio', 'xstore-core' ),
			),
		) );

		// search_by_sku
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_by_sku_et-desktop',
			'label'       => esc_html__( 'Search by SKU', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'search_results_content_et-desktop',
					'operator' => 'in',
					'value'    => 'products'
				),
			),
		) );

		// search_category
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_category_et-desktop',
			'label'       => esc_html__( 'Search by category', 'xstore-core' ),
			'section'     => 'search',
			'default'     => '1',
			'active_callback' => array(
				array(
					'setting'  => 'search_results_content_et-desktop',
					'operator' => 'in',
					'value'    => array('posts', 'products')
				),
			),
		) );

		// search_all_categories_text
		Kirki::add_field( 'et_kirki_options', array (
			'type'     => 'text',
			'settings' => 'search_all_categories_text_et-desktop',
			'label'    => esc_html__( 'All categories text', 'xstore-core' ),
			'section'  => 'search',
			'default'  => esc_html__( 'All categories', 'xstore-core' ),
			'active_callback' => array(
				array(
					'setting'  => 'search_results_content_et-desktop',
					'operator' => 'in',
					'value'    => array('posts', 'products')
				),
				array(
					'setting' => 'search_category_et-desktop',
					'operator' => '==',
					'value'    => '1'
				)
			),
			'transport'   => 'postMessage',
		    'js_vars'     => array(
		        array(
		            'element'  => '.et_b_header-search .input-row select option:first-child',
		            'function' => 'html',
		        ),
		    )
		) );

		// search_page_sidebar
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'search_page_sidebar_et-desktop',
			'label'       => esc_html__( 'Sidebar position', 'xstore-core' ),
			'description' => esc_html__( 'Choose the position of the sidebar for the search results page.', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 'without',
			'choices'     => $sidebars_with_inherit,
		) );

		// search_page_custom_area_position
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'search_page_custom_area_position_et-desktop',
			'label'       => esc_html__( 'Custom area position on page', 'xstore-core' ),
			'description' => esc_html__( 'Choose the position of the custom area for the search results page.', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 'none',
			'choices'     => array(
				'none' => esc_html__( 'None', 'xstore-core' ),
				'before' => esc_html__( 'Before results', 'xstore-core' ),
				'after' => esc_html__( 'After results', 'xstore-core' )	
			),
		) );

		// search_page_custom_area
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'search_page_custom_area',
			'label'       => esc_html__( 'Custom area content', 'xstore-core' ),
			'description' => $strings['label']['editor_control'],
			'section'     => 'search',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'search_page_custom_area_position_et-desktop',
					'operator' => '!=',
					'value'    => 'none',
				),
				array(
					'setting'  => 'search_page_sections',
					'operator' => '!=',
					'value'    => 1,
				),
			),
		) );

		// search_page_sections
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'search_page_sections',
			'label'       => $strings['label']['use_static_block'],
			'section'     => 'search',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'search_page_custom_area_position_et-desktop',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		) );

		// search_page_section
		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'select',
			'settings' => 'search_page_section',
			'label'    => sprintf(esc_html__( 'Choose %1s for Search page custom area', 'xstore-core' ), '<a href="https://xstore.helpscoutdocs.com/article/47-static-blocks" target="_blank" style="color: #555">'.esc_html__('static block', 'xstore-core').'</a>'),
			'section'  => 'search',
			'default'  => '',
			'priority' => 10,
			'choices'  => $post_types['sections'],
			'active_callback' => array(
				array(
					'setting'  => 'search_page_custom_area_position_et-desktop',
					'operator' => '!=',
					'value'    => 'none',
				),
				array(
					'setting'  => 'search_page_sections',
					'operator' => '==',
					'value'    => 1,
				),
			)
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'search_style_separator',
			'section'     => 'search',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// search_icon_zoom 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_icon_zoom_et-desktop',
			'label'       => $strings['label']['icons_zoom'],
			'description' => esc_html__( 'Only for search type icon', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 1,
			'choices'     => array(
				'min'  => '.7',
				'max'  => '3',
				'step' => '.1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level > span svg, .et_b_header-search.et_element-top-level .search-button svg',
					'property' => 'width',
					'units' => 'em'
				),
				array(
					'element' => '.et_b_header-search.et_element-top-level > span svg, .et_b_header-search.et_element-top-level .search-button svg',
					'property' => 'height',
					'units' => 'em'
				),
			)
		) );

		// search_icon_zoom 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_icon_zoom_et-mobile',
			'label'       => $strings['label']['icons_zoom'],
			'description' => esc_html__( 'Only for search type icon', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 1,
			'choices'     => array(
				'min'  => '.7',
				'max'  => '3',
				'step' => '.1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level > span svg, .mobile-header-wrapper .et_b_header-search.et_element-top-level .search-button svg',
					'property' => 'width',
					'units' => 'em'
				),
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level > span svg, .mobile-header-wrapper .et_b_header-search.et_element-top-level .search-button svg',
					'property' => 'height',
					'units' => 'em'
				),
			)
		) );

		// search_content_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'search_content_alignment_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'search',
			'default'     => 'center',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.header-wrapper .et_b_header-search.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'justify-content-start',
					'value' => 'start'
				),
				array(
					'element'  => '.header-wrapper .et_b_header-search.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'justify-content-center',
					'value' => 'center'
				),
				array(
					'element'  => '.header-wrapper .et_b_header-search.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'justify-content-end',
					'value' => 'end'
				),
			),
		) );

		// search_content_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'search_content_alignment_et-mobile',
			'label'       => $strings['label']['alignment'],
			'section'     => 'search',
			'default'     => 'center',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.mobile-header-wrapper .et_b_header-search.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'mob-justify-content-start',
					'value' => 'start'
				),
				array(
					'element'  => '.mobile-header-wrapper .et_b_header-search.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'mob-justify-content-center',
					'value' => 'center'
				),
				array(
					'element'  => '.mobile-header-wrapper .et_b_header-search.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'mob-justify-content-end',
					'value' => 'end'
				),
			),
		) );

		// search_width
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_width_et-desktop',
			'label'       => esc_html__( 'Width (%)', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .input-row',
					'property' => 'width',
					'units' => '%'
				),
			),
		) );

		// search_width
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_width_et-mobile',
			'label'       => esc_html__( 'Width (%)', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .input-row',
					'property' => 'width',
					'units' => '%'
				),
			),
		) );

		// search_height
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_height_et-desktop',
			'label'       => esc_html__( 'Height (px)', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 40,
			'choices'     => array(
				'min'  => '10',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level input[type="text"], .et_b_header-search.et_element-top-level select, .et_b_header-search.et_element-top-level .search-button',
					'property' => 'height',
					'units' => 'px'
				),
				array(
					'element' => '.et_b_header-search.et_element-top-level input[type="text"], .et_b_header-search.et_element-top-level select, .et_b_header-search.et_element-top-level .search-button',
					'property' => 'line-height',
					'value_pattern' => 'calc($px / 2)'
				),
				array(
					'element' => '.et_b_header-search.et_element-top-level input[type="text"]',
					'property' => 'max-width',
					'value_pattern' => 'calc(100% - $px)'
				),
				array(
					'element' => '.et_b_header-search.et_element-top-level .search-button',
					'property' => 'width',
					'units' => 'px'
				)
			)
		) );

		// search_height 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_height_et-mobile',
			'label'       => esc_html__( 'Height (px)', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 40,
			'choices'     => array(
				'min'  => '10',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level input[type="text"],
						.mobile-header-wrapper .et_b_header-search.et_element-top-level select,.mobile-header-wrapper  .et_b_header-search.et_element-top-level .search-button',
					'property' => 'height',
					'units' => 'px'
				),
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level input[type="text"],
						.mobile-header-wrapper .et_b_header-search.et_element-top-level select,.mobile-header-wrapper  .et_b_header-search.et_element-top-level .search-button',
					'property' => 'line-height',
					'value_pattern' => 'calc($px / 2)'
				),
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level input[type="text"]',
					'property' => 'max-width',
					'value_pattern' => 'calc(100% - $px)'
				),
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .search-button',
					'property' => 'width',
					'units' => 'px'
				)
			)
		) );

		// search_border_radius
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_border_radius_et-desktop',
			'label'       => $strings['label']['border_radius'],
			'section'     => 'search',
			'default'     => 0,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .input-row, .et_b_header-search.et_element-top-level .input-row .search-button',
					'property' => 'border-radius',
					'units' => 'px'
				),
			),
		) );

		// search_border_radius
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_border_radius_et-mobile',
			'label'       => $strings['label']['border_radius'],
			'section'     => 'search',
			'default'     => 0,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .input-row, .mobile-header-wrapper .et_b_header-search.et_element-top-level .input-row .search-button',
					'property' => 'border-radius',
					'units' => 'px'
				),
			),
		) );

		// search_color
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'search_color_et-desktop',
			'label'       => esc_html__( 'Placeholder color', 'xstore-core' ),
			'description' => esc_html__( 'Background controls are pretty complex - but extremely useful if properly used.', 'xstore-core' ),
			'section'     => 'search', 
			'default'	  => '#888888',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level input[type="text"]::-webkit-input-placeholder',
					'property' => 'color'
				),
			),
		) );

		// search_background_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'search_background_color_custom_et-desktop',
			'label'       => esc_html__( 'Input Background color', 'xstore-core' ),
			'description' => esc_html__( 'Background controls are pretty complex - but extremely useful if properly used.', 'xstore-core' ),
			'section'     => 'search', 
			'default'	  => '#fff',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .input-row, .et_b_header-search.et_element-top-level input[type="text"]',
					'property' => 'background-color'
				),
			),
		) );

		// search_button_background_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'search_button_background_custom_et-desktop',
			'label'       => esc_html__( 'Button background color', 'xstore-core' ),
			'section'     => 'search',
			'default'	  => '#000000',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .search-button',
					'property' => 'background-color'
				),
			),
		) );

		// search_button_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'search_button_color_et-desktop',
			'label'       => $strings['label']['wcag_color'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'search',
			'default'     => '#ffffff',
			'choices'     => array(
				'setting' => 'search_button_background_custom_et-desktop',
				// 'maxHueDiff'          => 60,   // Optional.
				// 'stepHue'             => 15,   // Optional.
				// 'maxSaturation'       => 0.5,  // Optional.
				// 'stepSaturation'      => 0.1,  // Optional.
				// 'stepLightness'       => 0.05, // Optional.
				// 'precissionThreshold' => 6,    // Optional.
				// 'contrastThreshold'   => 4.5   // Optional.	
				'show'    => array(
					// 'auto'        => false,
					// 'custom'      => false,
					'recommended' => false,
				),	
			),		
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .search-button',
					'property' => 'color'
				)
			),
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'search_input_separator',
			'section'     => 'search',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-editor-removeformatting"></span> <span style="padding-left: 3px;">' . esc_html__( 'Input boxes', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// search_icon_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'kirki-box-model',
			'settings'    => 'search_input_box_model_et-desktop',
			'label'       => esc_html__( 'Input Computed box', 'xstore-core' ),
			'section'     => 'search',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '',
				'margin-bottom'       => '0px',
				'margin-left'         => '',
				'border-top-width'    => '1px',
				'border-right-width'  => '1px',
				'border-bottom-width' => '1px',
				'border-left-width'   => '1px',
				'padding-top'         => '0px',
				'padding-right'       => '0px',
				'padding-bottom'      => '0px',
				'padding-left'        => '10px',
			),
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .input-row',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_b_header-search.et_element-top-level .input-row')
		) );

		// search_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'kirki-box-model',
			'settings'    => 'search_input_box_model_et-mobile',
			'label'       => esc_html__( 'Input Computed box', 'xstore-core' ),
			'section'     => 'search',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '',
				'margin-bottom'       => '0px',
				'margin-left'         => '',
				'border-top-width'    => '1px',
				'border-right-width'  => '1px',
				'border-bottom-width' => '1px',
				'border-left-width'   => '1px',
				'padding-top'         => '0px',
				'padding-right'       => '0px',
				'padding-bottom'      => '0px',
				'padding-left'        => '10px',
			),
			'output'	  => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .input-row',
				),
				array(
					'choice' => 'padding-right',
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .buttons-wrapper',
					'property' => 'right'
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => array_merge(
	        	box_model_output('.mobile-header-wrapper .et_b_header-search.et_element-top-level .input-row'),
	        	array(
	        		array(
						'choice' => 'padding-right',
						'function' => 'css',
						'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .buttons-wrapper',
						'property' => 'right'
					),
	        	)
	        ),
		) );

		// search_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'search_input_border_et-desktop',
			'label'       => esc_html__( 'Input Border style', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .input-row, .ajax-search-form input[type="text"]',
					'property' => 'border-style'
				)
			),
		) );

		// search_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'search_input_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Input Border color', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'search',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .input-row, .ajax-search-form input[type="text"], .ajax-search-form input[type="text"]:focus',
					'property' => 'border-color',
				)
			),
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'search_icon_separator',
			'section'     => 'search',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-code-standards"></span> <span style="padding-left: 3px;">' . esc_html__( 'Icon', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// search_icon_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'kirki-box-model',
			'settings'    => 'search_icon_box_model_et-desktop',
			'label'       => esc_html__( 'Icon Computed box', 'xstore-core' ),
			'section'     => 'search',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '0px',
				'margin-left'         => '0px',
				'border-top-width'    => '0px',
				'border-right-width'  => '0px',
				'border-bottom-width' => '0px',
				'border-left-width'   => '0px',
				'padding-top'         => '10px',
				'padding-right'       => '0px',
				'padding-bottom'      => '10px',
				'padding-left'        => '0px',
			),
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .et_b_search-icon',
				),
				array(
					'choice' => 'padding-bottom',
					'element' => '.ajax-search-form.input-icon:before',
					'property' => 'top',
					'value_pattern' => 'calc(-$ - 3px)'
				),
				array(
					'choice' => 'padding-bottom',
					'element' => '.ajax-search-form.input-icon:before',
					'property' => 'height',
					'value_pattern' => 'calc($ + 3px)'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => array_merge(
	        	box_model_output('.et_b_header-search.et_element-top-level .et_b_search-icon'),
	        	array(
	        		array(
						'choice' => 'padding-bottom',
						'element' => '.ajax-search-form.input-icon:before',
						'function' => 'css',
						'property' => 'top',
						'value_pattern' => 'calc(-$ - 3px)'
					),
					array(
						'choice' => 'padding-bottom',
						'element' => '.ajax-search-form.input-icon:before',
						'function' => 'css',
						'property' => 'height',
						'value_pattern' => 'calc($ + 3px)'
					)
	        	)
	        ),
		) );

		// search_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'kirki-box-model',
			'settings'    => 'search_icon_box_model_et-mobile',
			'label'       => esc_html__( 'Icon Computed box', 'xstore-core' ),
			'section'     => 'search',
			'default'     => $box_models['empty'],
			'output'	  => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-search.et_element-top-level .et_b_search-icon',
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.mobile-header-wrapper .et_b_header-search.et_element-top-level .et_b_search-icon')
		) );

		// search_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'search_icon_border_et-desktop',
			'label'       => esc_html__( 'Icon Border style', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .et_b_search-icon',
					'property' => 'border-style'
				)
			),
		) );

		// search_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'search_icon_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Icon Border color', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'search',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level .et_b_search-icon',
					'property' => 'border-color',
				)
			),
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'search_content_dropdown_separator',
			'section'     => 'search',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-images-alt"></span> <span style="padding-left: 3px;">' . esc_html__( 'Results Dropdown', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// search_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_zoom_et-desktop',
			'label'       => $strings['label']['content_size'],
			'section'     => 'search',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.ajax-search-form:not(.input-icon) .autocomplete-suggestions, .ajax-search-form.input-icon',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// search_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_zoom_et-mobile',
			'label'       => $strings['label']['content_size'],
			'section'     => 'search',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-header-wrapper .ajax-search-form:not(.input-icon) .autocomplete-suggestions, .mobile-header-wrapper .ajax-search-form.input-icon',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// search_content_position
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'search_content_position_et-desktop',
			'label'       => esc_html__( 'Results Dropdown Position', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 'right',
			'multiple'    => 1,
			'choices'     => $choices['dropdown_position'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-search',
					'function' => 'toggleClass',
					'class' => 'et-content-right',
					'value' => 'right'
				),
				array(
					'element'  => '.et_b_header-search',
					'function' => 'toggleClass',
					'class' => 'et-content-left',
					'value' => 'left'
				),
			),
		) );

		// search_content_position
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'search_content_position_custom_et-desktop',
			'label'       => esc_html__( 'Results Dropdown offset', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 0,
			'choices'     => array(
				'min'  => '-300',
				'max'  => '300',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'search_content_position_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-search.et_element-top-level.et-content-dropdown form.et-mini-content, .et_b_header-search.et_element-top-level.et-content-dropdown form:not(.et-mini-content) .ajax-results-wrapper',
					'property' => 'right',
					'units' => 'px'
				),
			),
		) );

		// search_content_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'kirki-box-model',
			'settings'    => 'search_content_box_model_et-desktop',
			'label'       => esc_html__( 'Results Dropdown Computed box', 'xstore-core' ),
			'section'     => 'search',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '0px',
				'margin-left'         => '0px',
				'border-top-width'    => '1px',
				'border-right-width'  => '1px',
				'border-bottom-width' => '1px',
				'border-left-width'   => '1px',
				'padding-top'         => '20px',
				'padding-right'       => '30px',
				'padding-bottom'      => '30px',
				'padding-left'        => '30px',
			),
			'output'	=> array(
				array(
					'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
				),
				array(
					'choice' => 'padding-left',
					'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
					'property' => 'padding-left',
					'value_pattern' => '0px'
				),
				array(
					'choice' => 'padding-right',
					'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
					'property' => 'padding-right',
					'value_pattern' => '0px'
				),
				array(
					'choice' => 'padding-left',
					'element' => '.ajax-search-form .autocomplete-suggestion a, .ajax-search-form .autocomplete-no-suggestion',
					'property' => 'padding-left'
				),
				array(
					'choice' => 'padding-right',
					'element' => '.ajax-search-form .autocomplete-suggestion a, .ajax-search-form .autocomplete-no-suggestion',
					'property' => 'padding-right'
				),
				array(
					'choice' => 'border-top-width',
					'element' => '.ajax-search-form.input-icon'
				),
				array(
					'choice' => 'border-right-width',
					'element' => '.ajax-search-form.input-icon'
				),
				array(
					'choice' => 'border-bottom-width',
					'element' => '.ajax-search-form.input-icon'
				),
				array(
					'choice' => 'border-left-width',
					'element' => '.ajax-search-form.input-icon'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => array_merge(
	        	box_model_output('.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions'),
	        	array(
					array(
						'choice' => 'padding-left',
						'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
						'type'     => 'css',
						'property' => 'padding-left',
						'value_pattern' => '0px'
					),
					array(
						'choice' => 'padding-right',
						'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
						'type'     => 'css',
						'property' => 'padding-right',
						'value_pattern' => '0px'
					),
					array(
						'choice' => 'padding-left',
						'element' => '.ajax-search-form .autocomplete-suggestion a, .ajax-search-form .autocomplete-no-suggestion',
						'type'     => 'css',
						'property' => 'padding-left'
					),
					array(
						'choice' => 'padding-right',
						'element' => '.ajax-search-form .autocomplete-suggestion a, .ajax-search-form .autocomplete-no-suggestion',
						'type'     => 'css',
						'property' => 'padding-right'
					),
					array(
						'choice' => 'border-top-width',
						'type'     => 'css',
						'property' => 'border-top-width',
						'element' => '.ajax-search-form.input-icon'
					),
					array(
						'choice' => 'border-right-width',
						'type'     => 'css',
						'property' => 'border-right-width',
						'element' => '.ajax-search-form.input-icon'
					),
					array(
						'choice' => 'border-bottom-width',
						'type'     => 'css',
						'property' => 'border-bottom-width',
						'element' => '.ajax-search-form.input-icon'
					),
					array(
						'choice' => 'border-left-width',
						'type'     => 'css',
						'property' => 'border-left-width',
						'element' => '.ajax-search-form.input-icon'
					)
	        	)
	      	),
		) );

		// search_content_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'kirki-box-model',
			'settings'    => 'search_content_box_model_et-mobile',
			'label'       => esc_html__( 'Results Dropdown Computed box', 'xstore-core' ),
			'section'     => 'search',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '0px',
				'margin-left'         => '0px',
				'border-top-width'    => '1px',
				'border-right-width'  => '1px',
				'border-bottom-width' => '1px',
				'border-left-width'   => '1px',
				'padding-top'         => '10px',
				'padding-right'       => '10px',
				'padding-bottom'      => '10px',
				'padding-left'        => '10px',
			),
			'output'	=> array(
				array(
					'element' => '.mobile-header-wrapper .ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
				),
				array(
					'choice' => 'padding-left',
					'element' => '.mobile-header-wrapper .ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
					'property' => 'padding-left',
					'value_pattern' => '0px'
				),
				array(
					'choice' => 'padding-right',
					'element' => '.mobile-header-wrapper .ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
					'property' => 'padding-right',
					'value_pattern' => '0px'
				),
				array(
					'choice' => 'padding-left',
					'element' => '.mobile-header-wrapper .ajax-search-form .autocomplete-suggestion a, .mobile-header-wrapper .ajax-search-form .autocomplete-no-suggestion',
					'property' => 'padding-left'
				),
				array(
					'choice' => 'padding-right',
					'element' => '.mobile-header-wrapper .ajax-search-form .autocomplete-suggestion a, .mobile-header-wrapper .ajax-search-form .autocomplete-no-suggestion',
					'property' => 'padding-right'
				),
				array(
					'choice' => 'border-top-width',
					'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
				),
				array(
					'choice' => 'border-right-width',
					'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
				),
				array(
					'choice' => 'border-bottom-width',
					'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
				),
				array(
					'choice' => 'border-left-width',
					'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => array_merge(
	        	box_model_output('.mobile-header-wrapper .ajax-search-form .ajax-results-wrapper .autocomplete-suggestions'),
	        	array(
					array(
						'choice' => 'padding-left',
						'type'     => 'css',
						'element' => '.mobile-header-wrapper .ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
						'property' => 'padding-left',
						'value_pattern' => '0px'
					),
					array(
						'choice' => 'padding-right',
						'type'     => 'css',
						'element' => '.mobile-header-wrapper .ajax-search-form .ajax-results-wrapper .autocomplete-suggestions',
						'property' => 'padding-right',
						'value_pattern' => '0px'
					),
					array(
						'choice' => 'padding-left',
						'type'     => 'css',
						'element' => '.mobile-header-wrapper .ajax-search-form .autocomplete-suggestion a, .mobile-header-wrapper .ajax-search-form .autocomplete-no-suggestion',
						'property' => 'padding-left'
					),
					array(
						'choice' => 'padding-right',
						'type'     => 'css',
						'element' => '.mobile-header-wrapper .ajax-search-form .autocomplete-suggestion a, .mobile-header-wrapper .ajax-search-form .autocomplete-no-suggestion',
						'property' => 'padding-right'
					),
					array(
						'choice' => 'border-top-width',
						'type'     => 'css',
						'property' => 'border-top-width',
						'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
					),
					array(
						'choice' => 'border-right-width',
						'type'     => 'css',
						'property' => 'border-right-width',
						'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
					),
					array(
						'choice' => 'border-bottom-width',
						'type'     => 'css',
						'property' => 'border-bottom-width',
						'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
					),
					array(
						'choice' => 'border-left-width',
						'type'     => 'css',
						'property' => 'border-left-width',
						'element' => '.mobile-header-wrapper .ajax-search-form.input-icon'
					)
	        	)
	      	),
		) );

		// search_content_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'search_content_border_et-desktop',
			'label'       => esc_html__( 'Results Dropdown Border style', 'xstore-core' ),
			'section'     => 'search',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					// 'element' => '.ajax-search-form:not(.input-icon) .autocomplete-suggestions, .ajax-search-form.input-icon',
					'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions, .ajax-search-form.input-icon',
					'property' => 'border-style',
				),
			),
		) );

		// search_content_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'search_content_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Results Dropdown Border color', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'search',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					// 'element' => '.ajax-search-form:not(.input-icon) .autocomplete-suggestions, .ajax-search-form.input-icon',
					'element' => '.ajax-search-form .ajax-results-wrapper .autocomplete-suggestions, .ajax-search-form.input-icon',
					'property' => 'border-color',
				),
			),
		) );
?>