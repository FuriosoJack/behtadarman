<?php  
	/**
	 * The template created for displaying single product variation gallery options 
	 *
	 * @version 0.0.1
	 * @since 6.2.12
	 */
	
	// section variations-gallery
	Kirki::add_section( 'variations-gallery', array(
	    'title'          => esc_html__( 'Variation gallery', 'xstore' ),
	    'panel' => 'single-product-page',
	    'icon' => 'dashicons-images-alt'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'enable_variation_gallery',
			'label'       => esc_html__( 'Variation gallery', 'xstore' ),
			'description' => esc_html__( 'Turn on to use separate gallery for product variations.', 'xstore'),
			'section'     => 'variations-gallery',
			'default'     => 0,
		) );

?>