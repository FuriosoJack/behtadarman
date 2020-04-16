<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * The template for displaying multiple templates of Wordpress customizer
 *
 * @since   1.4.6
 * @version 1.0.2
 */

$builder = isset( $_POST['builder'] ) ? $_POST['builder'] : 'header';
if ( $builder == 'header' ) {
	$headers = get_option('et_multiple_headers', false);

	$texts['new-template']             = esc_html__( 'Add Header', 'xstore-core' );
	$texts['new-template-placeholder'] = esc_html__( 'Name your header', 'xstore-core' );
	$texts['default-condition']        = esc_html__( 'Entire Site by Default', 'xstore-core' );
} elseif( $builder == 'single-product' ){
	$headers = get_option('et_multiple_single_product', false);

	$texts['new-template']             = esc_html__( 'Add Template', 'xstore-core' );
	$texts['new-template-placeholder'] = esc_html__( 'Name your template', 'xstore-core' );
	$texts['default-condition']        = esc_html__( 'All products by Default', 'xstore-core' );
}

$headers = json_decode($headers, true);

if ( ! is_array($headers) ) {
    $headers = array();
}

$_i = 0;
?>

<ul>
	<?php foreach ($headers as $key => $value): ?>
		<?php 
		$_i++;
		?>
		<li data-header="<?php echo $key; ?>" class="<?php echo ( $_i == count($headers) ) ? 'last': ''; ?>">
			<div class="et_header-left">
				<span class="et_header-title"><b><?php echo ( $value['title'] == 'Default' ) ? $value['title'] . ' ' . $builder : $value['title']; ?></b></span>
				<span class="et_header-conditions text-nowrap">
					<?php
						$Etheme_Customize_Builder = new Etheme_Customize_header_Builder();

						if ( $builder == 'header' ) {
							$conditions = $Etheme_Customize_Builder->get_json_option('et_multiple_conditions');
						} elseif( $builder == 'single-product' ){
							$conditions = $Etheme_Customize_Builder->get_json_option('et_multiple_single_product_conditions');
						}

						
						$titles = $Etheme_Customize_Builder->condition_default_select_data();
						$i = 0;
						foreach ( $conditions as $k => $v ) {
							if ( $i > 1 ) {
								echo '...'; break;
							}
							if ( $key == $v['header'] ) {

								echo '<span class="et_header-condition">';

									if ( $builder == 'header' ) {
										echo $titles[$v['primary']]['title'];
									} else {
										if ( is_array( $v['primary'] ) ) {
											$post_type = get_post_type_object($v['primary']['post_type']);
											echo $post_type->label . '/' . $v['primary']['title'];
										} elseif ( ! empty( $v['primary'] ) )  {
											echo '/'. $titles[$v['primary']]['title'];
										}
									}

									if ( isset( $v['secondary'] ) ) {
										if ( is_array( $v['secondary'] ) ) {
											$post_type = get_post_type_object($v['secondary']['post_type']);
											echo '/' . $post_type->label . '/' . $v['secondary']['title'];
										} elseif ( ! empty( $v['secondary'] ) )  {
											echo '/'. $titles[$v['secondary']]['title'];
										}
									}
									if ( isset( $v['third'] ) && ! empty( $v['third'] ) ) {
											$atts	          = array();
											$atts['selected'] = $v['third'];

											if ( $builder == 'header' ) {
												$atts['data']     = $v['secondary'];
											} else {
												$atts['data']     = $v['primary'];
											}

											$selected = $Etheme_Customize_Builder->condition_select_data($atts);	
										echo '/'. $selected[0]['text'];
									}
								echo "<br></span>";
								$i++;
							} 
							if( $value['title'] == 'Default' ) {
								echo '<span class="et_header-condition">' . $texts['default-condition'] . '</span>';
								break;
							}
						}
					?>
				</span>
			</div>
			<span class="et_header-actions">
				<?php if ( $value['title'] != 'Default' ): ?>
					<span class="et_header-action et_button et_button-darktext et_header-edit" data-action="edit"><span class="dashicons dashicons-edit"></span></span>
					<span class="et_header-action et_button et_button-green et_header-save hidden" data-action="save" data-saving-text="saving..."><span class="dashicons dashicons-yes"></span></span>

					<?php if ( $builder == 'header' ): ?>
						<span class="et_separator">|</span>
						<span class="et_button et_button-lightgrey desktop" data-device="desktop"><span class="dashicons dashicons-desktop"></span><span><?php esc_html_e('Edit desktop','xstore-core'); ?></span></span>
						<span class="et_separator">|</span>
						<span class="et_button et_button-lightgrey mobile" data-device="mobile"><span class="dashicons dashicons-smartphone"></span><span><?php esc_html_e('Edit mobile','xstore-core'); ?></span></span>
					<?php elseif ( $builder == 'single-product' ) : ?>
						<span class="et_separator">|</span>
			            <span class="et_button et_button-lightgrey show-builder"><span class="dashicons dashicons-schedule"></span><span><?php esc_html_e( 'Build Product', 'xstore-core' ); ?></span></span>	
					<?php endif; ?>

					<span class="et_header-action et_button et_button-darktext et_header-remove" data-action="remove"><span class="dashicons dashicons-trash"></span></span>
				<?php endif; ?>
			</span>
		</li>
	<?php endforeach; ?>
</ul>

<div class="add-new-section">
	<div class="et_new-multiple-holder hidden">
		<input class="et_add-new-multiple" placeholder="<?php echo $texts['new-template-placeholder']; ?>" name="et_add-new-header" type="text">
		<span class="et_button et_button-lg et_button-green et_header-action et_header-add" data-action="add"><?php esc_html_e('Add new', 'xstore-core'); ?></span>
	</div>
	<span class="et_call-new-header et_button et_button-lg et_button-lightgrey"><?php echo $texts['new-template']; ?></span>
</div>