/**
 * Theme Customizer enhancements for a better user experience
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously
 */

( function( $ ) {

	wp.customize('blogname', function( value ) {
		value.bind( function( to ) {
			$('.site-title a').text( to );
		} );
	} );
	wp.customize('blogdescription', function( value ) {
		value.bind( function( to ) {
			$('.site-description').text( to );
		} );
	} );

	wp.customize('header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {
				$( 'body' ).removeClass( 'title-tagline-hidden' );
				$('.site-title a,.site-description,#site-navigation,#site-navigation a,#primary-menu,#primary-menu li a,.toggle-nav,.menu-item-has-children .sub-trigger,.top-account h2,#masthead .search-form input[type="search"],#masthead .woocommerce-product-search input[type="search"]').css('color', to );
			}			
		} );
	} );

	wp.customize('container_width', function( value ) {
		value.bind( function( to ) {
			$('.container').css( {'max-width': to + 'px'} );
		} );
	} );

	wp.customize('header_search_off', function( value ) {
		value.bind( function( to ) {
			if ( to == 1 ) {
				$('#masthead .top-search').css( {'display': 'none'} );
			} else {
				$('#masthead .top-search').css( {'display': 'inline-block'} );
			}			
		} );
	} );

	wp.customize('grid_layout', function( value ) {
		value.bind( function( to ) {
			$( '#grid-loop' ).removeClass();	
			$( '#grid-loop' ).addClass( 'layout-' + to );			
		} );
	} );

	wp.customize('color1', function( value ) {
		value.bind( function( to ) {

			var styleBackground = 'th,blockquote,#grid-loop article.sticky,#main.infinite-grid .infinite-wrap article.sticky,#secondary,#shop-filters,.wp-caption-text,.top-search .mini-search,#masthead .top-account .mini-account,#masthead .top-cart .mini-cart,#primary-menu ul,.pagination span,.pagination .dots,.pagination a,.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,.woocommerce div.product .woocommerce-tabs ul.tabs li{background:' + to + ';}';

			var styleBgColor = '.entry-header.with-image,.archive-header.with-image,#masthead,#colophon{background-color:' + to + ';}';

			var styleBorderLeft = '.comment-navigation .nav-next a:after{border-left-color:' + to + ';}';

			var styleBorderRight = '.comment-navigation .nav-previous a:after{border-right-color:' + to + ';}';

			var styleBorderRight = '.woocommerce div.product .woocommerce-tabs ul.tabs li{border-color:' + to + ';}';

			$('head').append('<style>' + styleBackground + styleBgColor + styleBorderLeft + styleBorderRight + styleBorderRight + '</style>');
		} );
	} );

	wp.customize('color2', function( value ) {
		value.bind( function( to ) {
			var rgba7 = lorina_hex2rgba(to, '0.7');
			var rgba2 = lorina_hex2rgba(to, '0.2');

			var styleBackground = '.button,a.button,button,input[type="button"],input[type="reset"],input[type="submit"],#infinite-handle span button,#infinite-handle span button:hover,#infinite-handle span button:focus,#infinite-handle span button:active,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.entry-header.with-image:before,.archive-header.with-image:before,#home-hero-section .widget_media_image:before,.bx-wrapper .bx-controls-direction a:hover,#footer-menu a[href^="mailto:"]:before,.widget_nav_menu a[href^="mailto:"]:before,#footer-menu a[href^="tel:"]:before,.widget_nav_menu a[href^="tel:"]:before,.pagination a:hover,.pagination .current,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce div.product .woocommerce-tabs ul.tabs li.active{background:' + to + ';}';

			var styleBgColor = '.woocommerce .sale-flash,.woocommerce ul.products li.product .sale-flash,#yith-quick-view-content .onsale,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.wp-block-button__link{background-color:' + to + ';}';

			var styleColor = 'a,#masthead a.lorina-cart.items .lorina-icon-shopping-cart,#masthead a.lorina-cart.items .item-count,#primary-menu li.current-menu-item > a,.featured-post .featured-icon,#add_payment_method .cart-collaterals .cart_totals .discount td,.woocommerce-cart .cart-collaterals .cart_totals .discount td,.woocommerce-checkout .cart-collaterals .cart_totals .discount td,.infinite-loader{color:' + to + ';}';

			var styleBorderColor = '.woocommerce-info,.woocommerce-message,.woocommerce div.product .woocommerce-tabs ul.tabs:before,.woocommerce div.product .woocommerce-tabs ul.tabs li:after,.woocommerce div.product .woocommerce-tabs ul.tabs li:before,.woocommerce div.product .woocommerce-tabs ul.tabs li.active{border-color:' + to + ';}';

			var stylebxcontrols = '.bx-wrapper .bx-controls-direction a{background: ' + rgba7 + ';}';

			var styleMastheadScrolled = '#masthead.scrolled{border-color: ' + rgba2 + ';}';

			$('head').append('<style>' + styleBackground + styleBgColor + styleColor + styleBorderColor + stylebxcontrols + styleMastheadScrolled + '</style>');
		} );
	} );

	// Featured Page icons
	wp.customize('featured_page_icon1', function( value ) {
		value.bind( function( to ) {
			$('.featured-post1 .featured-icon i').removeClass().addClass(to);
		} );
	} );
	wp.customize('featured_page_icon2', function( value ) {
		value.bind( function( to ) {
			$('.featured-post2 .featured-icon i').removeClass().addClass(to);
		} );
	} );
	wp.customize('featured_page_icon3', function( value ) {
		value.bind( function( to ) {
			$('.featured-post3 .featured-icon i').removeClass().addClass(to);
		} );
	} );

	wp.customize('font_site_title', function( value ) {
		value.bind( function( to ) {
			lorina_font_bind( to, '.site-title' );
		} );
	} );

	wp.customize('font_nav', function( value ) {
		value.bind( function( to ) {
			lorina_font_bind( to, '#site-navigation .site-main-menu' );
		} );
	} );

	wp.customize('font_content', function( value ) {
		value.bind( function( to ) {
			var font_nav = wp.customize.value( 'font_nav' )();
			var font_site_title = wp.customize.value( 'font_site_title' )();
			lorina_font_bind( to, 'body, button, input, select, textarea' );
			if ( font_site_title === '' ) {
				$('.site-title').css({ fontFamily: 'initial' });
			} else {
				lorina_font_bind( font_site_title, '.site-title' );
			}
			if ( font_nav === '' ) {
				$('#site-navigation .site-main-menu').css({ fontFamily: 'initial' });
			} else {
				lorina_font_bind( font_nav, '#site-navigation .site-main-menu' );
			}
		} );
	} );

	wp.customize('font_headings', function( value ) {
		value.bind( function( to ) {
			lorina_font_bind( to, 'h1:not(.site-title), h2, h3, h4, h5, h6, blockquote' );
		} );
	} );

	wp.customize('fs_site_title', function( value ) {
		value.bind( function( to ) {
			$('.site-title').css( {'font-size': to + 'px'} );
		} );
	} );


} )( jQuery );

