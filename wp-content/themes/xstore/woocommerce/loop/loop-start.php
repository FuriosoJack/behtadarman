<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
global $woocommerce_loop;
// Store column count for displaying the grid
$loop = (wc_get_loop_prop( 'columns' )) ? wc_get_loop_prop( 'columns' ) : get_query_var('et_cat-cols');

$view_mode = get_query_var('et_view-mode');
if( !empty($woocommerce_loop['view_mode'])) {
    $view_mode = $woocommerce_loop['view_mode'];
} else {
    $woocommerce_loop['view_mode'] = $view_mode;
}

if($view_mode == 'list') {
    $view_class = 'products-list';
}else{
    $view_class = 'products-grid';
}
    
if ( ! empty( $woocommerce_loop['isotope'] ) && $woocommerce_loop['isotope'] || etheme_get_option( 'products_masonry' ) && ( is_shop() || is_product_category() ) ) {
    $view_class .= ' et-isotope';
}

$product_view = etheme_get_option('product_view');
if( !empty($woocommerce_loop['product_view'])) {
    $product_view = $woocommerce_loop['product_view'];
}

$custom_template = etheme_get_option('custom_product_template');
if( !empty($woocommerce_loop['custom_template'])) {
    $custom_template = $woocommerce_loop['custom_template'];
}

if ( $product_view == 'custom' && $custom_template != '' ) { 
	$view_class .= ' products-with-custom-template';
	$view_class .= ' products-template-'.$custom_template;
}

$view_class .= isset($woocommerce_loop['product_loop_class']) ? ' ' . $woocommerce_loop['product_loop_class'] : '';

$view_class .= (etheme_get_option( 'ajax_product_filter' ) || etheme_get_option( 'ajax_product_pagination' )) ? ' with-ajax' : '';

 ?>
<div class="row products-loop <?php echo esc_attr( $view_class ); ?> row-count-<?php echo esc_attr( $loop ); ?>"<?php if ($product_view == 'custom' && $custom_template != '' ) : ?> data-post-id="<?php echo esc_attr( $custom_template ); ?>"<?php endif; ?>>

<?php if ( etheme_get_option( 'ajax_product_filter' ) || etheme_get_option( 'ajax_product_pagination' ) ): ?>
	<?php etheme_loader( true, 'product-ajax' ); ?>
    <div class="ajax-content clearfix">
<?php endif ?>