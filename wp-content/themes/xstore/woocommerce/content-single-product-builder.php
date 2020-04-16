<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
defined( 'ABSPATH' ) || exit;

global $etheme_global, $product;

$l = etheme_page_config();
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

// 
$etheme_global['class'][] = 'single-product-builder';
if ( etheme_get_option( 'product_reviews_in_two_columns_et-desktop' ) )
    $etheme_global['class'][] = 'reviews-two-columns';

if ( etheme_get_option( 'single_product_sidebar_mode_et-desktop' ) != 'default') {
    $l['sidebar'] = 'without';
    $l['content-class'] = 'col-md-12';
}

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $etheme_global['class'], $product ); ?>>
    
    <div class="row">
        <div class="<?php echo esc_attr( $l['content-class'] ); ?> sidebar-position-<?php echo esc_attr( $l['sidebar'] ); ?>">
            <div class="row">
                <?php if ( function_exists('single_product_bulder_content_callback')) 
                    echo single_product_bulder_content_callback();
                ?>
            </div>
        </div>

        <?php if($l['sidebar'] != '' && $l['sidebar'] != 'without' && $l['sidebar'] != 'no_sidebar'): ?>
            <div class="<?php echo esc_attr( $l['sidebar-class'] ); ?> sidebar single-product-sidebar sidebar-<?php echo esc_attr( $l['sidebar'] ); ?>">
                <?php $sidebar_name = etheme_get_option( 'single_product_widget_area_1_et-desktop' ); 
                if ( etheme_get_option('brands_location') == 'sidebar' && ! etheme_xstore_plugin_notice() ) etheme_product_brand_image(); 
                // if(etheme_get_option('upsell_location') == 'sidebar') woocommerce_upsell_display(); 
                if ( !dynamic_sidebar( $sidebar_name ) || is_active_sidebar( $sidebar_name ) ): endif; ?>
            </div>
        <?php endif; ?>
    </div>


    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    //do_action( 'woocommerce_before_single_product_summary' );
    ?>

                                                    <!-- <div class="summary entry-summary"> -->
                                                        <?php
                                                        /**
                                                         * Hook: woocommerce_single_product_summary.
                                                         *
                                                         * @hooked woocommerce_template_single_title - 5
                                                         * @hooked woocommerce_template_single_rating - 10
                                                         * @hooked woocommerce_template_single_price - 10
                                                         * @hooked woocommerce_template_single_excerpt - 20
                                                         * @hooked woocommerce_template_single_add_to_cart - 30
                                                         * @hooked woocommerce_template_single_meta - 40
                                                         * @hooked woocommerce_template_single_sharing - 50
                                                         * @hooked WC_Structured_Data::generate_product_data() - 60
                                                         */
                                                       // do_action( 'woocommerce_single_product_summary' );
                                                        ?>
                                                    <!-- </div> -->

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    //do_action( 'woocommerce_after_single_product_summary' );
    ?>
</div>

<?php etheme_woocommerce_after_single_product(); ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>