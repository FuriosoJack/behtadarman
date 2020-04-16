<?php
    /**
     * The template for displaying header wishlist block
     *
     * @since   1.4.0
     * @version 1.0.4
     * last changes in 2.2.4
     */
 ?>

<?php 

    global $et_wishlist_icons, $et_builder_globals;

    $element_options = array();
    $element_options['is_YITH_WCWL'] = ( class_exists('YITH_WCWL') ) ? true : false;

    $html = '';

    if ( !$element_options['is_YITH_WCWL'] ) : ?>
        <div class="et_element et_b_header-wishlist" data-title="<?php esc_html_e( 'Wishlist', 'xstore-core' ); ?>">
            <span class="flex flex-wrap full-width align-items-center currentColor">
                <span class="flex-inline justify-content-center align-items-center flex-nowrap">
                    <?php esc_html_e( 'Wishlist ', 'xstore-core' ); ?> 
                    <span class="mtips" style="text-transform: none;">
                        <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
                        <span class="mt-mes"><?php esc_html_e('Please, install WooCommerce Wishlist plugin', 'xstore-core'); ?></span>
                    </span>
                </span>
            </span>
        </div>
    <?php return; 
    endif;

    $element_options['wishlist_style'] = Kirki::get_option( 'wishlist_style_et-desktop' );
    $element_options['wishlist_style'] = apply_filters('wishlist_style', $element_options['wishlist_style']);

    $element_options['icon_type'] = Kirki::get_option( 'wishlist_icon_et-desktop' );

    if ( !Kirki::get_option('bold_icons') ) { 
        $element_options['wishlist_icons'] = $et_wishlist_icons['light'];
    }
    else {
        $element_options['wishlist_icons'] = $et_wishlist_icons['bold'];
    }

    $element_options['wishlist_icons']['custom'] = Kirki::get_option( 'wishlist_icon_custom_et-desktop' );

    $element_options['wishlist_icon'] = $element_options['wishlist_icons'][$element_options['icon_type']];

    $element_options['wishlist_quantity_et-desktop'] = Kirki::get_option( 'wishlist_quantity_et-desktop' );
    $element_options['wishlist_quantity_position_et-desktop'] = ( $element_options['wishlist_quantity_et-desktop'] ) ? ' et-quantity-' . Kirki::get_option( 'wishlist_quantity_position_et-desktop' ) : '';

    $element_options['wishlist_content_position_et-desktop'] = Kirki::get_option( 'wishlist_content_position_et-desktop' );

    $element_options['wishlist_content_type_et-desktop'] = Kirki::get_option( 'wishlist_content_type_et-desktop' );

    $element_options['wishlist_dropdown_position_et-desktop'] = Kirki::get_option( 'wishlist_dropdown_position_et-desktop' );

    if ( $et_builder_globals['in_mobile_menu'] ) {
        $element_options['wishlist_style'] = 'type1';
        $element_options['wishlist_quantity_et-desktop'] = false;
        $element_options['wishlist_quantity_position_et-desktop'] = '';
        $element_options['wishlist_content_type_et-desktop'] = 'none';
    }

    $element_options['not_wishlist_page'] = true;
    if ( function_exists('yith_wcwl_object_id') ) {
        $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
        if ( ! empty( $wishlist_page_id ) && is_page( $wishlist_page_id ) ) {
            $element_options['not_wishlist_page'] = false;
        }
    }

    // filters 
    $element_options['etheme_mini_wishlist_content_type'] = apply_filters('etheme_mini_wishlist_content_type', $element_options['wishlist_content_type_et-desktop']);

    $element_options['etheme_mini_wishlist_content'] = ( $element_options['etheme_mini_wishlist_content_type'] != 'none' ) ? true : false;
    $element_options['etheme_mini_wishlist_content'] = apply_filters('etheme_mini_wishlist_content', $element_options['etheme_mini_wishlist_content']);

    $element_options['etheme_mini_wishlist_content_position'] = apply_filters('etheme_mini_wishlist_content_position', $element_options['wishlist_content_position_et-desktop']);

    $element_options['wishlist_off_canvas'] = ( $element_options['etheme_mini_wishlist_content_type'] == 'off_canvas' ) ? true : false;
    $element_options['wishlist_off_canvas'] = apply_filters('wishlist_off_canvas', $element_options['wishlist_off_canvas']);

    // header wishlist classes 
    $element_options['wrapper_class'] = ' flex align-items-center';
    if ( $et_builder_globals['in_mobile_menu'] ) $element_options['wrapper_class'] .= ' justify-content-inherit';
    $element_options['wrapper_class'] .= ' wishlist-' . $element_options['wishlist_style'];
    $element_options['wrapper_class'] .= ' ' . $element_options['wishlist_quantity_position_et-desktop'];
    $element_options['wrapper_class'] .= ( $element_options['wishlist_off_canvas'] ) ? ' et-content-' . $element_options['etheme_mini_wishlist_content_position'] : '';
    $element_options['wrapper_class'] .= ( !$element_options['wishlist_off_canvas'] && $element_options['wishlist_dropdown_position_et-desktop'] != 'custom' ) ? ' et-content-' . $element_options['wishlist_dropdown_position_et-desktop'] : '';
    $element_options['wrapper_class'] .= ( $element_options['wishlist_off_canvas'] && $element_options['etheme_mini_wishlist_content'] && $element_options['not_wishlist_page']) ? ' et-off-canvas et-off-canvas-wide et-content_toggle' : ' et-content-dropdown et-content-toTop';
    $element_options['wrapper_class'] .= ( $element_options['wishlist_quantity_et-desktop'] && $element_options['wishlist_icon'] == '' ) ? ' static-quantity' : '';
    $element_options['wrapper_class'] .= ( $et_builder_globals['in_mobile_menu'] ) ? '' : ' et_element-top-level';

    $element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
    $element_options['attributes'] = array();

    if ( $element_options['is_customize_preview'] ) 
        $element_options['attributes'] = array(
            'data-title="' . esc_html__( 'Wishlist', 'xstore-core' ) . '"',
            'data-element="wishlist"'
        ); 
?>

<div class="et_element et_b_header-wishlist <?php echo $element_options['wrapper_class']; ?>" <?php echo implode( ' ', $element_options['attributes'] ); ?>>
    <?php echo header_wishlist_callback(); ?>
</div>

<?php unset($element_options);