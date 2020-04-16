<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Add custom query data
// **********************************************************************//
add_action('wp', 'et_custom_query');
if ( ! function_exists( 'et_custom_query' ) ) {
    function et_custom_query(){
        global $post;
        
        $old_options = get_option('et_options', array());
        set_query_var( 'et_redux_options', $old_options );

        $post_id = etheme_get_page_id();
        $id = $post_id['id'];
        $is_mobile_device = wp_is_mobile();
        $ht = etheme_get_option('header_type');
        $custom_header = etheme_get_custom_field('custom_header', $id);
        $top_bar_color = etheme_get_option('top_bar_color');
        $header_color = etheme_get_option('header_color');
        $etheme_header_builder = get_option( 'etheme_header_builder', false );
        $etheme_single_product_builder = get_option( 'etheme_single_product_builder', false );

        $custom = etheme_get_custom_field('top_bar_color', $id);

        if( ! empty( $custom ) && $custom != 'inherit' ) {
            $top_bar_color = $custom;
        }

        if ( wp_is_mobile() ) {
            $header_color = etheme_get_option('mobile_header_color');
        }

        $custom = etheme_get_custom_field('header_color', $id);

        if( ! empty( $custom ) && $custom != 'inherit' ) {
            $header_color = $custom;
        }

        if ( ! empty( $custom_header ) && $custom_header != $ht && ( $custom_header != 'inherit' ) ) {
            $ht = $custom_header;
        }
        apply_filters('custom_header_filter', $ht );


        $template = etheme_get_option('post_template');

        $custom = etheme_get_custom_field('post_template', $id);

        if( ! empty( $custom ) ) {
            $template = $custom;
        }

        if ( class_exists('WooCommerce') ) {
            $grid_sidebar = etheme_get_option('grid_sidebar');
            set_query_var('et_grid-sidebar', $grid_sidebar);
            if  (is_shop() || is_product_category() || is_product_tag() || is_tax('brand')) {
                $view_mode = etheme_get_view_mode();
                set_query_var( 'et_view-mode', $view_mode );

            }
            if ( is_product_category() ) {
                $categories_sidebar = etheme_get_option('category_sidebar');
                set_query_var('et_cat-sidebar', $categories_sidebar);
                $category_cols = etheme_get_option('category_page_columns');
                if ( $category_cols >= 1 ) {
                    set_query_var('et_cat-cols', $category_cols);
                }
            }

            // to add variation gallery on image hover slider for products 
            set_query_var( 'etheme_shop_archive_product_variation_gallery', false );

            // if ( is_product() ) {

                if ( !$etheme_single_product_builder ) {

                    $l = etheme_page_config();
                    $layout = $l['product_layout'];

                    $thumbs_slider_mode = etheme_get_option('thumbs_slider_mode');

                    if ( $thumbs_slider_mode == 'enable' || ( $thumbs_slider_mode == 'enable_mob' && $is_mobile_device ) ) {
                        $gallery_slider = true;
                    } 
                    else {
                        $gallery_slider = false;
                    } 

                    $thumbs_slider = etheme_get_option('thumbs_slider_vertical');

                    $enable_slider = etheme_get_custom_field('product_slider', $id); 

                    $stretch_slider = etheme_get_option('stretch_product_slider');

                    $slider_direction = etheme_get_custom_field('slider_direction', $id);

                    $vertical_slider = ($thumbs_slider == 'vertical') ? true : false;

                    if ( $slider_direction == 'vertical' ) {
                        $vertical_slider = true;
                    }
                    elseif($slider_direction == 'horizontal') {
                        $vertical_slider = false;
                    }

                    $show_thumbs = ($thumbs_slider != 'disable' ) ? true : false;

                    if ( $layout == 'large' && $stretch_slider ) {
                        $show_thumbs = false;
                    }
                    if ( $slider_direction == 'disable' ) {
                        $show_thumbs = false;
                    }
                    elseif ( in_array($slider_direction, array('vertical', 'horizontal') ) ) {
                        $show_thumbs = true;
                    }
                    if ( $enable_slider == 'on' || ($enable_slider == 'on_mobile' && $is_mobile_device ) ) {
                        $gallery_slider = true;
                    }
                    elseif ( $enable_slider == 'off' || ($enable_slider == 'on_mobile' && !$is_mobile_device ) ) {
                        $gallery_slider = false;
                        $show_thumbs = false;
                    }

                    $etheme_single_product_variation_gallery = $gallery_slider && $show_thumbs && etheme_get_option('enable_variation_gallery');

                }
                else {

                    $gallery_type = etheme_get_option('product_gallery_type_et-desktop');
                    $vertical_slider = $gallery_type == 'thumbnails_left';

                    $gallery_slider = ( !in_array($gallery_type, array('one_image', 'double_image')) );
                    $show_thumbs = ( in_array($gallery_type, array('thumbnails_bottom', 'thumbnails_bottom_inside', 'thumbnails_left')));
                    $thumbs_slider = etheme_get_option('product_gallery_thumbnails_et-desktop');

                    if( defined('DOING_AJAX') && DOING_AJAX ) {
                        $gallery_slider = true;
                    }

                    $etheme_single_product_variation_gallery = etheme_get_option('enable_variation_gallery');
                
                }

                set_query_var( 'etheme_single_product_gallery_type', $gallery_slider );
                set_query_var( 'etheme_single_product_vertical_slider', $vertical_slider );
                set_query_var( 'etheme_single_product_show_thumbs', $show_thumbs );

                set_query_var( 'etheme_single_product_variation_gallery', $etheme_single_product_variation_gallery );
            
            // }
        }
        
        // ! set-query-var
        set_query_var( 'is_yp', (isset($_GET['yp_page_type']) ? true : false)); // yellow pencil
        set_query_var( 'et_post-template', $template );
        set_query_var( 'et_ht', $ht );
        set_query_var( 'is_mobile', $is_mobile_device );
        set_query_var( 'et_header-color', $header_color );
        set_query_var( 'et_top-bar-color', $top_bar_color );
        set_query_var( 'et_page-id', $post_id );
        set_query_var( 'etheme_header_builder', $etheme_header_builder );
        set_query_var( 'etheme_single_product_builder', $etheme_single_product_builder );
    }
}

function etheme_child_styles() {
    // files:
    // parent-theme/style.css, parent-theme/bootstrap.css (parent-theme/xstore.css), secondary-menu.css, options-style.min.css, child-theme/style.css
    $theme = wp_get_theme();
    $is_kirki = class_exists('Kirki') ? true : false;
    $depends = array();

    if ( get_query_var('etheme_header_builder', true) ) {
        $depends = array('etheme_customizer_frontend_css');
    }
    if ( $is_kirki && etheme_get_option('et_optimize_css') ) {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/xstore.css', $depends, $theme->version);
    }
    else {
        array_push($depends, 'bootstrap');
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', $depends, $theme->version);
    }

    if ( $is_kirki && ( etheme_get_option('secondary_menu') || get_query_var('etheme_header_builder', true) ) ) {
        wp_enqueue_style("secondary-style",get_template_directory_uri().'/css/secondary-menu.css', array("parent-style"), $theme->version);
    }

    if ( is_rtl() ) {
        wp_enqueue_style( 'rtl-style', get_template_directory_uri() . '/rtl.css', array(), $theme->version);
    }

    if( etheme_get_option('dark_styles') ) {
        wp_enqueue_style("dark-style",get_template_directory_uri().'/css/dark.css', array(), $theme->version);
    }

    $upload_dir = wp_upload_dir();
    if ( !is_xstore_migrated() && is_file($upload_dir['basedir'].'/xstore/options-style.min.css') && filesize($upload_dir['basedir'].'/xstore/options-style.min.css') > 0 && !is_customize_preview() ) {
        $custom_css = $upload_dir['baseurl'] . '/xstore/options-style.min.css';
        $custom_css = str_replace( array( 'https://', 'http://',), '//', $custom_css );
        wp_enqueue_style("options-style",$custom_css, array("parent-style"));
    }

    if ( $is_kirki && etheme_get_option('et_optimize_css') ) {
        wp_enqueue_style( 'child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array('parent-style'),
            $theme->version
        );
    }
    else {
        wp_enqueue_style( 'child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array('parent-style', 'bootstrap'),
            $theme->version
        );
    }
}

add_action('wp_head', function() {
    global $post;
    if ( !is_object($post) ) return;
    if ( $post->post_type == 'staticblocks' && function_exists('wp_no_robots') ) {
        wp_no_robots();
    }
});

