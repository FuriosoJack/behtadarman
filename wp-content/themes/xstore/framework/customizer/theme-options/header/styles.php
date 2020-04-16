<?php  
	/**
	 * The template created for displaying header styles options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section header-styles
	Kirki::add_section( 'header-styles', array(
	    'title'          => esc_html__( 'Header styles', 'xstore' ),
	    'panel' => 'header',
	    'icon' => 'dashicons-admin-customizer'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'header_full_width',
			'label'       => esc_html__( 'Header wide', 'xstore' ),
			'description' => esc_html__( 'Stretches the header container to full width.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'header_width',
			'label'       => esc_html__( 'Header max-width', 'xstore' ),
			'description' => esc_html__( 'Limits the width of the header container. In pixels.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => 1600,
			'choices'     => array(
				'min'  => 1170,
				'max'  => 3000,
				'step' => 1,
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_full_width',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.et-header-full-width .main-header .container,
	                .et-header-full-width .navigation-wrapper .container,
	                .et-header-full-width .fixed-header .container',
	                'property' => 'max-width',
	                'units' => 'px'
				),
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'header_padding',
			'label'       => esc_html__( 'Header paddings', 'xstore' ),
			'description' => esc_html__( 'Controls the paddings of the header area.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => $paddings_empty,
			'choices'     => array(
				'labels' => $padding_labels,
			),
			'transport' => 'auto',
			'output'    => array(
			    array(
			      'choice'      => 'padding-top',
			      'element'     => '
				      .header-wrapper.header-advanced header > .container .container-wrapper,
	                .header-wrapper header > .container .container-wrapper, 
	                .header-smart-responsive .header-wrapper header > .container .container-wrapper
	                ',
			      'property'    => 'padding-top',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-bottom',
			      'element'     => '
				      .header-wrapper.header-advanced header > .container .container-wrapper,
	                .header-wrapper header > .container .container-wrapper, 
	                .header-smart-responsive .header-wrapper header > .container .container-wrapper
	                ',
			      'property'    => 'padding-bottom',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-left',
			      'element'     => '
				      .header-wrapper.header-advanced header > .container .container-wrapper,
	                .header-wrapper header > .container .container-wrapper, 
	                .header-smart-responsive .header-wrapper header > .container .container-wrapper
	                ',
			      'property'    => 'padding-left',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-right',
			      'element'     => '
				      .header-wrapper.header-advanced header > .container .container-wrapper,
	                .header-wrapper header > .container .container-wrapper, 
	                .header-smart-responsive .header-wrapper header > .container .container-wrapper
	                ',
			      'property'    => 'padding-right',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),

			    array(
			      'choice'      => 'padding-top',
			      'element'     => '.header-wrapper.header-xstore2 header .container-wrapper, .header-wrapper.header-center2 .container-wrapper',
			      'property'    => 'padding-top',
			      'suffix'		=> '!important',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-bottom',
			      'element'     => '.header-wrapper.header-xstore2 header .container-wrapper, .header-wrapper.header-center2 .container-wrapper',
			      'property'    => 'padding-bottom',
			      'suffix'		=> '!important',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-left',
			      'element'     => '.header-wrapper.header-xstore2 header .container-wrapper, .header-wrapper.header-center2 .container-wrapper',
			      'property'    => 'padding-left',
			      'suffix'		=> '!important',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-right',
			      'element'     => '.header-wrapper.header-xstore2 header .container-wrapper, .header-wrapper.header-center2 .container-wrapper',
			      'property'    => 'padding-right',
			      'suffix'		=> '!important',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			  ),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'header_margin_bottom',
			'label'       => esc_html__( 'Header margin bottom', 'xstore' ),
			'description' => esc_html__( 'Controls the bottom margin of the header to page content when breadcrumbs are disabled. In pixels.', 'xstore'),
			'section'     => 'header-styles',
			'transport' => 'auto',
			'default'     => 30,
			'choices'     => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 5,
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.breadcrumbs-type-disable.et-header-not-overlap:not(.home) .header-wrapper',
					'property' => 'margin-bottom',
					'units' => 'px'
				)
			),
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'header_border_bottom',
			'label'       => esc_html__( 'Header border bottom', 'xstore' ),
			'description' => esc_html__( 'Controls the header border line.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'header_border_color',
			'label'       => esc_html__( 'Header border color', 'xstore' ),
			'description' => esc_html__( 'Controls the header border line color.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => '#e1e1e1',
			'active_callback' => array(
				array(
					'setting'  => 'header_border_bottom',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => '.header-wrapper .et-hr',
					'property' => 'border-color'
				)
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'header_overlap',
			'label'       => esc_html__( 'Header over the content', 'xstore' ),
			'description' => esc_html__( 'Turn it on if you want to have absolute header position and show it over the breadcrumbs and content.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'header_color',
			'label'       => esc_html__( 'Header text color', 'xstore' ),
			'description' => esc_html__( 'Controls the header text/icons color scheme.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => 'dark',
			'choices'     => $text_color_scheme,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'background',
			'settings'    => 'header_bg',
			'label'       => esc_html__( 'Header background', 'xstore' ),
			'description' => esc_html__( 'Controls the header background.', 'xstore' ),
			'section'     => 'header-styles',
			'default'     => array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => '',
				'background-position'   => '',
				'background-size'       => '',
				'background-attachment' => '',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => '.header-bg-block, .header-vertical .container-wrapper, .header-vertical .menu-main-container, .header-vertical .nav-sublist-dropdown, .header-vertical .menu .nav-sublist-dropdown ul > li ul, .header-vertical .nav-sublist-dropdown ul > li .nav-sublist ul',
				),
			),
		) );
		
?>