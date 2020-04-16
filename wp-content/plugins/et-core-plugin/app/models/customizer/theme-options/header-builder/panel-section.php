<?php 
	/**
	 * The template created for displaying header panel
	 *
	 * @version 1.0.0
	 * @since 1.4.0
	 */

	$checked = get_option( 'etheme_header_builder', false );

	$checked = ( $checked ) ? 'checked' : '';

	Kirki::add_section( 'header-builder', array(
	    'title'       => esc_html__( 'Header Builder', 'xstore-core' ),
	    'description' => esc_html__( 'Activating header builder will deactivate your current header options. Working with one will disable the other. All old header options will be deprecated soon.', 'xstore-core' ) . '<br/><br/><span class="customize-control-kirki-toggle"> <label for="etheme-disable-default-header"> <span class="customize-control-title">' . esc_html__( 'Enable header builder', 'xstore-core' ) . '</span> <input class="screen-reader-text" id="etheme-disable-default-header" name="etheme-disable-default-header" type="checkbox" ' . $checked . '><span class="switch"></span></label></span>',
	    'icon'		  => 'dashicons-arrow-up-alt',
	    'priority' => 2
		) );
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'et_placeholder_header_builder',
			'label'       => false,
			'section'     => 'header-builder',
			'default'     => '',
			'priority'    => 10,
		) );
?>