// **********************************************************************// 
// ! Add classes to body
// **********************************************************************//
add_filter('body_class', 'etheme_add_body_classes');
if(!function_exists('etheme_add_body_classes')) {
    function etheme_add_body_classes($classes) {
        
        $l = etheme_page_config();

        $post_id = (array)get_query_var('et_page-id');
        $post_template  = get_query_var('et_post-template', 'default');

        $id = $post_id['id'];
        $etheme_header_builder = get_query_var( 'etheme_header_builder', false );
        $etheme_single_product_builder = get_query_var('etheme_single_product_builder', false);

        // portfolio page asap fix 
        $portfolio_page_id = etheme_get_option( 'portfolio_page' );

        if ( etheme_get_option('portfolio_projects') ) {

            if ( function_exists('icl_object_id') ) {
                global $sitepress;
                if ( ! empty( $sitepress )  ) {
                    $multy_id = icl_object_id ( $id, "page", false, $sitepress->get_default_language() );
                } elseif( function_exists( 'pll_current_language' ) ) {
                    $multy_id = icl_object_id ( $id, "page", false, pll_current_language() );
                } else {
                    $multy_id = false;
                }

                if (  $id == $portfolio_page_id || $portfolio_page_id == $multy_id ) {
                    foreach ( $classes as $key => $value ) {
                        if ( in_array($value, array('page-template-default', 'page-template-portfolio') ) ) unset( $classes[ $key ] );
                    }
                    $classes[] = 'page-template-portfolio';
                }
            } else {
                if (  $id == $portfolio_page_id ) {
                    foreach ( $classes as $key => $value ) {
                        if ( in_array($value, array('page-template-default', 'page-template-portfolio') ) ) unset( $classes[ $key ] );
                    }
                    $classes[] = 'page-template-portfolio';
                }
            }
        }

        if ( !$etheme_header_builder ) {
            $ht = get_query_var('et_ht', 'xstore');

            $custom_header = etheme_get_custom_field('custom_header', $id);
            if ( ! empty($custom_header) && $custom_header != $ht && ($custom_header != 'inherit') ) {
                $ht = $custom_header;
            }

            if ( etheme_get_option('fixed_header') == 'fixed' ) { $fixed_type = 'et-header-fixed'; }
            elseif ( etheme_get_option('fixed_header') == 'smart' ) { $fixed_type = 'et-header-sticky'; }
            else { $fixed_type = 'et-fixed-disable'; }

            if( etheme_get_option( 'fixed_nav' ) != 'disable') $classes[] = 'fixed-' . etheme_get_option('fixed_nav');

            if( in_array( $ht, array( 'vertical', 'vertical2' ) ) ) $classes[] = 'et-vertical-fixed';
            $classes[] = (etheme_get_option('cart_widget')) ? 'cart-widget-on' : 'cart-widget-off';
            $classes[] = (etheme_get_option('shopping_cart_icon')) ? 'et_cart-type-'.etheme_get_option('shopping_cart_icon') : ''; //
            $classes[] = (etheme_get_option('search_form')) ? 'search-widget-on' : 'search-widget-off';
            $classes[] = (etheme_get_option('header_full_width')) ? 'et-header-full-width' : 'et-header-boxed';
            $classes[] = (etheme_get_option('top_panel')) ? 'et-toppanel-on' : 'et-toppanel-off';
            $classes[] = (etheme_get_option('header_overlap') || etheme_get_custom_field('header_overlap', $id)) ? 'et-header-overlap' : 'et-header-not-overlap';
            $classes[] = $fixed_type;
            $classes[] = (etheme_get_option('smart_header_menu')) ? 'header-smart-responsive' : '';

            $classes[] = ( etheme_get_option( 'search_form' ) != 'header' || etheme_get_option( 'top_wishlist_widget' ) != 'header' || etheme_get_option( 'cart_widget' ) != 'header' || ( etheme_get_option('top_links') != 'header' && etheme_get_option('top_links') != 'menu' ) ) ? 'shop-top-bar': '';
            $classes[] = (etheme_get_option('menu_full_width')) ? 'mega-menus-full-width' : '';
            if ( etheme_get_option( 'secondary_menu' ) ) {
                $classes[] = 'et-secondary-menu-on';
            } else {
                $classes[] = 'et-secondary-menu-off';
            }

            $classes[] = "global-header-" . $ht;

            if( etheme_get_option( 'promo_auto_open' ) ) $classes[] = 'open-popup ';
            if( etheme_get_option( 'promo_open_scroll' ) ) $classes[] = 'scroll-popup ';
        }
        else {
            $cart = etheme_get_option('cart_icon_et-desktop');
            switch ($cart) {
                case 'type1':
                    $classes[] = 'et_cart-type-1';
                    break;
                case 'type2':
                    $classes[] = 'et_cart-type-4';
                    break;
                case 'type4':
                    $classes[] = 'et_cart-type-3';
                    break;
                default:
                    $classes[] = 'et_cart-type-2';
                    break;
            }
            $classes[] = 'et-fixed-disable';
            $classes[] = 'et-secondary-menu-on';
            $classes[] = (etheme_get_option('header_overlap_et-desktop')) ? 'et_b_dt_header-overlap' : 'et_b_dt_header-not-overlap';
            $classes[] = (etheme_get_option('header_overlap_et-mobile')) ? 'et_b_mob_header-overlap' : 'et_b_mob_header-not-overlap';
        }

        $classes[] = 'breadcrumbs-type-'.$l['breadcrumb'];
        $classes[] = etheme_get_option('main_layout');
        $classes[] = (etheme_get_option('cart_special_breadcrumbs')) ? 'special-cart-breadcrumbs' : '';
        $classes[] = (etheme_get_option('site_preloader')) ? 'et-preloader-on' : 'et-preloader-off';
        $classes[] = (etheme_get_option('just_catalog')) ? 'et-catalog-on' : 'et-catalog-off';
        $classes[] = ( ( etheme_get_option('footer_fixed') || etheme_get_custom_field('footer_fixed', $id) == 'yes' ) && etheme_get_custom_field('footer_fixed', $id) != 'no' ) ? 'et-footer-fixed-on' : 'et-footer-fixed-off';
        $classes[] = ( get_query_var('is_mobile') ) ? 'mobile-device' : ''; // new
        if ( get_query_var('is_mobile') && etheme_get_option('footer_widgets_open_close') ) {
            $classes[] = 'f_widgets-open-close';
            $classes[] = (etheme_get_option('footer_widgets_open_close_type') == 'closed_mobile') ? 'fwc-default' : '';
        }
        $classes[] = etheme_masonry() ? 'etheme_masonry_on' : '';


        if ( etheme_woocommerce_installed() ) {
            if ( is_shop() || is_product_category() ) {
                $classes[] = (etheme_get_option('sidebar_widgets_scroll')) ? 's_widgets-with-scroll' : ''; // sidebar widgets with scroll
                $classes[] = (etheme_get_option('sidebar_widgets_open_close')) ? 's_widgets-open-close' : '';
                $sidebar_widgets_open_close_type = etheme_get_option('sidebar_widgets_open_close_type');
                $classes[] = ($sidebar_widgets_open_close_type == 'closed' || (($sidebar_widgets_open_close_type == 'closed_mobile') && get_query_var('is_mobile')) ) ? 'swc-default' : '';
            }
            elseif ( is_product() ) {
                $classes[] = 'sticky-message-'.(etheme_get_option('sticky_added_to_cart_message') ? 'on' : 'off');
                if ( $etheme_single_product_builder ) {
                    $classes[] = (etheme_get_option('single_product_widget_area_1_widget_scroll_et-desktop')) ? 's_widgets-with-scroll' : ''; // sidebar widgets with scroll
                    $classes[] = (etheme_get_option('single_product_widget_area_1_widget_toggle_et-desktop')) ? 's_widgets-open-close' : '';
                    $single_product_widget_area_1_widget_toggle_actions = etheme_get_option('single_product_widget_area_1_widget_toggle_actions_et-desktop');
                    $classes[] = ($single_product_widget_area_1_widget_toggle_actions == 'closed' || (($single_product_widget_area_1_widget_toggle_actions == 'closed_mobile') && get_query_var('is_mobile')) ) ? 'swc-default' : '';
                }
            }
        }

        // secondary
        $classes[] = 'et-secondary-visibility-' . etheme_get_option('secondary_menu_visibility');
        if( etheme_get_option('secondary_menu_visibility') == 'opened' ) {
            $classes[] = (etheme_get_option('secondary_menu_home')) ? 'et-secondary-on-home' : '';
            $classes[] = (etheme_get_option('secondary_menu_subpages')) ? 'et-secondary-on-subpages' : '';
        } else {
            $classes[] = (etheme_get_option('secondary_menu_darkening') && !$etheme_header_builder ) ? 'et-secondary-darkerning-on' : 'et-secondary-darkerning-off';
        }
        if ( $post_template == 'large2' ) {
            $post_template = 'large global-post-template-large2';
        }
        $classes[] = 'global-post-template-' . $post_template;

        // $header_bg = etheme_get_option('header_bg_color');

        // if( !empty($header_bg['background-color']) && $header_bg['background-color'] == 'transparent' ) {
        //     $classes[] = "body-header-transparent";
        // }

        if(!$etheme_single_product_builder && etheme_get_option('product_name_signle')) {
            $classes[] = 'global-product-name-off';
        } else {
            $classes[] = 'global-product-name-on';
        }

        if ( class_exists( 'WooCommerce_Quantity_Increment' ) ) $classes[] = 'et_quantity-off';

        if ( etheme_get_option( 'enable_swatch' ) && class_exists( 'St_Woo_Swatches_Base' ) ) {
           $classes[] = 'et-enable-swatch';
        }

        if ( etheme_get_option( 'ajax_product_filter' ) && etheme_woocommerce_installed() && !is_product() ) {
            $classes[] = 'et-ajax-product-filter';
        }

        if ( etheme_get_option( 'ajax_product_pagination' ) && etheme_woocommerce_installed() && !is_product() ) {
            $classes[] = 'et-ajax-product-pagination';
        }


        if ( etheme_get_option( 'et_optimize_js' ) ) {
            $classes[] = 'et-old-browser';
        }

        return $classes;
    }
}

// **********************************************************************// 
// ! Render custom styles
// **********************************************************************//
if ( !function_exists('et_custom_styles') ) {
    function et_custom_styles () {

        $css = '';

        $preloader = etheme_get_option( 'preloader_img' );

        $et_selectors = array();

        $activeColor = (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#8a8a8a';

        $etheme_header_builder = get_query_var( 'etheme_header_builder', false );
        $etheme_single_product_builder = get_query_var( 'etheme_single_product_builder', false );

        if ( !$etheme_header_builder ) {
            // Header background color
            $header_bg_color = etheme_get_option('header_bg');

            if ( is_array($header_bg_color) && isset($header_bg_color['background-color'] ) ) {
                $header_bg_color = $header_bg_color['background-color'];
            }

            // tweak for search button background color 
            if ( $header_bg_color != $activeColor ) {
                $css .= '.header-advanced .header-search.act-default [role="searchform"] .btn:before {background-color: transparent;}';
            }

        }

            $fonts = get_option( 'etheme-fonts', false );
            if ( $fonts ) {
                foreach ( $fonts as $value ) {
                    // ! Validate format
                    switch ( $value['file']['extension'] ) {
                        case 'ttf':
                            $format = 'truetype';
                            break;
                        case 'otf':
                            $format = 'opentype';
                            break;
                        case 'eot':
                            $format = false;
                            break;
                        case 'eot?#iefix':
                            $format = 'embedded-opentype';
                            break;
                        case 'woff2':
                            $format = 'woff2';
                            break;
                        case 'woff':
                            $format = 'woff';
                            break;
                        default:
                            $format = false;
                            break;
                    }

                    $format = ( $format ) ? 'format("' . $format . '")' : '';

                    $font_url = ( is_ssl() && (strpos($value['file']['url'], 'https') === false) ) ? str_replace('http', 'https', $value['file']['url']) : $value['file']['url'];

                    // ! Set fonts
                    $css .= '
                        @font-face {
                            font-family: "' . $value['name'] . '";
                            src: url(' . $font_url . ') ' . $format . ';
                        }
                    ';
                }
            }

            $sale_size = etheme_get_option('sale_icon_size');
            $sale_size = explode( 'x', $sale_size );

            if ( ! isset( $sale_size[0] ) ) $sale_size[0] = 3.75;
            if ( ! isset( $sale_size[1] ) ) $sale_size[1] = $sale_size[0];

            $sale_color = etheme_get_option('sale_icon_color');
            $sale_bg = etheme_get_option('sale_icon_bg_color');
            $sale_br_radius = etheme_get_option('sale_br_radius');
            $sale_width = $sale_size[0];
            $sale_height = $sale_size[1];

            $css .= '.onsale{';
                $css .= (!empty($sale_width)) ? 'width:'.$sale_width.'em;' : '';
                $css .= (!empty($sale_height)) ? 'height:'.$sale_height.'em; line-height: 1.2;' : '';
            $css .= '}';

            $site_width = etheme_get_option('site_width');

            $css .= '@media (min-width: 1200px){
                .container, div.container, .et-container {
                    width: 100%;
                }
                .footer:after,
                .boxed .template-container, .framed .template-container,
                .boxed .header-wrapper, .framed .header-wrapper {
                    max-width: 100%;
                }
            }';

        // Secondary links
        $secondary_links_border_style = etheme_get_option('secondary-links-border-style');
        $secondary_links_border_style = (!empty($secondary_links_border_style['border-style']) && $secondary_links_border_style['border-style'] != 'solid' ) ? $secondary_links_border_style['border-style'] : '';

        if ( trim($secondary_links_border_style) != '' ) {
            $css .= '.secondary-menu-wrapper .menu > li:not(:last-child) > a {
                border-bottom-style: ' . $secondary_links_border_style . '!important;
            }
            .menu-wrapper .secondary-menu-wrapper .menu > li {
                border: none;
                border-color: transparent;
            }';
        }

        $active_buttons_bg = etheme_get_option('active_buttons_bg');
        
        if ( is_array($active_buttons_bg) && isset($active_buttons_bg['hover']) && $active_buttons_bg['hover'] != '' ) {
            $css .= '.btn-checkout:hover, .btn-view-wishlist:hover {
                opacity: 1 !important;
            }';
        }

        $q_dimentions = etheme_get_option('quick_dimentions');

        if ( etheme_get_option('quick_view') && ( !empty($q_dimentions['width']) || !empty($q_dimentions['height']) ) ) {
            $css .= '@media (min-width: 768px) {';
                $css .= '.quick-view-popup {';
                if ( !empty($q_dimentions['width']) ) {
                    $css .= 'width: '.$q_dimentions['width'].';';
                }
                if ( !empty($q_dimentions['height']) ) {
                    $css .= 'height: '.$q_dimentions['height'].';';
                }

                $css .= '}';

                if ( !empty($q_dimentions['height']) ) {
                    $css .= '.quick-view-popup .product-content {';
                    $css .= 'max-height:'.$q_dimentions['height'].';';
                    $css .= '}';
                    $css .= '.quick-view-layout-default img, .quick-view-layout-default iframe {';
                    $css .= 'max-height:'.$q_dimentions['height'].';';
                    $css .= 'margin: 0 auto !important;';
                    $css .= '}';
                }
            $css .= '}';
        }

        // ! breadcrumb background
        $bread_bg = etheme_get_option( 'breadcrumb_bg' );

        $css .= '.page-heading {';
            if( ! empty( $bread_bg['background-image'] ) || ! empty( $bread_bg['background-color'] ) ){
                $css .= 'margin-bottom: 15px;';
            }
        $css .= '}';

        $css = et_minify_css($css);
        return $css;
    }
}

if ( !function_exists('et_custom_styles_responsive') ) {
    function et_custom_styles_responsive () {
        $css = '';
        $custom_css = etheme_get_option('custom_css_global');
        $custom_css_desktop = etheme_get_option('custom_css_desktop');
        $custom_css_tablet = etheme_get_option('custom_css_tablet');
        $custom_css_wide_mobile = etheme_get_option('custom_css_wide_mobile');
        $custom_css_mobile = etheme_get_option('custom_css_mobile');
        if($custom_css != '') {
            $css .= $custom_css;
        }
        if($custom_css_desktop != '') {
            $css .= '@media (min-width: 993px) { ' . $custom_css_desktop . ' }';
        }
        if($custom_css_tablet != '') {
            $css .= '@media (min-width: 768px) and (max-width: 992px) {' . $custom_css_tablet . ' }';
        }
        if($custom_css_wide_mobile != '') {
            $css .= '@media (min-width: 481px) and (max-width: 767px) { ' . $custom_css_wide_mobile . ' }';
        }
        if($custom_css_mobile != '') {
            $css .= '@media (max-width: 480px) { ' . $custom_css_mobile . ' }';
        }
        $css = et_minify_css($css);
        return $css;
    }
}

if ( !function_exists('et_minify_css') ) {
    function et_minify_css ($css) {
        // Normalize whitespace
        $css = preg_replace( '/\s+/', ' ', $css );
        
        // Remove spaces before and after comment
        $css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
        // Remove comment blocks, everything between /* and */, unless
        // preserved with /*! ... */ or /** ... */
        $css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
        // Remove ; before }
        $css = preg_replace( '/;(?=\s*})/', '', $css );
        // Remove space after , : ; { } */ >
        $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
        // Remove space before , ; { } ( ) >
        $css = preg_replace( '/ (,|;|\{|}|>)/', '$1', $css );
        // Strips leading 0 on decimal values (converts 0.5px into .5px)
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
        // Strips units if value is 0 (converts 0px to 0)
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
        // Converts all zeros value into short-hand
        $css = preg_replace( '/0 0 0 0/', '0', $css );
        // Shortern 6-character hex color codes to 3-character where possible
        $css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );
        return trim( $css );
    
    }
}

