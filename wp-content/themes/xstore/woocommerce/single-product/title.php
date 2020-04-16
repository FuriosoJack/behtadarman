<?php
/**
 * Single Product title
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if( (!get_option( 'etheme_single_product_builder', false ) && etheme_get_option('product_name_signle') ) || (get_option('etheme_single_product_builder') && ( etheme_get_option('product_breadcrumbs_mode_et-desktop') != 'element' && etheme_get_option('product_breadcrumbs_product_title_et-desktop') ) ) ) {
    return;
}
?>
<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
