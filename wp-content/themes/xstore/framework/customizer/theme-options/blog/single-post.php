<?php  
	/**
	 * The template created for displaying blog page options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section blog-blog_page
	Kirki::add_section( 'blog-single-post', array(
	    'title'          => esc_html__( 'Single post', 'xstore' ),
	    'panel' => 'blog',
	    'icon' => 'dashicons-format-aside'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'post_template',
			'label'       => esc_html__( 'Post template', 'xstore' ),
			'description' => esc_html__( 'Choose layout of the post template. Header displays over the post featured image for the "Large", "Full width", "Full width centred" layouts.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 'default',
			'choices'     => $post_template,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'post_sidebar',
			'label'       => esc_html__( 'Sidebar position', 'xstore' ),
			'description' => esc_html__( 'Choose layout of the post template. Header displays over the post featured image for the "Large", "Full width", "Full width centred" layouts.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 'right',
			'choices'     => $sidebars,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'blog_featured_image',
			'label'       => esc_html__( 'Display featured image on single post', 'xstore' ),
			'description' => esc_html__( 'Turn on to display featured image at the single post page.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'single_post_title',
			'label'       => esc_html__( 'Display Title/Meta on single post', 'xstore' ),
			'description' => esc_html__( 'Turn on to show post title and post meta on the single post page. You can use post meta shortcode [etheme_post_meta time="true" time_details="true" author="true" comments="true" count="true" class="" ] in post content as an alternative of this option.', 'xstore'),
			'section'     => 'blog-single-post',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'post_share',
			'label'       => esc_html__( 'Show share buttons', 'xstore' ),
			'description' => esc_html__( 'Turn on to display share buttons on the post page.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'about_author',
			'label'       => esc_html__( 'Show about author block', 'xstore' ),
			'description' => esc_html__( 'Turn on to display the name of the writer on the post page.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 0,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'posts_links',
			'label'       => esc_html__( 'Posts previous/next buttons', 'xstore' ),
			'description' => esc_html__( 'Turn on to show navigation to previous and next posts.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'post_related',
			'label'       => esc_html__( 'Show Related posts', 'xstore' ),
			'description' => esc_html__( 'Turn on to display related posts on the single post.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 1,
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'related_query',
			'label'       => esc_html__( 'Related query type', 'xstore' ),
			'description' => esc_html__( 'Choose the type of the related post query.', 'xstore' ),
			'section'     => 'blog-single-post',
			'default'     => 'categories',
			'choices'     => array(
				'categories' => esc_html__( 'Categories', 'xstore' ),
                'tags' => esc_html__( 'Tags', 'xstore' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'post_related',
					'operator' => '==',
					'value'    => true,
				),
			)
		) );

		
?>