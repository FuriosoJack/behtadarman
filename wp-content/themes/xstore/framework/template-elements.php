<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
// **********************************************************************//
// ! Page heading
// **********************************************************************//
if(!function_exists('etheme_page_heading')) {

	add_action('etheme_page_heading', 'etheme_page_heading', 10);

	function etheme_page_heading() {

		// require( ETHEME_TEMPLATES . 'page-heading.php' );


		get_template_part( 'templates/page-heading' );

		return;

		
	}
}

// **********************************************************************//
// ! Get logo
// **********************************************************************//
if ( ! function_exists( 'etheme_logo' ) ) {
    function etheme_logo($echo = true) {
    	get_template_part( 'templates/logo' );

		return;
    }
}

// **********************************************************************//
// ! Get top links
// **********************************************************************//
if( ! function_exists( 'etheme_top_links' ) ) {
	function etheme_top_links($args = array(), $account = false, $pp = true) {
		extract(shortcode_atts(array(
			'short'  => false,
		), $args));

		$popup = $out = '';

		if( etheme_get_option( 'promo_popup' ) && $pp) {
			$popup = array(
				'class' 	 => 'popup_link',
				'link_class' => 'etheme-popup',
				'href' 		 => '#etheme-popup-holder',
				'title' 	 => etheme_get_option( 'promo-link-text' ),
			);

			if( ! etheme_get_option( 'promo_link' ) ) $popup['class'] .= ' hidden';
			if( etheme_get_option( 'promo_auto_open' ) ) $popup['link_class'] .= ' open-click';
		}

		if ( $popup ){
			$out .= sprintf(
				'<li class="%s"><a href="%s" class="%s">%s</a>%s</li>',
				$popup['class'],
				$popup['href'],
				$popup['link_class'],
				$popup['title'],
				( isset( $popup['submenu'] ) ) ? $popup['submenu'] : ''
			);
		}
		if ( $account ){
			$account = etheme_sign_link( '', $short );
			$out .= sprintf(
				'<li class="%s"><a href="%s" class="%s">%s</a>%s</li>',
				$account['class'],
				$account['href'],
				$account['link_class'],
				$account['title'],
				( isset( $account['submenu'] ) ) ? $account['submenu'] : ''
			);
		}

		if ( $out ) echo '<ul class="links">' . $out . '</ul>';
    }
}


// **********************************************************************//
// ! Post content image
// **********************************************************************//

if( ! function_exists( 'etheme_post_thumb' ) ) {
	function etheme_post_thumb( $args = array() ) {
		global $et_loop;

		$defaults = array(
			'size' 		=> 'large',
			'in_slider' => false,
			'link' 		=> true,
			'ID'        => null
		);

		$args 		 = wp_parse_args( $args, $defaults );
		$post_format = get_post_format($args['ID']);
		$post_category = etheme_get_option('blog_categories');
		$primary_category = ( $post_category ) ? etheme_primary_category(false) : ''; 

		?>
		<?php if( $post_format == 'gallery' && ! $args['in_slider'] ): ?>
			<?php $gallery_filter = etheme_gallery_from_content( get_the_content(null, false, $args['ID']) ); ?>

            <?php if( count( $gallery_filter['ids'] ) > 0 ): ?>
                <div class="swiper-entry et_post-slider arrows-effect-static">
	                <div class="swiper-container slider_id-<?php echo rand( 100, 10000 ); ?>" data-autoheight="1">
            		<?php if ( $post_category ) etheme_primary_category(true); ?>
	                    <div class="swiper-wrapper">
							<?php 
								foreach ( $gallery_filter['ids'] as $attach_id ) {
									echo '<div class="swiper-slide">' . etheme_get_image( $attach_id, $args['size'] ) . '</div>';
								}
							?>
	                    </div>
	                    <div class="swiper-pagination"></div>
	                    <div class="swiper-custom-left"></div>
	                	<div class="swiper-custom-right"></div>
	                </div>
	            </div>
            <?php endif; ?>

		<?php elseif( $post_format == 'video' ): ?>
			<?php etheme_the_post_field( 'video', $args['ID'], $primary_category); ?>

		<?php elseif( $post_format == 'audio' ): ?>
			<?php etheme_the_post_field( 'audio', $args['ID'], $primary_category); ?>

		<?php elseif( has_post_thumbnail($args['ID']) ): ?>
			<?php
				$location = ( $args['in_slider'] ) ? 'slider' : '';
				$hover 	  = ( ! empty( $et_loop['blog_hover'] ) ) ? $et_loop['blog_hover'] : etheme_get_option( 'blog_hover' );
			?>

			<div class="wp-picture blog-hover-<?php echo esc_attr( $hover ); ?>">

				<?php if ( $args['link']): ?>
					<a href="<?php the_permalink($args['ID']); ?>">
						<?php echo etheme_get_image( get_post_thumbnail_id($args['ID']), $args['size'], $location ); ?>
						<?php if ( $location == 'slider' ) etheme_loader( true, 'swiper-lazy-preloader' ); ?>
					</a>
				<?php else: ?>
					<?php echo etheme_get_image( get_post_thumbnail_id($args['ID']), $args['size'], $location ); ?>
					<?php if ( $location == 'slider' ) etheme_loader( true, 'swiper-lazy-preloader' ); ?>
				<?php endif ?>

	            <?php if ( $post_category ) etheme_primary_category(true); ?>

	            <?php if ( (! is_single() || $args['in_slider']) && $hover != 'none' ): ?>
	            	<div class="blog-mask">
	            		<?php if( $post_format != 'quote' ): ?>
	            		<div class="blog-mask-inner">
							<div class="svg-wrapper">
		            			<a href="<?php the_permalink($args['ID']); ?>">
									<svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
										<rect class="shape" height="40" width="150" />
									</svg>
									<span class="btn btn-read-more"><?php esc_html_e( 'Read more', 'xstore' ); ?></span>
								</a>
							</div>
	            		</div>
	            		<?php endif; ?>
	            	</div>
	            <?php endif ?>

                <?php if( $post_format == 'quote' ): ?>
                    <div class="featured-quote">
                        <div class="quote-content">
                            <?php etheme_the_post_field( 'quote', $args['ID'], $primary_category ); ?>
                        </div>
                    </div>
                <?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
	}
}

