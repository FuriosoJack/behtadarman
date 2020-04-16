<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Etheme Admin Panel Dashboard.
 *
 * Add admin panel dashboard pages to admin menu.
 * Output dashboard pages.
 *
 * @since   5.0.0
 * @version 1.0.3
 */
class EthemeAdmin{

    // ! Main construct/ add actions
    function __construct(){
        add_action( 'admin_menu', array( $this, 'et_add_menu_page' ) );
        add_action( 'admin_head', array( $this, 'et_add_menu_page_target') );
        add_action( 'wp_ajax_et_ajax_panel_popup', array($this, 'et_ajax_panel_popup') );
    }

    /**
     * Add admin panel dashboard pages to admin menu.
     *
     * @since   5.0.0
     * @version 1.0.1
     */
    public function et_add_menu_page(){
        $system = new Etheme_System_Requirements();
        $system->system_test();
        $result = $system->result();
        

        $is_et_core = class_exists('ETC\App\Controllers\Admin\Import');
        $is_activated = etheme_is_activated();
        $info = '<span class="awaiting-mod" style="position: relative;min-width: 16px;height: 16px;margin: 2px 0 0 6px; background: #fff;"><span class="dashicons dashicons-info" style="width: auto;height: auto;vertical-align: middle;position: absolute;left: -3px;top: -3px; color: #ca4a1f; font-size: 22px;"></span></span>';

        add_menu_page( 
            'XStore' . ( ( !$is_activated || !$result ) ? $info : '' ),
            'XStore' . ( ( !$is_activated || !$result ) ? $info : '' ),
            'manage_options', 
            'et-panel-welcome',
            array( $this, 'etheme_panel_page' ),
            ETHEME_CODE_IMAGES . 'wp-icon.svg',
            65
        );
        add_submenu_page(
            'et-panel-welcome',
            esc_html__( 'Dashboard', 'xstore' ),
            esc_html__( 'Dashboard', 'xstore' ),
            'manage_options',
            'et-panel-welcome',
            array( $this, 'etheme_panel_page' )
        );

        if ( $is_activated ) {

            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Import Demos', 'xstore' ),
                esc_html__( 'Import Demos', 'xstore' ),
                'manage_options',
                'et-panel-demos',
                array( $this, 'etheme_panel_page' )
            );

        }

