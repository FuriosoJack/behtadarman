<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Customizer builder functions
 *
 * @since   1.4.0
 * @version 1.0.0
 */

/**
 * Return header top html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of header-top part
 */
function etheme_header_top(){
    require_once( ET_CORE_DIR . 'app/models/customizer/templates/header/header-top.php' );
}

/**
 * Return header main html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of header-main part
 */
function etheme_header_main(){
    require_once( ET_CORE_DIR . 'app/models/customizer/templates/header/header-main.php' );
}

/**
 * Return header bottom html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of header-bottom part
 */
function etheme_header_bottom(){
    require_once( ET_CORE_DIR . 'app/models/customizer/templates/header/header-bottom.php' );
}

/**
 * Return mobile header top html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of mobile-header-top part
 */
function etheme_mobile_header_top(){
    require_once( ET_CORE_DIR . 'app/models/customizer/templates/header/mobile/mobile-top.php' );
}

/**
 * Return mobile header main html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of mobile-header-main part
 */
function etheme_mobile_header_main(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/mobile/mobile-main.php' );
}

/**
 * Return mobile header bottom html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of mobile-header-bottom part
 */
function etheme_mobile_header_bottom(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/mobile/mobile-bottom.php' );
}

/**
 * Return header account element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of account part
 */
function etheme_header_parts_account(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/account.php' );
}

/**
 * Return header button element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of button part
 */
function etheme_header_parts_button(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/button.php' );
}

/**
 * Return header promo-text element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of promo_text part
 */
function etheme_header_parts_promo_text(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/promo_text.php' );
}

/**
 * Return header cart element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of cart part
 */
function etheme_header_parts_cart(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/cart.php' );
}

/**
 * Return header main menu element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of menu part
 */
function etheme_header_parts_menu(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/menu.php' );
}

/**
 * Return header newsletter element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of newsletter part
 */
function etheme_header_parts_newsletter(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/newsletter.php' );
}

/**
 * Return header search element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of search part
 */
function etheme_header_parts_search(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/search.php' );
}

/**
 * Return header socials element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of socials part
 */
function etheme_header_parts_socials(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/socials.php' );
}

/**
 * Return header wishlist element html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of wishlist part
 */
function etheme_header_parts_wishlist(){
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/wishlist.php' );
}

/**
 * Return header wrapper start html.
 *
 * @since   1.4.0
 * @version 1.0.2
 * last changes in 1.5.5
 * @return  {html} html of header wrapper start
 */
function etheme_header_wrapper_start() {
    global $et_builder_globals;
    $et_builder_globals['in_mobile_menu'] = false;
    $et_builder_globals['is_customize_preview'] = is_customize_preview();

    $class = $sticky_attr = '';
    $sticky_header = Kirki::get_option( 'top_header_sticky_et-desktop' ) || Kirki::get_option( 'main_header_sticky_et-desktop' ) || Kirki::get_option( 'bottom_header_sticky_et-desktop' ) || Kirki::get_option( 'top_header_sticky_et-mobile' ) || Kirki::get_option( 'main_header_sticky_et-mobile' ) || Kirki::get_option( 'bottom_header_sticky_et-mobile' )? 'sticky' : ''; 
    $class .= $sticky_header;
    if ( $sticky_header != '') {
        $sticky_type = ( Kirki::get_option( 'header_sticky_type_et-desktop' ) );
        $sticky_attr .= ' data-type="'.$sticky_type.'"';
        if ( $sticky_type == 'custom' ) {
            $sticky_attr .= 'data-start= "' . Kirki::get_option( 'headers_sticky_start_et-desktop' ) . '"';
        }
    }
    echo '<header id="header" class="site-header '.  $class . '" ' . $sticky_attr . '>';
}

/**
 * Return header wrapper end html.
 *
 * @since   1.4.0
 * @version 1.0.1
 * last changes in 1.5.4
 * @return  {html} html of header wrapper end
 */
function etheme_header_wrapper_end() {
    global $et_builder_globals;
    $et_builder_globals['in_mobile_menu'] = false;
    echo '</header>';
}

/**
 * Return header desktop wrapper start html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of header desktop wrapper start
 */
function etheme_header_dt_wrapper_start() {
    echo '<div class="header-wrapper mob-hide">';
}

/**
 * Return header desktop wrapper end html.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return  {html} html of header desktop wrapper end
 */
function etheme_header_dt_wrapper_end() {
    echo '</div>';
}

/**
 * Return header mobile wrapper start html with filters for mobile header content.
 *
 * @since   1.4.0
 * @version 1.0.2
 * @return  {html} html of header mobile wrapper start
 */
function etheme_header_mob_wrapper_start() {
    $etheme_filters = array(
        // 'etheme_mini_cart_content' => 'etheme_return_false',
        // 'etheme_mini_wishlist_content' => 'etheme_return_false',
        // 'etheme_mini_account_content' => 'etheme_return_false',
        // 'etheme_mini_content' => 'etheme_return_false',
        'search_type' => 'etheme_mobile_search_type',
        'search_category' => 'etheme_return_false',
        'account_icon' => 'etheme_mobile_account_icon',
    );

    if ( etheme_mobile_search_type() == 'icon' ) {
        $etheme_filters['search_by_icon'] = 'etheme_return_true';
    }
    else {
        $etheme_filters['search_by_icon'] = 'etheme_return_false';
    }

    foreach ($etheme_filters as $key => $value) {
        add_filter($key, $value, 10);
    }

    echo '<div class="mobile-header-wrapper dt-hide">';
}

/**
 * Return header mobile wrapper start html with removed filters for mobile header content.
 *
 * @since   1.4.0
 * @version 1.0.2
 * @return  {html} html of header mobile wrapper end
 */
function etheme_header_mob_wrapper_end() {
    $etheme_filters = array(
        // 'etheme_mini_cart_content' => 'etheme_return_false',
        // 'etheme_mini_wishlist_content' => 'etheme_return_false',
        // 'etheme_mini_account_content' => 'etheme_return_false',
        // 'etheme_mini_content' => 'etheme_return_false',
        'search_type' => 'etheme_mobile_search_type',
        'search_category' => 'etheme_return_false',
        'account_icon' => 'etheme_mobile_account_icon'
    );

    if ( etheme_mobile_search_type() == 'icon' ) {
        $etheme_filters['search_by_icon'] = 'etheme_return_true';
    }
    else {
        $etheme_filters['search_by_icon'] = 'etheme_return_false';
    }

    foreach ($etheme_filters as $key => $value) {
        remove_filter($key, $value, 10);
    }
    echo '</div>';
}

/**
 * Return header vertical html.
 *
 * @since   1.4.2
 * @version 1.0.0
 * @return  {html} html of header-vertical part
 */
function etheme_vertical_header() {
    if ( Kirki::get_option('header_vertical_et-desktop') ) 
    require( ET_CORE_DIR . 'app/models/customizer/templates/header/header-vertical.php' );
}