// **********************************************************************//
// ! Meta data block (byline)
// **********************************************************************//
if( ! function_exists( 'etheme_byline' ) ) {
	function etheme_byline($atts = array() ) {

        extract( shortcode_atts( array(
            'author' => 0,
            'time' => 0,
            'slide_view' => 0,
            'ID' => null,
            'views_counter' => true
        ), $atts ) );
        
        $blog_layout 		   = etheme_get_option( 'blog_layout' );

		?>
        <div class="meta-post">
	        <?php if( ! in_array( $blog_layout , array( 'timeline', 'timeline2', 'grid2' ) ) ): ?>
				<time class="entry-date published updated" datetime="<?php echo get_the_time('F j, Y', $ID); ?>"><?php echo get_the_time(get_option('date_format'), $ID); ?></time>
				
				<?php if ( $time ): ?>
					<?php esc_html_e( 'at', 'xstore' );?>
					<?php echo get_the_time( get_option( 'time_format' ), $ID); ?>
				<?php endif; ?>
				
				<?php if ( $author ): ?>
					<?php esc_html_e( 'by', 'xstore' );?> <?php the_author_posts_link(); ?>
				<?php endif; ?>

			<?php elseif( $slide_view == 'timeline2' ) : ?>
				<?php esc_html_e( 'Posted by', 'xstore' );?> <?php the_author_posts_link(); ?>
	        <?php endif; ?>

         	<?php if ( etheme_get_option( 'views_counter' ) && $views_counter ): ?>
         		<span class="meta-divider">/</span>
            	<?php etheme_get_views( $ID, true ) ?>
     		<?php endif; ?>
        	<?php
            if(comments_open($ID) && ! post_password_required($ID) ) :?>
                <span class="meta-divider">/</span> 
                <?php if ($ID): ?>
                	<?php 
						$comments_number = get_comments_number( $ID );

						if ($comments_number === 0) {
							$comments_number = '<span>0</span>';
						} elseif($comments_number === 1){
							$comments_number = '<span>1</span>';
						} else{
							$comments_number = '<span>' . $comments_number . '</span>';
						}

						printf(
							'<a href="%s" class="post-comments-count">%s</a>',
							get_the_permalink($ID),
							$comments_number

						);
                    ?>
                <?php else: ?>
                	<?php comments_popup_link('<span>0</span>','<span>1</span>','<span>%</span>','post-comments-count'); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
	}
}
// **********************************************************************//
// ! ET loader HTML
// **********************************************************************//
if (!function_exists('etheme_loader')) {
	function etheme_loader($echo = true, $class="") {

		$type   = '';
        if ( defined('ET_CORE_VERSION') ) {
           $type   = Kirki::get_option( 'images_loading_type_et-desktop' );
        }

        if ( ( $type == 'default' || $type == 'lqip' ) && $class != 'no-lqip' ) {
        	return;
        }

		$img = etheme_get_option( 'preloader_images' );

		$html = '';

		if ( ! empty( $img['url'] ) ){
			$html .= '<img class="et-loader-img" src="' . $img['url'] . '" alt="et-loader">';
		} else {
			$html .= '<svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>';
		}

		if ($echo) {
			echo '<div class="et-loader ' . esc_attr( $class ) . '">' . $html .'</div>';
		} else {
			return '<div class="et-loader ' . esc_attr( $class ) . '">' . $html .'</div>';
		}
	}
}


// **********************************************************************//
// ! Site preloader
// **********************************************************************//
if ( ! function_exists('etheme_site_preloader') ) {
	function etheme_site_preloader(){

		$img = etheme_get_option( 'preloader_img' );

		$html = '';

		if ( ! empty( $img['url'] ) ){
			$html .= '<img class="et-loader-img" src="' . $img['url'] . '" alt="et-loader">';
		} else {
			$html .= '<svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>';
		}

		echo '<div class="et-loader">' . $html .'</div>';

	}
}
add_action( 'et_after_body', 'etheme_site_preloader', 100, 1);


// **********************************************************************//
// ! Show navigation
// **********************************************************************//
function etheme_menu( $menu_id = 'main-menu', $type = 'custom_nav' ){
    $custom_menu   = etheme_get_custom_field( $type );
    $one_page_menu = ( etheme_get_custom_field( 'one_page' ) ) ? ' one-page-menu' : '';
    $cache         = etheme_get_option( 'menu_cache' );

	if ( $menu_id == 'mobile-menu' ) {
        $custom_menu_args = array(
            'menu' => $custom_menu,
            'before' => '',
            'container_class' => 'menu-mobile-container' . $one_page_menu,
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 4,
            'fallback_cb' => false,
            'walker' => new ETheme_Navigation_Mobile
        );
        $menu_args = array(
            'container_class' => $one_page_menu,
            'theme_location' => 'mobile-menu',
            'walker' => new ETheme_Navigation_Mobile
        );
    } else {
        $custom_menu_args = array(
            'menu' => $custom_menu,
            'before' => '',
            'container_class' => 'menu-main-container' . $one_page_menu,
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 100,
            'fallback_cb' => false,
            'walker' => new ETheme_Navigation
        );
        $menu_args = array(
            'theme_location' => $menu_id,
            'before' => '',
            'container_class' => 'menu-main-container',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 100,
            'fallback_cb' => false,
            'walker' => new ETheme_Navigation
        );
    }

    if( ! empty( $custom_menu ) && $custom_menu != '' ) {
        etheme_nav_menu( $custom_menu_args, $cache, $menu_id );
    } elseif ( has_nav_menu( $menu_id ) ) {
        etheme_nav_menu( $menu_args, $cache, $menu_id );
	} else {
        printf(
            '<h4 class="a-center">%s <em>%s</em></h4>',
            esc_html__( 'Set your menu in', 'xstore' ),
            esc_html__( 'Appearance &gt; Menus', 'xstore' )
        );
	}
}

function etheme_nav_menu($args, $cache, $menu_id){
    if ( $cache ) {
        $output = false;
        $output = wp_cache_get( $menu_id, 'etheme_' . $menu_id );
        if ( ! $output ) {
            ob_start();
                wp_nav_menu( $args );
                $output = ob_get_contents();
            ob_end_clean();
            wp_cache_add( $menu_id, $output, 'etheme_' . $menu_id );
        }
        echo $output; // All data escaped
    } else {
        wp_nav_menu( $args );
    }
}