add_action('wp', 'is_xstore_migrated');
// **********************************************************************// 
// ! Check xstore migrated
// **********************************************************************// 
function is_xstore_migrated(){
    if ( get_option( 'et_options' ) ) {
        return get_option( 'xstore_theme_migrated', false );
    } else{
        return true;
    }
}

// **********************************************************************// 
// ! Check woocommerce installed
// **********************************************************************// 
if( ! function_exists('etheme_woocommerce_installed') ) {
    function etheme_woocommerce_installed() {
        return class_exists('WooCommerce');
    }
}

// **********************************************************************// 
// ! WooCommerce active notice
// **********************************************************************// 
if( ! function_exists('etheme_woocommerce_notice') ) {
    function etheme_woocommerce_notice($notice = '') {
        if ( ! etheme_woocommerce_installed() ) {
            if ( $notice == '' ) $notice = esc_html__( 'To use this element install or activate WooCommerce plugin', 'xstore' );
            echo '<p>' . $notice . '</p>';
            return true;
        } else {
            return false;
        }
    }
}

// **********************************************************************// 
// ! core plugin active notice
// **********************************************************************// 
if( ! function_exists('etheme_xstore_plugin_notice') ) {
    function etheme_xstore_plugin_notice($notice = '') {
        if ( ! defined( 'ET_CORE_DIR' ) ) {
            if ( $notice == '' ) $notice = esc_html__( 'To use this element install or activate XStore Core plugin', 'xstore' );
            echo '<p>' . $notice . '</p>';
            return true;
        } else {
            return false;
        }
    }
}

// **********************************************************************// 
// ! Wp title
// **********************************************************************// 
if(!function_exists('etheme_wp_title')) {
    function etheme_wp_title($title, $sep ) {
        global $paged, $page;

        if ( is_feed() ) {
            return $title;
        }

        // Add the site name.
        $title .= get_bloginfo( 'name', 'display' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title = "$title $sep $site_description";
        }

        // Add a page number if necessary.
        if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
            $title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'xstore' ), max( $paged, $page ) );
        }

        return $title;
    }
    add_filter( 'wp_title', 'etheme_wp_title', 10, 2 );
}

// **********************************************************************// 
// ! Get logo data
// **********************************************************************// 
if(!function_exists('etheme_get_logo_data')) {
    function etheme_get_logo_data() {
        $return = array(
            'logo' => array(),
            'fixed_logo' => array()
        );

        $logo_fixed = etheme_get_option('logo_fixed');
        if(!is_array($logo_fixed)) {
            $logo_fixed = array('url' => $logo_fixed);
        }

        $logoimg = etheme_get_option('logo');

        if ( !is_array($logoimg) && $logoimg == '' ) {
            $logoimg = array();
        }

        if(empty($logo_fixed['url'])) {
            $logo_fixed = $logoimg;
        }

       $page = (array) get_query_var('et_page-id');

        $custom_logo = etheme_get_custom_field('custom_logo', $page['id'] );

        if($custom_logo != '') {
            $logoimg['url'] = $custom_logo;
            $logo_fixed['url'] = $custom_logo;
        }

        $return['logo']['src'] = (!empty($logoimg['url'])) ? $logoimg['url'] : ETHEME_BASE_URI.'theme/assets/images/logo.png';
        $return['fixed_logo']['src'] = (!empty($logo_fixed['url'])) ? $logo_fixed['url'] : ETHEME_BASE_URI.'theme/assets/images/logo.png';

        if( is_ssl() ) {
            $return['logo']['src'] = str_replace('http://', 'https://', $return['logo']['src']);
            $return['fixed_logo']['src'] = str_replace('http://', 'https://', $return['fixed_logo']['src']);
        }

        $return['logo']['alt'] = '';
        $return['fixed_logo']['alt'] ='';

        if ( isset( $logoimg['id'] ) && $logoimg['id'] != '') {
            $return['logo']['alt'] = get_post_meta( $logoimg['id'], '_wp_attachment_image_alt', true ) ;
            $return['fixed_logo']['alt'] = get_post_meta( $logo_fixed['id'], '_wp_attachment_image_alt', true ) ;
        }

        if ( $return['logo']['alt'] == '' )  $return['logo']['alt'] = get_bloginfo( 'description' );
        if ( $return['fixed_logo']['alt'] == '' )  $return['fixed_logo']['alt'] = get_bloginfo( 'description' );    
        $return['logo']['width'] = (!empty($logoimg['width'])) ? $logoimg['width'] : 259;
        $return['logo']['height'] = (!empty($logoimg['height'])) ? $logoimg['height'] : 45;      
        $return['fixed_logo']['width'] = (!empty($logo_fixed['width'])) ? $logo_fixed['width'] : 259;
        $return['fixed_logo']['height'] = (!empty($logo_fixed['height'])) ? $logo_fixed['height'] : 45;

        return $return;
    }
}   

// **********************************************************************// 
// ! Signin link
// **********************************************************************//
if ( ! function_exists('etheme_sign_link') ) {
    function etheme_sign_link($class = '', $short = false, $echo = false) {
        $link = array();
        $type = etheme_get_option( 'sign_in_type' );
        $ht = get_query_var( 'et_ht', 'xstore' );
        $login_link = (etheme_woocommerce_installed()) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();

        if ( $ht == 'hamburger-icon' || $type == 'icon' ) {
            $class .= ' type-icon';
        } elseif( $type == 'text_icon' ){
            $class .= ' type-icon-text';
        }

        if ( is_user_logged_in() && etheme_woocommerce_installed() ) {
                if ( has_nav_menu( 'my-account' ) ) { 
                    $submenu = wp_nav_menu(array(
                        'theme_location' => 'my-account',
                        'before' => '',
                        'container_class' => 'menu-main-container',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'depth' => 100,
                        'fallback_cb' => false,
                        'walker' => new ETheme_Navigation,
                        'echo' => false
                    ));
                } else {
                    $submenu = '<div class="menu-main-container">';
                        $submenu .= '<ul class="menu">';
                            foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
                                $url = ( $endpoint != 'dashboard' ) ? wc_get_endpoint_url( $endpoint, '', $login_link ) : $login_link ;
                                $url = ( $endpoint == 'customer-logout' ) ? wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) : $url;
                                $submenu .= '<li class="' . wc_get_account_menu_item_classes( $endpoint ) . '">';
                                    $submenu .= '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
                                $submenu .= '</li>';
                            }
                        $submenu .= '</ul>';
                    $submenu .= '</div>';
                }

                $link = array(
                    'class' => 'my-account-link' . $class,
                    'link_class' => '',
                    'href' => $login_link,
                    'title' => esc_html__( 'My Account', 'xstore' ),
                    'submenu' => $submenu
                );
                $class .= ' my-account-link';
        } else {
            $login_text = ( $short ) ? esc_html__( 'Sign In', 'xstore' ) : esc_html__( 'Sign In or Create an account', 'xstore' );
            $login_text = ( etheme_get_option( 'sign_in_text' ) != '' ) ? etheme_get_option( 'sign_in_text' ) : $login_text;

            if ( ! $short ) {
                if ( etheme_woocommerce_installed() ) { 
                    ob_start(); ?>
                    <form class="woocommerce-form woocommerce-form-login login" autocomplete="off" method="post" action="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>">

                        <?php do_action( 'woocommerce_login_form_start' ); ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="username"><?php esc_html_e( 'Username or email address', 'xstore' ); ?>&nbsp;<span class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="password"><?php esc_html_e( 'Password', 'xstore' ); ?>&nbsp;<span class="required">*</span></label>
                            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                        </p>

                        <?php do_action( 'woocommerce_login_form' ); ?>

                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="lost-password"><?php esc_html_e( 'Lost password ?', 'xstore' ); ?></a>

                        <p>
                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember Me', 'xstore' ); ?></span>
                            </label>
                        </p>

                        <p class="login-submit">
                            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                            <button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Log in', 'xstore' ); ?>"><?php esc_html_e( 'Log in', 'xstore' ); ?></button>
                        </p>
                        <?php etheme_faceboook_login_button(); ?>
                        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ): ?>
                            <p class="text-center"><?php esc_html_e('New client', 'xstore');?> <a href="<?php echo esc_url( $login_link ); ?>" class="register-link"><?php esc_html_e('Register ?', 'xstore'); ?></a></p>
                        <?php endif; ?>

                        <?php do_action( 'woocommerce_login_form_end' ); ?>

                    </form>

                <?php $login_form = ob_get_clean(); }
                else {
                    $login_form = wp_login_form(
                        array(
                            'echo' => false,
                            'label_username' => esc_html__( 'Username or email address *', 'xstore' ),
                            'label_password' => esc_html__( 'Password *', 'xstore' )
                        )
                    );
                }
            } else {
                $login_form = '';
            }
            $link = array(
                'class' => 'login-link' . $class,
                'link_class' => '',
                'href' => $login_link,
                'title' => $login_text,
                'submenu' => '<div class="menu-main-container">' . $login_form . '</div>'
            );

            $class .= ' login-link';
        }

        if ( $echo ) {
            if ( $echo === 'get' ) {
                return sprintf(
                    '<%1$s class="%2$s"><a href="%3$s" class="%4$s">%5$s</a>%6$s</%1$s>',
                    ( etheme_get_option( 'top_links') == 'menu' ) ? 'li' : 'div',
                    esc_attr( $class ),
                    esc_url( $link['href'] ),
                    esc_attr( $link['link_class'] ),
                    $link['title'],
                    $link['submenu']
                );
            } else {
                printf(
                    '<%1$s class="%2$s"><a href="%3$s" class="%4$s">%5$s</a>%6$s</%1$s>',
                    ( etheme_get_option( 'top_links') == 'menu' ) ? 'li' : 'div',
                    esc_attr( $class ),
                    esc_url( $link['href'] ),
                    esc_attr( $link['link_class'] ),
                    $link['title'],
                    $link['submenu']
                );
            }
        } else {
            return $link;
        }
    }
}

// **********************************************************************// 
// ! Get gallery from content
// **********************************************************************//
if(!function_exists('etheme_gallery_from_content')) {
    function etheme_gallery_from_content($content) {

        $result = array(
            'ids' => array(),
            'filtered_content' => ''
        );

        preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);
        if(!empty($ids)) {
            $result['ids'] = explode(",", $ids[1]);
            $content =  str_replace($ids[0], "", $content);
            $result['filtered_content'] = apply_filters( 'the_content', $content);
        }

        return $result;

    }
}

// **********************************************************************// 
// ! Get post classes
// **********************************************************************//
if(!function_exists('etheme_post_class')) {
    function etheme_post_class( $layout = false ) {
        global $et_loop;

        $classes = array();
        $classes[] = 'blog-post';

        if ( ! empty( $et_loop['columns'] ) ) {
            if( $et_loop['columns'] < 1 ) $et_loop['columns'] = 1;
            $cols = 12/$et_loop['columns'];
            $classes[] = 'post-grid';
            $classes[] = 'isotope-item';
            $classes[] = 'col-md-' . $cols;
        }

        if(etheme_get_option('blog_byline')) {
            $classes[] = ' byline-on';
        } else {
            $classes[] = ' byline-off';
        }

        if( ! $layout ) {
            $classes[] = ' content-'.etheme_get_option('blog_layout');
        } else {
            $classes[] = ' content-'.$layout;
        }

        if( ! empty( $et_loop['slide_view'] ) ) {
            $classes[] = 'slide-view-' . $et_loop['slide_view'];
        }

        if( ! empty( $et_loop['blog_align'] ) ) {
            $classes[] = ' blog-align-' . $et_loop['blog_align'];
        }
        return $classes;
    }
}

// **********************************************************************// 
// ! Get column class bootstrap
// **********************************************************************// 
if(!function_exists('etheme_get_product_class')) {
    function etheme_get_product_class($colums = 3 ) {
        $cols = 12 / $colums;

        $small = 6;
        $extra_small = 6;

        $class = 'col-md-' . $cols;
        $class .= ' col-sm-' . $small;
        $class .= ' col-xs-' . $extra_small;

        return $class;
    }
}

// **********************************************************************// 
// ! Get read more button text
// **********************************************************************//
if(!function_exists('etheme_read_more')) {
    function etheme_read_more( $link = false, $echo = false ) {
        $btn = etheme_get_option( 'read_more' );

        if ( $btn == 'off' || ! $link ) return;

        if ( $echo ) {
            printf(
                '<a href="%s" class="more-button"><span class="read-more%s">%s</span></a>',
                esc_url( $link ),
                ( $btn == 'btn' ) ? ' btn medium active' : '',
                esc_html__( 'Continue reading', 'xstore' )
            );
        } else {
            return sprintf(
                '<a href="%s" class="more-button"><span class="read-more%s">%s</span></a>',
                esc_url( $link ),
                ( $btn == 'btn' ) ? ' btn medium active' : '',
                esc_html__( 'Continue reading', 'xstore' )
            );
        }
    }
}

