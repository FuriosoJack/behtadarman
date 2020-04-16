<?php  
	/**
	 * The template created for displaying footer panel
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// panel footer
	Kirki::add_panel( 'footer', array(
	    'title'       => esc_html__( 'Footer', 'xstore' ),
	    'icon'		  => 'dashicons-arrow-down-alt',
	    'priority' => $priorities['footer']
		) );
?>