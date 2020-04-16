<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * The template for displaying multiple section of Wordpress customizer
 *
 * @since   1.4.4
 * @version 1.0.0
 */

$builder = isset( $_POST['builder'] ) ? $_POST['builder'] : 'header';
$classes = array();
$texts   = array();

if ( $builder == 'header' ) {
	$classes[] = 'et_headers-multiple';
	$classes[] = 'et_headers-multiple-content';
	$classes[] = 'et_headers-multiple-headers';
	$classes[] = 'et_headers-multiple-conditions';
	$texts['templates-title']  = esc_html__( 'Your headers (Add/Edit/Delete)', 'xstore-core' );
	$texts['conditions-title'] = esc_html__( 'Where do you want to display your header?', 'xstore-core' );
	$texts['bug']              = esc_html__( 'headers', 'xstore-core' );
} elseif( $builder == 'single-product' ){
	$classes[] = 'et_product-single-multiple';
	$classes[] = 'et_product-single-multiple-content';
	$classes[] = 'et_product-single-multiple-products';
	$classes[] = 'et_product-single-multiple-conditions';
	$texts['templates-title']  = esc_html__( 'Your templates (Add/Edit/Delete)', 'xstore-core' );
	$texts['conditions-title'] = esc_html__( 'Where do you want to display your template?', 'xstore-core' );
	$texts['bug']              = esc_html__( 'templates', 'xstore-core' );
}
?>
<div class="et_builder-multiple <?php echo $classes[0]; ?> hidden">
	<div class="et_builder-multiples <?php echo $classes[2]; ?>">
		<h3>
			<?php echo $texts['templates-title']; ?>
		</h3>
		<p style="text-align: center; color: #555">Multiple <?php echo $texts['bug']; ?> are in <span style="color: #c62828">beta</span> now. Send us a <span class="dashicons dashicons-buddicons-replies"></span> <a href="https://www.8theme.com/forums/xstore-wordpress-support-forum/" target="_blank" style="color: #222;">bug report</a>, if you found the issue. Before using, please <span class="dashicons dashicons-format-video"></span> <a href="https://www.youtube.com/watch?v=BpeXfzNwkOc&feature=youtu.be" target="_blank" style="color: #222;">watch the video.</a></p>
		<div class="et_builder-multiple-content <?php echo $classes[1]; ?>">
			<?php require( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/multiple-headers.php' ); ?>
		</div>
	</div>
	<div class="et_builder-multiple-conditions <?php echo $classes[3]; ?>">
		<h3><?php echo $texts['conditions-title']; ?></h3>
		<div class="et_builder-multiple-content <?php echo $classes[1]; ?>">
			<?php require( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/multiple-conditions.php' ); ?>
		</div>
	</div>
</div>