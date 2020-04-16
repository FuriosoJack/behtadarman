<?php
	/**
	 * The template for displaying header search block
	 *
	 * @since   1.4.0
	 * @version 1.0.3
	 * last changes in 2.0.0
	 */
 ?>

<?php 

	global $et_builder_globals;
	
	$element_options = array();
	$element_options['search_type'] = Kirki::get_option( 'search_type_et-desktop' ); // icon, full form 
	$element_options['search_type'] = apply_filters('search_type', $element_options['search_type']);
	$element_options['search_content'] = Kirki::get_option( 'search_results_content_et-desktop' );

	$element_options['search_ajax'] = Kirki::get_option( 'search_ajax_et-desktop' ); 

	// to use desktop styles when use this element in mobile menu for example etc.
    $element_options['etheme_use_desktop_style'] = false;
    $element_options['etheme_use_desktop_style'] = apply_filters( 'etheme_use_desktop_style', $element_options['etheme_use_desktop_style'] );

	$element_options['search_icon_et-desktop'] = ( !Kirki::get_option('bold_icons') ) ? '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24"><path d="M23.784 22.8l-6.168-6.144c1.584-1.848 2.448-4.176 2.448-6.576 0-5.52-4.488-10.032-10.032-10.032-5.52 0-10.008 4.488-10.008 10.008s4.488 10.032 10.032 10.032c2.424 0 4.728-0.864 6.576-2.472l6.168 6.144c0.144 0.144 0.312 0.216 0.48 0.216s0.336-0.072 0.456-0.192c0.144-0.12 0.216-0.288 0.24-0.48 0-0.192-0.072-0.384-0.192-0.504zM18.696 10.080c0 4.752-3.888 8.64-8.664 8.64-4.752 0-8.64-3.888-8.64-8.664 0-4.752 3.888-8.64 8.664-8.64s8.64 3.888 8.64 8.664z"></path></svg>' : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M23.64 22.176l-5.736-5.712c1.44-1.8 2.232-4.032 2.232-6.336 0-5.544-4.512-10.032-10.032-10.032s-10.008 4.488-10.008 10.008c-0.024 5.568 4.488 10.056 10.032 10.056 2.328 0 4.512-0.792 6.336-2.256l5.712 5.712c0.192 0.192 0.456 0.312 0.72 0.312 0.24 0 0.504-0.096 0.672-0.288 0.192-0.168 0.312-0.384 0.336-0.672v-0.048c0.024-0.288-0.096-0.552-0.264-0.744zM18.12 10.152c0 4.392-3.6 7.992-8.016 7.992-4.392 0-7.992-3.6-7.992-8.016 0-4.392 3.6-7.992 8.016-7.992 4.392 0 7.992 3.6 7.992 8.016z"></path></svg>';
	$element_options['search_icon_et-desktop'] = apply_filters('et_b_search_icon', $element_options['search_icon_et-desktop']);
	$element_options['search_category_et-desktop'] = Kirki::get_option( 'search_category_et-desktop' );
	$element_options['search_category_et-desktop'] = apply_filters('search_category', $element_options['search_category_et-desktop']);
	$element_options['search_posts_et-desktop'] = Kirki::get_option( 'search_posts_et-desktop' );

	$element_options['search_content_alignment'] = ' justify-content-' . Kirki::get_option( 'search_content_alignment_et-desktop' );
	$element_options['search_content_alignment'] .= ( !$element_options['etheme_use_desktop_style'] ) ? ' mob-justify-content-' . Kirki::get_option( 'search_content_alignment_et-mobile' ) : '';

	$element_options['search_content_position_et-desktop'] = Kirki::get_option( 'search_content_position_et-desktop' );
	$element_options['search_content_position_et-mobile'] = Kirki::get_option( 'search_content_position_et-mobile' );

	$element_options['search_content_position'] = ( $element_options['search_content_position_et-desktop'] != 'custom' ) ? ' et-content-' . $element_options['search_content_position_et-desktop'] : '';

	$element_options['search_placeholder_et-desktop'] = Kirki::get_option( 'search_placeholder_et-desktop' );

	$element_options['search_categories_et-desktop'] = '';

	$element_options['etheme_search_results'] = true;
	$element_options['etheme_search_results'] = apply_filters('etheme_search_results', $element_options['etheme_search_results']);

	if ( $element_options['search_category_et-desktop'] && $element_options['etheme_search_results'] ) {

		$element_options['search_taxonomy_et-desktop'] = ( class_exists( 'WooCommerce' ) && in_array('products', $element_options['search_content']) ) ? 'product_cat' : 'category';

		$element_options['search_all_categories_text_et-desktop'] = Kirki::get_option('search_all_categories_text_et-desktop');

		$element_options['search_categories_et-desktop'] = wp_dropdown_categories(
				array(
	            'show_option_all' => ( $element_options['search_all_categories_text_et-desktop'] != '' ) ? $element_options['search_all_categories_text_et-desktop'] : false,
	            'taxonomy'        => $element_options['search_taxonomy_et-desktop'],
	            'hierarchical'    => true,
	            'echo'			  => 0,
	            'id'              => $element_options['search_taxonomy_et-desktop'] . '-' . rand( 100, 999 ),
	            'name'            => $element_options['search_taxonomy_et-desktop'],
	            'orderby'         => 'name',
	            'value_field'     => 'slug',
	            'hide_if_empty' => true
	        )
		);
	}

	$element_options['class'] = ( $element_options['etheme_search_results'] && $element_options['search_ajax'] ) ? ' ajax-with-suggestions' : '';

	$element_options['search_by_icon-click'] = ( $element_options['search_type'] == 'icon' && $element_options['etheme_search_results'] ) ? true : false;
	$element_options['search_by_icon-click'] = apply_filters('search_by_icon', $element_options['search_by_icon-click']);

	$element_options['min_symbols'] = Kirki::get_option( 'search_ajax_min_symbols_et-desktop' );

	$element_options['icon_class'] = '';

	$element_options['wrapper_class'] = ' ' . $element_options['search_content_position'];
	$element_options['wrapper_class'] .= $element_options['search_content_alignment'];
	$element_options['wrapper_class'] .= ( ( $element_options['search_type'] != 'icon' ) ? ' flex-basis-full' : '' );
	$element_options['wrapper_class'] .= ( $et_builder_globals['in_mobile_menu'] ? '' : ' et_element-top-level' );

	if ( $element_options['search_by_icon-click'] && !$et_builder_globals['in_mobile_menu'] && wp_is_mobile() ) {
		$element_options['wrapper_class'] .= ' et-content_toggle';
		$element_options['icon_class'] .= ' et-toggle';
	}

	$element_options['class'] .= ' input-' . $element_options['search_type'].' ';

	$element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
	$element_options['attributes'] = array();
	if ( $element_options['is_customize_preview'] ) 
		$element_options['attributes'] = array(
			'data-title="' . esc_html__( 'Search', 'xstore-core' ) . '"',
			'data-element="search"'
		);

