<?php  
	/**
	 * The template created for displaying product compare options
	 *
	 * @since   2.2.4
	 * @version 1.0.0
	 */

	// section product_compare
	Kirki::add_section( 'product_compare', array(
	    'title'          => esc_html__( 'Compare', 'xstore-core' ),
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-update-alt',
		) );

		// content separator
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'custom',
		// 	'settings'    => 'product_compare_content_separator',
		// 	'section'     => 'product_compare',
		// 	'default'     => $separators['content'],
		// ) );

		// product_compare_icon 
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'radio-image',
		// 	'settings'    => 'product_compare_icon_et-desktop',
		// 	'label'       => $strings['label']['icon'],
		// 	'section'     => 'product_compare',
		// 	'default'     => 'type1',
		// 	'choices'     => array(
		// 		'type1'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/compare/Compare-1.svg',
		// 		'type2'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/compare/Compare-2.svg',
		// 		// 'custom'  => ETHEME_CODE_CUSTOMIZER_IMAGES . '/global/icon-custom.svg',
		// 		'none'    => ETHEME_CODE_CUSTOMIZER_IMAGES . '/global/icon-none.svg' 
		// 	),
		// 	'js_vars' => array(
		// 		array(
		// 			'element'  => '.et_product-block .single-compare .et_b-icon',
		// 			'function' => 'toggleClass',
		// 			'class' => 'none',
		// 			'value' => 'none'
		// 		),
		// 	),
			// 'transport' => 'postMessage',
			// 'partial_refresh' => array(
			// 	'product_compare_icon_et-desktop' => array(
			// 		'selector' => '.et_product-block .single-compare .et_b-icon',
			// 		'render_callback' => function() {
			// 			global $et_compare_icons;
			// 			$element_options = array();
		 //        		$element_options['icon_type'] = get_theme_mod('product_compare_icon_et-desktop');

			// 	        if ( !get_theme_mod('bold_icons') ) { 
			// 	            $element_options['compare_icons'] = $et_compare_icons['light'];
			// 	        }
			// 	        else {
			// 	            $element_options['compare_icons'] = $et_compare_icons['bold'];
			// 	        }

		 //                // $element_options['compare_icons']['custom'] = get_theme_mod( 'compare_icon_custom_et-desktop' );

			// 			return $element_options['compare_icons'][$element_options['icon_type']];
			// 		}
			// 	),
			// )
		// ) );

		// product_compare_icon_custom
		// Kirki::add_field( 'et_kirki_options', array (
		// 	'type'     => 'code',
		// 	'settings' => 'product_compare_icon_custom',
		// 	'label'    => $strings['label']['custom_icon_svg'],
		// 	'section'  => 'product_compare',
		// 	'default'  => '',
		// 	'choices'  => array(
		// 		'language' => 'html'
		// 	),
		// 	'active_callback' => array(
		// 		array(
		// 			'setting'  => 'product_compare_icon_et-desktop',
		// 			'operator' => '==',
		// 			'value'    => 'custom',
		// 		),
		// 	),
		// ) );

		// product_compare_label_type
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'radio-buttonset',
		// 	'settings'    => 'product_compare_label_type_et-desktop',
		// 	'label'       => esc_html__( 'Label type', 'xstore-core' ),
		// 	'section'     => 'product_compare',
		// 	'default'     => 'text',
		// 	'choices'     => array(
		// 		'text' => esc_html__('Text', 'xstore-core'),
		// 		'tooltip' => esc_html__('Tooltip', 'xstore-core'),
		// 	),
		// 	'transport' => 'postMessage',
		// 	'js_vars' => array(
		// 		array(
		// 			'element'  => '.et_product-block .single-compare .et_b-icon + span',
		// 			'function' => 'toggleClass',
		// 			'class' => 'mt-mes',
		// 			'value' => 'tooltip'
		// 		),
		// 	),
		// ) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'product_compare_style_separator',
			'section'     => 'product_compare',
			'default'     => $separators['style'],
		) );

		// product_compare_align
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'product_compare_align_et-desktop',
			'label'       => $strings['label']['alignment'],
			'description' => $strings['description']['size_bigger_attention'],
			'section'     => 'product_compare',
			'default'     => 'start',
			'choices'     => $choices['alignment_with_inherit'],
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_product-block .single-compare',
					'property' => 'text-align'
				)
			)
		) );

		// product_compare_proportion
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_compare_proportion_et-desktop',
			'label'       => $strings['label']['size_proportion'],
			'section'     => 'product_compare',
			'default'     => 1.1,
			'choices'     => array(
				'min'  => '0',
				'max'  => '5',
				'step' => '.1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'body',
					'property' => '--single-product-compare-proportion',
				),
			),
		) );

		// product_compare_background
		// Kirki::add_field( 'et_kirki_options', array(
		// 	'type'        => 'select',
		// 	'settings'    => 'product_compare_background_et-desktop',
		// 	'label'       => esc_html__( 'Background', 'xstore-core' ),
		// 	'section'     => 'product_compare',
		// 	'default'     => 'transparent',
		// 	'choices'     => $choices['colors'],
		// 	'transport' => 'auto',
		// 	'output'      => array(
		// 		array(
		// 			'element' => '.et_product-block .tinvwl-shortcode-add-to-cart > a',
		// 			'property' => 'background-color',
		// 			'value_pattern' => 'var(--$-color)'
		// 		),
		// 	),
		// ) );

		// product_compare_background_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_compare_background_custom_et-desktop',
			'label'       => $strings['label']['wcag_bg_color'],
			'description' => $strings['description']['wcag_bg_color'],
			'section'     => 'product_compare',
			'choices' 	  => array (
				'alpha' => true
			),
			'default' => '#ffffff',
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block .single-compare > a',
					'property' => 'background-color',
				),
			),
		) );

		// product_compare_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_compare_color_et-desktop',
			'label'       => $strings['label']['wcag_color'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'product_compare',
			'default'     => '#000000',
			'choices'     => array(
				'setting' => 'product_compare_background_custom_et-desktop',
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
					'element' => '.et_product-block .single-compare > a',
					'property' => 'color'
				)
			),
		) );

		// product_compare_background_hover_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_compare_background_hover_custom_et-desktop',
			'label'       => $strings['label']['wcag_bg_color_hover'],
			'description' => $strings['description']['wcag_bg_color'],
			'section'     => 'product_compare',
			'choices' 	  => array (
				'alpha' => true
			),
			'default' => '#ffffff',
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block .single-compare a:hover',
					'property' => 'background-color',
				),
			),
		) );

		// product_compare_hover_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_compare_hover_color_et-desktop',
			'label'       => $strings['label']['wcag_color_hover'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'product_compare',
			'default'     => '#000000',
			'choices'     => array(
				'setting' => 'product_compare_background_hover_custom_et-desktop',
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
					'element' => '.et_product-block .single-compare a:hover',
					'property' => 'color'
				)
			),
		) );

		// product_compare_border_radius
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'product_compare_border_radius_et-desktop',
			'label'       => $strings['label']['border_radius'],
			'section'     => 'product_compare',
			'default'     => 0,
			'choices'     => array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et_product-block .single-compare > a',
					'property' => 'border-radius',
					'units' => 'px'
				)
			)
		) );

		// product_compare_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'product_compare_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'product_compare',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '0px',
				'margin-bottom'       => '10px',
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
			'output'      => array(
				array(
					'element' => '.et_product-block .single-compare > a'
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_product-block .single-compare > a')
		) );

		// product_compare_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'product_compare_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'product_compare',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block .single-compare > a',
					'property' => 'border-style',
				),
			),
		) );

		// product_compare_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'product_compare_border_color_custom_et-desktop',
			'label'		  => $strings['label']['border_color'],
			'section'     => 'product_compare',
			'default'	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_product-block .single-compare > a',
					'property' => 'border-color',
				),
			),
		) );
?>