function lorina_font_bind( to, style_class ) {
	if ( to == '' || to == 'Arial, Helvetica, sans-serif' || to == 'Impact, Charcoal, sans-serif' || to == '"Lucida Sans Unicode", "Lucida Grande", sans-serif' || to == 'Tahoma, Geneva, sans-serif' || to == '"Trebuchet MS", Helvetica, sans-serif' || to == 'Verdana, Geneva, sans-serif' || to == 'Georgia, serif' || to == '"Palatino Linotype", "Book Antiqua", Palatino, serif' || to == '"Times New Roman", Times, serif' ) {
	} else {
		var googlefont = encodeURI(to.replace(" ", "+"));
		jQuery('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
		to = to.substr(0, to.indexOf(':'));
		to = "'" + to + "'";
	}
	jQuery(style_class).css({
		fontFamily: to
	});
}

function lorina_font_style( to, style_class ) {
	if ( to == 'italic' ) {
		var to_style = 'italic';
	} else {
		var to_style = 'normal';
	}
	jQuery(style_class).css( {'font-style': to_style } );
}

function lorina_hex2rgba( colour, opacity ) {
	var r,g,b;
	if ( colour.charAt(0) == '#') {
	colour = colour.substr(1);
	}

	r = colour.charAt(0) + '' + colour.charAt(1);
	g = colour.charAt(2) + '' + colour.charAt(3);
	b = colour.charAt(4) + '' + colour.charAt(5);

	r = parseInt( r,16 );
	g = parseInt( g,16 );
	b = parseInt( b,16);
	return 'rgba(' + r + ',' + g + ',' + b + ',' + opacity + ')';
}
