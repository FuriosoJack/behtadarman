<?php
namespace ETC\App\Controllers;

use ETC\App\Controllers\Base_Controller;

/**
 * Import controller.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controller
 */
class General extends Base_Controller {

	function hooks() {
		// Allow HTML in term (category, tag) descriptions
		foreach ( array( 'pre_term_description' ) as $filter ) {
			remove_filter( $filter, 'wp_filter_kses' );
		}

		foreach ( array( 'term_description' ) as $filter ) {
			remove_filter( $filter, 'wp_kses_data' );
		}

		add_filter( 'style_loader_src', array( $this, 'etheme_remove_cssjs_ver' ), 10, 2 );
		add_filter( 'script_loader_src', array( $this, 'etheme_remove_cssjs_ver' ), 10, 2 );
		add_action( 'init', array( $this, 'etheme_disable_emojis' ) );
		// Add button to adminbar panel
		add_action( 'admin_bar_menu', array( $this, 'top_bar_menu' ), 100 );
	}

	function etheme_remove_cssjs_ver( $src ) {
		if ( function_exists( 'etheme_get_option' ) && etheme_get_option( 'cssjs_ver' ) ) {

            // ! Do not do it for revslider and essential-grid.
			if ( strpos( $src, 'revslider' ) || strpos( $src, 'essential-grid' ) ) return $src;

			if( strpos( $src, '?ver=' ) ) $src = remove_query_arg( 'ver', $src );
		}
		return $src;   
	}

	function etheme_disable_emojis() {
		if ( function_exists( 'etheme_get_option' ) && etheme_get_option( 'disable_emoji' ) ) {
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		}
	}

	function top_bar_menu( $wp_admin_bar ) {
		if ( ! defined( 'ETHEME_CODE_IMAGES' ) ) {
           return;
        }

        $result = true;

        if ( class_exists('Etheme_System_Requirements') ) {
            $system = new \Etheme_System_Requirements();
            $system->system_test();
            $result = $system->result();
        } elseif( defined('ETHEME_CODE') && is_user_logged_in() && current_user_can('administrator') ) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once( apply_filters('etheme_file_url', ETHEME_CODE . 'system-requirements.php') );

            $system = new \Etheme_System_Requirements();
            $system->system_test();
            $result = $system->result();
        }

        $theme_activated = etheme_is_activated();
        $info = '<span class="awaiting-mod" style="position: relative;min-width: 16px;height: 16px;margin: 0px 0 0 7px;background: #fff;line-height: 1;display: inline-block;width: 10px;height: 10px;min-width: unset;"><span class="dashicons dashicons-info" style="width: auto;height: auto;font-size: 20px;font-family: dashicons;line-height: 1;border-radius: 50%;color: #ca4a1f;position: absolute;top: -5px;left: -5px;"></span></span>';

        $title = '
            <span class="ab-label"><img class="et-logo" style="vertical-align: -4px; margin-right: 5px;" src="' . ETHEME_CODE_IMAGES . 'wp-icon.svg' . '" alt="xstore">' . 'XStore' . ( ( !$theme_activated || ! $result ) ? $info : '' ) . '</span>
        ';

        $new_label = '<span style="margin-left: 3px; background: #0b9f17; letter-spacing: 1px; display: inline-block; text-transform: lowercase; border-radius: 3px; color: #fff; padding: 3px 2px 2px 3px; text-transform: uppercase; font-size: 8px; line-height: 1;">'.esc_html__('new', 'xstore-core').'</span>';
        
        $args = array(
            'id'    => 'et-top-bar-menu',
            'title' => $title,
            'href'  => admin_url( 'admin.php?page=et-panel-welcome' ),
        );
        
        $wp_admin_bar->add_node( $args );

        $wp_admin_bar->add_node( array(
            'parent' => 'et-top-bar-menu',
            'id'     => 'et-panel-welcome',
            'title'  => esc_html__( 'Dashboard', 'xstore-core' ),
            'href'   => admin_url( 'admin.php?page=et-panel-welcome' ),
        ) );