if ( get_option( 'etheme_header_builder', false ) ) {
    /**
     * Actions of header parts.
     *
     * @since   1.4.0
     * @version 1.0.0
     */
    add_action('init', function() {
        $header_actions = array (
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_vertical_header',
                'priority' => 1
            ),
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_header_wrapper_start',
                'priority' => 4,
            ),
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_header_dt_wrapper_start',
                'priority' => 5,
            ),
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_header_top',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_header_main',
                'priority' => 20
            ),
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_header_bottom',
                'priority' => 30
            ),
            array(
                'action' => 'etheme_header',
                'function' => 'etheme_header_dt_wrapper_end',
                'priority' => 35,
            ),
            // mobile header
            array(
                'action' => 'etheme_header_mobile',
                'function' => 'etheme_header_mob_wrapper_start',
                'priority' => 5,
            ),
            array(
                'action' => 'etheme_header_mobile',
                'function' => 'etheme_mobile_header_top',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_header_mobile',
                'function' => 'etheme_mobile_header_main',
                'priority' => 20
            ),
            array(
                'action' => 'etheme_header_mobile',
                'function' => 'etheme_mobile_header_bottom',
                'priority' => 30
            ),
            array(
                'action' => 'etheme_header_mobile',
                'function' => 'etheme_header_mob_wrapper_end',
                'priority' => 32,
            ),
            array(
                'action' => 'etheme_header_mobile',
                'function' => 'etheme_header_wrapper_end',
                'priority' => 35,
            ),
        );

        if(class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes')){
            WPBMap::addAllMappedShortcodes();
        }

        if ( class_exists('Kirki') ) { 

            switch ( Kirki::get_option('header_banner_position') ) {
	        	
	        	case 'top':
	        		$header_actions[] = array(
		        		'action' => 'etheme_header',
		                'function' => 'etheme_header_banner',
		                'priority' => 2
		        	);
	        		break;
	        	case 'bottom':
	        		$header_actions[] = array(
		        		'action' => 'etheme_header_mobile',
		                'function' => 'etheme_header_banner',
		                'priority' => 40
		        	);
	        		break;
	        	
	        	default:
	        		break;
	        }

            foreach ( $header_actions as $key ) {
                add_action( $key['action'], $key['function'], $key['priority'] );
            }

        }

        unset($header_actions);
    });

    if ( !function_exists('etheme_header_banner') ) {
    	function etheme_header_banner() {
	        if ( (!function_exists('dynamic_sidebar') || !dynamic_sidebar('header-banner'))):
	        endif; 
    	}
    }

    /**
    * Cart fragment
    * @since   1.4.0
    * @version 1.0.0
    * @see etheme_cart_link_fragment()
    */
    add_filter( 'woocommerce_add_to_cart_fragments', 'etheme_cart_link_fragment' );

    if ( ! function_exists( 'etheme_cart_link_fragment' ) ) {
    /**
     * Cart Fragments
     *
     * @since   1.4.0
     * @version 1.0.0
     * @param  {array} $cart_fragments Fragments to refresh via AJAX.
     * @return {array} fragments to refresh via AJAX
     */
    function etheme_cart_link_fragment( $cart_fragments ) {
            global $woocommerce;

            ob_start();
            etheme_cart_total();
            $cart_fragments['span.et-cart-total-inner'] = ob_get_clean();

            ob_start();
            etheme_cart_quantity();
            $cart_fragments['span.et-cart-quantity'] = ob_get_clean();

            return $cart_fragments;
        }
    }

    if ( ! function_exists( 'etheme_cart_total' ) ) {
        /**
         * Cart total 
         *
         * @since   1.4.0
         * @version 1.0.0
         * @return {html} cart total 
         */
        function etheme_cart_total() {
            if ( !class_exists('WooCommerce') ) return; ?>
            <span class="et-cart-total-inner">
              (<?php echo wp_specialchars_decode(WC()->cart->get_cart_subtotal()); ?>)
            </span>
        <?php 
        }
    }

    if ( ! function_exists( 'etheme_cart_quantity' ) ) {
        /**
         * Cart total 
         *
         * @since   1.4.0
         * @version 1.0.0
         * @return {html} cart quantity 
         */
        function etheme_cart_quantity() {
            if ( !class_exists('WooCommerce') ) return;

            $count = WC()->cart->get_cart_contents_count(); ?>
            <span class="et-cart-quantity et-quantity count-<?php echo $count; ?>">
              <?php echo  wp_specialchars_decode( $count ); ?>
            </span>
            <?php 
        }
    }

    /**
     * Enqueueing of theme options styles with tweaks of their using.
     *
     * @since   1.4.0
     * @version 1.0.0
     */
    add_action( 'wp_enqueue_scripts', 'etheme_options_styles', 50);

    /**
     * Load option styles.
     *
     * @since   1.4.0
     * @version 1.0.0
     */
    if(!function_exists('etheme_options_styles')) {
        function etheme_options_styles () {

            if ( !class_exists('Kirki') ) return;

           $element_options = array();

            // together options
            $element_options['menu_item_box_model_et-desktop'] = Kirki::get_option( 'menu_item_box_model_et-desktop' );
            $element_options['menu_nice_space_et-desktop'] = Kirki::get_option( 'menu_nice_space_et-desktop' );
            $element_options['menu_2_item_box_model_et-desktop'] = Kirki::get_option( 'menu_2_item_box_model_et-desktop' );
            $element_options['menu_2_nice_space_et-desktop'] = Kirki::get_option( 'menu_2_nice_space_et-desktop' );

            // mobile options 

            ob_start(); 

            if ( $element_options['menu_nice_space_et-desktop'] ) { ?>
              .header-main-menu.et_element-top-level .menu {
                <?php echo ( isset($element_options['menu_item_box_model_et-desktop']['margin-right']) ) ? 'margin-right:' . '-' . $element_options['menu_item_box_model_et-desktop']['margin-right'] : ''; ?>;
                <?php echo ( isset($element_options['menu_item_box_model_et-desktop']['margin-left']) ) ? 'margin-left:' . '-' . $element_options['menu_item_box_model_et-desktop']['margin-left'] : ''; ?>;
              }
            <?php }

            if ( $element_options['menu_2_nice_space_et-desktop'] ) { ?>
              .header-main-menu2.et_element-top-level .menu {
                <?php echo ( isset($element_options['menu_2_item_box_model_et-desktop']['margin-right']) ) ? 'margin-right:' . '-' . $element_options['menu_2_item_box_model_et-desktop']['margin-right'] : ''; ?>;
                <?php echo ( isset($element_options['menu_2_item_box_model_et-desktop']['margin-left']) ) ? 'margin-left:' . '-' . $element_options['menu_2_item_box_model_et-desktop']['margin-left'] : ''; ?>;
              }
            <?php } ?>

              @media only screen and (max-width: 992px) {

                .mob-hide {
                  display: none;
                }

                .mob-full-width {
                    width: 100% !important;
                }

                .mob-full-width-children > * {
                    width: 100%;
                }

                .mob-et-content-right .et-mini-content,
                .mob-et-content-right .ajax-search-form .ajax-results-wrapper {
                  left: auto;
                  right: 0;
                }

                .mob-et-content-left .et-mini-content,
                .mob-et-content-left .ajax-search-form .ajax-results-wrapper {
                  right: auto;
                  left: 0;
                }

                /* alignments on mobile */

                .mob-align-start {
                  text-align: start;
                }

                .mob-align-center {
                  text-align: center;
                }

                .mob-align-end {
                  text-align: end;
                }

                .mob-align-justify {
                  text-align: justify;
                }

                /* justify content */
                .mob-justify-content-start {
                  justify-content: flex-start;
                  text-align: start
                }
                .mob-justify-content-end {
                  justify-content: flex-end;
                  text-align: end
                }
                .mob-justify-content-center {
                  justify-content: center;
                  text-align: center
                }
                .mob-justify-content-between {
                  justify-content: space-between;
                }
                .mob-justify-content-around {
                  justify-content: space-around;
                }
                .mob-justify-content-inherit {
                  justify-content: inherit;
                  text-align: inherit
                }

                .mob-flex-wrap {
                    flex-wrap: wrap;
                }
            }

            @media only screen and (min-width: 993px) {
              .dt-hide {
                display: none;
              }
            }

            <?php 

            $element_options['options_css'] = ob_get_clean();
            wp_register_style( 'et-options-style', false );
            wp_enqueue_style( 'et-options-style' );
            wp_add_inline_style( 'et-options-style', $element_options['options_css'] );

          unset($element_options);

        }
    }
}

if ( ! function_exists( 'etheme_wishlist_quantity' ) ) {
    /**
     * Wishlist quantity
     *
     * @since   1.4.0
     * @version 1.0.0
     * @return {html} html of wishlist quantity 
     */
    function etheme_wishlist_quantity() {
        $args = array();
        if ( defined( 'YITH_WCWL_PREMIUM' ) && is_user_logged_in() ) {
            $args['wishlist_id'] = 'all';
        } else {
            $args['is_default'] = true;
        }


        $products = YITH_WCWL()->get_products( $args );

        if ( ! defined( 'YITH_WCWL_PREMIUM' ) ) {
            $products = array_reverse($products);
        }

        $count = count( $products ); ?>
        <span class="et-wishlist-quantity et-quantity count-<?php echo $count; ?>">
          <?php echo wp_specialchars_decode( $count ); ?>
        </span>
        <?php 
        }
    }

