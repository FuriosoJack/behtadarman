<?php  
	/**
	 * The template created for displaying general optimization options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section general-optimization
	Kirki::add_section( 'general-optimization', array(
	    'title'          => esc_html__( 'Speed Optimization', 'xstore' ),
	    'icon' => 'dashicons-dashboard',
	    'priority' => $priorities['speed-optimization']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'images_loading_type_et-desktop',
			'label'       => esc_html__( 'Image Loading Type', 'xstore' ),
			'description' => esc_html__( 'It can improve the loading time. Lazy Load - images will be loaded only as they enter the viewport and reduces the number of requests.
LQIP(Low-Quality Image Placeholders) - initially loads a low-quality (smaller version) of the final image to fill in the container until the high-resolution version can load.', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 'lazy',
			'choices'     => array(
				'lazy' => esc_html__( 'Lazy', 'xstore' ),
                'lqip' => esc_html__( 'LQIP', 'xstore' ),
                'default' => esc_html__( 'Default', 'xstore' ),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'et_optimize_js',
			'label'       => esc_html__( 'Old browser support', 'xstore' ),
			'description' => esc_html__( 'Turn on to load additional JS library to support old browsers.', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'et_optimize_css',
			'label'       => esc_html__( 'Optimize frontend CSS', 'xstore' ),
			'description' => esc_html__( 'Turn on to load optimized CSS. Read our documentation to do it in a properly way if you are using child theme installed before 5.0 theme release.', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'global_masonry',
			'label'       => esc_html__( 'Masonry scripts', 'xstore' ),
			'description' => esc_html__( 'Turn on to load masonry scripts to all pages. Enable this option if you plan to use WPBakery Brands list, 8theme Product Looks elements.', 'xstore' ),
			'tooltip' => esc_html__( 'Loads masonry scripts needed to work for masonry elements (115kb of page size)', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'fa_icons',
			'label'       => esc_html__( 'FontAwesome support', 'xstore' ),
			'description' => esc_html__( 'Turn on to load FontAwesom 4.7 icons font and scripts.', 'xstore' ),
			'tooltip' => esc_html__( 'Running FontAwesome scripts and styles needed to work for some elements that use those icons, e.g. menu subitem item icons (41kb of page size)', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'menu_cache',
			'label'       => esc_html__( 'Menu cache', 'xstore' ),
			'description' => esc_html__( 'Enable object cache for menu.', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'static_block_cache',
			'label'       => esc_html__( 'Static Blocks cache', 'xstore' ),
			'description' => esc_html__( 'Enable object cache for Static Blocks.', 'xstore' ),
			'section'     => 'general-optimization',
			'default'     => 1,
		) );

		if ( defined( 'ET_CORE_VERSION' ) ) {
			
			Kirki::add_field( 'et_kirki_options', array(
				'type'        => 'toggle',
				'settings'    => 'cssjs_ver',
				'label'       => esc_html__( 'Remove query strings from theme static resources', 'xstore' ),
				'description' => esc_html__( 'Enable to remove the version query string from static resources to improve the Remove query strings from static resources grade on GT Metrix. Don\'t enable if you use cache plugin where this option is also enabled', 'xstore' ),
				'section'     => 'general-optimization',
				'default'     => 0,
			) );

			Kirki::add_field( 'et_kirki_options', array(
				'type'        => 'toggle',
				'settings'    => 'disable_emoji',
				'label'       => esc_html__( 'Disable emoji', 'xstore' ),
				'description' => esc_html__( 'It generates an additional HTTP request on your WordPress site to load the wp-emoji-release.min.js file. ', 'xstore' ),
				'section'     => 'general-optimization',
				'default'     => 0,
			) );
			
		}

?>