// **********************************************************************//
// ! Views coutner
// **********************************************************************//
if(!function_exists('etheme_get_views')) {
    function etheme_get_views($id = false, $echo = false) {
        if( ! $id ) $id = get_the_ID();
        $number = get_post_meta( $id, '_et_views_count', true );
        if( empty($number) ) $number = 0;

        if ( $echo ) {
            echo '<span class="views-count">' . $number . '</span>';
        } else {
            return $number;
        }
    }
}

add_action( 'wp', 'etheme_update_views');

if(!function_exists('etheme_update_views')) {
    function etheme_update_views() {
        if( ! is_single() || ! is_singular( 'post' ) ) return;

        $id = get_the_ID();

        $number = etheme_get_views( $id );
        if( empty($number) ) {
            $number = 1;
            add_post_meta( $id, '_et_views_count', $number );
        } else {
            $number++;
            update_post_meta( $id, '_et_views_count', $number );
        }
    }
}

// **********************************************************************// 
// ! Custom Comment Form
// **********************************************************************// 

if(!function_exists('etheme_custom_comment_form')) {
    function etheme_custom_comment_form($defaults) {
        $defaults['comment_notes_before'] = '
            <p class="comment-notes">
                <span id="email-notes">
                ' . esc_html__( 'Your email address will not be published. Required fields are marked', 'xstore' ) . '
                </span>
            </p>
        ';
        $defaults['comment_notes_after'] = '';
        $dafaults['id_form'] = 'comments_form';

        $defaults['comment_field'] = '
            <div class="form-group">
                <label for="comment" class="control-label">'.esc_html__('Your Comment', 'xstore').'</label>
                <textarea placeholder="' . esc_html__('Comment', 'xstore') . '" class="form-control required-field"  id="comment" name="comment" cols="45" rows="12" aria-required="true"></textarea>
            </div>
        ';

        return $defaults;
    }
}

add_filter('comment_form_defaults', 'etheme_custom_comment_form');

if(!function_exists('etheme_custom_comment_form_fields')) {
    function etheme_custom_comment_form_fields() {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $reqT = '<span class="required">*</span>';
        $aria_req = ($req ? " aria-required='true'" : ' ');
        $consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
        $fields = array(
            'author' => '
                <div class="form-group comment-form-author">'.
                    '<label for="author" class="control-label">'.esc_html__('Name', 'xstore').' '.($req ? $reqT : '').'</label>'.
                    '<input id="author" name="author" placeholder="' . esc_html__('Your name (required)', 'xstore') . '" type="text" class="form-control ' . ($req ? ' required-field' : '') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30" ' . $aria_req . '>'.
                '</div>
            ',
            'email' => '
                <div class="form-group comment-form-email">'.
                    '<label for="email" class="control-label">'.esc_html__('Email', 'xstore').' '.($req ? $reqT : '').'</label>'.
                    '<input id="email" name="email" placeholder="' . esc_html__('Your email (required)', 'xstore') . '" type="text" class="form-control ' . ($req ? ' required-field' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" ' . $aria_req . '>'.
                '</div>
            ',
            'url' => '
                <div class="form-group comment-form-url">'.
                    '<label for="url" class="control-label">'.esc_html__('Website', 'xstore').'</label>'.
                    '<input id="url" name="url" placeholder="' . esc_html__('Your website', 'xstore') . '" type="text" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" size="30">'.
                '</div>
            ',
            'cookies' => '
                <p class="comment-form-cookies-consent">
                    <label for="wp-comment-cookies-consent">
                        <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '
                        <span>' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'xstore' ) . '</span>
                    </label>
                </p>'
        );

        return $fields;
    }
}

add_filter('comment_form_default_fields', 'etheme_custom_comment_form_fields');







if ( ! function_exists( 'filter_login_form_middle' ) ) {
    function filter_login_form_middle( $content, $args ){
        $content .= '<a href="'.wp_lostpassword_url().'" class="lost-password">'.esc_html__('Lost Password ?', 'xstore').'</a>';
        return $content;
    }
}
add_filter( 'login_form_middle', 'filter_login_form_middle', 10, 2 );

if ( !function_exists( 'filter_login_form_bottom' ) ) {
    function filter_login_form_bottom( $content, $args ){
        $url = (etheme_woocommerce_installed() && (get_option('woocommerce_enable_myaccount_registration') == 'yes') ) ? wc_get_page_permalink( 'myaccount' ) : wp_registration_url();
        $content .= etheme_faceboook_login_button(false);
        $content .= '<p class="text-center">'.esc_html__('New client', 'xstore').' <a href="'.$url.'" class="register-link">'.esc_html__('Register ?', 'xstore').'</a></p>';
        return $content;
    }
}
add_filter( 'login_form_bottom', 'filter_login_form_bottom', 10, 2 );

// **********************************************************************// 
// ! Set exerpt 
// **********************************************************************//
if(!function_exists('etheme_excerpt_length')) {
    function etheme_excerpt_length( $length ) {
        return (int)etheme_get_option('excerpt_length');
    }
}

if(!function_exists('etheme_excerpt_length_sliders')) {
    function etheme_excerpt_length_sliders( $length ) {
        return (int)etheme_get_option('excerpt_length_sliders');
    }
}

add_filter( 'excerpt_length', 'etheme_excerpt_length', 999 );

if( ! function_exists( 'etheme_excerpt_more' ) ) {
    function etheme_excerpt_more( $more ) {
        return etheme_get_option( 'excerpt_words' );
    }
}

add_filter( 'excerpt_more', 'etheme_excerpt_more', 9999 );


// **********************************************************************// 
// ! Enable shortcodes in text widgets
// **********************************************************************// 
add_filter('widget_text', 'do_shortcode');


// **********************************************************************// 
// ! Add Facebook Open Graph Meta Data
// **********************************************************************// 

//Adding the Open Graph in the Language Attributes
if( ! function_exists( 'etheme_add_opengraph_doctype' ) ) {
    function etheme_add_opengraph_doctype( $output ) {
        $share_facebook = etheme_get_option('socials');
        if ( is_array($share_facebook) && in_array( 'share_facebook', $share_facebook ) ) {
            return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
        } else {
            return $output;
        }
    }
}
add_filter('language_attributes', 'etheme_add_opengraph_doctype');

// **********************************************************************//
// ! Search, search SKU
// **********************************************************************/

add_action('pre_get_posts', 'etheme_search_all_sku_query');
function etheme_search_all_sku_query($query){
    // if ( is_search() && etheme_get_option('search_by_sku')) {
       add_filter('posts_join', 'etheme_search_post_join');
       add_filter('posts_where', 'etheme_search_post_excerpt');
    // }

}

function etheme_search_post_join($join = ''){

   global $wp_the_query, $wpdb;

   // default
   $prefix = 'wp_';
   if ( $wpdb->prefix ) {
       // current site prefix
       $prefix = $wpdb->prefix;
   } elseif ( $wpdb->base_prefix ) {
       // wp-config.php defined prefix
       $prefix = $wpdb->base_prefix;
   }

   // escape if not woocommerce searcg query
   if ( empty( $wp_the_query->query_vars['wc_query'] ) || empty( $wp_the_query->query_vars['s'] ) )
       return $join;

   $join .= 'INNER JOIN '.$prefix.'postmeta AS jcmt1 ON ('.$prefix.'posts.ID = jcmt1.post_id)';

   return $join;
}


if ( ! function_exists( 'etheme_search_post_excerpt' ) ) :

    function etheme_search_post_excerpt($where = ''){

        global $wp_the_query;
        global $wpdb;

        $prefix = 'wp_';
        if ( $wpdb->prefix ) {
           // current site prefix
           $prefix = $wpdb->prefix;
        } elseif ( $wpdb->base_prefix ) {
           // wp-config.php defined prefix
           $prefix = $wpdb->base_prefix;
        }

        // ! Filter by brands
        if ( isset( $_GET['filter_brand'] ) && ! empty($_GET['filter_brand']) ) {

            $brands = explode(',', $_GET['filter_brand']);
            $ids    = array();

            foreach ($brands as $key => $value) {
                $term = get_term_by('slug', $value, 'brand');
                if ( ! isset( $term->term_taxonomy_id ) || empty( $term->term_taxonomy_id ) ) {
                } else {
                    $ids[] = $term->term_taxonomy_id;
                }
            }

            if ( ! implode( ',', $ids ) ) {
                $ids = 0;
            } else {
                $ids = implode( ',', $ids );
            }

            $where .= " AND " . $prefix . "posts.ID IN ( SELECT " . $prefix . "term_relationships.object_id  FROM " . $prefix . "term_relationships WHERE term_taxonomy_id  IN (" . $ids . ") )";

            return $where;
        }

        // ! Search by sku
        if ( is_search() && etheme_get_option('search_by_sku_et-desktop')) {
            // escape if not woocommerce search query
            if ( empty( $wp_the_query->query_vars['wc_query'] ) || empty( $wp_the_query->query_vars['s'] ) ) return $where;

            $s = $wp_the_query->query_vars['s'];



            // ! Fix for wpml
            if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ){
                $where .= " OR ( " . $prefix . "posts.ID IN ( SELECT " . $prefix . "postmeta.post_id  FROM " . $prefix . "postmeta WHERE meta_key = '_sku' AND meta_value LIKE '%$s%' )
                    AND " . $prefix . "posts.ID IN (
                        SELECT ID FROM {$wpdb->prefix}posts 
                        LEFT JOIN {$wpdb->prefix}icl_translations ON {$wpdb->prefix}icl_translations.element_id = {$wpdb->prefix}posts.ID
                        WHERE post_type = 'product'
                        AND post_status = 'publish'
                        AND {$wpdb->prefix}icl_translations.language_code = '". ICL_LANGUAGE_CODE ."'
                    ) )";
            } else {
                $where .= " OR " . $prefix . "posts.ID IN ( SELECT " . $prefix . "postmeta.post_id  FROM " . $prefix . "postmeta WHERE meta_key = '_sku' AND meta_value LIKE '%$s%' )";
            }
        }
       return $where;
    }
endif;

