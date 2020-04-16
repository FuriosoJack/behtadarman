<?php
/**
 * The template for displaying search forms
 *
 */

defined( 'ABSPATH' ) || exit( 'Direct script access denied.' );

$header_type      = get_query_var( 'et_ht', 'xstore' );
$ajax['enable']   = etheme_get_option( 'search_ajax' );
$ajax['taxonomy'] = $ajax['name'] = 'product_cat';
$ajax['product']  = etheme_get_option( 'search_ajax_product' );
$ajax['post']     = etheme_get_option( 'search_ajax_post' );
$class            = '';

if( $ajax['enable'] ) {
	$class .= 'ajax-search-form';
	if ( $ajax['post'] && $ajax['product'] ) {
		$class .= ' all-results-on';
	} elseif ( $ajax['product'] ) {
		$class .= ' product-results-on';
	} elseif ( $ajax['post'] ) {
		$class .= ' post-results-on';
		$ajax['taxonomy'] = 'category';
		$ajax['name'] = 'cat';
	}
}
?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="searchform" class="<?php echo esc_attr($class); ?>" method="get">
	<div class="input-row">
		<input type="text" value="" placeholder="<?php esc_attr_e( 'Type here...', 'xstore' ); ?>" autocomplete="off" class="form-control" name="s" />
		<input type="hidden" name="post_type" value="<?php echo esc_attr( $ajax['product'] ) ? 'product': 'post' ; ?>" />
		<?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ) : ?>
			<input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/>
		<?php endif ?>
		<?php
            if ( $header_type == 'advanced' ) {
                wp_dropdown_categories(array(
                    'show_option_all' => esc_html__( 'All categories', 'xstore' ),
                    'taxonomy'        => $ajax['taxonomy'],
                    'hierarchical'    => true,
                    'id'              => $ajax['name'] . '-' . rand( 100, 999 ),
                    'name'            => $ajax['name'],
                    'orderby'         => 'name',
                    'value_field'     => 'slug'
                ));
            }
        ?>
		<button type="submit" class="btn filled"><?php esc_html_e( 'Search', 'xstore' ); ?><i class="et-icon et-zoom"></i></button>
	</div>
	<?php if($ajax['enable']): ?>
		<div class="ajax-results-wrapper"><div class="ajax-results"></div></div>
	<?php endif ?>
</form>