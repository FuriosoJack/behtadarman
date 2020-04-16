<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Set Content Width
// **********************************************************************//  
if (!isset( $content_width )) $content_width = 1170;

// **********************************************************************// 
// ! Include CSS and JS
// **********************************************************************// 
if(!function_exists('etheme_enqueue_scripts')) {
    function etheme_enqueue_scripts() {
        if ( !is_admin() ) {

            $theme = wp_get_theme();

            $etheme_scripts = array('jquery');

            if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );

            if ( etheme_get_option( 'et_optimize_js' ) ) wp_enqueue_script('etheme_optimize', get_template_directory_uri().'/js/etheme.optimize.min.js', array(),false,true);

            wp_enqueue_script('et_imagesLoaded', get_template_directory_uri().'/js/imagesLoaded.js', array(),$theme->version,true);

            if ( etheme_masonry() ) wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/isotope.js', array(),$theme->version,true);

            //wp_enqueue_script('et_plugins', get_template_directory_uri().'/js/plugins.min.js',array(),false,true);

            if ( class_exists('WooCommerce') && is_product()) {
                wp_enqueue_script('photoswipe_optimize', get_template_directory_uri().'/js/photoswipe-optimize.min.js',array(),$theme->version,true);
            }

            $single_template = get_query_var( 'et_post-template', 'default' );
            
            if ( in_array($single_template, array('large', 'large2')) && has_post_thumbnail() && is_singular(array('post', 'wpsl_stores')) ) {
                wp_enqueue_script('backstretch_single', get_template_directory_uri().'/js/jquery.backstretch.min.js',array(),$theme->version,true);
            }

            if ( get_query_var('etheme_single_product_variation_gallery', false) ) {
                $etheme_scripts[] = 'wp-util';
            }

            wp_enqueue_script('etheme', get_template_directory_uri().'/js/etheme.min.js', $etheme_scripts, $theme->version, true);

            if ( class_exists('Woocommerce') && is_product() ) {
                $product_id = get_the_ID();
                $slider_vertical = ( etheme_get_option('thumbs_slider_vertical') || etheme_get_custom_field('slider_direction', $product_id) == 'vertical') || ( get_query_var('etheme_single_product_builder') && etheme_get_option('product_gallery_type_et-desktop') == 'thumbnails_left' );
                if ( $slider_vertical ) {
                    wp_enqueue_script('stick', get_template_directory_uri().'/js/slick.min.js', array(),$theme->version);
                }
            }

            $etConf = array();
            $cartUrl = '#';

            if (class_exists('WooCommerce')) {
                $etConf['checkoutUrl'] = esc_url( wc_get_checkout_url() );
                $cartUrl = esc_url( wc_get_cart_url() );

                // dequeue woocommerce zoom scripts
                if ( ( !get_query_var('etheme_single_product_builder') && ! etheme_get_option( 'product_zoom' ) ) || ( get_query_var('etheme_single_product_builder') && !etheme_get_option( 'product_gallery_zoom_et-desktop' ) ) || get_query_var('is_mobile') ) {
                    wp_deregister_script( 'zoom' );
                    wp_dequeue_script( 'zoom' );
                }
            }

            $etConf = array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'noresults' => esc_html__('No results were found!', 'xstore'),
                'successfullyAdded' => esc_html__('Product added.', 'xstore'),
                'checkCart' => esc_html__('Please check your ', 'xstore') . "<a href='". $cartUrl ."'>" . esc_html__('cart.', 'xstore') ."</a>",
                'catsAccordion' => etheme_get_option('cats_accordion'),
                'contBtn' => esc_html__('Continue shopping', 'xstore'),
                'checkBtn' => esc_html__('Checkout', 'xstore'),
                'menuBack' => esc_html__('Back', 'xstore'),
                'woocommerce' => (class_exists('Woocommerce') && current_theme_supports('woocommerce')),
                'ajaxProductNotify' => etheme_get_option('ajax_added_product_notify'),
                'notices' => array(
                    'ajax-filters' => esc_html__( 'Ajax error: cannot get filters result', 'xstore' ),
                    'post-product'         => esc_html__( 'Ajax error: cannot get post/product result', 'xstore' ),
                    'products'             => esc_html__( 'Ajax error: cannot get products result', 'xstore' ),
                    'posts'                => esc_html__( 'Ajax error: cannot get posts result', 'xstore' ),
                    'element'              => esc_html__( 'Ajax error: cannot get element result', 'xstore' ),
                    'portfolio'            => esc_html__( 'Ajax error: problem with ajax et_portfolio_ajax action', 'xstore' ),
                    'portfolio-pagination' => esc_html__( 'Ajax error: problem with ajax et_portfolio_ajax_pagination action', 'xstore' ),
                    'menu'                 => esc_html__( 'Ajax error: problem with ajax menu_posts action', 'xstore' ),
                ),
                'variationGallery' => get_query_var('etheme_single_product_variation_gallery', false),
                'archiveVariationGallery' => get_query_var('etheme_shop_archive_product_variation_gallery', false)
            );

            

            wp_localize_script( 'etheme', 'etConfig', $etConf);
            // wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');

            if ( class_exists('Vc_Manager') ) {
                // fix to scripts in static blocks 
                wp_enqueue_script( 'wpb_composer_front_js' );
            }

        }
    }
}

add_action( 'wp_enqueue_scripts', 'etheme_enqueue_scripts', 30);

// **********************************************************************// 
// ! Add new images size
// **********************************************************************// 

if(!function_exists('etheme_image_sizes')) {
    function etheme_image_sizes() {
        add_image_size( 'shop_catalog_alt', 600, 600, true );
    }
}
add_action( 'after_setup_theme', 'etheme_image_sizes');

// **********************************************************************// 
// ! Theme 3d plugins
// **********************************************************************// 
add_action( 'init', 'etheme_3d_plugins' );
if(!function_exists('etheme_3d_plugins')) {
    function etheme_3d_plugins() {
        if(function_exists( 'set_revslider_as_theme' )){
            set_revslider_as_theme();
        }
        if(function_exists( 'set_ess_grid_as_theme' )){
            set_ess_grid_as_theme();
        }
    }
}

add_action( 'vc_before_init', 'etheme_vcSetAsTheme' );
if(!function_exists('etheme_vcSetAsTheme')) {
    function etheme_vcSetAsTheme() {
        if(function_exists( 'vc_set_as_theme' )){
            vc_set_as_theme();
        }
    }
}

// ! REFER for woo premium plugins
if(!defined('YITH_REFER_ID')) {
    define('YITH_REFER_ID', '1028760');
}

// REFER for yellow pencil
if ( !defined('YP_THEME_MODE') ) {
    define('YP_THEME_MODE', "true");
}

// **********************************************************************// 
// ! Load theme translations
// **********************************************************************// 
if( ! function_exists( 'etheme_load_textdomain' ) ) {
    add_action( 'after_setup_theme', 'etheme_load_textdomain' );

    function etheme_load_textdomain(){
        load_theme_textdomain( 'xstore', get_template_directory() . '/languages' );

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) ){
            require_once( $locale_file );
        }
    }
}
