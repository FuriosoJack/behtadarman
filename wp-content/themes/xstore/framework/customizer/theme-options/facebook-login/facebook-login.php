<?php  
	/**
	 * The template created for displaying facebook login options 
	 *
	 * @version 0.0.1
	 * @since 6.0.0
	 */
	
	// section general-facebook
	Kirki::add_section( 'general-facebook', array(
	    'title'          => esc_html__( 'Facebook Login', 'xstore' ),
	    'description' => sprintf (esc_html__( 'To create FaceBook APP ID follow the instructions %1s %2s Check theme documentation if it does not work for you %3s', 'xstore' ), '<a href="https://developers.facebook.com/docs/apps/register" target="blank">https://developers.facebook.com/docs/apps/register</a>', '<br/>', '<a href="https://xstore.helpscoutdocs.com/article/87-facebook-login" target="blank">https://xstore.helpscoutdocs.com/article/87-facebook-login</a>' ),
	    'icon' => 'dashicons-facebook',
	    'priority' => $priorities['facebook-login']
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'facebook_app_id',
			'label'    => esc_html__( 'Facebook APP ID', 'xstore' ),
			'section'  => 'general-facebook',
			'default'  => '',
		) );

		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'text',
			'settings' => 'facebook_app_secret',
			'label'    => esc_html__( 'Facebook APP SECRET', 'xstore' ),
			'section'  => 'general-facebook',
			'default'  => '',
		) );

?>