// **********************************************************************// 
// ! Pagination links
// **********************************************************************// 
if(!function_exists('etheme_pagination')) {
	function etheme_pagination($args = array()) {
		extract( shortcode_atts( array(
			'type'   => 'default',
			'url'    => '',
			'pages'  => 1,
			'paged'  => 1,
			'range'  => 2,
			'class'  => '',
			'before' => '',
			'after'  => '',
			'prev_next' => true,
			'prev_text' => '<i class="et-icon et-left-arrow"></i>',
			'next_text' => '<i class="et-icon et-right-arrow"></i>'
        ), $args ) );

	    if( $pages != 1 ){
	    	$showitems = ( $range * 2 )+1;
	    	$out = '';

	    	if ( $type != 'default' ) {

	    		if ( ! $url ) {
	    			$url = get_permalink();
	    		}

	    		if( $prev_next && $paged > 1  ){
				 	$out .= '<li><a href="' . add_query_arg( 'et-paged', ( $paged - 1 ), $url ) . '" class="prev page-numbers">' . $prev_text . '</a></li>';
				}


				for ( $i=1; $i <= $pages; $i++ ){
					if ( $pages != 1 &&( ! ( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ){
						if ( $paged == $i ) {
							$out .= '<li><span class="page-numbers current">' . $i . '</span></li>';
						} else {
							$out .= '<li><a href="' . add_query_arg( 'et-paged', $i, $url ) . '" class="inactive">' . $i . '</a></li>';
						}
					}
				}

				if ( $prev_next && $paged < $pages ){
					$out .= '<li><a href="' . add_query_arg( 'et-paged', ( $paged + 1 ), $url ) . '" class="next page-numbers">' . $next_text . '</a></li>';
				}

	    	} else {
	    		if( $prev_next && $paged > 1  ){
			 		$out .= '<li><a href="' . get_pagenum_link($paged-1) . '" class="prev page-numbers">' . $prev_text . '</a></li>';
				}

				for ( $i=1; $i <= $pages; $i++ ){
					if ( $pages != 1 &&( ! ( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ){
						if ( $paged == $i ) {
							$out .= '<li><span class="page-numbers current">' . $i . '</span></li>';
						} else {
							$out .= '<li><a href="' . get_pagenum_link($i) . '" class="inactive">' . $i . '</a></li>';
						}
					}
				}
				
				if ( $prev_next && $paged < $pages ){
					$out .= '<li><a href="' . get_pagenum_link($paged + 1) . '" class="next page-numbers">' . $next_text . '</a></li>';
			}
	    	}

	    	
	        echo '
				<div class="etheme-pagination ' . $class . '">
				' . $before . '
				<nav class="pagination-cubic"><ul class="page-numbers">' . $out . '</ul></nav>
				' . $after . '
				</div>
	        ';
     	}
	}
}

// **********************************************************************//
// ! Display quantity of posts on the page.
// **********************************************************************//
if ( ! function_exists( 'etheme_count_posts' ) ) {

    function etheme_count_posts( $args = array() ) {
        $args = shortcode_atts( array(
            'skip_query'  => false,
            'total'       => 1,
            'first'       => '',
            'last'        => '',
            'echo'        => true
        ), $args );

        if ( $args['skip_query'] ) {
            $total = $args['total'];
            $first = $args['first'];
            $last = $args['last'];
            $out = sprintf(
                esc_html_x(
                    ' %1$d&ndash;%2$d %4$s %3$d posts',
                    '%1$d = first, %2$d = last, %3$d = total',
                    'xstore'
                ),
                $first,
                $last,
                $total,
                esc_html__( 'of', 'xstore' )
            );
        } else {
            global $wp_query;

            $paged    = max( 1, $wp_query->get( 'paged' ) );
            $per_page = $wp_query->get( 'posts_per_page' );
            $total    = $wp_query->found_posts;
            $first    = ( $per_page * $paged ) - $per_page + 1;
            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

            if ( $total == 1 ) {
                $out = esc_html__( 'the single result', 'xstore' );
            } elseif ( $total <= $per_page || -1 === $per_page ) {
                $out = sprintf( '%1$s %2$d %3$s' , esc_html__( 'all', 'xstore' ), $total, esc_html__( 'posts', 'xstore' ) );
            } else {
                 $out = sprintf(
                    esc_html_x(
                        ' %1$d&ndash;%2$d %4$s %3$d posts',
                        '%1$d = first, %2$d = last, %3$d = total',
                        'xstore'
                    ),
                    $first,
                    $last,
                    $total,
                    esc_html__( 'of', 'xstore' )
                );
            }
        }

        if ( $args['echo'] ) {
            return printf( '<p class="et_count-posts">%1$s %2$s</p>', esc_html__( 'Showing', 'xstore' ), $out );
        } else {
            return sprintf( '<p class="et_count-posts">%1$s %2$s</p>', esc_html__( 'Showing', 'xstore' ), $out );
        }
    }
};

// **********************************************************************//
// ! Show Search form
// **********************************************************************//
if(!function_exists('etheme_search_form')) {
    function etheme_search_form( $args = array() ) {
    	extract( wp_parse_args( $args, array(
    		'action' => 'full-width',
    		'class'  => '',
    	) ));

    	$class .= ' act-' . $action;
        ?>
            <div class="header-search <?php echo esc_attr( $class ); ?>">
                <a href="#" class="search-btn"><i class="et-icon et-zoom"></i> <span><?php esc_html_e('Search', 'xstore'); ?></span></a>
               	<div class="search-form-wrapper">
	                <?php get_template_part('woosearchform'); ?>
               	</div>
            </div>
        <?php
    }
}

// **********************************************************************//
// ! Function to display comments
// **********************************************************************//
if(!function_exists('etheme_comments')) {
    function etheme_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        if( get_comment_type() == 'pingback' || get_comment_type() == 'trackback' ) : ?>
            <li id="comment-<?php comment_ID(); ?>" class="pingback">
                <div class="comment-block row">
                    <div class="col-md-12">
                        <div class="author-link"><?php esc_html_e('Pingback:', 'xstore') ?></div>
                        <div class="comment-reply"> <?php edit_comment_link(); ?></div>
                        <?php comment_author_link(); ?>
                    </div>
                </div>
				<div class="media">
					<h4 class="media-heading"><?php esc_html_e('Pingback:', 'xstore') ?></h4>
	                <?php comment_author_link(); ?>
					<?php edit_comment_link(); ?>
				</div>
       	<?php elseif(get_comment_type() == 'comment') :
    		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ); ?>

			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="media">
					<div class="pull-left"><?php echo get_avatar($comment, 80); ?></div>

					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'xstore' ), $rating ) ?>">
							<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%">
								<strong itemprop="ratingValue"><?php echo intval( $rating ); ?></strong> <?php esc_html_e( 'out of 5', 'xstore' ); ?>
							</span>
						</div>
					<?php endif; ?>

					<div class="media-body">
						<h4 class="media-heading"><?php comment_author_link(); ?></h4>
						<div class="meta-comm"><?php comment_date(); ?> - <?php comment_time(); ?></div>

                        <?php if ($comment->comment_approved == '0'): ?>
                            <p class="awaiting-moderation"><?php esc_html__('Your comment is awaiting moderation.', 'xstore') ?></p>
                        <?php endif ?>

                        <?php comment_text(); ?>
                        <?php
                        	comment_reply_link(array_merge(
                    			$args, array('reply_text' => esc_html__('Reply to comment', 'xstore'),
                    			'depth' => $depth, 'max_depth' => $args['max_depth'])
                    		));
                        ?>
					</div>
				</div>
        <?php endif;
    }
}

// **********************************************************************// 
// ! Create products grid by args
// **********************************************************************//
if(!function_exists('etheme_products')) {
    function etheme_products($args,$title = false, $columns = 4, $extra = array() ){
        global $wpdb, $woocommerce_loop;
        $output = '';

        if ( isset($woocommerce_loop['view_mode']) && $woocommerce_loop['view_mode'] == 'list' && $columns > 3) { $columns = 3; }

		if ( isset( $extra['navigation'] ) && $extra['navigation'] != 'off' ){
			$args['no_found_rows'] = false;
			$args['posts_per_page'] = $extra['per-page'];
		} 

        $products = new WP_Query( $args );
        $class = '';

       

        wc_setup_loop( array(
			'columns'      => $columns,
			'name'         => 'product',
			'is_shortcode' => true,
			'total'        => $args['posts_per_page'],
		) );

        if ( $products->have_posts() ) :  
        	if ( wc_get_loop_prop( 'total' ) ) { 
        		if ( $title != '' ) {
		        	echo '<h2 class="products-title"><span>' . esc_html( $title ) . '</span></h2>';
		        }
        	?>
            <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                   <?php $output .= wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>
                
            <?php woocommerce_product_loop_end(); ?>
            <?php } ?>
        <?php endif;

        wp_reset_postdata();
        wc_reset_loop();

        // ! Do it for load more button
		if ( isset( $extra['navigation'] ) && $extra['navigation'] != 'off' ) {
			if ( $products->max_num_pages > 1 && $extra['limit'] > $extra['per-page'] ) {
				$attr = 'paged="1"';
				$attr .= ' max-paged="' . $products->max_num_pages . '"';

				if ( isset( $extra['limit'] ) && $extra['limit'] != -1 ) {
					$attr .= ' limit="' . $extra['limit'] . '"';
				}

				$ajax_nonce = wp_create_nonce( 'etheme_products' );

				$attr .= ' nonce="' . $ajax_nonce . '"';

				$loader = etheme_loader(false);
				$type = ( $extra['navigation'] == 'lazy' ) ? 'lazy-loading' : 'button-loading';

		        $output .= '
		        <div class="et-load-block text-center et_load-products ' . $type . '">
		        	' . $loader . '
		        	<span class="btn">
		        		<a ' . $attr . '>' . esc_html__( 'Load More', 'xstore' ) . '</a>
		        	</span>
		        </div>';
			}
		}
		return $output;
    }
}