        if ( ! etheme_is_activated() && ! class_exists( 'Kirki' ) ) {
            // add_submenu_page(
            //     'et-panel-welcome',
            //     esc_html__( 'Setup Wizard', 'xstore' ),
            //     esc_html__( 'Setup Wizard', 'xstore' ),
            //     'manage_options',
            //     admin_url( 'themes.php?page=xstore-setup' ),
            //     ''
            // );
        } elseif( ! etheme_is_activated() ){

        } elseif( ! class_exists( 'Kirki' ) ){
            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Install Plugins', 'xstore' ),
                esc_html__( 'Install Plugins', 'xstore' ),
                'manage_options',
                admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
                ''
            );
        } else {
            
            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Install Plugins', 'xstore' ),
                esc_html__( 'Install Plugins', 'xstore' ),
                'manage_options',
                admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
                ''
            );
        }

        if ( $is_activated && $is_et_core ) {

            if ( ! class_exists( 'Kirki' ) ) {
                add_submenu_page(
                    'et-panel-welcome',
                    'Theme Options',
                    'Theme Options',
                    'manage_options',
                    admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
                    ''
                );
            }
            elseif ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ) {
                add_submenu_page(
                    'et-panel-welcome',
                    'Theme Options',
                    'Theme Options',
                    'manage_options',
                    add_query_arg( 'xstore_theme_migrate_options', 'true', wp_customize_url() ),
                    ''
                );
                add_submenu_page(
                    'et-panel-welcome',
                    'Header Builder',
                    'Header Builder',
                    'manage_options',
                    ( get_option( 'etheme_header_builder', false ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[panel]=header-builder' ) ) : add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[section]=header-builder' ) ) ),
                    ''
                );
                add_submenu_page(
                    'et-panel-welcome',
                    'Single Product Layout Builder',
                    'Single Product Layout Builder',
                    'manage_options',
                    ( get_option( 'etheme_single_product_builder', false ) ? add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[panel]=single_product' ) ) : add_query_arg( 'xstore_theme_migrate_options', 'true', admin_url( '/customize.php?autofocus[section]=single_product' ) ) ),
                    ''
                );
            }
            else {
                add_submenu_page(
                    'et-panel-welcome',
                    'Theme Options',
                    'Theme Options',
                    'manage_options',
                    wp_customize_url(),
                    ''
                );
                add_submenu_page(
                    'et-panel-welcome',
                    'Header Builder',
                    'Header Builder',
                    'manage_options',
                    ( get_option( 'etheme_header_builder', false ) ? admin_url( '/customize.php?autofocus[panel]=header-builder' ) : admin_url( '/customize.php?autofocus[section]=header-builder' ) ),
                    ''
                );
                add_submenu_page(
                    'et-panel-welcome',
                    'Single Product Layout Builder',
                    'Single Product Layout Builder',
                    'manage_options',
                    ( get_option( 'etheme_single_product_builder', false ) ? admin_url( '/customize.php?autofocus[panel]=single_product_builder' ) : admin_url( '/customize.php?autofocus[section]=single_product_builder' ) ),
                    ''
                );
            }

            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Instagram API', 'xstore' ),
                esc_html__( 'Instagram API', 'xstore' ),
                'manage_options',
                'et-panel-social',
                array( $this, 'etheme_panel_page' )
            );

            add_submenu_page(
                'et-panel-welcome',
                esc_html__('Custom Fonts', 'xstore'),
                esc_html__('Custom Fonts', 'xstore'),
                'manage_options',
                'et-panel-custom-fonts',
                array( $this, 'etheme_panel_page' )
            );
            
            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Tutorials & Support', 'xstore' ),
                esc_html__( 'Tutorials & Support', 'xstore' ),
                'manage_options',
                'et-panel-support',
                array( $this, 'etheme_panel_page' )
            );

            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Changelog', 'xstore' ),
                esc_html__( 'Changelog', 'xstore' ),
                'manage_options',
                'et-panel-changelog',
                array( $this, 'etheme_panel_page' )
            );
        }

        add_submenu_page(
            'et-panel-welcome',
            esc_html__( 'Setup Wizard', 'xstore' ),
            esc_html__( 'Setup Wizard', 'xstore' ),
            'manage_options',
            'themes.php?page=xstore-setup',
            ''
        );

        if ( $is_activated && $is_et_core ) {
            add_submenu_page(
                'et-panel-welcome',
                esc_html__( 'Rate Theme', 'xstore' ),
                esc_html__( 'Rate Theme', 'xstore' ),
                'manage_options',
                'https://themeforest.net/item/xstore-responsive-woocommerce-theme/reviews/15780546',
                ''
            );
        }
    }

    /**
     * Add target blank to some dashboard pages.
     *
     * @since   6.2
     * @version 1.0.0
     */
    public function et_add_menu_page_target() {
        ob_start(); ?>
            <script type="text/javascript">
                jQuery(document).ready( function($) {   
                    $('#adminmenu .wp-submenu a[href*=themeforest]').attr('target','_blank');  
                });
            </script>
        <?php echo ob_get_clean();
    }

    /**
     * Show Add admin panel dashboard pages.
     *
     * @since   5.0.0
     * @version 1.0.1
     */
    public function etheme_panel_page(){
        ob_start();
            get_template_part( 'framework/panel/templates/page', 'header' );
                get_template_part( 'framework/panel/templates/page', 'navigation' );
                echo '<div class="et-row etheme-page-content">';
                    switch ( $_GET['page'] ) {
                        case 'et-panel-welcome':
                            get_template_part( 'framework/panel/templates/page', 'welcome' );
                            break;
                        case 'et-panel-changelog':
                            get_template_part( 'framework/panel/templates/page', 'changelog' );
                            break;
                        case 'et-panel-support':
                            get_template_part( 'framework/panel/templates/page', 'support' );
                            break;
                        case 'et-panel-demos':
                            get_template_part( 'framework/panel/templates/page', 'demos' );
                            break;
                        case 'et-panel-custom-fonts':
                            if ( class_exists('Etheme_Custom_Fonts') ) {
                                $custom_fonts = new Etheme_Custom_Fonts();
                                $custom_fonts->render();
                            }
                            break;
                        case 'et-panel-social':
                            get_template_part( 'framework/panel/templates/page', 'instagram' );
                            break;
                        default:
                            get_template_part( 'framework/panel/templates/page', 'welcome' );
                            break;
                    }
                echo '</div>';
            get_template_part( 'framework/panel/templates/page', 'footer' );
        echo ob_get_clean();
    }


    public function et_ajax_panel_popup(){
        $response = array(
            // 'head'    => 
            // get_template_part( 'framework/panel/templates/popup-import', 'head' ),
            // 'content' => 
            // get_template_part( 'framework/panel/templates/popup-import', 'content'),
        );
ob_start();
    get_template_part( 'framework/panel/templates/popup-import', 'head' );
 $response['head'] = ob_get_clean();
        ob_start();

        // $response['head'] = get_template_part( 'framework/panel/templates/popup-import', 'head' );

             get_template_part( 'framework/panel/templates/popup-import', 'content');

       $response['content'] = ob_get_clean();

        wp_send_json($response);
        // die();
        // die();
    }
}
new EthemeAdmin;