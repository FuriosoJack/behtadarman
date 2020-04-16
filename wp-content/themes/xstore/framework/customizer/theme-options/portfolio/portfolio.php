<?php  
	/**
	 * The template created for displaying blog portfolio options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section blog-portfolio
	Kirki::add_section( 'blog-portfolio', array(
	    'title'          => esc_html__( 'Portfolio', 'xstore' ),
	    'icon' => 'dashicons-images-alt2',
	    'priority' => $priorities['portfolio']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'portfolio_projects',
			'label'       => esc_html__( 'Portfolio projects', 'xstore' ),
			'description' => esc_html__( 'Turn on to enable portfolio projects post type.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_page',
			'label'       => esc_html__( 'Portfolio page', 'xstore' ),
			'description' => esc_html__( 'Choose the portfolio page.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => '',
			'choices' => $pages,
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_filters_type',
			'label'       => esc_html__( 'Portfolio filters show', 'xstore' ),
			'description' => esc_html__( 'Work only at portfolio archive page.', 'xstore'),
			'section'     => 'blog-portfolio',
			'default'     => 'all',
			'choices'     => array(
				'all'    => esc_html__( 'All', 'xstore' ),
                'parent' => esc_html__( 'Only parent', 'xstore' ),
                // 'child'  => esc_html__( 'Only child', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_style',
			'label'       => esc_html__( 'Portfolio grid style', 'xstore' ),
			'description' => esc_html__( 'Control the portfolio projects design on the portfolio page.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 'default',
			'choices'     => array(
				'default' => esc_html__( 'With title', 'xstore' ),
                'classic' => esc_html__( 'On hover', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'portfolio_fullwidth',
			'label'       => esc_html__( 'Full width portfolio', 'xstore' ),
			'description' => esc_html__( 'Turn on to stretch portfolio page.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'port_first_wide',
			'label'       => esc_html__( 'Make first project wide', 'xstore' ),
			'description' => esc_html__( 'Turn on to make the first portfolio project on the portfolio page in double size.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'portfolio_masonry',
			'label'       => esc_html__( 'Masonry', 'xstore' ),
			'description' => esc_html__( 'Turn on placing projects in optimal position based on available vertical space.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 1,
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_columns',
			'label'       => esc_html__( 'Columns', 'xstore' ),
			'description' => esc_html__( 'Choose the number of columns for the portfolio projects.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 3,
			'choices'     => array(
				2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_margin',
			'label'       => esc_html__( 'Portfolio item spacing', 'xstore' ),
			'description' => esc_html__( 'Set the space between portfolio projects on the portfolio page.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 15,
			'choices'     => array(
				1 => '0',
                5 => '5',
                10 => '10',
                15 => '15',
                20 => '20',
                30 => '30',
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'portfolio_count',
			'label'    => esc_html__( 'Items per page', 'xstore' ),
			'description' => esc_html__( 'Set the number of projects to show on the portfolio page before pagination appears. Use -1 to show all items.', 'xstore' ),
			'section'  => 'blog-portfolio',
			'default'  => '',
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'port_single_nav',
			'label'       => esc_html__( 'Show next/previous projects navigation', 'xstore' ),
			'description' => esc_html__( 'Turn on to show next/prev project navigation on the single project page.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 0,
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'portfolio_images_size',
			'label'    => esc_html__( 'Image sizes for portfolio', 'xstore' ),
			'description' => esc_html__( 'Choose the most suitable size for the project images on the portfolio page. Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme. Alternatively enter size in pixels. Example: 200x100 (Width x Height).', 'xstore' ),
			'section'  => 'blog-portfolio',
			'default'  => 'large',
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_order',
			'label'       => esc_html__( 'Portfolio order way', 'xstore' ),
			'description' => esc_html__( 'Choose the method of collation for the portfolio projects on the portfolio page.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 'DESC',
			'choices'     => array(
				'DESC' => 'Descending',
                'ASC' => 'Ascending',
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'portfolio_orderby',
			'label'       => esc_html__( 'Portfolio order by', 'xstore' ),
			'description' => esc_html__( 'Choose the ascending or descending order for the portfolio projects.', 'xstore' ),
			'section'     => 'blog-portfolio',
			'default'     => 'title',
			'choices'     => array(
				'title' => 'Title',
                'date' => 'Date',
                'ID' => 'ID',
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_projects',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

?>