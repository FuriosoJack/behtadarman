// header elements 

(function($, api) {

	var $document = $(document);

	api.bind('preview-ready', function() {
		var target = window.parent === window ? null : window.parent;

		var elements = {
			'.top-bar': 'Top bar',
			'.header-wrapper .main-header': 'Header',
			'.header-logo': 'Logo',
			'.menu-wrapper': 'Main menu',
			'.header-bg-block .secondary-menu-wrapper': 'Secondary menu',
			'.site-header .et_b_header-menu .nav-sublist-dropdown': 'Dropdown menu',
			'.shopping-container': 'Cart',
			'.et-wishlist-widget': 'Wishlist',
			'.navbar-header .login-link': 'Sign in',
			'.header-search': 'Search',
			'.popup_link:not(.et_b_element)': 'Promo popup',
			'.page-heading, .cart-checkout-nav': 'Breadcrumbs',

			'.footer': 'Footer',
			'.footer-bottom': 'Copyrights',
			
			'.product-category': 'Categories',
			'.content-product': 'Product',

			'.filter-wrap': 'Shop toolbar',
			
			'.st-swatch-in-loop, .st-swatch-preview-single-product': 'Variation swatches',

			'.cart-empty': 'Empty cart',

			'.product_brand, .products-page-brands': 'Brands',

			'.content-product .sale-wrapper, .content-product .stock, .content-product .available-on-backorder': 'Sale & Out of stock',

			'.single .type-product > .related-products': 'Related products',
			'.single .single-product .woocommerce-tabs:not(.et_element)': 'Tabs',

			'.woocommerce-checkout': 'Checkout',

			'.product-share, .share-post': 'Socials',

			'.page-404': '404 page',

			'.sidebar-widget[data-customize-partial-id]': 'Sidebar widget',
			'.footer-widget[data-customize-partial-id]': 'Footer widget',

			'.topbar-widget[data-customize-partial-id]': 'Top bar widget',
			'.top-panel-widget[data-customize-partial-id]': 'Top panel widget',
			'.mobile-sidebar-widget': 'Mobile menu widget',
			'.header-banner-widget': 'Header banner widget',
			'.copyrights-widget[data-customize-partial-id]': 'Copyrights widget',

			// single product elements 

			'.single-product-builder h1.product_title' : 'Product title',
			'.product-content p.price:not(.price-in-nav), .et_product-block > .price, .et_element > .price' : 'Product price',
			'.single-product-builder .product_meta' : 'Product meta',
			'.single-product-builder form.cart' : 'Form cart',
			'.single-product-builder .woocommerce-product-gallery.images-wrapper' : 'Product gallery',
			'.single-product-builder .woocommerce-product-details__short-description' : 'Short description',
			'.single-product-builder .woocommerce-product-rating' : 'Product rating',
			'.single-product-builder .woocommerce-breadcrumb-wrapper' : 'Breadcrumbs',
			'.single-wishlist' : 'Wishlist',
			'.et_product-block .upsell-products' : 'Upsell products',
			'.et_product-block .related-products' : 'Related products',
		};

		jQuery.each(elements, function(el, title) {
			jQuery(document).on( 'mouseenter', el, function(e){
				jQuery(this).addClass('et-element-active');
				jQuery(this).prepend('<div class="et_edit-shortcut"><span class="dashicons dashicons-admin-generic"></span><span class="et-title">'+title+'</span></div>');
			});
			jQuery(document).on( 'mouseleave', el, function(e){
				jQuery(this).removeClass('et-element-active');
				jQuery('.et_edit-shortcut').remove();
			});
		});

		jQuery(document).on( 'mouseenter', '.header-top, .header-main, .header-bottom', function(e){
			jQuery(this).addClass('et-element-active');
			jQuery(this).prepend('<div class="et_edit-shortcut"><span class="dashicons dashicons-admin-generic"></span><span class="et-title">' + jQuery(this).data( 'title' ) + '</span></div>');
		});

		jQuery(document).on( 'mouseleave', '.header-top, .header-main, .header-bottom', function(e){
			jQuery(this).removeClass('et-element-active');
			jQuery('.et_edit-shortcut').remove();
		});

		jQuery(document).on( 'mouseenter', '.et_element:not(.et_connect-block), #header-vertical', function(e){
			jQuery(this).addClass('et-element-active');
			jQuery(this).prepend('<div class="et_edit-shortcut"><span class="dashicons dashicons-admin-generic"></span><span class="et-title">' + jQuery(this).data( 'title' ) + '</span></div>');
		});

		jQuery(document).on( 'mouseleave', '.et_element:not(.et_connect-block), #header-vertical', function(e){
			jQuery(this).removeClass('et-element-active');
			jQuery(this).find('.et_edit-shortcut').remove();
		});

		jQuery(document).on( 'mouseenter', '.et_element.et_connect-block', function(e){
			jQuery(this).addClass('et-element-active builder-connect-block');
		});

		jQuery(document).on( 'mouseleave', '.et_element.et_connect-block', function(e){
			jQuery(this).removeClass('et-element-active builder-connect-block');
		});

		$document.on('click', '.et_edit-shortcut', function(e) {
				e.preventDefault();
				var section_id = $(this).parents('[data-element]').attr('data-element') || '';
				if (section_id && target.wp.customize.section(section_id) )
					target.wp.customize.section(section_id).focus();
				else 
					jQuery(this).parent().find('.customize-partial-edit-shortcut').first().trigger('click');
			}
		);

	});

})(jQuery, wp.customize);