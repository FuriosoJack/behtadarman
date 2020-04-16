<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Lorina
 */

/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element
 * @return array
 */
if ( !function_exists( 'lorina_body_classes' ) ) {
	function lorina_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if ( get_theme_mod( 'header_textcolor' ) == 'blank' ) {
			$classes[] = 'title-tagline-hidden';
		}

		if ( post_password_required() ) {
			$classes[] = 'post-password-required';
		}

		$sidebar_position = get_theme_mod( 'sidebar_position' );
		if ( $sidebar_position == "left" ) {
			$classes[] = 'sidebar-left';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'lorina_body_classes' );


if ( !function_exists( 'lorina_primary_menu_sub_trigger' ) ) {
	function lorina_primary_menu_sub_trigger( $args, $item ) {
		if ( 'primary' === $args->theme_location ) {
			if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
				$args->before = '<button class="sub-trigger"></button>';
			} else {
				$args->before = '';
			}
		}
		return $args;
	}
}
add_filter( 'nav_menu_item_args', 'lorina_primary_menu_sub_trigger', 10, 2 );


if ( !function_exists( 'lorina_primary_menu_fallback' ) ) {
	function lorina_primary_menu_fallback() {
		echo '<ul id="primary-menu" class="demo-menu">';
		if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {
			echo '<li class="menu-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Create your Primary Menu here', 'lorina' ) . '</a></li>';
		} else {
			wp_list_pages( array( 'depth' => 1, 'sort_column' => 'post_name', 'title_li' => '' ) );
		}		
		echo '</ul>';
	}
}


if ( !function_exists( 'lorina_footer_menu_fallback' ) ) {
	function lorina_footer_menu_fallback() {
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			echo '<div class="site-info-right">';
			the_privacy_policy_link( '', '' );
			echo '</div>';
		}
	}
}


if ( !function_exists( 'lorina_custom_excerpt_length' ) ) {
	function lorina_custom_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		} else {
			return 20;
		}
	}
}
add_filter( 'excerpt_length', 'lorina_custom_excerpt_length', 999 );


if ( !function_exists( 'lorina_excerpt_more' ) ) {
	function lorina_excerpt_more( $more ) {
		return '&hellip;';
	}
}
add_filter( 'excerpt_more', 'lorina_excerpt_more' );


if ( !function_exists( 'lorina_archive_title_prefix' ) ) {
	function lorina_archive_title_prefix( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="author vcard">' . get_avatar( get_the_author_meta( 'ID' ), '90' ) . esc_html( get_the_author() ) . '</span>';
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'lorina_archive_title_prefix' );


if ( !function_exists( 'lorina_header_menu' ) ) {
	function lorina_header_menu() {
		?>
		<button class="toggle-nav"></button>
		<div id="site-navigation" role="navigation">
			<div class="site-main-menu">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'		=> 'primary-menu',
					'fallback_cb'	=> 'lorina_primary_menu_fallback',
				)
			); ?>
			</div>

			<?php lorina_header_content_extra(); ?>

		</div>
		<?php
	}
}


if ( !function_exists( 'lorina_header_content' ) ) {
	function lorina_header_content() {
		?>
			<div id="site-branding">
				<?php if ( get_theme_mod( 'custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
					<?php if ( is_front_page() ) { ?>
						<h1 class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } else { ?>
						<p class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php } 
					} ?>				
						<div class="site-description"><?php bloginfo( 'description' ); ?></div>
			</div><!-- #site-branding -->
		<?php
	}
}


if ( !function_exists( 'lorina_header_content_extra' ) ) {
	function lorina_header_content_extra() {
		?>
				<?php lorina_header_search() ?>
				<?php lorina_header_account(); ?>
				<?php lorina_header_wishlist(); ?>
				<?php lorina_header_cart(); ?>
				<button class="icons menu-close"><?php esc_html_e( 'Close Menu', 'lorina' ); ?></button>
		<?php
	}
}


if ( !function_exists( 'lorina_header_account' ) ) {
	function lorina_header_account() {
		if ( class_exists( 'WooCommerce' ) ) { ?>
			<div class="top-account">
			<?php $woo_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $woo_account_page_id ) { ?>
				<a class="lorina-account" href="<?php echo esc_url( get_permalink( $woo_account_page_id ) ); ?>" role="button"><span id="icon-user" class="icons lorina-icon-user"></span></a>
			<?php } else { ?>
				<span class="lorina-account" role="button"><span id="icon-user" class="icons lorina-icon-user"></span></span>
			<?php } ?>
				<div class="mini-account">
				<?php if ( is_user_logged_in() ) {
					woocommerce_account_navigation();
				} else {
					wc_get_template( 'myaccount/form-login.php' );
				} ?>
				</div>
			</div>
		<?php }
	}
}


