<?php
namespace ETC\App\Controllers\Shortcodes;

use ETC\App\Controllers\Shortcodes;

/**
 * Portfolio Recent shortcode.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controllers/Shortcodes
 */
class Portfolio_Recent extends Shortcodes {

	function hooks() {}

	function portfolio_recent_shortcode( $atts, $content ) {
		$atts = shortcode_atts(array(
			'limit'   => '',
			'title'   => '',
			'columns' => '',
			'order'   => 'DESC',
			'ajax'    => false,
			'is_preview' => false
		), $atts);

		$options = array();

		global $et_portfolio_loop;

		$et_portfolio_loop['columns'] = $atts['columns'];

		$options['wp_query_args'] = array(
			'post_type'      => 'etheme_portfolio',
			'order'          => $atts['order'],
			'orderby'        => 'date',
			'posts_per_page' => $atts['limit']
		);

		$options['spacing'] = etheme_get_option( 'portfolio_margin' );
		$options['posts'] = new \WP_Query( $options['wp_query_args'] );

		ob_start();
		if ( $options['posts']->have_posts() ) :
			if ( $atts['title'] ) { ?>
				<h3 class="title">
					<span>
						<?php echo esc_html($atts['title']); ?>
					</span>
				</h3>
			<?php } ?>
			
			<div class="portfolio spacing-<?php esc_attr_e( $options['spacing'] ); ?>">
				<?php 
					while ( $options['posts']->have_posts() ) : 
						$options['posts']->the_post();
						get_template_part( 'content', 'portfolio' );
					endwhile;
				?> 
			</div>
		<?php 
		endif;

        if ( $atts['is_preview'] ) 
            echo parent::initPreviewJs();

		unset($atts);
		unset($options);
		
		wp_reset_query();
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}
