<?php  
	/**
	 * The template created for displaying single product page panel
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// panel single-product-page
	Kirki::add_panel( 'single-product-page', array(
	    'title'       => esc_html__( 'Single Product Page', 'xstore' ),
	    'icon'		  => 'dashicons-align-left',
	    'panel' => 'woocommerce'
		) );
?>