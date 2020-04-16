<?php  
	/**
	 * The template created for displaying instagram api options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section general-instagram
	Kirki::add_section( 'general-instagram', array(
	    'title'          => esc_html__( 'Instagram API', 'xstore' ),
	    'description' => esc_html__('To add instagram account click the button below and follow the intructions.', 'xstore'),
	    'icon' => 'dashicons-instagram',
	    'priority' => $priorities['instagram-api']
		) );

		Kirki::add_field( 'theme_config_id', array(
			'type'        => 'custom',
			'settings'    => 'add_instagram',
			'label'       => false,
			'section'     => 'general-instagram',
			'default'     => '<a class="button" href="'.admin_url('admin.php?page=et-panel-social').'" target="_blank">'.esc_html__('Add your account', 'xstore').'</a>',
			'priority'    => 10,
		) );

?>