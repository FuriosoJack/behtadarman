<?php  
	/**
	 * The template created for displaying shop promo popup options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section shop-promo-popup
	Kirki::add_section( 'shop-promo-popup', array(
	    'title'          => esc_html__( 'Promo Popup', 'xstore' ),
	    'icon' => 'dashicons-external',
	    'priority' => $priorities['promo-popup']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_popup',
			'label'       => esc_html__( 'Enable promo popup', 'xstore' ),
			'description' => esc_html__( 'Turn on to enable promo popup.', 'xstore' ),
			'section'     => 'shop-promo-popup',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_auto_open',
			'label'       => esc_html__( 'Open popup on enter', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the promo popup when visitor just opened the site.', 'xstore' ),
			'section'     => 'shop-promo-popup',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_open_scroll',
			'label'       => esc_html__( 'Open when scrolled to the bottom of the page', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the promo popup only when visitor scrolled to the bottom of the page.', 'xstore' ),
			'section'     => 'shop-promo-popup',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'pp_delay',
			'label'    => esc_html__( 'Popup delay', 'xstore' ),
			'description' => esc_html__( 'Controls the delay before popup appears. In ms. For example, 1000.', 'xstore' ),
			'section'  => 'shop-promo-popup',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'promo_auto_open',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'promo_link',
			'label'       => esc_html__( 'Show link in the top bar', 'xstore' ),
			'description' => esc_html__( 'Turn on to show the link to open promo popup at the top bar.', 'xstore' ),
			'section'     => 'shop-promo-popup',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'editor',
			'settings' => 'promo-link-text',
			'label'    => esc_html__( 'Promo link text', 'xstore' ),
			'description' => esc_html__( 'The text will be displayed if promo popup link in the top bar is enabled.', 'xstore' ),
			'section'  => 'shop-promo-popup',
			'default'  => '<i class="et-icon et-message"></i> ' . esc_html__( 'Newsletter', 'xstore' ),
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'pp_content',
			'label'       => esc_html__( 'Popup content', 'xstore' ),
			'description' => esc_html__( 'Add the content to be shown in the promo popup. You can use HTML or static block shortcode here. Do not include JS, PHP code.', 'xstore' ),
			'section'     => 'shop-promo-popup',
			'default'     => '<p style="font-size: 1.14rem; color: #fff;">You can add any HTML here (admin -&gt; Theme Options -&gt; E-Commerce -&gt; Promo Popup).<br /> We suggest you create a static block and put it here using shortcode</p>',
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'pp_width',
			'label'    => esc_html__( 'Popup width', 'xstore' ),
			'description' => esc_html__( 'Controls the width of the popup. In pixels.', 'xstore' ),
			'section'  => 'shop-promo-popup',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'pp_height',
			'label'    => esc_html__( 'Popup height', 'xstore' ),
			'description' => esc_html__( 'Controls the height of the popup. If popup content is higher than this height then you will get the vertical scroll for the popup content. In pixels.', 'xstore' ),
			'section'  => 'shop-promo-popup',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'pp_spacing',
			'label'       => esc_html__( 'Popup paddings', 'xstore' ),
			'description' => esc_html__( 'Controls paddings of the popup content.', 'xstore' ),
			'section'  => 'shop-promo-popup',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			),
			'output'    => array(
			    array(
			      'choice'      => 'padding-top',
			      'element'     => '#etheme-popup',
			      'property'    => 'padding-top',
			    ),
			    array(
			      'choice'      => 'padding-right',
			      'element'     => '#etheme-popup',
			      'property'    => 'padding-right',
			    ),
			    array(
			      'choice'      => 'padding-bottom',
			      'element'     => '#etheme-popup',
			      'property'    => 'padding-bottom',
			    ),
			    array(
			      'choice'      => 'padding-left',
			      'element'     => '#etheme-popup',
			      'property'    => 'padding-left',
			    ),
		  	),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'pp_bg',
			'label'       => esc_html__( 'Popup background', 'xstore' ),
			'description' => esc_html__( 'Choose the promo popup background.', 'xstore' ),
			'section'     => 'shop-promo-popup',
			'default'     => array(
				'background-color'      => '',
				'background-image'      => '',
				'background-repeat'     => '',
				'background-position'   => '',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'active_callback' => array(
				array(
					'setting'  => 'promo_popup',
					'operator' => '==',
					'value'    => true,
				),
			),
		) );

?>