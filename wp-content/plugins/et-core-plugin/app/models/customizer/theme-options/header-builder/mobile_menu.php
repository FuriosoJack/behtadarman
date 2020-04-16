<?php 
	/**
	 * The template created for displaying header mobile menu element options
	 *
	 * @version 1.0.6
	 * @since 1.4.0
  	 * last changes in 2.0.0
	 */

	// section mobile_menu
	Kirki::add_section( 'mobile_menu', array(
	    'title'          => esc_html__( 'Mobile menu', 'xstore-core' ),
	    'panel' => 'header-builder',
	    'icon' => 'dashicons-menu'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'mobile_menu_content_separator',
			'section'     => 'mobile_menu',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// mobile_menu_off_canvas
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'mobile_menu_type_et-desktop',
			'label'       => esc_html__( 'Off-canvas type', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 'off_canvas_left',
			'choices'     => array(
				'off_canvas_left'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/mobile_menu/Style-mobile-menu-1.svg',
				'popup' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/mobile_menu/Style-mobile-menu-2.svg',
				'off_canvas_right' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/mobile_menu/Style-mobile-menu-3.svg',
			),
			// need time to improve and check more
			// 'transport' => 'postMessage',
			// 'partial_refresh' => array(
			// 	'mobile_menu_type_et-desktop' => array(
			// 		'selector'  => '.et_b_header-mobile-menu',
			// 		'render_callback' => 'mobile_menu_callback'
			// 	),
			// ),
			// 'js_vars'     => array(
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu',
			// 		'function' => 'toggleClass',
			// 		'class' => 'et-content-left',
			// 		'value' => 'off_canvas_left'
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu',
			// 		'function' => 'toggleClass',
			// 		'class' => 'et-content-right',
			// 		'value' => 'off_canvas_right'
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu .et-mini-content .et-close',
			// 		'function' => 'toggleClass',
			// 		'class' => 'full-right',
			// 		'value' => 'off_canvas_left'
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu .et-mini-content .et-close',
			// 		'function' => 'toggleClass',
			// 		'class' => 'full-left',
			// 		'value' => 'off_canvas_right'
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu',
			// 		'function' => 'toggleClass',
			// 		'class' => 'et-content_toggle',
			// 		// 'value' => array('off_canvas_left', 'off_canvas_right') not working
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu',
			// 		'function' => 'toggleClass',
			// 		'class' => 'et-off-canvas',
			// 		// 'value' => array('off_canvas_left', 'off_canvas_right') not working
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label',
			// 		'function' => 'toggleClass',
			// 		'class' => 'et-toggle',
			// 		// 'value' => array('off_canvas_left', 'off_canvas_right') not working
			// 	),
			// 	array(
			// 		'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label',
			// 		'function' => 'toggleClass',
			// 		'class' => 'et-popup_toggle',
			// 		'value' => 'popup'
			// 	),
			// ),
		) );

		// mobile_menu_icon
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'mobile_menu_icon_et-desktop',
			'label'       => $strings['label']['icon'],
			'section'     => 'mobile_menu',
			'default'     => 'icon1',
			'choices'     => array(
				'icon1'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/mobile_menu/Icon-1.svg',
				'icon2'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/mobile_menu/Icon-2.svg',
				'custom'  => ETHEME_CODE_CUSTOMIZER_IMAGES . '/global/icon-custom.svg',
				'none'    => ETHEME_CODE_CUSTOMIZER_IMAGES . '/global/icon-none.svg' 
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'icon1' => array(
					'selector'        => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label .et_b-icon',
					'render_callback' => function() {
						switch (get_theme_mod('mobile_menu_icon_et-desktop')) {
							case 'icon1':
								$icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0.792 5.904h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744zM23.208 11.256h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744zM23.208 18.096h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744z"></path></svg>';
								break;
							case 'icon2':
								$icon = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="1em" height="1em" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><g><path d="M26,37h47.7c1.7,0,3.3-1.3,3.3-3.3s-1.3-3.3-3.3-3.3H26c-1.7,0-3.3,1.3-3.3,3.3S24.3,37,26,37z"/><path d="M74,46.7H26c-1.7,0-3.3,1.3-3.3,3.3s1.3,3.3,3.3,3.3h47.7c1.7,0,3.3-1.3,3.3-3.3S75.7,46.7,74,46.7z"/><path d="M74,63H26c-1.7,0-3.3,1.3-3.3,3.3s1.3,3.3,3.3,3.3h47.7c1.7,0,3.3-1.3,3.3-3.3S75.7,63,74,63z"/></g><path d="M50,0C22.3,0,0,22.3,0,50s22.3,50,50,50s50-22.3,50-50S77.7,0,50,0z M50,93.7C26,93.7,6.3,74,6.3,50S26,6.3,50,6.3S93.7,26,93.7,50S74,93.7,50,93.7z"/></svg>';
								break;
							case 'custom':
								$icon = get_theme_mod('mobile_menu_icon_custom_et-desktop');
								break;
							default:
								$icon = '';
								break;
						}
						return $icon;
					},
				),
			),
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label .et_b-icon',
					'function' => 'toggleClass',
					'class' => 'none',
					'value' => 'none'
				),
			),
		) );

		// mobile_menu_icon_custom
		Kirki::add_field( 'et_kirki_options', array (
			'type'     => 'code',
			'settings' => 'mobile_menu_icon_custom_et-desktop',
			'label'    => $strings['label']['custom_icon_svg'],
			'section'  => 'mobile_menu',
			'default'  => '',
			'choices'  => array(
				'language' => 'html'
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_icon_et-desktop',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'        => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label .et_b-icon',
					'function' => 'html',
				),
			),
		) );

		// mobile_menu_icon_zoom 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_icon_zoom_et-desktop',
			'label'       => esc_html__( 'Icon zoom (proportion)', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 1,
			'choices'     => array(
				'min'  => '.7',
				'max'  => '3',
				'step' => '.1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_icon_et-desktop',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-mobile-menu > span svg',
					'property' => 'width',
					'units' => 'em'
				),
				array(
					'element' => '.et_b_header-mobile-menu > span svg',
					'property' => 'height',
					'units' => 'em'
				)
			)
		) );

		// mobile_menu_icon_zoom 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_icon_zoom_et-mobile',
			'label'       => $strings['label']['icons_zoom'],
			'section'     => 'mobile_menu',
			'default'     => 1,
			'choices'     => array(
				'min'  => '.7',
				'max'  => '3',
				'step' => '.1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_icon_et-desktop',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-mobile-menu > span svg',
					'property' => 'width',
					'units' => 'em'
				),
				array(
					'element' => '.mobile-header-wrapper .et_b_header-mobile-menu > span svg',
					'property' => 'height',
					'units' => 'em'
				)
			)
		) );

		// mobile_menu_label
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'mobile_menu_label_et-desktop',
			'label'       => esc_html__( 'Show label', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => '0',
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label > span:not(.et_b-icon)',
					'function' => 'toggleClass',
					'class' => 'none',
					'value' => false
				),
			),
		) );

		// mobile_menu_text
		Kirki::add_field( 'et_kirki_options', array (
			'type'     => 'text',
			'settings' => 'mobile_menu_text',
			'section'  => 'mobile_menu',
			'default'  => esc_html__( 'Menu', 'xstore-core' ),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_label_et-desktop',
					'operator' => '==',
					'value'    => '1',
				),
			),
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper .et-element-label > span:not(.et_b-icon)',
					'function' => 'html',
				),
			),
		) );

		// elements separator 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'mobile_menu_elements_separator',
			'section'     => 'mobile_menu',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-list-view"></span> <span style="padding-left: 3px;">' . esc_html__( 'Elements', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// mobile_menu_content
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'sortable',
			'label'       => $strings['label']['elements'],
			'description' => esc_html__('On/Off elements you need. Drag&Drop to change order.', 'xstore-core'),
			'section'     => 'mobile_menu',
			'priority'    => 10,
			'settings'     => 'mobile_menu_content',
			'default'	  => array(
				'logo',
				'search',
				'menu',
				'header_socials'
			),
			'choices'      => array(
				'logo' => esc_html__( 'Logo', 'xstore-core' ),
				'search' => esc_html__( 'Search', 'xstore-core' ),
				'menu' => esc_html__( 'Menu', 'xstore-core' ),
				'wishlist' => esc_html__( 'Wishlist', 'xstore-core' ),
				'cart' => esc_html__( 'Cart', 'xstore-core' ),
				'account' => esc_html__( 'Account', 'xstore-core' ),
				'header_socials' => esc_html__( 'Socials', 'xstore-core' ),
				'button' => esc_html__( 'Button', 'xstore-core' ),
				'html_block1' => esc_html__( 'HTML Block 01', 'xstore-core' ),
				'html_block2' => esc_html__( 'HTML Block 02', 'xstore-core' ),
				'html_block3' => esc_html__( 'HTML Block 03', 'xstore-core' ),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_content' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// mobile_menu_2
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_menu_2',
			'label'       => esc_html__( 'Extra tab content', 'xstore-core' ),
			'description' => esc_html__('Displays the product categories', 'xstore-core'),
			'section'     => 'mobile_menu',
			'default' => 'none',
			'choices'     => array(
				'none' => esc_html__('None', 'xstore-core'),
				'categories' => esc_html__('Categories', 'xstore-core'),
				'menu' => esc_html__('Menu', 'xstore-core'),
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'menu'
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_2' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// mobile_menu_2_term
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_menu_2_term',
			'label'       => $strings['label']['select_menu'],
			'section'     => 'mobile_menu',
			'choices'     => $post_types['menus'],
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'menu'
				),
				array(
					'setting'  => 'mobile_menu_2',
					'operator' => '==',
					'value'    => 'menu'
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_2_term' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// mobile_menu_tab_2_text
		Kirki::add_field( 'et_kirki_options', array (
			'type'     => 'text',
			'settings' => 'mobile_menu_tab_2_text',
			'label'    => esc_html__('Extra tab title', 'xstore-core'),
			'section'  => 'mobile_menu',
			'default'  => esc_html__( 'Categories', 'xstore-core' ),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'menu'
				),
				array(
					'setting'  => 'mobile_menu_2',
					'operator' => '!=',
					'value'    => 'none'
				),
			),
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.mobile-menu-content .et_b-tabs .et-tab[data-tab="menu_2"]',
					'function' => 'html',
				),
			),
		) );

		// mobile_menu_item_click
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'mobile_menu_item_click_et-desktop',
			'label'       => esc_html__( 'Dropdown opening action', 'xstore-core' ),
			'description' => esc_html__('Open dropdown only on arrow click. Check on real devices, please.', 'xstore-core'),
			'section'     => 'mobile_menu',
			'default'     => '0',
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'menu'
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_item_click_et-desktop' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// mobile_menu_term
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_menu_term',
			'label'       => $strings['label']['select_menu'],
			'section'     => 'mobile_menu',
			'choices'     => $post_types['menus'],
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'menu'
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_term' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// mobile_menu_one_page
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'mobile_menu_one_page',
			'label'       => esc_html__( 'One page menu', 'xstore-core' ),
			'description' => esc_html__( 'Enable when your menu is working only for one page by anchors', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => '0',
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'menu'
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_one_page' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// mobile_menu_logo_type
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'mobile_menu_logo_type_et-desktop',
			'label'       => esc_html__( 'Logo', 'xstore-core' ),
			'description' => sprintf( esc_html__('Choose the header logo from %s main %s or %s sticky %s header ', 'xstore-core'), 
				'<span class="et_edit" data-section="logo_content_separator" data-option="#customize-control-logo_img" style="color: #222;">', '</span>', 
				'<span class="et_edit" data-section="header_sticky_content_separator" data-option="#customize-control-headers_sticky_logo_img" style="color: #222;">', '</span>' ),
			'section'     => 'mobile_menu',
			'default'     => 'simple',
			'multiple'    => 1,
			'choices'     => array(
				'simple' => esc_html__( 'Main header', 'xstore-core' ),
				'sticky' => esc_html__( 'Sticky header', 'xstore-core' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'logo'
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'mobile_menu_logo_type_et-desktop' => array(
					'selector'  => '.mobile-menu-content',
					'render_callback' => 'mobile_menu_content_callback'
				),
			),
		) );

		// logo_width
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_logo_width_et-desktop',
			'label'       => esc_html__( 'Logo width (px)', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 200,
			'choices'     => array(
				'min'  => '10',
				'max'  => '300',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_content',
					'operator' => 'in',
					'value'    => 'logo'
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.mobile-menu-content .et_b_header-logo img',
					'property' => 'width',
					'units' => 'px'
				)
			)
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'mobile_menu_style_separator',
			'section'     => 'mobile_menu',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// mobile_menu_content_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'mobile_menu_content_alignment_et-desktop',
			'label'       => esc_html__( 'Alignment of the menu icon', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 'start',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper',
					'function' => 'toggleClass',
					'class' => 'justify-content-start',
					'value' => 'start'
				),
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper',
					'function' => 'toggleClass',
					'class' => 'justify-content-center',
					'value' => 'center'
				),
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper',
					'function' => 'toggleClass',
					'class' => 'justify-content-end',
					'value' => 'end'
				),
			),
		) );

		// mobile_menu_content_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'mobile_menu_content_alignment_et-mobile',
			'label'       => esc_html__( 'Alignment of the menu icon', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 'start',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper',
					'function' => 'toggleClass',
					'class' => 'mob-justify-content-start',
					'value' => 'start'
				),
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper',
					'function' => 'toggleClass',
					'class' => 'mob-justify-content-center',
					'value' => 'center'
				),
				array(
					'element'  => '.et_b_header-mobile-menu .et-element-label-wrapper',
					'function' => 'toggleClass',
					'class' => 'mob-justify-content-end',
					'value' => 'end'
				),
			),
		) );

		// mobile_menu_box_model 
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_box_model_et-desktop',
			'label'       => esc_html__( 'Computed box of the menu icon', 'xstore-core' ),
			'description' => esc_html__( 'You can select the margin, border-width and padding for menu icon element.', 'xstore-core' ),
			'type'        => 'kirki-box-model',
			'section'     => 'mobile_menu',
			'default'     => $box_models['empty'],
			'output' => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle')
		) );

		// mobile_menu_box_model 
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_box_model_et-mobile',
			'label'       => esc_html__( 'Computed box of the menu icon', 'xstore-core' ),
			'description' => esc_html__( 'You can select the margin, border-width and padding for menu icon element.', 'xstore-core' ),
			'type'        => 'kirki-box-model',
			'section'     => 'mobile_menu',
			'default'     => $box_models['empty'],
			'output' => array(
				array(
					'element' => '.mobile-header-wrapper .et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .mobile-header-wrapper .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.mobile-header-wrapper .et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .mobile-header-wrapper .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle')
		) );

		// mobile_menu_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_menu_border_et-desktop',
			'label'       => esc_html__( 'Border style of the menu icon', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle',
      				'property' => 'border-style'
				)
			),
		) );

		// mobile_menu_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_menu_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Border color of the menu icon', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'mobile_menu',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),			
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle',
      				'property' => 'border-color',
				)
			),
		) );

		// mobile_border_radius
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_border_radius_et-desktop',
			'label'       => $strings['label']['border_radius'],
			'section'     => 'mobile_menu',
			'default'     => 0,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-element-label-wrapper .et-toggle, .et_b_header-mobile-menu > .et-element-label-wrapper .et-popup_toggle',
					'property' => 'border-radius',
					'units' => 'px'
				)
			)
		) );

		// separator content
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'mobile_menu_dropdown_separator',
			'section'     => 'mobile_menu',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-editor-outdent"></span> <span style="padding-left: 3px;">' . esc_html__( 'Off-Canvas content', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '!=',
					'value'    => 'popup'
				),
			),
		) );

		// separator content
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'mobile_menu_popup_separator',
			'section'     => 'mobile_menu',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-external"></span> <span style="padding-left: 3px;">' . esc_html__( 'Popup content', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '==',
					'value'    => 'popup'
				),
			),
		) );

		// mobile_menu_content_fonts 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'mobile_menu_content_fonts_et-desktop',
			'section'     => 'mobile_menu',
			'default'     => array(
				'font-family'    => '',
				'variant'        => 'regular',
				// 'font-size'      => '15px',
				// 'line-height'    => '1.5',
				// 'letter-spacing' => '0',
				// 'color'          => '#555',
				'text-transform' => 'inherit',
				// 'text-align'     => 'left',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-menu-content',
				),
			),
		) );

		// mobile_menu_zoom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_zoom_dropdown_et-desktop',
			'label'       => $strings['label']['content_size'],
			'section'     => 'mobile_menu',
			'default'     => 100,
			'choices'     => array(
				'min'  => '10',
				'max'  => '200',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '!=',
					'value'    => 'popup'
				),
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-mini-content',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// mobile_menu_zoom_popup
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_zoom_popup_et-desktop',
			'label'       => $strings['label']['content_size'],
			'section'     => 'mobile_menu',
			'default'     => 100,
			'choices'     => array(
				'min'  => '0',
				'max'  => '200',
				'step' => '1',
			),			
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '==',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-menu-popup',
					'property' => '--content-zoom',
					'value_pattern' => 'calc($em * .01)'
				),
			),
		) );

		// mobile_menu_zoom_popup
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_items_space_popup_et-desktop',
			'label'       => esc_html__( 'Items space (px)', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 10,
			'choices'     => array(
				'min'  => '0',
				'max'  => '50',
				'step' => '1',
			),			
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '==',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.mobile-menu-content > .et_element:not(:last-child),
						.et-mobile-tabs-wrapper:not(:last-child), 
						.mobile-menu-content .et_b_header-contacts .contact:not(:last-child),
						.mobile-menu-content .et_b_header-button',
					'property' => 'margin-bottom',
					'value_pattern' => 'calc(2 * $px)'
				),
				array(
					'element' => '.mobile-menu-content > .et_element > .menu-main-container,
							.et-mobile-tab-content',
					'property' => 'margin-top',
					'value_pattern' => '-$px'
				),
				array(
					'element' => '.mobile-menu-content > .et_element > .menu-main-container,
							.et-mobile-tab-content',
					'property' => 'margin-bottom',
					'value_pattern' => '-$px'
				),
				array(
					'element' => 'div.mobile-menu-content .et_b_header-menu .menu li a, .et-mobile-tab-content .widget .cat-item a',
					'property' => 'padding-top',
					'units' => 'px'
				),
				array(
					'element' => 'div.mobile-menu-content .et_b_header-menu .menu li a, .et-mobile-tab-content .widget .cat-item a',
					'property' => 'padding-bottom',
					'units' => 'px'
				)
			),
		) );

		// mobile_menu_overlay
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_overlay_et-desktop',
			'label'       => esc_html__( 'Overlay background', 'xstore-core' ),
			'description' => esc_html__( 'Select a background color for your content.', 'xstore-core' ),
			'type'        => 'color',
			'section'     => 'mobile_menu',
			'default'     => 'rgba(0,0,0,.3)',
			'choices' => array (
				'alpha' => true
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '==',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et-popup-wrapper.mobile-menu-popup:before',
					'property' => 'background-color'
				),
				array(
					'element' => '.mobile-menu-popup .et-close-popup',
					'property' => 'color'
				)
			)
		) );

		// mobile_menu_background_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_background_color_et-desktop',
			'label'       => esc_html__( 'Off-Canvas content WCAG Control (background)', 'xstore-core' ),
			'description' => $strings['description']['wcag_bg_color'],
			'type'        => 'color',
			'section'     => 'mobile_menu',
			'default'     => '#ffffff',
			'choices' => array (
				'alpha' => true
			),
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '!=',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-mobile-menu .et-mini-content',
					'property' => 'background-color'
				),
				// array(
				// 	'element' => '.et_b_header-mobile-menu .et-mini-content > .et-toggle',
				// 	'property' => 'color'
				// )
			),
		) );

		// mobile_menu_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_color_et-desktop',
			'label'       => esc_html__( 'Off-Canvas content WCAG Color', 'xstore-core' ),
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'mobile_menu',
			'default'     => '#000000',
			'choices'     => array(
				'setting' => 'mobile_menu_background_color_et-desktop',
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
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '!=',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.mobile-menu-content',
					'property' => 'color'
				),
				// array(
				// 	'element' => '.et_b_header-mobile-menu .et-mini-content > .et-toggle',
				// 	'property' => 'background-color'
				// )
			),
		) );

		// mobile_menu_color2
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_color2_et-desktop',
			'label'       => esc_html__( 'Popup content WCAG Color', 'xstore-core' ),
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'mobile_menu',
			'default'     => '#ffffff',
			'choices'     => array(
				'setting' => 'mobile_menu_overlay_et-desktop',
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
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '==',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.mobile-menu-content',
					'property' => 'color'
				),
				// array(
				// 	'element' => '.mobile-menu-popup .et-close-popup',
				// 	'property' => 'background-color'
				// ),
			),
		) );

		// mobile_menu_max_height
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'mobile_menu_max_height_et-desktop',
			'label'       => esc_html__( 'Max height (%)', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 70,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),			
			'active_callback' => array(
				array(
					'setting'  => 'mobile_menu_type_et-desktop',
					'operator' => '==',
					'value'    => 'popup',
				),
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element'  => '.mobile-menu-popup .et-popup-content',
					'property' => 'max-height',
					'units'	   => 'vh'
				),
			),
		) );

		// mobile_menu_content_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'mobile_menu_content_box_model_et-desktop',
			'label'       => esc_html__( 'Off-Canvas content Computed box', 'xstore-core' ),
			'description' => esc_html__( 'You can select the margin, border-width and padding for off-canvas content element.', 'xstore-core' ),
			'type'        => 'kirki-box-model',
			'section'     => 'mobile_menu',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '',
				'margin-bottom'       => '0px',
				'margin-left'         => '',
				'border-top-width'    => '0px',
				'border-right-width'  => '0px',
				'border-bottom-width' => '0px',
				'border-left-width'   => '0px',
				'padding-top'         => '10px',
				'padding-right'       => '10px',
				'padding-bottom'      => '10px',
				'padding-left'        => '10px',
			),
			'output'	  => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-mini-content,
								.mobile-menu-popup .et-popup-content',
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_b_header-mobile-menu > .et-mini-content,
								.mobile-menu-popup .et-popup-content')
		) );

		// mobile_menu_content_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'mobile_menu_content_border_et-desktop',
			'label'       => esc_html__( 'Off-Canvas/Popup content Border style', 'xstore-core' ),
			'section'     => 'mobile_menu',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-mini-content,
      							 .mobile-menu-popup .et-popup-content',
      				'property' => 'border-style'
				)
			),
		) );

		// mobile_menu_content_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'mobile_menu_content_border_color_custom_et-desktop',
			'label'       => esc_html__( 'Off-Canvas/Popup content Border color', 'xstore-core' ),
			'description' => $strings['description']['border_color'],
			'section'     => 'mobile_menu',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_b_header-mobile-menu > .et-mini-content,
      							 .mobile-menu-popup .et-popup-content',
      				'property' => 'border-color',
				)
			),
		) );
?>