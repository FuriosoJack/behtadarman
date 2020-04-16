<?php  
	/**
	 * The template created for displaying typography content options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section typography-content
	Kirki::add_section( 'typography-content', array(
	    'title'          => esc_html__( 'Content', 'xstore' ),
	    'panel' => 'typography',
	    'icon' => 'dashicons-media-document'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'sfont',
			'label'       => esc_html__( 'Body Font', 'xstore' ),
			'description' => esc_html__( 'Controls the font of the body.', 'xstore' ),
			'section'     => 'typography-content',
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'color'          => '#555',
				'text-transform' => '',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => 'body, .quantity input[type="number"], .page-wrapper',
				),
			),
		) );

		// paragraph_font_size 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'paragraph_font_size',
			'label'       => esc_html__( 'Paragraph font-size (px)', 'xstore' ),
			'section'     => 'typography-content',
			'default'     => 16,
			'choices'     => array(
				'min'  => '10',
				'max'  => '24',
				'step' => '1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'p, .content-article, blockquote p, .testimonials-slider .swiper-container:not(.with-grid) blockquote',
					'property' => 'font-size',
					'units' => 'px'
				),
			)
		) );

		// paragraph_line_height 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'slider',
			'settings'    => 'paragraph_line_height',
			'label'       => esc_html__( 'Paragraph line-height (proportion)', 'xstore' ),
			'section'     => 'typography-content',
			'default'     => 1.6,
			'choices'     => array(
				'min'  => '1',
				'max'  => '2',
				'step' => '.1',
			),
			'transport' => 'auto',
			'output' => array(
				array(
					'element' => 'p, .content-article, blockquote p, .testimonials-slider .swiper-container:not(.with-grid) blockquote',
					'property' => 'line-height',
				),
			)
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'typography',
			'settings'    => 'headings',
			'label'       => esc_html__( 'Headings', 'xstore' ),
			'description' => esc_html__( 'Controls the font of the headings.', 'xstore' ),
			'section'     => 'typography-content',
			'default'     => array(
				'font-family'    => 'Lato',
				'variant'        => 'regular',
				// 'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'color'          => '',
				'text-transform' => '',
			),
			'transport'   => 'auto',
			'output'      => array(
				array(
					'element' => 
					   '.title h3,
                        blockquote,
                        .share-post .share-title,
                        .sidebar-widget .tabs .tab-title,
                        .widget-title,
                        .related-posts .title span,
                        .content-product .product-title a,
                        .results-ajax-list .ajax-item-title,
                        table.cart .product-details .product-title,
                        .product_list_widget li .product-title a,
                        .woocommerce table.wishlist_table .product-name a,
                        .comment-reply-title,
                        .et-tabs .vc_tta-title-text,
                        .single-product-right .product-information-inner .product_title,
                        .single-product-right .product-information-inner h1.title,
                        .post-heading h2 a,
                        .sidebar .recent-posts-widget .post-widget-item h4 a,
                        .et-tabs-wrapper .tabs .accordion-title span',
				),
				array(
					'choice' => 'font-family',
					'element' => 'h1, h2, h3, h4, h5, h6, .products-title',
				),
				array(
					'choice' => 'variant',
					'element' => 'h1, h2, h3, h4, h5, h6, .products-title',
				),
				array(
					'choice' => 'letter-spacing',
					'element' => 'h1, h2, h3, h4, h5, h6, .products-title',
				),
				array(
					'choice' => 'color',
					'element' => 'h1, h2, h3, h4, h5, h6, .products-title',
				),
				array(
					'choice' => 'text-transform',
					'element' => 'h1, h2, h3, h4, h5, h6, .products-title',
				)
			),
		) );

?>