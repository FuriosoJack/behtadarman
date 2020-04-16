<?php  
	/**
	 * The template created for displaying single product custom html options 
	 *
	 * @version 1.0.0
	 * @since 0.0.1
	 */

	// section single_product_html_blocks
	Kirki::add_section( 'single_product_html_blocks', array(
	    'title'          => esc_html__( 'Custom HTML', 'xstore-core' ),
	    'description' => esc_html__('Most used classes for elements').'<br/><code>
		    .justify-content-start, 
			.justify-content-end, 
			.justify-content-center, 
			.text-lowercase, 
			.text-capitalize, 
			.text-uppercase, 
			.text-underline, 
			.flex, 
			.flex-inline, 
			.block, 
			.inline-block, 
			.none, 
			.list-style-none, 
			.full-width
	    </code>',
	    'panel'          => 'single_product_builder',
	    'icon' => 'dashicons-editor-code',
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'single_product_html_block1_content_separator',
			'section'     => 'single_product_html_blocks',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-admin-settings"></span> <span style="padding-left: 3px;">' . esc_html__( 'Html block 1', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// html_block1
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'single_product_html_block1',
			'label'       => esc_html__( 'Html block 1', 'xstore-core' ),
			'description' => $strings['label']['editor_control'],
			'section'     => 'single_product_html_blocks',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'single_product_html_block1_sections',
					'operator' => '!=',
					'value'    => '1',
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block1' => array(
					'selector'  => '.single_product-html_block1',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'html_backup' => 'single_product_html_block1',
					    ));
					},
				),
			),
		) );

		// html_block1_sections
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'single_product_html_block1_sections',
			'label'       => $strings['label']['use_static_block'],
			'section'     => 'single_product_html_blocks',
			'default'     => 0,
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block1_sections' => array(
					'selector'  => '.single_product-html_block1',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'section' => 'single_product_html_block1_section',
					    	'sections' => 'single_product_html_block1_sections',
					    	'html_backup' => 'single_product_html_block1',
					    	'section_content' => true
					    ));
					},
				),
			),
		) );

		// html_block1_section
		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'select',
			'settings' => 'single_product_html_block1_section',
			'label'    => sprintf(esc_html__( 'Choose %1s for Html Block 1', 'xstore-core' ), '<a href="https://xstore.helpscoutdocs.com/article/47-static-blocks" target="_blank" style="color: #555">'.esc_html__('static block', 'xstore-core').'</a>'),
			'section'  => 'single_product_html_blocks',
			'default'  => '',
			'priority' => 10,
			'choices'  => $post_types['sections'],
			'active_callback' => array(
				array(
					'setting'  => 'single_product_html_block1_sections',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block1_section' => array(
					'selector'  => '.single_product-html_block1',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'section' => 'single_product_html_block1_section',
					    	'sections' => 'single_product_html_block1_sections',
					    	'html_backup' => 'single_product_html_block1',
					    	'section_content' => true
					    ));
					},
				),
			),
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'single_product_html_block2_content_separator',
			'section'     => 'single_product_html_blocks',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-admin-settings"></span> <span style="padding-left: 3px;">' . esc_html__( 'Html block 2', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// html_block2
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'single_product_html_block2',
			'label'       => esc_html__( 'Html block 2', 'xstore-core' ),
			'description' => $strings['label']['editor_control'],
			'section'     => 'single_product_html_blocks',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'single_product_html_block2_sections',
					'operator' => '!=',
					'value'    => '1',
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block2' => array(
					'selector'  => '.single_product-html_block2',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'html_backup' => 'single_product_html_block2',
					    ));
					},
				),
			),
		) );

		// html_block2_sections
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'single_product_html_block2_sections',
			'label'       => $strings['label']['use_static_block'],
			'section'     => 'single_product_html_blocks',
			'default'     => 0,
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block2_sections' => array(
					'selector'  => '.single_product-html_block1',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'section' => 'single_product_html_block2_section',
					    	'sections' => 'single_product_html_block2_sections',
					    	'html_backup' => 'single_product_html_block2',
					    	'section_content' => true
					    ));
					},
				),
			),
		) );

		// html_block2_section
		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'select',
			'settings' => 'single_product_html_block2_section',
			'label'    => sprintf(esc_html__( 'Choose %1s for Html Block 2', 'xstore-core' ), '<a href="https://xstore.helpscoutdocs.com/article/47-static-blocks" target="_blank" style="color: #555">'.esc_html__('static block', 'xstore-core').'</a>'),
			'section'  => 'single_product_html_blocks',
			'default'  => '',
			'priority' => 10,
			'choices'  => $post_types['sections'],
			'active_callback' => array(
				array(
					'setting'  => 'single_product_html_block2_sections',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block2_section' => array(
					'selector'  => '.single_product-html_block2',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'section' => 'single_product_html_block2_section',
					    	'sections' => 'single_product_html_block2_sections',
					    	'html_backup' => 'single_product_html_block2',
					    	'section_content' => true
					    ));
					},
				),
			),
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'single_product_html_block3_content_separator',
			'section'     => 'single_product_html_blocks',
			'default'     => '<div style="'.$sep_style.'"><span class="dashicons dashicons-admin-settings"></span> <span style="padding-left: 3px;">' . esc_html__( 'Html block 3', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// html_block3
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'single_product_html_block3',
			'label'       => esc_html__( 'Html block 3', 'xstore-core' ),
			'description' => $strings['label']['editor_control'],
			'section'     => 'single_product_html_blocks',
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'single_product_html_block3_sections',
					'operator' => '!=',
					'value'    => '1',
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block3' => array(
					'selector'  => '.single_product-html_block3',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'html_backup' => 'single_product_html_block3',
					    ));
					},
				),
			),
		) );

		// html_block3_sections
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'single_product_html_block3_sections',
			'label'       => $strings['label']['use_static_block'],
			'section'     => 'single_product_html_blocks',
			'default'     => 0,
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block3_sections' => array(
					'selector'  => '.single_product-html_block3',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'section' => 'single_product_html_block3_section',
					    	'sections' => 'single_product_html_block3_sections',
					    	'html_backup' => 'single_product_html_block3',
					    	'section_content' => true
					    ));
					},
				),
			),
		) );

		// html_block3_section
		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'select',
			'settings' => 'single_product_html_block3_section',
			'label'    => sprintf(esc_html__( 'Choose %1s for Html Block 3', 'xstore-core' ), '<a href="https://xstore.helpscoutdocs.com/article/47-static-blocks" target="_blank" style="color: #555">'.esc_html__('static block', 'xstore-core').'</a>'),
			'section'  => 'single_product_html_blocks',
			'default'  => '',
			'priority' => 10,
			'choices'  => $post_types['sections'],
			'active_callback' => array(
				array(
					'setting'  => 'single_product_html_block3_sections',
					'operator' => '==',
					'value'    => 1,
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'single_product_html_block3_section' => array(
					'selector'  => '.single_product-html_block3',
					'render_callback' => function() {
					    return html_blocks_callback(array(
					    	'section' => 'single_product_html_block3_section',
					    	'sections' => 'single_product_html_block3_sections',
					    	'html_backup' => 'single_product_html_block3',
					    	'section_content' => true
					    ));
					},
				),
			),
		) );
?>