// **********************************************************************// 
// ! AJAX search
// **********************************************************************// 
add_action( 'wp_ajax_et_ajax_search', 'etheme_ajax_search_action');
add_action( 'wp_ajax_nopriv_et_ajax_search', 'etheme_ajax_search_action');
if(!function_exists('etheme_ajax_search_action')) {
    function etheme_ajax_search_action() {
        global $woocommerce, $wpdb, $wp_query, $product;
        $result = array(
            'status' => 'error',
            'html' => ''
        );

        
        if ( ! isset( $_REQUEST['cat'] ) ) {
            $_REQUEST['cat'] = 0;
        }

        if( isset( $_REQUEST['s'] ) && $_REQUEST['s'] != '') {

            $s = sanitize_text_field( $_REQUEST['s'] );
            $i = 0;
            $to = 8;

            // ! Get sku results
            if ( etheme_get_option('search_by_sku') ) {
                $sku = $_REQUEST['s'];

                // ! Should the query do some extra joins for WPML Enabled sites...
                $wmplEnabled = false;

                if(defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') && class_exists("woocommerce_wpml")){
                    $wmplEnabled = true;
                    // ! What language should we search for...
                    $languageCode = ICL_LANGUAGE_CODE;
                }

                // ! Search for the sku of a variation and return the parent.
                $variationsSql = "
                  SELECT p.post_parent as post_id FROM $wpdb->posts as p
                  join $wpdb->postmeta pm
                  on p.ID = pm.post_id
                  and pm.meta_key='_sku'
                  and pm.meta_value LIKE '%$sku%'
                  ";

                // ! IF WPML Plugin is enabled join and get correct language product.
                if( $wmplEnabled ) {
                    $variationsSql .=
                        "join ".$wpdb->prefix."icl_translations t on
                         t.element_id = p.post_parent
                         and t.element_type = 'post_product'
                         and t.language_code = '$languageCode'";
                    ;
                }

                $variationsSql .= "
                      where 1
                      AND p.post_parent <> 0
                      and p.post_status = 'publish'
                      group by p.post_parent
                  ";
                $variations = $wpdb->get_results($variationsSql);


                $regularProductsSql =
                    "SELECT p.ID as post_id FROM $wpdb->posts as p
                        join $wpdb->postmeta pm
                        on p.ID = pm.post_id
                        and  pm.meta_key='_sku' 
                        AND pm.meta_value LIKE '%$sku%'
                        AND post_title NOT LIKE '%$sku%'
                    ";
                // ! IF WPML Plugin is enabled join and get correct language product.
                if($wmplEnabled) {
                    $regularProductsSql .=
                        "join ".$wpdb->prefix."icl_translations t on
                         t.element_id = p.ID
                         and t.element_type = 'post_product'
                         and t.language_code = '$languageCode'";
                }
                $regularProductsSql .=
                    "where 1
                    and (p.post_parent = 0 or p.post_parent is null)
                    and p.post_status = 'publish'
                    group by p.ID";
                $regular_products = $wpdb->get_results($regularProductsSql);
            }

            // ! Get title/excerpt results
            // $title_q = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%$s%' AND post_type = 'product'";
            $excerpt_q = "SELECT ID FROM $wpdb->posts WHERE post_excerpt LIKE '%$s%' AND post_title NOT LIKE '%$s%' AND post_type = 'product'";

            if ( ! $wmplEnabled ) {
                $title_q = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%$s%' AND post_type = 'product'";
            } else {
                $title_q = "
                    SELECT ID FROM $wpdb->posts
                    JOIN {$wpdb->prefix}icl_translations ON 
                    ($wpdb->posts.ID = {$wpdb->prefix}icl_translations.element_id)
                    AND {$wpdb->prefix}icl_translations.language_code = '$languageCode'
                    WHERE post_title LIKE '%$s%' AND post_type = 'product'
                ";
            }

            $title_q = $wpdb->get_results( $title_q );
            $excerpt_q = $wpdb->get_results( $excerpt_q );

            $title_q = array_reverse( $title_q );
            $excerpt_q = array_reverse( $excerpt_q );

            $products = array_merge( $title_q, $excerpt_q );

            $result['html'] .= '<div class="product-ajax-list results-ajax-list"></ul>';

            if ( ! empty( $products ) || ! empty( $regular_products ) || ! empty( $variations ) ) {
                $result['status'] = 'success';
                $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Products found', 'xstore') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=product&product_cat=' . $_REQUEST['cat'] . '">' . esc_html__('View all', 'xstore' ) . '</a></h3>';
            }

            if ( ! empty( $products ) && count( $products ) > 0 ) {
                $result['html'] .= '<ul>';
                foreach ( $products as $post ) {
                    if ( $i >= $to )  break;

                    setup_postdata( $post );
                    $product = wc_get_product( $post->ID );

                    if ( ! $product->is_visible() ) continue;

                    if ( $_REQUEST['cat'] ) {
                        $terms = wp_get_post_terms( $post->ID, 'product_cat' );
                        $categories = array();
                        foreach ( $terms as $term ){
                            $categories[] = $term->slug;
                        } 

                        if ( ! in_array( $_REQUEST['cat'], $categories ) ) continue;
                    }
                    
                    $result['html'] .= '<li>';
                        $result['html'] .= '<a href="'.get_the_permalink($post->ID).'" title="'.get_the_title($post->ID).'" class="product-list-image ajax-list-image">';
                            $result['html'] .= ( get_the_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID ) : wc_placeholder_img( $size = 'shop_thumbnail' );
                        $result['html'] .='</a>';
                        $result['html'] .= '<div class="ajax-item-info">';
                        $result['html'] .= '<p class="product-title ajax-item-title"><a href="'.get_the_permalink($post->ID).'" title="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></p>';
                        $result['html'] .= '<div class="price">'.$product->get_price_html().'</div>';
                        $result['html'] .= '</div>';
                    $result['html'] .= '</li>';

                    $i++;
                }
                $result['html'] .= '</ul>';
            }

            
            if ( ( ! empty( $regular_products ) || ! empty( $variations ) ) && etheme_get_option('search_by_sku') ) {

                $products = array_merge( $variations, $regular_products );

                $arrayID = array();
                foreach ( $products as $object ) {
                    array_push( $arrayID, $object->post_id );
                }
                $arrayID = array_unique( $arrayID );

                $newObjects = array();
                foreach ( $arrayID as $id ) {
                    foreach ( $products as $object ) {
                        if ( $object->post_id == $id ) {
                            array_push($newObjects, $object);
                            break;
                        }
                    }
                }

                foreach ( $newObjects as $post ) {
                    if ( $i >= $to )  break;

                    setup_postdata( $post );
                   // $_product = wc_get_product( get_the_ID() );

                    global $woocommerce;
                    $_product = new WC_Product( $post->post_id );
                    $_id = $_product->get_id();

                    $result['html'] .= '<li p-id="' . $post->ID . '">';
                        $result['html'] .= '<a href="'.get_the_permalink( $_id ).'" title="'.get_the_title( $_id ).'" class="product-list-image ajax-list-image">';
                            $result['html'] .= ( get_the_post_thumbnail( $_id ) ) ? get_the_post_thumbnail( $_id ) : wc_placeholder_img( $size = 'shop_thumbnail' );
                        $result['html'] .='</a>';
                        $result['html'] .= '<div class="ajax-item-info">';
                        $result['html'] .= '<p class="product-title ajax-item-title"><a href="'.get_the_permalink( $_id ).'" title="'.get_the_title( $_id ).'">'.get_the_title($_id).'</a></p>';
                        $result['html'] .= '<div class="price">'.$_product->get_price_html().'</div>';
                        $result['html'] .= '</div>';
                    $result['html'] .= '</li>';

                    $i++;
                }
            }

            wp_reset_postdata();
            $result['html'] .= '</ul></div>';

            // ! Get posts results
            $args = array(
                's'                   => $s,
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $to,
            );

            if ( etheme_get_option( 'search_ajax_page' ) ) {
                $args['post_type'] = array( 'post', 'page' );
            }

            if ( $_REQUEST['cat'] && ! etheme_get_option( 'search_ajax_product' ) ) $args['category_name'] = $_REQUEST['cat'];

            $posts = ( etheme_get_option( 'search_ajax_post' ) ) ? get_posts( $args ) : '' ;

            if ( !empty( $posts ) ) {
                ob_start();
                foreach ( $posts as $post ) {
                    ?>
                        <li>
                            <a href="<?php echo get_the_permalink( $post->ID ); ?>" class="post-list-image ajax-list-image"><?php echo get_the_post_thumbnail( $post->ID );?></a>
                            <div class="ajax-item-info">
                                <p class="post-title ajax-item-title"><a href="<?php echo get_the_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ) ?></a></p>
                                <span class="post-date"><?php echo get_the_date( '',$post->ID ); ?></span>
                            </div>
                        </li>
  
                    <?php
                }

                $result['status'] = 'success';
                $result['html'] .= '<div class="posts-ajax-list results-ajax-list">';
                $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Posts found', 'xstore') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=post">' . esc_html__('View all', 'xstore' ) . '</a></h3>';
                $result['html'] .= '<ul>' . ob_get_clean() . '</ul>';
                $result['html'] .= '</div>';
            }
            wp_reset_postdata();

            if ( empty( $products ) && empty( $posts ) && empty( $regular_products ) && empty( $variations ) ) {
                $result['status'] = 'error';
                $result['html'] = '<div class="empty-category-block">';
                $result['html'] .= '<h3>' . esc_html__( 'No results were found', 'xstore' ) . '</h3>';
                $result['html'] .= '<p class="not-found-info">';
                $result['html'] .= esc_html__('No items matched your search', 'xstore') . ' <strong>' . $s . '.</strong><br/>';
                $result['html'] .= '' . esc_html__( 'Check your spelling or search again with less specific terms.', 'xstore' );
                $result['html'] .= '</p>';
                $result['html'] .= '</div>';
            }

            wp_reset_postdata();

        }

        echo json_encode($result);
        die();
    }
}


// **********************************************************************// 
// ! Add page to search results
// **********************************************************************// 
// add_filter( 'pre_get_posts', 'etheme_search_filter' );
function etheme_search_filter( $query ) {
    if ( ! is_admin() ) {
        if ( etheme_get_option( 'search_ajax_post' ) && etheme_get_option( 'search_ajax_page' ) && $query->is_search && $query->query['post_type'] == 'post') {
            $query->set( 'post_type', array( 'post', 'page' ) );
        }
        return $query;
    }
}

// **********************************************************************// 
// ! Footer Type
// **********************************************************************// 
if(!function_exists('etheme_footer_type')) {
    function etheme_footer_type() {
        return etheme_get_option('footer_type');
    }

    add_filter('custom_footer_filter', 'etheme_footer_type',10);
}

// **********************************************************************// 
// ! Footer widgets class
// **********************************************************************// 
if(!function_exists('etheme_get_footer_widget_class')) {
    function etheme_get_footer_widget_class($n) {
        $class = 'col-md-';
        switch ($n) {
            case 1:
                $class .= 12;
                break;
            case 2:
                $class .= 6;
                break;
            case 3:
                $class .= 4;
                break;
            case 4:
                $class .= 3;
                break;

            default:
                $class .= 3;
                break;
        }
        if( $n == 4 ) $class .= ' col-sm-6';
        return $class;
    }
}

// **********************************************************************//
// ! Implement Opauth Facebook login
// **********************************************************************//
if( ! function_exists('etheme_login_facebook') ) {
    add_action('init', 'etheme_login_facebook', 20);
    function etheme_login_facebook() {
        if( ! class_exists( 'WooCommerce' ) || ( empty( $_GET['facebook'] ) && empty( $_GET['code'] ) ) ) return;

        $page = get_option('etheme_fb_login');
        $account_url    = wc_get_page_permalink($page);
        $security_salt  = apply_filters('et_facebook_salt', '2NlBUibcszrVtNmDnxqDbwCOpLWq91eatIz6O1O');
        $app_id         = etheme_get_option('facebook_app_id');
        $app_secret     = etheme_get_option('facebook_app_secret');

        if( empty( $app_secret ) || empty( $app_id ) ) return;

        $config = array(
            'security_salt' => $security_salt,
            'host' => $account_url,
            'path' => '/',
            'callback_url' => $account_url,
            'callback_transport' => 'get',
            'strategy_dir' => ETHEME_CODE_3D . 'vendor/opauth/',
            'Strategy' => array(
                'Facebook' => array(
                    'app_id' => $app_id,
                    'app_secret' => $app_secret,
                    'scope' => 'email'
                ),
            )
        );

        if( empty( $_GET['code'] ) ) {
            $config['request_uri'] = '/facebook/';
        } else {
            $config['request_uri'] = '/facebook/int_callback?code=' . $_GET['code'];
        }

        new Opauth( $config );
    }
}

if( ! function_exists('etheme_process_facebook_callback') ) {
    add_action('init', 'etheme_process_facebook_callback', 30);
    function etheme_process_facebook_callback() {
        if( empty( $_GET['opauth'] ) ) return;

        $opauth = unserialize(etheme_decoding($_GET['opauth']));

        if( empty( $opauth['auth']['info'] ) ) {
            wc_add_notice( esc_html__( 'Can\'t login with Facebook. Please, try again later.', 'xstore' ), 'error' );
            return;
        }

        $info = $opauth['auth']['info'];

        if( empty( $info['email'] ) ) {
            wc_add_notice( esc_html__( 'Facebook doesn\'t provide your email. Try to register manually.', 'xstore' ), 'error' );
            return;
        }

        add_filter('pre_option_woocommerce_registration_generate_username', 'etheme_generate_username_option', 10);

        $password = wp_generate_password();
        $customer = wc_create_new_customer( $info['email'], '', $password);

        $user = get_user_by('email', $info['email']);

        if( is_wp_error( $customer ) ) {
            if( isset( $customer->errors['registration-error-email-exists'] ) ) {
                wc_set_customer_auth_cookie( $user->ID );
            }
        } else {
            wc_set_customer_auth_cookie( $customer );
        }

        wc_add_notice( sprintf( '%s<strong>%s</strong>', esc_html__( 'You are now logged in as ', 'xstore' ), $user->display_name ) );

        remove_filter('pre_option_woocommerce_registration_generate_username', 'etheme_generate_username_option', 10);
    }
}

if( ! function_exists('etheme_generate_username_option') ) {
    function etheme_generate_username_option() {
        return 'yes';
    }
}

// **********************************************************************//
// ! Facebook login button
// **********************************************************************//
if( ! function_exists('etheme_faceboook_login_button') ) {
    add_action( 'woocommerce_before_customer_login_form', function() { etheme_faceboook_login_button(); });
    function etheme_faceboook_login_button($echo = true) {
        if( ! class_exists( 'WooCommerce' ) ) return;
        $app_id         = etheme_get_option('facebook_app_id');
        $app_secret     = etheme_get_option('facebook_app_secret');

        if( empty( $app_secret ) || empty( $app_id ) ) return;

        $page = ( is_checkout() ) ? 'checkout' : 'myaccount';
        update_option( 'etheme_fb_login', $page );

        $facebook_login_url = add_query_arg( 'facebook', 'login', wc_get_page_permalink( $page ) );

        ob_start();
        ?>
            <div class="et-facebook-login-wrapper">
                <a href="<?php echo esc_url( $facebook_login_url ); ?>" class="et-facebook-login-button">
                    <i class="et-icon et-facebook"></i>
                    <?php esc_html_e('Login / Register with Facebook', 'xstore') ?>
                </a>
            </div>
        <?php

        if ( $echo ) {
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}


// **********************************************************************//
// ! Get activated theme
// **********************************************************************//
if( ! function_exists( 'etheme_activated_theme' ) ) {
    function etheme_activated_theme() {
        $activated_data = get_option( 'etheme_activated_data' );

        // auto update option for old users
        if ( isset( $activated_data['purchase'] ) && $activated_data['purchase'] && get_option( 'envato_purchase_code_15780546', 'undefined' ) === 'undefined' ) {
            update_option( 'envato_purchase_code_15780546', $activated_data['purchase'] );
            
        }
        if( isset( $activated_data['purchase'] ) && $activated_data['purchase'] && $activated_data['purchase'] != get_option( 'envato_purchase_code_15780546', false )){
            return false;
        }

        $theme = ( isset( $activated_data['theme'] ) && ! empty( $activated_data['theme'] ) ) ? $activated_data['theme'] : false ;
        return $theme;
    }

}

// **********************************************************************//
// ! Is theme activatd
// **********************************************************************//
if(!function_exists('etheme_is_activated')) {
    function etheme_is_activated() {
        if ( etheme_activated_theme() != ETHEME_PREFIX ) return false;
        if ( ! get_option( 'etheme_is_activated' ) ) update_option( 'etheme_is_activated', true );
        return get_option( 'etheme_is_activated', false );
    }
}


// **********************************************************************// 
// ! http://codex.wordpress.org/Function_Reference/wp_nav_menu#How_to_add_a_parent_class_for_menu_item
// **********************************************************************// 
add_filter( 'wp_nav_menu_objects', 'etheme_add_menu_parent_class');
function etheme_add_menu_parent_class( $items ) {
    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-item';
        }
    }
    return $items;
}

