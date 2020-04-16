<?php  
	/**
	 * The template created for displaying general options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section general
	Kirki::add_section( 'general', array(
	    'title'          => esc_html__( 'General / Layout', 'xstore' ),
	    'icon' => 'dashicons-schedule',
	    'priority' => $priorities['general']
		) );
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'main_layout',
			'label'       => esc_html__( 'Site Layout', 'xstore' ),
			'description' => esc_html__( 'Choose the type of layout you want your site to display.', 'xstore' ),
			'section'     => 'general',
			'default'     => 'wide',
			'choices'     => array(
				'wide'     => esc_html__( 'Wide layout', 'xstore' ),
                'boxed'    => esc_html__( 'Boxed', 'xstore' ),
                'framed'   => esc_html__( 'Framed', 'xstore' ),
                'bordered' => esc_html__( 'Bordered', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'site_width',
			'label'       => esc_html__( 'Site width', 'xstore' ),
			'description' => esc_html__( 'Controls the content width. In pixels, default: 1170px.', 'xstore' ),
			'section'     => 'general',
			'default'     => 1170,
			'choices'     => array(
				'min'  => 970,
				'max'  => 3000,
				'step' => 1,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.boxed #header.sticky-on:not([data-type="sticky"]) > [class*=header-wrapper], .boxed #header > [class*=header-wrapper] .sticky-on > div,
					.framed #header.sticky-on:not([data-type="sticky"]) > [class*=header-wrapper], .framed #header > [class*=header-wrapper] .sticky-on > div',
					'property' => 'max-width',
					'value_pattern' => 'calc($px + 30px - ( 2 * var(--sticky-on-space-fix, 0px)) )'
				),
				array(
					'element' => '.container, div.container, .et-container',
                	'media_query' => '@media only screen and (min-width: 1200px)',
                	'property' => 'max-width',
                	'units' => 'px'
				),
				array(
					'element' => '.footer:after',
                	'media_query' => '@media only screen and (min-width: 1200px)',
                	'property' => 'width',
                	'value_pattern' => 'calc($px - 30px)'
				),
				array(
					'element' => '.boxed .template-container, .framed .template-container',
                	'media_query' => '@media only screen and (min-width: 1200px)',
                	'property' => 'width',
                	'value_pattern' => 'calc($px + 30px)'
				),
				array(
					'element' => '.boxed .header-wrapper, .framed .header-wrapper',
                	'media_query' => '@media only screen and (min-width: 1200px)',
                	'property' => 'width',
                	'value_pattern' => 'calc($px + 30px)'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'site_preloader',
			'label'       => esc_html__( 'Site preloader', 'xstore' ),
			'description' => esc_html__( 'Enable nice loading effect while your site or page is in loading mode.', 'xstore' ),
			'section'     => 'general',
			'default'     => 0,
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class'    => 'et-preloader-on',
					'value'    => true,
				),
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class'    => 'et-preloader-off',
					'value'    => false,
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'preloader_img',
			'label'       => esc_html__( 'Site Preloader image', 'xstore' ),
			'description' => esc_html__( 'Upload an interesting png, jpg or gif file to make the waiting time less of a hassle for site visitors.', 'xstore' ),
			'section'     => 'general',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
			'active_callback' => array(
				array(
					'setting'  => 'site_preloader',
					'operator' => '==',
					'value'    => 1,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'image',
			'settings'    => 'preloader_images',
			'label'       => esc_html__( 'Images loader', 'xstore' ),
			'description' => esc_html__( 'Upload an interesting png, jpg or gif file to make the waiting time less of a hassle for site visitors.', 'xstore' ),
			'section'     => 'general',
			'default'     => '',
			'choices'     => array(
				'save_as' => 'array',
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'static_blocks',
			'label'       => esc_html__( 'Static blocks', 'xstore' ),
			'description' => esc_html__( 'Enable this option if you want to use static blocks functionality to create an advanced content of footer, newsletter, mega menu etc.', 'xstore'),
			'section'     => 'general',
			// 'transport'	  => 'auto',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'testimonials_type',
			'label'       => esc_html__( 'Testimonials', 'xstore' ),
			'description' => esc_html__( 'Enable this option if you collect written recommendations from customers, clients and want to display them on your site in different ways.', 'xstore'),
			'section'     => 'general',
			// 'transport'	  => 'auto',
			'default'     => 1,
		) );

		if ( class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes') ) {

			Kirki::add_field( 'et_kirki_options', array(
				'type'        => 'toggle',
				'settings'    => 'et_wpbakery_css_module',
				'label'       => esc_html__( 'WPBakery responsive CSS box-module', 'xstore' ),
				'description' => esc_html__( 'Enable responsive CSS boxes for columns and rows in WPBakery builder.', 'xstore' ),
				'section'     => 'general',
				'default'     => 0,
			) );

		}
?>