if( wp_doing_ajax() ){
	add_action( 'wp_ajax_etheme_ajax_products', 'etheme_ajax_products');
	add_action( 'wp_ajax_nopriv_etheme_ajax_products', 'etheme_ajax_products');
}

if(!function_exists('etheme_ajax_products')) {
    function etheme_ajax_products( $args = array() ){
    	if( isset( $_POST['_wpnonce'] ) ) return;
    	if( $_POST['context'] !== 'frontend' ) return;

    	global $wpdb, $woocommerce_loop;

    	$attr = array();
    	$attr = $_POST['attr'];
        $output = '';
        $args = Array(
		    'post_type' => 'product',
		    'ignore_sticky_posts' => 1,
		    'no_found_rows' => 1,
		    'posts_per_page' => $attr['per-page'],
		    'paged' => $attr['paged'],
		    'orderby' =>'', 
		    'order' => 'ASC',
		);

        if ( $attr['orderby'] ) {
    		$args['orderby'] = $attr['orderby'];
    	} else {
    		$args['orderby'] = '';
    	}

    	if ( $attr['order'] ) {
    		$args['order'] = $attr['order'];
    	} else {
    		$args['order'] = 'ASC';
    	}

    	if ( isset( $attr['stock'] ) ) {
            $args['meta_query'] = array(
                array (
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '='
                ),
            );
        }

        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'hidden',
            'operator' => 'NOT IN',
       	 );

        if (  isset( $attr['type'] ) ) {
        	switch ($attr['type']) {
	        	case 'featured':
			          	$args['tax_query'][] = array(
			              'taxonomy' => 'product_visibility',
			              'field'    => 'name',
			              'terms'    => 'featured',
			              'operator' => 'IN',
			          );
	        		break;
	        	case 'bestsellings':
			          	$args['meta_key'] = 'total_sales';
	            		$args['orderby'] = 'meta_value_num';
	        		break;
	        	default:

	        		break;
	        }
        }

        if ($attr['orderby'] == 'price') {
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
        }

    	if ( isset($attr['ids']) ) {
    		$ids = explode( ',', $attr['ids'] );
    		$ids = array_map('trim', $ids);
    		$args['post__in'] = $ids;
    	}

    	// Narrow by categories
        if( ! empty( $attr['taxonomies'] ) ) {
            $taxonomy_names = get_object_taxonomies( 'product' );
            $terms = get_terms( $taxonomy_names, array(
                'orderby' => 'name',
                'include' => $attr['taxonomies']
            ));

            if( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                $args['tax_query'] = array('relation' => 'OR');
                foreach ($terms as $key => $term) {
                    $args['tax_query'][] = array(
                        'taxonomy' => $term->taxonomy,
                        'field' => 'slug',
                        'terms' => array( $term->slug ),
                        'include_children' => true,
                        'operator' => 'IN'
                    );
                }
            }
        }

        $products = new WP_Query( $args );
        $class = '';

        wc_setup_loop( array(
			'columns'      => $attr['columns'],
			'name'         => 'product',
			'is_shortcode' => true,
			'total'        => $args['posts_per_page'],
		) );

		if ( isset( $attr['limit'] ) ) {
			$_i = 0;
		}

		if ( isset($attr['product_view']) )
			$woocommerce_loop['product_view'] = $attr['product_view'];
		if ( isset($attr['custom_template']) )
			$woocommerce_loop['custom_template'] = $attr['custom_template'];
		if ( isset($attr['product_view_color']) )
			$woocommerce_loop['product_view_color'] = $attr['product_view_color'];
		if ( isset($attr['hover']) )
			$woocommerce_loop['hover'] = $attr['hover'];
		if ( isset($attr['show_counter']) )
			$woocommerce_loop['show_counter'] = $attr['show_counter'];
		if ( isset($attr['show_stock']) )
			$woocommerce_loop['show_stock'] = $attr['show_stock'];

		$woocommerce_loop['loading_class'] = 'productAnimated product-fade';

        if ( $products->have_posts() ) :  
        	if ( wc_get_loop_prop( 'total' ) ) { 

        	?>
            <?php woocommerce_product_loop_start(false); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                	<?php
                	if ( isset( $attr['limit'] ) ) {
                		if ( $_i >= $attr['limit'] ) {
                			break;
                		}
                		$_i++;
                	}
                	?>

                   <?php $output .= wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>
                
            <?php woocommerce_product_loop_end(false); ?>
            <?php } ?>
        <?php endif;

        if ( isset($woocommerce_loop['product_view']) )
			unset($woocommerce_loop['product_view']);
		if ( isset($woocommerce_loop['custom_template']) )
			unset($woocommerce_loop['custom_template']);
		if ( isset($woocommerce_loop['product_view_color']) )
			unset($woocommerce_loop['product_view_color']);
		if ( isset($woocommerce_loop['hover']) )
			unset($woocommerce_loop['hover']);
		if ( isset($woocommerce_loop['show_counter']) )
			unset($woocommerce_loop['show_counter']);
		if ( isset($woocommerce_loop['show_stock']) )
			unset($woocommerce_loop['show_stock']);

        unset($woocommerce_loop['loading_class']);

        wp_reset_postdata();
        wc_reset_loop();

        echo $output; // All data escaped

		die();
    }
}