/**
 * Return translated post ID
 */
if(!function_exists( 'lorina_wpml_page_id' )){
	function lorina_wpml_page_id($id){
		if ( function_exists( 'wpml_object_id' ) ) {
			return apply_filters( 'wpml_object_id', $id, 'page' );
		} elseif ( function_exists( 'icl_object_id' ) ) {
			return icl_object_id( $id, 'page', true );
		} else {
			return $id;
		}
	}
}


if ( !function_exists( 'lorina_header_search' ) ) {
	function lorina_header_search() {
		?>
		<div class="top-search">
			<button class="icons lorina-icon-search"></button>
			<div class="mini-search">
			<?php if ( class_exists( 'WooCommerce' ) ) {
				get_product_search_form();
			} else {
				get_search_form();
			} ?>
			<button class="icons search-close"><?php esc_html_e( 'Close Search', 'lorina' ); ?></button>
			</div>
		</div>
	<?php }
}


if ( !function_exists( 'lorina_header_wishlist' ) ) {
	function lorina_header_wishlist() {
		if ( class_exists( 'WooCommerce' ) ) {
			if ( class_exists( 'YITH_WCWL' ) ) { ?>
				<div class="top-wishlist"><a class="lorina-wishlist" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" role="button"><span class="icons lorina-icon-heart"></span><span class="wishlist_products_counter_number"><?php echo yith_wcwl_count_all_products(); ?></span></a></div>
			<?php } elseif ( class_exists( 'TInvWL' ) ) {
				echo do_shortcode( '[ti_wishlist_products_counter show_icon="off" show_text="off"]' );
			}
		}
	}
}


