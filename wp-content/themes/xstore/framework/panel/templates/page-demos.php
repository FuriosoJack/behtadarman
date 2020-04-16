<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Template "Demos" for 8theme dashboard.
 *
 * @since   6.0.2
 * @version 1.0.1
 */

$class = '';

$versions = require apply_filters('etheme_file_url', ETHEME_THEME . 'versions.php');

$pages = array_filter($versions, function( $el ) {
    return $el['type'] == 'page';
});

$demos = array_filter($versions, function( $el ) {
    return $el['type'] == 'demo';
});
?>
<div class="etheme-import-section <?php echo esc_attr( $class ); ?>">
    <div class="import-demos-wrapper admin-demos">
        <h1 class="text-center">80+ good to go shops. The choice is yours.</h1>
        <p class="text-center" style="max-width: 700px; margin-left: auto; margin-right: auto;">Importing pre-built website is the easiest way to setup theme. It will allow you to quickly edit everything instead of creating content from scratch. </p>
        <div class="import-demos-header">
            <ul class="et-filters import-demos-filter">
                <li class="et-filter versions-filter active" data-filter="all"><?php esc_html_e('All', 'xstore'); ?></li>
                <li class="et-filter versions-filter" data-filter="popular"><?php esc_html_e('Popular', 'xstore'); ?></li>
                <li class="et-filter versions-filter" data-filter="catalog"><?php esc_html_e('Catalog', 'xstore'); ?></li>
                <li class="et-filter versions-filter" data-filter="one-page"><?php esc_html_e('One page', 'xstore'); ?></li>
                <li class="et-filter versions-filter" data-filter="corporate"><?php esc_html_e('Corporate', 'xstore'); ?></li>
            </ul>
            <div class="etheme-search">
                <input type="text" class="etheme-versions-search form-control" placeholder="Search for versions">
                <i class="et-admin-icon et-zoom"></i>
                <span class="spinner">
                    <div class="et-loader ">
                        <svg class="loader-circular" viewBox="25 25 50 50">
                            <circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                </span>
            </div>
        </div>

        <div class="import-demos">
            <?php
                foreach ( $demos as $key => $version ) : ?>
                <?php
                    $imported = 'not-imported';
                    $imported_text = esc_html__( 'Choose', 'xstore' );

                    if ( ! isset( $version['filter'] ) ) {
                        $version['filter'] = 'all';
                    }
                ?>
                <div class="version-preview <?php echo esc_attr( $imported ); ?> version-preview-<?php echo esc_attr( $key ); ?>" data-filter="<?php echo esc_js($version['filter']); ?>" 
                    data-active-filter="all">
                    <div class="version-screenshot">
                        <img
                            src="https://xstore.8theme.com/dashboard-images/<?php echo esc_attr( $key ); ?>/screenshot.jpg"
                            alt="<?php echo esc_attr( $key ); ?>">
                        <div class="version-footer">
                            <a href="<?php echo esc_url( $version['preview_url'] ); ?>" target="_blank" class="button-preview et-button et-button-dark-grey no-loader">
                                <?php echo esc_html__('Preview', 'xstore'); ?>
                            </a>
                            <span class="button-import-version et-button et-button-green no-loader" data-version="<?php echo esc_attr( $key ); ?>">
                                <?php echo esc_html__('Import', 'xstore'); ?>

                            </span>
                        </div>
                    </div>
                    <span class="version-title"><?php echo esc_html( $version['title'] ); ?></span>
                </div>
                <style type="text/css">
                    <?php 
//                         if ( isset($version['orders']) ) {
                            foreach ($version['orders'] as $key2 => $value2) {
                                echo '.version-preview-' . esc_attr( $key ) . '[data-active-filter="'.$key2.'"]{ order: ' . $value2 . '}'; 
                            }
//                         }
                    ?>
                </style>
            <?php endforeach; ?>
        </div>

        <div class="install-base-first">
            <h1><?php esc_html_e('No access!', 'xstore'); ?></h1>
            <p><?php esc_html_e('Please, install Base demo content before, to access the collection of our Home Pages.', 'xstore'); ?></p>
        </div>
    </div>
</div>
<?php if ( isset( $_GET['after_activate'] ) ): ?>
    <?php $out = ''; ?>
    
    <?php if ( ! class_exists( 'ETC\App\Controllers\Admin\Import' ) ) : ?>

        <?php 
            // $out .= '<p class="et_installing-base-plugin et-message et-info">' . esc_html__( 'Please wait installing base plugin', 'xstore' ) . '</p>';
            // $out .= '<p class="et_installed-base-plugin hidden et-message et-success">' . esc_html__( 'plugin intalled', 'xstore' ) . '</p>'; 
        ?>
        <span class="hidden et_plugin-nonce" data-plugin-nonce="<?php echo wp_create_nonce( 'envato_setup_nonce' ); ?>"></span>
    <?php endif; ?>

    <?php $out .= '<div class="et_all-success">
            <br>
            <img src="' . ETHEME_BASE_URI . ETHEME_CODE .'assets/images/' . 'success-icon.png" alt="installed icon" style="margin-bottom: -7px;"><br/><br/>
            <h3 class="et_step-title text-center">' . esc_html__('Theme successfully activated!', 'xstore') . '</h3>
            <p>'.esc_html__('Now you have lifetime updates, top-notch 24/7 live support and much more.', 'xstore').'</p>
        </div>
        <span class="et-button et-button-green no-loader et_close-popup" onclick="window.location=\'' . admin_url( 'admin.php?page=et-panel-demos' ) . '\'">ok</span><br><br>' ?>
    <?php echo '<div class="et_popup-activeted-content hidden">' . $out . '</div>'; ?>
<?php endif ?>
