<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Lorina
 */

if ( ! is_active_sidebar( 'lorina-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'lorina-sidebar' ); ?>
</div><!-- #secondary -->
