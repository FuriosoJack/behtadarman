<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

return array(
	'default' => array(
		'sidebar-widgets' => array(
			'main-sidebar' => array(
				'widgets' => array(
					'categories' => array(
						'title' => ''
					),
					'etheme-recent-posts' => array(
						'title'		=> 'Recent posts',
						'number' 	=> 5,
						'image'  	=> true,
						'post_type' => 'post',
						'slider' 	=> 'slider',
						'query' 	=> 'recent',
						'auto_play' => false
					),
					'calendar' => array(
						'title' => 'Calendar',
					),
					'search' => array(
						'title' => ''
					),
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
					
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4270
					)
				),
				'flush' => true
			),
			'shop-filters-sidebar' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Product Categories',
						'dropdown' => 1,
						'hierarchical' => 1,
					),
					'woocommerce_price_filter' => array(
						'title' => 'Filter by price'
					),
					'etheme-static-block' => array(
						'block_id' => 4244
					)
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4246
					)
				),
				'flush' => true
			),
			'single-sidebar' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4386
					)
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'About us',
						'text' => '<p style="margin-bottom: 5px;">Lorem ipsum dolor sit amet,conse ctetur adipiscing elit, sed doeiusmo dminim veniar.</p>
East 21st Street / 304 New York <br/>
Email: youremail@site.com <br/>
Phone: +1 408 996 1010'
					),
					'etheme-socials' => array(
						'size' => 'normal',
						'align' => 'left',
						'facebook' => '#',
						'twitter' => '#',
						'instagram' => '#',
						'google' => '#',
						'pinterest' => '#',
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'Our services',
						'text' => '<ul class="menu">
 	<li><a href="#" target="_blank" rel="noopener">Company Information</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Conditions of Sales</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Privacy policy</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Returns and refunds</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Dispute Resolution</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Returns and refunds</a></li>
</ul>'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'Useful links',
						'text' => '<ul class="menu">
 	<li><a href="#" target="_blank" rel="noopener">Fast Shipping</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Paypal/Secure Payment</a></li>
 	<li><a href="#" target="_blank" rel="noopener">30 Days Return Policy</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Business Development</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Terms of Us</a></li>
 	<li><a href="#" target="_blank" rel="noopener">Business Development</a></li>
</ul>'
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					
					
					'text' => array(
						'title' => 'Newsletter',
						'text' => '
						<p style="margin-bottom: 10px;">Get 10% off by subscribing to our newsletter</p><div class="et-mailchimp classic-button dark">[mc4wp_form id="4242"]</div>
						<p class="widget-title"><span>Payment methods</span></p><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png" alt="payment methods">
						'
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="font-size: 1rem;">Ⓒ Created by 8theme - Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'etheme-menu' => array(
						'menu' => 'Top&bottom menu',
						'style' => 'horizontal',
						'align' => 'right'
					)
				),
				'flush' => true
			),
			// 'recent-products' => array(
			// 	'widgets' => array(
			// 		'woocommerce_products' => array(
			// 			'title' => 'Latest Products',
			// 			'number' => 3,
			// 			'order' => 'desc',
			// 		),
			// 	),
			// 	'flush' => true
			// ),
			// 'sale-products' => array(
			// 	'widgets' => array(
			// 		'woocommerce_products' => array(
			// 			'title' => 'ON SALE',
			// 			'number' => 3,
			// 			'show' => 'onsale',
			// 			'order' => 'desc',
			// 		),
			// 	),
			// 	'flush' => true
			// ),
			// 'featured-products' => array(
			// 	'widgets' => array(
			// 		'woocommerce_products' => array(
			// 			'title' => 'Featured Products',
			// 			'number' => 3,
			// 			'show' => 'featured',
			// 			'order' => 'desc',
			// 		),
			// 	),
			// 	'flush' => true
			// ),
		),
		// 'custom-sidebars' => array(
		// 	'recent-products',
		// 	'sale-products',
		// 	'featured-products'
		// )
	),
	'marseille01' => array(
		'sidebar-widgets' => array(
			'main-sidebar' => array(
				'widgets' => array(
					'categories' => array(
						'title' => 'CATEGORIES'
					),
					'search' => array(
						'title' => 'SEARCH'
					),
					'null-instagram-feed' => array(
						'title' => 'INSTAGRAM',
						'username' => 'madewell',
						'number' => 8,
						'columns' => 4,
					),
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8000
					)
				),
				'flush' => true
			),
			'shop-filters-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7997
					)
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
		),
	),
	'marseille02' => array(
		'sidebar-widgets' => array(
			'main-sidebar' => array(
				'widgets' => array(
					'categories' => array(
						'title' => 'CATEGORIES'
					),
					'search' => array(
						'title' => 'SEARCH'
					),
					'null-instagram-feed' => array(
						'title' => 'INSTAGRAM',
						'username' => 'madewell',
						'number' => 8,
						'columns' => 4,
					),
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8044
					)
				),
				'flush' => true
			),
			'shop-filters-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8043
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8040
					)
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
		),
	),
	'default-red' => array(
		'sidebar-widgets' => array(
			'main-sidebar' => array(
				'widgets' => array(
					'etheme-about-author' => array(
						'image' => 'http://8theme.com/import/xstore/wp-content/uploads/2016/05/author-new.jpg',
						'bio' => 'Primis adipiscing non lobortis porttitor cras elit tempor vestibulum non ligula molestie massa consectetur.'
					),
					'categories' => array(
						'title' => 'Categories'
					),
					'etheme-posts-tabs' => array(
						'number' => 4
					),
					'tag_cloud' => array(
						'title' => 'Tags Cloud',
						'taxonomy' => 'post_tag'
					),
					'search' => array(
						'title' => 'Search'
					),
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'mobile-sidebar' => array(
				'widgets' => array(
					'etheme-socials' => array(
						'size' => 'small',
						'align' => 'left',
						'facebook' => '#',
						'twitter' => '#',
						'instagram' => '#',
						'google' => '#',
						'pinterest' => '#',
					),
				),
				'flush' => true
			),
			'top-panel' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4245
					)
				),
				'flush' => true
			),
			'shop-sidebar' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Categories'
					),
					'woocommerce_price_filter' => array(
						'title' => 'Filter by price'
					),
					'woocommerce_layered_nav' => array(
						'title' => 'Filter by',
						'display_type' => 'list',
						'query_type' => 'and',
					),
				),
				'flush' => true
			),
			'shop-filters-sidebar' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Product Categories',
						'dropdown' => 1,
						'hierarchical' => 1,
					),
					'woocommerce_price_filter' => array(
						'title' => 'Filter by price'
					),
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4246
					)
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4270
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/logo-footer.png" /></p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.
<br><br>
48 Park Avenue,<br>
East 21st Street, Apt. 304<br>
New York NY 10016<br>
Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
Phone: <mark>+1 408 996 1010</mark>'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '<div class="row">
									<div class="col-md-6">
									<ul class="menu">
									<li><a href="#">Home Page</a></li>
									<li><a href="#">About Us</a></li>
									<li><a href="#">Delivery Info</a></li>
									<li><a href="#">Conditions</a></li>
									<li><a href="#">Order Tracking</a></li>
									<li><a href="#">My Account</a></li>
									<li><a href="#">My Wishlist</a></li>
									</ul>
									</div>
									<div class="col-md-6">
									<ul class="menu">
									<li><a href="#">London</a></li>
									<li><a href="#">San Fransisco</a></li>
									<li><a href="#">New Orlean</a></li>
									<li><a href="#">Seatle</a></li>
									<li><a href="#">Portland</a></li>
									<li><a href="#">Stockholm</a></li>
									<li><a href="#">Hoffenheim</a></li>
									</ul>
									</div>
									</div>'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'tag_cloud' => array(
						'title' => 'Product Tags',
						'taxonomy' => 'product_tag',
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '© Created by <a href="#"><i class="et-icon et-heart-o"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="margin-bottom:0;"><a href="#"><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png" /></a></p>'
					),
				),
				'flush' => true
			),
			'recent-products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Latest Products',
						'number' => 3,
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'sale-products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'ON SALE',
						'number' => 3,
						'show' => 'onsale',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'featured-products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Featured Products',
						'number' => 3,
						'show' => 'featured',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'recent-products',
			'sale-products',
			'featured-products'
		)
	),
	'furniture' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p><img src="http://8theme.com/import/xstore/versions/wp-content/uploads/sites/2/2016/06/logo-fixed.png" /></p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.
							<br><br>
							48 Park Avenue,<br>
							East 21st Street, Apt. 304<br>
							New York NY 10016<br>
							Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
							Phone: <mark>+1 408 996 1010</mark>'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '<div class="row">
									<div class="col-md-6">
									<ul class="menu">
									<li><a href="#">Home Page</a></li>
									<li><a href="#">About Us</a></li>
									<li><a href="#">Delivery Info</a></li>
									<li><a href="#">Conditions</a></li>
									<li><a href="#">Order Tracking</a></li>
									<li><a href="#">My Account</a></li>
									<li><a href="#">My Wishlist</a></li>
									</ul>
									</div>
									<div class="col-md-6">
									<ul class="menu">
									<li><a href="#">London</a></li>
									<li><a href="#">San Fransisco</a></li>
									<li><a href="#">New Orlean</a></li>
									<li><a href="#">Seatle</a></li>
									<li><a href="#">Portland</a></li>
									<li><a href="#">Stockholm</a></li>
									<li><a href="#">Hoffenheim</a></li>
									</ul>
									</div>
									</div>'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'null-instagram-feed' => array(
						'title' => 'Instagram',
						'username' => 'mrorlandosoria',
						'number' => 6,
						'columns' => 3,
					),
				),
				'flush' => true
			),
		)
	),
	'cosmetics' => array(
		'sidebar-widgets' => array(
			'cosmetics-sidebar' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Categories'
					),
					'etheme_widget_products' => array(
						'title' => 'Special Products',
						'number' => 10,
						'order' => 'desc',
						'slider' => 1,
					),
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '
							<p><img src="http://8theme.com/demo/xstore/cosmetics/wp-content/uploads/sites/7/2016/06/logo-cosmetics.png" alt="logo-footer-retina" width="160" height="29"></p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.</p>
							<p>
								48 Park Avenue,<br>
								East 21st Street, Apt. 304<br>
								New York NY 10016<br>
								Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
								Phone: <mark>+1 408 996 1010</mark>
							</p>
						'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '
							<div class="row">
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">Home Page</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Delivery Info</a></li>
							<li><a href="#">Conditions</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							</ul>
							</div>
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">London</a></li>
							<li><a href="#">San Fransisco</a></li>
							<li><a href="#">New Orlean</a></li>
							<li><a href="#">Seatle</a></li>
							<li><a href="#">Portland</a></li>
							<li><a href="#">Stockholm</a></li>
							<li><a href="#">Hoffenheim</a></li>
							</ul>
							</div>
							</div>
						'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'Subscribe',
						'text' => '
							<p>Be always up to date with our news!</p>
							[mc4wp_form]
							<p>* Don’t worry, we won’t spam mailboxes</p>
						'
					),
					'etheme-socials' => array(
						'size' => 'small',
						'align' => false,
						'facebook' => '#',
						'twitter' => '#',
						'instagram' => '#',
						'google' => '#',
						'pinterest' => '#',
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p>© Created by <a href="#"><i class="et-icon et-heart-o"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="margin-bottom:0;"><a href="#"><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png" /></a></p>'
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'cosmetics-sidebar'
		)
	),
	'engineer' => array(
		'sidebar-widgets' => array(
			'Engineer' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Categories'
					)
				),
				'flush' => true
			),
			'Engineer posts' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4590
					)
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'Engineer',
			'Engineer posts'
		)
	),
	'kids' => array(
		'sidebar-widgets' => array(
			'Kids newsletter' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'NEWSLETTER',
						'text' => 'You can be always up to date with our company news!
[mc4wp_form]
<p>*Don’t worry, we won’t spam our customers mailboxes
</p>'
					),
					'etheme-socials' => array(
						'title' => 'Follow us',
						'size' => 'small',
						'align' => 'left',
						'facebook' => '#',
						'twitter' => '#',
						'instagram' => '#',
						'google' => '#',
						'pinterest' => '#',
					),
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4645
					)
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'Kids newsletter'
		)
	),
	'dark' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
		)
	),	
	'drinks' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 4990
					)
				),
				'flush' => true
			),
		),
	),
	'bakery' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5053
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5052
					)
				),
				'flush' => true
			),
		),
	),
	'hipster' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'popular products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Popular Products',
						'number' => 3,
						'show' => 'featured',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'popular products',
		)
	),
	'jewellery' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5098
					)
				),
				'flush' => true
			),
		)
	),
	'landing' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5131 //
					)
				),
				'flush' => true
			),
		)
	),
	'hosting' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5183
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5182 //
					)
				),
				'flush' => true
			),
		)
	),
	'electronics' => array(
		'sidebar-widgets' => array(
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5224
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5222
					)
				),
				'flush' => true
			),
			'recent products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Latest Products',
						'number' => 3,
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'sale products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'ON SALE',
						'number' => 3,
						'show' => 'onsale',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'featured products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Featured Products',
						'number' => 3,
						'show' => 'featured',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'Popular products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Popular Products',
						'number' => 3,
						'show' => 'featured',
						'order' => 'asc',
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'recent products',
			'sale products',
			'sale products',
			'Popular products'
		)
	),
	'christmas' => array(
		'sidebar-widgets' => array(
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '[rev_slider alias="footer-christmas"]'
					),
				),
				'flush' => true
			),
		)
	),
	'sushi' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5357
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5361
					)
				),
				'flush' => true
			),
		),		
	),
	'gym' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5414
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5413
					)
				),
				'flush' => true
			),
		),		
	),
	'corporate' => array(
		'sidebar-widgets' => array(
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8058
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8057
					)
				),
				'flush' => true
			),
		)
	),
	'finances' => array(
		'sidebar-widgets' => array(
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8087
					)
				),
				'flush' => true
			),			
		)	
	),
	'marketing' => array(
		'sidebar-widgets' => array(
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5671
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5661
					)
				),
				'flush' => true
			),
		),	
	),
	'lawyer' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5710
					)
				),
				'flush' => true
			),
		),	
	),
	'flowers' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5796
					)
				),
				'flush' => true
			),
		),	
	),
	'handmade' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5837
					)
				),
				'flush' => true
			),
		),	
	),
	'medical' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5973
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 5970
					)
				),
				'flush' => true
			),
		),	
	),
	'minimal' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6014
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6028
					)
				),
				'flush' => true
			),
		),	
	),
	'concert' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6123
					)
				),
				'flush' => true
			),
		),	
	),
	'animals' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6230
					)
				),
				'flush' => true
			),
			'instagram' => array(
				'widgets' => array(
					'null-instagram-feed' => array(
						'title' => '',
						'username' => 'sandiegozoo',
						'number' => 4,
						'columns' => 4,
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'instagram'
		)	
	),
	'underwear' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6285
					)
				),
				'flush' => true
			),
		),	
	),
	'books' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6353
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6351
					)
				),
				'flush' => true
			),
		),	
	),
	'makeup' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6469
					)
				),
				'flush' => true
			),
		),	
	),
	'wedding' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7986
					)
				),
				'flush' => true
			),
			'recent products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Latest Products',
						'number' => 3,
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'sale products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'ON SALE',
						'number' => 3,
						'show' => 'onsale',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'featured products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Featured Products',
						'number' => 3,
						'show' => 'featured',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '
							<p><img src="http://8theme.com/demo/xstore/wedding/wp-content/uploads/sites/2/2016/05/logo-footer-retina.png" alt="logo-footer-retina" width="160" height="29"></p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.</p>
							<p>
								48 Park Avenue,<br>
								East 21st Street, Apt. 304<br>
								New York NY 10016<br>
								Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
								Phone: <mark>+1 408 996 1010</mark>
							</p>
						'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '
							<div class="row">
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">Home Page</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Delivery Info</a></li>
							<li><a href="#">Conditions</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							</ul>
							</div>
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">London</a></li>
							<li><a href="#">San Fransisco</a></li>
							<li><a href="#">New Orlean</a></li>
							<li><a href="#">Seatle</a></li>
							<li><a href="#">Portland</a></li>
							<li><a href="#">Stockholm</a></li>
							<li><a href="#">Hoffenheim</a></li>
							</ul>
							</div>
							</div>
						'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'Subscribe',
						'text' => '
							<p>Be always up to date with our news!</p>
							[mc4wp_form]
							<p>* Don’t worry, we won’t spam mailboxes</p>
						'
					),
					'etheme-socials' => array(
						'size' => 'small',
						'align' => 'left',
						'facebook' => '#',
						'twitter' => '#',
						'instagram' => '#',
						'google' => '#',
						'pinterest' => '#',
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p>© Created by <a href="#"><i class="et-icon et-heart-o"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="margin-bottom:0;"><a href="#"><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png" /></a></p>'
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'recent products',
			'sale products',
			'featured products'
		)	
	),
	'bicycle' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '
							<p><img src="http://8theme.com/demo/xstore/bike/wp-content/uploads/sites/4/2016/05/logo-footer-retina.png" alt="logo-footer-retina" width="160" height="29"></p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.</p>
							<p>
								48 Park Avenue,<br>
								East 21st Street, Apt. 304<br>
								New York NY 10016<br>
								Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
								Phone: <mark>+1 408 996 1010</mark>
							</p>
						'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '
							<div class="row">
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">Home Page</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Delivery Info</a></li>
							<li><a href="#">Conditions</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							</ul>
							</div>
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">London</a></li>
							<li><a href="#">San Fransisco</a></li>
							<li><a href="#">New Orlean</a></li>
							<li><a href="#">Seatle</a></li>
							<li><a href="#">Portland</a></li>
							<li><a href="#">Stockholm</a></li>
							<li><a href="#">Hoffenheim</a></li>
							</ul>
							</div>
							</div>
						'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'Subscribe',
						'text' => '
							<p>Be always up to date with our news!</p>
							[mc4wp_form id=“4242”]
							<p>* Don’t worry, we won’t spam mailboxes</p>
						'
					),
					'etheme-socials' => array(
						'size' => 'small',
						'align' => false,
						'facebook' => '#',
						'twitter' => '#',
						'instagram' => '#',
						'google' => '#',
						'pinterest' => '#',
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p>© Created by <a href="#"><i class="et-icon et-heart-o"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="margin-bottom:0;"><a href="#"><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png" /></a></p>'
					),
				),
				'flush' => true
			),
		),	
	),
	'glasses' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '
							<p><img src="http://8theme.com/demo/xstore/glasses/wp-content/uploads/sites/11/2016/07/logo-blue-footer.png" alt="logo-footer-retina" width="160" height="29"></p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.</p>
							<p>
								48 Park Avenue,<br>
								East 21st Street, Apt. 304<br>
								New York NY 10016<br>
								Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
								Phone: <mark>+1 408 996 1010</mark>
							</p>
						'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '
							<div class="row">
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">Home Page</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Delivery Info</a></li>
							<li><a href="#">Conditions</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							</ul>
							</div>
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">London</a></li>
							<li><a href="#">San Fransisco</a></li>
							<li><a href="#">New Orlean</a></li>
							<li><a href="#">Seatle</a></li>
							<li><a href="#">Portland</a></li>
							<li><a href="#">Stockholm</a></li>
							<li><a href="#">Hoffenheim</a></li>
							</ul>
							</div>
							</div>
						'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'Subscribe',
						'text' => '
							<p>Be always up to date with our news!</p>
							[mc4wp_form]
							<p>* Don’t worry, we won’t spam mailboxes</p>
						'
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p>© Created by <a href="#"><i class="et-icon et-heart-o"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="margin-bottom:0;"><a href="#"><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png" /></a></p>'
					),
				),
				'flush' => true
			),
		),	
	),
	'organic' => array(
		'sidebar-widgets' => array(
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'text' => array(
						'text' => '
							<p><img src="http://8theme.com/demo/xstore/organic/wp-content/uploads/sites/14/2016/08/logo-organic-footer.png" alt="logo-footer-retina" width="160" height="29"></p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod lorem.</p>
							<p>
								48 Park Avenue,<br>
								East 21st Street, Apt. 304<br>
								New York NY 10016<br>
								Email: <mark><a href="mailto:youremail@site.com" >youremail@site.com</a></mark><br>
								Phone: <mark>+1 408 996 1010</mark>
							</p>
						'
					),
				),
				'flush' => true
			),
			'footer-2' => array(
				'widgets' => array(
					'text' => array(
						'title' => 'USEFUL LINKS',
						'text' => '
							<div class="row">
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">Home Page</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Delivery Info</a></li>
							<li><a href="#">Conditions</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							</ul>
							</div>
							<div class="col-md-6">
							<ul class="menu">
							<li><a href="#">London</a></li>
							<li><a href="#">San Fransisco</a></li>
							<li><a href="#">New Orlean</a></li>
							<li><a href="#">Seatle</a></li>
							<li><a href="#">Portland</a></li>
							<li><a href="#">Stockholm</a></li>
							<li><a href="#">Hoffenheim</a></li>
							</ul>
							</div>
							</div>
						'
					),
				),
				'flush' => true
			),
			'footer-3' => array(
				'widgets' => array(
					'etheme-recent-posts' => array(
						'title' => 'Latest Posts',
						'number' => 3,
						'image' => 1,
						'post_type' => 'post',
						'query' => 'recent',
					),
				),
				'flush' => true
			),
			'footer-4' => array(
				'widgets' => array(
					'null-instagram-feed' => array(
						'title' => 'Instagram',
						'username' => 'cleanfooddirtycity',
						'number' => 12,
						'columns' => 4,
					),
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p>© Created by <a href="#"><i class="et-icon et-heart-o"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
		),	
	),
	'tea' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6589
					)
				),
				'flush' => true
			),
			'instagram' => array(
				'widgets' => array(
					'null-instagram-feed' => array(
						'title' => '',
						'username' => 'yourtea',
						'number' => 8,
						'columns' => 4,
					),
				),
				'flush' => true
			),
		),
		'custom-sidebars' => array(
			'instagram'
		),
	),
	'freelance' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6693
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'shoes' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6772
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'coctails' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6859
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6831
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p>© Created by 8theme – Power Elite ThemeForest Author.</p>'
					),
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="margin-bottom:0;"><a href="#"><img src="http://8theme.com/import/xstore/wp-content/uploads/2016/05/payments.png"></a></p>'
					),
				),
				'flush' => true
			),
			'instagram' => array(
				'widgets' => array(
					'null-instagram-feed' => array(
						'title' => 'Instagram',
						'username' => 'beautifulbooze',
						'number' => 8,
						'columns' => 4,
					),
				),
				'flush' => true
			),			
		),		
		'custom-sidebars' => array(
			'instagram'
		),
	),
	'barbershop' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6732
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'business' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6913
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'games' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array (
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 6959
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'typography' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7101
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'pizza' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7017
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'spa' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7157
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'mobile' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7249
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'burger' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7309
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'interior' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7269
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'furniture2' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7114
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'plumbing' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7564
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'caramel' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7646
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'x-phone' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7502
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'photographer' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7429
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'delivery' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7713
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'carwash' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7808
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'baby-shop' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(			
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-filters-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7847
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'cleaning' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7758
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'designers' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 7936
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),		
	),
	'electron01' => array(
		'sidebar-widgets' => array(
			'languages-sidebar' => array(
				'widgets' => array(	
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8247
					)
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8248
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
					'text' => array(
						'text' => '<p style="font-size: 1rem; color: #555;">Ⓒ Created by 8theme - Power Elite ThemeForest Author.</p>'
					),					
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(										
				),
				'flush' => true
			),			
		),
	),
	'electron02' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8341
					)
				),
				'flush' => true
			),
			'single-sidebar' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8337
					)
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8332
					)
				),
				'flush' => true
			),
			'recent products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Latest Products',
						'number' => 3,
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'sale products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'ON SALE',
						'number' => 3,
						'show' => 'onsale',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'featured products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Featured Products',
						'number' => 3,
						'show' => 'featured',
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'random products' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Random Products',
						'number' => 3,
						'order' => 'desc',
					),
				),
				'flush' => true
			),
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8329
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),
		'custom-sidebars' => array(
			'recent products',
			'sale products',
			'random products',
			'featured products'
		)		
	),
	'organic01' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'Organic01-home' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Categories'
					),
					'woocommerce_products' => array(
						'title' => 'Featured Products',
						'number' => 3,
						'order' => 'desc',
					)
				),
				'flush' => true
			),			
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8371
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),
		'custom-sidebars' => array(
			'Organic01-home'
		)		
	),
	'organic02' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
					'woocommerce_products' => array(
						'title' => 'Our offers',
			 			'number' => 3,
						'order' => 'desc',
			 		),
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8440
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		)	
	),
	'babyland01' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8485
					)
				),
				'flush' => true
			),
			'shop-sidebar' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Product categories'
					),
					'woocommerce_price_filter' => array(
						'title' => 'Filter by price'
					),					
				),
				'flush' => true
			),
			'shop-filters-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8484
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'Baby-land01-home-sidebar' => array(
				'widgets' => array(
					'woocommerce_product_categories' => array(
						'title' => 'Categories',
						'count' => true
					),
					'etheme-static-block' => array(
						'block_id' => 8493
					),
					'woocommerce_products' => array(
						'title' => 'Featured Products',
						'number' => 3,
						'order' => 'desc',
					)
				),
				'flush' => true
			),			
		),
		'custom-sidebars' => array(
			'Baby-land01-home-sidebar'
		)	
	),
	'lingerie' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8534
					)
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8535
					)
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8537
					)
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8536
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),				
	),
	'artmaxy' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8588
					)
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8589
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),				
	),
	'fashion' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(					
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8928
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),				
	),
	'language-courses' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(					
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 8961
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),				
	),
	'minimalist-outfits' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(					
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 9015
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),				
	),
	'decor' => array(
		'sidebar-widgets' => array(			
			'languages-sidebar' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'top-bar-right' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'header-banner' => array(
				'widgets' => array(					
				),
				'flush' => true
			),
			'shop-after-products' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
			'single-sidebar' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'prefooter' => array(
				'widgets' => array(					
				),
				'flush' => true
			),					
			'footer-1' => array(
				'widgets' => array(
					'etheme-static-block' => array(
						'block_id' => 9060
					)
				),
				'flush' => true
			),
			'footer-copyrights' => array(
				'widgets' => array(
				),
				'flush' => true
			),
			'footer-copyrights2' => array(
				'widgets' => array(
				),
				'flush' => true
			),			
		),				
	),
);