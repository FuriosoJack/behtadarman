<?php
/**
 * The sidebar containing the main widget area for pages
 *
 * @package Lorina
 */

if ( ! is_active_sidebar( 'lorina-sidebar-page' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'lorina-sidebar-page' ); ?>
</div><!-- #secondary -->
