<?php  
	/**
	 * The template created for displaying header contacts options 
	 *
	 * @version 1.0.3
	 * @since 1.4.0
	 * last changes in 1.5.5
	 */

	// section contacts
	Kirki::add_section( 'contacts', array(
	    'title'          => esc_html__( 'Contacts', 'xstore-core' ),
	    'panel' => 'header-builder',
	    'icon' => 'dashicons-phone'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'contacts_content_separator',
			'section'     => 'contacts',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// contacts_icon
	    Kirki::add_field( 'et_kirki_options', array(
	        'type'        => 'radio-image',
	        'settings'    => 'contacts_icon_et-desktop',
	        'label'       => $strings['label']['type'],
	        'section'     => 'contacts',
	        'default'     => 'left',
	        'choices'     => array(
	            'left' => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/contacts/Style-contacts-horizontal-icon-1.svg',
	            'top'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/contacts/Style-contacts-horizontal-icon-2.svg',
	            'none'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/contacts/Style-contacts-horizontal-icon-3.svg',
	        ),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'contacts_icon_et-desktop' => array(
					'selector'  => '.et_b_header-contacts.et_element-top-level',
					'render_callback' => 'header_contacts_callback'
				),
			),
	    ) );

		// contacts_direction
		Kirki::add_field( 'et_kirki_options', array(
			'type'     => 'radio-buttonset',
			'settings' => 'contacts_direction_et-desktop',
			'label'    => $strings['label']['direction'],
			'section'  => 'contacts',
			'default'  => 'hor',
			'choices'  => $choices['direction']['type1'],
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'contacts_direction_et-desktop' => array(
					'selector'  => '.et_b_header-contacts.et_element-top-level',
					'render_callback' => 'header_contacts_callback'
				),
			),
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-contacts.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'flex-col',
					'value' => 'ver'
				),
				array(
					'element'  => '.et_b_header-contacts.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'flex-inline',
					'value' => 'hor'
				),
				array(
					'element'  => '.et_b_header-contacts.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'flex',
					'value' => 'ver'
				),
			),
		) );

		// contacts_separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'toggle',
			'settings'    => 'contacts_separator_et-desktop',
			'label'       => esc_html__( 'Add separators between contacts', 'xstore-core' ),
			'section'     => 'contacts',
			'default'     => '0',
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'contacts_separator_et-desktop' => array(
					'selector'  => '.et_b_header-contacts.et_element-top-level',
					'render_callback' => 'header_contacts_callback'
				),
			),
		) );

		// contacts_separator_type 
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'contacts_separator_type_et-desktop',
			'label'       => esc_html__( 'Separator type', 'xstore-core' ),
			'section'     => 'contacts',
			'default'	  => '\2059',
			'choices'     => $menu_settings['separators'],
			'active_callback' => array(
				array(
					'setting'  => 'contacts_direction_et-desktop',
					'operator' => '==',
					'value'    => 'hor',
				),
				array(
					'setting'  => 'contacts_separator_et-desktop',
					'operator' => '==',
					'value'    => '1',
				),
			),
			'transport' => 'auto',
			'output'  => array(
				array(
					'element' => '.et_b_header-contacts.et_element-top-level .contact:not(:last-child) + .et_b_header-contact-sep:before',
					'property' => 'content',
					'value_pattern' => '"$"'
				),
			),
		) );

		// contacts_package
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'repeater', 
			'settings'     => 'contacts_package_et-desktop',
			'label'       => $strings['label']['elements'],
			'section'     => 'contacts',
			'row_label' => array(
				'type' => 'field',
				'value' => esc_html__('Contact name', 'xstore-core' ),
				'field' => 'contact_title',
			),
			'button_label' => esc_html__('Add new field', 'xstore-core' ),
			'default'      => array(
				array(
					'contact_title' => esc_html__( 'Phone', 'xstore-core' ),
					'contact_subtitle' => esc_html__( 'Call us any time', 'xstore-core' ),
					'contact_icon'  => 'et_icon-phone',
					'contact_link' => '',
					'contact_link_target' => '0'
				),
			),
			'fields' => array(
				'contact_title' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Field name', 'xstore-core' ),
					'default'     => '',
				),
				'contact_subtitle' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Text for field', 'xstore-core' ),
					'description' => esc_html__( 'Add text you want to show next for the icon', 'xstore-core' ),
					'default'     => '',
				),
				'contact_link' => array(
					'type'        => 'text',
					'label'       => esc_html__( 'Url for field', 'xstore-core' ),
					'description' => esc_html__( 'Add link for your field', 'xstore-core' ),
					'default'     => '',
				),
				'contact_link_target' => array(
					'type'        => 'checkbox',
					'label'       => $strings['label']['target_blank'],
					'default'     => '0',
				),
				'contact_icon' => array(
					'type'        => 'select',
					'label'       => $strings['label']['icon'],
					'description' => $strings['description']['icons_style'],
					'default'     => 'et_icon-coupon',
					'choices'     =>  $icons['simple'],
				),
			),
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'contacts_package_et-desktop' => array(
					'selector'  => '.et_b_header-contacts.et_element-top-level',
					'render_callback' => 'header_contacts_callback'
				),
			),
		) );

		// style separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'contacts_style_separator',
			'section'     => 'contacts',
			'default'     => $separators['style'],
			'priority'    => 10,
		) );

		// contacts_alignment
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-buttonset',
			'settings'    => 'contacts_alignment_et-desktop',
			'label'       => $strings['label']['alignment'],
			'section'     => 'contacts',
			'default'     => 'start',
			'choices'     => $choices['alignment'],
			'transport' => 'postMessage',
			'partial_refresh' => array(
				'contacts_alignment_et-desktop' => array(
					'selector'  => '.et_b_header-contacts.et_element-top-level',
					'render_callback' => 'header_contacts_callback'
				),
			),
			'js_vars'     => array(
				array(
					'element'  => '.et_b_header-contacts.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'justify-content-start',
					'value' => 'start'
				),
				array(
					'element'  => '.et_b_header-contacts.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'justify-content-center',
					'value' => 'center'
				),
				array(
					'element'  => '.et_b_header-contacts.et_element-top-level',
					'function' => 'toggleClass',
					'class' => 'justify-content-end',
					'value' => 'end'
				),
				// array(
				// 	'element'  => '.et_b_header-contacts.et_element-top-level:not(.flex-col)',
				// 	'function' => 'toggleClass',
				// 	'class' => 'align-items-start',
				// 	'value' => 'start'
				// ),
				// array(
				// 	'element'  => '.et_b_header-contacts.et_element-top-level:not(.flex-col)',
				// 	'function' => 'toggleClass',
				// 	'class' => 'align-items-center',
				// 	'value' => 'center'
				// ),
				// array(
				// 	'element'  => '.et_b_header-contacts.et_element-top-level:not(.flex-col)',
				// 	'function' => 'toggleClass',
				// 	'class' => 'align-items-end',
				// 	'value' => 'end'
				// ),
			),
		) );

		// contact_box_model
		Kirki::add_field( 'et_kirki_options', array(
			'settings'    => 'contact_box_model_et-desktop',
			'label'       => $strings['label']['computed_box'],
			'description' => $strings['description']['computed_box'],
			'type'        => 'kirki-box-model',
			'section'     => 'contacts',
			'default'     => array(
				'margin-top'          => '0px',
				'margin-right'        => '10px',
				'margin-bottom'       => '0px',
				'margin-left'         => '10px',
				'border-top-width'    => '0px',
				'border-right-width'  => '0px',
				'border-bottom-width' => '0px',
				'border-left-width'   => '0px',
				'padding-top'         => '0px',
				'padding-right'       => '0px',
				'padding-bottom'      => '0px',
				'padding-left'        => '0px',
			),
			'output'      => array(
				array(
					'element' => '.et_b_header-contacts.et_element-top-level .contact',
				),
			),
			'transport' => 'postMessage',
	        'js_vars'   => box_model_output('.et_b_header-contacts.et_element-top-level .contact')
		) );

		// contact_border
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'contact_border_et-desktop',
			'label'       => $strings['label']['border_style'],
			'section'     => 'contacts',
			'default'     => 'solid',
			'choices'     => $choices['border_style'],
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-contacts.et_element-top-level .contact',
					'property' => 'border-style',
				),
			),
		) );

		// contact_border_color_custom
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'color',
			'settings'    => 'contact_border_color_custom_et-desktop',
			'label'       => $strings['label']['border_color'],
			'description' => $strings['description']['border_color'],
			'section'     => 'contacts',
			'default' 	  => '#e1e1e1',
			'choices' 	  => array (
				'alpha' => true
			),
			'transport' => 'auto',
			'output'      => array(
				array(
					'element' => '.et_b_header-contacts.et_element-top-level .contact',
					'property' => 'border-color',
				),
			),
		) );
?>