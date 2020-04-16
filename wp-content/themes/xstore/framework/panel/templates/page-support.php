<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Template "Services" for 8theme dashboard.
 *
 * @since   6.0.2
 * @version 1.0.0
 */
?>
<div class="et-col-7 etheme-support">
	<h3 class="et-title"><?php esc_html_e( 'Video tutorials', 'xstore' ); ?></h3>
	<div class="etheme-videos-wrapper">
		<div class="etheme-videos"></div>
	</div>
	<div class="text-center">
		<a href="https://www.youtube.com/channel/UCiZY0AJRFoKhLrkCXomrfmA" class="et-button no-loader more-videos last-button" target="_blank"><?php esc_html_e( 'View more videos', 'xstore' ); ?></a>
	</div>
	<h3><?php esc_html_e( 'Help and support', 'xstore' ); ?></h3>
	<p><?php esc_html_e( 'If you encounter any difficulties with our product we are ready to assist you via:', 'xstore' ); ?></p>
	<ul class="support-blocks">
		<li>
			<a href="https://t.me/etheme" target="_blank">
				<img src="<?php echo esc_html(ETHEME_BASE_URI . ETHEME_CODE ); ?>assets/images/telegram.png">
				<span><?php esc_html_e( 'Telegram channel', 'xstore' ); ?></span>
			</a>
		</li>
		<li>
			<a href="https://www.8theme.com/forums/" target="_blank">
				<img src="<?php echo esc_html( ETHEME_BASE_URI . ETHEME_CODE ); ?>assets/images/support-icon.png">
				<span><?php esc_html_e( 'Support Forum', 'xstore' ); ?></span>
			</a>
		</li>
		<li>
			<a href="http://prntscr.com/d24xhu" target="_blank">
				<img src="<?php echo esc_html( ETHEME_BASE_URI . ETHEME_CODE ); ?>assets/images/envato-icon.png">
				<span><?php esc_html_e( 'ThemeForest profile', 'xstore' ); ?></span>
			</a>
		</li>
	</ul>
	<div class="support-includes">
		<div class="includes">
			<p><?php esc_html_e( 'Item Support includes:', 'xstore' ); ?></p>
			<ul>
				<li><?php esc_html_e( 'Answering technical questions', 'xstore' ); ?></li>
				<li><?php esc_html_e( 'Assistance with reported bugs and issues', 'xstore' ); ?></li>
				<li><?php esc_html_e( 'Help with bundled 3rd party plugins', 'xstore' ); ?></li>
			</ul>
		</div>
		<div class="excludes">
			<p><?php _e( 'Item Support <span class="red-color">DOES NOT</span> Include:', 'xstore' ); ?></p>
			<ul>
				<li><?php esc_html_e( 'Customization services', 'xstore' ); ?></li>
				<li><?php esc_html_e( 'Installation services', 'xstore' ); ?></li>
				<li><?php esc_html_e( 'Support for non-bundled 3rd party plugins.', 'xstore' ); ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="et-col-5 etheme-documentation et-sidebar">
	<h3><?php esc_html_e( 'Documentation', 'xstore' ); ?></h3>
	<h4><?php esc_html_e( 'Theme Installation', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/4-theme-package" target="_blank">XStore Theme Package</a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/12-theme-installation" target="_blank"><?php esc_html_e( 'Theme Installation', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/32-child-theme" target="_blank"><?php esc_html_e( 'Child Theme', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/34-demo-content" target="_blank"><?php esc_html_e( 'Demo Content', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/45-8theme-page-post-layout-settings-8theme-post-options" target="_blank"><?php esc_html_e( '8theme Page/Post/Product Layout settings', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/42-portfolio-page" target="_blank"><?php esc_html_e( 'Portfolio Page', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/43-blank-page" target="_blank"><?php esc_html_e( 'Blank Page', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Theme Update', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/63-theme-update" target="_blank"><?php esc_html_e( 'Theme Update', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Menu Set Up', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/86-general-information" target="_blank"><?php esc_html_e( 'General Information', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/27-mega-menu" target="_blank"><?php esc_html_e( 'Mega Menu', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/88-one-page-menu" target="_blank"><?php esc_html_e( 'One Page menu', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Theme Translation', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/30-base-theme-translation" target="_blank"><?php esc_html_e( 'Base theme translation', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/31-translation-with-wpml" target="_blank"><?php esc_html_e( 'Translation with WPML', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Widgets/Static Blocks', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/48-widgets-custom-widget-areas" target="_blank"><?php esc_html_e( 'Widgets & Custom Widget Areas', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/47-static-blocks" target="_blank"><?php esc_html_e( 'Static Blocks', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/46-xstore-shortcodes" target="_blank"><?php esc_html_e( 'XStore Shortcodes', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'WooCommerce', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/29-general-information" target="_blank"><?php esc_html_e( 'General Information', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/67-shop-page" target="_blank"><?php esc_html_e( 'Shop page', 'xstore' ); ?></a></li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/68-single-product-page" target="_blank"><?php esc_html_e( 'Single Product page', 'xstore' ); ?></a>
		</li>
		<li><a href="https://xstore.helpscoutdocs.com/article/89-product-images" target="_blank"><?php esc_html_e( 'Product Images', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Plugins', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/35-general-info" target="_blank"><?php esc_html_e( 'General Info', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/36-included-plugins" target="_blank"><?php esc_html_e( 'Included plugins', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/37-plugins-update" target="_blank"><?php esc_html_e( 'Plugins Update', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/38-activation-and-purchase-codes" target="_blank"><?php esc_html_e( 'Activation and Purchase Codes', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/65-woocommerce-infinite-scroll-and-ajax-pagination-settings" target="_blank"><?php esc_html_e( 'WooCommerce Infinite Scroll and Ajax Pagination', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/91-mail-chimp-form-custom-styles" target="_blank"><?php esc_html_e( 'MailChimp form custom styles', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Troubleshooting', 'xstore' ); ?></h4>
	<ul>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/64-how-to-add-custom-favicon" target="_blank"><?php esc_html_e( 'How to add custom favicon', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/69-how-to-add-slider-banner-in-product-category-page" target="_blank"><?php esc_html_e( 'How to add slider/banner on Category page', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/87-facebook-login" target="_blank"><?php esc_html_e( 'FaceBook login', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/41-contact-page" target="_blank"><?php esc_html_e( 'How to create a contact page', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/44-blog-page" target="_blank"><?php esc_html_e( 'How to create a blog page', 'xstore' ); ?></a>
		</li>
		<li>
			<a href="https://xstore.helpscoutdocs.com/article/90-how-to-find-your-themeforest-item-purchase-code" target="_blank"><?php esc_html_e( 'How to find your ThemeForest Item Purchase Code', 'xstore' ); ?></a>
		</li>
	</ul>
	<h4><?php esc_html_e( 'Support', 'xstore' ); ?></h4>
	<ul>
		<li><a href="https://xstore.helpscoutdocs.com/article/25-support" target="_blank"><?php esc_html_e( 'Support Policy', 'xstore' ); ?></a></li>
	</ul>
</div>