if ( !function_exists('etheme_mini_wishlist') ) {
    /**
     * Wishlist dropdown content
     *
     * @since   1.4.0
     * @version 1.0.0
     * @return {html} html content of mini-wishlist products
     */
    function etheme_mini_wishlist() { 
        $args = array();
        if ( defined( 'YITH_WCWL_PREMIUM' ) && is_user_logged_in() ) {
            $args['wishlist_id'] = 'all';
        } else {
            $args['is_default'] = true;
        }


        $products = YITH_WCWL()->get_products( $args );

        $limit = etheme_get_option('mini-wishlist-items-count');
        $limit = is_numeric($limit) ? $limit : 3;

        if ( ! defined( 'YITH_WCWL_PREMIUM' ) ) {
            $products = array_reverse($products);
        }

        $add_remove_ajax = false;
        $wishlist_class = 'et_b_wishlist-dropdown product_list_widget cart_list';
        $wishlist_attr = array();

        if ( class_exists('YITH_WCWL_Wishlist_Factory') ) {
            
            $wishlist = YITH_WCWL_Wishlist_Factory::get_current_wishlist();

            if ( is_object($wishlist) ) {

                $wishlist_attr[] = 'data-token="' . $wishlist->get_token() . '"';
                $wishlist_attr[] = 'data-id="' . $wishlist->get_id() . '"';

                $wishlist_class .= ' cart wishlist_table';

                $add_remove_ajax = true;

            }

        }

        ?>
        <div class="<?php esc_attr_e($wishlist_class); ?>" <?php echo implode(' ', $wishlist_attr); ?>>
            <?php if ( ! empty($products) ) : ?>
                <ul class="cart-widget-products">
                    <?php
                    $i = 0;
                    foreach( $products as $item ) {
                        $i++;
                        if( $i > $limit) break;

                        if ( function_exists( 'yit_wpml_object_id' ) ) {
                            $item['prod_id'] = yit_wpml_object_id ( $item['prod_id'], 'product', true );
                        }

                        if( function_exists( 'wc_get_product' ) ) {
                            $_product = wc_get_product( $item['prod_id'] );
                        }
                        else{
                            $_product = get_product( $item['prod_id'] );
                        }

                        if( ! $_product ) continue;

                        $product_name  = $_product->get_title();
                        $thumbnail     = $_product->get_image();
                        ?>
                        <li class="">
                            <?php if ( ! $_product->is_visible() ) : ?>
                                <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '&nbsp;'; ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url( $_product->get_permalink() ); ?>" class="product-mini-image">
                                    <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '&nbsp;'; ?>
                                </a>
                            <?php endif; ?>

                            <div class="product-item-right" data-row-id="<?php esc_attr_e($item['prod_id']); ?>">

                                <h4 class="product-title"><a href="<?php echo esc_url( $_product->get_permalink() ); ?>"><?php echo wp_specialchars_decode( $product_name); ?></a></h4>

                                <?php if ( $add_remove_ajax ) : ?>
                                    <a href="<?php echo add_query_arg('remove_from_wishlist', $item['prod_id'], esc_url(YITH_WCWL()->get_wishlist_url())); ?>" class="remove remove_from_wishlist" title="Remove this product"><i class="et-icon et-delete"></i></a>
                                <?php endif; ?>

                                <div class="descr-box">
                                    <?php echo WC()->cart->get_product_price( $_product ); ?>
                                </div>

                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <p class="buttons">
                    <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="button btn-view-wishlist"><?php _e( 'View Wishlist', 'xstore-core' ); ?></a>
                </p>
            <?php else : ?>
                <p class="empty"><?php esc_html_e( 'No products in the wishlist.', 'xstore-core' ); ?></p>
            <?php endif; ?>
        </div><!-- end product list -->
    <?php }
}

/**
* Wishlist notice on ajax
* @since   2.2.4
* @version 1.0.0
* @see etheme_wishlist_notice_ajax()
*/

add_action( 'wp_ajax_etheme_wishlist_notice_ajax', 'etheme_wishlist_notice_ajax');
add_action( 'wp_ajax_nopriv_etheme_wishlist_notice_ajax', 'etheme_wishlist_notice_ajax');

if ( !function_exists('etheme_wishlist_notice_ajax') ) {
    /**
    * Wishlist notice on ajax
    * @since   2.2.4
    * @version 1.0.0
    */
    function etheme_wishlist_notice_ajax() {

        $notices = WC()->session->get( 'wc_notices', array() );
        if ( isset($notices['success']) && count($notices['success']) ) {
            array_pop($notices['success']);
        }
        WC()->session->set( 'wc_notices', $notices );

    }
}

/**
* Wishlist fragment
* @since   1.4.0
* @version 1.0.0
* @see etheme_wishlist_link_fragment()
*/

add_action( 'wp_ajax_etheme_wishlist_link_fragment', 'etheme_wishlist_link_fragment');
add_action( 'wp_ajax_nopriv_etheme_wishlist_link_fragment', 'etheme_wishlist_link_fragment');

if ( !function_exists('etheme_wishlist_link_fragment') ) {
    /**
     * Wishlist Fragments
     *
     * @since   1.4.0
     * @version 1.0.0
     * @return {array} fragments to refresh via AJAX
     */
    function etheme_wishlist_link_fragment() {

        $data = array(
            'fragments' => array()
        );

        if(! function_exists('wc_setcookie') || ! function_exists('YITH_WCWL') ) return;

        ob_start();
        etheme_wishlist_quantity();
        $data['fragments']['span.et-wishlist-quantity'] = ob_get_clean();

        ob_start();
        etheme_mini_wishlist();
        $data['fragments']['.et_b_wishlist-dropdown'] = ob_get_clean();

        wp_send_json( $data );
    }
}

/**
 * Header account content part
 *
 * @since   1.4.0
 * @version 1.0.2
 * @param  {bool} echo and return content.
 * @return {html} account content html 
 */
if ( !function_exists( 'et_b_account_link' ) ) {
    function et_b_account_link($echo = true, $off_canvas = false, $element_options = array()) {
        $is_woocommerce = (class_exists('WooCommerce')) ? true : false;
        $login_link = ( $is_woocommerce ) ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : wp_login_url();
        $account_dropdown = '';
        $login_options = array();

        $canvas = array('close' => '', 'label' => '');
        if ( $off_canvas ) : 
            ob_start(); ?>
            <span class="et-toggle pos-absolute et-close full-<?php echo $element_options['etheme_mini_account_content_position']; ?> top">
                <svg xmlns="http://www.w3.org/2000/svg" width="0.8em" height="0.8em" viewBox="0 0 24 24">
                    <path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
                </svg>
            </span>
            <?php 

                $canvas['close'] = ob_get_clean(); 
                ob_start(); ?>
            
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="et-mini-content-head account-type2 flex justify-content-center flex-wrap">
                <?php if ( $element_options['account_icon_et-desktop'] == '' ) 
                        $element_options['account_icon_et-desktop'] = $element_options['account_icons_et-desktop']['type1']; 
                    ?>
                    <span class="et_b-icon">
                        <?php echo $element_options['account_icon_et-desktop']; ?>
                    </span>

                    <span class="et-element-label pos-relative inline-block">
                        <?php echo esc_html__('My Account', 'xstore-core'); ?>
                    </span>
            </a>
        <?php $canvas['label'] = ob_get_clean();

        endif;

        if ( is_user_logged_in() ) {
            if ( $is_woocommerce ) { 
                ob_start(); ?>
                <div class="et-mini-content">
                    <?php echo $canvas['close']; ?>
                    <div class="et-content">
                        <?php echo $canvas['label']; ?>
                        <ul class="menu">
                            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) { 
                                $url = ( $endpoint != 'dashboard' ) ? wc_get_endpoint_url( $endpoint, '', $login_link ) : $login_link;
                                ?>
                                <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                    <a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( $label ); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php $account_dropdown = ob_get_clean();
            }
        } 
        else {
            $account_dropdown = '';
            if ( $is_woocommerce ) { 
                $with_tabs = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) );
                ob_start(); ?>
                <?php 
                    $login_options['form_tabs'] = $login_options['form_tabs_start'] = $login_options['form_tabs_end']  = '';
                    $login_options['form_tabs_start'] = '<div class="et_b-tabs-wrapper">';
                    $login_options['form_tabs_end'] = '</div>';
                    ob_start(); ?>
                    <div class="et_b-tabs">
                        <span class="et-tab active" data-tab="login">
                            <?php esc_html_e('Login', 'xstore-core'); ?>
                        </span>
                        <span class="et-tab" data-tab="register">
                            <?php esc_html_e('Register', 'xstore-core'); ?>
                        </span>
                    </div>
                <?php 
                $login_options['form_tabs'] = ob_get_clean(); 
                ?>
                
                <div class="header-account-content et-mini-content">
                    <?php echo $canvas['close']; ?>
                    <div class="et-content">
                        <?php echo $canvas['label']; ?>
                        <?php 
                            if ( $with_tabs ) {
                                echo $login_options['form_tabs_start'];
                                echo $login_options['form_tabs']; 
                            } 
                        ?>
                        <form class="woocommerce-form woocommerce-form-login login <?php if ( $with_tabs ) echo 'et_b-tab-content active'; ?>" data-tab-name="login" autocomplete="off" method="post" action="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>">

                                <?php do_action( 'woocommerce_login_form_start' ); ?>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                  <label for="username"><?php esc_html_e( 'Username or email address', 'xstore-core' ); ?>&nbsp;<span class="required">*</span></label>
                                  <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                </p>
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                  <label for="password"><?php esc_html_e( 'Password', 'xstore-core' ); ?>&nbsp;<span class="required">*</span></label>
                                  <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                                </p>

                                <?php do_action( 'woocommerce_login_form' ); ?>

                                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="lost-password"><?php esc_html_e( 'Lost password ?', 'xstore-core' ); ?></a>

                                <p>
                                  <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                      <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember Me', 'xstore-core' ); ?></span>
                                  </label>
                                </p>

                                <p class="login-submit">
                                  <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                  <button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Log in', 'xstore-core' ); ?>"><?php esc_html_e( 'Log in', 'xstore-core' ); ?></button>
                                </p>

                                <?php do_action( 'woocommerce_login_form_end' ); ?>

                            </form>

                            <?php if ( $with_tabs ) : ?>
                              <form method="post" autocomplete="off" class="woocommerce-form woocommerce-form-register et_b-tab-content register" data-tab-name="register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                                <?php do_action( 'woocommerce_register_form_start' ); ?>

                                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                                        <label for="reg_username"><?php esc_html_e( 'Username', 'xstore-core' ); ?>&nbsp;<span class="required">*</span></label>
                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                    </p>

                                <?php endif; ?>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                                    <label for="reg_email"><?php esc_html_e( 'Email address', 'xstore-core' ); ?>&nbsp;<span class="required">*</span></label>
                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                </p>

                                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                                        <label for="reg_password"><?php esc_html_e( 'Password', 'xstore-core' ); ?>&nbsp;<span class="required">*</span></label>
                                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                                    </p>

                                <?php else : ?>

                                    <p><?php esc_html_e( 'A password will be sent to your email address.', 'xstore-core' ); ?></p>

                                <?php endif; ?>

                                <?php do_action( 'woocommerce_register_form' ); ?>

                                <p class="woocommerce-FormRow">
                                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                                    <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'xstore-core' ); ?>"><?php esc_html_e( 'Register', 'xstore-core' ); ?></button>
                                </p>

                                <?php do_action( 'woocommerce_register_form_end' ); ?>

                                </form>
    
                            <?php 
                            echo $login_options['form_tabs_end']; 
                        endif; ?>

                    </div>

                </div>
            <?php $account_dropdown .= ob_get_clean(); 
            }
            else { 
                ob_start(); ?>
                <div class="et-mini-content header-account-content">
                    <?php echo $canvas['close']; ?>
                    <div class="et-content">
                        <?php echo $canvas['label']; ?>
                    <?php 
                        wp_login_form(
                            array(
                                'echo' => true,
                                'label_username' => esc_html__( 'Username or email address *', 'xstore-core' ),
                                'label_password' => esc_html__( 'Password *', 'xstore-core' )
                            )
                        );
                    ?>
                </div>
                </div>
            <?php
                $account_dropdown = ob_get_clean();
            }
        }
        if ( !$echo ) return $account_dropdown;
        echo $account_dropdown;
    }
}

/**
 * Action for ajax popup.
 *
 * @since   1.4.0
 * @version 1.0.0
 */
add_action( 'wp_ajax_nopriv_etheme_ajax_popup_content', 'etheme_ajax_popup_content');
add_action( 'wp_ajax_etheme_ajax_popup_content', 'etheme_ajax_popup_content');

/**
 * Ajax popup with multicontent set up by parameter in js.
 *
 * @since   1.4.0
 * @version 1.0.2
 * @return {html} popup content 
 */
