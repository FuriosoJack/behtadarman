<?php 
    
    // copy full when update will be on 
    if ( ! class_exists( 'Kirki' ) ) {
        global $et_options;

        $base_options = get_template_directory() . '/theme/base-options.php';
        $base_options = require_once $base_options;
        $base_options = json_decode( $base_options, true );
        $et_options   = $base_options;
        return;
    }

    add_action('init', function() {

        $options = array(
            'config' => 'config',
            'general' => 'layout',
            'header' => 'global',
            'breadcrumbs' => 'breadcrumbs',
            'footer' => 'global',
            'styling' => 'styling',
            'typography' => 'global',
            'portfolio' => 'portfolio',
            'woocommerce' => ( class_exists('WooCommerce') ? 'global' : 'section' ),
            'promo-popup' => 'promo-popup',
            'blog' => 'global',
            'social-sharing' => 'social-sharing',
            'facebook-login' => 'facebook-login',
            'instagram-api' => 'instagram-api',
            '404-page' => '404-page',
            'custom-css' => 'custom-css',
            'speed-optimization' => 'speed-optimization'
        );

        if ( get_option( 'etheme_header_builder', false ) ) {
            unset( $options['header'] );
            unset( $options['promo-popup'] );
        }

        foreach ($options as $key => $value) {
            require_once apply_filters('etheme_file_url', ETHEME_CODE . 'customizer/theme-options/'.$key.'/'.$value.'.php');   
        }

    } );

    function etheme_refresh_header_buttons_partials( WP_Customize_Manager $wp_customize ) {
    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }
        $et_partials = array();

        if ( ! get_option( 'etheme_header_builder', false ) ) {
            $et_partials['header_partials'] = array (
                // top bar 
                array(
                    'selector' => '.top-bar',
                    'partial' => 'top_bar',
                ),
                // header parts
                array(
                    'selector' => '.header-wrapper .main-header',
                    'partial' => 'header_type',
                ),
                array(
                    'selector' => '.header-logo',
                    'partial' => 'logo',
                ),
                // menu 
                array(
                    'selector' => '.menu-wrapper',
                    'partial' => 'menu_align',
                ),
                // secondary menu 
                array(
                    'selector' => '.header-bg-block .secondary-menu-wrapper',
                    'partial' => 'secondary-links-background',
                ),
                array(
                    'selector' => '.shopping-container, .et-wishlist-widget',
                    'partial' => 'cart_widget',
                ),
                array(
                    'selector' => '.navbar-header .login-link',
                    'partial' => 'top_links',
                ),
                array(
                    'selector' => '.header-search',
                    'partial' => 'search_form',
                ),
                array(
                    'selector' => '.popup_link:not(.et_b_element)',
                    'partial' => 'promo_popup',
                ),
            );
        }
        else {
            $et_partials['header_partials'] = array (
                // header parts
                array(
                    'selector' => '.header-top',
                    'partial' => 'top_header_style_separator',
                ),
                array(
                    'selector' => '.header-main',
                    'partial' => 'main_header_style_separator',
                ),
                array(
                    'selector' => '.header-bottom',
                    'partial' => 'bottom_header_style_separator',
                ),
                // vertical header 
                array(
                    'selector' => '#header-vertical',
                    'partial' => 'header_vertical_et-desktop',
                ),
                array(
                    'selector' => '#header-vertical .et_b_header-logo.et_element-top-level',
                    'partial' => 'header_vertical_logo_img_et-desktop',
                ),
                array(
                    'selector' => '#header-vertical .header-vertical-menu-icon-wrapper, .header-vertical-menu',
                    'partial' => 'header_vertical_menu_type_et-desktop',
                ),
                // header elements 
                array(
                    'selector' => '.header-button-wrapper.et_element-top-level',
                    'partial' => 'button_content_separator',
                ),
                array(
                    'selector' => '.site-header .et_b_header-logo.et_element-top-level',
                    'partial' => 'logo_content_separator',
                ),
                // all departments menu 
                array(
                    'selector' => '.et_b_header-menu.et_element-top-level .secondary-menu-wrapper',
                    'partial' => 'secondary_menu_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-mobile-menu',
                    'partial' => 'mobile_menu_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-wishlist.et_element-top-level',
                    'partial' => 'wishlist_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-socials.et_element-top-level',
                    'partial' => 'header_socials_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-languages.et_element-top-level',
                    'partial' => 'languages_content_separator',
                ),
                array(
                    'selector' => '.header-html_block1',
                    'partial' => 'html_block1',
                ),
                array(
                    'selector' => '.header-html_block2',
                    'partial' => 'html_block2',
                ),
                array(
                    'selector' => '.header-html_block3',
                    'partial' => 'html_block3',
                ),
                array(
                    'selector' => '.et_b_header-widget',
                    'partial' => 'header_widget1_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-account.et_element-top-level',
                    'partial' => 'account_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-search.et_element-top-level',
                    'partial' => 'search_content_separator',
                ),
                array(
                    'selector' => '.header-promo-text',
                    'partial' => 'promo_text_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-newsletter.et_element-top-level',
                    'partial' => 'newsletter_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-cart.et_element-top-level',
                    'partial' => 'cart_content_separator',
                ),
                array(
                    'selector' => '.header-main-menu.et_element-top-level',
                    'partial' => 'menu_content_separator',
                ),
                array(
                    'selector' => '.header-main-menu2.et_element-top-level',
                    'partial' => 'menu_2_content_separator',
                ),
                array(
                    'selector' => '.site-header .et_b_header-menu.et_element-top-level:not(.header-secondary-menu) .nav-sublist-dropdown, .site-header .header-secondary-menu.et_element-top-level .menu .nav-sublist-dropdown',
                    'partial' => 'menu_dropdown_content_separator',
                ),
                array(
                    'selector' => '.et_b_header-contacts.et_element-top-level',
                    'partial' => 'contacts_content_separator',
                ),
            );
        }

        if ( get_option( 'etheme_single_product_builder', false ) ) {
            // single product elements 
            $et_partials['single_product_partials'] = array(
                array(
                    'partial' => 'product_gallery_content_separator',
                    'selector' => '.woocommerce-product-gallery'
                ),
                array(
                    'partial' => 'product_title_style_separator',
                    'selector' => 'h1.product_title',
                ),
                array(
                    'partial' => 'product_price_style_separator',
                    'selector' => '.et_product-block > .price, .element > .price',
                ),
                array(
                    'partial' => 'product_rating_content_separator',
                    'selector' => '.woocommerce-product-rating .star-rating',
                ),
                array(
                    'partial' => 'product_meta_content_separator',
                    'selector' => '.product_meta',
                ),
                array(
                    'partial' => 'product_cart_style_separator',
                    'selector' => 'form.cart',
                ),
                array(
                    'partial' => 'product_tabs_content_separator',
                    'selector' => '.woocommerce-tabs',
                ),
                array(
                    'partial' => 'product_short_description_style_separator',
                    'selector' => '.woocommerce-product-details__short-description',
                ),
                array(
                    'partial' => 'product_sharing_content_separator',
                    'selector' => '.single-product-socials',
                ),
                array(
                    'partial' => 'product_size_guide_content_separator',
                    'selector' => '.single-product-size-guide',
                ),
                array(
                    'partial' => 'product_wishlist_content_separator',
                    'selector' => '.single-wishlist',
                ),
                array(
                    'partial' => 'product_breadcrumbs_content_separator',
                    'selector' => 'body.single-product .page-heading',
                ),
                array(
                    'partial' => 'products_upsell_content_separator',
                    'selector' => '.upsell-products',
                ),
                array(
                    'partial' => 'products_related_content_separator',
                    'selector' => '.related-products',
                ),
                array(
                    'partial' => 'single_product_html_block1_content_separator',
                    'selector' => '.single_product-html_block',
                ),
                // sidebar settings 
                array(
                    'partial' => 'single_product_layout_content_separator',
                    'selector' => '.single-product .widget-area'
                )
            );
        }
        else {
            $et_partials['single_product_partials'] = array(
                // product brands
                array(
                    'selector' => '.product_brand, .products-page-brands',
                    'partial' => 'enable_brands'
                ),

                array(
                    'selector' => 'body.single-product .page-heading',
                    'partial' => 'breadcrumb_type'
                ),

                // sale, outofstock
                array(
                    'selector' => '.sale-wrapper',
                    'partial' => 'sale_icon'
                ),

                // single related products 
                array(
                    'partial' => 'show_related',
                    'selector' => '.related-products',
                ),

                // tabs 
                array(
                    'selector' => '.single .single-product .woocommerce-tabs',
                    'partial' => 'tabs_type'
                ),
            );
        }

        $et_partials['global_partials'] = array (

            // breadcrumbs 
            array(
                'selector' => 'body:not(.single-product) .page-heading, .cart-checkout-nav',
                'partial' => 'breadcrumb_type',
            ),

            // footer 
            array(
                'selector' => '.footer',
                'partial' => 'footer_columns',
            ),
            array(
                'selector' => '.footer-bottom',
                'partial' => 'copyrights_color',
            ),

            // woocommerce 
            array(
                'selector' => '.product-category',
                'partial' => 'cat_style'
            ),
            array(
                'selector' => '.content-product',
                'partial' => 'product_view'
            ),

            // toolbar 
            array(
                'selector' => '.filter-wrap',
                'partial' => 'view_mode'
            ),

            // swatches 
            array(
                'selector' => '.st-swatch-in-loop, .st-swatch-preview-single-product',
                'partial' => 'enable_swatch'
            ),

            // cart empty
            array(
                'selector' => '.cart-empty',
                'partial' => 'empty_cart_content'
            ),

            // sale, outofstock
            array(
                'selector' => '.content-product .stock, .content-product .available-on-backorder',
                'partial' => 'sale_icon'
            ),

            // default woocommerce checkout 
            array(
                'selector' => '.woocommerce-checkout',
                'partial' => 'wp_page_for_privacy_policy'
            ),

            // social sharing 
            array(
                'selector' => '.product-share, .share-post',
                'partial' => 'socials',
            ),

            // page 404 content
            array(
                'selector' => '.page-404',
                'partial' => '404_text',
            ),
            
        );

        foreach ($et_partials['header_partials'] as $key) {
            $wp_customize->selective_refresh->add_partial( $key['partial'],
                array(
                    'selector' => $key['selector'],
                )
            );
        }

        foreach ($et_partials['single_product_partials'] as $key) {
            $wp_customize->selective_refresh->add_partial( $key['partial'],
                array(
                    'selector' => $key['selector'],
                )
            );
        }

        foreach ($et_partials['global_partials'] as $key) {
            $wp_customize->selective_refresh->add_partial( $key['partial'],
                array(
                    'selector' => $key['selector'],
                )
            );
        }

        unset($et_partials);
}

add_action( 'customize_register', 'etheme_refresh_header_buttons_partials' );