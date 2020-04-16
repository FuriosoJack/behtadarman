<?php
namespace ETC\App\Controllers\Shortcodes;

use ETC\App\Controllers\Shortcodes;

/**
 * Categories lists shortcode.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controllers/Shortcodes
 */
class Categories extends Shortcodes {

	function hooks(){}

	function categories_shortcode( $atts ) {
		
		if ( etheme_woocommerce_notice() ) return;

		global $woocommerce_loop;

		$atts = shortcode_atts( array(
			'number'     => null,
			'title'      => '',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => 1,
			'columns' => 3,
			'parent'     => '',
			'display_type' => 'grid',
			'valign' => 'center',
			'no_space' => 0,
			'text_color' => 'white',
			'style' => 'default',

			'text_align' => 'center',
			'text_transform' => 'uppercase',
			'count_label' => '',
			'sorting' => '',
			'hide_all' => '',

			'bg_color' => '',
			'title_color' => '',
			'subtitle_color' => '',
			'title_size' => '',
			'subtitle_size' => '',
			'ids'        => '',
			'large' => 4,
			'notebook' => 3,
			'tablet_land' => 2,
			'tablet_portrait' => 2,
			'mobile' => 1,
			'slider_autoplay' => false,
			'slider_speed' => 300,
			'slider_loop' => false,
			'slider_interval' => 3000,
			'slider_stop_on_hover' => false,
			'pagination_type' => 'hide',
			'default_color' => '#e1e1e1',
			'active_color' => '#222',
			'hide_fo' => '',
			'hide_buttons' => false,
            'hide_buttons_for'   => '',
			'class'      => '',

			// extra settings
            'is_preview' => false
		), $atts );

		$options = array(
			'output' => '',
			'wrapper_attr' => array(),
			'cat_ids' => $atts['ids']
		);

		$options['p_exploded'] = explode(",", $atts['parent']);

		if ( count( $options['p_exploded'] ) > 1 ) 
			$atts['ids'] = array_map( 'trim', $options['p_exploded'] );
		else 
			$atts['ids'] = array();

		$atts['hide_empty'] = ( $atts['hide_empty'] == true || $atts['hide_empty'] == 1 ) ? 1 : 0;

		$options['is_slider'] = ( $atts['display_type'] == 'slider' ) ? true : false;

      	// get terms and workaround WP bug with parents/pad counts
		if ( $atts['ids'] ) {

			$options['args'] = $options['result'] = $options['p_cats'] = array();

			$options['_i'] = 0;

			foreach ($atts['ids'] as $key => $value ) {

				$options['args'][$options['_i']] = array(
					'orderby'    => $atts['orderby'],
					'order'      => $atts['order'],
					'hide_empty' => $atts['hide_empty'],
					'pad_counts' => true,
					'child_of'   => $value
				);

				$options['p_cats'][$options['_i']] = get_terms( 'product_cat', $options['args'][$options['_i']] );

				if ( $atts['parent'] !== '' ) {
					$options['p_cats'][$options['_i']] = wp_list_filter( $options['p_cats'][$options['_i']], array( 'parent' => $value ) );
				}

				if ( $atts['hide_empty'] ) {
					foreach ( $options['p_cats'][$options['_i']] as $key => $category ) {
						if ( $category->count == 0 ) 
							unset( $options['p_cats'][$options['_i']][ $key ] );
					}
				}

				$options['result'][] = $options['p_cats'][$options['_i']];

				$options['_i']++;
			}

			if ( $atts['number'] ) 
				$options['p_cats'] = array_slice( $options['result'], 0, $atts['number'] );
		}
		else {

			$options['cat_ids'] = array_filter( array_map( 'trim', explode( ',', $options['cat_ids'] ) ) );

			if ($options['cat_ids']) {

				array_push($options['cat_ids'], $atts['parent']);

				$options['args'] = array(
					'orderby'    => $atts['orderby'],
					'order'      => $atts['order'],
					'hide_empty' => $atts['hide_empty'],
					'include'    => $options['cat_ids'],
					'pad_counts' => true
				);

			}
			else {

				$options['args'] = array(
					'orderby'    => $atts['orderby'],
					'order'      => $atts['order'],
					'hide_empty' => $atts['hide_empty'],
					'include'    => $atts['ids'],
					'pad_counts' => true,
					'child_of'   => $atts['parent']
				);

			}

			$options['p_cats'] = get_terms( 'product_cat', $options['args'] );

			if ( $atts['parent'] !== '' && ! ($options['cat_ids'] ) ) 
				$options['p_cats'] = wp_list_filter( $options['p_cats'], array( 'parent' => $atts['parent'] ) );

			if ( $atts['hide_empty'] ) {
				foreach ( $options['p_cats'] as $key => $category ) {
					if ( $category->count == 0 ) 
						unset( $options['p_cats'][ $key ] );
				}
			}

			if ( $atts['number'] ) 
				$options['p_cats'] = array_slice( $options['p_cats'], 0, $atts['number'] );
		}

		$options['box_id'] = rand(1000,10000);

		if ( $options['is_slider'] && $atts['slider_stop_on_hover'] )
			$atts['class'] .= ' stop-on-hover';

		// selectors 
        $options['selectors'] = array();
        
        $options['selectors']['slider'] = '.slider-'.$options['box_id'];
        $options['selectors']['pagination'] = $options['selectors']['slider'] . ' .swiper-pagination-bullet';
        $options['selectors']['pagination_hover'] = $options['selectors']['pagination'].':hover';
        $options['selectors']['pagination_hover'] .= ', ' . $options['selectors']['pagination'] . '-active';

        $options['selectors']['mask'] = $options['selectors']['slider'] . ' .category-grid .categories-mask';

        $options['selectors']['title'] = $options['selectors']['mask'] . ' h4';
        $options['selectors']['count'] = $options['selectors']['mask'] . ' .count';
        $options['selectors']['count'] .= ', ' . $options['selectors']['mask'] . ' h4 sup';

        // create css data for selectors
        $options['css'] = array(
            $options['selectors']['slider'] => array(),
            $options['selectors']['pagination'] => array(),
            $options['selectors']['pagination_hover'] => array(),
            $options['selectors']['mask'] => array(),
            $options['selectors']['title'] => array(),
            $options['selectors']['count'] => array()
        );

		if ($atts['pagination_type'] != 'hide' && $options['is_slider']) {
           	$options['css'][$options['selectors']['pagination']][] = 'background-color:'.$atts['default_color'];
           	$options['css'][$options['selectors']['pagination_hover']][] = 'background-color:'.$atts['active_color'];
		}

		// title styles 
		if ( $atts['title_color'] != '' ) 
			$options['css'][$options['selectors']['title']][] = 'color:'.$atts['title_color'];

		if ( $atts['title_size'] != '' ) 
			$options['css'][$options['selectors']['title']][] = 'font-size:'.$atts['title_size'];

		// count styles
		if ($atts['subtitle_color'] != '')
			$options['css'][$options['selectors']['count']][] = 'color:'. $atts['subtitle_color'];

		if ($atts['subtitle_size'] != '')
			$options['css'][$options['selectors']['count']][] = 'font-size:'. $atts['subtitle_size'];

		if ( $atts['bg_color'] != '' ) 
			$options['css'][$options['selectors']['mask']][] = 'background-color:'.$atts['bg_color'];

        // create output css 
        $options['output_css'] = array();

        if ( count( $options['css'][$options['selectors']['pagination']] ) )
            $options['output_css'][] = $options['selectors']['pagination'] . '{'.implode(';', $options['css'][$options['selectors']['pagination']]).'}';

        if ( count( $options['css'][$options['selectors']['pagination_hover']] ) )
            $options['output_css'][] = $options['selectors']['pagination_hover'] . '{'.implode(';', $options['css'][$options['selectors']['pagination_hover']]).'}';

        if ( count( $options['css'][$options['selectors']['title']] ) )
            $options['output_css'][] = $options['selectors']['title'] . '{'.implode(';', $options['css'][$options['selectors']['title']]).'}';

	    if ( count( $options['css'][$options['selectors']['count']] ) )
            $options['output_css'][] = $options['selectors']['count'] . '{'.implode(';', $options['css'][$options['selectors']['count']]).'}';

        if ( count( $options['css'][$options['selectors']['mask']] ) )
            $options['output_css'][] = $options['selectors']['mask'] . '{'.implode(';', $options['css'][$options['selectors']['mask']]).'}';

      	// Reset loop/columns globals when starting a new loop
		$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

		$woocommerce_loop['display_type'] = $atts['display_type'];

		if(! empty( $atts['columns'] ) ) 
			$woocommerce_loop['categories_columns'] = $atts['columns'];

		if ( $options['p_cats'] ) {

			if( $atts['display_type'] == 'menu' ) {

				$options['instance'] = array(
					'style'          => 'list',
					'title_li'       => '',
					'hierarchical'   => true,
					'hide_empty'     => $atts['hide_empty'],
					'pad_counts'     => true,
					'orderby'        => $atts['orderby'],
					'order'          => $atts['order'],
					'echo'           => 1,
					'taxonomy'       => 'product_cat'
				);

				if ( !( empty( $atts['parent'] ) && count( $options['p_exploded'] ) == 1 ) ) {
					$options['instance'] = array_merge( $options['instance'], 
						array(
							'child_of'       => $atts['parent']
						) 
					);
				}

				else {
					$options['instance'] = array_merge( $options['instance'], 
						array(
							'include'        => $options['cat_ids'],
							'number'         => null
						)
					);
				}

				ob_start();
				?>

				<div class="categories-menu-element product-categories <?php echo esc_attr( $atts['class'] ); ?>">
					<?php 
						echo esc_html($atts['title']);
						wp_list_categories($options['instance']);
					?>
				</div>
				
				<?php 
				$options['output'] = ob_get_clean();
			}

			else {

				$atts['class'] .= ' slider-'.$options['box_id'];

				if( $options['is_slider'] ) {

					if ( $atts['slider_autoplay'] ) 
						$atts['slider_autoplay'] = $atts['slider_interval'];

					$atts['class'] .= ( $atts['pagination_type'] == 'lines' ) ? ' swiper-pagination-lines' : '';
					$atts['class'] .= ( $atts['no_space'] ) ? ' no-space' : '';

					$options['wrapper_attr'] = array_merge( $options['wrapper_attr'], array(
						'data-breakpoints="1"',
						'data-xs-slides="' . esc_js( $atts['mobile'] ) . '"',
						'data-sm-slides="' . esc_js( $atts['tablet_land']) . '"',
						'data-md-slides="' . esc_js( $atts['notebook'] ) . '"',
						'data-lt-slides="' . esc_js( $atts['large'] ) . '"',
						'data-slides-per-view="' . esc_js( $atts['large'] ) . '"',
						'data-autoplay="' . esc_attr( $atts['slider_autoplay'] ) . '"',
						'data-speed="' . esc_attr( $atts['slider_speed'] ) . '"',
					) );

					$atts['class'] .= ' categoriesCarousel swiper-container';

					if ( $atts['slider_loop'] ) 
						$options['wrapper_attr'][] = 'data-loop="true"';

				} 

				elseif ($atts['display_type'] == 'grid') {
					$atts['class'] .= ' categories-grid row';
					$atts['class'] .= ( $atts['no_space'] ) ? ' no-space' : '';
				}

				$options['styles'] = array();

				$options['styles']['style'] = $atts['style'];
				$options['styles']['text_color'] = $atts['text_color'];
				$options['styles']['valign'] = $atts['valign'];
				$options['styles']['text-align'] = $atts['text_align'];
				$options['styles']['text-transform'] = $atts['text_transform'];
				$options['styles']['count_label'] = $atts['count_label'];
				$options['styles']['sorting'] = $atts['sorting'];
				$options['styles']['hide_all'] = $atts['hide_all'];

				ob_start();

				if( $atts['title'] != '' ) { ?>

					<h3 class="title"><span><?php echo esc_html($atts['title']); ?></span></h3>

				<?php } ?>

				<div class="swiper-entry">

					<div class="<?php echo esc_attr( $atts['class'] ); ?>" <?php echo implode(' ', $options['wrapper_attr']); ?>>

					<?php if ( $options['is_slider'] ) { ?>

						<div class="swiper-wrapper">

					<?php }

						foreach ( $options['p_cats'] as $category ) {

							if ($options['is_slider']) { ?>
								<div class="swiper-slide">
							<?php }

								wc_get_template( 'content-product_cat.php', array(
									'category' => $category,
									'styles' => $options['styles']
								) );

							if ($options['is_slider']) { ?>
								</div>
							<?php }

						}

					if ( $options['is_slider'] ) { ?>
						</div> <?php // .swiper-wrapper ?>
					<?php } ?>

				<?php if ( $atts['pagination_type'] != 'hide' && $options['is_slider'] ) { 
						$options['pagination_class'] = '';
						if ( $atts['hide_fo'] == 'mobile' )
							$options['pagination_class'] = ' mob-hide';
						elseif ( $atts['hide_fo'] == 'desktop' )
							$options['pagination_class'] = ' dt-hide';
					?>

					<div class="swiper-pagination<?php esc_html_e( $options['pagination_class'] ); ?>"></div>

				<?php } ?>
		
				</div> <?php // .swiper-container ?>

                <?php 
                    if ( $options['is_slider'] && ( !$atts['hide_buttons'] || ( $atts['hide_buttons'] && $atts['hide_buttons_for'] != '' ) ) ) {
                        $options['nav_class'] = '';
                        if ( $atts['hide_buttons_for'] == 'desktop' ) 
                            $options['nav_class'] = ' dt-hide';
                        elseif ( $atts['hide_buttons_for'] == 'mobile' ) 
                            $options['nav_class'] = ' mob-hide';
                        ?>
                        <div class="swiper-custom-left swiper-nav <?php echo esc_attr($options['nav_class']); ?>"></div>
                        <div class="swiper-custom-right swiper-nav <?php echo esc_attr($options['nav_class']); ?>"></div>
                <?php } ?>

				</div> <?php // .swiper-entry ?>

				<?php $options['output'] = ob_get_clean(); ?>
			<?php }
		}

        if ( $atts['is_preview'] ) {
			echo parent::initPreviewCss($options['output_css']);
			echo parent::initPreviewJs();
		}
		else 
			parent::initCss($options['output_css']);

		$output = $options['output'];

		unset($atts);
		unset($options);

		woocommerce_reset_loop();

		return $output;
	}
}