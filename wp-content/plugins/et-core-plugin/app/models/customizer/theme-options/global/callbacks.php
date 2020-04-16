<?php 
	/**
	 * The template created for elements callbacks theme options and templates
	 *
	 * @version 1.0.1
	 * @since 1.5.4
	 * last changes in 1.5.5
	 */

	/**
	 * Return header content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @param {string} top, main, bottom header part
	 * @param {boolean} mobile on desktop header part
	 * @return  {html} html of header part content
	 */
	function header_content_callback($part, $mobile_part = false) {
		global $et_builder_globals, $wp_customize;

		$et_builder_globals['is_customize_preview'] = is_customize_preview();
		$et_builder_globals['in_mobile_menu'] = false;

		switch ($part) {
			case 'top':
				$part_data = ( $mobile_part ) ? json_decode( Kirki::get_option( 'header_mobile_top_elements' ), true ) : json_decode( Kirki::get_option( 'header_top_elements' ), true );
			break;
			case 'main':
				$part_data = ( $mobile_part ) ? json_decode( Kirki::get_option( 'header_mobile_main_elements' ), true ) : json_decode( Kirki::get_option( 'header_main_elements' ), true );
			break;
			case 'bottom':
				$part_data = ( $mobile_part ) ? json_decode( Kirki::get_option( 'header_mobile_bottom_elements' ), true ) : json_decode( Kirki::get_option( 'header_bottom_elements' ), true );
			break;
		}

		if ( ! is_array( $part_data ) ) {
			$part_data = array();
		}

	    uasort( $part_data, function ( $item1, $item2 ) {
		    return $item1['index'] <=> $item2['index'];
		});

		$et_promo_text_hidden = false;

		if ( Kirki::get_option( 'promo_text_close_button_action_et-desktop' ) && isset($_COOKIE['et_promo_text_shows']) && $_COOKIE['et_promo_text_shows'] == 'false') {
			$et_promo_text_hidden = true;
		}

		$mobile_filters = array(
			'etheme_mini_cart_content_type' => 'etheme_mini_cart_content_mobile',
			'etheme_mini_cart_content_position' => 'etheme_mini_cart_content_position_mobile',
			'etheme_mini_account_content_type' => 'etheme_mini_account_content_mobile',
			'etheme_mini_account_content_position' => 'etheme_mini_account_content_position_mobile',
			'etheme_mini_wishlist_content_type' => 'etheme_mini_wishlist_content_mobile',
			'etheme_mini_wishlist_content_position' => 'etheme_mini_wishlist_content_position_mobile',
		);

		ob_start();

		if ( $et_builder_globals['is_customize_preview'] ) 
			add_filter('is_customize_preview', 'etheme_return_true');

		if ( $mobile_part ) {
	        foreach ($mobile_filters as $key => $value) {
	            add_filter($key, $value, 15);
	        }
		}

		foreach ( $part_data as $key => $value ) : 

			if ( $et_promo_text_hidden && count($part_data)  == 1 && $value['element'] == 'promo_text' ) continue; ?>
			
			<?php 

				if ( $value['element'] == 'connect_block' ) {
					$blockID = $key;
					if ( $mobile_part ) 
						add_filter( 'connect_block_package', function(){ return 'connect_block_mobile_package'; } );
					add_filter( 'et_connect_block_id', function($id) use ($blockID){ return $blockID; } );
				}

			 ?>

			<?php 
				$col_class = array();
				$col_class[] = 'et_col-xs-' . $value['size'];
				$col_class[] = 'et_col-xs-offset-' . $value['offset'];
				if ( $mobile_part && (in_array($value['element'], array('main_menu', 'secondary_menu', 'mobile_menu', 'search'))) ) 
					$col_class[] = 'pos-static';
				elseif ( in_array($value['element'], array('main_menu', 'secondary_menu', 'mobile_menu')) )
					$col_class[] = 'pos-static';
			?>

			<div class="et_column <?php echo esc_attr(implode($col_class, ' ')); ?>">
				<?php require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/' . $value['element'] . '.php' ); ?>
			</div>
		<?php endforeach;

		if ( $et_builder_globals['is_customize_preview'] ) { 
			// for toggle action on menu items ?>
			<script type="text/javascript">
				jQuery(document).ready(function($){

					<?php if ( count($part_data) < 1 ) : ?>
						$('.<?php echo ( $mobile_part ) ? 'mobile-' : ''; ?>header-wrapper .header-<?php echo esc_js($part); ?>-wrapper').addClass('none'); 
					<?php else : ?> 
						$('.<?php echo ( $mobile_part ) ? 'mobile-' : ''; ?>header-wrapper .header-<?php echo esc_js($part); ?>-wrapper').removeClass('none');
					<?php endif; ?>

					etTheme.swiperFunc();
					etCoreScript.fixedHeader();
					etCoreScript.etPromoTextCarousel();

				});
			</script>
		<?php }

		if ( $mobile_part ) {
	        foreach ($mobile_filters as $key => $value) {
	            remove_filter($key, $value, 15);
	        }
		}

		if ( $et_builder_globals['is_customize_preview'] )
			remove_filter('is_customize_preview', 'etheme_return_true');

		$html = ob_get_clean();

		return $html;
	}

	/**
	 * Return header top content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of header-top part content
	 */
	function header_top_callback() {
		return header_content_callback('top');
	}

	/**
	 * Return header main content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of header-main part content
	 */
	function header_main_callback() {
		return header_content_callback('main');
	}

	/**
	 * Return header bottom content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of header-bottom part content
	 */
	function header_bottom_callback() {
		return header_content_callback('bottom');
	}

	/**
	 * Return mobile header top content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of mobile-header-top part content
	 */
	function mobile_header_top_callback() {
		return header_content_callback('top', true);
	}

	/**
	 * Return mobile header main content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of mobile-header-main part content
	 */
	function mobile_header_main_callback() {
		return header_content_callback('main', true);
	}

	/**
	 * Return mobile header bottom content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of mobile-header-bottom part content
	 */
	function mobile_header_bottom_callback() {
		return header_content_callback('bottom', true);
	}

	/**
	 * Return header content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of header part content
	 */
	function header_callback() {
		etheme_header_top();
		etheme_header_main();
		etheme_header_bottom();
	}

	/**
	 * Return mobile header content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of mobile header part content
	 */
	function mobile_header_callback() {
		etheme_mobile_header_top();
		etheme_mobile_header_main();
		etheme_mobile_header_bottom();
	}

    /**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} header socials content
     */

	function header_socials_callback() {
		global $et_social_icons;
		
		$element_options = array();
		$element_options['header_socials_type_et-desktop'] = Kirki::get_option( 'header_socials_type_et-desktop' );
		$element_options['header_socials_direction_et-desktop'] = Kirki::get_option( 'header_socials_direction_et-desktop' );
		$element_options['header_socials_direction_et-desktop'] = apply_filters('header_socials_direction', $element_options['header_socials_direction_et-desktop']);

		$element_options['header_socials_package_et-desktop'] = Kirki::get_option( 'header_socials_package_et-desktop' );
		$element_options['header_socials_target_et-desktop'] = Kirki::get_option( 'header_socials_target_et-desktop' ) ? 'target="_blank"' : '';
		$element_options['header_socials_no_follow_et-desktop'] = Kirki::get_option( 'header_socials_no_follow_et-desktop' ) ? 'rel="nofollow"' : '';

		ob_start();
		foreach ($element_options['header_socials_package_et-desktop'] as $key ) { ?>
			<a href="<?php echo $key['social_url'] ?>" <?php echo $element_options['header_socials_target_et-desktop']; ?> <?php echo $element_options['header_socials_no_follow_et-desktop']; ?> data-tooltip="<?php echo $key['social_name']; ?>">
				<?php
					if ( $key['social_icon'] != '' && isset( $key['social_icon'] ) && isset( $et_social_icons[$element_options['header_socials_type_et-desktop']][$key['social_icon']] ) ) echo $et_social_icons[$element_options['header_socials_type_et-desktop']][$key['social_icon']]; 
					else echo $et_social_icons[$element_options['header_socials_type_et-desktop']]['et_icon-facebook'];
				?>
			</a>
		<?php }
		$html = ob_get_clean();
		return $html;
	}

    /**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} header vertical content
     */
	function header_vertical_callback() {

		$header_vertical_options = array();

		$header_vertical_options['header_vertical_menu_type_et-desktop'] = Kirki::get_option( 'header_vertical_menu_type_et-desktop' );
		$header_vertical_options['header_vertical_section1_content'] = Kirki::get_option('header_vertical_section1_content');
		$header_vertical_options['header_vertical_section1_content'] = !is_array($header_vertical_options['header_vertical_section1_content']) ? array() : $header_vertical_options['header_vertical_section1_content'];

		$header_vertical_options['header_vertical_section2_content'] = Kirki::get_option('header_vertical_section2_content');
		$header_vertical_options['header_vertical_section2_content'] = !is_array($header_vertical_options['header_vertical_section2_content']) ? array() : $header_vertical_options['header_vertical_section2_content'];

		$header_vertical_options['header_vertical_section3_content'] = Kirki::get_option('header_vertical_section3_content');
		$header_vertical_options['header_vertical_section3_content'] = !is_array($header_vertical_options['header_vertical_section3_content']) ? array() : $header_vertical_options['header_vertical_section3_content'];

		if ( !Kirki::get_option('bold_icons') ) { 
			$header_vertical_options['menu_icon'] = array(
				'to_open' => '<span class="et_b-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0.792 5.904h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744zM23.208 11.256h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744zM23.208 18.096h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744z"></path></svg></span>',
				'to_close' => '<span class="et_b-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" style="padding: .25em;"><path d="M13.536 12l10.128-10.104c0.216-0.216 0.312-0.48 0.312-0.792 0-0.288-0.12-0.552-0.312-0.768l-0.024-0.024c-0.12-0.12-0.408-0.288-0.744-0.288-0.312 0-0.6 0.12-0.768 0.312l-10.128 10.128-10.104-10.128c-0.408-0.408-1.104-0.432-1.512 0-0.216 0.192-0.336 0.48-0.336 0.768 0 0.312 0.12 0.576 0.312 0.792l10.104 10.104-10.128 10.104c-0.216 0.216-0.312 0.48-0.312 0.792 0 0.288 0.096 0.552 0.312 0.768 0.192 0.192 0.48 0.312 0.768 0.312s0.552-0.12 0.768-0.312l10.128-10.128 10.104 10.104c0.192 0.192 0.48 0.312 0.768 0.312s0.552-0.12 0.768-0.312c0.192-0.192 0.312-0.48 0.312-0.768s-0.12-0.552-0.312-0.768l-10.104-10.104z"></path></svg></span>');
		}
		else {
			$header_vertical_options['menu_icon'] = array(
				'to_open' => '<span class="et_b-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0.792 5.904h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744zM23.208 11.256h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744zM23.208 18.096h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744z"></path></svg></span>',
				'to_close' => '<span class="et_b-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" style="padding: .25em;"><path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path></svg></span>');
		}

		$header_vertical_options['etheme_filters'] = array(
			'etheme_logo_sticky' => 'etheme_return_false',
			'logo_img' => 'etheme_vertical_header_logo',
			'logo_align' => 'etheme_return_align_inherit',
			'menu_item_design' => 'etheme_menu_item_design_dropdown',
			'etheme_mini_content' => 'etheme_return_false',
			'etheme_search_results' => 'etheme_return_false',
			'search_category' => 'etheme_return_false',
			'cart_off_canvas' => 'etheme_return_false',
			'etheme_mini_cart_content' => 'etheme_return_false',
			'etheme_mini_account_content' => 'etheme_return_false',
			'account_off_canvas' => 'etheme_return_false',
			'etheme_mini_wishlist_content' => 'etheme_return_false',
			'wishlist_off_canvas' => 'etheme_return_false',
			'cart_content_alignment' => 'etheme_return_align_inherit',
			'wishlist_content_alignment' => 'etheme_return_align_inherit',
			'account_content_alignment' => 'etheme_return_align_inherit',
			'header_socials_content_alignment' => 'etheme_return_align_inherit',
			'header_button_content_align' => 'etheme_return_align_inherit',
			// 'et_mobile_menu' => 'etheme_return_true',
			// 'etheme_use_desktop_style' => 'etheme_return_true',
			// 'search_type' => 'etheme_mobile_type_input',
			// 'search_by_icon' => 'etheme_return_false',
			// 'cart_style' => 'etheme_mobile_content_element_type1',
			// 'account_style' => 'etheme_mobile_content_element_type1',
			// 'contacts_icon_position' => 'etheme_mobile_icon_left'
		);

		foreach ($header_vertical_options['etheme_filters'] as $key => $value) {
			add_filter($key, $value, 15);
		}

		$header_vertical_options['header_vertical_menu_term'] = Kirki::get_option('header_vertical_menu_term');
		$header_vertical_options['header_vertical_menu_term_name'] = ($header_vertical_options['header_vertical_menu_term'] == '') ? 'main-menu' : $header_vertical_options['header_vertical_menu_term'];

	    $header_vertical_options['sections'] = array(
	    	'start' => '1',
	    	'center' => '2',
	    	'end' => '3'
	    );

		ob_start();
		foreach ($header_vertical_options['sections'] as $key => $value) { ?>
		<div class="header-vertical-section flex flex-wrap full-width-children align-content-<?php echo $key; ?> align-items-<?php echo $key; ?>">
			<?php foreach ($header_vertical_options['header_vertical_section'.$value.'_content'] as $key => $value) {
				switch ($value) {
					case 'menu':
						$args = array(
					        'menu' => $header_vertical_options['header_vertical_menu_term_name'],
					        'before' => '',
					        'container_class' => 'menu-main-container flex-col-child',
					        'after' => '',
					        'link_before' => '',
					        'link_after' => '',
					        'depth' => 5,
					        'echo' => false,
					        'fallback_cb' => false,
					        'walker' => new ETheme_Navigation
					    ); 

						if ( wp_nav_menu( $args ) != '' ) { 

							if ( $header_vertical_options['header_vertical_menu_type_et-desktop'] == 'icon') { ?>
								<div class="et_element et-content_toggle header-vertical-menu-icon-wrapper et_element-top-level static justify-content-inherit" data-title="<?php esc_html_e( 'Header vertical menu', 'xstore-core' ); ?>">
									<span class="et-toggle pos-relative inline-block">
										<?php echo $header_vertical_options['menu_icon']['to_open'] . $header_vertical_options['menu_icon']['to_close']; ?>
									</span>
									<div class="et-mini-content justify-content-inherit">
										<div class="et_element et_b_header-menu header-vertical-menu flex align-items-center" data-title="<?php esc_html_e( 'Header vertical menu', 'xstore-core' ); ?>">
											<?php echo wp_nav_menu($args); ?>
										</div>
									</div>
								</div>
							<?php } 
							else { ?> 
								<div class="et_element et_b_header-menu et_element-top-level header-vertical-menu flex align-items-center" data-title="<?php esc_html_e( 'Header vertical menu', 'xstore-core' ); ?>">
									<?php echo wp_nav_menu($args); ?>
								</div>
							<?php } 
						}
						else {
							esc_html_e( 'Vertical header menu', 'xstore-core' ); ?> <span class="mtips" style="width: 1em; height: 1em; font-size: 1em; text-transform: none;"><span style="width: .9em; height: .9em; font-size: .9em; vertical-align: -15%;" class="dashicons dashicons-warning"></span><span class="mt-mes"><?php esc_html_e('To use Header vertical menu please select your menu in dropdown', 'xstore-core'); ?></span></span><?php 
						}
						break;
					default:
						require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/'.$value.'.php' );
						break;
				}
			} ?>
			</div>
		<?php } ?>

		<?php foreach ($header_vertical_options['etheme_filters'] as $key => $value) {
			remove_filter($key, $value, 15);
		}

		$html = ob_get_clean();
		return $html; 
	}

    /**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} main menu content
     */
	function main_menu_callback() {

		if ( !class_exists('ETheme_Navigation') ) return;

		global $et_builder_globals;

		$element_options = array();
		$element_options['main_menu_term'] = Kirki::get_option('main_menu_term');
		$element_options['main_menu_term_name'] = $element_options['main_menu_term'] == '' ? 'main-menu' : $element_options['main_menu_term'];
		$element_options['one_page_menu'] = ( Kirki::get_option('menu_one_page') ) ? ' one-page-menu' : '';
		$element_options['menu_link_after'] = ( Kirki::get_option('menu_item_style_et-desktop') == 'dots' || $et_builder_globals['is_customize_preview']) ? '<span class="et_b_header-menu-sep align-self-center"></span>' : '';

		$args = array(
	        'menu' => $element_options['main_menu_term_name'],
	        'before' => '',
	        'container_class' => 'menu-main-container' . $element_options['one_page_menu'],
	        'after' => $element_options['menu_link_after'],
	        'link_before' => '',
	        'link_after' => '',
	        'depth' => 100,
	        'echo' => false,
	        'fallback_cb' => false,
	        'walker' => new ETheme_Navigation
	    );

    	$element_options['menu_arrows'] = Kirki::get_option('menu_arrows');

		if ( $element_options['menu_arrows'] || $et_builder_globals['is_customize_preview'] )
			add_filter('menu_item_with_svg_arrow', 'etheme_return_true');

		if ( !$element_options['menu_arrows'] && $et_builder_globals['is_customize_preview'] )
			add_filter('menu_item_with_svg_arrow_class', 'etheme_return_none');

	    ob_start();

		if ( wp_nav_menu( $args ) != '' ) {
			echo wp_nav_menu($args);
		}
		else { ?> 
			<span class="flex-inline justify-content-center align-items-center flex-nowrap">
	            <?php esc_html_e( 'Main menu ', 'xstore-core' ); ?> 
	            <span class="mtips" style="text-transform: none;">
	                <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
	                <span class="mt-mes"><?php esc_html_e('To use Main menu, please, set up the main menu in the dashboard -> appearence -> menus', 'xstore-core'); ?></span>
	            </span>
	        </span>
		<?php } 

		if ( $element_options['menu_arrows'] || $et_builder_globals['is_customize_preview'] )
			remove_filter('menu_item_with_svg_arrow', 'etheme_return_true');

		if ( !$element_options['menu_arrows'] && $et_builder_globals['is_customize_preview'] )
			add_filter('menu_item_with_svg_arrow_class', 'etheme_return_none');

		unset($element_options);
		$html = ob_get_clean();
		return $html; 
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} main menu2 content
     */
	function main_menu2_callback() {

		if ( !class_exists('ETheme_Navigation') ) return;

		global $et_builder_globals;

		$element_options = array();
		$element_options['main_menu_2_term'] = Kirki::get_option('main_menu_2_term');
		$element_options['main_menu_2_term_name'] = $element_options['main_menu_2_term'] == '' ? 'main-menu' : $element_options['main_menu_2_term'];
		$element_options['one_page_menu'] = ( Kirki::get_option('menu_2_one_page') ) ? ' one-page-menu' : '';
		$element_options['menu_link_after'] = ( Kirki::get_option('menu_2_item_style_et-desktop') == 'dots' || $et_builder_globals['is_customize_preview']) ? '<span class="et_b_header-menu-sep align-self-center"></span>' : '';

		$args = array(
	        'menu' => $element_options['main_menu_2_term_name'],
	        'before' => '',
	        'container_class' => 'menu-main-container' . $element_options['one_page_menu'],
	        'after' => $element_options['menu_link_after'],
	        'link_before' => '',
	        'link_after' => '',
	        'depth' => 100,
	        'echo' => false,
	        'fallback_cb' => false,
	        'walker' => new ETheme_Navigation
	    );

		$element_options['menu_arrows'] = Kirki::get_option('menu_2_arrows');

		if ( $element_options['menu_arrows'] || $et_builder_globals['is_customize_preview'] )
			add_filter('menu_item_with_svg_arrow', 'etheme_return_true');

		if ( !$element_options['menu_arrows'] && $et_builder_globals['is_customize_preview'] )
			add_filter('menu_item_with_svg_arrow_class', 'etheme_return_none');

	    ob_start();

		if ( wp_nav_menu( $args ) != '' ) {
			echo wp_nav_menu($args);
		}
		else { ?> 
			<span class="flex-inline justify-content-center align-items-center flex-nowrap">
	            <?php esc_html_e( 'Secondary menu ', 'xstore-core' ); ?> 
	            <span class="mtips" style="text-transform: none;">
	                <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
	                <span class="mt-mes"><?php esc_html_e('To use Secondary menu, please, set up the main menu in the dashboard -> appearence -> menus', 'xstore-core'); ?></span>
	            </span>
	        </span>
		<?php } 

		if ( $element_options['menu_arrows'] || $et_builder_globals['is_customize_preview'] )
			remove_filter('menu_item_with_svg_arrow', 'etheme_return_true');

		if ( !$element_options['menu_arrows'] && $et_builder_globals['is_customize_preview'] )
			add_filter('menu_item_with_svg_arrow_class', 'etheme_return_none');
		
		unset($element_options);
		$html = ob_get_clean();
		return $html; 
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} all departments content
     */
	function all_departments_menu_callback() {

		if ( !class_exists('ETheme_Navigation') ) return;

		$element_options = array();
	    $element_options['secondary_menu_term'] = Kirki::get_option('secondary_menu_term');
    	$element_options['secondary_menu_term_name'] = $element_options['secondary_menu_term'] == '' ? 'main-menu' : $element_options['secondary_menu_term'];

    	add_filter('menu_item_with_svg_arrow', 'etheme_return_false');
		
		$args = array(
	        'menu' => $element_options['secondary_menu_term_name'],
	        'before' => '',
	        'container_class' => 'menu-main-container',
	        'after' => '',
	        'link_before' => '',
	        'link_after' => '',
	        'depth' => 100,
	        'echo' => false,
	        'fallback_cb' => false,
	        'walker' => new ETheme_Navigation
	    );

	    ob_start();

	    if ( wp_nav_menu( $args ) != '' ) { ?>
	        <div class="secondary-menu-wrapper">
	            <div class="secondary-title">
	                <div class="secondary-menu-toggle">
	                    <span class="et-icon et-burger"></span>
	                </div>
	                <span><?php etheme_option('all_departments_text'); ?></span>
	            </div>
	            <?php echo wp_nav_menu($args); ?>
	        </div>
	    <?php }
	    else {
	        ?> <span style="white-space: nowrap;"><?php esc_html_e( 'All departments menu', 'xstore-core' ); ?></span><span class="mtips" style="width: 1em; height: 1em; font-size: 1em; text-transform: none;"><span style="width: .9em; height: .9em; font-size: .9em; vertical-align: -15%;" class="dashicons dashicons-warning"></span><span class="mt-mes"><?php esc_html_e('To use All departments menu, please, set up the main menu in the dashboard -> appearence -> menus', 'xstore-core'); ?></span></span>
	    <?php } 

	    remove_filter('menu_item_with_svg_arrow', 'etheme_return_false');

		unset($element_options);
		$html = ob_get_clean();
		return $html; 
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.2
     * last changes in 2.0.0
     * @see /templates/header/parts/mobile-menu
     * @return {html} mobile menu content
     */
	function mobile_menu_callback() { 

		global $et_builder_globals;

		$mob_menu_element_options = array();

		$mob_menu_element_options['mobile_menu_type_et-desktop'] = Kirki::get_option( 'mobile_menu_type_et-desktop' );
		// $mob_menu_element_options['mobile_menu_content'] = Kirki::get_option( 'mobile_menu_content' );
		$mob_menu_element_options['mobile_menu_content_position'] = ( $mob_menu_element_options['mobile_menu_type_et-desktop'] == 'off_canvas_left' ) ? 'left' : 'right';
		$mob_menu_element_options['mobile_menu_content_alignment'] = ' justify-content-'.Kirki::get_option( 'mobile_menu_content_alignment_et-desktop' );
		$mob_menu_element_options['mobile_menu_content_alignment'] .= ' mob-justify-content-'.Kirki::get_option( 'mobile_menu_content_alignment_et-mobile' );

		$mob_menu_element_options['icon_type_et-desktop'] = Kirki::get_option( 'mobile_menu_icon_et-desktop' );

		if ( !Kirki::get_option('bold_icons') ) { 
			$mob_menu_element_options['mobile_menu_icons_et-desktop'] = array (
				'icon1' => '<span class="et_b-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0.792 5.904h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744zM23.208 11.256h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744zM23.208 18.096h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744z"></path></svg></span>',
				'icon2' => '<span class="et_b-icon"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="1em" height="1em" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><g><path d="M26,37h47.7c1.7,0,3.3-1.3,3.3-3.3s-1.3-3.3-3.3-3.3H26c-1.7,0-3.3,1.3-3.3,3.3S24.3,37,26,37z"/><path d="M74,46.7H26c-1.7,0-3.3,1.3-3.3,3.3s1.3,3.3,3.3,3.3h47.7c1.7,0,3.3-1.3,3.3-3.3S75.7,46.7,74,46.7z"/><path d="M74,63H26c-1.7,0-3.3,1.3-3.3,3.3s1.3,3.3,3.3,3.3h47.7c1.7,0,3.3-1.3,3.3-3.3S75.7,63,74,63z"/></g><path d="M50,0C22.3,0,0,22.3,0,50s22.3,50,50,50s50-22.3,50-50S77.7,0,50,0z M50,93.7C26,93.7,6.3,74,6.3,50S26,6.3,50,6.3S93.7,26,93.7,50S74,93.7,50,93.7z"/></svg></span>',
				'none' => ($et_builder_globals['is_customize_preview']) ? '<span class="et_b-icon none"></span>' : ''
			);
		}
		else {
			$mob_menu_element_options['mobile_menu_icons_et-desktop'] = array (
				'icon1' => '<span class="et_b-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0.792 5.904h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744zM23.208 11.256h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744zM23.208 18.096h-22.416c-0.408 0-0.744 0.336-0.744 0.744s0.336 0.744 0.744 0.744h22.416c0.408 0 0.744-0.336 0.744-0.744s-0.336-0.744-0.744-0.744z"></path></svg></span>',
				'icon2' => '<span class="et_b-icon"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="1em" height="1em"viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><g><path d="M73.2,29.7H26.5c-2,0-4.2,1.6-4.2,4.2c0,2.6,2.2,4.2,4.2,4.2h46.7c2,0,4.2-1.6,4.2-4.2C77.5,31.5,75.7,29.7,73.2,29.7z"/><path d="M73.5,45.8H26.5c-2,0-4.2,1.6-4.2,4.2c0,2.5,1.7,4.2,4.2,4.2h46.7c2,0,4.2-1.6,4.2-4.2C77.5,47.6,75.8,45.8,73.5,45.8z"/><path d="M73.5,61.8H26.5c-2,0-4.2,1.6-4.2,4.2c0,2.5,1.7,4.2,4.2,4.2h46.7c2,0,4.2-1.6,4.2-4.2C77.5,63.6,75.8,61.8,73.5,61.8z"/><path d="M50,0C22.4,0,0,22.4,0,50c0,27.6,22.4,50,50,50c27.6,0,50-22.4,50-50C100,22.4,77.6,0,50,0z M50,91.8C26.9,91.8,8.2,73.1,8.2,50S26.9,8.2,50,8.2S91.8,26.9,91.8,50S73.1,91.8,50,91.8z"/></g></svg></span>',
				'none' => ($et_builder_globals['is_customize_preview']) ? '<span class="et_b-icon none"></span>' : ''
			);
		}

		$mob_menu_element_options['mobile_menu_icon_et-desktop']['custom'] = Kirki::get_option( 'mobile_menu_icon_custom_et-desktop' );

		$mob_menu_element_options['mobile_menu_icon_et-desktop'] = $mob_menu_element_options['mobile_menu_icons_et-desktop'][$mob_menu_element_options['icon_type_et-desktop']];

		$mob_menu_element_options['mobile_menu_label_et-desktop'] = Kirki::get_option( 'mobile_menu_label_et-desktop' );
		$mob_menu_element_options['mobile_menu_label_text_et-desktop'] = Kirki::get_option( 'mobile_menu_text' );

		// $mob_menu_element_options['mobile_menu_logo_type'] = Kirki::get_option( 'mobile_menu_logo_type_et-desktop' );
		// $mob_menu_element_options['mobile_menu_logo_filter'] = ( $mob_menu_element_options['mobile_menu_logo_type'] == 'sticky' ) ? 'simple' : 'sticky';

		// $mob_menu_element_options['mobile_menu_2'] = ( Kirki::get_option( 'mobile_menu_2' ) != 'none' ) ? true : false;

		$mob_menu_element_options['mobile_menu_classes'] = ' static';
		$mob_menu_element_options['mobile_menu_classes'] .= ( $mob_menu_element_options['mobile_menu_type_et-desktop'] != 'popup' ) ? ' et-content_toggle et-off-canvas et-content-' . $mob_menu_element_options['mobile_menu_content_position'] : ' ';
		$mob_menu_element_options['mobile_menu_classes'] .= ' toggles-by-arrow';

		ob_start(); ?>

		<span class="et-element-label-wrapper flex <?php echo $mob_menu_element_options['mobile_menu_content_alignment']; ?>">
			<span class="flex-inline align-items-center et-element-label pointer et-<?php echo ( $mob_menu_element_options['mobile_menu_type_et-desktop'] != 'popup' ) ? '' : 'popup_'; ?>toggle valign-center" <?php echo ( $mob_menu_element_options['mobile_menu_type_et-desktop'] == 'popup' || $et_builder_globals['is_customize_preview'] ) ? 'data-type="mobile_menu"' : ''; ?>>
				<?php echo $mob_menu_element_options['mobile_menu_icon_et-desktop']; ?>
				<?php if ( $mob_menu_element_options['mobile_menu_label_et-desktop'] || $et_builder_globals['is_customize_preview'] ) { ?>
					<span class="<?php echo ($et_builder_globals['is_customize_preview'] && !$mob_menu_element_options['mobile_menu_label_et-desktop'] ) ? 'none' : ''; ?>">
						<?php echo $mob_menu_element_options['mobile_menu_label_text_et-desktop']; ?>
					</span>
				<?php } ?>
			</span>
		</span>
		<?php if ( $mob_menu_element_options['mobile_menu_type_et-desktop'] != 'popup' ) : ?>
		<div class="et-mini-content">
			<span class="et-toggle pos-absolute et-close full-<?php echo $mob_menu_element_options['mobile_menu_content_position']; ?> top">
				<svg xmlns="http://www.w3.org/2000/svg" width="0.8em" height="0.8em" viewBox="0 0 24 24">
					<path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
				</svg>
			</span>

			<div class="et-content mobile-menu-content children-align-inherit">
				<?php echo mobile_menu_content_callback(); ?>
			</div>
		</div>
		<?php endif; 
	
		$html = ob_get_clean();

		return $html; 
	}

	/**
     *
     * @since   1.5.5
     * @version 1.0.0
     * @see /templates/header/parts/mobile-menu
     * @return {html} mobile menu content element 
     */
	function mobile_menu_content_callback() {

		global $et_builder_globals;

		$et_builder_globals['in_mobile_menu'] = true;

		$mob_menu_element_options = array();

		$mob_menu_element_options['mobile_menu_logo_type'] = Kirki::get_option( 'mobile_menu_logo_type_et-desktop' );
		$mob_menu_element_options['mobile_menu_logo_filter'] = ( $mob_menu_element_options['mobile_menu_logo_type'] == 'sticky' ) ? 'simple' : 'sticky';

		$mob_menu_element_options['mobile_menu_type_et-desktop'] = Kirki::get_option( 'mobile_menu_type_et-desktop' );
		$mob_menu_element_options['mobile_menu_content'] = Kirki::get_option( 'mobile_menu_content' );
		$mob_menu_element_options['etheme_filters'] = array(
			"etheme_logo_{$mob_menu_element_options['mobile_menu_logo_filter']}" => 'etheme_return_false',
			'logo_align' => 'etheme_return_align_center',
			'etheme_mini_content' => 'etheme_return_false',
			'etheme_search_results' => 'etheme_return_true',
			'search_category' => 'etheme_return_false',
			'cart_off_canvas' => 'etheme_return_false',
			'etheme_mini_cart_content' => 'etheme_return_false',
			'etheme_mini_account_content' => 'etheme_return_false',
			'account_off_canvas' => 'etheme_return_false',
			'etheme_mini_wishlist_content' => 'etheme_return_false',
			'wishlist_off_canvas' => 'etheme_return_false',
			'et_mobile_menu' => 'etheme_return_true',
			'etheme_use_desktop_style' => 'etheme_return_true',
			'search_type' => 'etheme_mobile_type_input',
			'search_by_icon' => 'etheme_return_false',
			'cart_style' => 'etheme_mobile_content_element_type1',
			'account_style' => 'etheme_mobile_content_element_type1',
			'header_socials_direction' => 'etheme_return_false',
			'contacts_icon_position' => 'etheme_mobile_icon_left',
			'etheme_output_shortcodes_inline_css' => 'etheme_return_true'
		);
		foreach ($mob_menu_element_options['etheme_filters'] as $key => $value) {
			add_filter($key, $value, 15);
		}

		$mob_menu_element_options['mobile_menu_2'] = Kirki::get_option( 'mobile_menu_2' );
		$mob_menu_element_options['mobile_menu_2_state'] = ( $mob_menu_element_options['mobile_menu_2'] != 'none' ) ? true : false;

		$mob_menu_element_options['mobile_menu_2_term'] = ( $mob_menu_element_options['mobile_menu_2'] == 'menu' ) ? Kirki::get_option('mobile_menu_2_term') : '';
		$mob_menu_element_options['mobile_menu_2_term_name'] = $mob_menu_element_options['mobile_menu_2_term'] == '' ? 'main-menu' : $mob_menu_element_options['mobile_menu_2_term'];

		$mob_menu_element_options['mobile_menu_tab_2_text'] = Kirki::get_option( 'mobile_menu_tab_2_text' );

		$mob_menu_element_options['mobile_menu_term'] = Kirki::get_option('mobile_menu_term');
		$mob_menu_element_options['mobile_menu_term_name'] = $mob_menu_element_options['mobile_menu_term'] == '' ? 'main-menu' : $mob_menu_element_options['mobile_menu_term'];
		$mob_menu_element_options['mobile_menu_one_page'] = Kirki::get_option('mobile_menu_one_page') ? ' one-page-menu' : '';
		$args = array(
	        'menu' => $mob_menu_element_options['mobile_menu_term_name'],
	        'before' => '',
	        'container_class' => 'menu-main-container' . $mob_menu_element_options['mobile_menu_one_page'],
	        'after' => '',
	        'link_before' => '',
	        'link_after' => '',
	        'depth' => 4,
	        'echo' => false,
	        'fallback_cb' => false,
	        'walker' => new ETheme_Navigation
	    );

		$mob_menu_element_options['mobile_menu_2_tabs'] = $mob_menu_element_options['mobile_menu_2_wrapper_start'] = $mob_menu_element_options['mobile_menu_2_wrapper_end']  = '';
		if ( $mob_menu_element_options['mobile_menu_2_state'] ) {
			$mob_menu_element_options['mobile_menu_2_wrapper_start'] = '<div class="et_b-tabs-wrapper">';
			$mob_menu_element_options['mobile_menu_2_wrapper_end'] = '</div>';
			ob_start(); ?>
			<div class="et_b-tabs">
				<span class="et-tab active" data-tab="menu">
					<?php esc_html_e('Menu', 'xstore-core'); ?>
				</span>
				<span class="et-tab" data-tab="menu_2">
					<?php echo esc_html($mob_menu_element_options['mobile_menu_tab_2_text']); ?>
				</span>
			</div>
		<?php 
			$mob_menu_element_options['mobile_menu_2_tabs'] = ob_get_clean();

			ob_start(); 

			if ( $mob_menu_element_options['mobile_menu_2'] == 'categories' ) {
				the_widget('WC_Widget_Product_Categories', 'title=');
			}
			else {
				$args_2 = array(
			        'menu' => $mob_menu_element_options['mobile_menu_2_term_name'],
			        'before' => '',
			        'container_class' => 'menu-main-container',
			        'after' => '',
			        'link_before' => '',
			        'link_after' => '',
			        'depth' => 4,
			        'echo' => false,
			        'fallback_cb' => false,
			        'walker' => new ETheme_Navigation
			    );

				if ( wp_nav_menu( $args_2 ) != '' ) {
						?>
					<div class="et_element et_b_header-menu header-mobile-menu flex align-items-center" data-title="<?php esc_html_e( 'Menu', 'xstore-core' ); ?>">
						<?php echo wp_nav_menu($args_2); ?>
					</div>
				<?php }
				else { ?>
					<span class="flex-inline justify-content-center align-items-center flex-nowrap">
                        <?php esc_html_e( 'Mobile menu 2', 'xstore-core' ); ?> 
                        <span class="mtips" style="text-transform: none;">
                            <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
                            <span class="mt-mes"><?php esc_html_e('To use Mobile menu 2 please select your menu in dropdown', 'xstore-core'); ?></span>
                        </span>
                    </span>
				<?php } 
			}

			$mob_menu_element_options['mobile_menu_2_content'] = ob_get_clean();

		}

		ob_start();
		foreach ($mob_menu_element_options['mobile_menu_content'] as $key => $value) {
			if ( $value == 'menu' && $mob_menu_element_options['mobile_menu_2_state'] ) {
				echo $mob_menu_element_options['mobile_menu_2_wrapper_start'];
				echo $mob_menu_element_options['mobile_menu_2_tabs'];
				?>
					<div class="et_b-tab-content active" data-tab-name="menu">
						<?php 
						if ( wp_nav_menu( $args ) != '' ) {
								?>
							<div class="et_element et_b_header-menu header-mobile-menu flex align-items-center" data-title="<?php esc_html_e( 'Menu', 'xstore-core' ); ?>">
								<?php echo wp_nav_menu($args); ?>
							</div>
						<?php }
						else { ?>
							<span class="flex-inline justify-content-center align-items-center flex-nowrap">
                                <?php esc_html_e( 'Mobile menu ', 'xstore-core' ); ?> 
                                <span class="mtips" style="text-transform: none;">
                                    <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
                                    <span class="mt-mes"><?php esc_html_e('To use Mobile menu please select your menu in dropdown', 'xstore-core'); ?></span>
                                </span>
                            </span>
						<?php } ?>
					</div>
					<div class="et_b-tab-content" data-tab-name="menu_2">
						<?php 
							echo $mob_menu_element_options['mobile_menu_2_content'];
						?> 
					</div>
				<?php
				echo $mob_menu_element_options['mobile_menu_2_wrapper_end'];
			}
			else {
				if ( $value == 'menu' ) {
					if ( wp_nav_menu( $args ) != '' ) {
								?>
						<div class="et_element et_b_header-menu header-mobile-menu flex align-items-center" data-title="<?php esc_html_e( 'Menu', 'xstore-core' ); ?>">
							<?php echo wp_nav_menu($args); ?>
						</div>
					<?php }
					else { ?>
						<span class="flex-inline justify-content-center align-items-center flex-nowrap">
                            <?php esc_html_e( 'Mobile menu ', 'xstore-core' ); ?> 
                            <span class="mtips" style="text-transform: none;">
                                <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
                                <span class="mt-mes"><?php esc_html_e('To use Mobile menu please select your menu in dropdown', 'xstore-core'); ?></span>
                            </span>
                        </span>
					<?php }
				}
				else {
					require( ET_CORE_DIR . 'app/models/customizer/templates/header/parts/'.$value.'.php' );
				}
			}
		}

		if ( $et_builder_globals['is_customize_preview'] ) { 
			// for toggle action on menu items ?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					etCoreScript.mobileMenu();
				});
			</script>
		<?php }

		$html = ob_get_clean();

		foreach ($mob_menu_element_options['etheme_filters'] as $key => $value) {
			remove_filter($key, $value, 15);
		}

		$et_builder_globals['in_mobile_menu'] = false;

		return $html;
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.1
     * @return {html} header cart content
     */
	function header_cart_callback() {

		global $et_cart_icons, $et_builder_globals;

		$element_options = array();
		$element_options['is_woocommerce_et-desktop'] = ( class_exists('WooCommerce') ) ? true : false;
		$element_options['cart_style'] = Kirki::get_option( 'cart_style_et-desktop' );
		$element_options['cart_style'] = apply_filters('cart_style', $element_options['cart_style']);
		$element_options['icon_type_et-desktop'] = Kirki::get_option( 'cart_icon_et-desktop' );
		$element_options['cart_icon'] = false;

		if ( !Kirki::get_option('bold_icons') ) { 
			$element_options['cart_icons_et-desktop'] = $et_cart_icons['light'];
		}
		else {
			$element_options['cart_icons_et-desktop'] = $et_cart_icons['bold'];
		}

		$element_options['cart_icons_et-desktop']['custom'] = Kirki::get_option( 'cart_icon_custom_et-desktop' );

		if ( $element_options['is_woocommerce_et-desktop'] ) $element_options['cart_icon'] = $element_options['cart_icons_et-desktop'][$element_options['icon_type_et-desktop']];
		$element_options['cart_label_et-desktop'] = Kirki::get_option( 'cart_label_et-desktop' );
		$element_options['cart_label_et-mobile'] = Kirki::get_option( 'cart_label_et-mobile' );
		$element_options['cart_label'] = ( $element_options['cart_label_et-desktop'] || $element_options['cart_label_et-mobile'] || $et_builder_globals['in_mobile_menu'] || $et_builder_globals['is_customize_preview'] ) ? true : false;
		$element_options['cart_label_text'] = '';

		if ( $element_options['cart_label'] ) {
			$element_options['cart_label_text'] = esc_html('Cart', 'xstore-core');
			if ( Kirki::get_option( 'cart_label_custom' ) != '' ) $element_options['cart_label_text'] = Kirki::get_option( 'cart_label_custom' );
		}

		$element_options['cart_total_et-desktop'] = Kirki::get_option( 'cart_total_et-desktop' );
		$element_options['cart_total_et-mobile'] = Kirki::get_option( 'cart_total_et-mobile' );
		$element_options['cart_total'] = ( $element_options['cart_total_et-desktop'] || $element_options['cart_total_et-mobile'] || $et_builder_globals['is_customize_preview'] ) ? true : false;

		$element_options['cart_quantity_et-desktop'] = Kirki::get_option( 'cart_quantity_et-desktop' );
		$element_options['cart_quantity_position_et-desktop'] = ( $element_options['cart_quantity_et-desktop'] ) ? ' et-quantity-' . Kirki::get_option( 'cart_quantity_position_et-desktop' ) : '';
		
		$element_options['cart_content_position_et-desktop'] = Kirki::get_option( 'cart_content_position_et-desktop' );

		$element_options['cart_content_alignment'] = ' justify-content-'.Kirki::get_option( 'cart_content_alignment_et-desktop' );
		$element_options['cart_content_alignment'] .= ' mob-justify-content-'.Kirki::get_option( 'cart_content_alignment_et-mobile' );

		$element_options['cart_content_type_et-desktop'] = Kirki::get_option( 'cart_content_type_et-desktop' );
		$element_options['cart_dropdown_position_et-desktop'] = Kirki::get_option( 'cart_dropdown_position_et-desktop' );

		$element_options['cart_footer_content_et-desktop'] = Kirki::get_option( 'cart_footer_content_et-desktop' );

		$element_options['cart_link_to'] = Kirki::get_option( 'cart_link_to' );
		switch ($element_options['cart_link_to']) {
			case 'custom_url':
				$element_options['cart_link'] = Kirki::get_option( 'cart_custom_url' );
				break;
			case 'checkout_url':
				$element_options['cart_link'] = ($element_options['is_woocommerce_et-desktop']) ? wc_get_checkout_url() : home_url();
				break;
			default:
				$element_options['cart_link'] = ($element_options['is_woocommerce_et-desktop']) ? wc_get_cart_url() : home_url();
				break;
		}

		$element_options['not_cart_checkout'] = ( $element_options['is_woocommerce_et-desktop'] && !(is_cart() || is_checkout()) ) ? true : false;

		if ( $et_builder_globals['in_mobile_menu'] ) {
	        $element_options['cart_style'] = 'type1';
	        $element_options['cart_quantity_et-desktop'] = false;
	        $element_options['cart_quantity_position_et-desktop'] = '';
	        $element_options['cart_content_alignment'] = ' justify-content-inherit';
		 	$element_options['cart_content_type_et-desktop'] = 'none';
	    }

	    $element_options['cart_content_alignment'] = apply_filters('cart_content_alignment', $element_options['cart_content_alignment']);

		// filters 
		$element_options['etheme_mini_cart_content_type'] = apply_filters('etheme_mini_cart_content_type', $element_options['cart_content_type_et-desktop']);

		$element_options['etheme_mini_cart_content'] = ( $element_options['etheme_mini_cart_content_type'] != 'none' ) ? true : false;
		$element_options['etheme_mini_cart_content'] = apply_filters('etheme_mini_cart_content', $element_options['etheme_mini_cart_content']);

		$element_options['etheme_mini_cart_content_position'] = apply_filters('etheme_mini_cart_content_position', $element_options['cart_content_position_et-desktop']);

		$element_options['cart_off_canvas'] = ( $element_options['etheme_mini_cart_content_type'] == 'off_canvas' ) ? true : false;
		$element_options['cart_off_canvas'] = apply_filters('cart_off_canvas', $element_options['cart_off_canvas']);

		// link classes 

		$element_options['class'] = ' flex flex-wrap full-width align-items-center';
		$element_options['class'] .= ' ' . $element_options['cart_content_alignment'];
		$element_options['class'] .= ( $element_options['cart_off_canvas'] && $element_options['etheme_mini_cart_content'] && $element_options['not_cart_checkout']) ? ' et-toggle' : '';

		$element_options['label_class'] = ( !$element_options['cart_label_et-mobile'] ) ? 'mob-hide' : '';
		$element_options['label_class'] .= ( !$element_options['cart_label_et-desktop'] ) ? ' dt-hide' : '';

		$element_options['total_class'] = ( !$element_options['cart_total_et-mobile'] ) ? 'mob-hide' : '';
		$element_options['total_class'] .= ( !$element_options['cart_total_et-desktop'] ) ? ' dt-hide' : '';

		ob_start();

		if ( $element_options['is_woocommerce_et-desktop'] ) : ?>
		<a href="<?php echo $element_options['cart_link']; ?>" class="<?php echo $element_options['class']; ?>">
			<span class="flex<?php echo ( !$et_builder_globals['in_mobile_menu'] ) ? '-inline' : ''; ?> justify-content-center align-items-center flex-wrap">

				<?php if ( $element_options['is_woocommerce_et-desktop'] ) : ?>

					<?php if ( in_array ( $element_options['cart_style'], array('type1', 'type2') ) ) : ?>
						<span class="et_b-icon">
							<?php if ( $element_options['cart_icon'] != '' ) echo '<span class="et-svg">' . $element_options['cart_icon'] . '</span>'; ?>
							<?php if ( $element_options['cart_quantity_et-desktop'] ) etheme_cart_quantity(); ?>
						</span>
					<?php endif; // cart_position-before ?>

					<?php if ( $element_options['cart_label'] ) : ?>
						<span class="et-element-label inline-block <?php echo ( !$et_builder_globals['in_mobile_menu'] ) ? $element_options['label_class'] : ''; ?>">
							<?php echo $element_options['cart_label_text']; ?>
						</span>
					<?php endif; // end cart_label ?>
				
					<?php if ( $element_options['cart_total'] ) { ?>
				        <span class="et-cart-total et-total <?php echo $element_options['total_class']; ?>">
							<?php etheme_cart_total(); ?>
						</span>
					<?php } ?>

					<?php if ( $element_options['cart_style'] === 'type3' ) : ?>
						<span class="et_b-icon">
							<?php if ( $element_options['cart_icon'] != '' ) echo '<span class="et-svg">' . $element_options['cart_icon'] . '</span>'; ?>
							<?php if ( $element_options['cart_quantity_et-desktop'] ) etheme_cart_quantity(); ?>
						</span>
					<?php endif; // cart_position-after ?>
				<?php endif; ?>
			</span>
			</a>
			<?php etheme_cart_quantity(); ?>
			<?php if ( $element_options['etheme_mini_cart_content'] && $element_options['not_cart_checkout'] ) : ?>
				<div class="et-mini-content">
					<?php if ( $element_options['cart_off_canvas'] ) : ?>
					<span class="et-toggle pos-absolute et-close full-<?php echo $element_options['etheme_mini_cart_content_position']; ?> top">
						<svg xmlns="http://www.w3.org/2000/svg" width="0.8em" height="0.8em" viewBox="0 0 24 24">
							<path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
						</svg>
					</span>
					<?php endif; ?>
					<div class="et-content">
						<?php if ( $element_options['cart_off_canvas'] ) : ?>
							<a href="<?php echo $element_options['cart_link']; ?>" class="et-mini-content-head cart-type2 flex justify-content-center flex-wrap <?php echo 'et-quantity-' . ( $element_options['cart_quantity_et-desktop'] ) ? Kirki::get_option( 'cart_quantity_position_et-desktop' ) : 'top' ?>">
								<?php if ( $element_options['cart_icon'] == '' ) 
			                        $element_options['cart_icon'] = $element_options['cart_icons']['type1']; 
			                    ?>
								<span class="et_b-icon">
			                        <?php echo '<span class="et-svg">' . $element_options['cart_icon'] . '</span>'; 
			                        etheme_cart_quantity(); ?>
			                    </span>
			                    <span class="et-element-label pos-relative inline-block">
			                        <?php echo esc_html__('Shopping Cart', 'xstore-core'); ?>
			                    </span>
							</a>							
						<?php endif; ?>
						<?php if ( class_exists('WC_Widget_Cart') ) the_widget( 'WC_Widget_Cart', 'title=' );
				      	if ( $element_options['cart_footer_content_et-desktop'] != '' || $et_builder_globals['is_customize_preview'] ) : ?>
					      <div class="woocommerce-mini-cart__footer flex justify-content-center align-items-center <?php echo ( $et_builder_globals['is_customize_preview'] && $element_options['cart_footer_content_et-desktop'] == '') ? 'dt-hide mob-hide' : ''; ?>"><?php echo do_shortcode($element_options['cart_footer_content_et-desktop']); ?></div>
					      <?php
					  	endif; ?>
				  	</div>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<span class="flex flex-wrap full-width align-items-center currentColor">
				<span class="flex-inline justify-content-center align-items-center flex-nowrap">
		            <?php esc_html_e( 'Cart ', 'xstore-core' ); ?> 
		            <span class="mtips" style="text-transform: none;">
		                <i class="et-icon et-exclamation" style="margin-left: 3px; vertical-align: middle; font-size: 75%;"></i>
		                <span class="mt-mes"><?php esc_html_e('To use Cart please install WooCommerce plugin', 'xstore-core'); ?></span>
		            </span>
		        </span>
			</span>
		<?php endif;

		$html = ob_get_clean();
		return $html;
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.1
     * @return {html} header wishlist content
     */
	function header_wishlist_callback() {

        global $et_wishlist_icons, $et_builder_globals;

        $element_options = array();
        $element_options['is_YITH_WCWL'] = ( class_exists('YITH_WCWL') ) ? true : false;
        $element_options['wishlist_style'] = Kirki::get_option( 'wishlist_style_et-desktop' );
        $element_options['wishlist_style'] = apply_filters('wishlist_style', $element_options['wishlist_style']);
        $element_options['icon_type'] = Kirki::get_option( 'wishlist_icon_et-desktop' );

        if ( !Kirki::get_option('bold_icons') ) { 
            $element_options['wishlist_icons'] = $et_wishlist_icons['light'];
        }
        else {
            $element_options['wishlist_icons'] = $et_wishlist_icons['bold'];
        }

        $element_options['wishlist_icons']['custom'] = Kirki::get_option( 'wishlist_icon_custom_et-desktop' );

        $element_options['wishlist_icon'] = $element_options['wishlist_icons'][$element_options['icon_type']];
        $element_options['wishlist_label_et-desktop'] = Kirki::get_option( 'wishlist_label_et-desktop' );
        $element_options['wishlist_label_et-mobile'] = Kirki::get_option( 'wishlist_label_et-mobile' );
        $element_options['wishlist_label'] = ( $element_options['wishlist_label_et-desktop'] || $element_options['wishlist_label_et-mobile'] || $et_builder_globals['in_mobile_menu'] || $et_builder_globals['is_customize_preview'] ) ? true : false;
        $element_options['wishlist_label_text'] = '';

        if ( $element_options['wishlist_label'] ) {
            $element_options['wishlist_label_text'] = esc_html__('Wishlist', 'xstore-core');
            if ( Kirki::get_option( 'wishlist_label_custom_et-desktop' ) != '' ) $element_options['wishlist_label_text'] = Kirki::get_option( 'wishlist_label_custom_et-desktop' );
        }

        $element_options['wishlist_quantity_et-desktop'] = Kirki::get_option( 'wishlist_quantity_et-desktop' );
        $element_options['wishlist_quantity_position_et-desktop'] = ( $element_options['wishlist_quantity_et-desktop'] ) ? ' et-quantity-' . Kirki::get_option( 'wishlist_quantity_position_et-desktop' ) : '';
        
        $element_options['wishlist_content_position_et-desktop'] = Kirki::get_option( 'wishlist_content_position_et-desktop' );

        $element_options['wishlist_content_alignment'] = ' justify-content-'.Kirki::get_option( 'wishlist_content_alignment_et-desktop' );
        $element_options['wishlist_content_alignment'] .= ' mob-justify-content-'.Kirki::get_option( 'wishlist_content_alignment_et-mobile' );

        $element_options['wishlist_content_type_et-desktop'] = Kirki::get_option( 'wishlist_content_type_et-desktop' );
        $element_options['wishlist_dropdown_position_et-desktop'] = Kirki::get_option( 'wishlist_dropdown_position_et-desktop' );

        if ( $et_builder_globals['in_mobile_menu'] ) {
            $element_options['wishlist_style'] = 'type1';
            $element_options['wishlist_quantity_et-desktop'] = false;
            $element_options['wishlist_quantity_position_et-desktop'] = '';
            $element_options['wishlist_content_alignment'] = ' justify-content-inherit';
            $element_options['wishlist_content_type_et-desktop'] = 'none';
        }

        $element_options['wishlist_link_to'] = Kirki::get_option( 'wishlist_link_to' );
        switch ($element_options['wishlist_link_to']) {
            case 'custom_url':
                $element_options['wishlist_link'] = Kirki::get_option( 'wishlist_custom_url' );
                break;
            default:
                $element_options['wishlist_link'] = YITH_WCWL()->get_wishlist_url();
                break;
        }

        // filters 
	    $element_options['etheme_mini_wishlist_content_type'] = apply_filters('etheme_mini_wishlist_content_type', $element_options['wishlist_content_type_et-desktop']);

	    $element_options['etheme_mini_wishlist_content'] = ( $element_options['etheme_mini_wishlist_content_type'] != 'none' ) ? true : false;
	    $element_options['etheme_mini_wishlist_content'] = apply_filters('etheme_mini_wishlist_content', $element_options['etheme_mini_wishlist_content']);

	    $element_options['etheme_mini_wishlist_content_position'] = apply_filters('etheme_mini_wishlist_content_position', $element_options['wishlist_content_position_et-desktop']);

	    $element_options['wishlist_off_canvas'] = ( $element_options['etheme_mini_wishlist_content_type'] == 'off_canvas' ) ? true : false;
	    $element_options['wishlist_off_canvas'] = apply_filters('wishlist_off_canvas', $element_options['wishlist_off_canvas']);

		$element_options['not_wishlist_page'] = true;
        if ( function_exists('yith_wcwl_object_id') ) {
        	$wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
        	if ( ! empty( $wishlist_page_id ) && is_page( $wishlist_page_id ) ) {
        		$element_options['not_wishlist_page'] = false;
        	}
        }

        $element_options['wishlist_content_alignment'] = apply_filters('wishlist_content_alignment', $element_options['wishlist_content_alignment']);

        // link classes 
        $element_options['class'] = ' flex flex-wrap full-width align-items-center';
        $element_options['class'] .= ' ' . $element_options['wishlist_content_alignment'];
        $element_options['class'] .= ( $element_options['etheme_mini_wishlist_content'] ) ? ' et-toggle' : '';

        $element_options['label_class'] = ( !$element_options['wishlist_label_et-mobile'] ) ? 'mob-hide' : '';
        $element_options['label_class'] .= ( !$element_options['wishlist_label_et-desktop'] ) ? ' dt-hide' : '';

		ob_start(); ?>
		<a href="<?php echo $element_options['wishlist_link']; ?>" class="<?php echo $element_options['class']; ?>">
            <span class="flex<?php echo ( !$et_builder_globals['in_mobile_menu'] ) ? '-inline' : ''; ?> justify-content-center align-items-center flex-wrap">
                <?php if ( in_array ( $element_options['wishlist_style'], array('type1', 'type2') ) ) : ?>
                    <span class="et_b-icon">
                        <?php if ( $element_options['wishlist_icon'] != '' ) echo '<span class="et-svg">' . $element_options['wishlist_icon'] . '</span>'; ?>
                        <?php if ( $element_options['wishlist_quantity_et-desktop'] ) etheme_wishlist_quantity(); ?>
                    </span>
                <?php endif; // wishlist_position-before ?>

                <?php if ( $element_options['wishlist_label'] ) : ?>
                    <span class="et-element-label inline-block <?php echo ( !$et_builder_globals['in_mobile_menu'] ) ? $element_options['label_class'] : ''; ?>">
                        <?php echo $element_options['wishlist_label_text']; ?>
                    </span>
                <?php endif; // end wishlist_label ?>

                <?php if ( $element_options['wishlist_style'] === 'type3' ) : ?>
                    <span class="et_b-icon">
                        <?php if ( $element_options['wishlist_icon'] != '' ) echo '<span class="et-svg">' . $element_options['wishlist_icon'] . '</span>'; ?>
                       <?php if ( $element_options['wishlist_quantity_et-desktop'] ) etheme_wishlist_quantity(); ?>
                    </span>
                <?php endif; // wishlist_position-after ?>
            </span>
            </a>
            <?php etheme_wishlist_quantity(); ?>
            <?php if ( $element_options['etheme_mini_wishlist_content'] && $element_options['not_wishlist_page'] ) : ?>
                <div class="et-mini-content">
                    <?php if ( $element_options['wishlist_off_canvas'] ) : ?>
                    <span class="et-toggle pos-absolute et-close full-<?php echo $element_options['wishlist_content_position_et-desktop']; ?> top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.8em" height="0.8em" viewBox="0 0 24 24">
                            <path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
                        </svg>
                    </span>
                    <?php endif; ?>
                    <div class="et-content">
                    	<?php if ( $element_options['wishlist_off_canvas'] ) : ?>
							<a href="<?php echo $element_options['wishlist_link']; ?>" class="et-mini-content-head wishlist-type2 flex justify-content-center flex-wrap <?php echo 'et-quantity-' . ( $element_options['wishlist_quantity_et-desktop'] ) ? Kirki::get_option( 'wishlist_quantity_position_et-desktop' ) : 'top' ?>">
								<?php if ( $element_options['wishlist_icon'] == '' ) 
			                        $element_options['wishlist_icon'] = $element_options['wishlist_icons']['type1']; 
			                    ?>
								<span class="et_b-icon">
			                        <?php echo '<span class="et-svg">' . $element_options['wishlist_icon'] . '</span>'; ?>
			                        <?php etheme_wishlist_quantity(); ?>
			                    </span>
			                    <span class="et-element-label pos-relative inline-block">
			                        <?php echo esc_html__('My Wishlist', 'xstore-core'); ?>
			                    </span>
							</a>
						<?php endif; 
                        etheme_mini_wishlist(); ?>
                    </div>
                </div>
            <?php endif; ?>
		<?php 
		$html = ob_get_clean();
		return $html;
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.1
     * @return {html} header account content
     */
	function header_account_callback() {

		global $et_account_icons, $et_builder_globals;

		$is_woocommerce = class_exists('WooCommerce') ? true : false;
		$element_options = array();
		$element_options['account_style_et-desktop'] = Kirki::get_option( 'account_style_et-desktop' );
		$element_options['account_style_et-desktop'] = apply_filters('account_style', $element_options['account_style_et-desktop']);
		$element_options['account_type_et-desktop'] = Kirki::get_option( 'account_icon_et-desktop' );
		$element_options['account_type_et-desktop'] = apply_filters('account_icon', $element_options['account_type_et-desktop']);

		if ( !Kirki::get_option('bold_icons') ) { 
			$element_options['account_icons_et-desktop'] = $et_account_icons['light'];
		}
		else {
			$element_options['account_icons_et-desktop'] = $et_account_icons['bold'];
		}

		$element_options['account_icons_et-desktop']['custom'] = Kirki::get_option( 'account_icon_custom_et-desktop' );

		$element_options['account_icon_et-desktop'] = $element_options['account_icons_et-desktop'][$element_options['account_type_et-desktop']];

		$element_options['account_label_et-desktop'] = Kirki::get_option( 'account_label_et-desktop' );
		$element_options['account_label_et-mobile'] = Kirki::get_option( 'account_label_et-mobile' );
		$element_options['account_label'] = ( $element_options['account_label_et-desktop'] || $element_options['account_label_et-mobile'] || $et_builder_globals['in_mobile_menu'] || $et_builder_globals['is_customize_preview'] ) ? true : false;
		$element_options['account_label_text'] = '';
		if ( $element_options['account_label'] ) {
			if ( is_user_logged_in() ) {
				if ( Kirki::get_option( 'account_label_username' ) ) {
					$element_options['current_user_et-desktop'] = wp_get_current_user();
					$element_options['account_label_text'] = $element_options['current_user_et-desktop']->user_login;
				}
				elseif ( Kirki::get_option( 'account_label_custom_et-desktop' ) != '' ) {
					$element_options['account_label_text'] = Kirki::get_option( 'account_label_custom_et-desktop' );
				}
				else {
					$element_options['account_logged_in_text'] = Kirki::get_option( 'account_logged_in_text' );
					$element_options['account_label_text'] = ( $element_options['account_logged_in_text'] != '' ) ? $element_options['account_logged_in_text'] : esc_html__('My account', 'xstore-core');
				}
			}
			else {
				$element_options['account_text'] = Kirki::get_option( 'account_text' );
				$element_options['account_label_text'] = ( $element_options['account_text'] != '' ) ? $element_options['account_text'] : esc_html__('Login / Sign in', 'xstore-core');
			}
		} 

	    $element_options['account_content_type_et-desktop'] = Kirki::get_option( 'account_content_type_et-desktop' );
		$element_options['account_content_position_et-desktop'] = Kirki::get_option( 'account_content_position_et-desktop' );

	    $element_options['account_content_alignment'] = ' justify-content-' . Kirki::get_option( 'account_content_alignment_et-desktop' );
	    $element_options['account_content_alignment'] .= ' mob-justify-content-' . Kirki::get_option( 'account_content_alignment_et-mobile' );

	    $element_options['not_account'] = function_exists( 'is_account_page' ) && is_account_page() ? false : true;
	    
	    if ( $et_builder_globals['in_mobile_menu'] ) {
	        $element_options['account_style_et-desktop'] = 'type1';
	        $element_options['account_content_alignment'] = ' justify-content-inherit';
	        $element_options['account_content_type_et-desktop'] = 'none';
	    }

	    $element_options['account_content_alignment'] = apply_filters('account_content_alignment', $element_options['account_content_alignment']);

		// filters 
   		$element_options['etheme_mini_account_content_type'] = apply_filters('etheme_mini_account_content_type', $element_options['account_content_type_et-desktop']);

		$element_options['etheme_mini_account_content'] = ( $element_options['etheme_mini_account_content_type'] != 'none' ) ? true : false;
		$element_options['etheme_mini_account_content'] = apply_filters('etheme_mini_account_content', $element_options['etheme_mini_account_content']);

		$element_options['etheme_mini_account_content_position'] = apply_filters('etheme_mini_account_content_position', $element_options['account_content_position_et-desktop']);

		$element_options['account_off_canvas'] = ( $element_options['etheme_mini_account_content_type'] == 'off_canvas' ) ? true : false;
		$element_options['account_off_canvas'] = apply_filters('account_off_canvas', $element_options['account_off_canvas']);

    	$element_options['class'] = ' flex full-width align-items-center';
		$element_options['class'] .= ' ' . $element_options['account_content_alignment'];
		$element_options['class'] .= ( $element_options['account_off_canvas'] && $element_options['etheme_mini_account_content'] && $element_options['not_account']) ? ' et-toggle' : '';

	    $element_options['label_class'] = ( !$element_options['account_label_et-mobile'] ) ? 'mob-hide' : '';
		$element_options['label_class'] .= ( !$element_options['account_label_et-desktop'] ) ? ' dt-hide' : '';

		ob_start(); ?>

		<a href="<?php echo ( $is_woocommerce ) ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : get_dashboard_url(); ?>" class="<?php echo $element_options['class']; ?>">
			<span class="flex<?php echo ( !$et_builder_globals['in_mobile_menu'] ) ? '-inline' : ''; ?> justify-content-center align-items-center flex-wrap">

				<?php if ( in_array ( $element_options['account_style_et-desktop'], array('type1', 'type2') ) && $element_options['account_icon_et-desktop'] != '' ) : ?>
					<span class="et_b-icon">
						<?php echo $element_options['account_icon_et-desktop']; ?>
					</span>
				<?php endif; // account_position-before ?>

				<?php if ( $element_options['account_label'] ) : ?>
					<span class="et-element-label inline-block <?php echo ( !$et_builder_globals['in_mobile_menu'] ) ? $element_options['label_class'] : ''; ?>">
						<?php echo $element_options['account_label_text']; ?>
					</span>
				<?php endif; ?>

				<?php if ( $element_options['account_style_et-desktop'] === 'type3' && $element_options['account_icon_et-desktop'] != '' ) : ?>
					<span class="et_b-icon">
						<?php echo $element_options['account_icon_et-desktop']; ?>
					</span>
				<?php endif; // account_position-after ?>

			</span>
		</a>
	    <?php if ( $element_options['etheme_mini_account_content'] && $element_options['not_account'] ) :
		   et_b_account_link(true, $element_options['account_off_canvas'], $element_options); 
	    endif; ?>	

		<?php $html = ob_get_clean();

		return $html;
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} header contacts content
     */
	function header_contacts_callback() {

		global $et_icons, $et_builder_globals;

		$element_options = array();
		$element_options['contacts_package_et-desktop'] = Kirki::get_option( 'contacts_package_et-desktop' );
		$element_options['contacts_separator_et-desktop'] = Kirki::get_option( 'contacts_separator_et-desktop' );

		if ( Kirki::get_option( 'bold_icons' ) ) {
			$element_options['icons'] = $et_icons['bold'];
		}
		else {
			$element_options['icons'] = $et_icons['light'];
		}

		$element_options['contacts_direction_et-desktop'] = Kirki::get_option( 'contacts_direction_et-desktop' );

		$element_options['contacts_alignment_et-desktop'] = Kirki::get_option( 'contacts_alignment_et-desktop' );
		$element_options['contacts_content_alignment_et-desktop'] = $element_options['contacts_alignment_et-desktop'];

		$element_options['contacts_icon_et-desktop'] = Kirki::get_option( 'contacts_icon_et-desktop' );

		$element_options['contacts_inner_align'] = 'center';

		$element_options['wrapper_class'] = '';

		if ( $et_builder_globals['in_mobile_menu'] ) {
	        $element_options['contacts_direction_et-desktop'] = 'ver';
	        $element_options['contacts_alignment_et-desktop'] = $element_options['contacts_content_alignment_et-desktop'] = $element_options['contacts_inner_align'] = 'start';
	        $element_options['contacts_icon_et-desktop'] = 'left';
	    }

		$element_options['wrapper_class'] .= ( $element_options['contacts_direction_et-desktop'] == 'hor' ) ? '' : ' flex-col';

		$element_options['contacts_direction_et-desktop'] = ( $element_options['contacts_direction_et-desktop'] == 'hor' ) ? ' flex-inline' : ' flex';
		$element_options['contacts_content_alignment_et-desktop'] = ($element_options['contacts_direction_et-desktop'] == 'hor') ? ' align-items-' . $element_options['contacts_content_alignment_et-desktop'] : 
		' justify-content-' . $element_options['contacts_content_alignment_et-desktop'];

		$element_options['contacts_icon_position_et-desktop'] = ( $element_options['contacts_icon_et-desktop'] != 'none' ) ? $element_options['contacts_icon_et-desktop'] : '';
		$element_options['contacts_icon_position_et-desktop'] = apply_filters('contacts_icon_position', $element_options['contacts_icon_position_et-desktop']);

		$element_options['contact_count'] = 0;

		$element_options['sep_align_type'] = ($element_options['contacts_direction_et-desktop'] == 'hor') ? 'justify' : 'align';
		$element_options['contact_class'] = 'justify-content-' . $element_options['contacts_inner_align'];
		$element_options['contact_class'] .= ' flex-' . ($element_options['contacts_icon_position_et-desktop'] != 'top' ? 'nowrap' : 'wrap');

		ob_start(); 

		foreach ( $element_options['contacts_package_et-desktop'] as $key ) {
			if ( $key['contact_subtitle'] == '' ) continue; 
			$element_options['contact_count']++; ?>
				<div class="contact contact-<?php echo str_replace(' ', '_', $key['contact_title']); ?> icon-<?php echo $element_options['contacts_icon_position_et-desktop']; ?> <?php echo $element_options['contacts_direction_et-desktop']; ?> <?php echo $element_options['contacts_content_alignment_et-desktop']; ?>" data-tooltip="<?php echo $key['contact_title']; ?>" <?php 
					if ( isset($key['contact_link']) && $key['contact_link'] != '' ) {
						$element_options['contact_class'] .= ' pointer';
						if ( !$key['contact_link_target'] ) {
							echo 'onclick="window.location.href = \'' . $key['contact_link'] .'\'"';
						}
						else {
							echo 'onclick="window.open(\''.$key['contact_link'].'\')"';
						}
					} ?>
					>
		
					<?php if ( $element_options['contacts_icon_et-desktop'] != 'none' && $key['contact_icon'] != 'none' ) : ?>
					<span class="flex-inline <?php echo $element_options['contact_class']; ?>">
						<span class="contact-icon flex-inline justify-content-center align-items-center">
							<?php
								if ( $key['contact_icon'] != 'none' ) { 
									if ( isset( $key['contact_icon'] ) && isset( $element_options['icons'][$key['contact_icon']] ) ) echo $element_options['icons'][$key['contact_icon']]; 
									else echo $element_options['icons']['et_icon-chat'];
								}
							?>
						</span>
						<?php endif; ?>
						<span class="contact-info">
							<?php 
								echo $key['contact_subtitle'];
							?>
						</span>
					</span>
				</div>
				<?php 
				if ( $element_options['contacts_separator_et-desktop'] && $element_options['contact_count'] > 0 && $element_options['contact_count'] < count($element_options['contacts_package_et-desktop'])) {
			        echo '<span class="et_b_header-contact-sep '.$element_options['sep_align_type'].'-self-center"></span>';
			    }
				?>
			<?php
		} 

		$html = ob_get_clean();

		return $html;		
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.1
     * last changes in 1.5.5
     * @return {html} header button content
     */
	function header_button_callback() {
		$element_options = array();
		$element_options['button_text'] = Kirki::get_option( 'button_text_et-desktop' );
		$element_options['button_link'] = Kirki::get_option( 'button_link_et-desktop' );
		$element_options['button_custom_link'] = Kirki::get_option( 'button_custom_link_et-desktop' );
		$element_options['button_link'] = ($element_options['button_link'] == 'custom' ) ? $element_options['button_custom_link'] : get_permalink($element_options['button_link']);

		$element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
		$element_options['attributes'] = array();

		if ( $element_options['is_customize_preview'] ) 
			$element_options['attributes'] = array(
				'data-title="' . esc_html__( 'Button', 'xstore-core' ) . '"',
				'data-element="button"'
			); 

		if ( Kirki::get_option( 'button_target_et-desktop' ) ) 
			$element_options['attributes'][] = 'target="_blank"';
		if ( Kirki::get_option( 'button_no_follow_et-desktop' ) ) 
			$element_options['attributes'][] = 'rel="nofollow"';

		ob_start(); ?>
			<a 
				class="et_element et_b_header-button inline-block pos-relative" 
				href="<?php echo $element_options['button_link']; ?>"
				<?php echo implode( ' ', $element_options['attributes'] ); ?>>
				<?php esc_html_e($element_options['button_text'], 'xstore-core'); ?>
			</a>
		<?php 
		$html = ob_get_clean();
		return $html;
	}

	/**
     *
     * @since   1.5.4
     * @version 1.0.0
     * @return {html} header newsletter popup content
     */
	function header_newsletter_content_callback() {

	    $element_options = array();
	    $element_options['newsletter_title_et-desktop'] = Kirki::get_option( 'newsletter_title_et-desktop' );
	    $element_options['newsletter_content_et-desktop'] = Kirki::get_option( 'newsletter_content_et-desktop' );
	    $element_options['newsletter_section_et-desktop'] = ( Kirki::get_option( 'newsletter_sections_et-desktop' ) ) ? Kirki::get_option( 'newsletter_section_et-desktop' ) : '';
	    $element_options['newsletter_content_et-desktop'] = ( $element_options['newsletter_section_et-desktop'] != '' && $element_options['newsletter_section_et-desktop'] > 0 ) ? $element_options['newsletter_section_et-desktop'] : $element_options['newsletter_content_et-desktop'];
	    $element_options['newsletter_close_button_action_et-desktop'] = Kirki::get_option( 'newsletter_close_button_action_et-desktop' );

		ob_start(); ?>
	
        <span class="et-close-popup et-toggle pos-fixed full-left top <?php echo ( $element_options['newsletter_close_button_action_et-desktop'] ) ? 'close-forever' : ''; ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width=".8em" height=".8em" viewBox="0 0 24 24">
                <path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
              </svg>
            </span>
            <?php 
            if ( $element_options['newsletter_section_et-desktop'] != '' ) :

                $element_options['section_css'] = get_post_meta($element_options['newsletter_section_et-desktop'], '_wpb_shortcodes_custom_css', true);
                if(!empty($element_options['section_css'])) {
                    echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                    echo strip_tags($element_options['section_css']);
                    echo '</style>';
                }

                etheme_static_block($element_options['newsletter_section_et-desktop'], true);

            else :

              if ( $element_options['newsletter_title_et-desktop'] || is_customize_preview() ) { ?>
                <h2><?php echo $element_options['newsletter_title_et-desktop']; ?></h2>
              <?php } ?>

              <?php if ( $element_options['newsletter_content_et-desktop'] || is_customize_preview() ) { ?>
                <div class="et-content"><?php echo do_shortcode($element_options['newsletter_content_et-desktop']); ?></div>
              <?php }

            endif; ?> 

		<?php $html = ob_get_clean();
		return $html;
	}

	/**
     *
     * @since   1.5.5
     * @version 1.0.0
     * @param {array} - options 
     * @uses WPBMap class
     * @uses addAllMappedShortcodes method 
     * @return {html} html blocks content
     */
	function html_blocks_callback($options = array()) {

		ob_start();

	    if(class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes'))
	        WPBMap::addAllMappedShortcodes();

		if ( isset($options['section_content'] ) ) {
			$content = Kirki::get_option($options['section']);

			if ( Kirki::get_option($options['sections']) && $content != '' && $content > 0 ) {

				$section_css = get_post_meta($content, '_wpb_shortcodes_custom_css', true);
		        if(!empty($section_css)) {
		            echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
		            echo strip_tags($section_css);
		            echo '</style>';
		        }

		        etheme_static_block($content, true);

		    }

		    else {
		    	echo do_shortcode(Kirki::get_option($options['html_backup']));
		    }
		}
		else {
			$content = Kirki::get_option($options['html_backup']);
			echo do_shortcode($content);
		}

		$html = ob_get_clean();
		return $html;
	}

	// single product builder callbacks

	/**
     *
     * @since   1.5.5
     * @version 1.0.0
     * @return {html} single product button content
     */
	function single_product_button_callback() {
		$element_options = array();
		$element_options['button_text'] = Kirki::get_option( 'single_product_button_text_et-desktop' );
		$element_options['button_link'] = Kirki::get_option( 'single_product_button_link-desktop' );
		$element_options['button_custom_link'] = Kirki::get_option( 'single_product_button_custom_link-desktop' );
		$element_options['button_link'] = ($element_options['button_link'] == 'custom' ) ? $element_options['button_custom_link'] : get_permalink($element_options['button_link']);

		$element_options['is_customize_preview'] = apply_filters('is_customize_preview', false);
		$element_options['attributes'] = array();

		if ( $element_options['is_customize_preview'] ) 
			$element_options['attributes'] = array(
				'data-title="' . esc_html__( 'Button', 'xstore-core' ) . '"',
				'data-element="single-button"'
			); 

		if ( Kirki::get_option( 'single_product_button_target_et-desktop' ) ) 
			$element_options['attributes'][] = 'target="_blank"';
		if ( Kirki::get_option( 'single_product_button_no_follow_et-desktop' ) ) 
			$element_options['attributes'][] = 'rel="nofollow';

		ob_start(); ?>
			<a 
				class="et_element et_b_single-button inline-block pos-relative" 
				href="<?php echo $element_options['button_link']; ?>"
				<?php echo implode( ' ', $element_options['attributes'] ); ?>>
				<?php esc_html_e($element_options['button_text'], 'xstore-core'); ?>
			</a>
		<?php 
		$html = ob_get_clean();
		return $html;
	}

	/**
     *
     * @since   1.5.5
     * @version 1.0.0
     * @return {html} product size guide popup content
     */
	function product_size_guide_content_callback($id) {

	    $element_options = array();
	    $element_options['product_size_guide_img_et-desktop'] = Kirki::get_option( 'product_size_guide_img_et-desktop' );
	    $element_options['product_size_guide_title_et-desktop'] = Kirki::get_option( 'product_size_guide_title_et-desktop' );
	    $element_options['product_size_guide_section_et-desktop'] = ( Kirki::get_option( 'product_size_guide_sections_et-desktop' ) ) ? Kirki::get_option( 'product_size_guide_section_et-desktop' ) : '';
	    $element_options['product_size_guide_content_et-desktop'] = ( $element_options['product_size_guide_section_et-desktop'] != '' && $element_options['product_size_guide_section_et-desktop'] > 0 ) ? $element_options['product_size_guide_section_et-desktop'] : '<img src="'.$element_options['product_size_guide_img_et-desktop'].'" alt="' . esc_html__('sizing guide', 'xstore-core') . '">';

	    $element_options['product_size_guide_local_img'] = etheme_get_custom_field( 'size_guide_img', $id);

		ob_start(); ?>
	
    	<span class="et-close-popup pos-fixed full-left top">
          <svg xmlns="http://www.w3.org/2000/svg" width=".8em" height=".8em" viewBox="0 0 24 24">
            <path d="M13.056 12l10.728-10.704c0.144-0.144 0.216-0.336 0.216-0.552 0-0.192-0.072-0.384-0.216-0.528-0.144-0.12-0.336-0.216-0.528-0.216 0 0 0 0 0 0-0.192 0-0.408 0.072-0.528 0.216l-10.728 10.728-10.704-10.728c-0.288-0.288-0.768-0.288-1.056 0-0.168 0.144-0.24 0.336-0.24 0.528 0 0.216 0.072 0.408 0.216 0.552l10.728 10.704-10.728 10.704c-0.144 0.144-0.216 0.336-0.216 0.552s0.072 0.384 0.216 0.528c0.288 0.288 0.768 0.288 1.056 0l10.728-10.728 10.704 10.704c0.144 0.144 0.336 0.216 0.528 0.216s0.384-0.072 0.528-0.216c0.144-0.144 0.216-0.336 0.216-0.528s-0.072-0.384-0.216-0.528l-10.704-10.704z"></path>
          </svg>
        </span>
        <?php 
            if ( $element_options['product_size_guide_section_et-desktop'] != '' && !$element_options['product_size_guide_local_img'] ) :

                $element_options['section_css'] = get_post_meta($element_options['product_size_guide_section_et-desktop'], '_wpb_shortcodes_custom_css', true);
                if(!empty($element_options['section_css'])) {
                    echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                    echo strip_tags($element_options['section_css']);
                    echo '</style>';
                }

                etheme_static_block($element_options['product_size_guide_section_et-desktop'], true);

            else :

                if ( $element_options['product_size_guide_local_img'] != '' ) {
                    echo '<img src="'.$element_options['product_size_guide_local_img'].'" alt="' . esc_html__('sizing guide', 'xstore-core') . '">';
                }

                else {

                  if ( $element_options['product_size_guide_title_et-desktop'] || is_customize_preview() ) { ?>
                    <h2><?php echo $element_options['product_size_guide_title_et-desktop']; ?></h2>
                  <?php } ?>

                  <?php if ( $element_options['product_size_guide_content_et-desktop'] || is_customize_preview() ) { ?>
                    <div class="et-content"><?php echo do_shortcode($element_options['product_size_guide_content_et-desktop']); ?></div>
                  <?php }
                }

            endif; ?> 

		<?php $html = ob_get_clean();
		return $html;
	}

	/**
     *
     * @since   1.5.5
     * @version 1.0.0
     * @return {html} product sharing content
     */
	function product_sharing_callback($post_id) {
		global $et_social_icons;

		$element_options = array();
		
		$element_options['product_sharing_type_et-desktop'] = Kirki::get_option( 'product_sharing_type_et-desktop' );

	    $element_options['permalink'] = get_permalink($post_id);

	    $element_options['image'] =  wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'small' );
	    $element_options['image'] = $element_options['image'][0];
	    $element_options['title'] = rawurlencode(get_the_title($post_id));

		$element_options['product_socials_label'] = Kirki::get_option('product_socials_label_et-desktop');
		$element_options['product_socials_label_text'] = Kirki::get_option('product_socials_label_text_et-desktop');

		$element_options['product_sharing_package_et-desktop'] = Kirki::get_option( 'product_sharing_package_et-desktop' );

		$element_options['product_sharing_links'] = array(
			'facebook' => array(
				'href' => 'https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D='.$element_options['title'].'&amp;p%5Burl%5D='.$element_options['permalink'],
				'title' => esc_attr__('Facebook', 'xstore-core'),
			),
			'twitter' => array(
				'href' => 'https://twitter.com/share?url='.$element_options['permalink'].'&text='.$element_options['title'],
				'title' => esc_attr__('Twitter', 'xstore-core'),
			),
			'linkedin' => array(
				'href' => 'https://www.linkedin.com/shareArticle?mini=true&url='.$element_options['permalink'].'&title='.$element_options['title'],
				'title' => esc_attr__('Linkedin', 'xstore-core'),
			),
			'houzz' => array(
				'href' => 'http://www.houzz.com/imageClipperUpload?imageUrl='.$element_options['image'].'&title='.$element_options['title'].'&link='.$element_options['permalink'],
				'title' => esc_attr__('Houzz', 'xstore-core'),
			),
			'pinterest' => array(
				'href' => 'http://pinterest.com/pin/create/button/?url='.$element_options['permalink'].'&amp;media='.$element_options['image'].'&amp;description='.$element_options['title'],
				'title' => esc_attr__('Pinterest', 'xstore-core'),
			),
			'tumblr' => array(
				'href' => 'https://www.tumblr.com/widgets/share/tool?shareSource=legacy&canonicalUrl=<-urlencode('.$element_options['permalink'].')->&posttype=link',
				'title' => esc_attr__('Tumblr', 'xstore-core'),
			),
			'vk' => array(
				'href' => 'http://vk.com/share.php?url='.$element_options['permalink'].'&image='.$element_options['image'].'?&title='.$element_options['title'],
				'title' => esc_attr__('Vk', 'xstore-core'),
			),
			'whatsapp' => array(
				'href' => 'whatsapp://send?text='.$element_options['title'],
				'title' => esc_attr__('Whatsapp', 'xstore-core'),
			),
		);

		$element_options['attributes'] = array();

		if ( Kirki::get_option( 'product_sharing_target_et-desktop' ) ) 
			$element_options['attributes'][] = 'target="_blank"';
		if ( Kirki::get_option( 'product_sharing_no_follow_et-desktop' ) ) 
			$element_options['attributes'][] = 'rel="nofollow"';

		ob_start();

		if ( $element_options['product_socials_label'] ) { 
				echo '<span class="socials-title">' . $element_options['product_socials_label_text'] . '</span>';
			} ?>
		<?php foreach ((array)$element_options['product_sharing_package_et-desktop'] as $key => $value) { 
			if ( $value == 'whatsapp' && !wp_is_mobile() ) continue;

			$element_options['attributes'][] = 'data-tooltip="' . $element_options['product_sharing_links'][$value]['title'] . '"';

			$element_options['attributes_backup'] = $element_options['attributes'];

			?>

			<a href="<?php echo $element_options['product_sharing_links'][$value]['href']; ?>" <?php echo implode( ' ', $element_options['attributes'] ); ?>>
				<?php
					echo $et_social_icons[$element_options['product_sharing_type_et-desktop']]['et_icon-'.$value];
				?>
			</a>

			<?php $element_options['attributes'] = $element_options['attributes_backup'];
			array_pop($element_options['attributes']); // for tooltip attr ?>
		<?php } 

		$html = ob_get_clean();
		return $html;
	}

	/**
	 * Return single product builder content html.
	 *
	 * @since   1.5.5
	 * @version 1.0.0
	 * @return  {html} html of single product builder content
	 */
	function single_product_bulder_content_callback() {

	if ( is_customize_preview() ) 
        add_filter('is_customize_preview', 'etheme_return_true');

    $element_options = array();
    $sidebar_element = ( Kirki::get_option( 'single_product_sidebar_mode_et-desktop' ) != 'default' );

    $data = json_decode( Kirki::get_option( 'product_single_elements' ), true );

    if ( ! is_array( $data ) ) {
        $data = array();
    }

    uasort( $data, function ( $item1, $item2 ) {
        return $item1['index'] <=> $item2['index'];
    });

    add_filter( 'connect_block_package', function(){ return 'connect_block_product_single_package'; } );

    ob_start();

    foreach ($data as $key => $value) {
        if ( !isset($data[$value['sticky']])) $value['sticky'] = "false";

		$css = 'width:' . $value['width'] . '%;';
        if ( isset( $value['style'] ) && !is_array( $value['style'] ) ) {
        	$style = json_decode($value['style'], true);

        	if ( is_array( $style ) && count($style) ) {
	        	foreach ( $style as $k => $v ) {
	        		if ( $v ) {
	        			if ( $k == 'background-image' ) {
	                        $v = 'url(' . wp_get_attachment_image_url($v, 'full') . ')';
	                    } elseif ( $k == 'border-radius' ) {
	                    	$v = $v . 'px';
	                    } elseif ( $k == 'border-color' ){
	                    	$v = $v . '!important';
	                    }
	        			$css .= $k . ':' . $v . ';';
	        		}
        		}

        		// @todo add this to some filter 
        		if ( isset( $style['color'] ) && ! empty( $style['color'] ) ) {
        			$style_css = '
			        	.et_column.'. $key .' {color:' . $style['color'] . ';}
			        	.et_column.'. $key .' .quantity .quantity-wrapper.type-circle input{
			        		color:' . $style['color'] . ';
			        	}
			        	.et_column.'. $key .' .quantity-wrapper span {color:' . $style['color'] . ';}
			        	.et_column.'. $key .' .quantity-wrapper.type-circle span {
			        		border-color:' . $style['color'] . ';
			        	}
			        	.et_column.'. $key .' a {color:' . $style['color'] . ';}
			        	.et_column.'. $key .' .single-tags, .product_meta, .product-share, .wcpv-sold-by-single {color:' . $style['color'] . ';}
			        	.et_column.'. $key .' .single-product-size-guide {color:' . $style['color'] . ';}
			        	.et_column.'. $key .' .product_title {color:' . $style['color'] . ';}
			        	.et_column.'. $key .'.et_product-block > .price ins .amount{color:' . $style['color'] . ';}
			        ';

			        wp_add_inline_style( 'xstore-inline-css', $style_css );
        		}
        	}
        }

        $is_gallery = false;
        if ( $value['data'] ) {
            foreach ($value['data'] as $id => $element) {
                if ( $element['element'] == 'etheme_woocommerce_show_product_images' ) $is_gallery = true;
            }
        } 
        ?>
        <div
            class="<?php echo $key; ?> et_column et_product-block mob-full-width mob-full-width-children<?php echo ($is_gallery) ? ' etheme-woocommerce-product-gallery' : ''; ?><?php echo ($is_gallery && Kirki::get_option('product_gallery_type_et-desktop') == 'full_width') ? ' stretch-swiper-slider' : ''; ?> justify-content-<?php echo $value['align'] ?>"
            style="<?php echo $css; ?>"
            <?php if ( $value['sticky'] != 'false' ) echo "data-sticky='". $value['sticky'] . "'"; ?>
            data-key="<?php echo $key; ?>"
            data-width="<?php echo $value['width']; ?>"
            <?php echo ( $value['sticky'] ) ? 'data-start="0"' : ''; ?>
            >
            <?php if ( $value['data'] ) {
                uasort( $value['data'], function ( $item1, $item2 ) {
                    return $item1['index'] <=> $item2['index'];
                });

                foreach ($value['data'] as $id => $element) {

                    if ( $element['element'] == 'etheme_woocommerce_template_woocommerce_breadcrumb' && Kirki::get_option('product_breadcrumbs_mode_et-desktop') != 'element' || $element['element'] == 'etheme_product_single_widget_area_1' && !$sidebar_element ) continue;

                    $to_close = false;
                    if ( in_array($element['element'], array('etheme_woocommerce_output_upsell_products', 'etheme_woocommerce_output_related_products')) ) {
                        $to_close = true;
                        echo ( 'etheme_woocommerce_output_upsell_products' == $element['element'] ) ? '<div class="upsell-products-wrapper products-hover-only-icons">' : '<div class="related-products-wrapper products-hover-only-icons">';
                    }
                    do_action( $element['element'] );
                    if ( $to_close ) echo '</div>';
                }
            } ?>
        </div>
   <?php } 

   $html = ob_get_clean();

   return $html;
}
?>