<?php 
	/**
	 * The template created for displaying header overlap options 
	 *
	 * @version 1.0.1
	 * @since 1.4.1
	 * last changes in 1.5.4
	 */

	// section header_overlap
	Kirki::add_section( 'header_overlap', array(
	    'title'          => esc_html__( 'Header overlap', 'xstore-core' ),
	    'description' => esc_html__( 'Choose the header preset that is most suitable for your header design of your site. Please note that re-activation header preset will overwrite previously activated header options/elements. '),
	    'panel'          => 'header-builder',
	    'icon' => 'dashicons-archive'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'header_overlap_content_separator',
			'section'     => 'header_overlap',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// header_overlap
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'header_overlap_et-desktop',
			'label'       => esc_html__( 'Header overlap', 'xstore-core' ),
			'description' => esc_html__( 'Use conditions to make this options work only on specific pages you chose', 'xstore-core'),
			'section'     => 'header_overlap',
			'default'     => '0',
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et_b_dt_header-overlap',
					'value' => true
				),
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et_b_dt_header-not-overlap',
					'value' => false
				),
			),
		) );

		// header_overlap
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'header_overlap_et-mobile',
			'label'       => esc_html__( 'Header overlap', 'xstore-core' ),
			'description' => esc_html__( 'Use conditions to make this options work only on specific pages you chose', 'xstore-core'),
			'section'     => 'header_overlap',
			'default'     => '0',
			'transport' => 'postMessage',
			'js_vars'     => array(
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et_b_mob_header-overlap',
					'value' => true
				),
				array(
					'element'  => 'body',
					'function' => 'toggleClass',
					'class' => 'et_b_mob_header-not-overlap',
					'value' => false
				),
			),
		) );

		// breadcrumb_padding
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'overlap_breadcrumb_padding_et-desktop',
			'label'       => esc_html__( 'Custom Breadcrumbs paddings (overlap only)', 'xstore-core' ),
			'description' => sprintf(esc_html__( 'Controls the paddings for the breadcrumbs area. Leave empty to use default values. You also may set up your breadcrumbs settings in %1s', 'xstore-core' ), '<span class="et_edit" data-section="breadcrumb_padding" style="color: #222;">' . esc_html__( 'Breadcrumbs settings', 'xstore-core' ) . '</span>' ),
			'section'     => 'header_overlap',
			'transport' => 'auto',
			'default'     => array(
				'padding-top'    => '13em',
				'padding-right'  => '',
				'padding-bottom' => '5em',
				'padding-left'   => '',
			),
			'choices'     => array(
				'labels' => $strings['label']['paddings'],
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      'choice'      => 'padding-top',
			      'element'     => '
				      .et_b_dt_header-overlap .page-heading',
			      'property'    => 'padding-top',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-bottom',
			      'element'     => '
				      .et_b_dt_header-overlap .page-heading',
			      'property'    => 'padding-bottom',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-left',
			      'element'     => '
				      .et_b_dt_header-overlap .page-heading',
			      'property'    => 'padding-left',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			    array(
			      'choice'      => 'padding-right',
					'element'     => '
				      .et_b_dt_header-overlap .page-heading',
			      'property'    => 'padding-right',
			      'media_query' => '@media only screen and (min-width: 993px)',
			    ),
			),
		) );

		// breadcrumb_padding
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'dimensions',
			'settings'    => 'overlap_breadcrumb_padding_et-mobile',
			'label'       => esc_html__( 'Custom Breadcrumbs paddings (overlap only)', 'xstore-core' ),
			'description' => sprintf(esc_html__( 'Controls the paddings for the breadcrumbs area. Leave empty to use default values. You also may set up your breadcrumbs settings in %1s', 'xstore-core' ), '<span class="et_edit" data-section="breadcrumb_padding" style="color: #222;">' . esc_html__( 'Breadcrumbs settings', 'xstore-core' ) . '</span>' ),
			'section'     => 'header_overlap',
			'transport' => 'auto',
			'default'     => array(
				'padding-top'    => '11em',
				'padding-right'  => '',
				'padding-bottom' => '1.2em',
				'padding-left'   => '',
			),
			'choices'     => array(
				'labels' => $strings['label']['paddings'],
			),
			'transport' => 'auto',
			'output'      => array(
				array(
			      'choice'      => 'padding-top',
			      'element'     => '
				      .et_b_mob_header-overlap .page-heading',
			      'property'    => 'padding-top',
			      'media_query' => '@media only screen and (max-width: 992px)',
			    ),
			    array(
			      'choice'      => 'padding-bottom',
			      'element'     => '
				      .et_b_mob_header-overlap .page-heading',
			      'property'    => 'padding-bottom',
			      'media_query' => '@media only screen and (max-width: 992px)',
			    ),
			    array(
			      'choice'      => 'padding-left',
			      'element'     => '
				      .et_b_mob_header-overlap .page-heading',
			      'property'    => 'padding-left',
			      'media_query' => '@media only screen and (max-width: 992px)',
			    ),
			    array(
			      'choice'      => 'padding-right',
					'element'     => '
				      .et_b_mob_header-overlap .page-heading',
			      'property'    => 'padding-right',
			      'media_query' => '@media only screen and (max-width: 992px)',
			    ),
			),
		) );