if ( !function_exists( 'etheme_ajax_popup_content' ) ) {
  function etheme_ajax_popup_content () {
    if(class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes'))
        WPBMap::addAllMappedShortcodes();
    switch ($_POST['type']) {
        case 'newsletter':
            $html = et_b_newsletter_content();
            break;
        case 'mobile_menu':
            $html = et_b_mobile_menu_content();
            break;
        case 'size_guide':
            $html = etheme_size_guide_content($_POST['id']);
            break;
        default:
            $html = '';
            break;
    }

    echo json_encode($html);
    die();

  }
}

/**
 * Ajax mobile menu popup.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return {html} popup content 
 */
if ( !function_exists('et_b_mobile_menu_content') ) {
    function et_b_mobile_menu_content() {

        global $et_builder_globals;

        $et_builder_globals['in_mobile_menu'] = true;

        $mob_menu_element_options['mobile_menu_content'] = Kirki::get_option( 'mobile_menu_content' );

        $mob_menu_element_options['mobile_menu_logo_type'] = Kirki::get_option( 'mobile_menu_logo_type_et-desktop' );
        $mob_menu_element_options['mobile_menu_logo_filter'] = ( $mob_menu_element_options['mobile_menu_logo_type'] == 'sticky' ) ? 'simple' : 'sticky';

        $mob_menu_element_options['mobile_menu_classes'] = ' justify-content-center';
        $mob_menu_element_options['mobile_menu_classes'] .= ' toggles-by-arrow';

        $mob_menu_element_options['mobile_menu_2'] = ( Kirki::get_option( 'mobile_menu_2' ) != 'none' ) ? true : false;

        $mob_menu_element_options['mobile_menu_term'] = Kirki::get_option('mobile_menu_term');
        $mob_menu_element_options['mobile_menu_term_name'] = $mob_menu_element_options['mobile_menu_term'] == '' ? 'main-menu' : $mob_menu_element_options['mobile_menu_term'];
        $mob_menu_element_options['mobile_menu_one_page'] = Kirki::get_option('mobile_menu_one_page') ? ' one-page-menu' : '';

        $mob_menu_element_options['mobile_menu_categories_tabs'] = $mob_menu_element_options['mobile_menu_categories_wrapper_start'] = $mob_menu_element_options['mobile_menu_categories_wrapper_end']  = '';
        if ( $mob_menu_element_options['mobile_menu_2'] ) {
            $mob_menu_element_options['mobile_menu_categories_wrapper_start'] = '<div class="et_b-tabs-wrapper">';
            $mob_menu_element_options['mobile_menu_categories_wrapper_end'] = '</div>';
            ob_start(); ?>
            <div class="et_b-tabs">
                <span class="et-tab active" data-tab="menu">
                    <?php esc_html_e('Menu', 'xstore-core'); ?>
                </span>
                <span class="et-tab" data-tab="categories">
                    <?php esc_html_e('Categories', 'xstore-core'); ?>
                </span>
            </div>
        <?php 
        $mob_menu_element_options['mobile_menu_categories_tabs'] = ob_get_clean(); 
        }

        $args = array(
            'menu' => $mob_menu_element_options['mobile_menu_term_name'],
            'before' => '',
            'container_class' => 'menu-main-container' . $mob_menu_element_options['mobile_menu_one_page'],
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 4,
            'echo' => false,
            'fallback_cb' => false,
            'walker' => new ETheme_Navigation
        );

       $mob_menu_element_options['etheme_filters'] = array(
            "etheme_logo_{$mob_menu_element_options['mobile_menu_logo_filter']}" => 'etheme_return_false',
            'logo_align' => 'etheme_return_align_center',
            'etheme_mini_content' => 'etheme_return_false',
            'etheme_search_results' => 'etheme_return_true',
            'search_category' => 'etheme_return_false',
            'cart_off_canvas' => 'etheme_return_false',
            'etheme_mini_cart_content' => 'etheme_return_false',
            'etheme_mini_account_content' => 'etheme_return_false',
            'et_mobile_menu' => 'etheme_return_true',
            'etheme_use_desktop_style' => 'etheme_return_true',
            'search_type' => 'etheme_mobile_type_input',
            'search_by_icon' => 'etheme_return_false',
            'cart_style' => 'etheme_mobile_content_element_type1',
            'account_style' => 'etheme_mobile_content_element_type1',
            'header_socials_direction' => 'etheme_return_false',
            'contacts_icon_position' => 'etheme_mobile_icon_left',

            'etheme_output_shortcodes_inline_css' => 'etheme_return_true'
        );

        foreach ($mob_menu_element_options['etheme_filters'] as $key => $value) {
            add_filter($key, $value, 15);
        }

        ob_start();

        ?>
        <div class="et-popup-wrapper mobile-menu-popup">
          <span class="et-close-popup pos-fixed right top">
            <svg xmlns="http://www.w3.org/2000/svg" width=".8em" height=".8em" viewBox="0 0 24 24">
              <path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
            </svg>
            </span>
            <div class="et-popup">
                <div class="et-popup-content flex-row mobile-menu-content children-align-inherit <?php echo $mob_menu_element_options['mobile_menu_classes']; ?>">
                    <?php if ( is_array($mob_menu_element_options['mobile_menu_content']) && count( $mob_menu_element_options['mobile_menu_content'] ) == 1 ) echo '<div style="height: 0px;margin: 0px; visibility: hidden;">Fix for iphone submenus</div>'; // fix for iphones when scroll down submenus and only one element is shown in content ?>

                      <?php foreach ($mob_menu_element_options['mobile_menu_content'] as $key => $value) {
                            if ( $value == 'menu' && $mob_menu_element_options['mobile_menu_2'] ) {
                                echo $mob_menu_element_options['mobile_menu_categories_wrapper_start'];
                                echo $mob_menu_element_options['mobile_menu_categories_tabs'];
                                ?>
                                    <div class="et_b-tab-content active" data-tab-name="menu">
                                        <?php 
                                        if ( wp_nav_menu( $args ) != '' ) {
                                                ?>
                                            <div class="et_element et_b_header-menu header-mobile-menu flex align-items-center" data-title="<?php esc_html_e( 'Menu', 'xstore-core' ); ?>">
                                                <?php echo wp_nav_menu($args); ?>
                                            </div>
                                        <?php }
                                        else { ?>
                                            <span class="flex-inline justify-content-center align-items-center flex-nowrap">
                                                <?php esc_html_e( 'Mobile menu ', 'xstore-core' ); ?> 
                                                <span class="mtips" style="text-transform: none;">
                                                    <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
                                                    <span class="mt-mes"><?php esc_html_e('To use Mobile menu please select your menu in dropdown', 'xstore-core'); ?></span>
                                                </span>
                                            </span>
                                            <?php 
                                        } ?>
                                    </div>
                                    <div class="et_b-tab-content" data-tab-name="categories">
                                        <?php the_widget('WC_Widget_Product_Categories', 'title='); ?>
                                    </div>
                                <?php
                                echo $mob_menu_element_options['mobile_menu_categories_wrapper_end'];
                            }
                            else {
                                if ( $value == 'menu' ) {
                                    if ( wp_nav_menu( $args ) != '' ) {
                                                ?>
                                        <div class="et_element et_b_header-menu header-mobile-menu flex align-items-center" data-title="<?php esc_html_e( 'Menu', 'xstore-core' ); ?>">
                                            <?php echo wp_nav_menu($args); ?>
                                        </div>
                                    <?php }
                                    else { ?>
                                        <span class="flex-inline justify-content-center align-items-center flex-nowrap">
                                            <?php esc_html_e( 'Mobile menu ', 'xstore-core' ); ?> 
                                            <span class="mtips" style="text-transform: none;">
                                                <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
                                                <span class="mt-mes"><?php esc_html_e('To use Mobile menu please select your menu in dropdown', 'xstore-core'); ?></span>
                                            </span>
                                        </span>
                                        <?php 
                                    }
                                }
                                else {
                                    require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/'.$value.'.php' );
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php

        $html = ob_get_clean();

        foreach ($mob_menu_element_options['etheme_filters'] as $key => $value) {
          remove_filter($key, $value, 15);
        }
    
        unset($mob_menu_element_options);
        $et_builder_globals['in_mobile_menu'] = false;

        return $html;
    }
}

/**
 * Ajax newsletter menu popup.
 *
 * @since   1.4.0
 * @version 1.0.1
 * last changes in 1.5.5
 * @return {html} popup content 
 */
if ( !function_exists('et_b_newsletter_content') ) {
  function et_b_newsletter_content () {

    $element_options = array();
    $element_options['newsletter_title_et-desktop'] = Kirki::get_option( 'newsletter_title_et-desktop' );
    $element_options['newsletter_content_et-desktop'] = Kirki::get_option( 'newsletter_content_et-desktop' );
    $element_options['newsletter_content_alignment_et-desktop'] = ' align-' . Kirki::get_option( 'newsletter_content_alignment_et-desktop' );
    $element_options['newsletter_section_et-desktop'] = ( Kirki::get_option( 'newsletter_sections_et-desktop' ) ) ? Kirki::get_option( 'newsletter_section_et-desktop' ) : '';
    $element_options['newsletter_content_et-desktop'] = ( $element_options['newsletter_section_et-desktop'] != '' && $element_options['newsletter_section_et-desktop'] > 0 ) ? $element_options['newsletter_section_et-desktop'] : $element_options['newsletter_content_et-desktop'];
    $element_options['newsletter_close_button_action_et-desktop'] = Kirki::get_option( 'newsletter_close_button_action_et-desktop' );

    ob_start();
    $element_options['class'] = ( $element_options['newsletter_section_et-desktop'] != '' ) ? 'with-static-block' : '';
    $element_options['class'] .= $element_options['newsletter_content_alignment_et-desktop'];
    $element_options['class'] .= Kirki::get_option('newsletter_content_width_height_et-desktop') == 'custom' ? ' et-popup-content-custom-dimenstions' : '';
    ?>
    <div class="et-popup-wrapper header-newsletter-popup">
      <div class="et-popup">
          <div class="et-popup-content <?php esc_attr_e( $element_options['class'] ); ?>">
            <?php echo header_newsletter_content_callback(); ?>
        </div>
      </div>
    </div>
    <?php
    $html = ob_get_clean();
    unset($element_options);
    return $html;
  }
}

/**
 * Ajax size guide popup.
 *
 * @since   1.5.0
 * @version 1.0.1
 * last changes in 1.5.5
 * @return {html} popup content 
 */
if ( !function_exists('etheme_size_guide_content') ) {
  function etheme_size_guide_content ($id) {

    $element_options = array();
    $element_options['product_size_guide_img_et-desktop'] = Kirki::get_option( 'product_size_guide_img_et-desktop' );
    $element_options['product_size_guide_title_et-desktop'] = Kirki::get_option( 'product_size_guide_title_et-desktop' );
    $element_options['product_size_guide_section_et-desktop'] = ( Kirki::get_option( 'product_size_guide_sections_et-desktop' ) ) ? Kirki::get_option( 'product_size_guide_section_et-desktop' ) : '';
    $element_options['product_size_guide_content_et-desktop'] = ( $element_options['product_size_guide_section_et-desktop'] != '' && $element_options['product_size_guide_section_et-desktop'] > 0 ) ? $element_options['product_size_guide_section_et-desktop'] : '<img src="'.$element_options['product_size_guide_img_et-desktop'].'" alt="' . esc_html__('sizing guide', 'xstore-core') . '">';
    $element_options['product_size_guide_content_alignment_et-desktop'] = ' align-' . Kirki::get_option( 'product_size_guide_content_alignment_et-desktop' );

    $element_options['product_size_guide_local_img'] = etheme_get_custom_field( 'size_guide_img', $id);

    $element_options['class'] = ( $element_options['product_size_guide_section_et-desktop'] != '' ) ? 'with-static-block' : '';
    $element_options['class'] .= $element_options['product_size_guide_content_alignment_et-desktop'];
    $element_options['class'] .= Kirki::get_option('product_size_guide_content_width_height_et-desktop') == 'custom' ? ' et-popup-content-custom-dimenstions' : '';

    ob_start();

    ?>
    <div class="et-popup-wrapper size-guide-popup">
      <div class="et-popup">
          <div class="et-popup-content <?php esc_attr_e( $element_options['class'] ); ?>">
            <?php echo product_size_guide_content_callback($id); ?>
        </div>
      </div>
    </div>
    <?php
    $html = ob_get_clean();
    unset($element_options);
    return $html;
  }
}

/**
 * Return true.
 * In most case uses in filters.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {bool} true  
 */
if ( !function_exists('etheme_return_true') ) {
  function etheme_return_true ($content) {
    return true;
  }
}

/**
 * Return false.
 * In most case uses in filters.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {bool} false 
 */
if ( !function_exists('etheme_return_false') ) {
  function etheme_return_false ($content) {
    return false;
  }
}

/**
 * Return none.
 * In most case uses in filters.
 *
 * @since   1.5.4
 * @param {string} content 
 * @version 1.0.0
 * @return {string} none 
 */
if ( !function_exists('etheme_return_none') ) {
  function etheme_return_none ($content) {
    return 'none';
  }
}

/**
 * Return type.
 * In most case uses in filters.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {string} type1 
 */
if ( !function_exists('etheme_mobile_content_element_type1') ) {
  function etheme_mobile_content_element_type1 ($el_type) {
    return 'type1';
  }
}

/**
 * Return input type - input.
 * It uses in filters for mobile menu.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {string} input 
 */
if ( !function_exists('etheme_mobile_type_input') ) {
  function etheme_mobile_type_input ($search_type) {
    return 'input';
  }
}

/**
 * Return mobile icon position - left.
 * It uses in filters for mobile menu.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {string} left 
 */
if ( !function_exists('etheme_mobile_icon_left') ) {
  function etheme_mobile_icon_left ($position) {
    return 'left';
  }
}

/**
 * Return align center content.
 * It uses in filters for mobile menu.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {string} align of content 
 */
if ( !function_exists('etheme_return_align_center') ) {
  function etheme_return_align_center ($align) {
    return 'justify-content-center';
  }
}

/**
 * Return align inherit for content.
 * It uses in filters for mobile menu.
 *
 * @since   1.4.0
 * @param {string} content 
 * @version 1.0.0
 * @return {string} align of content
 */
if ( !function_exists('etheme_return_align_inherit') ) {
  function etheme_return_align_inherit ($align) {
    return 'align-inherit justify-content-inherit';
  }
}

/**
 * Return mobile search type.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return {string} search type for mobile header
 */
if ( !function_exists('etheme_mobile_search_type') ) {
  function etheme_mobile_search_type () {
    return Kirki::get_option( 'search_type_et-mobile' );
  }
}

/**
 * Return mobile account icon type.
 *
 * @since   1.4.0
 * @version 1.0.0
 * @return {string} mobile account icon type for mobile header
 */
if ( !function_exists('etheme_mobile_account_icon') ) {
  function etheme_mobile_account_icon () {
    return Kirki::get_option( 'account_icon_et-mobile' );
  }
}

/**
 * Return mobile account content type.
 *
 * @since   2.2.4
 * @version 1.0.0
 * @return {string} mobile account content type for mobile header
 */
if ( !function_exists('etheme_mini_account_content_mobile') ) {
  function etheme_mini_account_content_mobile () {
    return Kirki::get_option( 'account_content_type_et-mobile' );
  }
}

/**
 * Return mobile account content position.
 *
 * @since   2.2.4
 * @version 1.0.0
 * @return {string} mobile account content position for mobile header
 */
if ( !function_exists('etheme_mini_account_content_position_mobile') ) {
  function etheme_mini_account_content_position_mobile () {
    return Kirki::get_option( 'account_content_position_et-mobile' );
  }
}

/**
 * Return mobile cart content type.
 *
 * @since   2.2.4
 * @version 1.0.0
 * @return {string} mobile cart content type for mobile header
 */
if ( !function_exists('etheme_mini_cart_content_mobile') ) {
  function etheme_mini_cart_content_mobile () {
    return Kirki::get_option( 'cart_content_type_et-mobile' );
  }
}

/**
 * Return mobile cart content position.
 *
 * @since   2.2.4
 * @version 1.0.0
 * @return {string} mobile cart content position for mobile header
 */
if ( !function_exists('etheme_mini_cart_content_position_mobile') ) {
  function etheme_mini_cart_content_position_mobile () {
    return Kirki::get_option( 'cart_content_position_et-desktop' );
  }
}

/**
 * Return mobile wishlist content type.
 *
 * @since   2.2.4
 * @version 1.0.0
 * @return {string} mobile wishlist content type for mobile header
 */
if ( !function_exists('etheme_mini_wishlist_content_mobile') ) {
  function etheme_mini_wishlist_content_mobile () {
    return Kirki::get_option( 'wishlist_content_type_et-mobile' );
  }
}

/**
 * Return mobile wishlist content position.
 *
 * @since   2.2.4
 * @version 1.0.0
 * @return {string} mobile wishlist content position for mobile header
 */
if ( !function_exists('etheme_mini_wishlist_content_position_mobile') ) {
  function etheme_mini_wishlist_content_position_mobile () {
    return Kirki::get_option( 'wishlist_content_position_et-desktop' );
  }
}

/**
 * Header vertical logo.
 *
 * @since   1.4.2
 * @see templates/header/header-vertical
 * @version 1.0.0
 * @return {string} logo type in vertical header 
 */
if ( !function_exists('etheme_vertical_header_logo') ) {
  function etheme_vertical_header_logo ($logo) {
    return Kirki::get_option( 'header_vertical_logo_img_et-desktop' );
  }
}

/**
 * Menu item design dropdown.
 *
 * @since   1.4.2
 * @see templates/header/header-vertical
 * @version 1.0.0
 * @return {string} item-design-dropdown for any menu item type 
 */
if ( !function_exists('etheme_menu_item_design_dropdown') ) {
  function etheme_menu_item_design_dropdown ($design) {
    return 'item-design-dropdown';
  }
}

























if ( !function_exists('etheme_woocommerce_template_single_title') ) {
    /**
     * Single product title function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_title(){
        woocommerce_template_single_title();
    }
}

if ( !function_exists('etheme_woocommerce_template_single_rating') ) {
    /**
     * Single product rating function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_rating(){
        woocommerce_template_single_rating();
    }
}

if ( !function_exists('etheme_woocommerce_template_single_price') ) {
    /**
     * Single product price function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_price(){
        woocommerce_template_single_price();
    }
}

if ( !function_exists('etheme_woocommerce_template_single_excerpt') ) {
    /**
     * Single product short description function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_excerpt(){
        woocommerce_template_single_excerpt();
    }
}

if ( !function_exists('etheme_woocommerce_template_single_add_to_cart') ) {
    /**
     * Single product cart form function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_add_to_cart(){

        $is_builder = apply_filters('etheme_woocommerce_template_single_add_to_cart_hooks', true);

        if ( $is_builder ) :
            // remove default icons and add it after action 
            remove_action('woocommerce_before_quantity_input_field', 'et_quantity_minus_icon');
            remove_action('woocommerce_after_quantity_input_field', 'et_quantity_plus_icon');

            add_action('woocommerce_before_quantity_input_field', 'etheme_woocommerce_before_add_to_cart_quantity', 10);
            add_action('woocommerce_after_quantity_input_field', 'etheme_woocommerce_after_add_to_cart_quantity', 10);

            add_filter('woocommerce_cart_item_quantity', 'etheme_woocommerce_cart_item_quantity', 3, 20);
        endif;

        $just_catalog = etheme_get_option('just_catalog');
        if ( $just_catalog ) {
            remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
            remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
            remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
            remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
        }
        woocommerce_template_single_add_to_cart();

        if ( $is_builder ) :
            remove_filter('woocommerce_cart_item_quantity', 'etheme_woocommerce_cart_item_quantity', 3, 20);

            remove_action('woocommerce_before_quantity_input_field', 'etheme_woocommerce_before_add_to_cart_quantity', 10);
            remove_action('woocommerce_after_quantity_input_field', 'etheme_woocommerce_after_add_to_cart_quantity', 10);

            add_action('woocommerce_before_quantity_input_field', 'et_quantity_minus_icon');
            add_action('woocommerce_after_quantity_input_field', 'et_quantity_plus_icon');
        endif;
    }
}

if ( !function_exists('etheme_woocommerce_template_single_meta') ) {
    /**
     * Single product meta function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_meta(){
        woocommerce_template_single_meta();
    }
}

if ( !function_exists('etheme_product_single_sharing') ) {
    /**
     * Single product sharing function (theme socials).
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_sharing() {
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-sharing.php' );
    }
}

if ( !function_exists('etheme_woocommerce_template_single_sharing') ) {
    /**
     * Single product sharing function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_single_sharing(){
        woocommerce_template_single_sharing();
    }
}

if ( !function_exists('etheme_woocommerce_show_product_images') ) {
    /**
     * Single product gallery function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_show_product_images(){
        /**
        * Single sale label 
        * @see etheme_woocommerce_sale_flash()
        */
        $sale_show = ( Kirki::get_option( 'product_sale_label_type_et-desktop' ) != 'none' );
        $sale_label_percentage = Kirki::get_option( 'product_sale_label_percentage_et-desktop' );
        if ( !$sale_show ) {
            add_filter('woocommerce_sale_flash', 'etheme_return_false', 20, 3);
        }
        elseif ( $sale_label_percentage ) {
            add_filter('etheme_sale_label_percentage', 'etheme_return_true', 15);
        }
        else {
            add_filter('etheme_sale_label_percentage', 'etheme_return_false', 15);
        }
        add_filter('etheme_sale_label_single', 'etheme_return_true', 15);

        woocommerce_show_product_images();

        remove_filter('etheme_sale_label_single', 'etheme_return_true', 15);
        if ( !$sale_show ) {
            remove_filter('woocommerce_sale_flash', 'etheme_return_false', 20, 3);
        }
        elseif ( $sale_label_percentage ) {
            remove_filter('etheme_sale_label_percentage', 'etheme_return_true', 15);
        }
        else {
            remove_filter('etheme_sale_label_percentage', 'etheme_return_false', 15);
        }
    }
}

if ( !function_exists('etheme_woocommerce_output_product_data_tabs') ) {
    /**
     * Single product tabs function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_output_product_data_tabs(){
        woocommerce_output_product_data_tabs();
    }
}

if ( !function_exists('etheme_woocommerce_output_upsell_products') ) {
    /**
     * Single product upsell products function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_output_upsell_products(){
        global $woocommerce_loop;
        $products_upsells_sale_label = Kirki::get_option( 'products_upsells_sale_label_et-desktop' );
        $products_upsell_view = Kirki::get_option( 'products_upsell_view_et-desktop' );

        if ( $products_upsells_sale_label ) {
            /**
            * Upsell product sale label 
            * @see etheme_return_false()
            */

            add_filter('woocommerce_sale_flash', 'etheme_return_false', 20, 3);
        }

        if ( $products_upsell_view ) {
            $before_view = false;
            if ( isset($woocommerce_loop['product_view'])) {
                $before_view = true;
                $before_related = $woocommerce_loop['product_view'];
            }

            $woocommerce_loop['product_view'] = 'disable';
        }

        /**
        * Upsell products args
        * @see etheme_set_upsells_product_args()
        */

        add_filter( 'product_type_grid', 'etheme_return_true' );
        add_filter( 'woocommerce_upsell_display_args', 'etheme_set_upsells_product_args' );
        add_filter( 'products_grid_align', 'etheme_set_related_product_align' );

        woocommerce_upsell_display();

        remove_filter( 'products_grid_align', 'etheme_set_related_product_align' );
        remove_filter( 'woocommerce_upsell_display_args', 'etheme_set_upsells_product_args' );
        remove_filter( 'product_type_grid', 'etheme_return_true' );

        if ( $products_upsell_view ) {
            if ( $before_view ) {
                $woocommerce_loop['product_view'] = $before_related;
            }
            else {
                unset($woocommerce_loop['product_view']);
            }
        }

        if ( $products_upsells_sale_label ) {
            remove_filter('woocommerce_sale_flash', 'etheme_return_false', 20, 3);
        }

        unset($products_upsells_sale_label);
    }
}

if ( !function_exists('etheme_woocommerce_output_related_products') ) {
    /**
     * Single product related products function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_output_related_products(){
        global $woocommerce_loop;
        $products_related_sale_label = Kirki::get_option( 'products_related_sale_label_et-desktop' );
        $products_related_view = Kirki::get_option( 'products_related_view_et-desktop' );

        if ( $products_related_sale_label ) {
            /**
            * Related product sale label 
            * @see etheme_return_false()
            */

            add_filter('woocommerce_sale_flash', 'etheme_return_false', 20, 3);
        }

        /**
        * Related products args
        * @see etheme_set_related_product_args()
        */

        if ( $products_related_view ) {
            $before_view = false;
            if ( isset($woocommerce_loop['product_view'])) {
                $before_view = true;
                $before_related = $woocommerce_loop['product_view'];
            }

            $woocommerce_loop['product_view'] = 'disable';
        }

        add_filter( 'product_type_grid', 'etheme_return_true' );
        add_filter('woocommerce_output_related_products_args', 'etheme_set_related_product_args');
        add_filter('products_grid_align', 'etheme_set_related_product_align');

        woocommerce_output_related_products();

        remove_filter('products_grid_align', 'etheme_set_related_product_align');
        remove_filter('woocommerce_output_related_products_args', 'etheme_set_related_product_args');
        remove_filter( 'product_type_grid', 'etheme_return_true' );

        if ( $products_related_view ) {
            if ( $before_view ) {
                $woocommerce_loop['product_view'] = $before_related;
            }
            else {
                unset($woocommerce_loop['product_view']);
            }
        }
        
        if ( $products_related_sale_label ) {
            remove_filter('woocommerce_sale_flash', 'etheme_return_false', 20, 3);
        }

        unset($products_related_sale_label);
    }
}

