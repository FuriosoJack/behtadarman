<?php  
	/**
	 * The template created for displaying single product panel
	 *
	 * @version 1.0.0
	 * @since 0.0.1
	 */

	$checked = get_option( 'etheme_single_product_builder', false );

	$checked = ( $checked ) ? 'checked' : '';

	// panel single_product
	Kirki::add_panel( 'single_product_builder', array(
	    'title'          => esc_html__( 'Single product builder', 'xstore-core' ),
	    'panel'          => 'woocommerce',
	    'description' => '<span class="customize-control-kirki-toggle"> <label for="etheme-disable-default-single-product"> <span class="customize-control-title">' . esc_html__( 'Disable single product builder', 'xstore-core' ) . '</span> <input class="screen-reader-text" id="etheme-disable-default-single-product" name="etheme-disable-default-single-product" type="checkbox" ' . $checked . '><span class="switch"></span></label></span>',
	    'icon' => 'dashicons-align-left',
		) );
?>