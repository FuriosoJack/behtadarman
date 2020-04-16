<?php
/**
 * The sidebar containing the main widget area for WooCommerce archives
 *
 * @package Lorina
 */

if ( ! is_active_sidebar( 'lorina-sidebar-shop' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'lorina-sidebar-shop' ); ?>
</div><!-- #secondary -->
