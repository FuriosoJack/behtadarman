<?php 
	/**
	 * The template created for displaying header presets
	 *
	 * @version 1.0.1
	 * @since 1.4.0
	 */

	// section header_presets
	Kirki::add_section( 'header_presets', array(
	    'title'          => esc_html__( 'Header templates', 'xstore-core' ),
	    'panel'          => 'header-builder',
	    'icon' => 'dashicons-schedule'
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'header_presets_select_content_separator',
			'section'     => 'header_presets',
			'default'     => '<div style="display: flex;justify-content: center;align-items: center;padding: 7px 15px;margin: 0 -15px;text-align: center;font-size: 12px;line-height: 1;text-transform: uppercase;letter-spacing: 1px;background-color: rgba(11, 159, 18, 0.7);color: #fff;"><span class="dashicons dashicons-schedule"></span> <span style="padding-left: 3px;">' . esc_html__( 'Prebuild headers', 'xstore-core' ) . '</span></div>',
			'priority'    => 10,
		) );

		// header_presets_select
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'select',
			'settings'    => 'header_presets_select',
			'label'       => esc_html__( 'Ready to go headers', 'xstore-core' ),
			'description' => esc_html__('Choose the header that is most suitable for your site.', 'xstore-core') . ' <a style="color: #222;" href="https://xstore.8theme.com/preview-new/" target="_blank">' . esc_html__('Preview demos', 'xstore-core') . '</a>',
			'section'     => 'header_presets',
			'default'     => '',
			'priority'    => 10,
			'multiple'    => false,
			'choices'     => $header_presets
		) );

		// content separator
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'header_presets_content_separator',
			'section'     => 'header_presets',
			'default'     => $separators['content'],
			'priority'    => 10,
		) );

		// header_presets_package
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'header_presets_package_et-desktop',
			'label'       => false,
			'section'     => 'header_presets',
			'default'     => 'type1',
			'priority'    => 10,
			'choices'     => array(
				'default1'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-1.svg',
				'default2'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-2.svg',
				'default3'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-3.svg',
				'default4'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-4.svg',
				'default5'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-5.svg',
				'default6'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-6.svg',
				'default7'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-7.svg',
				'default8'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-8.svg',
				'default9'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-9.svg',
				'default10'  => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-10.svg',
			),
		));

		// header_presets_package
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'radio-image',
			'settings'    => 'header_presets_package_et-mobile',
			'label'       => false,
			'section'     => 'header_presets',
			'default'     => 'type1',
			'priority'    => 10,
			'choices'     => array(
				'default1-mob'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-mob-1.svg',
				'default2-mob'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-mob-2.svg',
				'default3-mob'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-mob-3.svg',
				'default4-mob'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-mob-4.svg',
				'default5-mob'   => ETHEME_CODE_CUSTOMIZER_IMAGES . '/header/presets/Preset-mob-5.svg',
			),
		));

		// Import/Export
		Kirki::add_field( 'et_kirki_options', array(
			'type'        => 'custom',
			'settings'    => 'header_import_export',
			'section'     => 'header_presets',
			'label'       => '',
			'default'     => '
				</label>
				<div class="et_header-import-export">
					<div class="et_header-export">
						<span class="customize-control-title">' . esc_html__( 'Export', 'xstore-core' )  .'</span>
						<span class="description customize-control-description">'.esc_html__('When you click the button below json file will be created for you to save to your computer. This format will contain your header layout and elements.', 'xstore-core').'<br>'.esc_html__('Once you\'ve saved the download file, you can use the Import function in another XStore installation to import the header from this site.', 'xstore-core').'</span>
						<span><span class="button et_header-export-btn">' . esc_html__( 'Export File', 'xstore-core' )  .'</span></span>
						<a id="et_download-export-file" style="display:none"></a>
					</div><br/>
					<div class="et_header-import">
						<span class="customize-control-title">' . esc_html__( 'Import', 'xstore-core' )  .'</span>
						<div class="et_file-zone">
							<input type="file" id="et_import-file" accept=".json">
						</div>
						<span class="et_header-import-btn hidden"><br/><span class="button">' . esc_html__( 'Import', 'xstore-core' )  .'</span></span>
						<span class="et_import-error hidden" data-type="filetype">' . esc_html__( 'Wrong filetype', 'xstore-core' )  .'</span>
						<span class="et_import-error hidden" data-type="filedata">' . esc_html__( 'Wrong filedata', 'xstore-core' )  .'</span>
					</div>
				</div>
			',
			'priority'    => 10,
		) );
?>