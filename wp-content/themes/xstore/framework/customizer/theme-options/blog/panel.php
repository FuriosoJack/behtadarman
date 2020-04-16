<?php  
	/**
	 * The template created for displaying blog panel
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// panel blog
	Kirki::add_panel( 'blog', array(
	    'title'       => esc_html__( 'Blog', 'xstore' ),
	    'icon'		  => 'dashicons-editor-table',
	    'priority' => $priorities['blog']
		) );
?>