// **********************************************************************// 
// ! Change WP coockie notice position
// **********************************************************************//
if( class_exists('Cookie_Notice') ) {
    remove_action( 'wp_footer', array( $cookie_notice, 'add_cookie_notice' ), 1000 );
    add_action( 'et_after_body', array( $cookie_notice, 'add_cookie_notice' ), 1000 );
}

// **********************************************************************// 
// ! Twitter API functions
// **********************************************************************// 
if(!function_exists('etheme_capture_tweets')) {
    function etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count) {

        $connection = etheme_connection_with_access_token($consumer_key,$consumer_secret,$user_token, $user_secret);
        $params = array(
            'screen_name' => $user,
            'count' => $count
        );

        $content = $connection->get("statuses/user_timeline",$params);

        return json_encode($content);
    }
}

if(!function_exists('etheme_connection_with_access_token')) {
    function etheme_connection_with_access_token($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret) {
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
        return $connection;
    }
}


if(!function_exists('etheme_tweet_linkify')) {
    function etheme_tweet_linkify($tweet) {
        $tweet = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet);
        $tweet = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet);
        $tweet = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet);
        $tweet = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet);
        return $tweet;
    }
}
if(!function_exists('etheme_store_tweets')) {
    function etheme_store_tweets($file, $tweets) {
        ob_start(); // turn on the output buffering 
        $fo = etheme_fo($file, 'w'); // opens for writing only or will create if it's not there
        if (!$fo) return etheme_print_tweet_error(error_get_last());
        $fr = etheme_fw($fo, $tweets); // writes to the file what was grabbed from the previous function
        if (!$fr) return etheme_print_tweet_error(error_get_last());
        etheme_fc($fo); // closes
        ob_end_flush(); // finishes and flushes the output buffer; 
    }
}

if(!function_exists('etheme_pick_tweets')) {
    function etheme_pick_tweets($file) {
        ob_start(); // turn on the output buffering 
        $fo = etheme_fo($file, 'r'); // opens for reading only 
        if (!$fo) return etheme_print_tweet_error(error_get_last());
        $fr = etheme_fr($fo, filesize($file));
        if (!$fr) return etheme_print_tweet_error(error_get_last());
        etheme_fc($fo);
        ob_end_flush();
        return $fr;
    }
}

if(!function_exists('etheme_print_tweet_error')) {
    function etheme_print_tweet_error($errorsArray) {
        $html = '';
        if( count($errorsArray) > 0 ){
            foreach ($errorsArray as $key => $error) {
                $html .= '<p class="warning">Error: ' . $error['message']  . '</p>';
            }
        }
        return $html;
    }
}

if(!function_exists('etheme_twitter_cache_enabled')) {
    function etheme_twitter_cache_enabled(){
        return apply_filters('etheme_twitter_cache_enabled', true);
    }
}

if(!function_exists('etheme_get_tweets')) {
    function etheme_get_tweets($consumer_key, $consumer_secret, $user_token, $user_secret, $user, $count, $cachetime=50, $key = 'widget') {
        if(etheme_twitter_cache_enabled()){
            //setting the location to cache file
            $cachefile = ETHEME_CODE_DIR . 'cache/cache-twitter-' . $key . '.json';

            // the file exitsts but is outdated, update the cache file
            if (file_exists($cachefile) && ( time() - $cachetime > filemtime($cachefile)) && filesize($cachefile) > 0) {
                //capturing fresh tweets
                $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
                $tweets_decoded = json_decode($tweets, true);
                //if get error while loading fresh tweets - load outdated file
                if(isset($tweets_decoded['errors'])) {
                    $tweets = etheme_pick_tweets($cachefile);
                }
                //else store fresh tweets to cache
                else
                    etheme_store_tweets($cachefile, $tweets);
            }
            //file doesn't exist or is empty, create new cache file
            elseif (!file_exists($cachefile) || filesize($cachefile) == 0) {
                $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
                $tweets_decoded = json_decode($tweets, true);
                //if request fails, and there is no old cache file - print error
                if(isset($tweets_decoded['errors'])) {
                    echo etheme_print_tweet_error($tweets_decoded['errors']);
                    return array();
                }
                //make new cache file with request results
                else
                    etheme_store_tweets($cachefile, $tweets);
            }
            //file exists and is fresh
            //load the cache file
            else {
               $tweets = etheme_pick_tweets($cachefile);
            }
        } else{
           $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
        }

        $tweets = json_decode($tweets, true);

        if(isset($tweets['errors'])) {
            echo etheme_print_tweet_error($tweets_decoded['errors']);
            return array();
        }

        return $tweets;
    }
}

// **********************************************************************// 
// ! Related posts 
// **********************************************************************// 
if(!function_exists('etheme_get_related_posts')) {
    function etheme_get_related_posts($postId = false, $limit = 5){
        global $post;
        if(!$postId) {
            $postId = $post->ID;
        }

        $query_type = etheme_get_option('related_query');
        $atts = array(
            'title' => esc_html__( 'Related posts', 'xstore' ),
            'echo' => true,
            'large' => 3,
            'notebook' => 3,
            'tablet_land' => 2,
            'tablet_portrait' => 2,
            'mobile' => 1,
            'size' => etheme_get_option('blog_related_images_size'),
            'autoheight' => false,
            'slider_autoplay' => false,
            'slider_speed' => false,
        );
        $args = array();
        if($query_type == 'tags') {
            $tags = get_the_tags($postId);
            if ($tags) {
                $tags_ids = array();
                foreach($tags as $tag) $tags_ids[] = $tag->term_id;

                $args = array(
                    'tag__in' => $tags_ids,
                    'post__not_in' => array($postId),
                    'showposts'=>$limit, // Number of related posts that will be shown.
                );
            }
        } else {
            $categories = get_the_category($postId);
            if ($categories) {
                $category_ids = array();
                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                $args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($postId),
                    'showposts'=>$limit, // Number of related posts that will be shown.
                );
            }
        }
        etheme_slider( $args, 'post' , $atts );
    }
}



if(!function_exists('etheme_get_menus_options')) {
    function etheme_get_menus_options() {
        $menus = array();
        $menus = array(""=>"Default");
        $nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        foreach ( $nav_terms as $obj ) {
            $menus[$obj->slug] = $obj->name;
        }
        return $menus;
    }
}


// **********************************************************************// 
// ! Get image by size function
// **********************************************************************// 
if( ! function_exists('etheme_get_image') ) {
    function etheme_get_image($attach_id, $size, $location = '') {

        $type   = '';
        if ( defined('ET_CORE_VERSION') ) {
           $type   = Kirki::get_option( 'images_loading_type_et-desktop' );
        }

        $class = ( $location == 'slider' && $type !='default' && $type !='lqip' ) ? 'swiper-lazy' : '';
        
        
        if ($type == 'lqip') {
            if ( $size == 'woocommerce_thumbnail' ) {
                $placeholder = wp_get_attachment_image_src( $attach_id, 'etheme-woocommerce-nimi' );
            } else {
                $placeholder = wp_get_attachment_image_src( $attach_id, 'etheme-nimi' );

            }
            $class .= ' lazyload lazyload-lqip';
        } elseif($type == 'lazy'){
            $class .= ' lazyload lazyload-simple';
        }

        if (function_exists('wpb_getImageBySize')) {
            $image = wpb_getImageBySize( array(
                    'attach_id' => $attach_id,
                    'thumb_size' => $size,
                    'class' => $class
                ) );
            $image = $image['thumbnail'];
        } else {
            $image = wp_get_attachment_image( $attach_id, $size, false, array('class' => $class) );
        }

        // $class .='aadssada';

        if ($type == 'lqip') {
            $new_attr = 'src="' . $placeholder[0] . '" data-src';
            $image = str_replace( 'src', $new_attr, $image );
        
        }

        if ( $type != 'default' ) {
            if ( $location == 'slider' ) {

                if ($type != 'lqip') {
                    $image = str_replace( 'src', 'data-src', $image );
                }
                // $image = str_replace( 'src', 'data-src', $image );
                //$image = str_replace( 'srcset', 'data-srcset', $image );
                $image = str_replace( 'sizes', 'data-sizes', $image );
            }

        }

        


        return $image;
    }
}

if ( ! function_exists( 'etheme_stock_taxonomy' ) ) :
function etheme_stock_taxonomy( $term_id = false, $taxonomy = 'product_cat', $category = false, $stock = true ) {
    if ( $term_id === false ) return false;
    $args = array(
        'post_type'         => 'product',
        'posts_per_page'    => -1,
        'tax_query'         => array( 
            array(
                'taxonomy'  => $taxonomy,
                'field'     => 'term_id',
                'terms'     => $term_id
            ),
        ),
    );

    if ( $category ) {
        $args['tax_query'][] = array(
            'taxonomy'         => 'product_cat',
            'field'            => 'slug',
            'terms'            => $category,
            'include_children' => true,
            'operator'         => 'IN'
        );
    }

    $cat_prods = get_posts( $args );
    $i = 0;

    foreach ( $cat_prods as $single_prod ) { 
        $product = wc_get_product( $single_prod->ID );

        if ( ! $stock ) {
            $i++;
        } elseif( $product->is_in_stock() === true ){
            $i++;
        }
    }

    return $i;
}
endif;

// **********************************************************************//
// ! Check file exists by url
// **********************************************************************//
if ( ! function_exists( 'etheme_custom_font_exists' ) ) :
    function etheme_custom_font_exists( $url ) {
        $upload_dir = wp_upload_dir();
        $upload_dir = $upload_dir['basedir'] . '/custom-fonts';
        $url = explode( '/custom-fonts', $url );

        return file_exists( $upload_dir . $url[1] );
    }
endif;

// **********************************************************************//
// ! Force name sorting
// **********************************************************************//
if ( ! function_exists( 'et_force_name_sort' ) ) :
    function et_force_name_sort( $array, $order ){

        if ( is_wp_error( $array ) || count( $array ) <= 0 ) return;

        // ! Set values
        $to_sort = array();
        $sorted = array();

        // ! Set names array
        foreach ( $array as $key => $value ) {
            $to_sort[] = strtolower( $value->name );
        }

        // ! Sort names array
        sort( $to_sort );

        // ! Change order if need it
        if ( $order == 'DESC' ){
           $to_sort = array_reverse( $to_sort );
        }

        // ! Set new sorted array
        foreach ( $to_sort as $key => $value ) {
            foreach ( $array as $k => $v ) {
                if ( $value == strtolower( $v->name ) ) {
                    $sorted[] = $v;
                }
            }
        }
        return $sorted;
    }
endif;

function unicode_chars($source, $iconv_to = 'UTF-8') {
    $decodedStr = '';
    $pos = 0;
    $len = strlen ($source);
    while ($pos < $len) {
        $charAt = substr ($source, $pos, 1);
            $decodedStr .= $charAt;
            $pos++;
    }

    if ($iconv_to != "UTF-8") {
        $decodedStr = iconv("UTF-8", $iconv_to, $decodedStr);
    }
    
    return $decodedStr;
}

// For wpml test 
apply_filters( 'wpml_current_language', NULL );

// rewrite default bbp separator with theme icon and removed wrapped p

function et_bbp_breadcrumb_sep() {
    $args['sep'] = '<i class="et-icon et-right-arrow"></i>';
    $args['before'] = '<div class="bbp-breadcrumb">';
    $args['after'] = '</div>';
    return $args;
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'et_bbp_breadcrumb_sep' );

// **********************************************************************// 
// ! Masonry
// **********************************************************************/
if ( ! function_exists( 'etheme_masonry' ) ) :
function etheme_masonry(){
   $masonry = false;

    if ( etheme_get_option( 'global_masonry' ) ) {
        $masonry = true;
    } elseif ( class_exists( 'WooCommerce' ) && etheme_get_option( 'products_masonry' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
        $masonry = true;
    } elseif ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) && 'post' == get_post_type() && etheme_get_option( 'blog_masonry' ) ) {
        $masonry = true;
    } elseif ( ( etheme_get_option( 'portfolio_page') == get_the_id() || is_tax( 'portfolio_category' ) ) && etheme_get_option('portfolio_masonry') ) {
        $masonry = true;
    }
    return $masonry;
}
endif;