if ( !function_exists('etheme_set_related_product_args') ) {
    /**
     * Single product related product args function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @param array - default woocommerce settings of product loop for related products
     * @return array - settings
     */

    function etheme_set_related_product_args($args) {

        $args['posts_per_page'] = Kirki::get_option( 'products_related_limit_et-desktop' );
        $args['columns'] = Kirki::get_option( 'products_related_per_view_et-desktop' );

        return $args;
    }
}

if ( !function_exists('etheme_set_related_product_align') ) {
    /**
     * Single product related product align function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_set_related_product_align() {

        $align = Kirki::get_option( 'products_related_content_align_et-desktop' );
        $align = ( $align == 'inherit' ) ? Kirki::get_option( 'products_grid_content_align_et-desktop' ) : $align;

        return $align;
    }
}

if ( !function_exists('etheme_set_upsells_product_args') ) {
    /**
     * Single product upsell product args function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @param array - default woocommerce settings of product loop for upsell products
     * @return array - settings 
     */

    function etheme_set_upsells_product_args($args) {

        $args['posts_per_page'] = Kirki::get_option( 'products_upsell_limit_et-desktop' );
        $args['columns'] = Kirki::get_option( 'products_upsell_per_view_et-desktop' );

        return $args;
    }
}

if ( !function_exists('etheme_product_single_size_guide') ) {
    /**
     * Single product sizing guide function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_size_guide(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-size-guide.php' );
    }
}

if ( !function_exists('etheme_product_single_button') ) {
    /**
     * Single product sizing guide function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_button(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/button.php' );
    }
}

if ( !function_exists('etheme_product_single_widget_area_01') ) {
    /**
     * Single product widget area function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_widget_area_01() {
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-widget-area-1.php' );
    }
}

if ( !function_exists('etheme_product_single_custom_html_01') ) {
    /**
     * Single product custom html function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_custom_html_01(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-custom-html-01.php' );
    }
}

if ( !function_exists('etheme_product_single_custom_html_02') ) {
    /**
     * Single product custom html function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_custom_html_02(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-custom-html-02.php' );
    }
}

if ( !function_exists('etheme_product_single_custom_html_03') ) {
    /**
     * Single product custom html function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_custom_html_03(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-custom-html-03.php' );
    }
}

if ( !function_exists('etheme_product_single_additional_custom_block') ) {
    /**
     * Single product custom html function.
     *
     * @version 1.0.0
     * @since 2.2.1
     * @return string
     */

    function etheme_product_single_additional_custom_block(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-single-additional-custom-block.php' );
    }
}

