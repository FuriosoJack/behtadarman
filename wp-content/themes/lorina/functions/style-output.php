<?php
/**
 * Output the customizer styling changes
 *
 * @package Lorina
 */
if ( !function_exists( 'lorina_css_font_family' ) ) {
	function lorina_css_font_family( $font_family ) {
		if ( strpos( $font_family, ':' ) ) {
			$font_family = substr( $font_family, 0, strpos( $font_family, ':' ) );
			return 'font-family:\'' . lorina_esc_font_family( $font_family ) . '\'';
		} else {			
			return 'font-family:' . lorina_esc_font_family( $font_family );
		}
	}
}


function lorina_esc_font_family( $input ) {
	$input = wp_kses( $input, array(
		'"' => array(),
		)
	);
	return $input;
}


if ( !function_exists( 'lorina_dynamic_style' ) ) {
	function lorina_dynamic_style( $css = array() ) {

		$font_content = get_theme_mod( 'font_content' );
		$font_headings = get_theme_mod( 'font_headings' );
		$font_site_title = get_theme_mod( 'font_site_title' );
		$font_nav = get_theme_mod( 'font_nav' );

		if ( $font_content ) {
			$font_site_title_on = 1;
			$font_nav_on = 1;
			$css[] = 'body,button,input,select,textarea{' . lorina_css_font_family( $font_content ) . ';}';
			if ( $font_site_title ) {
				$css[] = '.site-title{' . lorina_css_font_family( $font_site_title ) . ';}';
			} else {
				$css[] = '.site-title{font-family:\'Josefin Sans\';}';
			}
			if ( $font_nav ) {
				$css[] = '#site-navigation .site-main-menu{' . lorina_css_font_family( $font_nav ) . ';}';
			} else {
				$css[] = '#site-navigation .site-main-menu{font-family:\'Josefin Sans\';}';
			}
		} else {
			$font_site_title_on = 0;
			$font_nav_on = 0;
		}

		if ( $font_headings ) {
			$css[] = 'h1:not(.site-title),h2,h3,h4,h5,h6,blockquote{' . lorina_css_font_family( $font_headings ) . ';}';
		}

		if ( $font_site_title && $font_site_title_on == 0 ) {
			$css[] = '.site-title{' . lorina_css_font_family( $font_site_title ) . ';}';
		}

		if ( $font_nav && $font_nav_on == 0 ) {
			$css[] = '#site-navigation .site-main-menu{' . lorina_css_font_family( $font_nav ) . ';}';
		}
		
		$fs_site_title = get_theme_mod( 'fs_site_title', '56' );
		if ( $fs_site_title && $fs_site_title != '56' ) {
			$css[] = '.site-title{font-size:' . esc_attr($fs_site_title) . 'px;}';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$woo_uncat_id = term_exists( 'uncategorized', 'product_cat' );
			if ( $woo_uncat_id != NULL ) {
				$woo_uncat_id = $woo_uncat_id['term_id'];
				$css[] = '#shop-filters .widget_product_categories li.cat-item-' . $woo_uncat_id . '{display:none;}';
			}
		}

		$container_width = get_theme_mod( 'container_width', '1920' );
		if ( $container_width && $container_width != '1920' ) {
			$css[] = '.container{max-width:' . esc_attr($container_width) . 'px;}';
		}

		$header_textcolor = get_theme_mod( 'header_textcolor', '414141' );
		if ( $header_textcolor && $header_textcolor != '414141' && $header_textcolor != 'blank' ) {
			$css[] = '.site-title a,.site-title a:hover,.site-title a:active,.site-title a:focus,.site-description,#site-navigation,#site-navigation a,#primary-menu,#primary-menu li a,.toggle-nav,.menu-item-has-children .sub-trigger,.top-account h2,#masthead .search-form input[type="search"],#masthead .woocommerce-product-search input[type="search"],#masthead .search-form input[type="submit"]:after,#masthead .woocommerce-product-search button[type="submit"]:after,#masthead .search-form input[type="search"]::placeholder,#masthead .woocommerce-product-search input[type="search"]::placeholder{color:#' . esc_attr($header_textcolor) . ';}';
		}

		$color1 = get_theme_mod( 'color1', '#faeded' );
		if ( $color1 && $color1 != '#faeded' ) {
			$color1 = esc_attr($color1);
			
			$css[] = 'th,blockquote,#grid-loop article.sticky,#main.infinite-grid .infinite-wrap article.sticky,#secondary,#shop-filters,.wp-caption-text,.top-search .mini-search,#masthead .top-account .mini-account,#masthead .top-cart .mini-cart,#primary-menu ul,.pagination span,.pagination .dots,.pagination a,.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,.woocommerce div.product .woocommerce-tabs ul.tabs li{background:' . $color1 . ';}';
			
			$css[] = '.entry-header.with-image,.archive-header.with-image,#masthead,#colophon,.has-custom-color-1-background-color{background-color:' . $color1 . ';}';
			
			$css[] = '.comment-navigation .nav-next a:after{border-left-color:' . $color1 . ';}';

			$css[] = '.comment-navigation .nav-previous a:after{border-right-color:' . $color1 . ';}';

			$css[] = '.woocommerce div.product .woocommerce-tabs ul.tabs li{border-color:' . $color1 . ';}';

			$css[] = '.has-custom-color-1-color{color:' . $color1 . ';}';

		}

		$color2 = get_theme_mod( 'color2', '#e08b8b' );
		if ( $color2 && $color2 != '#e08b8b' ) {
			$color2 = esc_attr($color2);
			$color2_rgb = lorina_hex2RGB($color2);
			
			$css[] = '.button,a.button,button,input[type="button"],input[type="reset"],input[type="submit"],#infinite-handle span button,#infinite-handle span button:hover,#infinite-handle span button:focus,#infinite-handle span button:active,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.entry-header.with-image:before,.archive-header.with-image:before,#home-hero-section .widget_media_image:before,.bx-wrapper .bx-controls-direction a:hover,#footer-menu a[href^="mailto:"]:before,.widget_nav_menu a[href^="mailto:"]:before,#footer-menu a[href^="tel:"]:before,.widget_nav_menu a[href^="tel:"]:before,.pagination a:hover,.pagination .current,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce div.product .woocommerce-tabs ul.tabs li.active{background:' . $color2 . ';}';
			
			$css[] = '.woocommerce .sale-flash,.woocommerce ul.products li.product .sale-flash,#yith-quick-view-content .onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.wp-block-button__link,.has-custom-color-2-background-color{background-color:' . $color2 . ';}';
			
			$css[] = 'a,#masthead a.lorina-cart.items .lorina-icon-shopping-cart,#masthead a.lorina-cart.items .item-count,#primary-menu li.current-menu-item > a,.featured-post .featured-icon,#add_payment_method .cart-collaterals .cart_totals .discount td,.woocommerce-cart .cart-collaterals .cart_totals .discount td,.woocommerce-checkout .cart-collaterals .cart_totals .discount td,.infinite-loader,.has-custom-color-2-color{color:' . $color2 . ';}';
			
			$css[] = '.woocommerce-info,.woocommerce-message,.woocommerce div.product .woocommerce-tabs ul.tabs:before,.woocommerce div.product .woocommerce-tabs ul.tabs li:after,.woocommerce div.product .woocommerce-tabs ul.tabs li:before,.woocommerce div.product .woocommerce-tabs ul.tabs li.active{border-color:' . $color2 . ';}';


			$css[] = '.bx-wrapper .bx-controls-direction a{background:rgba('.$color2_rgb['r'].','.$color2_rgb['g'].','.$color2_rgb['b'].',.7);}';

			$css[] = '#masthead.scrolled{border-color:rgba('.$color2_rgb['r'].','.$color2_rgb['g'].','.$color2_rgb['b'].',.2);}';
			
		}

		if ( get_theme_mod( 'header_search_off' ) ) {
			$css[] = '#masthead .top-search{display:none;}';
		}

		return implode( '', $css );

	}
}