// **********************************************************************// 
// ! Add activation redirect
// **********************************************************************//
add_action( 'after_switch_theme', 'et_activation_redirect' );
if ( ! function_exists( 'et_activation_redirect' ) ) :
    function et_activation_redirect() {
        if ( isset($_GET['page']) && $_GET['page'] == '_options' ) {
            if ( !class_exists( 'Kirki' ) || !etheme_is_activated() ) {
                header( 'Location:' . admin_url( 'admin.php?page=et-panel-welcome' ) );
            }
            else {
                header( 'Location:' . wp_customize_url() );
            }
        }
    }
endif;

// **********************************************************************// 
// ! Add custom fonts to customizer typography
// **********************************************************************//
function et_kirki_custom_fonts( $standard_fonts ){
    $etheme_fonts = get_option( 'etheme-fonts', false );
    if ( ! is_array($etheme_fonts) || count( $etheme_fonts ) < 1 ) {
        return $standard_fonts;
    }
    $custom_fonts = array();

    foreach ( $etheme_fonts as $value ) {
        $custom_fonts[$value['name']] = array(
            'label' => $value['name'],
            'variant' => '400',
            'stack' => '"'.$value['name'].'"'
        );
    }

    $std_fonts = array(
            "Arial, Helvetica, sans-serif",
            "Courier, monospace",
            "Garamond, serif",
            "Georgia, serif",
            "Impact, Charcoal, sans-serif",
            "Tahoma,Geneva, sans-serif",
            "Verdana, Geneva, sans-serif",
        );

    foreach ( $std_fonts as $value) {
        $custom_fonts[$value] = array(
            'label' => $value,
            'variant' => '400',
            'stack' => $value
        );
    }

    return array_merge_recursive( $custom_fonts, $standard_fonts );
}
add_filter( 'kirki/fonts/standard_fonts', 'et_kirki_custom_fonts', 20 );

// **********************************************************************// 
// ! Hex to rgba
// **********************************************************************//
if ( ! function_exists( 'et_hex_to_rgba' ) ) {
    function et_hex_to_rgba( $color, $opacity = false ) {

        $default = 'rgb(0,0,0)';

        if ( empty( $color ) ) return $default; 
        if ( $color[0] == '#' ) $color = substr( $color, 1 );

        if ( strlen( $color ) == 6 ) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        $rgb =  array_map( 'hexdec', $hex );

        if( $opacity !== false ){
            if( abs( $opacity ) > 1 ) $opacity = 1.0;
            $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode( ",", $rgb ) . ')';
        }

        return $output;
    }
} 

if( ! function_exists( 'etheme_blog_header' ) ){
    function etheme_blog_header() {
        global $wp_query;
        $cat = $wp_query->get_queried_object();

        if( etheme_get_option( 'blog_page_banner' ) != '' ){
            echo '<div class="category-description">';
            echo do_shortcode( etheme_get_option( 'blog_page_banner' ) );
            echo '</div>';
        } else {;
            return;
        }
    }
}

add_action( 'wp_ajax_et_ajax_blog_element', 'et_ajax_blog_element');
add_action( 'wp_ajax_nopriv_et_ajax_blog_element', 'et_ajax_blog_element');
if ( ! function_exists( 'et_ajax_blog_element' ) ) {
    function et_ajax_blog_element(){

        $atts = '';
        $args = ( isset( $_POST['args'] ) ) ? $_POST['args'] : array() ;
        $args['ajax'] = false;
        foreach ( $args as $key => $value ) {
            // ! Do it because js change data type
            if ( $value === 'false' ) $value = false;

            $atts .= $key . '="' . $value . '" ';
        }
        echo do_shortcode( '[' . $_POST[ 'element' ] . ' ' . $atts . ' paged="' . $_POST[ 'paged' ] . '" html_type="true" ]' );
        die();
    }
}


// **********************************************************************// 
// ! Ajax response for shortcodes/VC elements loading
// **********************************************************************//
add_action( 'wp_ajax_et_ajax_element', 'et_ajax_element');
add_action( 'wp_ajax_nopriv_et_ajax_element', 'et_ajax_element');
if ( ! function_exists( 'et_ajax_element' ) ) {
    function et_ajax_element(){
        if ( ! isset( $_POST[ 'element' ] ) ) die();

        $atts = '';
        $args = ( isset( $_POST['args'] ) ) ? $_POST['args'] : array() ;
        $args['ajax'] = false;

        foreach ( $args as $key => $value ) {
            // ! Do it because js change data type
            if ( $value === 'false' ) $value = false;

            $atts .= $key . '="' . $value . '" ';
        }

        add_filter('woocommerce_sale_flash', 'etheme_woocommerce_sale_flash', 20, 3);
        add_filter( 'woocommerce_available_variation', 'etheme_available_variation_gallery', 90, 3 );
        add_filter( 'sten_wc_archive_loop_available_variation', 'etheme_available_variation_gallery', 90, 3 );

        // this add variation gallery filters at loop start and remove it after loop end
        if ( !$_POST['archiveVariationGallery'] ) {
            add_filter( 'woocommerce_product_loop_start', 'remove_et_variation_gallery_filter' );
            add_filter( 'woocommerce_product_loop_end', 'add_et_variation_gallery_filter' );
        }

        add_filter('woocommerce_get_availability_class', 'etheme_wc_get_availability_class', 20, 2);

        if ( isset( $_POST[ 'content' ] ) && ! empty( $_POST[ 'content' ] ) ) {
            // ! Do it because js add backslash
            $content = stripslashes( $_POST[ 'content' ] );
            $content = do_shortcode( $content ) . '[/' . $_POST[ 'element' ] . ']';
        } else {
            $content = '';
        }
        echo do_shortcode( '[' . $_POST[ 'element' ] . ' ' . $atts . ' ]' . $content );
        die();
    }
}

// **********************************************************************// 
// ! Ajax holder for shortcodes/VC elements loading
// **********************************************************************//
if ( ! function_exists( 'et_ajax_element_holder' ) ) {
    function et_ajax_element_holder($element = false, $atts = array(), $extra = '', $content = false){
        if ( ! $element ) return;

        if ( $content ) {
            $content = '<span class="hidden et-element-content" type="text/template">' . $content . '</span>';
        }

        $output = '
            <div class="et-load-block lazy-loading et-ajax-element" extra="' . $extra . '" element="' . $element . '">
                ' . etheme_loader(false) . '
                <span class="hidden et-element-args" type="text/template">' . json_encode( $atts ) . '</span>
                ' . $content . '
            </div>
        ';
        return $output;
    }
}

// **********************************************************************// 
// Let's search for variations also in visual composer our elements 
// **********************************************************************//

function et_vc_include_field_search ( $search_string ) {

    $query = $search_string;
    $data = array();
    $args = array(
        's' => $query,
        'post_type' => 'any',
    );
    $args['vc_search_by_title_only'] = true;
    $args['numberposts'] = - 1;
    if ( 0 === strlen( $args['s'] ) ) {
        unset( $args['s'] );
    }
    add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
    $posts = get_posts( $args );
    if ( is_array( $posts ) && ! empty( $posts ) ) {
        foreach ( $posts as $post ) {
            if ( $post->post_type == 'product' ) {
                $title = $post->post_title;
                $data[] = array (
                    'value' => $post->ID,
                    'label' => $title,
                    'group' => $post->post_type,
                );
                $_product = wc_get_product($post->ID);
                if ( $_product->is_type('variable') ) {
                    $attributes = $_product->get_available_variations();
                    foreach ($attributes as $key) {
                        $variation_group = $key['attributes'];
                        $variation_attributes = '';
                        $_i = 0;
                        $delimiter = ' ';
                        foreach ($variation_group as $key2 => $value ) {
                            if ( $_i > 0 ) $delimiter = ', ';
                            $variation_attributes .= $delimiter . str_replace(array('attribute_', 'pa_'), '', $key2).':'.$value;
                            $_i++;
                        }
                        $data[] = array (
                            'value' => $key['variation_id'],
                            'label' => $title . ' ( ' . $variation_attributes . ' )',
                            'group' => 'product_variation'
                        );
                    }
                }
            }
            else {
                $data[] = array(
                    'value' => $post->ID,
                    'label' => $post->post_title,
                    'group' => $post->post_type,
                );
            }
        }
    }

    return $data;

}

function et_vc_include_field_render( $value ) {

    $val = $value['value'];

    $post_type = get_post_type( $val );

    if ( $post_type == 'product_variation' ) {
        $post = wc_get_product($val);
        $attributes = $post->get_attributes();
        $variation_attributes = '';
        $_i = 0;
        $delimiter = ' ';
        foreach ($attributes as $key => $value) {
            if ( $_i > 0 ) $delimiter = ', ';
            $variation_attributes .= $delimiter . str_replace(array('attribute_', 'pa_'), '', $key).':'.$value;
            $_i++;
        }
        return array (
            'value' => $post->get_ID(),
            'label' => $post->get_ID() . ' - ' . $post->get_title() . ' ( ' . $variation_attributes . ' )',
            'group' => $post->post_type
        );
    }
    else {

        $post = get_post( $val );

        return array (
            'value' => $post->ID,
            'label' => $post->ID . ' - ' . $post->post_title,
            'group' => $post->post_type,
        );

    }
}

// **********************************************************************// 
// ! Visibility of next/prev pruduct
// **********************************************************************//

if ( ! function_exists('et_visible_pruduct') ) :
    function et_visible_pruduct( $id, $valid ){
        $product = wc_get_product( $id );

        // updated for woocommerce v3.0
        $visibility = $product->get_catalog_visibility();
        $stock = $product->is_in_stock();

        if (  $visibility  != 'hidden' &&  $visibility  != 'search' && $stock ) {
            return get_post( $id );
        }

        $the_query = new WP_Query( array( 'post_type' => 'product', 'p' => $id ) );

        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $valid_post = ( $valid == 'next' ) ? get_adjacent_post( 1, '', 0, 'product_cat' ) : get_adjacent_post( 1, '', 1, 'product_cat' );
                if ( empty( $valid_post ) ) return;
                $next_post_id = $valid_post->ID;
                $visibility = wc_get_product( $next_post_id );
                $stock = $visibility->is_in_stock();
                $visibility = $visibility->get_catalog_visibility();

            }
            // Restore original Post Data
            wp_reset_postdata();
        }

        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $stock ) {
            return et_visible_pruduct( $next_post_id, $valid );
        }

        if ( $visibility == 'visible' || $visibility == 'catalog' && $stock ) {
            return $valid_post;
        } else {
            return et_visible_pruduct( $next_post_id, $valid );
        }
            
    }
endif;

// **********************************************************************// 
// ! Project links
// **********************************************************************//

if ( ! function_exists('etheme_project_links') ) :
    function etheme_project_links( $atts, $content = null ) {

        global $post;
        $is_product = false;

        if ( $post->post_type == 'product' ) {
            $is_product = true;

            $next_post = get_adjacent_post( 1, '', 0, 'product_cat' );
            $prev_post = get_adjacent_post( 1, '', 1, 'product_cat' );

            if ( ! empty( $next_post ) && $next_post->post_type == 'product' ) {
                $next_post = et_visible_pruduct( $next_post->ID, 'next' );
            }

            if ( ! empty( $prev_post ) && $prev_post->post_type == 'product' ) {
                $prev_post = et_visible_pruduct( $prev_post->ID, 'prev' );
            }

        } else {
            $next_post = get_next_post();
            $prev_post = get_previous_post();
        }
        ?>
           <div class="posts-navigation">
                <?php if(!empty($prev_post)) : 
                if ( function_exists('mb_strlen') ) {
                    $prev_symbols = (mb_strlen(get_the_title($prev_post->ID)) > 30) ? '...' : ''; 
                    $title = mb_substr(get_the_title($prev_post->ID),0,30) . $prev_symbols;
                } 
                else {
                    $prev_symbols = (strlen(get_the_title($prev_post->ID)) > 30) ? '...' : ''; 
                    $title = substr(get_the_title($prev_post->ID),0,30) . $prev_symbols;
                }?>
                    <div class="posts-nav-btn prev-post">
                        <div class="post-info">
                            <div class="post-details">
                                 <a href="<?php echo get_permalink($prev_post->ID); ?>" class="post-title">
                                    <?php echo esc_html($title); ?>
                                </a>
                                <?php if ( $is_product ) {
                                    $p = wc_get_product($prev_post);
                                        echo '<p class="price">'.$p->get_price_html().'</p>';
                                    } ?>
                            </div>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                <?php $img = get_the_post_thumbnail( $prev_post->ID, array(90, 90));
                                echo (!empty($img) ) ? $img : '<img src="'.ETHEME_BASE_URI.'images/placeholder.jpg">';  ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(!empty($next_post)) : 
                 if ( function_exists('mb_strlen') ) {
                    $next_symbols = (mb_strlen(get_the_title($next_post->ID)) > 30) ? '...' : ''; 
                    $title = mb_substr(get_the_title($next_post->ID),0,30) . $next_symbols;
                } 
                else {
                    $next_symbols = (strlen(get_the_title($next_post->ID)) > 30) ? '...' : ''; 
                    $title = substr(get_the_title($next_post->ID),0,30) . $next_symbols;
                    } ?>
                    <div class="posts-nav-btn next-post">
                            <div class="post-info">
                                <a href="<?php echo get_permalink($next_post->ID); ?>">
                                    <?php $img = get_the_post_thumbnail( $next_post->ID, array(90, 90));
                                    echo (!empty($img) ) ? $img : '<img src="'.ETHEME_BASE_URI.'images/placeholder.jpg">';  ?>
                                </a>
                                <div class="post-details">
                                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="post-title">   
                                        <?php echo esc_html($title); ?>
                                    </a>
                                     <?php if ( $is_product ) {
                                        $p = wc_get_product($next_post);
                                       echo '<p class="price">'.$p->get_price_html().'</p>';
                                    } ?>
                                </div>
                            </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php wp_reset_query();
    }