if ( !function_exists('etheme_product_single_product_description') ) {
    /**
     * Single product custom html function.
     *
     * @version 1.0.0
     * @since 2.2.1
     * @return string
     */

    function etheme_product_single_product_description(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-single-description.php' );
    }
}

if ( !function_exists('etheme_product_single_wishlist') ) {
    /**
     * Single product wishlist function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_product_single_wishlist(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-wishlist.php' );
    }
}

if ( !function_exists('etheme_product_single_compare') ) {
    /**
     * Single product compare function.
     *
     * @version 1.0.0
     * @since 2.2.4
     * @return string
     */

    function etheme_product_single_compare(){
        require( ET_CORE_DIR . 'app/models/customizer/templates/woocommerce/single-product/etheme-product-compare.php' );
    }
}

if ( !function_exists('etheme_woocommerce_template_woocommerce_breadcrumb') ) {
    /**
     * Single product breadcrumbs function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_template_woocommerce_breadcrumb(){
        /**
        * Single product breadcrumbs args 
        * @see single_product_breadcrumb_delimiter()
        */
        add_filter('woocommerce_breadcrumb_stretch', 'etheme_return_single_product_breadcrumbs_width', 1, 10);

        add_filter( 'woocommerce_breadcrumb_delimiter', 'single_product_breadcrumb_delimiter', 1, 10 );

        add_filter('product_name_single', function(){
            return ( Kirki::get_option('product_breadcrumbs_mode_et-desktop') != 'element' && Kirki::get_option('product_breadcrumbs_product_title_et-desktop') );
        });

        woocommerce_breadcrumb();

        remove_filter( 'woocommerce_breadcrumb_delimiter', 'single_product_breadcrumb_delimiter', 1, 10 );

        remove_filter('woocommerce_breadcrumb_stretch', 'etheme_return_single_product_breadcrumbs_width', 1, 10);
    }
}

/**
 * Single product breadcrumbs width function.
 *
 * @version 1.0.0
 * @since 1.4.5
 * @return string
 */
function etheme_return_single_product_breadcrumbs_width() {
    return ( Kirki::get_option('product_breadcrumbs_mode_et-desktop') != 'element' ) ? Kirki::get_option( 'product_breadcrumbs_width_et-desktop' ) : 'default';
}

// filters 

if ( !function_exists('single_product_breadcrumb_delimiter') ) {
    /**
     * Single product breadcrumbs settings function.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @param array - $args of woocommerce single product breadcrumbs
     * @return array
     */

    function single_product_breadcrumb_delimiter($sep) {
        $options = array();
        $options['product_breadcrumbs_type'] = Kirki::get_option( 'product_breadcrumbs_type_et-desktop' );
        $options['product_breadcrumbs_types'] = array (
            'type1' => '<span class="delimeter" style="vertical-align: middle;"><i style="font-family: auto; font-size: 2em;">&#8226;</i></span>',
            'type2' => '<span class="delimeter"><i class="et-icon et-right-arrow"></i></span>',
            'type3' => '<span class="delimeter" style="vertical-align: middle;"><i style="font-family: auto; font-size: 2em;">&nbsp;&#47;&nbsp;</i></span>',
        );

        $separator = $options['product_breadcrumbs_types'][$options['product_breadcrumbs_type']];
        
        unset($options);

        return $separator;
    }
}

function etheme_woocommerce_cart_item_quantity($product_quantity, $cart_item_key, $cart_item) {
    ob_start();
    etheme_woocommerce_before_add_to_cart_quantity();
    echo $product_quantity;
    etheme_woocommerce_after_add_to_cart_quantity();

    return ob_get_clean();
}

if ( !function_exists('etheme_woocommerce_before_add_to_cart_quantity') ) {
    /**
     * Single product quantity wrapper start and minus icon.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_before_add_to_cart_quantity($style='') {
        $element_option = ( $style != '' ) ? $style : Kirki::get_option( 'product_quantity_style_et-desktop' );
        $element_option = apply_filters('product_quantity_style', $element_option);
        $ghost = is_customize_preview() && $element_option == 'none';
        // start of wrapper to make quantity correct showing ?>
        <div class="quantity-wrapper type-<?php echo $element_option; ?>">
        <?php if ( $element_option != 'none' || $ghost ) : ?>
            <span class="minus et-icon et_b-icon <?php echo ($ghost) ? 'none' : ''; ?>">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width=".7em" height=".7em" viewBox="0 0 24 24">
                    <path d="M23.52 11.4h-23.040c-0.264 0-0.48 0.216-0.48 0.48v0.24c0 0.264 0.216 0.48 0.48 0.48h23.040c0.264 0 0.48-0.216 0.48-0.48v-0.24c0-0.264-0.216-0.48-0.48-0.48z"></path>
                </svg>
            </span>
        <?php endif;
        unset($element_option);
    }
}

if ( !function_exists('etheme_woocommerce_after_add_to_cart_quantity') ) {
    /**
     * Single product quantity wrapper end and plus icon.
     *
     * @version 1.0.0
     * @since 1.4.5
     * @return string
     */

    function etheme_woocommerce_after_add_to_cart_quantity($style = '') {
        $element_option = ( $style != '' ) ? $style : Kirki::get_option( 'product_quantity_style_et-desktop' );
        $element_option = apply_filters('product_quantity_style', $element_option);
        $ghost = is_customize_preview() && $element_option == 'none';
        if ( $element_option != 'none' || $ghost ) : ?>
            <span class="plus et-icon et_b-icon <?php echo ($ghost) ? 'none' : ''; ?>">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width=".7em" height=".7em" viewBox="0 0 24 24">
                    <path d="M23.52 11.4h-10.92v-10.92c0-0.264-0.216-0.48-0.48-0.48h-0.24c-0.264 0-0.48 0.216-0.48 0.48v10.92h-10.92c-0.264 0-0.48 0.216-0.48 0.48v0.24c0 0.264 0.216 0.48 0.48 0.48h10.92v10.92c0 0.264 0.216 0.48 0.48 0.48h0.24c0.264 0 0.48-0.216 0.48-0.48v-10.92h10.92c0.264 0 0.48-0.216 0.48-0.48v-0.24c0-0.264-0.216-0.48-0.48-0.48z"></path>
                    </svg>
                </span>
            <?php endif; ?>
        </div>
        <?php // end of wrapper to make quantity correct showing
        unset($element_option);
    }
}

