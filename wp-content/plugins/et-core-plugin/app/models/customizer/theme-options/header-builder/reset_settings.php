<?php 
	/**
	 * The template created for displaying header panel
	 *
	 * @version 1.0.0
	 * @since 1.4.0
	 */

	Kirki::add_section( 'header_builder_reset', array(
	    'title'       => esc_html__( 'Reset header builder', 'xstore-core' ),
	    'description' => esc_html__( 'This option will clear your prebuild header elements', 'xstore-core' ),
	    'icon'		  => 'dashicons-image-rotate',
	    'panel' => 'header-builder',
		) );
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'et_placeholder' . $index++,
			'label'       => esc_html__( 'Reset header builder settings', 'xstore-core' ),
			'section'     => 'header_builder_reset',
			'default'     => '<span id="etheme-reset-header-builder" style="padding: 5px 7px; border-radius: 2px; background: #222; color: #fff; ">' . esc_html__( 'Reset elements', 'xstore-core' ) . '</span>',
			'priority'    => 10,
		) );
?>