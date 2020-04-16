<?php  
	/**
	 * The template created for displaying header cart options when woocommerce plugin is not installed 
	 *
	 * @version 1.0.0
	 * @since 1.4.0
	 */

	// section cart_off
	Kirki::add_section( 'cart_off', array(
	    'title'          => esc_html__( 'Cart', 'xstore-core' ),
	    'icon' => 'dashicons-cart',
	     'panel' => 'header-builder',
	) );

	// cart_off_text
	Kirki::add_field( 'et_kirki_options', array (
		'type'     => 'custom',
		'settings' => 'cart_off_text',
		'section'  => 'cart_off',
        'default'     => esc_html__('To use Cart options please install ', 'xstore-core') . '<a href="https://uk.wordpress.org/plugins/woocommerce/" rel="nofollow" target="_blank">' . esc_html__('WooCommerce', 'xstore-core') . '</a>',
	) );
?>