endif;

// **********************************************************************//
// ! Add custom link to menus
// **********************************************************************//

add_action( 'wp', 'etheme_add_links_to_menu' );

if( ! function_exists( 'etheme_add_links_to_menu' ) ) {
    function etheme_add_links_to_menu() {
        if ( get_query_var('etheme_header_builder', false ) ) return;
        $header_type = get_query_var( 'et_ht', 'xstore' );
        $location    = ( $header_type == 'double-menu' ) ? 'main-menu-right' : 'main-menu';
       
        if ( etheme_get_option( 'top_links' ) == 'menu' ) {
            etheme_menu_link( 'account', $location );
        }
        if ( etheme_get_option( 'search_form' ) == 'menu' && $header_type != 'center3' && $header_type != 'standard' ) {
            etheme_menu_link( 'search', $location );
        }
    }
}

if ( ! function_exists( 'etheme_menu_link' ) ) {
    function etheme_menu_link( $link, $menu = 'main-menu' ){
        $locations  = get_nav_menu_locations();

        if ( ! isset( $locations[$menu] ) ) return;

        $menu       = wp_get_nav_menu_object( $locations[ $menu ] );

        if ( !is_object($menu) ) return;
        $filter_for = 'wp_nav_menu_' . $menu->slug . '_items';

        if ( $link == 'account' ) {
            add_filter( $filter_for, function($items){ return $items .= etheme_sign_link( 'menu-item item-level-0', '', 'get' ); } );
        } elseif ( $link == 'search' ) {
            ob_start();
            etheme_search_form(array('class' => 'menu-item'));
            $html = ob_get_clean();
            add_filter( $filter_for, function($items) use ($html){ return $items .= $html; } );
        }
    }
}

add_action( 'etheme_header', 'etheme_header_content', 10 );

function etheme_header_content(){

    if ( get_query_var('etheme_header_builder', false ) ) return;

    $header_type = get_query_var('et_ht', 'xstore');
    get_template_part( 'headers/' . $header_type );

}

add_action( 'etheme_header_before_template_content', 'etheme_top_panel_content', 10 );

function etheme_top_panel_content(){

    if ( get_query_var('etheme_header_builder', false ) ) return;

    if ( is_active_sidebar('top-panel') && etheme_get_option('top_panel') && etheme_get_option('top_bar')): ?>
        <div class="top-panel-container">
            <div class="top-panel-inner">
                <div class="container">
                    <?php dynamic_sidebar( 'top-panel' ); ?>
                    <div class="close-panel"></div>
                </div>
            </div>
        </div>
    <?php endif;
}


add_action( 'etheme_header_before_template_content', 'etheme_mobile_menu_content', 20 );
function etheme_mobile_menu_content(){
    if ( get_query_var('etheme_header_builder', false ) ) return;
    $my_account_mobile = etheme_get_option('mobile_account');
    $pp_mobile = etheme_get_option('mobile_promo_popup');
    $mob_logo = etheme_get_option('mobile_menu_logo_switcher');
    $mob_menu_logo = etheme_get_option('mobile_menu_logo');
    ?>
    <div class="mobile-menu-wrapper">
        <div class="container">
            <div class="navbar-collapse">
                <div class="mobile-menu-header"><?php if ( $mob_logo ) { ?>
                        <div class="mobile-header-logo">
                        <?php if ( isset($mob_menu_logo['url']) && $mob_menu_logo['url'] != '' ) :
                            echo '<img src="'.$mob_menu_logo['url'].'" alt="'.( isset($mob_menu_logo['alt']) ? $mob_menu_logo['alt'] : 'mobile-logo' ).'">';
                            else :
                        etheme_logo(); 
                        endif; ?>
                        </div>
                <?php } ?><?php if(etheme_get_option('search_form')): ?>
                    <?php etheme_search_form( array(
                        'action' => 'default'
                    )); ?>
                <?php endif; ?></div>
                <div class="mobile-menu-inner">
                    <?php etheme_menu( 'mobile-menu', 'custom_nav_mobile' ); ?>
                    <?php etheme_top_links( array( 'short' => true ), $my_account_mobile, $pp_mobile ); ?>
                    <?php dynamic_sidebar('mobile-sidebar'); ?>
                </div>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
<?php }

// dokan compatibles
$dokan_compatibles_actions = array(
    'start_wrap' => array(
        'dokan_edit_product_wrap_before',
        'dokan_dashboard_wrap_before',
    ),
    'end_wrap' => array(
        'dokan_edit_product_wrap_after',
        'dokan_dashboard_wrap_after'
    ),
);

foreach ($dokan_compatibles_actions['start_wrap'] as $key => $value) {
    add_action($value, function(){ ?>
    <div class="container content-page sidebar-mobile-bottom">
        <div class="sidebar-position-without">
            <div class="row">
                <div class="content col-md-12">
    <?php });
}

foreach ($dokan_compatibles_actions['end_wrap'] as $key => $value) {
        add_action($value, function(){ ?>
                </div>
            </div>
        </div>
    </div>
    <?php });
}


function et_time_2_remove_header(){
    $today     = time();
    $event     = mktime( 0,0,0,3,14,2020 );
    return '<strong>' . round( ( $event - $today ) / 86400 ) . ' ' . esc_html__('days', 'xstore') . '</strong>';
}


// **********************************************************************// 
// ! Notice "Plugin version"
// **********************************************************************// 
add_action( 'admin_notices', 'etheme_required_core_notice', 50 );
add_action( 'wp_body_open', 'etheme_required_plugin_notice_frontend', 50 );

function etheme_required_core_notice(){
    $file = ABSPATH . 'wp-content/plugins/et-core-plugin/et-core-plugin.php';

    if ( ! file_exists($file) ) return;

    $plugin = get_plugin_data( $file, false, false );

    if ( version_compare( ETHEME_CORE_MIN_VERSION, $plugin['Version'], '>' ) ) {
        $video = '<a class="et-button et-button-active" href="https://www.youtube.com/watch?v=xMEoi3rKoHk" target="_blank" style="color: white!important; text-decoration: none"><span class="dashicons dashicons-video-alt3"></span> Video tutorial</a>';

        echo '
        <div class="et-message et-error">
            This theme version requires the following plugin <strong>XStore Core</strong> to be updated up to <strong>' . ETHEME_CORE_MIN_VERSION . ' version. </strong>You can install the updated version of XStore core plugin: <ul>
                <li>1) via <a href="'.admin_url('update-core.php').'">Dashboard</a> > Updates > click Check again button > update plugin</li>
                <li>2) via FTP using archive from <a href="https://www.8theme.com/downloads" target="_blank">Downloads</a></li>
                <li>3) via FTP using archive from the full theme package downloaded from <a href="https://themeforest.net/" target="_blank">ThemeForest</a></li>
                <li>4) via <a href="https://wordpress.org/plugins/easy-theme-and-plugin-upgrades/" target="_blank">Easy Theme and Plugin Upgrades</a> WordPress Plugin</li>
                <li>5) Don\'t Forget To Clear <strong style="color:#c62828;"> Cache! </strong></li>
                </ul>
                <br>
                ' . $video . '
                <br><br>
        </div>
    ';
    }
}

function etheme_required_plugin_notice_frontend(){
    if ( is_user_logged_in() && current_user_can('administrator') ) {

        if( !function_exists('get_plugin_data') ){
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        $file = ABSPATH . 'wp-content/plugins/et-core-plugin/et-core-plugin.php';

        if ( ! file_exists($file) ) return;

        $plugin = get_plugin_data( $file, false, false );

        if ( version_compare( ETHEME_CORE_MIN_VERSION, $plugin['Version'], '>' ) ) {
            $video = '<a class="et-button et-button-active" href="https://www.youtube.com/watch?v=xMEoi3rKoHk" target="_blank"> Video tutorial</a>';
            echo '
                </br>
                <div class="woocommerce-massege woocommerce-error error">
                    XStore theme requires the following plugin: <strong>Core plugin v.' . ETHEME_CORE_MIN_VERSION . '.</strong>
                    '.$video.'. This warning is visible for <strong>administrator only</strong>.
                </div>
            ';
        }
    }
}


// **********************************************************************// 
// ! add sizes for LQIP
// **********************************************************************//
$cropping = get_option( 'woocommerce_thumbnail_cropping', '1:1' );

if ( 'uncropped' === $cropping ) {
    add_image_size( 'etheme-woocommerce-nimi', 10, 10 );
} elseif ( 'custom' === $cropping ) {
    $width          = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '4' ) );
    $height         = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '3' ) );
    add_image_size( 'etheme-woocommerce-nimi', $width, $height );
} else {
    $cropping_split = explode( ':', $cropping );
    $width          = max( 1, current( $cropping_split ) );
    $height         = max( 1, end( $cropping_split ) );
    add_image_size( 'etheme-woocommerce-nimi', $width, $height );
}

add_image_size( 'etheme-nimi', 10, 10 );
add_action( 'wp', 'etheme_lazy_attachment' );

// **********************************************************************// 
// ! add LQIP
// **********************************************************************//
function etheme_lazy_attachment(){
    // Remove it after global lazy finish
    if ( ! is_admin() && defined('ET_CORE_VERSION') ) {

        // tweak for dokan img attributes with lazy load 
        add_filter( 'dokan_product_image_attributes', function( $attr ) {
            $attr['img'] = array_merge( $attr['img'], array(
                'data-src' => array(),
                'data-l-src' => array(),
                'data-sizes' => array(),
                'data-srcset' => array(),
                'srcset' => array(),
            ));
            return $attr;
        });

        add_filter( 'wp_get_attachment_image_attributes', 'etheme_lazy_attachment_attrs', 10, 3 );
    }
}


// **********************************************************************// 
// ! add LQIP attr
// **********************************************************************//
function etheme_lazy_attachment_attrs($attr, $attachment, $size){

    // Remove it after global lazy finish
    if ( strpos( $attr['class'], 'swiper-lazy' ) !== false || strpos( $attr['class'], 'lazyload' ) !== false ) {
        return $attr;
    }

    $type   = Kirki::get_option( 'images_loading_type_et-desktop' );
    $srcset = Kirki::get_option( 'images_srcset_type_et-desktop' );

    switch ($type) {
        case 'lqip':
            // Set LQIP
            if ( $size == 'woocommerce_thumbnail' ) {
                $placeholder = wp_get_attachment_image_src( $attachment->ID, 'etheme-woocommerce-nimi' );
            }
            else {
                $placeholder = wp_get_attachment_image_src( $attachment->ID, 'etheme-nimi' );
            }

            $placeholder = $placeholder[0];
            if ( strpos($attr['class'], 'attachment-shop_single') === false  ) {
                $attr['data-src']      = $attr['src'];
            }
            $attr['src']    = $placeholder;
            $attr['class'] .= ' lazyload lazyload-lqip';
            break;
        case 'lazy':
        // return $attr;
            $attr['class']        .= ' lazyload lazyload-simple';
            if ( isset( $attr['data-src']) ) {
                // only for single product image zoom
                $attr['data-l-src'] = $attr['src'];
            } else {
                $attr['data-src']  = $attr['src'];
            }
            unset( $attr['src'] );
            break;
        default:
            return $attr;
            break;
    }

    $attr['data-sizes']    = 'auto';

    // Set srcset
    if ( isset( $attr['srcset'] ) ) {
        $attr['data-srcset'] = $attr['srcset'];
            // $attr['srcset'] = $srcset;
        unset( $attr['srcset'] );
    }
    return $attr;
}


// **********************************************************************// 
// ! add action for etheme_prefooter
// **********************************************************************//
add_action( 'etheme_prefooter', 'etheme_prefooter_content', 10 );

function etheme_prefooter_content(){
    get_template_part( 'templates/footer/prefooter');

}


// **********************************************************************// 
// ! add actions for etheme_footer
// **********************************************************************//
add_action( 'etheme_footer', 'etheme_footer_content', 10 );

function etheme_footer_content(){
    get_template_part( 'templates/footer/footer');
}

add_action( 'etheme_footer', 'etheme_copyrights_content', 20 );
function etheme_copyrights_content(){
    get_template_part( 'templates/footer/copyrights');
}


// **********************************************************************// 
// ! Get query custom field
// **********************************************************************//
function etheme_get_query_custom_field($field){
    $page    = get_query_var('et_page-id');
    $page_id =  ( isset( $page['id'] ) ) ? $page['id'] : false;

    if ( $page_id ) {
        $field = etheme_get_custom_field($field, $page_id);
    }else{
        $field = false;
    }

    return $field;
}