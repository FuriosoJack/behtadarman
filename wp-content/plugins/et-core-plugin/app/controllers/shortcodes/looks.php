<?php
namespace ETC\App\Controllers\Shortcodes;

use ETC\App\Controllers\Shortcodes;

/**
 * Looks shortcode.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controllers/Shortcodes
 */
class Looks extends Shortcodes {

	function hooks() {}

	function looks_shortcode( $atts, $content ) {

		if ( etheme_woocommerce_notice() ) return;

		global $woocommerce_loop;

		$atts = shortcode_atts(array(
			'class'  => '',
		), $atts);

		$options = array();

		preg_match_all( '/et_the_look([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );

		$options['look_titles'] = isset( $matches[1] ) ? $matches[1] : array();

		ob_start();

		?>

		<div class="et-looks <?php esc_attr_e( $atts['class'] ); ?>">
			<?php 

				if( count( $options['look_titles'] ) > 1 ) : ?>

					<ul class="et-looks-nav">
						<?php $local_options = array(
							'i' => 0
						);
						foreach ( $options['look_titles'] as $look ) {
							$local_options['i']++;
							?>
							<li>
								<a href="#">
									<?php echo $local_options['i']; ?>
								</a>
							</li>
						<?php } 
							unset($local_options);
						?>
					</ul>

				<?php endif; 
			
			?>
			<div class="et-looks-content has-no-active-item">
				<?php echo do_shortcode( $content ); ?>
			</div>
		</div>
	
		<?php 

		unset($atts);
		unset($options);
		
		return ob_get_clean();
	}
}
