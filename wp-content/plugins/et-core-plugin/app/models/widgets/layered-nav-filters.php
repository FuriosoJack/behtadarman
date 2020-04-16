<?php
namespace ETC\App\Models\Widgets;

use ETC\App\Models\WC_Widget;

/**
 * Layered Navigation Filters Widget..
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models/Admin
 */
class Layered_Nav_Filters extends WC_Widget {
	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'sidebar-widget etheme-active-filters widget_layered_nav_filters';
		$this->widget_description = esc_html__( 'Display a list of active product filters.', 'xstore-core' );
		$this->widget_id          = 'et_layered_nav_filters';
		$this->widget_name        = '8theme - ' . esc_html__( 'Active Product Filters', 'xstore-core' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Active filters', 'xstore-core' ),
				'label' => esc_html__( 'Title', 'xstore-core' ),
			),
		);
		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}

		$filter_brand = isset( $_GET['filter_brand'] ) ? $_GET['filter_brand'] : '' ;
		$_chosen_attributes = \WC_Query::get_layered_nav_chosen_attributes();
		$min_price          = isset( $_GET['min_price'] ) ? wc_clean( wp_unslash( $_GET['min_price'] ) ) : 0; // WPCS: input var ok, CSRF ok.
		$max_price          = isset( $_GET['max_price'] ) ? wc_clean( wp_unslash( $_GET['max_price'] ) ) : 0; // WPCS: input var ok, CSRF ok.
		$rating_filter      = isset( $_GET['rating_filter'] ) ? array_filter( array_map( 'absint', explode( ',', wp_unslash( $_GET['rating_filter'] ) ) ) ) : array(); // WPCS: sanitization ok, input var ok, CSRF ok.
		$base_link          = $this->get_current_page_url();

		// ! Fix for brands
		if ( $filter_brand ) {
			$base_link = add_query_arg( 'filter_brand', $filter_brand, $base_link );
		}

		if ( 0 < count( $_chosen_attributes ) || 0 < $min_price || 0 < $max_price || ! empty( $rating_filter ) || ! empty( $filter_brand ) ) {
			$this->widget_start( $args, $instance );
			echo '<ul>';
			// Attributes.
			if ( ! empty( $_chosen_attributes ) ) {
				foreach ( $_chosen_attributes as $taxonomy => $data ) {
					foreach ( $data['terms'] as $term_slug ) {
						$term = get_term_by( 'slug', $term_slug, $taxonomy );
						if ( ! $term ) {
							continue;
						}
						$filter_name    = 'filter_' . sanitize_title( str_replace( 'pa_', '', $taxonomy ) );
						$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array(); // WPCS: input var ok, CSRF ok.
						$current_filter = array_map( 'sanitize_title', $current_filter );
						$new_filter     = array_diff( $current_filter, array( $term_slug ) );
						$link = remove_query_arg( array( 'add-to-cart', $filter_name ), $base_link );
						if ( count( $new_filter ) > 0 ) {
							$link = add_query_arg( $filter_name, implode( ',', $new_filter ), $link );
						}
						echo '<li class="chosen"><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'xstore-core' ) . '" href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a></li>';
					}
				}
			}
			if ( $min_price ) {
				$link = remove_query_arg( 'min_price', $base_link );
				/* translators: %s: minimum price */
				echo '<li class="chosen"><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'xstore-core' ) . '" href="' . esc_url( $link ) . '">' . sprintf( esc_html( 'Min %s', 'xstore-core' ), wc_price( $min_price ) ) . '</a></li>'; // WPCS: XSS ok.
			}
			if ( $max_price ) {
				$link = remove_query_arg( 'max_price', $base_link );
				/* translators: %s: maximum price */
				echo '<li class="chosen"><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'xstore-core' ) . '" href="' . esc_url( $link ) . '">' . sprintf( esc_html( 'Max %s', 'xstore-core' ), wc_price( $max_price ) ) . '</a></li>'; // WPCS: XSS ok.
			}
			if ( ! empty( $rating_filter ) ) {
				foreach ( $rating_filter as $rating ) {
					$link_ratings = implode( ',', array_diff( $rating_filter, array( $rating ) ) );
					$link         = $link_ratings ? add_query_arg( 'rating_filter', $link_ratings ) : remove_query_arg( 'rating_filter', $base_link );
					/* translators: %s: rating */
					echo '<li class="chosen"><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'xstore-core' ) . '" href="' . esc_url( $link ) . '">' . sprintf( esc_html__( 'Rated %s out of 5', 'xstore-core' ), esc_html( $rating ) ) . '</a></li>';
				}
			}

			// ! Use for brand
			if ( $filter_brand ) {
				$barnds = explode(',', $filter_brand);
				$link = remove_query_arg( 'filter_brand', $base_link );

				foreach ( $barnds as $key => $value ) {
					$all = $barnds;
					$bk  = array_search($value, $barnds);

					unset($all[$bk]);

					if ( $all ) {
						$link = add_query_arg( 'filter_brand', implode( ',', $all ), $link );
					}

					$term = get_term_by( 'slug', $value, 'brand' );

					/* translators: %s: maximum price */
					echo '<li class="chosen"><a class="remove-brand" rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'xstore-core' ) . '" href="' . esc_url( $link ) . '">' . $term->name . '</a></li>'; // WPCS: XSS ok.
				}
			
			}

			echo '</ul>';
			$this->widget_end( $args );
		}
	}
}