<?php
/**
 * Template "Demos" for 8theme dashboard.
 *
 * @since   
 * @version 1.0.1
 */

function get_popup_plugin_list($version){
	$versions = require apply_filters('etheme_file_url', ETHEME_THEME . 'versions.php');
	$version = $versions[$version];


	$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	$plugins  = array(
		'all'      => array(), // Meaning: all plugins which still have open actions.
		'install'  => array(),
		'update'   => array(),
		'activate' => array(),
	);

	foreach ( $instance->plugins as $slug => $plugin ) {

		$new_is_plugin_active = (
			( ! empty( $instance->plugins[ $slug ]['is_callable'] ) && is_callable( $instance->plugins[ $slug ]['is_callable'] ) )
			|| in_array( $instance->plugins[ $slug ]['file_path'], (array) get_option( 'active_plugins', array() ) ) || is_plugin_active_for_network( $instance->plugins[ $slug ]['file_path'] )
		);
		
		if ( $new_is_plugin_active && false === $instance->does_plugin_have_update( $slug ) ) {
			// No need to display plugins if they are installed, up-to-date and active.
			continue;
		} else {
			$plugins['all'][ $slug ] = $plugin;

			if ( ! $instance->is_plugin_installed( $slug ) ) {
				$plugins['install'][ $slug ] = $plugin;
			} else {
				if ( false !== $instance->does_plugin_have_update( $slug ) ) {
					$plugins['update'][ $slug ] = $plugin;
					// unset($plugins['all'][ $slug ]);
				}

				if ( $instance->can_plugin_activate( $slug ) ) {
					$plugins['activate'][ $slug ] = $plugin;
				}
			}
		}
	}

	$required = array_filter($plugins['all'], function($el) {
		return $el['required'];
	});

	$version_plugins = ( ! empty( $version['plugins'] ) ) ? $version['plugins'] : array();

	$to_show = array_filter($plugins['all'], function($el) use($version_plugins) {
		return in_array( $el['slug'], array_merge($version_plugins) );
	});

	$return = array_merge($required,$to_show);

	foreach ($return as $key => $value) {
		if ( array_key_exists($key, $plugins['install']) ) {
			$return[$key]['btn_text'] = esc_html__( 'Install', 'xstore' );
		} else if( array_key_exists($key, $plugins['activate']) ){
			$return[$key]['btn_text'] = esc_html__( 'Activate', 'xstore' );
		}
	}

	return $return;
}

$plugins = get_popup_plugin_list($_POST['version']);

$system = new Etheme_System_Requirements();
$system->system_test();
$result = $system->result();

$disable_next = false;

$classes = array();
$classes['et_step-reset']    = 'active';
$classes['et_navigate-next'] = '';
$classes['et_step-requirements'] = 'hidden';


