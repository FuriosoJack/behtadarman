<?php  
	/**
	 * The template created for displaying header panel
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// panel header
	Kirki::add_panel( 'header', array(
	    'title'       => esc_html__( 'Header', 'xstore' ),
	    'icon'		  => 'dashicons-arrow-up-alt',
	    'priority' => $priorities['header'],
	    'description' => esc_html__('These options will be deprecated in ', 'xstore') . et_time_2_remove_header() . '. ' . esc_html__( 'We recommend you to use ', 'xstore' ) . '<span class="et_edit" data-section="et_placeholder_header_builder"><b>' . esc_html__( 'Header Builder', 'xstore' ) . '.</b></span>'
		) );
?>