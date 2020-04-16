<?php
namespace ETC\App\Controllers\Shortcodes;

use ETC\App\Controllers\Shortcodes;

/**
 * Dropcap shortcode.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controllers/Shortcodes
 */
class Dropcap extends Shortcodes {

	function hooks(){}

	function dropcap_shortcode( $atts,$content=null ) {
		$atts = shortcode_atts( array(
				'style' => '',
				'color' => '',
			), $atts );

		$style = '';

		if( ! empty( $atts['color'] ) )
			$style = 'style="color:' . $atts['color'] . ';"';

		return '<span class="dropcap ' . $atts['style'] . '" ' . $style . '>' . $content . '</span>';
	}
}
