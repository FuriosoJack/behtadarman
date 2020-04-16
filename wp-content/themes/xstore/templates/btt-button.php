<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
/**
 * The template for displaying theme back to top btn
 *
 * @since   6.4.5
 * @version 1.0.0
 */
$is_customize_preview = is_customize_preview();
$to_top = etheme_get_option('to_top');
$to_top_mobile = etheme_get_option('to_top_mobile');
$class = 'back-top backOut';
if ( $is_customize_preview && ! $to_top ) {
	$class .= ' dt-hide';
}
if ( ! $to_top_mobile ) {
	$class .= ' mob-hide';
}
if ($to_top || $to_top_mobile || $is_customize_preview): ?>
	<div id="back-top" class="<?php echo esc_attr( $class ); ?>">
		<a href="#top">
			<span class="et-icon et-up-arrow"></span>
		</a>
	</div>
<?php endif;