if( ! function_exists( 'etheme_fullscreen_products' ) ) {
	function etheme_fullscreen_products( $args, $slider_args = array() ) {
		global $woocommerce_loop;

		extract($slider_args);

		ob_start();

		$products = new WP_Query( $args );

		$images_slider_items = array();

		if ( $products->have_posts() ) : ?>

			<div class="et-full-screen-products <?php echo esc_attr( $class ); ?>">
				<div class="et-products-info-slider swiper-container">
					<div class="swiper-wrapper">
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
							<div class="et-product-info-slide swiper-slide swiper-no-swiping">
								<div class="product-info-wrapper">
									<p class="product-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</p>

									<?php

										woocommerce_template_single_rating();

										woocommerce_template_single_price();

										woocommerce_template_single_excerpt();

										if( isset($woocommerce_loop['show_counter']) ) etheme_product_countdown(); 

										woocommerce_template_loop_add_to_cart();

										if( get_option('yith_wcwl_button_position') == 'shortcode' ) {
											etheme_wishlist_btn();
										}

										if ( isset($woocommerce_loop['show_stock']) && 'yes' === get_option( 'woocommerce_manage_stock' ) ) {
				                            $id = get_the_ID();
				                            $product = wc_get_product($id);
				                            echo et_product_stock_line($product);
				                    	}

										woocommerce_template_single_meta();

										if(etheme_get_option('share_icons')): ?>
											<div class="product-share">
												<?php echo do_shortcode('[share title="'.__('Share: ', 'xstore').'" text="'.get_the_title().'"]'); ?>
											</div>
										<?php endif;?>
								</div>
							</div>

							<?php
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
								$images_slider_items[] = '<div class="et-product-image-slide swiper-slide swiper-no-swiping" style="background-image: url(' . $image[0] . ');"></div>';
							?>

						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
				<div class="et-products-images-slider swiper-container">
					<div class="swiper-wrapper">
						<?php echo implode( '', array_reverse( $images_slider_items) ); ?>
					</div>
					<div class="et-products-navigation">
						<div class="et-swiper-next">
							<span class="swiper-nav-title"></span>
							<span class="swiper-nav-price"></span>
							<span class="swiper-nav-arrow et-icon et-up-arrow"></span>
						</div>
						<div class="et-swiper-prev">
							<span class="swiper-nav-arrow et-icon et-down-arrow"></span>
							<span class="swiper-nav-title"></span>
							<span class="swiper-nav-price"></span>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var slidesCount = $('.et-product-info-slide').length;

					var infoSwiper = new Swiper('.et-products-info-slider', {
						pagination: {
	                        clickable : true
	                    },
						direction: 'vertical',
						slidesPerView: 1,
						initialSlide: slidesCount,
						// simulateTouch: false, 
						noSwiping: true,
						loop: true,
						on : {
							init: function(swiper) {
								updateNavigation();
							}
						}
					});

					var imagesSwiper = new Swiper('.et-products-images-slider', {
						direction: 'vertical',
						slidesPerView: 1,
						loop: true,
						// simulateTouch: false, 
						noSwiping: true,
						navigation: {
							nextEl: '.et-products-navigation .et-swiper-next',
                        	prevEl: '.et-products-navigation .et-swiper-prev',
						},
						pagination: {
	                        clickable : true
	                    },
	                    on : {	
	                    	slideNextTransitionStart: function(swiper) {
								infoSwiper.slidePrev();
								updateNavigation();
							},
							slidePrevTransitionStart: function(swiper) {
								infoSwiper.slideNext();
								updateNavigation();
							}
	                    }
					});

					function updateNavigation() {
						var $nextBtn = $('.et-products-navigation .et-swiper-next'),
							$prevBtn = $('.et-products-navigation .et-swiper-prev'),
							currentIndex = $('.et-product-info-slide.swiper-slide-active').data('swiper-slide-index'),
							prevIndex = ( currentIndex >= slidesCount - 1 ) ? 0 : currentIndex + 1,
							nextIndex = ( currentIndex <= 0 ) ? slidesCount - 1 : currentIndex - 1,
							$nextProduct = $('.et-product-info-slide[data-swiper-slide-index="' + nextIndex + '"]'),
							nextTitle = $nextProduct.find('.product-title a').first().text(),
							nextPrice = $nextProduct.find('.price').html(),
							$prevProduct = $('.et-product-info-slide[data-swiper-slide-index="' + prevIndex + '"]'),
							prevTitle = $prevProduct.find('.product-title a').first().text(),
							prevPrice = $prevProduct.find('.price').html();

						$nextBtn.find('.swiper-nav-title').text(nextTitle);
						$nextBtn.find('.swiper-nav-price').html(nextPrice);

						$prevBtn.find('.swiper-nav-title').text(prevTitle);
						$prevBtn.find('.swiper-nav-price').html(prevPrice);
					}
				<?php if( isset($woocommerce_loop['show_counter']) ) : ?>
					etTheme.countdown(); // refresh product timers
				<?php endif; ?>
				});
			</script>

		<?php endif;
		wp_reset_postdata();
		return ob_get_clean();
	}
}

// **********************************************************************//
// ! Site breadcrumbs
// **********************************************************************//
if(!function_exists('etheme_breadcrumbs')) {
    function etheme_breadcrumbs() {
    	get_template_part( 'templates/breadcrumbs' );

		return;
    }
}

if(!function_exists('etheme_back_to_page')) {
    function etheme_back_to_page() {
        echo '<a class="back-history" href="javascript: history.go(-1)">' . esc_html__( 'Return to previous page', 'xstore' ) . '</a>';
    }
}


// **********************************************************************//
// ! Back to top button
// **********************************************************************//
if(!function_exists('etheme_btt_button')) {
	function etheme_btt_button() {
		get_template_part( 'templates/btt-button' );

		return;
	}
}

add_action('after_page_wrapper', 'etheme_btt_button');


// **********************************************************************//
// ! Promo Popup
// **********************************************************************//
add_action('after_page_wrapper', 'etheme_promo_popup');
if(!function_exists('etheme_promo_popup')) {
    function etheme_promo_popup() {
    	get_template_part( 'templates/promo-popup' );

		return;
    }
}

// **********************************************************************//
// ! Show secondary menu 
// **********************************************************************//

if ( ! function_exists('et_show_secondary_menu') ) {
	function et_show_secondary_menu () {
		if ( has_nav_menu( 'secondary' ) && etheme_get_option( 'secondary_menu' ) ): ?>
            <div class="secondary-menu-wrapper">
                <div class="secondary-title">
                    <div class="secondary-menu-toggle">
                        <span class="et-icon et-burger"></span>
                    </div>
                    <?php etheme_option('all_departments_text'); ?>
                </div>
                <?php etheme_menu( 'secondary', 'secondary' ); ?>
            </div>
       <?php endif;
	}
}

// **********************************************************************//
// ! Show shop navbar
// **********************************************************************//
if( ! function_exists( 'etheme_shop_navbar' ) ) {
    function etheme_shop_navbar( $location = 'header', $exclude = array() ) {
		ob_start();
			if ( ! in_array( 'account', $exclude ) && etheme_get_option( 'top_links' ) == $location ) {
				etheme_sign_link( '','', true );
			}
			if ( ! in_array( 'search', $exclude ) && etheme_get_option( 'search_form' ) == $location ) {
				etheme_search_form();
			}
			if ( ! in_array( 'wishlist', $exclude ) && etheme_woocommerce_installed() && etheme_get_option( 'top_wishlist_widget' ) == $location ) {
				etheme_wishlist_widget();
			}
			if ( ! in_array( 'cart', $exclude ) && etheme_woocommerce_installed() && ! etheme_get_option( 'just_catalog' ) && etheme_get_option( 'cart_widget' ) == $location ) {
				etheme_top_cart();
			}
		$html = ob_get_clean();

		if ( !empty($html) ) {

			do_action( 'etheme_before_shop_navbar' );
			echo '<div class="navbar-header show-in-' . $location . '">' . $html . '</div>';
			do_action( 'etheme_after_shop_navbar' );
    	
    	}
    }
}

if( ! function_exists( 'etheme_primary_category' ) ) {
    function etheme_primary_category( $echo = false ) {
        $primary = false;
        $cat = etheme_get_custom_field('primary_category');
        if(!empty($cat) && $cat != 'auto') {
            $primary = get_term_by( 'slug', $cat, 'category' );
        } else {
            $cats = wp_get_post_categories(get_the_ID());
            if( isset($cats[0]) ) {
                $primary = get_term_by( 'id', $cats[0], 'category' );
            }
        }
        if( $primary ) {
            $term_link = get_term_link( $primary );
            if ( $echo ) {
                echo '<div class="post-categories"><a href="' . esc_url( $term_link ) . '">' . $primary->name . '</a></div>';
            } else {
                return '<div class="post-categories"><a href="' . esc_url( $term_link ) . '">' . $primary->name . '</a></div>';
            }
        }
    }
}

// **********************************************************************// 
// ! Bordered layout
// **********************************************************************//
if(!function_exists('etheme_bordered_layout')) {
    function etheme_bordered_layout() {

        if(etheme_get_option('main_layout') != 'bordered') return;

        ?>
            <div class="body-border-left"></div>
            <div class="body-border-top"></div>
            <div class="body-border-right"></div>
            <div class="body-border-bottom"></div>
        <?php
    }
    add_action('et_after_body', 'etheme_bordered_layout');
}

// **********************************************************************// 
// ! Hook photoswipe tempalate to the footer
// **********************************************************************// 
add_action('after_page_wrapper', 'etheme_photoswipe_template', 30);
if( ! function_exists( 'etheme_photoswipe_template' ) ) {
    function etheme_photoswipe_template() {
        get_template_part( 'templates/photoswipe' );

		return;
    }
}

