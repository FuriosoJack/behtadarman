<?php
	/**
	 * The template for displaying header cart
	 *
	 * @since   1.4.0
	 * @version 1.0.6
	 * last changes in 2.2.4
	 */
 ?>

<?php

	global $et_cart_icons, $et_builder_globals;

	$element_options = array();
	$element_options['is_woocommerce_et-desktop'] = ( class_exists('WooCommerce') ) ? true : false;
	$element_options['cart_style'] = Kirki::get_option( 'cart_style_et-desktop' );
	$element_options['cart_style'] = apply_filters('cart_style', $element_options['cart_style']);
	$element_options['icon_type_et-desktop'] = Kirki::get_option( 'cart_icon_et-desktop' );

	$element_options['cart_icon'] = false;

	if ( !Kirki::get_option('bold_icons') ) { 
		$element_options['cart_icons_et-desktop'] = $et_cart_icons['light'];
	}
	else {
		$element_options['cart_icons_et-desktop'] = $et_cart_icons['bold'];
	}

	$element_options['cart_icons_et-desktop']['custom'] = Kirki::get_option( 'cart_icon_custom_et-desktop' );

	if ( $element_options['is_woocommerce_et-desktop'] ) $element_options['cart_icon'] = $element_options['cart_icons_et-desktop'][$element_options['icon_type_et-desktop']];

	$element_options['cart_quantity_et-desktop'] = Kirki::get_option( 'cart_quantity_et-desktop' );
	$element_options['cart_quantity_position_et-desktop'] = ( $element_options['cart_quantity_et-desktop'] ) ? ' et-quantity-' . Kirki::get_option( 'cart_quantity_position_et-desktop' ) : '';

	$element_options['cart_content_type_et-desktop'] = Kirki::get_option( 'cart_content_type_et-desktop' );
	$element_options['cart_content_position_et-desktop'] = Kirki::get_option( 'cart_content_position_et-desktop' );
	$element_options['cart_dropdown_position_et-desktop'] = Kirki::get_option( 'cart_dropdown_position_et-desktop' );

	$element_options['not_cart_checkout'] = ( $element_options['is_woocommerce_et-desktop'] && !(is_cart() || is_checkout()) ) ? true : false;

	if ( $et_builder_globals['in_mobile_menu'] ) {
        $element_options['cart_style'] = 'type1';
        $element_options['cart_quantity_et-desktop'] = false;
        $element_options['cart_quantity_position_et-desktop'] = '';
        $element_options['cart_content_alignment'] = ' justify-content-inherit';
	 	$element_options['cart_content_type_et-desktop'] = 'none';
    }

	$element_options['etheme_mini_cart_content_type'] = apply_filters('etheme_mini_cart_content_type', $element_options['cart_content_type_et-desktop']);

	$element_options['etheme_mini_cart_content_position'] = apply_filters('etheme_mini_cart_content_position', $element_options['cart_content_position_et-desktop']);

	$element_options['etheme_mini_cart_content'] = ( $element_options['etheme_mini_cart_content_type'] != 'none' ) ? true : false;
	$element_options['etheme_mini_cart_content'] = apply_filters('etheme_mini_cart_content', $element_options['etheme_mini_cart_content']);

	$element_options['cart_off_canvas'] = ( $element_options['etheme_mini_cart_content_type'] == 'off_canvas' ) ? true : false;
	$element_options['cart_off_canvas'] = apply_filters('cart_off_canvas', $element_options['cart_off_canvas']);

	// header cart classes 
	$element_options['wrapper_class'] = ' flex align-items-center';
	if ( $et_builder_globals['in_mobile_menu'] ) $element_options['wrapper_class'] .= ' justify-content-inherit';
	$element_options['wrapper_class'] .= ' cart-' . $element_options['cart_style'];
	$element_options['wrapper_class'] .= ' ' . $element_options['cart_quantity_position_et-desktop'];
	$element_options['wrapper_class'] .= ( $element_options['cart_off_canvas'] ) ? ' et-content-' . $element_options['etheme_mini_cart_content_position'] : '';
	$element_options['wrapper_class'] .= ( !$element_options['cart_off_canvas'] && $element_options['cart_dropdown_position_et-desktop'] != 'custom' ) ? ' et-content-' . $element_options['cart_dropdown_position_et-desktop'] : '';
	$element_options['wrapper_class'] .= ( $element_options['cart_off_canvas'] && $element_options['etheme_mini_cart_content'] && $element_options['not_cart_checkout']) ? ' et-off-canvas et-off-canvas-wide et-content_toggle' : ' et-content-dropdown et-content-toTop';
	$element_options['wrapper_class'] .= ( $element_options['cart_quantity_et-desktop'] && $element_options['cart_icon'] == '' ) ? ' static-quantity' : '';
	$element_options['wrapper_class'] .= ( $et_builder_globals['in_mobile_menu'] ? '' : ' et_element-top-level' );

	$element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
	$element_options['attributes'] = array();
	if ( $element_options['is_customize_preview'] ) 
		$element_options['attributes'] = array(
			'data-title="' . esc_html__( 'Cart', 'xstore-core' ) . '"',
			'data-element="cart"'
		); 

?>	

<div class="et_element et_b_header-cart <?php echo ( $element_options['is_woocommerce_et-desktop'] ) ? $element_options['wrapper_class'] : ''; ?>" <?php echo implode( ' ', $element_options['attributes'] ); ?>>
	<?php echo header_cart_callback(); ?>
</div>

<?php unset($element_options);