?>
<div class="et_popup-import-content">
	<div class="et_popup-step et_step-reset <?php echo esc_attr($classes['et_step-reset']); ?>">
		<br/><h3 class="et_step-title text-center"><?php echo esc_html__('Install', 'xstore') . ' ' . ucfirst( $_POST['version'] ); ?></h3><br/>
		<ul class="text-left">
			<li>1. <?php echo sprintf(esc_html__('It is recommended to run import on fresh WordPress installation (You can use %1sWordpress Database Reset%2s plugin).', 'xstore'), '<a href="https://fr.wordpress.org/plugins/wordpress-database-reset/" target="_blank" rel="nofollow" style="color: #c62828;">', '</a>'); ?></li>
			<li>2. <?php echo esc_html__('Importing site does not delete any pages or posts. However, it can overwrite your existing content.', 'xstore'); ?></li>
			<li>3. <?php echo esc_html__('Copyrighted media will not be imported. Instead it will be replaced with placeholders.', 'xstore'); ?></li>
		</ul>
	</div>

	<?php if ( count( $plugins ) ): ?>
		<?php $classes['et_step-reset'] = 'hidden'; ?>
		<?php $classes['et_navigate-next'] = 'hidden'; ?>
		<?php $classes['et_step-requirements'] = 'hidden'; ?>
		<div class="et_popup-step et_step-plugins hidden">
			<br/><h3 class="et_step-title text-center"><?php echo esc_html__('Required plugins.', 'xstore'); ?></h3><br/>
			<p><?php echo esc_html__('This demo requires some plugins to be installed.', 'xstore'); ?></p><br/>
			<ul class="et_popup-import-plugins with-scroll">
				<?php foreach ($plugins as $key => $value): ?>
					<li class="et_popup-import-plugin flex justify-content-between align-items-center">
						<?php 
						$notify_class = ' orange-color';
						echo '<span class="flex align-items-center">';
						if ( in_array($value['slug'], array('js_composer', 'et-core-plugin'))) {
							$disable_next = true;
							$notify_class = ' red-color';
						}
						echo '<span class="dashicons dashicons-warning dashicons-warning '.$notify_class.'"></span>';
						echo esc_html($value['name']); 
						echo '</span>'; ?>
						<span class="et_popup-import-plugin-btn" data-slug="<?php echo esc_attr($value['slug']); ?>" style="cursor: pointer; text-decoration: underline; color: #0073aa;"><?php echo esc_html($value['btn_text']); ?></span>
					</li>
				<?php endforeach ?>
			</ul>
			<span class="hidden et_plugin-nonce" data-plugin-nonce="<?php echo wp_create_nonce( 'envato_setup_nonce' ); ?>"></span>
		</div>
	<?php endif ?>

	<?php if ( ! $result ): ?>
		<?php $classes['et_step-reset'] = 'hidden'; ?>
		<div class="et_popup-step et_step-requirements <?php echo esc_attr($classes['et_step-requirements']); ?>">
			<br/><h3 class="et_step-title text-center"><?php echo esc_html__('System Requirements','xstore'); ?></h3><br/>
			<?php $system->html(); ?>
			<p class="et-message et-error"><?php esc_html_e( 'Your system does not meet the server requirements.', 'xstore' ); ?><p>
		</div>
	<?php endif ?>



	<?php 

		$versions = require apply_filters('etheme_file_url', ETHEME_THEME . 'versions.php');

		$version = $versions[$_POST['version']];

		$to_import = $version['to_import'];

	 ?>
	
	
	<div class="et_popup-step et_step-type text-left hidden">
		<br/><h3 class="et_step-title text-center"><?php echo esc_html__('Configuration Installer', 'xstore'); ?></h3><br/>
			<form class="et_install-demo-form with-scroll" action="">
					<div class="et_recomended-setup">
						<input type="checkbox" id="et_all" name="et_all" value="et_all" checked>
						<label for="et_all"><?php echo esc_html__('FULL DEMO-SITE CONTENT', 'xstore'); ?></label>
					</div>
					<div class="et_manual-setup">
						<?php if ( isset( $to_import['pages'] ) && ! empty( $to_import['pages'] ) ): ?>
							<input type="checkbox" id="pages" name="pages" value="pages" checked>
							<label for="pages"><?php echo esc_html__('Pages', 'xstore'); ?></label>
							<br>
							<div class="et_manual-setup-page">
								<?php if ( isset( $to_import['widgets'] ) && ! empty( $to_import['widgets'] ) ): ?>
									<input type="checkbox" id="widgets" name="widgets" value="widgets" checked>
									<label for="widgets"><?php echo esc_html__('Widgets', 'xstore'); ?></label>
								<br>
								<?php endif; ?>
								<?php if ( isset( $to_import['home_page'] ) && ! empty( $to_import['home_page'] ) ): ?>
									<input type="checkbox" id="home_page" name="home_page" value="home_page" checked>
									<label for="home_page"><?php echo esc_html__('Home Page', 'xstore'); ?></label>
								<br>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						
						<?php if ( isset( $to_import['posts'] ) && ! empty( $to_import['posts'] ) ): ?>
							<input type="checkbox" id="posts" name="posts" value="posts" checked>
							<label for="posts"><?php echo esc_html__('Posts', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
						
						<?php if ( isset( $to_import['products'] ) && ! empty( $to_import['products'] ) ): ?>
							<input type="checkbox" id="products" name="products" value="products" checked>
							<label for="products"><?php echo esc_html__('Products', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
						
						<?php if ( isset( $to_import['static-blocks'] ) && ! empty( $to_import['static-blocks'] ) ): ?>
							<input type="checkbox" id="static-blocks" name="static-blocks" value="static-blocks" checked>
							<label for="static-blocks"><?php echo esc_html__('Static Blocks', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['projects'] ) && ! empty( $to_import['projects'] ) ): ?>
							<input type="checkbox" id="projects" name="projects" value="projects" checked>
							<label for="projects"><?php echo esc_html__('Projects', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['testimonials'] ) && ! empty( $to_import['testimonials'] ) ): ?>
							<input type="checkbox" id="testimonials" name="testimonials" value="testimonials" checked>
							<label for="testimonials"><?php echo esc_html__('Testimonials', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['contact-forms'] ) && ! empty( $to_import['contact-forms'] ) ): ?>
							<input type="checkbox" id="contact-forms" name="contact-forms" value="contact-forms" checked>
							<label for="contact-forms"><?php echo esc_html__('Contact Forms', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['mailchimp'] ) && ! empty( $to_import['mailchimp'] ) ): ?>
							<input type="checkbox" id="mailchimp" name="mailchimp" value="mailchimp" checked>
							<label for="mailchimp"><?php echo esc_html__('Mailchimp Sign-up Forms', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['media'] ) && ! empty( $to_import['media'] ) ): ?>
							<input type="checkbox" id="media" name="media" value="media" checked>
							<label for="media"><?php echo esc_html__('Media', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['grid-builder'] ) && ! empty( $to_import['grid-builder'] ) ): ?>
							<input type="checkbox" id="grid-builder" name="grid-builder" value="grid-builder" checked>
							<label for="grid-builder"><?php echo esc_html__('Grid builder', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['fonts'] ) && ! empty( $to_import['fonts'] ) ): ?>
							<input type="checkbox" id="fonts" name="fonts" value="fonts" checked>
							<label for="fonts"><?php echo esc_html__('Custom fonts', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
						
						<?php if ( isset( $to_import['options'] ) && ! empty( $to_import['options'] ) ): ?>
							<input type="checkbox" id="options" name="options" value="options" checked>
							<label for="options"><?php echo esc_html__('Theme Options', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['products'] ) && ! empty( $to_import['products'] ) ): ?>
							<input style="display: none;" type="checkbox" id="variation_taxonomy" name="variation_taxonomy" value="variation_taxonomy" checked>
							<label style="display: none;" for="variation_taxonomy"><?php echo esc_html__('Variations taxonomy', 'xstore'); ?></label>
							
							<input style="display: none;" type="checkbox" id="variations_trems" name="variations_trems" value="variations_trems" checked>
							<label style="display: none;" for="variations_trems"><?php echo esc_html__('Variations terms', 'xstore'); ?></label>

							<input style="display: none;" type="checkbox" id="variation_products" name="variation_products" value="variation_products" checked>
							<label style="display: none;" for="variation_products"><?php echo esc_html__('Products variations', 'xstore'); ?></label>
						<?php endif; ?>

						<?php if ( isset( $to_import['menu'] ) && ! empty( $to_import['menu'] ) ): ?>
							<input type="checkbox" id="menu" name="menu" value="menu" checked>
							<label for="menu"><?php echo esc_html__('Menu', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
					</div>

					<div class="et_hidden-setup hidden">
						<?php if ( isset( $to_import['slider'] ) && ! empty( $to_import['slider'] ) ): ?>
							<input type="checkbox" id="slider" name="slider" value="slider" checked>
							<label for="slider"><?php echo esc_html__('Slider', 'xstore'); ?></label>
							<br>
						<?php endif; ?>

						<?php if ( isset( $to_import['multiple_headers'] ) && ! empty( $to_import['multiple_headers'] ) ): ?>
							<input type="checkbox" id="et_multiple_headers" name="et_multiple_headers" value="et_multiple_headers" checked>
							<label for="et_multiple_headers"><?php echo esc_html__('Multiple headers', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
						<?php if ( isset( $to_import['multiple_conditions'] ) && ! empty( $to_import['multiple_conditions'] ) ): ?>
							<input type="checkbox" id="et_multiple_conditions" name="et_multiple_conditions" value="et_multiple_conditions" checked>
							<label for="et_multiple_conditions"><?php echo esc_html__('Headers conditions', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
						<?php if ( isset( $to_import['multiple_single_product'] ) && ! empty( $to_import['multiple_single_product'] ) ): ?>
							<input type="checkbox" id="et_multiple_single_product" name="et_multiple_single_product" value="et_multiple_single_product" checked>
							<label for="et_multiple_single_product"><?php echo esc_html__('Multiple single product', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
						<?php if ( isset( $to_import['multiple_single_product_conditions'] ) && ! empty( $to_import['multiple_single_product_conditions'] ) ): ?>
							<input type="checkbox" id="et_multiple_single_product_conditions" name="et_multiple_single_product_conditions" value="et_multiple_single_product_conditions" checked>
							<label for="et_multiple_single_product_conditions"><?php echo esc_html__('Single product conditions', 'xstore'); ?></label>
							<br>
						<?php endif; ?>
					</div>
			</form>
		
	</div>
	<div class="et_popup-step et_step-processing hidden">
		<br/><h3 class="et_step-title text-center"><?php echo esc_html__('Importing, please wait!', 'xstore'); ?></h3><br/>
		<progress class="et_progress" max="100" value="0"></progress><br/>
		<div class="et_progress-notice"></div>
	</div>

	<div class="et_popup-step et_step-final hidden">
		<div class="et_all-success hidden">
			<br/><br/>
			<img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>success-icon.png" alt="installed icon" style="margin-bottom: -7px;"><br/><br/>
			<h3 class="et_step-title text-center"><?php echo ucfirst( $_POST['version'] ) . ' ' . esc_html__('successfully installed!', 'xstore'); ?></h3><br/>
		</div>
		<div class="et_with-errors hidden">
			<br/><br/>
			<h3 class="et_step-title text-center"><?php echo ucfirst( $_POST['version'] ) . ' ' . esc_html__('Installed! But we have some errors:', 'xstore'); ?></h3><br/>
			<ul class="et_errors-list with-scroll"></ul>
			<p><?php esc_html_e('The most common errors happened by low server requirments, we strongly recommend to contact your host provider and check the necessary settings.', 'xstore'); ?></p>
		</div>

		<a class="et-button et-button-green no-loader" href="<?php echo home_url(); ?>" target="_blank"><?php esc_html_e( 'Preview Website', 'xstore' ); ?></a><br/><br/>
	</div>
	<div class="et_popup-import-navigation">
		<!-- <span class="et_navigate-prev">prev</span> -->
		<span class="et_navigate-next et-button et-button-arrow" <?php echo esc_attr($classes['et_navigate-next']); ?>><?php echo esc_html__('Next', 'xstore'); ?>
			<svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 32 32">
	          <g fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-miterlimit="10">
	            <circle class="arrow-icon--circle" cx="16" cy="16" r="15.12"></circle>
	            <path class="arrow-icon--arrow" d="M16.14 9.93L22.21 16l-6.07 6.07M8.23 16h13.98"></path>
	          </g>
	        </svg>
	    </span>
		<span class="et_navigate-install et-button hidden" data-version="<?php echo esc_attr( $_POST['version'] ); ?>"><?php echo esc_html__('Install','xstore'); ?></span>
	</div>
</div>