        if ( ! $theme_activated && ! class_exists( 'Kirki' ) ) {
            $wp_admin_bar->add_node( array(
                'parent' => 'et-top-bar-menu',
                'id'     => 'et-setup-wizard',
                'title'  => esc_html__( 'Setup Wizard', 'xstore-core' ),
                'href'   => admin_url( 'themes.php?page=xstore-setup' ),
            ) );
        } elseif( ! $theme_activated ){
            // $wp_admin_bar->add_node( array(
            //     'parent' => 'et-top-bar-menu',
            //     'id'     => 'et-panel-options',
            //     'title'  => esc_html__( 'Theme Options', 'xstore-core' ),
            //     'href'   => ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', wp_customize_url() ) : wp_customize_url() ),
            // ) );
        } elseif( ! class_exists( 'Kirki' ) ){
            $wp_admin_bar->add_node( array(
                'parent' => 'et-top-bar-menu',
                'id'     => 'et-panel-plugins',
                'title'  => esc_html__( 'Install Plugins', 'xstore-core' ),
                'href'   => admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
            ) );
        } else {
            $wp_admin_bar->add_node( array(
                'parent' => 'et-top-bar-menu',
                'id'     => 'et-panel-demos',
                'title'  => esc_html__( 'Import Demos', 'xstore-core' ),
                'href'   => admin_url( 'admin.php?page=et-panel-demos' ),
            ) );
            $wp_admin_bar->add_node( array(
                'parent' => 'et-top-bar-menu',
                'id'     => 'et-panel-plugins',
                'title'  => esc_html__( 'Install Plugins', 'xstore-core' ),
                'href'   => admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
            ) );
            if ( $theme_activated ) {
	            $wp_admin_bar->add_node( array(
	                'parent' => 'et-top-bar-menu',
	                'id'     => 'et-panel-options',
	                'title'  => esc_html__( 'Theme Options', 'xstore-core' ),
	                'href'   => ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', wp_customize_url() ) : wp_customize_url() ),
	            ) );
	        }
            if ( get_option( 'etheme_header_builder', false ) ) {
                $wp_admin_bar->add_node( array(
                    'parent' => 'et-top-bar-menu',
                    'id'     => 'et-panel-header-builder',
                    'title'  => esc_html__( 'Header Builder', 'xstore-core' ) . $new_label,
                    'href'   => ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[panel]=header-builder' ) ) : admin_url( '/customize.php?autofocus[panel]=header-builder' ) ),
                ) );
            }
            else {
                $wp_admin_bar->add_node( array(
                    'parent' => 'et-top-bar-menu',
                    'id'     => 'et-panel-header-builder',
                    'title'  => esc_html__( 'Header Builder', 'xstore-core' ) . $new_label,
                    'href'   => ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[section]=header-builder' ) ) : admin_url( '/customize.php?autofocus[section]=header-builder' ) ),
                ) );
            }
            if ( get_option( 'etheme_single_product_builder', false ) ) {
                $wp_admin_bar->add_node( array(
                    'parent' => 'et-top-bar-menu',
                    'id'     => 'et-panel-single-product-builder',
                    'title'  => esc_html__( 'Single Product Builder', 'xstore-core' ) . $new_label,
                    'href'   => ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[panel]=single_product_builder' ) ) : admin_url( '/customize.php?autofocus[panel]=single_product_builder' ) ),
                ) );
            }
            else {
                $wp_admin_bar->add_node( array(
                    'parent' => 'et-top-bar-menu',
                    'id'     => 'et-panel-single-product-builder',
                    'title'  => esc_html__( 'Single Product Builder', 'xstore-core' ) . $new_label,
                    'href'   => ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[section]=single_product_builder' ) ) : admin_url( '/customize.php?autofocus[section]=single_product_builder' ) ),
                ) );
            }
        }

        if ( $theme_activated ) {

	        $wp_admin_bar->add_node( array(
	            'parent' => 'et-top-bar-menu',
	            'id'     => 'et-panel-social',
	            'title'  => esc_html__('Instagram API', 'xstore-core'),
	            'href'   => admin_url( 'admin.php?page=et-panel-social' ),
	        ) );

            $wp_admin_bar->add_node( array(
                'parent' => 'et-top-bar-menu',
                'id'     => 'et-panel-custom-fonts',
                'title'  => esc_html__('Custom Fonts', 'xstore-core'),
                'href'   => admin_url( 'admin.php?page=et-panel-custom-fonts' ),
            ) );

	        $wp_admin_bar->add_node( array(
	            'parent' => 'et-top-bar-menu',
	            'id'     => 'et-panel-support',
	            'title'  => esc_html__( 'Tutorials & Support', 'xstore-core' ),
	            'href'   => admin_url( 'admin.php?page=et-panel-support' ),
	        ) );

	        $wp_admin_bar->add_node( array(
	            'parent' => 'et-top-bar-menu',
	            'id'     => 'et-panel-changelog',
	            'title'  => esc_html__( 'Changelog', 'xstore-core' ),
	            'href'   => admin_url( 'admin.php?page=et-panel-changelog' ),
	        ) );

	    }	
	}
}