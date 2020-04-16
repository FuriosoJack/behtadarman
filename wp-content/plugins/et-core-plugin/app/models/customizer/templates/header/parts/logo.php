<?php
	/**
	 * The template for displaying header logo block
	 *
	 * @since   1.4.0
	 * @version 1.0.2
	 * last changes in 1.5.5
	 */
 ?>

<?php 
	
	global $et_builder_globals;

	$element_options = array();
	// logo img default
	$element_options['logo_img_alt'] = $element_options['sticky_logo_img_alt'] = '';
	$element_options['logo_img'] = ETHEME_BASE_URI.'theme/assets/images/logo.png';

	$element_options['logo_img_et-desktop'] = Kirki::get_option( 'logo_img_et-desktop' );
	$element_options['logo_img_et-desktop'] = apply_filters('logo_img', $element_options['logo_img_et-desktop']);

	if ( is_array($element_options['logo_img_et-desktop']) ) {
		if ( isset($element_options['logo_img_et-desktop']['id']) && $element_options['logo_img_et-desktop']['id'] != '' ) {
			$element_options['logo_img_alt'] = get_post_meta( $element_options['logo_img_et-desktop']['id'], '_wp_attachment_image_alt', true);
		}
		if ( isset($element_options['logo_img_et-desktop']['url']) && $element_options['logo_img_et-desktop']['url'] != '' ) {
			$element_options['logo_img'] = $element_options['logo_img_et-desktop']['url'];
		}
	}

	$element_options['headers_sticky_logo_img'] = $element_options['logo_img'];
	// retina logo
	$element_options['retina_logo_img_et-desktop'] = Kirki::get_option( 'retina_logo_img_et-desktop' );
	$element_options['retina_logo_img'] = '';

	// to use desktop styles when use this element in mobile menu for example etc.
    $element_options['etheme_use_desktop_style'] = false;
    $element_options['etheme_use_desktop_style'] = apply_filters( 'etheme_use_desktop_style', $element_options['etheme_use_desktop_style'] );

	$element_options['logo_align'] = 'align-' . Kirki::get_option( 'logo_align_et-desktop' );
	$element_options['logo_align'] .= ( !$element_options['etheme_use_desktop_style'] ) ? ' mob-align-' . Kirki::get_option( 'logo_align_et-mobile' ) : '';

	$element_options['logo_align'] = ' ' . apply_filters('logo_align', $element_options['logo_align']);

	// retina logo sets up
	if ( is_array($element_options['retina_logo_img_et-desktop']) ) {
		if ( isset($element_options['retina_logo_img_et-desktop']['url']) && $element_options['retina_logo_img_et-desktop']['url'] != '' ) {
			$element_options['retina_logo_img'] = $element_options['headers_sticky_retina_logo_img'] = ' srcset="' . $element_options['retina_logo_img_et-desktop']['url'] . ' 2x"';
		}
	}

	// sticky retina none by default

	$element_options['headers_sticky_logo_img_et-desktop'] = Kirki::get_option( 'headers_sticky_logo_img_et-desktop' );

	// in case sticky logo not set then all logoes will be copied to fixed header too
	if ( is_array($element_options['headers_sticky_logo_img_et-desktop']) ) {
		if (isset($element_options['headers_sticky_logo_img_et-desktop']['url']) && $element_options['headers_sticky_logo_img_et-desktop']['url'] != '') {
			$element_options['headers_sticky_logo_img'] = $element_options['headers_sticky_logo_img_et-desktop']['url'];
		}
		if ( isset($element_options['headers_sticky_logo_img_et-desktop']['id']) && $element_options['headers_sticky_logo_img_et-desktop']['id'] != '' ) {
			$element_options['sticky_logo_img_alt'] = get_post_meta( $element_options['headers_sticky_logo_img_et-desktop']['id'], '_wp_attachment_image_alt', true);
		}
	}

	$element_options['logo_simple_et-desktop'] = true;
	$element_options['logo_simple_et-desktop'] = apply_filters('etheme_logo_simple', $element_options['logo_simple_et-desktop']);

	$element_options['logo_sticky_et-desktop'] = true;
	$element_options['logo_sticky_et-desktop'] = apply_filters('etheme_logo_sticky', $element_options['logo_sticky_et-desktop']);

	$element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
	$element_options['attributes'] = array();
	if ( $element_options['is_customize_preview'] ) 
		$element_options['attributes'] = array(
			'data-title="' . esc_html__( 'Logo', 'xstore-core' ) . '"',
			'data-element="logo"'
		);
?>

<div class="et_element et_b_header-logo<?php echo $element_options['logo_align'] . ( $et_builder_globals['in_mobile_menu'] ? '' : ' et_element-top-level' ); ?>" <?php echo implode( ' ', $element_options['attributes'] ); ?>>
	<a href="<?php echo home_url(); ?>">
		<?php if ( $element_options['logo_simple_et-desktop'] ) : ?>
			<span><img src="<?php echo esc_url($element_options['logo_img']); ?>" alt="<?php echo $element_options['logo_img_alt']; ?>" <?php echo $element_options['retina_logo_img']; ?>></span>
		<?php endif; ?>
		<?php if ( $element_options['logo_sticky_et-desktop'] ) : ?>
			<span class="fixed"><img src="<?php echo esc_url($element_options['headers_sticky_logo_img']); ?>" alt="<?php echo $element_options['sticky_logo_img_alt']; ?>"></span>
		<?php endif; ?>
	</a>
</div>

<?php unset($element_options); ?>