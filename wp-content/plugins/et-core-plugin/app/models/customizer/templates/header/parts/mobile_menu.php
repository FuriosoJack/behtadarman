<?php
	/**
	 * The template for displaying header mobile menu block
	 *
	 * @since   1.4.0
	 * @version 1.0.3
	 * last changes in 1.5.5
	 */
 ?>

<?php 	
	
	if ( !class_exists('ETheme_Navigation') ) return;

	global $et_builder_globals;

	$et_builder_globals['in_mobile_menu'] = true;

	$mob_menu_element_options = array();

	$mob_menu_element_options['mobile_menu_type_et-desktop'] = Kirki::get_option( 'mobile_menu_type_et-desktop' );
	$mob_menu_element_options['mobile_menu_item_click_et-desktop'] = Kirki::get_option( 'mobile_menu_item_click_et-desktop' );
	$mob_menu_element_options['mobile_menu_content_position'] = ( $mob_menu_element_options['mobile_menu_type_et-desktop'] == 'off_canvas_left' ) ? 'left' : 'right';

	$mob_menu_element_options['mobile_menu_classes'] = ' static';
	$mob_menu_element_options['mobile_menu_classes'] .= ( $mob_menu_element_options['mobile_menu_type_et-desktop'] != 'popup' ) ? ' et-content_toggle et-off-canvas et-content-' . $mob_menu_element_options['mobile_menu_content_position'] : ' ';
	$mob_menu_element_options['mobile_menu_classes'] .= ' toggles-by-arrow';

	$mob_menu_element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
	$mob_menu_element_options['attributes'] = array();
	if ( $mob_menu_element_options['is_customize_preview'] ) 
		$mob_menu_element_options['attributes'] = array(
			'data-title="' . esc_html__( 'Mobile menu', 'xstore-core' ) . '"',
			'data-element="mobile_menu"'
		); 
	$mob_menu_element_options['attributes'][] = 'data-item-click="' . ( ( $mob_menu_element_options['mobile_menu_item_click_et-desktop'] ) ? 'arrow' : 'item' ) . '"';

?>

<div class="et_element et_b_header-mobile-menu <?php echo $mob_menu_element_options['mobile_menu_classes']; ?>" <?php echo implode( ' ', $mob_menu_element_options['attributes'] ); ?>>
	<?php echo mobile_menu_callback(); ?>
</div>
<?php 

$et_builder_globals['in_mobile_menu'] = false;

?>
<?php unset($mob_menu_element_options); ?>