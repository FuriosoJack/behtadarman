<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Template "Navigation" for 8theme dashboard.
 *
 * @since   6.0.2
 * @version 1.0.0
 */

$mtips_notify = esc_html__('Register your theme and activate XStore Core plugin, please.', 'xstore');
$theme_active = etheme_is_activated();
$core_active = class_exists('ETC\App\Controllers\Admin\Import');


if ( ! class_exists( 'Kirki' ) || !$theme_active ) {
	$theme_options = sprintf(
		'<li class="mtips inactive"><a href="%s" class="et-nav%s et-nav-general">%s</a><span class="mt-mes">'.$mtips_notify.'</span></li>',
		admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
		( $_GET['page'] == 'et-panel-options' ) ? ' active' : '',
		esc_html__( 'Theme Options', 'xstore' )
	);
}
elseif ( get_option('et_options') && (!get_option( 'xstore_theme_migrated', false ) ) ) {
    $theme_options = sprintf(
		'<li><a href="%s" class="et-nav%s et-nav-general">%s</a></li>',
		add_query_arg( 'xstore_theme_migrate_options', 'true', wp_customize_url() ),
		( $_GET['page'] == 'et-panel-options' ) ? ' active' : '',
		esc_html__( 'Theme Options', 'xstore' )
	);
}
else {
    $theme_options = sprintf(
		'<li><a href="%s" class="et-nav%s et-nav-general">%s</a></li>',
		wp_customize_url(),
		( $_GET['page'] == 'et-panel-options' ) ? ' active' : '',
		esc_html__( 'Theme Options', 'xstore' )
	);
}

$out = '';
$out .= sprintf(
	'<li><a href="%s" class="et-nav%s et-nav-menu">%s</a></li>',
	admin_url( 'admin.php?page=et-panel-welcome' ),
	( ! isset( $_GET['page'] ) || $_GET['page'] == 'et-panel-welcome' ) ? ' active' : '',
	esc_html__( 'Welcome', 'xstore' )

);

if ( ! $theme_active || ! class_exists( 'Kirki' ) ) {
	$out .= sprintf(
		'<li class="mtips inactive"><a href="%s" class="et-nav%s et-nav-portfolio">%s</a><span class="mt-mes">'.$mtips_notify.'</span></li>',
		admin_url( 'admin.php?page=et-panel-demos' ),
		( $_GET['page'] == 'et-panel-demos' ) ? ' active' : '',
		esc_html__( 'Import Demos', 'xstore' )
	);
	// $out .= sprintf(
	// 	( $theme_active ) ? '<li><a href="%s" class="et-nav%s et-nav-speed">%s</a></li>' : '<li class="mtips inactive"><a href="%s" class="et-nav%s et-nav-speed">%s</a><span class="mt-mes">'.$mtips_notify.'</span></li>',
	// 	admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
	// 	( $_GET['page'] == 'et-panel-plugins' ) ? ' active' : '',
	// 	esc_html__( 'Plugins', 'xstore' )
	// );
	$out .= $theme_options;
} else {
	$out .= sprintf(
		'<li><a href="%s" class="et-nav%s et-nav-portfolio">%s</a></li>',
		admin_url( 'admin.php?page=et-panel-demos' ),
		( $_GET['page'] == 'et-panel-demos' ) ? ' active' : '',
		esc_html__( 'Import Demos', 'xstore' )
	);
	// $out .= sprintf(
	// 	'<li><a href="%s" class="et-nav%s et-nav-speed">%s</a></li>',
	// 	admin_url( 'themes.php?page=install-required-plugins&plugin_status=all' ),
	// 	( $_GET['page'] == 'et-panel-plugins' ) ? ' active' : '',
	// 	esc_html__( 'Plugins', 'xstore' )
	// );
	$out .= $theme_options;

	if ( $theme_active ) {
		$out .= sprintf(
			'<li><a href="%s" class="et-nav%s et-nav-typography">%s</a></li>',
			admin_url( 'admin.php?page=et-panel-custom-fonts' ),
			( $_GET['page'] == 'et-panel-custom-fonts' ) ? ' active' : '',
			esc_html__( 'Custom Fonts', 'xstore' )
		);
	}
	
}

$out .= sprintf(
	( !$core_active || !$theme_active ) ? '<li class="mtips inactive"><a href="%s" class="et-nav%s et-nav-social">%s</a><span class="mt-mes">'.$mtips_notify.'</span></li>' : '<li><a href="%s" class="et-nav%s et-nav-social">%s</a></li>',
	( $theme_active && $core_active ) ? admin_url( 'admin.php?page=et-panel-social' ) : admin_url( 'admin.php?page=et-panel-welcome' ),
	( $_GET['page'] == 'et-panel-social' ) ? ' active' : '',
	esc_html__( 'Instagram API', 'xstore' )

);

$out .= sprintf(
	( $theme_active && $core_active ) ? '<li><a href="%s" class="et-nav%s et-nav-support">%s</a></li>' : '<li class="mtips inactive"><a href="%s" class="et-nav%s et-nav-support">%s</a><span class="mt-mes">'.$mtips_notify.'</span></li>',
	( $theme_active && $core_active ) ? admin_url( 'admin.php?page=et-panel-support' ) : admin_url( 'admin.php?page=et-panel-welcome' ),
	( $_GET['page'] == 'et-panel-support' ) ? ' active' : '',
	esc_html__( 'Tutorials & Support', 'xstore' )

);

$changelog_icon = '';
$check_update = new ETheme_Version_Check();
if( $check_update->is_update_available() ) 
	$changelog_icon = '<span class="dashicons dashicons-warning dashicons-warning orange-color"></span>';

$out .= sprintf(
	( $theme_active && $core_active ) ? '<li><a href="%s" class="et-nav%s et-nav-documentation">%s</a></li>' : '<li class="mtips inactive"><a href="%s" class="et-nav%s et-nav-documentation">%s</a><span class="mt-mes">'.$mtips_notify.'</span></li>',
	admin_url( 'admin.php?page=et-panel-changelog' ),
	( $_GET['page'] == 'et-panel-changelog' ) ? ' active' : '',
	esc_html__( 'Changelog', 'xstore' ) . $changelog_icon

);


ob_start();
    do_action('etheme_laast_dashboard_nav_item');
$out .= ob_get_clean();

echo'<div class="etheme-page-nav"><ul>' . $out . '</ul></div>';