<?php  
	/**
	 * The template created for displaying woocommerce section when WooCommerce plugin is inactive
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section woocommerce_off
	Kirki::add_section( 'woocommerce_off', array(
	    'title'          => esc_html__( 'WooCommerce (Shop)', 'xstore' ),
	    'icon' => 'dashicons-cart',
	    'priority' => $priorities['woocommerce']
		) );

		Kirki::add_field( 'theme_config_id', array (
			'type'     => 'custom',
			'settings' => 'woocommerce_off_text',
			'section'  => 'woocommerce_off',
	        'default'     => esc_html__('To use WooCommerce options please install ', 'xstore') . '<a href="https://uk.wordpress.org/plugins/woocommerce/" rel="nofollow" target="_blank">' . esc_html__('WooCommerce', 'xstore') . '</a>',
		) );
		
?>