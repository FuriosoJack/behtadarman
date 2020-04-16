<?php
namespace ETC\App\Controllers\Shortcodes;

use ETC\App\Controllers\Shortcodes;

/**
 * Products shortcode.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controllers/Shortcodes
 */
class Products extends Shortcodes {

    function hooks() {}

    function products_shortcode( $atts, $content ) {
        if ( etheme_woocommerce_notice() ) return;
        
        global $wpdb, $woocommerce_loop;

        $atts = shortcode_atts(array(
            'ids' => '',
            'columns' => 4,
            'shop_link' => 1,
            'limit' => 20,
            'taxonomies' => '',
            'type' => 'slider',
            'navigation' => 'off',
            'per_iteration' => '',
            // 'first_loaded' => 4,
            'style' => 'default',
            'show_counter' => '',
            'show_stock' => '',
            'products' => '', //featured new sale bestsellings recently_viewed
            'title' => '',
            'hide_out_stock' => '',
            'large' => 4,
            'notebook' => 3,
            'tablet_land' => 2,
            'tablet_portrait' => 2,
            'mobile' => 1,
            'slider_autoplay' => false,
            'slider_interval' => 3000,
            'slider_speed' => 300,
            'slider_loop' => false,
            'slider_stop_on_hover' => false,
            'pagination_type' => 'hide',
            'nav_color'          => '',
            'arrows_bg_color'    => '',
            'default_color' => '#e1e1e1',
            'active_color' => '#222',
            'hide_fo' => '',
            'hide_buttons' => false,
            'hide_buttons_for'   => '',
            'orderby' => 'date',
            'no_spacing' => '',
            'order' => 'ASC',
            'product_view' => '',
            'product_view_color' => '',
            'product_img_hover' => '',
            'custom_template' => '',
            'per_move' => 1,
            'autoheight' => false,
            'ajax' => false,
            'class' => '',
            'css' => '',
            'is_preview' => false
        ), $atts);

        if ( $atts['is_preview'] ) 
            add_filter('etheme_output_shortcodes_inline_css', function() { return true; });

        $options = array();

        $woocommerce_loop['product_view'] = $atts['product_view'];
        $woocommerce_loop['product_view_color'] = $atts['product_view_color'];
        $woocommerce_loop['hover'] = $atts['product_img_hover'];
        $woocommerce_loop['show_counter'] = $atts['show_counter'];
        $woocommerce_loop['show_stock'] = $atts['show_stock'];
        if ( !empty($atts['custom_template']) ) $woocommerce_loop['custom_template'] = $atts['custom_template'];

        if ( ! $atts['is_preview'] && $atts['ajax'] && $atts['navigation'] != 'lazy' ) {
            $options['extra'] = ( $atts['type'] == 'slider' ) ? 'slider' : '';
            return et_ajax_element_holder( 'etheme_products', $atts, $options['extra'] );
        }

        $options['wp_query_args'] = array(
            'post_type'             => 'product',
            'ignore_sticky_posts'   => 1,
            'no_found_rows'         => 1,
            'posts_per_page'        => $atts['limit'],
            'orderby'               => $atts['orderby'],
            'order'                 => $atts['order'],
        );

        if ($atts['hide_out_stock']) {
            $options['wp_query_args']['meta_query'] = array(
                array (
                    'key' => '_stock_status',
                    'value' => 'instock',
                    'compare' => '='
                ),
            );
        }

        $options['wp_query_args']['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'hidden',
            'operator' => 'NOT IN',
        );

        switch ( $atts['products'] ) {

            case 'featured':
                $options['featured_product_ids'] = wc_get_featured_product_ids();
                $options['wp_query_args']['post__in'] = array_merge( array( 0 ), $options['featured_product_ids'] );
            break;

            case 'sale':
                $options['product_ids_on_sale'] = wc_get_product_ids_on_sale();
                $options['wp_query_args']['post__in'] = array_merge( array( 0 ), $options['product_ids_on_sale'] );
            break;

            case 'bestsellings':
                $options['wp_query_args']['meta_key'] = 'total_sales';
                $options['wp_query_args']['orderby'] = 'meta_value_num';
            break;

            case 'recently_viewed':
                $options['viewed_products'] = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
                $options['viewed_products'] = array_filter( array_map( 'absint', $options['viewed_products'] ) );

                 set_query_var('recently_viewed', true);

                if ( empty( $options['viewed_products'] ) )
                    return;

                $options['wp_query_args']['post__in'] = $options['viewed_products'];
                $options['wp_query_args']['orderby'] = 'rand';

            break;

        }

        if ( $atts['type'] == 'slider' && $atts['slider_stop_on_hover'] ) 
            $atts['class'] .= ' stop-on-hover';

        if( ! empty($atts['css']) && function_exists( 'vc_shortcode_custom_css_class' ) )
            $atts['class'] .= ' ' . vc_shortcode_custom_css_class( $atts['css'] );

        if ($atts['orderby'] == 'price') {
            $options['wp_query_args']['meta_key'] = '_price';
            $options['wp_query_args']['orderby'] = 'meta_value_num';
        }

        if($atts['ids'] != ''){
            if ( !is_array($atts['ids']) ) {
                $atts['ids'] = explode(',', $atts['ids']);
            }
            $atts['ids'] = array_map('trim', $atts['ids']);
            $options['wp_query_args']['post__in'] = $atts['ids'];
        }

        // Narrow by categories
        if( ! empty( $atts['taxonomies'] ) ) {
            $options['taxonomy_names'] = get_object_taxonomies( 'product' );
            $options['terms'] = get_terms( $options['taxonomy_names'], array(
                'orderby' => 'name',
                'include' => $atts['taxonomies']
            ));

            if( ! is_wp_error( $options['terms'] ) && ! empty( $options['terms'] ) ) {
                $options['wp_query_args']['tax_query'] = array('relation' => 'OR');
                foreach ($options['terms'] as $key => $term) {
                    $options['wp_query_args']['tax_query'][] = array(
                        'taxonomy' => $term->taxonomy,
                        'field' => 'slug',
                        'terms' => array( $term->slug ),
                        'include_children' => true,
                        'operator' => 'IN'
                    );
                }
            }
        }

        ob_start();

        switch ($atts['type']) {
            case 'slider':
                $options['slider_args'] = array(
                    'title' => $atts['title'],
                    'shop_link' => $atts['shop_link'],
                    'slider_type' => false,
                    'style' => $atts['style'],
                    'no_spacing' => $atts['no_spacing'],
                    'large' => (int)$atts['large'],
                    'notebook' => (int)$atts['notebook'],
                    'tablet_land' => (int)$atts['tablet_land'],
                    'tablet_portrait' => (int)$atts['tablet_portrait'],
                    'mobile' => (int)$atts['mobile'],
                    'slider_autoplay' => $atts['slider_autoplay'],
                    'slider_interval' => $atts['slider_interval'],
                    'slider_speed' => $atts['slider_speed'],
                    'slider_loop' => $atts['slider_loop'],
                    'pagination_type' => $atts['pagination_type'],
                    'nav_color'       => $atts['nav_color'],
                    'arrows_bg_color' => $atts['arrows_bg_color'],
                    'default_color' => $atts['default_color'],
                    'active_color' => $atts['active_color'],
                    'hide_buttons' => $atts['hide_buttons'],
                    'hide_buttons_for' => $atts['hide_buttons_for'],
                    'hide_fo' => $atts['hide_fo'],
                    'per_move' => $atts['per_move'],
                    'autoheight' => $atts['autoheight'],
                    'class' => ( !empty($atts['custom_template']) ) ? 'products-with-custom-template products-template-'.$atts['custom_template']. $atts['class'] : $atts['class'],
                    'attr' => ( !empty($atts['custom_template']) ) ? 'data-post-id="'.$atts['custom_template'].'"' : '',
                    'echo' => true,
                    'is_preview' => $atts['is_preview'],
                );
                etheme_slider( $options['wp_query_args'], 'product', $options['slider_args'] );
                break;
            case 'full-screen':
                $options['slider_args'] = array(
                    'title' => $atts['title'],
                    'class' => $atts['class']
                );
                echo etheme_fullscreen_products($options['wp_query_args'], $options['slider_args']);
                break;
            
            default:
                // ! Add attr for lazy loading
                $options['atts'] = $options['extra'] = array();
                $options['extra']['navigation'] = $atts['navigation'];
                if ( $atts['navigation'] != 'off' ) {
                    if ( isset( $options['wp_query_args']['post__in'] ) ) 
                        $options['atts'][] = 'ids="' . implode( ',', $options['wp_query_args']['post__in'] ) . '"';

                    if ( isset( $options['wp_query_args']['orderby'] ) ) 
                        $options['atts'][] = 'orderby="' . $options['wp_query_args']['orderby'] . '"';

                    if ( isset( $options['wp_query_args']['order'] ) ) 
                        $options['atts'][] = 'order="' . $options['wp_query_args']['order'] . '"';

                    if ( $atts['hide_out_stock'] ) 
                        $options['atts'][] = 'stock="true"';

                    if ( $atts['products'] ) 
                        $options['atts'][] = 'type="' . $atts['products'] . '"';

                    if ( ! empty( $atts['taxonomies'] ) ) 
                        $options['atts'][] = 'taxonomies="' . $atts['taxonomies'] . '"';

                    if ( ! empty( $atts['product_view'] ) ) 
                        $options['atts'][] = 'product_view="' . $atts['product_view'] . '"';

                    // if ( ! empty($atts['custom_template']) ) 
                        // $options['atts'][] = 'custom_template="' . $atts['custom_template'] . '"'

                    if ( ! empty( $atts['product_view_color'] ) ) 
                        $options['atts'][] = 'product_view_color="' . $atts['product_view_color'] . '"';

                    if ( ! empty( $atts['product_img_hover'] ) ) 
                        $options['atts'][] = 'hover="' . $atts['product_img_hover'] . '"';

                    if ( $atts['show_counter'] ) 
                        $options['atts'][] = 'show_counter="true"';

                    if ( $atts['show_stock'] ) 
                        $options['atts'][] = 'show_stock="true"';

                    // if ( $atts['first_loaded'] > $atts['limit'] ) 
                    //     $atts['first_loaded'] = $atts['limit'];

                    $options['extra']['per-page'] = ( $atts['limit'] != -1 && $atts['limit'] < $atts['columns'] ) ? $atts['limit'] : $atts['columns'];

                    if ( $atts['per_iteration'] && ( $atts['limit'] == -1 || $atts['limit'] >= $atts['per_iteration'] ) )
                        $options['extra']['per-page'] = $atts['per_iteration'];

                    $options['extra']['limit'] = $atts['limit'];
                    $options['extra']['columns'] = $atts['columns'];

                    $options['atts'][] = 'columns="' . $atts['columns'] . '"';
                    $options['atts'][] = 'per-page="' . $options['extra']['per-page'] . '"';
                }

                // ! Add attr for lazy loading end.
                $woocommerce_loop['view_mode'] = $atts['type'];
                echo '<div class="etheme_products ' . $atts['class'] . '"' . implode(' ', $options['atts']) . '>';
                    echo etheme_products( $options['wp_query_args'], $atts['title'], $atts['columns'], $options['extra'] );
                echo '</div>';
                unset($woocommerce_loop['view_mode']);
                break;
        }

        unset($woocommerce_loop['product_view']);
        unset($woocommerce_loop['product_view_color']);
        unset($woocommerce_loop['hover']);
        unset($woocommerce_loop['show_counter']);
        unset($woocommerce_loop['show_stock']);
        if ( !empty($atts['custom_template']) ) unset($woocommerce_loop['custom_template']);

        unset($options);
        unset($atts);

        return ob_get_clean();
    }
}
