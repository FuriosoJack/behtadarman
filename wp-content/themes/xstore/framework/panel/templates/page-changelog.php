<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Template "Changelog" for 8theme dashboard.
 *
 * @since   6.0.2
 * @version 1.0.0
 */

$out = '';
$out .= '<h3 class="et-title">' . esc_html__( 'Changelog', 'xstore' ) . '</h3>';

if ( function_exists( 'wp_remote_get' ) ) {
	$response = wp_remote_get( 'https://xstore.8theme.com/change-log.php?type=panel' );
	$response = wp_remote_retrieve_body( $response );
	$response = str_replace( 'class="arrow"', '', $response );
	$response = str_replace( '<h2>', '<h4>', $response );
	$response = str_replace( '</h2>', '</h4>', $response );
	$response = str_replace( '[vc_column_text]', '', $response);
	$response = str_replace( '<div></div>', '', $response);
	$out .= $response;
} else {
	$out .= '<p class="et-message et-error">' . esc_html__( 'Can not get changelog data', 'xstore' ) . '</p>';
}

echo '<div class="etheme-div etheme-changelog">' . $out . '</div>';