add_action('after_page_wrapper', 'et_notify', 40);
if ( !function_exists('et_notify') ) {
	function et_notify() { ?>
		<div class="et-notify" data-type=""></div>
	<?php }
}

// **********************************************************************//
// ! WC Marketplace fix
// **********************************************************************//
if ( class_exists( 'WCMp_Ajax' ) ) add_action( 'wp_head', 'single_product_multiple_vendor_class' );
if ( ! function_exists( 'single_product_multiple_vendor_class' ) ) :
   function single_product_multiple_vendor_class(){
        ?>
        <script type="text/javascript">
            var themeSingleProductMultivendor = '#content_tab_singleproductmultivendor';
        </script>
        <?php
    }
endif;


if( ! function_exists( 'etheme_the_post_field' ) ) {
	function etheme_the_post_field( $field = false, $id = null, $html = '' ){
		if ( ! $field ) return;

		$data = etheme_get_custom_field( 'post_' . $field, $id );

		if ( empty( $data ) ) return;

		switch ( $field ) {
			case 'video':
				$embed =  VideoUrlParser::get_url_embed( $data );
				if( ! empty( $embed ) ){
					echo '
						<div class="featured-' . $field . '">' . $html . '
							<iframe width="100%" height="560" src="' . $embed . '" frameborder="0" allowfullscreen></iframe>
						</div>
					';
				} 
				break;
			case 'audio':
				echo '<div class="featured-' . $field . '">' . $html . do_shortcode( $data ) . '</div>';
				break;
			case 'quote':
				echo do_shortcode( $data );
				break;
			default:
				return;
				break;
		}
	}
}

// **********************************************************************//
// ! etheme slider
// **********************************************************************//
if( ! function_exists( 'etheme_slider' ) ) {
	function etheme_slider( $args, $type = 'post', $atts = array() ) {
	    // ! Slider args
	    $slider_atts = array(
	        'title'              => false,
	        'before'             => '',
	        'after'              => '',
	        'wrapper_class'		 => '',
	        'class'              => '',
	        'attr'               => '',
	        'echo'               => false,
	        'large'              => 4,
	        'notebook'           => 4,
	        'tablet_land'        => 3,
	        'tablet_portrait'    => 2,
	        'mobile'             => 2,
	        'slider_autoplay'    => 'no',
	        'slider_speed'       => 300,
	        'slider_interval'    => 1000,
	        'slider_stop_on_hover' => false,
	        'slider_loop'        => false,
	        'autoheight'         => true,
	        'pagination_type'    => 'hide',
	        'default_color'      => '#e6e6e6',
	        'active_color'       => '#b3a089',
	        'hide_fo'            => '',
	        'hide_buttons'       => false,
	        'hide_buttons_for'	 => '',
	        'size'               => 'shop_catalog',
	        'per_move'           => 1,
	        // ! blog args
	        'slide_view'         => '',
	        'hide_img' => false,
	        'blog_align'         => '',
	        'blog_hover'		 => 'zoom',
	        // ! Products args 
	        'block_id'           => false,
	        'style'              => 'default',
	        'product_view'       => '',
	        'product_view_color' => '',
	        'no_spacing'         => '',
	        'shop_link'          => false,
	        'slider_type'        => false,
	        'from_first'         => '',
	        'widget'             => false,
	        'is_preview'		 => false
	    );

	    extract( shortcode_atts( $slider_atts, $atts ) );

	    $box_id      = rand( 1000, 10000 );
	    $multislides = new WP_Query( $args );
	    $loop = $slide_class = $html = '';

        if ( $slider_stop_on_hover ) 
        	$class .= ' stop-on-hover';

	    if ( $type == 'post' ) {
	        global $et_loop;
	        $et_loop['slider']      = true;
	        $et_loop['blog_layout'] = 'default';
	        $et_loop['size']        = $size;
	        $et_loop['hide_img'] = $hide_img;
	        $et_loop['blog_hover'] = $blog_hover;
	        $et_loop['slide_view']  = $slide_view;
	        $et_loop['blog_align']  = $blog_align;
	        $class .= ' posts-slider';
	    } else {
	        if( ! class_exists( 'Woocommerce' ) ) return;
	        global $woocommerce_loop;
	        $woocommerce_loop['size'] = $size;

	        if( ! $slider_type ) {
	            $woocommerce_loop['lazy-load'] = true;
	            $woocommerce_loop['style'] = $style;
	        }
        	$product_view = etheme_get_option('product_view');
			if( !empty($woocommerce_loop['product_view'])) {
			    $product_view = $woocommerce_loop['product_view'];
			}

			$custom_template = etheme_get_option('custom_product_template');
			if( !empty($woocommerce_loop['custom_template'])) {
			    $custom_template = $woocommerce_loop['custom_template'];
			}

	        $block = '';
	        $class .= ' products-slider';
	        
	        $slide_class .= ' slide-item product-slide ';
	        $slide_class .= $slider_type . '-slide';

	        if( $no_spacing == 'yes' ) $slide_class .= ' item-no-space';

	        if( $block_id && $block_id != '' && etheme_static_block( $block_id, false ) != '' ) {
	            ob_start();
	                echo '<div class="slide-item '.$slider_type.'-slide">';
	                    etheme_static_block($block_id, true);
	                echo '</div><!-- slide-item -->';
	            $block = ob_get_contents();
	            ob_end_clean();
	        }
	    }

	    if ( $multislides->have_posts() ) {
	    	if ( $type == 'post' ) {
	    		add_filter( 'excerpt_length', 'etheme_excerpt_length_sliders', 1000 );
	    	}
	        $autoheight = ( $autoheight ) ? 'data-autoheight="1"' : '';
	        $lines = ( $pagination_type == 'lines' ) ? 'swiper-pagination-lines' : '';
	        $slider_speed = ( $slider_speed ) ? 'data-speed="' . $slider_speed . '"' : '';
	        
	        if ( $slider_autoplay ) $slider_autoplay = $slider_interval;
	        if ( $autoheight ) $autoheight = 'data-autoheight="1"';
	        if ( $slider_loop ) $loop = ' data-loop="true"';
	       
	        $html .= '<div class="swiper-entry '.$wrapper_class.'">';
	            $html .= $before;

	            $html .= ( $title ) ? '<h3 class="title"><span>' . $title . '</span></h3>' : '';

    			if ( $type == 'product' && $product_view == 'custom' && $custom_template != '' ) { 
					$class  .= ' products-with-custom-template products-template-'.$custom_template;
					$attr .= ' data-post-id="'.$custom_template.'"';
				}

	            $html .='
	                <div
	                    class="swiper-container carousel-area ' . $class . ' slider-' . $box_id . ' ' . $lines . '"
	                    data-breakpoints="1"
	                    data-xs-slides="' . esc_js( $mobile ) . '"
	                    data-sm-slides="' . esc_js( $tablet_land ) . '"
	                    data-md-slides="' . esc_js( $notebook ) . '"
	                    data-lt-slides="' . esc_js( $large ) . '"
	                    data-slides-per-view="' . esc_js( $large ) . '"
	                    ' . $autoheight . '
	                    data-slides-per-group="' . esc_attr( $per_move ). '"
	                    data-autoplay="' . esc_attr( $slider_autoplay ) . '"
	                    ' . $slider_speed . ' ' . $loop . ' ' . $attr . '
	                >
	            ';

	                $html .= '<div class="swiper-wrapper">';
	                    $_i=0;

	                    while ( $multislides->have_posts() ) : $multislides->the_post();
	                        $_i++;
	                        ob_start();

	                        if ( $type == 'product' ) {

	                            global $product;

	                            if( ( $from_first == 'no' && $_i ==  2) || ( $from_first != 'no' && $_i == 1 ) ) {
	                                echo $block; // All data escaped 
	                            }
	                            
	                            if ( ! $product->is_visible() ) continue;

	                            if ( $widget ) {
	                                wc_get_template_part( 'content', 'widget-product-slider' );
	                            } else {
	                                echo '<div class="swiper-slide' . esc_attr( $slide_class ) . '">';
	                                    wc_get_template_part( 'content', 'product-slider' );
	                                echo '</div>';
	                            }
	 
	                        } else {
	                            echo '<div class="swiper-slide' . esc_attr( $slide_class ) . '">';
	                                get_template_part( 'content', 'grid' );
	                            echo '</div>';
	                        }

	                        $html .= ob_get_clean();
	                    endwhile;
	                $html .= '</div><!-- slider wrapper-->';

	                if ( $pagination_type != 'hide' ) {
	                	$pagination_class = '';
	                	if ( $hide_fo == 'desktop' ) 
	                		$pagination_class = ' dt-hide';
	                	elseif ( $hide_fo == 'mobile' ) 
	                		$pagination_class = ' mob-hide';
	                    $html .= '
	                    <div class="swiper-pagination etheme-css '.$pagination_class.'"
	                        data-css="
	                            .slider-'.$box_id.' .swiper-pagination-bullet{background-color:'.$default_color.'; '. $lines.';}
	                            .slider-'.$box_id.' .swiper-pagination-bullet:hover{ background-color:'.$active_color.'; }
	                            .slider-'.$box_id.' .swiper-pagination-bullet-active{ background-color:'.$active_color.'; }
	                        "
	                    >
	                    </div>';
	                }
	            $html .= '</div><!-- slider container-->';

	            if ( ! $hide_buttons || ( $hide_buttons && $hide_buttons_for != '' ) ) {
                	$navigation_class = '';
                	if ( $hide_buttons_for == 'desktop' ) 
                		$navigation_class = ' dt-hide';
                	elseif ( $hide_buttons_for == 'mobile' ) 
                		$navigation_class = ' mob-hide';

	                $html .= '
	                    <div class="swiper-button-prev swiper-custom-left ' . $navigation_class . '"></div>
	                    <div class="swiper-button-next swiper-custom-right ' . $navigation_class . '"></div>
	                ';
	            }

	            $html .= $after;
	        $html .= '</div><div class="clear"></div><!-- slider-entry -->';
	        if ( $type == 'post' ) {
	    		remove_filter( 'excerpt_length', 'etheme_excerpt_length_sliders', 1000 );
	    	}
	    };

	    if ( $type == 'post' ) {
	        unset( $et_loop );
	        wp_reset_postdata();
	    } else {
	        wp_reset_query();
	        unset( $woocommerce_loop['lazy-load'] );
	        unset( $woocommerce_loop['style'] );
	    }

	    if ( $is_preview ) 
        	$html .= '<script>jQuery(document).ready(function(){ etTheme.global_image_lazy(); etTheme.addSwiperLazy(); etTheme.swiperFunc(); }); </script>';


	    if ( $echo ) {
	        echo $html; // All data escaped
	    } else {
	        return $html;
	    }
	}
}