if ( !function_exists( 'lorina_update_wishlist_count' ) ) {
	function lorina_update_wishlist_count() {
		if( class_exists( 'YITH_WCWL' ) ){
			wp_send_json( array(
				'count' => yith_wcwl_count_all_products()
			) );
		}
	}
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'lorina_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'lorina_update_wishlist_count' );


if ( !function_exists( 'lorina_header_cart' ) ) {
	function lorina_header_cart() {
		if ( class_exists( 'WooCommerce' ) ) {
			$cart_items = WC()->cart->get_cart_contents_count();
			if ( $cart_items > 0 ) {
				$cart_class = ' items';
			} else {
				$cart_class = '';
			} ?>
					<div class="top-cart"><a class="lorina-cart<?php echo $cart_class; ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" role="button"><span class="icons lorina-icon-shopping-cart"></span><?php echo sprintf ( '<span class="item-count">%d</span>', $cart_items ); ?></a><div class="mini-cart"><?php woocommerce_mini_cart();?></div></div>
		<?php }
	}
}


/**
 * Update header mini-cart contents when products are added to the cart via AJAX
 */
if ( !function_exists( 'lorina_header_cart_update' ) ) {
	function lorina_header_cart_update( $fragments ) {
		$cart_items = WC()->cart->get_cart_contents_count();
		if ( $cart_items > 0 ) {
			$cart_class = ' items';
		} else {
			$cart_class = '';
		}
		ob_start();
		?>
					<div class="top-cart"><a class="lorina-cart<?php echo $cart_class; ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" role="button"><span class="icons lorina-icon-shopping-cart"></span><?php echo sprintf ( '<span class="item-count">%d</span>', $cart_items ); ?></a><div class="mini-cart"><?php woocommerce_mini_cart();?></div></div>
		<?php	
		$fragments['.top-cart'] = ob_get_clean();	
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'lorina_header_cart_update' );


if ( !function_exists( 'lorina_yith_wishlist_icon' ) ) {
	function lorina_yith_wishlist_icon() {
		if ( class_exists( 'YITH_WCWL' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist label="" product_added_text="" already_in_wishslist_text="" browse_wishlist_text=""]' );
		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'lorina_yith_wishlist_icon', 9 );


/**
 * Powered by WordPress
 */
if ( !function_exists( 'lorina_powered_by' ) ) {
	function lorina_powered_by() {
		?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'lorina' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'lorina' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %2$s by %1$s', 'lorina' ), 'UXL Themes', '<a href="https://uxlthemes.com/theme/lorina/" rel="designer">Lorina</a>' ); ?>
		</div>
		<?php
	}
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action( 'woocommerce_before_main_content', 'lorina_theme_wrapper_start', 10);
add_action( 'woocommerce_after_main_content', 'lorina_theme_wrapper_end', 10);
add_action( 'woocommerce_before_shop_loop', 'lorina_shop_filter_section', 15);

add_action( 'woocommerce_before_shop_loop_item', 'lorina_before_shop_loop_item', 0);
add_action( 'woocommerce_before_subcategory', 'lorina_before_shop_loop_item', 0);

add_action( 'woocommerce_shop_loop_item_title', 'lorina_before_shop_loop_item_title', 0);
add_action( 'woocommerce_after_shop_loop_item_title', 'lorina_after_shop_loop_item_title', 100);

add_action( 'woocommerce_shop_loop_subcategory_title', 'lorina_before_shop_loop_cat_title', 0);
add_action( 'woocommerce_shop_loop_subcategory_title', 'lorina_after_shop_loop_item_title', 100);

add_action( 'woocommerce_after_shop_loop_item', 'lorina_before_shop_loop_addtocart', 6);
add_action( 'woocommerce_after_shop_loop_item', 'lorina_after_shop_loop_addtocart', 100);
add_action( 'woocommerce_after_subcategory', 'lorina_after_subcategory', 100);


if ( !function_exists( 'lorina_before_shop_loop_item' ) ) {
	function lorina_before_shop_loop_item() {
		echo '<div class="product-wrap">';
	}
}


if ( !function_exists( 'lorina_before_shop_loop_item_title' ) ) {
	function lorina_before_shop_loop_item_title() {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids && $product->get_image_id() ) {
			echo '<div class="product-extra-img">' . wp_get_attachment_image( $attachment_ids[0], 'woocommerce_thumbnail' ) . '</div>';
		}
		echo '<div class="product-detail-wrap">';
	}
}


if ( !function_exists( 'lorina_before_shop_loop_cat_title' ) ) {
	function lorina_before_shop_loop_cat_title() {
		echo '<div class="product-detail-wrap">';
	}
}


if ( !function_exists( 'lorina_after_shop_loop_item_title' ) ) {
	function lorina_after_shop_loop_item_title() {
		echo '</div>';
	}
}


if ( !function_exists( 'lorina_before_shop_loop_addtocart' ) ) {
	function lorina_before_shop_loop_addtocart() {
		echo '<div class="product-addtocart-wrap">';
	}
}


if ( !function_exists( 'lorina_after_shop_loop_addtocart' ) ) {
	function lorina_after_shop_loop_addtocart() {
		echo '</div></div>';
	}
}


if ( !function_exists( 'lorina_after_subcategory' ) ) {
	function lorina_after_subcategory() {
		echo '</div>';
	}
}


if ( !function_exists( 'lorina_shop_filter_section' ) ) {
	function lorina_shop_filter_section() {
		if ( !is_product() ) {
			get_sidebar( 'shop-filters' );
		}
	}
}


if ( !function_exists( 'lorina_theme_wrapper_start' ) ) {
	function lorina_theme_wrapper_start() {
		if ( !is_active_sidebar( 'lorina-sidebar-shop' ) || is_product() ) {
			$page_full_width = ' full-width';
		} else {
			$page_full_width = '';
		}
		echo '<div id="primary" class="content-area'.$page_full_width.'">
			<main id="main" class="site-main" role="main">';
	}
}


if ( !function_exists( 'lorina_theme_wrapper_end' ) ) {
	function lorina_theme_wrapper_end() {
		echo '</main><!-- #main -->
		</div><!-- #primary -->';
		if ( !is_product() ) {
			get_sidebar( 'shop' );
		}
	}
}


if ( !function_exists( 'lorina_change_prev_next' ) ) {
	function lorina_change_prev_next( $args ) {
		$args['prev_text'] = '<i class="fa fa-chevron-left"></i>';
		$args['next_text'] = '<i class="fa fa-chevron-right"></i>';
		return $args;
	}
}
add_filter( 'woocommerce_pagination_args', 'lorina_change_prev_next' );


if ( !function_exists( 'lorina_woocommerce_placeholder_img_src' ) ) {
	function lorina_woocommerce_placeholder_img_src() {
		return esc_url( get_template_directory_uri() ) . '/images/woocommerce-placeholder.png';
	}
}
if ( !get_option( 'woocommerce_placeholder_image', 0 ) ) {
	add_filter('woocommerce_placeholder_img_src', 'lorina_woocommerce_placeholder_img_src');
}


if ( !function_exists( 'lorina_upsell_products_args' ) ) {
	function lorina_upsell_products_args( $args ) {
		$col_per_page = esc_attr( get_option( 'woocommerce_catalog_columns', 4 ) );
		$args['posts_per_page'] = $col_per_page;
		$args['columns'] = $col_per_page;
		return $args;
	}
}
add_filter( 'woocommerce_upsell_display_args', 'lorina_upsell_products_args' );


if ( !function_exists( 'lorina_related_products_args' ) ) {
	function lorina_related_products_args( $args ) {
		$col_per_page = esc_attr( get_option( 'woocommerce_catalog_columns', 4 ) );
		$args['posts_per_page'] = $col_per_page;
		$args['columns'] = $col_per_page;
		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'lorina_related_products_args' );


if ( !function_exists( 'lorina_woocommerce_gallery_thumbnail_size' ) ) {
	function lorina_woocommerce_gallery_thumbnail_size( $size ) {
		return 'woocommerce_thumbnail';
	}
}
add_filter( 'woocommerce_gallery_thumbnail_size', 'lorina_woocommerce_gallery_thumbnail_size' );


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'lorina_before_loop_sale_flash', 7);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 8 );
add_action( 'woocommerce_before_shop_loop_item_title', 'lorina_after_loop_sale_flash', 9);

add_action( 'woocommerce_before_single_product_summary', 'lorina_before_loop_sale_flash', 9);
add_action( 'woocommerce_before_single_product_summary', 'lorina_after_loop_sale_flash', 11);


if ( !function_exists('lorina_before_loop_sale_flash') ) {
	function lorina_before_loop_sale_flash() {
		global $product;
		if ( $product->is_on_sale() ) {
			echo '<div class="sale-flash">';
		}
	}
}


if ( !function_exists('lorina_after_loop_sale_flash') ) {
	function lorina_after_loop_sale_flash() {
		global $product;
		if ( $product->is_on_sale() ) {			
			if ( ! $product->is_type( 'variable' ) && $product->get_regular_price() && $product->get_sale_price() ) {
				$discount_price = $product->get_regular_price() - $product->get_sale_price();
				if ( $discount_price > 0 ) {
					$max_percentage = ( $discount_price  / $product->get_regular_price() ) * 100;
				} else {
					$max_percentage = 0;
				}
			} else {
				$max_percentage = 0;				
				foreach ( $product->get_children() as $child_id ) {
					$variation = wc_get_product( $child_id );
					$price = $variation->get_regular_price();
					$sale = $variation->get_sale_price();
					$percentage = '';
					if ( $price != 0 && ! empty( $sale ) ) {
						$percentage = ( $price - $sale ) / $price * 100;
					}
					if ( $percentage > $max_percentage ) {
						$max_percentage = $percentage;
					}
				}
			}
			echo '<br /><span class="sale-percentage">-' . esc_attr( round($max_percentage) ) . '%</span>';
			echo '</div>';
		}
	}
}


/**
 * Available homepage WooCommerce sections
 */
if ( !function_exists( 'lorina_woo_home_tabs' ) ) {
	function lorina_woo_home_tabs() {
		$tabs = array();
		$tabs['services'] = array(
			'id'	   => 'services',
			'label'	=> esc_html__( 'Featured Services', 'lorina' ),
			'callback' => 'lorina_services',
			'shortcode'=> 'services',
		);
		$tabs['pagecontent'] = array(
			'id'	   => 'pagecontent',
			'label'	=> esc_html__( 'Page Content', 'lorina' ),
			'callback' => 'lorina_pagecontent',
			'shortcode'=> 'page_content',
		);

if ( class_exists( 'WooCommerce' ) ) {
		$tabs['categories'] = array(
			'id'		=> 'categories',
			'label'		=> esc_html__( 'Product Categories', 'lorina' ),
			'callback'	=> 'lorina_categories',
			'shortcode'	=> 'product_categories',
		);
		$tabs['recent'] = array(
			'id'		=> 'recent',
			'label'		=> esc_html__( 'New products', 'lorina' ),
			'callback'	=> 'lorina_recent',
			'shortcode'	=> 'recent_products',
		);
		$tabs['featured'] = array(
			'id'		=> 'featured',
			'label'		=> esc_html__( 'Featured products', 'lorina' ),
			'callback'	=> 'lorina_featured',
			'shortcode'	=> 'featured_products',
		);
		$tabs['sale'] = array(
			'id'		=> 'sale',
			'label'		=> esc_html__( 'On-sale products', 'lorina' ),
			'callback'	=> 'lorina_sale',
			'shortcode'	=> 'sale_products',
		);
		$tabs['best'] = array(
			'id'		=> 'best',
			'label'		=> esc_html__( 'Top sellers', 'lorina' ),
			'callback'	=> 'lorina_best',
			'shortcode'	=> 'best_selling_products',
		);
		$tabs['rated'] = array(
			'id'		=> 'rated',
			'label'		=> esc_html__( 'Top rated products', 'lorina' ),
			'callback'	=> 'lorina_rated',
			'shortcode'	=> 'top_rated_products',
		);
}

		return apply_filters( 'lorina_woo_home_tabs', $tabs );
	}
}


/**
 * Output the homepage sections without WooCommerce
 */
if ( !function_exists('lorina_home_nonwoo_section') ) {
	function lorina_home_nonwoo_section() {

		$woo_home_tabs = get_theme_mod( 'woo_home' );

		if ( !empty( $woo_home_tabs['tabs'] ) ) {

			echo '<div id="homepage-sections">';

			$woo_home = get_theme_mod( 'woo_home', true );

			$woo_tabs = lorina_woo_home_tabs();
	
			?>

			<?php
			$tabs = explode( ',', $woo_home['tabs'] );

			foreach ($tabs as $tab) {
				$tab = explode(":", $tab);
				$tab_id = $tab[0];
				$tab_active = $tab[1];
				$tab_shortcode = $woo_tabs[$tab_id]['shortcode'];

				if ( $tab_active == 1 ) {
					echo '<div id="section-'.$tab_id.'" class="section '.$tab_id.'">';
						if ( $woo_tabs[$tab_id]['shortcode'] == 'services' ) {
							lorina_homepage_features();
						} elseif ( $woo_tabs[$tab_id]['shortcode'] == 'page_content' ) {
							lorina_homepage_content();
						}
					echo '</div>';
				}

			}

			echo '</div>';

		}
	}
}


/**
 * Output the homepage sections with WooCommerce
 */
if ( !function_exists('lorina_home_woo_section') ) {
	function lorina_home_woo_section() {

		$woo_home_tabs = get_theme_mod( 'woo_home' );

		if ( !empty( $woo_home_tabs['tabs'] ) ) {

			echo '<div id="homepage-sections">';

			$woo_home = get_theme_mod( 'woo_home', true );

			$woo_tabs = lorina_woo_home_tabs();

			$woo_column_option = esc_attr( get_option( 'woocommerce_catalog_columns', 4 ) );
	
			?>

			<?php
			$tabs = explode( ',', $woo_home['tabs'] );

			foreach ($tabs as $tab) {
				$tab = explode(":", $tab);
				$tab_id = $tab[0];
				$tab_active = $tab[1];
				$tab_shortcode = $woo_tabs[$tab_id]['shortcode'];

				if ( $tab_active == 1 ) {
					echo '<div id="section-'.$tab_id.'" class="section '.$tab_id.'">';
						if ( $woo_tabs[$tab_id]['shortcode'] == 'services' ) {
							lorina_homepage_features();
						} elseif ( $woo_tabs[$tab_id]['shortcode'] == 'page_content' ) {
							lorina_homepage_content();
						} elseif ( $woo_tabs[$tab_id]['shortcode'] == 'product_categories' ) {
							echo '<h2 class="section-title">' . $woo_tabs[$tab_id]['label'] . '</h2>';
							echo do_shortcode('[product_categories number="0" parent="0" columns="' . $woo_column_option . '"]');
						} else {
							echo '<h2 class="section-title">' . $woo_tabs[$tab_id]['label'] . '</h2>';
							echo do_shortcode('[' . $tab_shortcode . ' limit="' . $woo_column_option . '" columns="' . $woo_column_option . '"]');
						}
					echo '</div>';
				}

			}

			echo '</div>';

		}
	}
}


if ( !function_exists('lorina_homepage_features') ) {
	function lorina_homepage_features() {


	$enable_featured_link = get_theme_mod( 'enable_featured_link', true);
?>
	<section id="featured-post-section" class="section">
		<div class="featured-post-wrap">
			<?php
			$featured_page_link1 = get_theme_mod( 'featured_page_link1' );
			if (!$featured_page_link1) {
			 	# display latest posts
				$lorina_recent_args = array(
					'numberposts' => '3',
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => false
					);
				$recent_posts = wp_get_recent_posts( $lorina_recent_args );
				$featured_post_number = 1;
				foreach( $recent_posts as $recent ){
					$featured_page_icon = get_theme_mod( 'featured_page_icon'.$featured_post_number, lorina_featured_icon_defaults($featured_post_number) );
					?>
					<div class="featured-post featured-post<?php echo $featured_post_number; ?>">
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span><h4><?php echo wp_kses_post( get_the_title($recent["ID"]) ); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = wp_kses_post( wpautop( get_post_field( 'post_excerpt', $recent["ID"] ) ) );
						if ( $featured_page_excerpt == '' ) {
							$featured_page_excerpt = wpautop( wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $recent["ID"] ) ), 15 ) );
						}
						if ( $featured_page_excerpt != '' ) {
							echo $featured_page_excerpt;
						}
						if ( $enable_featured_link ) {
						?>
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'lorina' );?></a>
						<?php
						}
						?>
						</div>
					</div>
					<?php
					$featured_post_number++;
				}
				wp_reset_postdata();
			} else {
				# display selected pages
				for( $i = 1; $i < 4; $i++ ){
					$featured_page_icon = get_theme_mod( 'featured_page_icon'.$i, lorina_featured_icon_defaults($i) );
					$featured_page_link = lorina_wpml_page_id( get_theme_mod( 'featured_page_link'.$i) );					
					if($featured_page_link){
					?>
					<div class="featured-post featured-post<?php echo $i ;?>">
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span><h4><?php echo wp_kses_post( get_the_title($featured_page_link) ); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = wp_kses_post( wpautop( get_post_field( 'post_excerpt', $featured_page_link ) ) );
						if ( $featured_page_excerpt == '' ) {
							$featured_page_excerpt = wpautop( wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $featured_page_link ) ), 15 ) );
						}
						if ( $featured_page_excerpt != '' ) {
							echo $featured_page_excerpt;
						}
						if ( $enable_featured_link ) {
						?>
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'lorina' );?></a>
						<?php
						}
						?>
						</div>
					</div>
				<?php
					}
				}
			}
			?>
		</div>
	</section>