if ( !function_exists( 'lorina_editor_dynamic_style' ) ) {
	function lorina_editor_dynamic_style( $mceInit, $css = array() ) {

		$font_content = get_theme_mod( 'font_content' );
		if ( $font_content ) {
			$css[] = 'body.mce-content-body{' . lorina_css_font_family( $font_content ) . ';}';
		}

		$font_headings = get_theme_mod( 'font_headings' );
		if ( $font_headings ) {
			$css[] = '.mce-content-body h1,.mce-content-body h2,.mce-content-body h3,.mce-content-body h4,.mce-content-body h5,.mce-content-body h6{' . lorina_css_font_family( $font_headings ) . ';}';
		}

		$color1 = get_theme_mod( 'color1' );
		if ( $color1 ) {
			$css[] = '.mce-content-body a:not(.button),.mce-content-body a:hover:not(.button),.mce-content-body a:focus:not(.button),.mce-content-body a:active:not(.button){color:' . esc_attr( $color1 ) . '}';
		}

		$styles = implode( '', $css );

		if ( isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] .= ' ' . $styles . ' ';
		} else {
			$mceInit['content_style'] = $styles . ' ';
		}
		return $mceInit;

	}
}
add_filter( 'tiny_mce_before_init', 'lorina_editor_dynamic_style' );


function lorina_block_editor_dynamic_style( $css = array() ) {

	$font_content = get_theme_mod( 'font_content', 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
	if ($font_content && $font_content != 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i' ) {
		$css[] = '.editor-default-block-appender textarea.editor-default-block-appender__content,.editor-styles-wrapper div,.editor-styles-wrapper p,.editor-styles-wrapper ul,.editor-styles-wrapper li{' . lorina_css_font_family( $font_content ) . ';}';
	}

	$font_headings = get_theme_mod( 'font_headings', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );
	if ($font_headings && $font_headings != 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' ) {
		$css[] = '.editor-post-title__block .editor-post-title__input,.editor-styles-wrapper h1,.editor-styles-wrapper h2,.editor-styles-wrapper h3,.editor-styles-wrapper h4,.editor-styles-wrapper h5,.editor-styles-wrapper h6{' . lorina_css_font_family( $font_headings ) . ';}';
	}

	$color2 = get_theme_mod( 'color2' );
	if ($color2 && $color2 != "#e08b8b") {		
		$css[] = '.editor-rich-text__tinymce a,.editor-rich-text__tinymce a:hover,.editor-rich-text__tinymce a:focus,.editor-rich-text__tinymce a:active{color:'.esc_attr($color2).'}';
		$css[] = '.wp-block-button__link{background-color:'.esc_attr($color2).'}';
	}

	return implode( '', $css );

}
