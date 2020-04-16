<?php  
	/**
	 * The template created for displaying catalog mode options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section catalog-mode
	Kirki::add_section( 'catalog-mode', array(
	    'title'          => esc_html__( 'Catalog Mode', 'xstore' ),
	    'panel' => 'shop',
	    'icon' => 'dashicons-hidden' // dashicons-tickets-alt
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'just_catalog',
			'label'       => esc_html__( 'Just Catalog', 'xstore' ),
			'description' => esc_html__( 'Turn on to disable ability to buy products via removing "Add to Cart" buttons.', 'xstore'),
			'section'     => 'catalog-mode',
			'default'     => 0,
		) );
		
?>