<?php

	}
}


function lorina_featured_icon_defaults( $input ) {
	if ( $input == 1 ) {
		$output = 'fa fa-camera';
	} elseif ( $input == 2 ) {
		$output = 'fa fa-spa';
	} elseif ( $input == 3 ) {
		$output = 'fa fa-award';
	} else {
		$output = 'fa fa-check';
	}
	return $output;
}


function lorina_hex2RGB( $hex ) {
	$hex = str_replace("#", "", $hex);

	preg_match("/^#{0,1}([0-9a-f]{1,6})$/i",$hex,$match);
	if ( !isset( $match[1] ) ) {
		return false;
	}

	if ( strlen( $match[1] ) == 6 ) {
		list($r, $g, $b) = array($hex[0].$hex[1],$hex[2].$hex[3],$hex[4].$hex[5]);
	}
	elseif ( strlen($match[1]) == 3 ) {
		list($r, $g, $b) = array($hex[0].$hex[0],$hex[1].$hex[1],$hex[2].$hex[2]);
	}
	elseif ( strlen($match[1]) == 2 ) {
		list($r, $g, $b) = array($hex[0].$hex[1],$hex[0].$hex[1],$hex[0].$hex[1]);
	}
	elseif ( strlen($match[1]) == 1 ) {
		list($r, $g, $b) = array($hex.$hex,$hex.$hex,$hex.$hex);
	}
	else {
		return false;
	}

	$color = array();
	$color['r'] = hexdec($r);
	$color['g'] = hexdec($g);
	$color['b'] = hexdec($b);

	return $color;
}


if ( !function_exists('lorina_homepage_content') ) {
	function lorina_homepage_content() {

		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'front-page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

		endwhile; // End of the loop.

	}
}
