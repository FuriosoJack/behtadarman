<?php  
	/**
	 * The template created for displaying social sharing options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section social-sharing
	Kirki::add_section( 'social-sharing', array(
	    'title'          => esc_html__( 'Social sharing', 'xstore' ),
	    'icon' => 'dashicons-share-alt',
	    'priority' => $priorities['social-sharing']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'multicheck',
			'settings'    => 'socials',
			'label'       => esc_html__( 'Select socials you want to show', 'xstore' ),
			'description' => esc_html__( 'Turn on share buttons you need to show on the single product and post pages.', 'xstore' ),
			'section'     => 'social-sharing',
			'default'     => array( 'share_twitter', 'share_facebook', 'share_vk', 'share_pinterest', 'share_mail', 'share_linkedin', 'share_whatsapp', 'share_skype'
			),
			'choices'     => array(
				'share_twitter' => esc_html__( 'Share twitter', 'xstore' ),
                'share_facebook' => esc_html__( 'Share facebook', 'xstore' ),
                'share_vk' => esc_html__( 'Share vk', 'xstore' ),
                'share_pinterest' => esc_html__( 'Share pinterest', 'xstore' ),
                'share_mail' => esc_html__( 'Share mail', 'xstore' ),
                'share_linkedin' => esc_html__( 'Share linkedin', 'xstore' ),
                'share_whatsapp' => esc_html__( 'Share whatsapp', 'xstore' ),
                'share_skype' => esc_html__( 'Share skype', 'xstore' ),
			),
		) );

?>