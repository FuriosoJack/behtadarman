<?php  
	/**
	 * The template created for displaying shop panel
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// panel shop
	Kirki::add_panel( 'shop', array(
	    'title'       => esc_html__( 'Shop', 'xstore' ),
	    'icon'		  => 'dashicons-store',
	    'panel' => 'woocommerce'
		) );
?>