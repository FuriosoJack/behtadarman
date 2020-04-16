<?php 
	/**
	 * The template created for displaying header secondary menu element options
	 *
	 * @version 1.0.5
	 * @since 1.4.0
 	 * last changes in 1.5.5
	 */

	// section secondary menu
	Kirki::add_section( 'main_menu_2', array(
	    'title'          => esc_html__( 'Secondary menu', 'xstore-core' ),
	    'panel'          => 'header-builder',
	    'icon' => 'dashicons-menu'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'menu_2_content_separator',
			'section'     => 'main_menu_2',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// menu_2_item_style
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'menu_2_item_style_et-desktop',
			'label'       => $strings['label']['style'],
			'section'     => 'main_menu_2',
			'default'     => 'underline',
			'choices'     => $menu_settings['style'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.header-main-menu2',
					'function' => 'toggleClass',
					'class' => 'menu-items-none',
					'value' => 'none'
				),
				array(
					'element'  => '.header-main-menu2',
					'function' => 'toggleClass',
					'class' => 'menu-items-underline',
					'value' => 'underline'
				),
				array(
					'element'  => '.header-main-menu2',
					'function' => 'toggleClass',
					'class' => 'menu-items-overline',
					'value' => 'overline'
				),
				array(
					'element'  => '.header-main-menu2',
					'function' => 'toggleClass',
					'class' => 'menu-items-dots',
					'value' => 'dots'
				),
				array(
					'element'  => '.header-main-menu2',
					'function' => 'toggleClass',
					'class' => 'menu-items-custom',
					'value' => 'custom'
				),
			),
			'partial_refresh' => array(
				'menu_2_item_style_et-desktop' => array(
					'selector'  => '.header-main-menu2',
					'render_callback' => 'main_menu2_callback'
				),
			),
		) );

		// menu_item_separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu_2_item_dots_separator_et-desktop',
			'label'       => $menu_settings['strings']['label']['sep_type'],
			'section'     => 'main_menu_2',
			'default'	  => '\2022',
			'choices'     => $menu_settings['separators'],
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'dots',
				),
			),
			'transport' => 'auto',
			'output'  => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li .et_b_header-menu-sep:before',
					'property' => 'content',
					'value_pattern' => '"$"'
				),
			),
		) );

		// main_menu_2_term 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'main_menu_2_term',
			'label'       => $strings['label']['select_menu'],
			'section'     => 'main_menu_2',
			'choices'     => $post_types['menus'],
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'main_menu_2_term' => array(
					'selector'  => '.header-main-menu2',
					'render_callback' => 'main_menu2_callback'
				),
			),
		) );

		// menu_2_one_page
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'menu_2_one_page',
			'label'       => $menu_settings['strings']['label']['one_page'],
			'description' => $menu_settings['strings']['description']['one_page'],
			'section'     => 'main_menu_2',
			'default'     => '0',
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'menu_2_one_page' => array(
					'selector'  => '.header-main-menu2',
					'render_callback' => 'main_menu2_callback'
				),
			),
		) );

		// menu_2_arrows 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'menu_2_arrows',
			'label'       => $menu_settings['strings']['label']['arrows'],
			'section'     => 'main_menu_2',
			'default'     => 1,
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.header-main-menu2 .item-level-0 > a > svg.arrow',
					'function' => 'toggleClass',
					'class' => 'none',
					'value' => false
				),
			),
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'menu_2_style_separator',
			'section'     => 'main_menu_2',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// menu_2_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'menu_2_zoom_et-desktop',
			'label'       => $strings['label']['content_zoom'],
			'section'     => 'main_menu_2',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// menu_2_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'menu_2_zoom_et-mobile',
			'label'       => $strings['label']['content_zoom'],
			'section'     => 'main_menu_2',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-device .header-main-menu2.et_element-top-level',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// menu_2_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'menu_2_alignment_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'main_menu_2',
			'default'     => 'center',
			'choices'     => $choices['alignment2'],
			'transport' => 'auto',
			'output' => array (
				array (
					'element' => '.header-main-menu2.et_element-top-level',
					'property' => 'justify-content',
				),
			)
		) );

		// menu_2_item_settings
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'menu_2_item_fonts_et-desktop',
			'section'     => 'main_menu_2',
			'default'     => $menu_settings['fonts'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li > a',
				),
			),
		) );

		// menu_2_item_border_radius
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'menu_2_item_border_radius_et-desktop',
			'label'       => $strings['label']['border_radius'],
			'section'     => 'main_menu_2',
			'default'     => 30,
			'choices'     => array(
				'min'  => '0',
				'max'  => '70',
				'step' => '1',
			),	
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level.menu-items-custom .menu > li > a',
					'property' => 'border-radius',
					'units' => 'px'
				),
			),
		) );

		// menu_item_color
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_color_custom_et-desktop',
			'label'       => $menu_settings['strings']['label']['color'],
			'section'     => 'main_menu_2',
			'default'     => '#555555',
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.header-main-menu2.et_element-top-level.menu-items-custom .menu > li > a',
					'property' => 'color',
				),
			),
		) );

		// menu_item_element_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_background_color_custom_et-desktop',
			'label'       => $strings['label']['bg_color'],
			'section'     => 'main_menu_2',
			'default'     => '#c62828',
			'choices' => array (
				'alpha' => true
			),
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level.menu-items-custom .menu > li > a',
					'property' => 'background-color',
				),
			),
		) );

		// menu_2_item_hover_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_hover_color_custom_et-desktop',
			'label'       => $menu_settings['strings']['label']['hover_color'],
			'section'     => 'main_menu_2',
			'default'     => '#222222',
			'transport' => 'auto',
			'output' => array(
				array(
					'element'  => '.header-main-menu2.et_element-top-level .menu > li > a:hover, .header-main-menu2.et_element-top-level .menu > .current-menu-item > a, .header-main-menu2.et_element-top-level.menu-items-custom .menu > li > a:hover, .header-main-menu2.et_element-top-level.menu-items-custom .menu > .current-menu-item > a',
					'property' => 'color',
				),
			),
		) );

		// menu_item_line_hover_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_line_hover_color_custom_et-desktop',
			'label'       => $menu_settings['strings']['label']['line_color'],
			'description' => $menu_settings['strings']['description']['line_color'],
			'section'     => 'main_menu_2',
			'default'     => '#555555',
			'choices' => array (
				'alpha' => true
			),			
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => 'in',
					'value'    => array('underline', 'overline'),
				),
			),
			'transport' => 'auto',
			'output' => array (
				array (
					'element' => '.header-main-menu2.et_element-top-level .menu > li > a:before, .header-main-menu2.et_element-top-level .menu > .current-menu-item > a:before',
					'property' => 'background-color'
				),
			),
		) );

		// menu_item_dots_color
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu_2_item_dots_color_et-desktop',
			'label'       => $menu_settings['strings']['label']['dots_color'],
			'description' => $menu_settings['strings']['description']['dots_color'],
			'section'     => 'main_menu_2',
			'default'     => 'current',
			'choices'     => $choices['colors'],
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'dots',
				),
			),
			'output' => array (
				array (
					'element' => '.header-main-menu2.et_element-top-level .menu > li .et_b_header-menu-sep',
					'property' => 'color',
					'value_pattern' => 'var(--$-color)'
				),
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li .et_b_header-menu-sep',
					'property' => 'opacity',
					'value_pattern' => '.5'
				)
			),
		) );

		// menu_item_dots_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_dots_color_custom_et-desktop',
			'label'       => $menu_settings['strings']['label']['dots_color'],
			'description' => $menu_settings['strings']['description']['dots_color'],
			'section'     => 'main_menu_2',
			'default'     => '#555555',
			'choices' => array (
				'alpha' => true
			),			
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'dots',
				),
				array(
					'setting'  => 'menu_2_item_dots_color_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array (
				array (
					'element' => '.header-main-menu2.et_element-top-level .menu > li .et_b_header-menu-sep',
					'property' => 'color'
				),
				array (
					'element' => '.header-main-menu2.et_element-top-level .menu > li .et_b_header-menu-sep',
					'property' => 'opacity',
					'value_pattern' => '1'
				),
			),
		) );

		// menu_item_background_hover_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_background_hover_color_custom_et-desktop',
			'label'       => $menu_settings['strings']['label']['bg_hover_color'],
			'description' => $menu_settings['strings']['description']['bg_hover_color'],
			'section'     => 'main_menu_2',
			'default'     => '#e1e1e1',
			'choices' => array (
				'alpha' => true
			),			
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array (
				array (
					'element' => '.header-main-menu2.et_element-top-level.menu-items-custom .menu > li > a:hover, .header-main-menu2.et_element-top-level.menu-items-custom .menu > .current-menu-item > a',
					'property' => 'background-color'
				),
			),
		) );

		// menu_2_item_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'menu_2_item_box_model_et-desktop',
			'label'       => $menu_settings['strings']['label']['item_box_model'],
			'description' => $menu_settings['strings']['description']['item_box_model'],
			'type'        => 'kirki-box-model',
			'section'     => 'main_menu_2',
			'default'     => $menu_settings['item_box_model'],
			'output' => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li > a',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.header-main-menu2.et_element-top-level .menu > li > a')
		) );

		// menu_2_nice_space
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'menu_2_nice_space_et-desktop',
			'label'       => $menu_settings['strings']['label']['nice_space'],
			'section'     => 'main_menu_2',
			'default'     => '0',
		) );

		// menu_2_item_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'menu_2_item_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'main_menu_2',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '!=',
					'value'    => 'dots',
				),
			),
			'output' => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li > a',
					'property' => 'border-style',
				),
			),
		) );

		// menu_2_item_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_border_color_custom_et-desktop',
			'label'       => $menu_settings['strings']['label']['border_hover_color'],
			'description' => $strings['description']['border_color'],
			'section'     => 'main_menu_2',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '!=',
					'value'    => 'dots',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li > a',
					'property' => 'border-color',
				),
			),
		) );

		// menu_item_border_hover_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'menu_2_item_border_hover_color_custom_et-desktop',
			'label'       => esc_html__( 'Border color (hover, active)', 'xstore-core' ),
			'description' => esc_html__( 'You have to set up border width via Computed box below. To have correct invisible border, please set up alpha chanel to 0', 'xstore-core' ),
			'section'     => 'main_menu_2',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'active_callback' => array(
				array(
					'setting'  => 'menu_2_item_style_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-main-menu2.et_element-top-level .menu > li > a:hover, .header-main-menu2.et_element-top-level .menu > .current-menu-item > a',
					'property' => 'border-color',
				),
			),
		) );

		// go_to_menu_2_dropdown
		Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'custom',
	        'settings'    => 'go_to_section'.$index++,
	        'section'     => 'main_menu_2',
	        'default'     => '<span class="et_edit" data-section="menu_2_dropdown_style_separator" style="padding: 5px 7px; border-radius: 2px; background: #222; color: #fff; ">' . esc_html__( 'Dropdown settings', 'xstore-core' ) . '</span>',
	        'priority'    => 10,
	    ) );
?>