<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;
$styles_default = array(
	'style' => etheme_get_option('cat_style'),
	'text_color' => etheme_get_option('cat_text_color'),
	'valign' => etheme_get_option('cat_valign'),
	'text-align' => 'center',
	'text-transform' => 'uppercase',
	'count_label' => false
);
if ( !isset($styles) ) {
	$styles = $sorting = array();
}
if ( ! empty( $styles ) ) {
	$styles_default = wp_parse_args( $styles, $styles_default  );
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

if ( empty( $woocommerce_loop['categories_columns'] ) )
	$woocommerce_loop['categories_columns'] = wc_get_loop_prop( 'columns' );

$woocommerce_loop['columns'] = (get_query_var('et_cat-cols')) ? get_query_var('et_cat-cols') : $woocommerce_loop['columns'];
$woocommerce_loop['categories_columns'] = (get_query_var('et_cat-cols')) ? get_query_var('et_cat-cols') : $woocommerce_loop['categories_columns'];

$mask_classes = '';

$classes = array();

$classes[] = 'category-grid';

if( !empty($woocommerce_loop['display_type']) && $woocommerce_loop['display_type'] == 'slider' ) {
	$classes[] = 'slide-item';
} else {
	$col_sm = 12 / $woocommerce_loop['categories_columns'];
	$classes[] = 'col-xs-12 col-sm-' . $col_sm . ' columns-' . $woocommerce_loop['categories_columns'];
}

if ( ! empty( $woocommerce_loop['isotope'] ) && $woocommerce_loop['isotope'] || etheme_get_option( 'products_masonry' ) && ( is_shop() || is_product_category() ) ) {
    $classes[] = 'et-isotope-item';
}

// if ( get_option( 'woocommerce_shop_page_display' ) == 'subcategories' && is_shop() && etheme_get_option( 'products_masonry' ) ) {
// 	if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {	
// 		$classes[] = 'grid-sizer';
// 	}
// }

if ( ( is_shop() || is_product_category() ) && etheme_get_option( 'products_masonry' ) ) {
	$classes[] = 'grid-sizer';
}

$classes[] = 'text-color-' . $styles_default['text_color'];
$classes[] = 'valign-' . $styles_default['valign'];
$classes[] = 'style-' . $styles_default['style'];
$mask_classes .= 'text-' . $styles_default['text-align'];
if ( $styles_default['text-transform'] != 'none') {
	$mask_classes .= ' text-' . $styles_default['text-transform'];
}
if ( isset($styles['sorting']) ) {
	$sorting = explode(',', $styles['sorting']);
}
// Increase loop count
$woocommerce_loop['loop'] ++;
?>
<div <?php wc_product_cat_class( $classes, $category ); ?>>
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );


	/**
	 * woocommerce_before_subcategory_title hook
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );
	?>
	
	<div class="categories-mask <?php echo esc_attr($mask_classes); ?>">
		<?php 
		if ( (isset($styles['hide_all']) && !$styles['hide_all']) || count($styles) < 1 ) :
			if ( (in_array('products', $sorting) && $sorting[0] == 'products') ) {
					if ( $category->count > 0 && !$styles_default['count_label'] ) {
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . sprintf( _n( '%s product', '%s products', $category->count, 'xstore' ), $category->count ). '</mark>', $category );
					}
				}
			?>
			<?php if ( empty($sorting[0]) || in_array('name', $sorting) ) { ?>
			<h4><?php echo esc_html($category->name); ?><?php if ( $styles_default['count_label'] && $category->count > 0 ) { echo ' <sup>('.$category->count.')</sup>'; } ?></h4>
			<?php } ?>
			<?php
				if ( (in_array('products', $sorting) && $sorting[1] == 'products') || empty($sorting[0]) ) {
					if ( $category->count > 0 && !$styles_default['count_label'] ) {
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . sprintf( _n( '%s product', '%s products', $category->count, 'xstore' ), $category->count ). '</mark>', $category );
					}
				}
			endif;
		?>
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>
	</div>

	<?php
	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>