<?php  
	/**
	 * The template created for displaying empty cart options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section empty-cart
	Kirki::add_section( 'empty-cart', array(
	    'title'          => esc_html__( 'Empty cart content', 'xstore' ),
	    'panel' => 'shop',
	    'icon' => 'dashicons-cart'
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'editor',
			'settings'    => 'empty_cart_content',
			'label'       => esc_html__( 'Text for empty cart', 'xstore' ),
			'description' => esc_html__( 'Add the content you need to display on the empty part page instead of the default content.', 'xstore' ),
			'section'     => 'empty-cart',
			'default'  => '<h1 style="text-align: center;">YOUR SHOPPING CART IS EMPTY</h1><p style="text-align: center;">We invite you to get acquainted with an assortment of our shop.Surely you can find something for yourself!</p> ',
		) );

		
?>