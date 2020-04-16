<?php  
	/**
	 * The template created for displaying single product cart form options 
	 *
	 * @since   1.5.0
	 * @version 1.0.1
	 * last changes in 1.5.5
	 */

	// section product_cart_form
	Kirki::add_section( 'product_cart_form', array(
	    'title'          => esc_html__( 'Add to cart & quantity', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-cart',
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'custom',
	        'settings'    => 'product_quantity_content_separator',
	        'section'     => 'product_cart_form',
	        'default'     => $separators['content'],
	    ) );

		// product_quantity_style
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'product_quantity_style_et-desktop',
			'label'       => $strings['label']['style'],
			'section'     => 'product_cart_form',
			'default'     => 'simple',
			'priority'    => 10,
			'choices'     => array(
				'simple'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/woocommerce/single-product/product-add-to-cart/1.svg',
				'circle' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/woocommerce/single-product/product-add-to-cart/2.svg',
				'square' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/woocommerce/single-product/product-add-to-cart/3.svg',
				'none' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/woocommerce/single-product/product-add-to-cart/4.svg',
			),
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => '.quantity-wrapper',
					'function' => 'toggleClass',
					'class' => 'type-simple',
					'value' => 'simple'
				),
				array(
					'element'  => '.quantity-wrapper',
					'function' => 'toggleClass',
					'class' => 'type-circle',
					'value' => 'circle'
				),
				array(
					'element'  => '.quantity-wrapper',
					'function' => 'toggleClass',
					'class' => 'type-square',
					'value' => 'square'
				),
				array(
					'element'  => '.quantity-wrapper',
					'function' => 'toggleClass',
					'class' => 'type-none',
					'value' => 'none'
				),
				array(
					'element'  => '.quantity-wrapper span.et-icon',
					'function' => 'toggleClass',
					'class' => 'none',
					'value' => 'none'
				),
			),
		) );

		// product_meta_direction 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_cart_form_direction_et-desktop',
			'label'       => $strings['label']['direction'],
			'section'     => 'product_cart_form',
			'default'     => 'row',
			'choices'     => $choices['direction']['type2'],
			'transport' => 'postMessage',
			'output' => array(
				array(
					'element' => '.single-product-builder form.cart',
					'property' => 'flex-direction',
				),
			),
			'js_vars' => array(
				array(
					'element'  => '.single-product-builder form.cart span.hidden',
					'function' => 'toggleClass',
					'class' => 'dir-column',
					'value' => 'column'
				),
				array(
					'element' => '.single-product-builder form.cart',
					'function' => 'css',
					'property' => 'flex-direction',
				),
			),
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'custom',
	        'settings'    => 'product_cart_style_separator',
	        'section'     => 'product_cart_form',
	        'default'     => $separators['style'],
	    ) );

	    // product_add_to_cart_fonts
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'product_add_to_cart_fonts_et-desktop',
			'section'     => 'product_cart_form',
			'default'     => array(
				// 'font-family'    => '',
				// 'variant'        => 'regular',
				// 'font-size'      => '14px',
				// 'line-height'    => '1.5',
				// 'letter-spacing' => '0',
				// 'color'          => '#555',
				'text-transform' => 'none',
				// 'text-align'     => 'left',
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.single-product-builder .single_add_to_cart_button, .single-product-builder .etheme-sticky-cart .etheme_custom_add_to_cart.single_add_to_cart_button',
				),
			),
		) );

		// product_add_to_cart_spacing_et
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_add_to_cart_spacing_et-desktop',
			'label'       => $strings['label']['elements_spacing'],
			'section'     => 'product_cart_form',
			'default'     => 15,
			'choices'     => array(
				'min'  => '0',
				'max'  => '30',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'body',
					'property' => '--single-add-to-cart-button-spacing',
					'units' => 'px'
				)
			)
		) );

		// product_add_to_cart_size
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_add_to_cart_size_et-desktop',
			'label'       => $strings['label']['size_proportion'],
			'section'     => 'product_cart_form',
			'default'     => 1,
			'choices'     => array(
				'min'  => '0',
				'max'  => '5',
				'step' => '.1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'body',
					'property' => '--single-add-to-cart-button-proportion',
				)
			)
		) );

		// product_add_to_cart_min_width
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_add_to_cart_min_width_et-desktop',
			'label'       => esc_html__( 'Min width (px)', 'xstore-core' ),
			'section'     => 'product_cart_form',
			'default'     => 120,
			'choices'     => array(
				'min'  => '90',
				'max'  => '350',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product-builder .single_add_to_cart_button',
					'property' => 'min-width',
					'units' => 'px'
				)
			)
		) );

		// product_add_to_cart_min_height
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_add_to_cart_min_height_et-desktop',
			'label'       => $strings['label']['min_height'],
			'section'     => 'product_cart_form',
			'default'     => 40,
			'choices'     => array(
				'min'  => '30',
				'max'  => '150',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product-builder .single_add_to_cart_button',
					'property' => 'min-height',
					'units' => 'px'
				)
			)
		) );

		// product_add_to_cart_radius
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_add_to_cart_radius_et-desktop',
			'label'       => $strings['label']['border_radius'],
			'section'     => 'product_cart_form',
			'default'     => 0,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product-builder .single_add_to_cart_button, .single-product-builder .single_add_to_cart_button.button, .single-product-builder .etheme-sticky-cart .etheme_custom_add_to_cart.single_add_to_cart_button',
					'property' => 'border-radius',
					'units' => 'px'
				)
			)
		) );

		// product_cart_background_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_cart_background_custom_et-desktop',
			'label'	   => $strings['label']['wcag_bg_color'],
			'description' => $strings['description']['wcag_bg_color'],
			'section'     => 'product_cart_form',
			'default'     => '#222222',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => 'body',
					'property' => '--single-add-to-cart-background-color'
				),
			),
		) );

		// product_cart_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_cart_color_et-desktop',
			'label'       => $strings['label']['wcag_color'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'product_cart_form',
			'default'     => '#ffffff',
			'choices'     => array(
				'setting' => 'product_cart_background_custom_et-desktop',
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
			'output'      => array(
				array(
					'element' => 'body',
					'property' => '--single-add-to-cart-color',
				),
				array(
					'element' => '.single-product-builder .single_add_to_cart_button, .single-product-builder .etheme-sticky-cart .etheme_custom_add_to_cart.single_add_to_cart_button',
					'property' => '--loader-side-color'
				),
			),
		) );

		// product_cart_background_custom_hover
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_cart_background_custom_hover_et-desktop',
			'label'	   => $strings['label']['wcag_bg_color_hover'],
			'description' => $strings['description']['wcag_bg_color'],
			'section'     => 'product_cart_form',
			'default'     => '#555555',
			'choices'     => array(
				'alpha' => true,
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => 'body',
					'property' => '--single-add-to-cart-hover-background-color',
				),
			),
		) );

		// product_cart_color_hover
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_cart_color_hover_et-desktop',
			'label'       => $strings['label']['wcag_color_hover'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'product_cart_form',
			'default'     => '#ffffff',
			'choices'     => array(
				'setting' => 'product_cart_background_custom_hover_et-desktop',
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
			'output'      => array(
				array(
					'element' => 'body',
					'property' => '--single-add-to-cart-hover-color',
				),
				array(
					'element' => '.single-product-builder .single_add_to_cart_button:hover, .single-product-builder .etheme-sticky-cart .etheme_custom_add_to_cart.single_add_to_cart_button:hover',
					'property' => '--loader-side-color'
				),
			),
		) );

		// content separator 
		Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'custom',
	        'settings'    => 'product_form_content_separator',
	        'section'     => 'product_cart_form',
	        'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-feedback"></span> <span style="padding-left: 3px;">' . esc_html__( 'Cart form', 'xstore-core' ) . '</span></div>',
	    ) );

		// product_cart_form_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_cart_form_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'product_cart_form',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '15px',
				'margin-left'         => '0px',
				'border-top-width'    => '0px',
				'border-right-width'  => '0px',
				'border-bottom-width' => '0px',
				'border-left-width'   => '0px',
				'padding-top'         => '0px',
				'padding-right'       => '0px',
				'padding-bottom'      => '0px',
				'padding-left'        => '0px',
			),
			'output' => array(
				array(
					'element' => '.single-product-builder form.cart'
				)
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.single-product-builder form.cart')
		) );

		// product_cart_form_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_cart_form_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'product_cart_form',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product-builder form.cart',
					'property' => 'border-style'
				)
			)
		) );

		// product_cart_form_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_cart_form_border_color_custom_et-desktop',
			'section'     => 'product_cart_form',
			'choices' 	  => array (
				'alpha' => true
			),
			'default' 	  => '#e1e1e1',
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.single-product-builder form.cart',
					'property' => 'border-color',
				),
			),
		) );

		// advanced separator
		Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'custom',
	        'settings'    => 'product_cart_advanced_separator',
	        'section'     => 'product_cart_form',
	        'default'     => $separators['advanced'],
	    ) );

		// sticky_add_to_cart
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sticky_add_to_cart_et-desktop',
			'label'       => esc_html__( 'Sticky add to cart bar', 'xstore-core' ),
			'section'     => 'product_cart_form',
			'default'     => 1,
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => '.etheme-sticky-cart',
					'function' => 'toggleClass',
					'class' => 'dt-hide',
					'value' => false
				),
				array(
					'element'  => '.etheme-sticky-cart',
					'function' => 'toggleClass',
					'class' => 'mob-hide',
					'value' => false
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'sticky_added_to_cart_message',
			'label'       => esc_html__( 'Fixed added to cart message', 'xstore-core' ),
			'section'     => 'product_cart_form',
			'default'     => 1,
			'transport' => 'postMessage',
			'js_vars' => array(
				array(
					'element'  => 'body.single-product',
					'function' => 'toggleClass',
					'class' => 'sticky-message-on',
					'value' => true
				),
				array(
					'element'  => 'body.single-product',
					'function' => 'toggleClass',
					'class' => 'sticky-message-off',
					'value' => false
				),
			),
		) );

		// added_to_cart_action
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'radio-buttonset',
		// 	'settings'    => 'added_to_cart_action_et-desktop',
		// 	'label'       => esc_html__( 'Action after (only for simple products)', 'xstore-core' ),
		// 	'section'     => 'product_cart_form',
		// 	'default'     => 'inherit',
		// 	'choices'     => array(
		// 		'inherit' => esc_html__('Inherit', 'xstore-core'),
		// 		'popup' => esc_html__('Popup', 'xstore-core'),
		// 		'none' => esc_html__('None', 'xstore-core'),
		// 	),
		// ) );
?>