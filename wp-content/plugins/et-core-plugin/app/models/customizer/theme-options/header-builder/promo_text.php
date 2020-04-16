<?php  
	/**
	 * The template created for displaying header promo text options
	 *
	 * @version 1.0.1
	 * @since 1.4.0
	 * last changes in 1.5.4
	 */

	// section promo_text
	Kirki::add_section( 'promo_text', array(
	    'title'          => esc_html__( 'Promo text', 'xstore-core' ),
	    'panel' => 'header-builder',
	    'icon' => 'dashicons-megaphone'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'promo_text_content_separator',
			'section'     => 'promo_text',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// promo_text_package
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'repeater',
			'label'       => esc_html__( 'Sections', 'xstore-core' ),
			'section'     => 'promo_text',
			'row_label' => array(
				'type' => 'field',
				'value' => esc_html__('Section', 'xstore-core' ),
				'field' => 'text',
			),
			'button_label' => esc_html__('Add new item', 'xstore-core' ),
			'settings'     => 'promo_text_package',
			'default'      => array(
				array(
					'text' => esc_html__( 'Take 30% off when you spend $120', 'xstore-core' ),
					'icon'  => 'et_icon-delivery',
					'icon_position'  => 'before',
					'link_title' => esc_html__('Go shop', 'xstore-core'),
					'link' => '#'
				),
				array(
					'text' => esc_html__( 'Free 2-days standard shipping on orders $255+', 'xstore-core' ),
					'icon'  => 'et_icon-coupon',
					'icon_position'  => 'before',
					'link_title' => $strings['label']['custom_link'],
					'link' => '#'
				),
			),
			'fields' => array(
				'text' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Custom text', 'xstore-core' ),
					'description' => esc_html__( 'This will be the label for your link', 'xstore-core' ),
					'default'     => 'Take 30% off when you spend $120 or more with code xstore-core_Space',
				),
				'icon' => array(
					'type'        => 'select',
					'label'       => $strings['label']['icon'],
					'description' => $strings['description']['icons_style'],
					'default'     => 'et_icon-coupon',
					'choices'     =>  $icons['simple'],
				),
				'icon_position' => array(
					'type'        => 'select',
					'label'       => esc_html__( 'Icon position', 'xstore-core' ),
					'default'     => 'before',
					'choices'	  => array(
						'before' => esc_html__('Before', 'xstore-core'),
						'after' => esc_html__('After', 'xstore-core')
					)
				),
				'link_title' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Link text', 'xstore-core' ),
					'description' => esc_html__( 'This will be the label for your link', 'xstore-core' ),
					'default'     => 'Read more',
				),
				'link' => array(
					'type'        => 'link',
					'label'       => esc_html__( 'Link', 'xstore-core' ),
					'default'     => '#'
				),
			)
		) );

		// promo_text_autoplay
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_text_autoplay_et-desktop',
			'label'       => esc_html__( 'Autoplay', 'xstore-core' ),
			'section'     => 'promo_text',
			'default'     => 0,
		) );

		// promo_text_speed 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'promo_text_speed_et-desktop',
			'label'       => esc_html__( 'Items speed (s)', 'xstore-core' ),
			'section'     => 'promo_text',
			'default'     => 3,
			'choices'     => array(
				'min'  => '1',
				'max'  => '5',
				'step' => '1',
			),
		) );

		// promo_text_delay
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'promo_text_delay_et-desktop',
			'label'       => esc_html__( 'Items delay (s)', 'xstore-core' ),
			'section'     => 'promo_text',
			'default'     => 4,
			'choices'     => array(
				'min'  => '1',
				'max'  => '10',
				'step' => '1',
			),
			'active_callback' => array(
				array(
					'setting'  => 'promo_text_autoplay_et-desktop',
					'operator' => '==',
					'value'    => 1,
				),
			),
		) );

		// promo_text_navigation
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_text_navigation_et-desktop',
			'label'       => esc_html__( 'Navigation', 'xstore-core' ),
			'section'     => 'promo_text',
			'default'     => 0,
			'transport'   => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_promo_text_carousel .swiper-custom-left, .et_promo_text_carousel .swiper-custom-right',
					'function' => 'toggleClass',
					'class' => 'dt-hide',
					'value' => false
				),
			),
		) );

		// promo_text_close_button
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_text_close_button_et-desktop',
			'label'       => esc_html__( 'Close button', 'xstore-core' ),
			'section'     => 'promo_text',
			'default'     => 1,
			'transport'   => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => '.et_promo_text_carousel .et-close',
					'function' => 'toggleClass',
					'class' => 'dt-hide',
					'value' => false
				),
			),
		) );

		// promo_text_close_button
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_text_close_button_action_et-desktop',
			'label'       => esc_html__( 'Close forever', 'xstore-core' ),
			'description' => esc_html__('Close till the clearing of the browser cookies', 'xstore-core'),
			'section'     => 'promo_text',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'promo_text_close_button_et-desktop',
					'operator' => '==',
					'value'    => 1,
				),
			),
			// 'transport' => 'postMessage',
			// 'js_vars'     => array(
			// 	array(
			// 		'element'  => '.et_promo_text_carousel .et-close',
			// 		'function' => 'toggleClass',
			// 		'class' => 'close-forever',
			// 		'value' => true
			// 	),
			// ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'promo_text_style_separator',
			'section'     => 'promo_text',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// promo_text_height
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'promo_text_height_et-desktop',
			'label'       => esc_html__( 'Height (px)', 'xstore-core' ),
			'section'     => 'promo_text',
			'default'     => 30,
			'choices'     => array(
				'min'  => '30',
				'max'  => '100',
				'step' => '1',
			),
			'transport' => 'auto',
			'output'	  => array(
				array(
					'element' => '.et_promo_text_carousel',
					'property' => '--promo-text-height',
					'units' => 'px'
				),
			)
		) );

		// promo_text_background_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'promo_text_background_custom_et-desktop',
			'label' 	  => esc_html__('Background color', 'xstore-core'),
			'section'     => 'promo_text',
			'default'	  => '#000000',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_promo_text_carousel',
					'property' => 'background-color'
				),
			),
		) );

		// promo_text_color
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'promo_text_color_et-desktop',
			'label'       => $strings['label']['wcag_color'],
			'description' => $strings['description']['wcag_color'],
			'type'        => 'kirki-wcag-tc',
			'section'     => 'promo_text',
			'default'     => '#ffffff',
			'choices'     => array(
				'setting' => 'promo_text_background_custom_et-desktop',
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
					'element' => '.et_promo_text_carousel',
					'property' => 'color'
				)
			),
		) );

?>