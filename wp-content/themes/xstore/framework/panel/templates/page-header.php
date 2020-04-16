<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Template "Header" for 8theme dashboard.
 *
 * @since   6.0.2
 * @version 1.0.0
 */

$theme   = wp_get_theme();
$version = $theme->get('Version');
$is_activated = etheme_is_activated();
$is_et_core = class_exists('ETC\App\Controllers\Admin\Import');

?>
<div class="etheme-page-wrapper">
<div class="et_panel-popup"></div>
<div class="etheme-page-header flex justify-content-between align-items-center">
	<div>
		<h2 class="etheme-page-title">Welcome to XStore!</h2>
		<?php if ( $is_activated ) : ?>
			<p style="max-width: 500px;">Thank you for choosing XStore. We hope you’ll like it!<br/>Good job! Your theme is now activated.</p>
		<?php else: ?>
			<p style="max-width: 500px;">Thank you for choosing XStore. We hope you’ll like it!<br/> To enjoy the full experience we strongly recommend to activate a theme with your purchase code.</p>
		<?php endif; ?>
	</div>
	<?php if ( !$is_activated || !$is_et_core ) : ?>
		<button class="et-button et-button-lg no-transform inline-flex align-items-center et-open-installation-video no-loader" data-text="<?php echo esc_html__('Watch now', 'xstore'); ?>">
			<span class="inline-flex align-items-center"><svg height="1.2em" viewBox="0 -77 512.00213 512" width="1.2em" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;"><path d="m501.453125 56.09375c-5.902344-21.933594-23.195313-39.222656-45.125-45.128906-40.066406-10.964844-200.332031-10.964844-200.332031-10.964844s-160.261719 0-200.328125 10.546875c-21.507813 5.902344-39.222657 23.617187-45.125 45.546875-10.542969 40.0625-10.542969 123.148438-10.542969 123.148438s0 83.503906 10.542969 123.148437c5.90625 21.929687 23.195312 39.222656 45.128906 45.128906 40.484375 10.964844 200.328125 10.964844 200.328125 10.964844s160.261719 0 200.328125-10.546875c21.933594-5.902344 39.222656-23.195312 45.128906-45.125 10.542969-40.066406 10.542969-123.148438 10.542969-123.148438s.421875-83.507812-10.546875-123.570312zm0 0" fill="#f00"></path><path d="m204.96875 256 133.269531-76.757812-133.269531-76.757813zm0 0" fill="#fff"></path></svg>How to install XStore</span></button>
	<?php endif; ?>
	<div class="text-center" style="margin-bottom: -15px;">
		<span class="theme-logo">
			<img
				src="<?php echo esc_html( ETHEME_BASE_URI . ETHEME_CODE ); ?>assets/images/admin-logo.png"
				alt="logo"
				srcset="<?php echo esc_html( ETHEME_BASE_URI . ETHEME_CODE ); ?>assets/images/admin-logo2x.png 2x"
			>
		</span>
		
		<?php if ( $is_activated ): ?>
			<span class="activate-note activated"><?php esc_html_e( 'Activated', 'xstore' ); ?></span>
		<?php else: ?>
			<span class="activate-note"><?php esc_html_e('Not activated', 'xstore'); ?></span>
		<?php endif; ?>

		<?php if ( is_child_theme() ): ?>
			<?php 
				$parent = wp_get_theme( 'xstore' );
				$parent = $parent->version;
			?>
			<span class="theme-version">v.<?php echo esc_html( $parent ) . ' (child  v.' . $version . ')'; ?></span>
		<?php else: ?>
			<span class="theme-version">v.<?php echo esc_html( $version ) ; ?></span>
		<?php endif; ?>
	</div>
</div>