if ( get_option('etheme_single_product_builder', false) ) {

    add_action('wp', function() {

        $actions = $filters = array();

        $actions['add'] = array (
            array(
                'action' => 'etheme_woocommerce_template_single_title',
                'function' => 'etheme_woocommerce_template_single_title',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_template_single_rating',
                'function' => 'etheme_woocommerce_template_single_rating',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_template_single_price',
                'function' => 'etheme_woocommerce_template_single_price',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_template_single_excerpt',
                'function' => 'etheme_woocommerce_template_single_excerpt',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_template_single_add_to_cart',
                'function' => 'etheme_woocommerce_template_single_add_to_cart',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_template_single_meta',
                'function' => 'etheme_woocommerce_template_single_meta',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_template_woocommerce_breadcrumb',
                'function' => 'etheme_woocommerce_template_woocommerce_breadcrumb',
                'priority' => 10
            ),

            array(
                'action' => 'woocommerce_share',
                'function' => 'etheme_product_single_sharing',
                'priority' => 20
            ),
            array(
                'action' => 'etheme_woocommerce_template_single_sharing',
                'function' => 'etheme_woocommerce_template_single_sharing',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_show_product_images',
                'function' => 'etheme_woocommerce_show_product_images',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_output_product_data_tabs',
                'function' => 'etheme_woocommerce_output_product_data_tabs',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_output_upsell_products',
                'function' => 'etheme_woocommerce_output_upsell_products',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_woocommerce_output_related_products',
                'function' => 'etheme_woocommerce_output_related_products',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_size_guide',
                'function' => 'etheme_product_single_size_guide',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_button',
                'function' => 'etheme_product_single_button',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_widget_area_01',
                'function' => 'etheme_product_single_widget_area_01',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_custom_html_01',
                'function' => 'etheme_product_single_custom_html_01',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_custom_html_02',
                'function' => 'etheme_product_single_custom_html_02',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_custom_html_03',
                'function' => 'etheme_product_single_custom_html_03',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_additional_custom_block',
                'function' => 'etheme_product_single_additional_custom_block',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_product_description',
                'function' => 'etheme_product_single_product_description',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_wishlist',
                'function' => 'etheme_product_single_wishlist',
                'priority' => 10
            ),
            array(
                'action' => 'etheme_product_single_compare',
                'function' => 'etheme_product_single_compare',
                'priority' => 10
            ),
        );
    
        if ( function_exists('dokan_get_option') && class_exists('Dokan_SPMV_Products') ) {

            $enable_option = dokan_get_option( 'enable_pricing', 'dokan_spmv', 'off' );
            $display_position = dokan_get_option( 'available_vendor_list_position', 'dokan_spmv', 'below_tabs' );

            if ( filter_var( $enable_option, FILTER_VALIDATE_BOOLEAN ) ) {

                $priority = ('after_tabs' == $display_position) ? 12 : 1;

                if ( in_array($display_position, array('below_tabs', 'after_tabs') ) ) {

                    $actions['add'][] = array(
                        'action' => 'etheme_woocommerce_output_product_data_tabs',
                        'function' => 'etheme_product_single_dokan_vendor_comparison',
                        'priority' => $priority
                    );

                }
            }

        }

        if ( function_exists('get_query_var') && !get_query_var( 'etheme_shop_archive_product_variation_gallery', false ) ) {
            add_filter( 'woocommerce_product_loop_start', 'remove_et_variation_gallery_filter' );
            add_filter( 'woocommerce_product_loop_end', 'add_et_variation_gallery_filter' );
        }

        foreach ( $actions['add'] as $key ) {
            add_action( $key['action'], $key['function'], $key['priority'] );
        }

        add_action( 'connect_block', 'etheme_connect_block_product_single', 10, 1 );

        unset($actions);
        unset($filters);

    }, 20);

    function etheme_connect_block_product_single($blockID){
        add_filter( 'et_connect_block_id', function($id) use ($blockID){ return $blockID; } );
        require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/connect_block.php' );
        // get_template_part( 'template-parts/header/parts/connect_block' );
    }

}

/**
 * Dokan vendor comparison .
 *
 * Show dokan vendor comparison .
 *
 * @since 2.2.4
 * @version 1.0.0
 * @return {html} dokan vendor comparison  
 *
 */
if ( !function_exists('etheme_product_single_dokan_vendor_comparison') ) {
    function etheme_product_single_dokan_vendor_comparison() {
        if ( function_exists('dokan_get_option') && class_exists('Dokan_SPMV_Products') ) {
            $obj = new Dokan_SPMV_Products();
            $obj->show_vendor_comparison();
        }
    }
}

/**
 * Sticky add to cart.
 *
 * Show add to cart with current img and price.
 *
 * @since 1.4.5
 * @version 1.0.0
 * @return {html} sticky cart content 
 *
 */

if ( !function_exists('etheme_woocommerce_after_single_product') ) {
    function etheme_woocommerce_after_single_product () {
        $element_option = Kirki::get_option( 'sticky_add_to_cart_et-desktop' ); 
        $ghost = is_customize_preview() && !$element_option;
        $is_mobile = wp_is_mobile();
        if ( !$element_option && !$ghost ) return; ?>

        <?php 
            remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
            remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
            remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 ); 
            add_action('woocommerce_grouped_add_to_cart', 'etheme_custom_add_to_cart', 30);
            add_action('woocommerce_variable_add_to_cart', 'etheme_custom_add_to_cart', 30);
            add_action('woocommerce_external_add_to_cart', 'etheme_custom_add_to_cart', 30); ?>
        <div class="etheme-sticky-cart flex align-items-center container-width-inherit <?php echo ( $ghost ) ? ' dt-hide mob-hide' : ''; ?>">
            <div class="et-row-container et-container">
                <div class="et-wrap-columns flex align-items-center">
                    <div class="et_column et_col-xs-5 flex-inline align-items-center mob-hide">
                        <?php 
                            if ( has_post_thumbnail() ) { ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="flex-inline"><?php the_post_thumbnail(); ?></a> <?php
                            }
                            else {
                                ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="flex-inline"><?php echo wc_placeholder_img(); ?></a> <?php
                            }
                            ?>
                            <span class="sticky_product_title">
                                <?php $full_title = $product_title = unicode_chars(get_the_title());
                                    $title_limit = 30;

                                    if ( $title_limit && strlen($product_title) > $title_limit) {
                                        $split = preg_split('/(?<!^)(?!$)/u', $product_title);
                                        $product_title = ($title_limit != '' && $title_limit > 0 && (count($split) >= $title_limit)) ? '' : $product_title;
                                        if ( $product_title == '' ) {
                                            for ($i=0; $i < $title_limit; $i++) { 
                                                $product_title .= $split[$i];
                                            }
                                            $product_title .= '...';
                                        }
                                    } 
                                    echo esc_attr($product_title); ?>
                            </span>
                            <?php 
                        ?>
                    </div>
                    <div class="et_column et_col-xs-7 flex-inline align-items-center justify-content-end mob-full-width mob-justify-content-center">
                        <?php
                            if ( !$is_mobile )
                                woocommerce_template_single_price();
                            
                            if ( !etheme_get_option('just_catalog') ) {
                                if ( $is_mobile ) {
                                    add_filter('woocommerce_get_stock_html', 'etheme_return_false');
                                }
                                etheme_woocommerce_template_single_add_to_cart();
                                if ( $is_mobile ) {
                                    remove_filter('woocommerce_get_stock_html', 'etheme_return_false');
                                }
                            }
                        ?>
                        <!-- <button onclick="etCoreScript.closeStickyAddToCart();" >
                            <svg xmlns="http://www.w3.org/2000/svg" width=".5em" height=".5em" fill="#222" viewBox="0 0 24 24">
                                <path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
                            </svg>
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
        <?php 
        remove_action('woocommerce_grouped_add_to_cart', 'etheme_custom_add_to_cart', 30);
        remove_action('woocommerce_variable_add_to_cart', 'etheme_custom_add_to_cart', 30);
        remove_action('woocommerce_external_add_to_cart', 'etheme_custom_add_to_cart', 30);
        add_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
        add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
        add_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 ); 

        unset($element_option);
    }
}

/**
 * Sticky add to cart button.
 *
 * Element for trigger scroll to real cart form - uses for not simple products.
 *
 * @since 1.4.5
 * @version 1.0.0
 * @return {html} sticky add to cart button 
 *
 */

if ( !function_exists('etheme_custom_add_to_cart') ) {

    function etheme_custom_add_to_cart () {
        ?>
        <div class="etheme_custom_add_to_cart button single_add_to_cart_button pointer"><?php esc_html_e('Buy now', 'xstore-core'); ?></div>
        <?php        
    }

}

/**
 * Custom product tabs.
 *
 * Function to add custom tabs inside defalt woocommerce tabs and sort them.
 *
 * @since 1.4.5
 * @version 1.0.1
 * @param {array} woocommerce tabs
 * @return {array} - sorted and added/removed tabs
 */

if ( !function_exists('etheme_single_product_custom_tabs') ) {
    function etheme_single_product_custom_tabs( $tabs ) {
        
        $element_options = array();
        $element_options['product_tabs_sortable'] = Kirki::get_option('product_tabs_sortable');
        $element_options['product_tabs_custom_tab_01_title'] = Kirki::get_option( 'product_tabs_custom_tab_01_title_et-desktop' );
        $element_options['product_tabs_custom_tab_02_title'] = Kirki::get_option( 'product_tabs_custom_tab_02_title_et-desktop' );
        // single product custom tab 
        $element_options['custom_tab'] = (function_exists('etheme_get_custom_field')) ? etheme_get_custom_field( 'custom_tab1_title' ) : false;
        $element_options['custom_tab_content'] = (function_exists('etheme_get_custom_field')) ? etheme_get_custom_field('custom_tab1') : false; 

        // Adds the new tab
        
        if ( $element_options['product_tabs_custom_tab_01_title'] ) {

            $tabs['et_custom_tab_01'] = array(
                'title'     => $element_options['product_tabs_custom_tab_01_title'],
                'priority'  => 40,
                'callback'  => 'etheme_single_product_custom_tab_01_content'
            );
        }

        if ( $element_options['product_tabs_custom_tab_02_title'] ) {
            $tabs['et_custom_tab_02'] = array(
                'title'     => $element_options['product_tabs_custom_tab_02_title'],
                'priority'  => 50,
                'callback'  => 'etheme_single_product_custom_tab_02_content'
            );
        }

        if ( $element_options['custom_tab'] ) {
            $custom_content = $element_options['custom_tab_content'];
            $tabs['single_custom_tab_01'] = array(
                'title'     => $element_options['custom_tab'],
                'priority'  => 60,
                'callback'  => function($custom) use ($custom_content) { echo do_shortcode($custom_content); }
            );
        } 

        $priority = 10;
        $tabs_filtered = array();
        foreach ((array)$element_options['product_tabs_sortable'] as $key) {
            if (!isset($tabs[$key])) continue;
            $tabs[$key]['priority'] = $priority;
            $tabs_filtered[$key] = $tabs[$key];
            $priority += 10;
        }

        unset($custom_content);
        unset($element_options);
        return apply_filters('etheme_single_product_builder_tabs', $tabs_filtered);

    }
}


/**
 * Custom tab 01 content.
 *
 * Custom tab 01 content for woocommerce custom tabs.
 *
 * @since 1.4.5
 *
 * @see { etheme_single_product_custom_tabs } function
 * @uses { etheme_single_product_custom_tabs } function 
 *
 * @return Custom tab content.
 */