add_action( 'wp', 'etheme_modify_search_page', 9 );


function etheme_modify_search_page(){

	if ( ( isset( $_GET['et_result'] ) && $_GET['et_result'] == 'products' ) || ! is_search() || !class_exists('WooCommerce') || ! get_query_var('etheme_header_builder', true) ) {
		return;
	}

	$search_content = etheme_get_option( 'search_results_content_et-desktop' );

	$search_aditional = etheme_get_option('search_page_custom_area_position_et-desktop');

	if ( ! is_array( $search_content ) ) {
		return;
	}

	if ( is_search() && $search_aditional != 'none' ) {

	   	$custom_area = etheme_get_option('search_page_custom_area');
	   	$search_section = etheme_get_option('search_page_sections');
	   	if ( $search_section ) {

	   		$custom_area = etheme_static_block( etheme_get_option('search_page_section') );
	   	}

	   	if ( $search_aditional == 'before' ) {
	   		add_action('etheme_before_product_loop_start', function($out) use($custom_area){
	   			echo do_shortcode( $custom_area );
	   			return;
	   		}, 5);
	   	} else {
	   		add_action('etheme_after_product_loop_end', function($out) use($custom_area){
	   			echo do_shortcode( $custom_area );
	   			return;
	   		}, 15);
	   	}
	}

	if ( in_array('products', $search_content) && woocommerce_product_loop() ) {
		add_action( 'etheme_before_product_loop_start', function(){
			echo '<h2 class="products-title"><span>' . esc_html__( 'Products found', 'xstore' ) .  '</span></h2>';
		}, 20 );
	}
	


	$i = 10;
	foreach ( $search_content as $key => $value ) {
	    if ( $value == 'products' && woocommerce_product_loop() ) {
	    	$i = 20;
	    } elseif( $value != 'products' ) {
	    	if ($i == 10) {
	    		if ( in_array($value, $search_content) ) {
		    		add_action('etheme_before_product_loop_start','etheme_' . $value . '_in_search_results', $key + 10);
	    		}
		    } else {
		    	if ( in_array($value, $search_content) ) {
		    		add_action('etheme_after_product_loop_end','etheme_' . $value . '_in_search_results', $key + 10);
	    		}
		    }
	    }
	}
}

function etheme_pages_in_search_results(){
    if(!is_search()) return;
    global $post;

    ?>
    <?php if( get_search_query() ) : ?>
	<?php
      $args = array(
                's'                   => get_search_query(),
                'post_type'           => 'page',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                // 'posts_per_page'      => 50,
                'orderby'             => '',
		        // 'post_type'           => array(),
		        // 'post_status'         => 'publish',
		        'posts_per_page'      => 50,
		        // 'ignore_sticky_posts' => 1,
		        'post_password'       => '',
		        // 'suppress_filters'    => false,
            );

            $posts = get_posts( $args );
            $box_id      = rand( 1000, 10000 );

            if ( count($posts) ) {
    			remove_action('woocommerce_no_products_found', 'wc_no_products_found', 10);

                echo '<h2 class="products-title"><span>' . esc_html__( 'Pages found', 'xstore' ) .  '</span></h2>';

                echo '<div class="swiper-entry"><div
                        class="swiper-container posts-slider carousel-area slider-' . $box_id . '"
                        data-breakpoints="1"
                        data-xs-slides="1"
                        data-sm-slides="2"
                        data-md-slides="3"
                        data-lt-slides="3"
                        data-slides-per-view="3"
                    >';
                        echo '<div class="swiper-wrapper">';
                               foreach ($posts as $key => $value) {
									
									$postClass      = etheme_post_class( 'grid' );
									$postClass[] = 'col-md-6';

                                    echo '<div class="swiper-slide">';
                                ?>
                                <article <?php post_class( $postClass ); ?> id="post-<?php echo esc_attr( $value->ID ); ?>">
                                    <div>

                                          <?php if ( ! empty( $et_loop['slide_view'] ) && $et_loop['slide_view'] == 'timeline2' ): ?>
                                            <div class="meta-post-timeline">
                                                <span class="time-day"><?php the_time('d'); ?></span>
                                                <span class="time-mon"><?php the_time('M'); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        $excerpt_length = etheme_get_option('excerpt_length');
                                       etheme_post_thumb( array('size' => 'shop_catalog', 'in_slider' => true, 'ID' => $value->ID) ); 

                                       ?>

                                        <div class="grid-post-body">
                                            <div class="post-heading">
                                                <h2><a href="<?php the_permalink($value->ID); ?>"><?php echo esc_html( $value->post_title ); ?></a></h2>
                                                <?php if(etheme_get_option('blog_byline')): ?>
                                                    <?php etheme_byline( array( 'author' => 0, 'ID' => $value->ID, 'views_counter' => false ) );  ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="content-article">
                                                <?php etheme_read_more( get_the_permalink($value->ID), true ) ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <?php
                                    echo '</div>';
                               }

                        echo '</div><!-- slider wrapper-->';
                   echo '</div>';
                   echo '<div class="swiper-button-prev swiper-custom-left"></div>
	                    <div class="swiper-button-next swiper-custom-right"></div>';
                   echo '</div><div class="clear"></div><!-- slider-entry -->';
                }
    ?>
    <?php endif; ?>

    <?php
}

