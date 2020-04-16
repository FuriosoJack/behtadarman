<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');
// **********************************************************************// 
// ! Static Blocks Post Type
// **********************************************************************// 

if(!function_exists('etheme_get_static_blocks')) {
    function etheme_get_static_blocks () {
        $return_array = array();
        $args = array( 'post_type' => 'staticblocks', 'posts_per_page' => 50);
        
        $myposts = get_posts( $args );
        $i=0;
        foreach ( $myposts as $post ) {
            $i++;
            $return_array[$i]['label'] = get_the_title($post->ID);
            $return_array[$i]['value'] = $post->ID;
        } 
        wp_reset_postdata();

        return $return_array;
    }
}

// **********************************************************************// 
// ! Get Static Blocks
// **********************************************************************// 
if ( ! function_exists( 'etheme_static_block' ) ) {
    function etheme_static_block($id = false, $echo = false){
        if( ! $id ) return;
        global $post;

        // ! Check post password_required
        if ( post_password_required( $id ) ) {
            echo get_the_password_form( $id );
            return;
        }

        $cache  = etheme_get_option( 'static_block_cache' );
        $output = false;

        if ( $cache ) {
            $output = wp_cache_get( $id, 'etheme_get_block' );
        }

        if ( ! $output ) {
            $args = array( 'include' => $id,'post_type' => 'staticblocks', 'posts_per_page' => 1);
            $output = '';
            $myposts = get_posts( $args );
            foreach ( $myposts as $block ) {
                setup_postdata($block);

                if(class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes')){
                    WPBMap::addAllMappedShortcodes();
                }

                $output = do_shortcode( $block->post_content );
            
                $shortcodes_custom_css = get_post_meta( $block->ID, '_wpb_shortcodes_custom_css', true );

                if ( ! empty( $shortcodes_custom_css ) ) {
                    $output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">' . $shortcodes_custom_css . '</style>';
                }
            } 
            wp_reset_postdata();

            if ( $cache ) {
                wp_cache_add( $id, $output, 'etheme_get_block' );
            }
        }

        if ( $echo ) {
            echo wp_specialchars_decode($output);
        } else {
            return wp_specialchars_decode($output);
        }
    }
}