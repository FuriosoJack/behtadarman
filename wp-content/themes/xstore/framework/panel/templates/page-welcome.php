<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Template "Welcome" for 8theme dashboard.
 *
 * @since   6.0.2
 * @version 1.0.0
 */
?>

<div class="et-col-5 etheme-system et-sidebar" style="float: right;">
    <h3><?php esc_html_e( 'System Requirements', 'xstore' ) ?></h3>
    <?php 
        $system = new Etheme_System_Requirements();
        $system->html();
        $result = $system->result();
    ?>
    <div class="text-center">
        <a href="" class="et-button et-button-grey last-button">
            <span class="et-loader">
            <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
            </span><span class="dashicons dashicons-image-rotate"></span> <?php esc_html_e( 'Check again', 'xstore' ); ?>
        </a>
    </div>
</div>

<div class="et-col-7 etheme-registration">
    <?php if ( ! defined( 'ET_CORE_VERSION' ) && etheme_is_activated() && ! class_exists('ETC\App\Controllers\Admin\Import') ): ?>

        <p class="et-message et-error flex align-items-center justify-content-between">
            <?php esc_html_e('The following required plugin is currently inactive: ', 'xstore'); ?>
                <?php echo 'XStore Core'; ?>

                <span class="et_core-plugin et-button et-button-green no-transform" data-slug="et-core-plugin"><?php echo esc_html__('Activate', 'xstore'); ?>
                    <span class="et-loader">
                        <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
                    </span>
                </span>
                <span class="hidden et_plugin-nonce" data-plugin-nonce="<?php echo wp_create_nonce( 'envato_setup_nonce' ); ?>"></span>
    <?php endif; ?>
    <?php if ( ! $result ) : ?>
        <p class="et-message et-error"><?php esc_html_e( 'Your system does not meet the server requirements. For more efficient result, we strongly recommend to contact your host provider and check the necessary settings.', 'xstore' ); ?><p>
    <?php endif; ?>

    <h3><?php esc_html_e( 'Theme Registration', 'xstore' ) ?></h3>
        <?php $version = new ETheme_Version_Check();?>
        <?php $version->activation_page();?>

        <?php if ( !etheme_is_activated() ) : ?>
        <h4 class="text-uppercase"><?php esc_html_e('Where can I find my purchase code?', 'xstore'); ?></h4>

        <ul>
            <li>1. <?php esc_html_e('Please enter your Envato account and find ', 'xstore'); ?> <a href="https://themeforest.net/downloads"><?php esc_html_e('Downloads tab', 'xstore'); ?></a></li>
            <li>2. <?php esc_html_e('Find XStore theme in the list and click on the opposite', 'xstore');?> <span><?php echo esc_html__('Download', 'xstore'); ?></span> <?php esc_html_e('button', 'xstore'); ?></li>
            <li>3. <?php esc_html_e('Select', 'xstore'); ?> <span><?php echo esc_html__('License Certificate & Purchase code', 'xstore'); ?></span> <?php esc_html_e('for download', 'xstore'); ?></li>
            <li>4. <?php esc_html_e('Copy the', 'xstore'); ?> <span><?php esc_html_e('Item Purchase Code', 'xstore'); ?> </span><?php esc_html_e('from the downloaded document', 'xstore'); ?></li>
        </ul>
        <br/>
        <?php endif; ?>
        <h3><?php esc_html_e('Buy license', 'xstore'); ?></h3>
        <p><?php echo sprintf(esc_html__('If you don\'t have a license or need another one for a new website, click on a Buy button. Interested in multiple licenses? Contact us via %1scontact form%2s for more details about discounts for you.', 'xstore'), '<a href="http://8theme.com/contact-us/" target="_blank">', '</a>'); ?></p>

        <a href="https://themeforest.net/item/xstore-responsive-woocommerce-theme/15780546?utm_source=xstorecta?utm_source=xstorencta&ref=8theme&license=regular&open_purchase_for_item_id=15780546&purchasable=source" class="et-button et-button-green last-button no-loader"><?php esc_html_e('Purchase now', 'xstore'); ?></a>
</div>