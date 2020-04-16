<?php
/**
 *	Register widgets 
 */
add_filter( 'etc/add/widget', 'etc_add_widgets' );
function etc_add_widgets( $args ) {

	$args[] = array(
		'ETC\App\Models\Widgets\Twitter',
		'ETC\App\Models\Widgets\Recent_Posts',
		'ETC\App\Models\Widgets\Recent_Comments',
		'ETC\App\Models\Widgets\Flickr',
		'ETC\App\Models\Widgets\Instagram',
		'ETC\App\Models\Widgets\Static_Block',
		'ETC\App\Models\Widgets\QR_Code',
		'ETC\App\Models\Widgets\About_Author',
		'ETC\App\Models\Widgets\Socials',
		'ETC\App\Models\Widgets\Featured_Posts',
		'ETC\App\Models\Widgets\Posts_Tabs',
		'ETC\App\Models\Widgets\Menu',
	);

	// Register WooCommerce depend widgets
	if( class_exists('WooCommerce') && class_exists( 'WC_Widget' ) ) {
		$args[] = array(
			'ETC\App\Models\Widgets\Brands',
			'ETC\App\Models\Widgets\Products',
			'ETC\App\Models\Widgets\Brands_Filter',
			'ETC\App\Models\Widgets\Layered_Nav_Filters',
			'ETC\App\Models\Widgets\Price_Filter',
		);

		if ( class_exists( 'St_Woo_Swatches_Base' ) ) {
			$args[] = array(
				'ETC\App\Models\Widgets\Swatches_Filter',
			);
		}
	}

	return $args;
}