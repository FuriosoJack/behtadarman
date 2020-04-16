<?php 
	// panel woocommerce
	Kirki::add_panel( 'woocommerce', array(
	    'title'       => esc_html__( 'WooCommerce (Shop)', 'xstore' ),
	    'icon'		  => 'dashicons-cart',
	    'priority' => $priorities['woocommerce']
	) );
?>