function etheme_portfolio_in_search_results(){
    if(!is_search()) return;
    global $post;

    ?>
    <?php if( get_search_query() ) : ?>
	<?php
      $args = array(
                's'                   => get_search_query(),
                'post_type'           => 'etheme_portfolio',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                // 'posts_per_page'      => 50,
                'orderby'             => '',
		        // 'post_type'           => array(),
		        // 'post_status'         => 'publish',
		        'posts_per_page'      => 50,
		        // 'ignore_sticky_posts' => 1,
		        'post_password'       => '',
		        // 'suppress_filters'    => false,
            );

            $posts = get_posts( $args );
            $box_id      = rand( 1000, 10000 );

            if ( count($posts) ) {
    			remove_action('woocommerce_no_products_found', 'wc_no_products_found', 10);

                echo '<h2 class="products-title"><span>' . esc_html__( 'Portfolio found', 'xstore' ) .  '</span></h2>';

                echo '<div class="swiper-entry"><div
                        class="swiper-container posts-slider carousel-area slider-' . $box_id . '"
                        data-breakpoints="1"
                        data-xs-slides="1"
                        data-sm-slides="2"
                        data-md-slides="3"
                        data-lt-slides="3"
                        data-slides-per-view="3"
                    >';
                        echo '<div class="swiper-wrapper">';
                               foreach ($posts as $key => $value) {
									
									$postClass      = etheme_post_class( 'grid' );
									$postClass[] = 'col-md-6';

                                    echo '<div class="swiper-slide">';
                                ?>
                                <article <?php post_class( $postClass ); ?> id="post-<?php echo esc_attr( $value->ID ); ?>">
                                    <div>

                                          <?php if ( ! empty( $et_loop['slide_view'] ) && $et_loop['slide_view'] == 'timeline2' ): ?>
                                            <div class="meta-post-timeline">
                                                <span class="time-day"><?php the_time('d'); ?></span>
                                                <span class="time-mon"><?php the_time('M'); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        $excerpt_length = etheme_get_option('excerpt_length');
                                       etheme_post_thumb( array('size' => 'shop_catalog', 'in_slider' => true, 'ID' => $value->ID) ); 

                                       ?>

                                        <div class="grid-post-body">
                                            <div class="post-heading">
                                                <h2><a href="<?php the_permalink($value->ID); ?>"><?php echo esc_html( $value->post_title ); ?></a></h2>
                                                <?php if(etheme_get_option('blog_byline')): ?>
                                                    <?php etheme_byline( array( 'author' => 0, 'ID' => $value->ID, 'views_counter' => false ) );  ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="content-article">
                                                <?php etheme_read_more( get_the_permalink($value->ID), true ) ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <?php
                                    echo '</div>';
                               }

                        echo '</div><!-- slider wrapper-->';
                   echo '</div>';
                   echo '<div class="swiper-button-prev swiper-custom-left"></div>
	                    <div class="swiper-button-next swiper-custom-right"></div>';
                   echo '</div><div class="clear"></div><!-- slider-entry -->';
                }
    ?>
    <?php endif; ?>

    <?php
}

function etheme_posts_in_search_results(){
    if(!is_search()) return;
    global $post;
    ?>
    <?php if( get_search_query() ) : ?>
	<?php
      // wp_reset_postdata();
      $args = array(
                's'                   => get_search_query(),
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => 50,
            );

            $posts = get_posts( $args );
            $box_id      = rand( 1000, 10000 );

               // echo '<h4>' . esc_html__( 'Posts found', 'xstore' ) .  '</h4>';
			if ( count($posts) ) {
				remove_action('woocommerce_no_products_found', 'wc_no_products_found', 10);
                echo '<h2 class="products-title"><span>' . esc_html__( 'Posts found', 'xstore' ) . '</span></h2>';

               echo '<div class="swiper-entry"><div
                        class="swiper-container posts-slider carousel-area slider-' . $box_id . '"
                        data-breakpoints="1"
                        data-xs-slides="1"
                        data-sm-slides="2"
                        data-md-slides="3"
                        data-lt-slides="3"
                        data-slides-per-view="3"
                    >';
                        echo '<div class="swiper-wrapper">';
                               foreach ($posts as $key => $value) {

                                    $postClass      = etheme_post_class( 'grid' );

                                    $postClass[] = 'col-md-6';

                                    echo '<div class="swiper-slide">';
                                ?>
                                <article <?php post_class( $postClass ); ?> id="post-<?php echo esc_attr( $value->ID ); ?>">
                                    <div>

                                          <?php if ( ! empty( $et_loop['slide_view'] ) && $et_loop['slide_view'] == 'timeline2' ): ?>
                                            <div class="meta-post-timeline">
                                                <span class="time-day"><?php the_time('d'); ?></span>
                                                <span class="time-mon"><?php the_time('M'); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        $excerpt_length = etheme_get_option('excerpt_length');
                                       etheme_post_thumb( array('size' => 'shop_catalog', 'in_slider' => true, 'ID' => $value->ID) ); 

                                       ?>

                                        <div class="grid-post-body">
                                            <div class="post-heading">
                                                <h2><a href="<?php the_permalink($value->ID); ?>"><?php echo esc_html( $value->post_title ); ?></a></h2>
                                                <?php if(etheme_get_option('blog_byline')): ?>
                                                    <?php etheme_byline( array( 'author' => 0, 'ID' => $value->ID ) );  ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="content-article">
                                               <?php if ( $excerpt_length > 0 ) {
                                                    if ( strlen(get_the_excerpt($value->ID)) > 0 ) {
                                                        $excerpt_length = apply_filters( 'excerpt_length', $excerpt_length );
                                                        $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
                                                        $text         = wp_trim_words( get_the_excerpt($value->ID), $excerpt_length, $excerpt_more );
                                                        echo apply_filters( 'wp_trim_excerpt', $text, $text );
                                                    }
                                                    else {
                                                        echo apply_filters( 'the_excerpt', get_the_excerpt($value->ID) );
                                                    }
                                                }  ?>
                                                <?php etheme_read_more( get_the_permalink($value->ID), true ) ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <?php
                                    echo '</div>';
                               }

                        echo '</div><!-- slider wrapper-->';
                   echo '</div>';
                   echo '<div class="swiper-button-prev swiper-custom-left"></div>
	                    <div class="swiper-button-next swiper-custom-right"></div>';
	               echo '</div><div class="clear"></div><!-- slider-entry -->';
				}
 // wp_reset_query();
    ?>
    <?php endif; ?>

    <?php
}
