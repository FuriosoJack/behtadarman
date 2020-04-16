<?php 
	/**
	 * The template created for displaying header panel
	 *
	 * @version 1.0.0
	 * @since 1.4.0
	 */

	$checked = get_option( 'etheme_header_builder', false );

	$checked = ( $checked ) ? 'checked' : '';

	Kirki::add_panel( 'header-builder', array(
	    'title'       => esc_html__( 'Header Builder', 'xstore-core' ),
	    'description' => '<span class="customize-control-kirki-toggle"> <label for="etheme-disable-default-header"> <span class="customize-control-title">' . esc_html__( 'Disable header builder', 'xstore-core' ) . '</span> <input class="screen-reader-text" id="etheme-disable-default-header" name="etheme-disable-default-header" type="checkbox" ' . $checked . '><span class="switch"></span></label></span>',
	    'icon'		  => 'dashicons-arrow-up-alt',
	    'priority' => 3
		) );
?>