?>

<div class="et_element et_b_header-search flex align-items-center et-content-dropdown <?php echo $element_options['wrapper_class']; ?>" <?php echo implode( ' ', $element_options['attributes'] ); ?>>
	<?php if ( $element_options['search_by_icon-click'] ) { ?>
		<span class="flex et_b_search-icon <?php echo esc_attr($element_options['icon_class']); ?>"><?php echo $element_options['search_icon_et-desktop']; ?></span>
	<?php } ?>
	
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="searchform" data-min="<?php echo esc_attr($element_options['min_symbols']); ?>" class="ajax-search-form <?php  esc_attr_e( $element_options['class'] ); ?> <?php echo ( $element_options['search_by_icon-click'] ) ? ' et-mini-content' : ''; ?>" method="get">
		<div class="input-row flex align-items-center">
			<?php echo str_replace('<select', '<select style="max-width: calc(122px + 1.4em)"', $element_options['search_categories_et-desktop']); ?>
			<input type="text" value="" placeholder="<?php echo $element_options['search_placeholder_et-desktop']; ?>" autocomplete="off" class="form-control" name="s">
			
			<?php if ( class_exists('WooCommerce') ): ?>
				<input type="hidden" name="post_type" value="<?php echo ( class_exists('WooCommerce') ) ? 'product': 'post'; ?>">
			<?php endif ?>

			<?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ) : ?>
				<input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/>
			<?php endif ?>
			<span class="buttons-wrapper flex flex-nowrap">
				<span class="clear flex-inline justify-content-center align-items-center pointer">
					<span class="et_b-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width=".7em" height=".7em" viewBox="0 0 24 24"><path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path></svg>
				</span>
				</span>
				<button type="submit" class="search-button flex justify-content-center align-items-center pointer">
					<span class="et_b-loader"></span>
				<?php echo $element_options['search_icon_et-desktop']; ?></button>
			</span>
		</div>
		<?php if ( $element_options['etheme_search_results'] && $element_options['search_ajax'] ) : ?>
			<div class="ajax-results-wrapper">
				<!-- <div class="search-results-titles full-width flex justify-content-start">
					<span class="active pointer" data-class="product-ajax-list-wrapper">
						<?php //esc_html_e( 'Products', 'xstore-core' ); ?>
						<span class="count-holder"></span>
					</span>
					<span class=" pointer" data-class="posts-ajax-list-wrapper">
						<?php //esc_html_e( 'Posts', 'xstore-core' ); ?>
						<span class="count-holder"></span>
					</span>
					<span class=" pointer" data-class="pages-ajax-list-wrapper">
						<?php //esc_html_e( 'Pages', 'xstore-core' ); ?>
						<span class="count-holder"></span>
					</span>
				</div> -->
				<!-- <div class="results-ajax-list-wrapper full-width">
					<div class="product-ajax-list-wrapper results-ajax-list-inner">
						<div class="product-ajax-list results-ajax-list">
							<ul class="list-style-none">
							</ul>
						</div>
						<div class="empty-results-block text-center hidden">
		                	<h4><?php //echo esc_html__( 'No Products matched your search', 'xstore-core') . '</h4>'; ?>
		                </div>
						<a class="search-results-redirect button active full-width align-center" href="<?php //echo esc_url( home_url() ) ?>"><?php //esc_html_e( 'All products results', 'xstore-core' ); ?></a>
					</div>
					<div class="posts-ajax-list-wrapper results-ajax-list-inner">
						<div class="posts-ajax-list results-ajax-list">
							<ul class="list-style-none">
							</ul>
						</div>
						<div class="empty-results-block text-center hidden">
		                	<h4><?php //echo esc_html__( 'No Posts matched your search', 'xstore-core') . '</h4>'; ?>
		                </div>
						<a class="search-results-redirect button active full-width align-center" href="<?php //echo esc_url( home_url() ) ?>"><?php //esc_html_e( 'All posts results', 'xstore-core' ); ?></a>
					</div>
					<div class="pages-ajax-list-wrapper results-ajax-list-inner">
						<div class="pages-ajax-list results-ajax-list">
							<ul class="list-style-none">
							</ul>
						</div>
						<div class="empty-results-block text-center hidden">
		                	<h4><?php //echo esc_html__( 'No Pages matched your search', 'xstore-core') . '</h4>'; ?>
		                </div>
						<a class="search-results-redirect button active full-width align-center" href="<?php //echo esc_url( home_url() ) ?>"><?php //esc_html_e( 'All pages results', 'xstore-core' ); ?></a>
					</div>
				</div> -->
			</div>
		<?php endif; ?>
	</form>               	
</div>