if ( !function_exists('etheme_single_product_custom_tab_01_content') ) {

    function etheme_single_product_custom_tab_01_content() {

        $element_options = array();
        $element_options['product_tabs_custom_tab_01_content_et-desktop'] = Kirki::get_option( 'product_tabs_custom_tab_01_content_et-desktop' );
        $element_options['product_tabs_custom_tab_01_section_et-desktop'] = ( Kirki::get_option( 'product_tabs_custom_tab_01_sections_et-desktop' ) ) ? Kirki::get_option( 'product_tabs_custom_tab_01_section_et-desktop' ) : '';
        $element_options['product_tabs_custom_tab_01_content_et-desktop'] = ( $element_options['product_tabs_custom_tab_01_section_et-desktop'] != '' && $element_options['product_tabs_custom_tab_01_section_et-desktop'] > 0 ) ? $element_options['product_tabs_custom_tab_01_section_et-desktop'] : $element_options['product_tabs_custom_tab_01_content_et-desktop'];

        if ( $element_options['product_tabs_custom_tab_01_section_et-desktop'] != '' && function_exists('etheme_static_block') ) {
            $element_options['section_css'] = get_post_meta($element_options['product_tabs_custom_tab_01_section_et-desktop'], '_wpb_shortcodes_custom_css', true);
            if(!empty($element_options['section_css'])) {
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo strip_tags($element_options['section_css']);
                echo '</style>';
            }

            etheme_static_block($element_options['product_tabs_custom_tab_01_section_et-desktop'], true);

        } else {
            echo do_shortcode( $element_options['product_tabs_custom_tab_01_content_et-desktop'] );
        }
        
    }
}

/**
 * Custom tab 02 content.
 *
 * Custom tab 02 content for woocommerce custom tabs.
 *
 * @since 1.4.5
 *
 * @see { etheme_single_product_custom_tabs } function
 * @uses { etheme_single_product_custom_tabs } function 
 *
 * @return Custom tab content.
 */
if ( !function_exists('etheme_single_product_custom_tab_02_content') ) {

    function etheme_single_product_custom_tab_02_content() {

        $element_options = array();
        $element_options['product_tabs_custom_tab_02_content_et-desktop'] = Kirki::get_option( 'product_tabs_custom_tab_02_content_et-desktop' );
        $element_options['product_tabs_custom_tab_02_section_et-desktop'] = ( Kirki::get_option( 'product_tabs_custom_tab_02_sections_et-desktop' ) ) ? Kirki::get_option( 'product_tabs_custom_tab_02_section_et-desktop' ) : '';
        $element_options['product_tabs_custom_tab_02_content_et-desktop'] = ( $element_options['product_tabs_custom_tab_02_section_et-desktop'] != '' && $element_options['product_tabs_custom_tab_02_section_et-desktop'] > 0 ) ? $element_options['product_tabs_custom_tab_02_section_et-desktop'] : $element_options['product_tabs_custom_tab_02_content_et-desktop'];

        if ( $element_options['product_tabs_custom_tab_02_section_et-desktop'] != '' && function_exists('etheme_static_block') ) {
            $element_options['section_css'] = get_post_meta($element_options['product_tabs_custom_tab_02_section_et-desktop'], '_wpb_shortcodes_custom_css', true);
            if(!empty($element_options['section_css'])) {
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo strip_tags($element_options['section_css']);
                echo '</style>';
            }

            etheme_static_block($element_options['product_tabs_custom_tab_02_section_et-desktop'], true);

        } else {
            echo do_shortcode( $element_options['product_tabs_custom_tab_02_content_et-desktop'] );
        }
        
    }
}

/**
 * Single wishlist shortcode filter function.
 *
 * @version 1.0.1
 * @see templates/woocommerce/single-product/etheme-product-wishlist
 * @since 1.4.5
 * @param array - params of wishlist shorcode
 * @return array
 */
if ( !function_exists('etheme_yith_wcwl_add_to_wishlist_params') ) {
    function etheme_yith_wcwl_add_to_wishlist_params($params) {

        global $et_wishlist_icons;

        $element_options = array();

        $element_options['is_customize_preview'] = is_customize_preview();

        $params['icon'] = false;
        $params['label'] = $params['browse_wishlist_text'] = '';
        $params['already_in_wishslist_text'] = $params['product_added_text'] = false;

        $element_options['icon_type'] = etheme_get_option('product_wishlist_icon_et-desktop');

        // if ( !Kirki::get_option('bold_icons') ) { 
        //     $element_options['wishlist_icons'] = $et_wishlist_icons['light'];
        // }
        // else {
        //     $element_options['wishlist_icons'] = $et_wishlist_icons['bold'];
        // }

        // $element_options['wishlist_icons']['custom'] = Kirki::get_option( 'wishlist_icon_custom_et-desktop' );

        // $element_options['wishlist_icon'] = $element_options['wishlist_icons'][$element_options['icon_type']];

        switch ($element_options['icon_type']) {
            case 'type1':
                $element_options['wishlist_icon'] = (( isset($params['template_part']) && $params['template_part'] == 'button' ) ? 'et-icon et_b-icon et-heart' : 'et-icon et_b-icon et-heart-o');
                break;
            case 'type2':
                $element_options['wishlist_icon'] = (( isset($params['template_part']) && $params['template_part'] == 'button' ) ? 'et-icon et_b-icon et-star' : 'et-icon et_b-icon et-star-o');
                break;

            default:
                $element_options['wishlist_icon'] = '';
                break;
        }

        $element_options['ghost_icon'] = empty($element_options['wishlist_icon']) && $element_options['is_customize_preview'];
        if ( !empty($element_options['wishlist_icon']) || $element_options['ghost_icon'] )
            $element_options['wishlist_icon'] = 'et-icon et_b-icon '. $element_options['wishlist_icon'] . ($element_options['ghost_icon'] ? ' none' : '');

        $tips_class = '';
        if ( etheme_get_option('product_wishlist_label_type_et-desktop') == 'tooltip' )
            $tips_class = 'mt-mes';
        // $params['label'] = $element_options['wishlist_icon'] . '<span class="'.$tips_class.'">' . etheme_get_option('product_wishlist_label_add_to_wishlist') . '</span>';
        // $params['label'] = '<i class="et-icon et_b-icon ' . $element_options['wishlist_icon'] . '"></i>' . '<span class="'.$tips_class.'">' . etheme_get_option('product_wishlist_label_add_to_wishlist') . '</span>';
        // $params['browse_wishlist_text'] = $element_options['wishlist_icon'] . '<span class="'.$tips_class.'">' . etheme_get_option('product_wishlist_label_browse_wishlist') . '</span>';
        // $params['icon'] = $element_options['wishlist_icon'];
        $params['label'] = '<i class="' . $element_options['wishlist_icon'] . '"></i>' . '<span class="'.$tips_class.'">' . etheme_get_option('product_wishlist_label_add_to_wishlist') . '</span>';
        $params['browse_wishlist_text'] = '<span class="'.$tips_class.'">' . etheme_get_option('product_wishlist_label_browse_wishlist') . '</span>';
        if ( isset($params['template_part']) ) {
            if ( $params['template_part'] != 'button' ) {
                $params['browse_wishlist_text'] = '<i class="' . $element_options['wishlist_icon'] . '"></i>' . $params['browse_wishlist_text'];
            }
        }
        else {
            $params['browse_wishlist_text'] = '<i class="' . $element_options['wishlist_icon'] . '"></i>' . $params['browse_wishlist_text'];
        }
        
        return $params;
    }
}

/**
 * Actions and filters.
 * add/remove filter for header builder and single product builder 
 *
 * @since 1.4.0
 */
add_action('wp', 'etheme_core_hooks', 70);
if(!function_exists('etheme_core_hooks')) {
    function etheme_core_hooks() {
        if ( get_option('etheme_single_product_builder', false) ) {

            $product_reviews = !in_array('reviews', (array) Kirki::get_option('product_tabs_sortable')) && Kirki::get_option( 'product_reviews_et-desktop' );
            if ( $product_reviews && post_type_supports( 'product', 'comments' ) ) {
                add_action( 'etheme_woocommerce_output_product_data_tabs', 'comments_template', 30 );
            }

            // related products 
            add_filter('related_slides', function($responsive_slides) {
                $responsive_slides['large'] = etheme_get_option('products_related_per_view_et-desktop');
                return $responsive_slides;
            });

            add_filter('related_columns', function($columns) {
                return etheme_get_option('products_related_per_view_et-desktop');
            });

            add_filter('related_limit', function($limit) {
                return etheme_get_option('products_related_limit_et-desktop');
            });

            add_filter('related_type', function($type) {
                return etheme_get_option('products_related_type_et-desktop');
            });

            add_filter('related_cols_gap', function($cols_gap) {
                return etheme_get_option('products_related_cols_gap_et-desktop');
            });

            // upsell products 
            add_filter('upsells_slides', function($responsive_slides) {
                $responsive_slides['large'] = etheme_get_option('products_upsell_per_view_et-desktop');
                return $responsive_slides;
            });

            add_filter('upsell_columns', function($columns) {
                return etheme_get_option('products_upsell_per_view_et-desktop');
            });

            add_filter('upsell_limit', function($limit) {
                return etheme_get_option('products_upsell_limit_et-desktop');
            });

            add_filter('upsell_type', function($type) {
                return etheme_get_option('products_upsell_type_et-desktop');
            });

            add_filter('upsell_cols_gap', function($cols_gap) {
                return etheme_get_option('products_upsell_cols_gap_et-desktop');
            });

            add_filter( 'woocommerce_product_tabs', 'etheme_single_product_custom_tabs', 98 );

            if ( class_exists('WooCommerce') && is_product() ) {
                remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
                add_action('woocommerce_before_main_content', 'etheme_woocommerce_template_woocommerce_breadcrumb', 20);
                if ( Kirki::get_option('product_breadcrumbs_mode_et-desktop') == 'element') {
                    remove_action( 'woocommerce_before_main_content', 'etheme_woocommerce_template_woocommerce_breadcrumb', 20 );
                }

                add_filter('return_to_previous', function() {
                    return (Kirki::get_option('product_breadcrumbs_return_to_previous_et-desktop'));
                });

                add_filter('breadcrumb_params', function($params) {
                    $type = Kirki::get_option('product_breadcrumbs_style_et-desktop');
                    if ( $type != 'inherit') {
                        $params['type'] = $type;
                    }
                    return $params;
                });
            }

            add_action('woocommerce_before_add_to_cart_button', function() {
                echo '<span class="hidden et-ghost-inline-block dir-' . apply_filters('product_quantity_direction', Kirki::get_option( 'product_cart_form_direction_et-desktop' ) ) . '"></span>';
            });
        }
    }
}
