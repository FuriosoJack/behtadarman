<?php
/**
 * Envato Theme Setup Wizard Class
 *
 * Takes new users through some basic steps to setup their ThemeForest theme.
 *
 * @author      dtbaker
 * @author      vburlak
 * @package     envato_wizard
 * @version     1.2.4
 *
 *
 * 1.2.0 - added custom_logo
 * 1.2.1 - ignore post revisioins
 * 1.2.2 - elementor widget data replace on import
 * 1.2.3 - auto export of content.
 * 1.2.4 - fix category menu links
 *
 * Based off the WooThemes installer.
 *
 *
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Envato_Theme_Setup_Wizard' ) ) {
	/**
	 * Envato_Theme_Setup_Wizard class
	 */
	class Envato_Theme_Setup_Wizard {

		/**
		 * The class version number.
		 *
		 * @since 1.1.1
		 * @access private
		 *
		 * @var string
		 */
		protected $version = '1.2.4';

		/** @var string Current theme name, used as namespace in actions. */
		protected $theme_name = '';

		/** @var string Current Step */
		protected $step = '';

		/** @var array Steps for the setup wizard */
		protected $steps = array();

		/**
		 * Relative plugin path
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $plugin_path = '';

		/**
		 * Relative plugin url for this plugin folder, used when enquing scripts
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $plugin_url = '';

		/**
		 * The slug name to refer to this menu
		 *
		 * @since 1.1.1
		 *
		 * @var string
		 */
		protected $page_slug;

		/**
		 * TGMPA instance storage
		 *
		 * @var object
		 */
		protected $tgmpa_instance;

		/**
		 * TGMPA Menu slug
		 *
		 * @var string
		 */
		protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

		/**
		 * TGMPA Menu url
		 *
		 * @var string
		 */
		protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

		/**
		 * The slug name for the parent menu
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $page_parent;

		/**
		 * Complete URL to Setup Wizard
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $page_url;

		protected $versions;


		/**
		 * Holds the current instance of the theme manager
		 *
		 * @since 1.1.3
		 * @var Envato_Theme_Setup_Wizard
		 */
		private static $instance = null;

		public $api_url;

		/**
		 * @since 1.1.3
		 *
		 * @return Envato_Theme_Setup_Wizard
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.1
		 * @access private
		 */
		public function __construct() {
			$this->init_globals();
			$this->init_actions();
		}

		/**
		 * Get the default style. Can be overriden by theme init scripts.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.7
		 * @access public
		 */
		public function get_default_theme_style() {
			return 'pink';
		}

		/**
		 * Get the default style. Can be overriden by theme init scripts.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.9
		 * @access public
		 */
		public function get_header_logo_width() {
			return '200px';
		}


		/**
		 * Get the default style. Can be overriden by theme init scripts.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.9
		 * @access public
		 */
		public function get_logo_image() {
			$image_url = ETHEME_BASE_URI.'theme/assets/images/logo-setup.png';
			return apply_filters( 'envato_setup_logo_image', $image_url );
		}

		/**
		 * Setup the class globals.
		 *
		 * @since 1.1.1
		 * @access public
		 */
		public function init_globals() {
			$current_theme         = wp_get_theme();
			$this->theme_name      = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
			$this->page_slug       = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', 'xstore-setup' );
			$this->parent_slug     = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );

            $this->versions = require apply_filters('etheme_file_url', ETHEME_THEME . 'versions.php');

			//If we have parent slug - set correct url
			if ( $this->parent_slug !== '' ) {
				$this->page_url = 'admin.php?page=' . $this->page_slug;
			} else {
				$this->page_url = 'themes.php?page=' . $this->page_slug;
			}
			$this->page_url = apply_filters( $this->theme_name . '_theme_setup_wizard_page_url', $this->page_url );

			$this->api_url = ETHEME_API;
			//set relative plugin path url
			$this->plugin_path = trailingslashit( $this->cleanFilePath( dirname( __FILE__ ) ) );
			$relative_url      = str_replace( $this->cleanFilePath( get_template_directory() ), '', $this->plugin_path );
			$this->plugin_url  = trailingslashit( get_template_directory_uri() . $relative_url );
		}

		/**
		 * Setup the hooks, actions and filters.
		 *
		 * @uses add_action() To add actions.
		 * @uses add_filter() To add filters.
		 *
		 * @since 1.1.1
		 * @access public
		 */
		public function init_actions() {
			if ( apply_filters( $this->theme_name . '_enable_setup_wizard', true ) && current_user_can( 'manage_options' ) ) {

				if(!is_child_theme()){
					add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );
				}

				if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
					add_action( 'init', array( $this, 'get_tgmpa_instanse' ), 30 );
					add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
				}

				add_action( 'admin_menu', array( $this, 'admin_menus' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'admin_init', array( $this, 'admin_redirects' ), 30 );
				add_action( 'admin_init', array( $this, 'init_wizard_steps' ), 30 );
				add_action( 'admin_init', array( $this, 'setup_wizard' ), 30 );
				add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
				add_action( 'wp_ajax_envato_setup_plugins', array( $this, 'ajax_plugins' ) );
			}
			#add_action( 'upgrader_post_install', array( $this, 'upgrader_post_install' ), 10, 2 );
		}

		/**
		 * After a theme update we clear the setup_complete option. This prompts the user to visit the update page again.
		 *
		 * @since 1.1.8
		 * @access public
		 */
		public function upgrader_post_install( $return, $theme ) {
			if ( is_wp_error( $return ) ) {
				return $return;
			}
			if ( $theme != get_stylesheet() ) {
				return $return;
			}
			update_option( 'envato_setup_complete', false );

			return $return;
		}


		public function enqueue_scripts() {
		}

		public function tgmpa_load( $status ) {
			return is_admin() || current_user_can( 'install_themes' );
		}

		public function switch_theme() {
			set_transient( '_' . $this->theme_name . '_activation_redirect', 1 );
		}

		public function admin_redirects() {
			ob_start();
			if ( ! get_transient( '_' . $this->theme_name . '_activation_redirect' ) || get_option( 'envato_setup_complete', false ) ) {
				return;
			}
			delete_transient( '_' . $this->theme_name . '_activation_redirect' );
			// wp_safe_redirect( admin_url( $this->page_url ) );
			wp_safe_redirect( admin_url( 'admin.php?page=et-panel-welcome' ) );
			exit;
		}

		/**
		 * Get configured TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function get_tgmpa_instanse() {
			$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		}

		/**
		 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function set_tgmpa_url() {

			$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
			$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );

			$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';

			$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );

		}

		/**
		 * Add admin menus/screens.
		 */
		public function admin_menus() {

			if ( $this->is_submenu_page() ) {
				//prevent Theme Check warning about "themes should use add_theme_page for adding admin pages"
				$add_subpage_function = 'add_submenu' . '_page';
				$add_subpage_function( $this->parent_slug, esc_html__( 'Setup Wizard', 'xstore' ), esc_html__( 'Setup Wizard', 'xstore' ), 'manage_options', $this->page_slug, array(
					$this,
					'setup_wizard',
				) );
			} else {
				add_theme_page( esc_html__( 'Setup Wizard', 'xstore' ), esc_html__( 'Setup Wizard', 'xstore' ), 'manage_options', $this->page_slug, array(
					$this,
					'setup_wizard',
				) );
			}

		}


		/**
		 * Setup steps.
		 *
		 * @since 1.1.1
		 * @access public
		 * @return array
		 */
		public function init_wizard_steps() {

			

			$this->steps = array(
				'introduction' => array(
					'name'    => esc_html__( 'Introduction', 'xstore' ),
					'view'    => array( $this, 'envato_setup_introduction' ),
					'handler' => array( $this, 'envato_setup_introduction_save' ),
				),
			);	

			$this->steps['updates'] = array(
				'name'    => __( 'Activation', 'xstore' ),
				'view'    => array( $this, 'envato_setup_updates' ),
				'handler' => array( $this, 'envato_setup_updates_save' ),
			);

			$this->steps['system_status'] = array(
				'name'    => esc_html__( 'Requirements', 'xstore' ),
				'view'    => array( $this, 'system_requirements' ),
				'handler' => '',
			);

			$this->steps['customize'] = array(
				'name'    => __( 'Child Theme', 'xstore' ),
				'view'    => array( $this, 'envato_setup_customize' ),
				'handler' => '',
			);

			$this->steps['default_content'] = array(
				'name'    => esc_html__( 'Demos', 'xstore' ),
				'view'    => array( $this, 'envato_setup_default_content' ),
				'handler' => '',
			);
			if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
				$this->steps['default_plugins'] = array(
					'name'    => esc_html__( 'Plugins', 'xstore' ),
					'view'    => array( $this, 'envato_setup_default_plugins' ),
					'handler' => '',
				);
			}
		
			$this->steps['next_steps']      = array(
				'name'    => esc_html__( 'Ready!', 'xstore' ),
				'view'    => array( $this, 'envato_setup_ready' ),
				'handler' => '',
			);

			$this->steps = apply_filters( $this->theme_name . '_theme_setup_wizard_steps', $this->steps );

		}

		/**
		 * Show the setup wizard
		 */
		public function setup_wizard() {
			if ( empty( $_GET['page'] ) || $this->page_slug !== $_GET['page'] ) {
				return;
			}
			ob_end_clean();

			$this->step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : current( array_keys( $this->steps ) );

			wp_register_script( 'jquery-blockui', $this->plugin_url . 'js/jquery.blockUI.js', array( 'jquery' ), '2.70', true );
			wp_register_script( 'envato-setup', $this->plugin_url . 'js/envato-setup.js', array(
				'jquery',
				'jquery-blockui',
			), $this->version );
			wp_localize_script( 'envato-setup', 'envato_setup_params', array(
				'tgm_plugin_nonce' => array(
					'update'  => wp_create_nonce( 'tgmpa-update' ),
					'install' => wp_create_nonce( 'tgmpa-install' ),
				),
				'tgm_bulk_url'     => admin_url( $this->tgmpa_url ),
				'ajaxurl'          => admin_url( 'admin-ajax.php' ),
				'wpnonce'          => wp_create_nonce( 'envato_setup_nonce' ),
				'verify_text'      => esc_html__( '...verifying', 'xstore' ),
			) );

			// ! enqueue etheme-admin-css
			wp_enqueue_style( 'etheme-admin-css', ETHEME_CODE_CSS . 'admin-backend-style.css');

			if ( is_rtl() ) {
		    	wp_enqueue_style('etheme_admin_rtl_css', ETHEME_CODE_CSS.'admin-rtl-backend-style.css', array('etheme-admin-css') );
		    }

		    wp_enqueue_style('xstore-icons', ETHEME_CODE_CSS.'xstore-admin-icons.css');

			wp_enqueue_style( 'envato-setup', $this->plugin_url . 'css/envato-setup.css', array(
				'wp-admin',
				'dashicons',
				'install',
			), $this->version );

			//enqueue style for admin notices
			wp_enqueue_style( 'wp-admin' );

			wp_enqueue_media();
			wp_enqueue_script( 'media' );

			ob_start();
			$this->setup_wizard_header();
			$this->setup_wizard_steps();
			$show_content = true;
			echo '<div class="envato-setup-content">';
			if ( ! empty( $_REQUEST['save_step'] ) && isset( $this->steps[ $this->step ]['handler'] ) ) {
				$show_content = call_user_func( $this->steps[ $this->step ]['handler'] );
			}
			if ( $show_content ) {
				$this->setup_wizard_content();
			}
			echo '</div>';
			$this->setup_wizard_footer();
			exit;
		}

		public function get_step_link( $step ) {
			return add_query_arg( 'step', $step, admin_url( 'admin.php?page=' . $this->page_slug ) );
		}

		public function get_next_step_link() {
			$keys = array_keys( $this->steps );

			return add_query_arg( 'step', $keys[ array_search( $this->step, array_keys( $this->steps ) ) + 1 ], remove_query_arg( 'translation_updated' ) );
		}

		/**
		 * Setup Wizard Header
		 */
		public function setup_wizard_header() {
			?>
			<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
			<head>
				<meta name="viewport" content="width=device-width"/>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<?php
				// avoid theme check issues.
				echo '<t';
				echo 'itle>' . esc_html__( 'Theme &rsaquo; Setup Wizard', 'xstore' ) . '</ti' . 'tle>'; ?>
				<?php wp_print_scripts( 'envato-setup' ); ?>
				<?php do_action( 'admin_print_styles' ); ?>
				<?php do_action( 'admin_print_scripts' ); ?>
				<?php do_action( 'admin_head' ); ?>
			</head>
			<body class="envato-setup wp-core-ui">
			<h1 id="wc-logo"><?php
					$image_url = $this->get_logo_image();
					if ( $image_url ) {
						$image = '<img class="site-logo" src="%s" alt="%s" style="height:auto" />';
						printf(
							$image,
							$image_url,
							get_bloginfo( 'name' )
						);
					} else { ?>
						<img src="<?php echo esc_url($this->plugin_url); ?>images/logo-setup.png" alt="Envato install wizard" /><?php
					} ?></a>
			</h1>
			<div class="et_panel-popup"></div>
			<?php
			}

			/**
			 * Setup Wizard Footer
			 */
			public function setup_wizard_footer() {
			?>
			<a class="wc-return-to-dashboard" href="<?php echo esc_url( admin_url( 'admin.php?page=et-panel-welcome' ) ); ?>"><?php esc_html_e( 'Return to the WordPress Dashboard', 'xstore' ); ?></a>
			<!-- <p class="copyrights">© Created by <a href="https://www.8theme.com/" target="_blank">8theme</a> - Power Elite ThemeForest Author.</p> -->
			</body>
			<?php
			@do_action( 'admin_footer' ); // this was spitting out some errors in some admin templates. quick @ fix until I have time to find out what's causing errors.
			do_action( 'admin_print_footer_scripts' );
			?>
			</html>
			<?php
		}

		/**
		 * Output the steps
		 */
		public function setup_wizard_steps() {
			$ouput_steps = $this->steps;
			array_shift( $ouput_steps );
			$_i = 0;
			?>
			<ol class="envato-setup-steps">
				<?php foreach ( $ouput_steps as $step_key => $step ) : ?>
					<?php $_i++ ?>
					<li class="<?php
						$show_link = false;
						if ( $step_key === $this->step ) {
							echo 'active';
						} elseif ( array_search( $this->step, array_keys( $this->steps ) ) > array_search( $step_key, array_keys( $this->steps ) ) ) {
							echo 'done';
							$show_link = true;
						}
						?>"><?php
							if ( $show_link ) {
								?>
								<a href="<?php echo esc_url( $this->get_step_link( $step_key ) ); ?>"><?php echo esc_html( $step['name'] ); ?></a>
								<?php
							} else {
								echo esc_html( $step['name'] );
							}
						?>
						<span class="progress"></span>
					</li>
				<?php endforeach; ?>
			</ol>
			<?php
		}

		/**
		 * Output the content for the current step
		 */
		public function setup_wizard_content() {
			isset( $this->steps[ $this->step ] ) ? call_user_func( $this->steps[ $this->step ]['view'] ) : false;
		}

		/**
		 * Introduction step
		 */
		public function envato_setup_introduction() {

			if ( false && isset( $_REQUEST['debug'] ) ) {
				echo '<pre>';
				// debug inserting a particular post so we can see what's going on
				$post_type = 'nav_menu_item';
				$post_id   = 239; // debug this particular import post id.
				$all_data  = $this->_get_json( 'default.json' );
				if ( ! $post_type || ! isset( $all_data[ $post_type ] ) ) {
					echo "Post type $post_type not found.";
				} else {
					echo "Looking for post id $post_id \n";
					foreach ( $all_data[ $post_type ] as $post_data ) {

						if ( $post_data['post_id'] == $post_id ) {
							print_r( $post_data );
						}
					}
				}
				print_r( $this->logs );

				echo '</pre>';
			} else if ( isset( $_REQUEST['export'] ) ) {

				//@include('envato-setup-export.php');

			} else if ( get_option( 'envato_setup_complete', false ) ) {
				?>
				<img src="<?php echo ETHEME_BASE_URI.'theme/assets/images/box-opening.gif'; ?>" alt="box-opening" style="max-width: 70px; margin-bottom:  -10px; margin-top:  -10px;">
				<h1><?php printf( esc_html__( 'Welcome to the setup wizard for %s.', 'xstore' ), wp_get_theme() ); ?></h1>
				<p class="et-message et-warning"><?php esc_html_e( 'It looks like you have already run the setup wizard. ', 'xstore' ); esc_html_e('If you need to update XStore theme, go to your', 'xstore'); ?> <a href="<?php echo esc_url( admin_url() ); ?>"><?php esc_html_e('Dashboard', 'xstore'); ?>.</a></p>
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="et-button last-button fright">
				<span class="et-loader">
                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
                </span>
				<?php esc_html_e( 'Run Setup Wizard Again', 'xstore' ); ?></a>
				<?php
			} else {
				?>
				<img src="<?php echo ETHEME_BASE_URI.'theme/assets/images/box-opening.gif'; ?>" alt="box-opening" style="max-width: 70px; margin-bottom:  -10px; margin-top:  -10px;">
				<h1><?php printf( esc_html__( 'Welcome to XStore Setup Wizard', 'xstore' ), wp_get_theme() ); ?></h1>
				<p><?php printf( esc_html__( 'Thank you for choosing our XStore template.', 'xstore' ), wp_get_theme() ); ?></p>
				<p><?php printf( esc_html__( 'This setup wizard will help you to refresh and configure your website with a new layout. You will have Child Theme, Demos, and Plugins installed in 3-8 minutes (depending on your server configuration). ', 'xstore' ), wp_get_theme() ); ?></p>
				<p><?php esc_html_e( 'No time to go through the Setup wizard? You may skip this step now and get back to WordPress dashboard. Come back any time to continue a theme installation.', 'xstore' ); ?></p>
				<p class="envato-setup-actions step">
				<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(), 'update.php' ) ? wp_get_referer() : admin_url( '' ) ); ?>"
					   class="skip"><?php esc_html_e( 'Not right now', 'xstore' ); ?>
					   	<span class="et-loader">
		                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
		                </span>
					   </a>
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="et-button button-active button-next"><?php esc_html_e( 'Let\'s Go!', 'xstore' ); ?>
					   	<span class="et-loader">
		                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
		                </span>
					   </a>
				</p>
				<?php
			}
		}

		public function filter_options( $options ) {
			return $options;
		}

		/**
		 *
		 * Handles save button from welcome page. This is to perform tasks when the setup wizard has already been run. E.g. reset defaults
		 *
		 * @since 1.2.5
		 */
		public function envato_setup_introduction_save() {

			check_admin_referer( 'envato-setup' );

			if ( ! empty( $_POST['reset-font-defaults'] ) && $_POST['reset-font-defaults'] == 'yes' ) {

				// clear font options
				update_option( 'tt_font_theme_options', array() );

				// reset site color
				remove_theme_mod( 'dtbwp_site_color' );

				if ( class_exists( 'dtbwp_customize_save_hook' ) ) {
					$site_color_defaults = new dtbwp_customize_save_hook();
					$site_color_defaults->save_color_options();
				}

				$file_name = get_template_directory() . '/style.custom.css';
				if ( file_exists( $file_name ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
					WP_Filesystem();
					global $wp_filesystem;
					$wp_filesystem->put_contents( $file_name, '' );
				}
				?>
				<p>
					<strong><?php esc_html_e( 'Options have been reset. Please go to Appearance > Customize in the WordPress backend.', 'xstore' ); ?></strong>
				</p>
				<?php
				return true;
			}

			return false;
		}


		private function _get_plugins( $version = false ) {
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
						}

						if ( $instance->can_plugin_activate( $slug ) ) {
							$plugins['activate'][ $slug ] = $plugin;
						}
					}
				}
			}

			return $plugins;
		}

		/**
		 * Page setup
		 */
		public function envato_setup_default_plugins() {

			tgmpa_load_bulk_installer();
			// install plugins with TGM.
			if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
				die( 'Failed to find TGM' );
			}
			$url     = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'envato-setup' );
			$plugins = $this->_get_plugins();

			// copied from TGM

			$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
			$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.

			if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
				return true; // Stop the normal page form from displaying, credential request form will be shown.
			}

			// Now we have some credentials, setup WP_Filesystem.
			if ( ! WP_Filesystem( $creds ) ) {
				// Our credentials were no good, ask the user for them again.
				request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );

				return true;
			}

			$version_import = false;

			if( isset( $_GET['version'] ) && isset( $this->versions[$_GET['version']] ) ) {
				$version_import = $_GET['version'];
			}

			/* If we arrive here, we have the filesystem */

			?>
			<h1><?php esc_html_e( 'Plugins', 'xstore' ); ?></h1>
			<form method="post" class="plugins-form" data-version="<?php echo esc_attr( $version_import ); ?>">

				<?php
				$plugins = $this->_get_plugins( $version_import );

				$required = array_filter($plugins['all'], function($el) {
					return $el['required'];
				});

				$version_plugins = ( ! empty( $this->versions[ $version_import ]['plugins'] ) ) ? $this->versions[ $version_import ]['plugins'] : array();

				$for_version = array_filter($plugins['all'], function($el) use($version_plugins) {
					return in_array( $el['slug'], array_merge($version_plugins) );
				});

				$for_version = array_filter($for_version, function($el) use($required) {
					return ( ! isset( $required[ $el['slug'] ] ) );
				});

				$recommended = array_filter($plugins['all'], function($el) use( $for_version ) {
					return ( ! $el['required'] && ! isset( $for_version[ $el['slug'] ] ) );
				});

				if ( count( $plugins['all'] ) ) {
					?>
					<p><?php esc_html_e( 'Our theme requires some plugins to be installed. You may edit the plugins, add or remove them at all later directly from your Wordpress Dashboard.', 'xstore' ); ?></p>
					<p class="et-message et-warning"><?php esc_html_e( 'Please, note that every external plugin can affect your website loading speed.', 'xstore' ); ?></p>
					<ul class="envato-wizard-plugins">
						<li class="plugins-title"><?php esc_html_e('Required Plugins', 'xstore'); ?></li>
						<?php $this->_list_plugins( $required, $plugins ); ?>
						<?php if ( ! empty( $for_version ) ): ?>
							<li class="plugins-title"><?php esc_html_e('Needed for this version' ,'xstore'); ?></li>
							<?php $this->_list_plugins( $for_version, $plugins, true ); ?>
						<?php endif ?>
						<li class="plugins-title"><?php esc_html_e('Additional plugins', 'xstore'); ?> <span style="float: none; padding: 0;">(<?php esc_html_e('not required' ,'xstore'); ?>)</span></li>
						<?php $this->_list_plugins( $recommended, $plugins ); ?>
					</ul>
					<?php
				} else {
					echo '<p class="et-message et-success">' . esc_html__( 'Good news! All plugins are already installed and up to date. Please continue.', 'xstore' ) . '</p>';
				} ?>

	            <div class="loading-info">
                    <span><?php esc_html_e('Importing demo content...', 'xstore'); ?></span><br>
	                <h2><?php esc_html_e('Please wait, it may take up to 5 minutes.', 'xstore'); ?></h2>
	                <div class="et-loader">
	                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
	                </div>
	            </div>
				<p class="envato-setup-actions step">
	                <span class="hidden et_install-parts"><?php 
	                	$to_import = array();
	                	// sorting to prevent crashed import parts of demos 
	                	if ( isset($this->versions[ $version_import ]['to_import']['pages'] ) ) 
	                		$to_import['pages'] = $this->versions[ $version_import ]['to_import']['pages'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['widgets'] ) ) 
	                		$to_import['widgets'] = $this->versions[ $version_import ]['to_import']['widgets'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['home_page'] ) ) 
	                		$to_import['home_page'] = $this->versions[ $version_import ]['to_import']['home_page'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['posts'] ) ) 
	                		$to_import['posts'] = $this->versions[ $version_import ]['to_import']['posts'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['products'] ) ) 
	                		$to_import['products'] = $this->versions[ $version_import ]['to_import']['products'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['static-blocks'] ) ) 
	                		$to_import['static-blocks'] = $this->versions[ $version_import ]['to_import']['static-blocks'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['projects'] ) ) 
	                		$to_import['projects'] = $this->versions[ $version_import ]['to_import']['projects'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['testimonials'] ) ) 
	                		$to_import['testimonials'] = $this->versions[ $version_import ]['to_import']['testimonials'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['contact-forms'] ) ) 
	                		$to_import['contact-forms'] = $this->versions[ $version_import ]['to_import']['contact-forms'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['grid-builder'] ) ) 
	                		$to_import['grid-builder'] = $this->versions[ $version_import ]['to_import']['grid-builder'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['mailchimp'] ) ) 
	                		$to_import['mailchimp'] = $this->versions[ $version_import ]['to_import']['mailchimp'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['media'] ) ) 
	                		$to_import['media'] = $this->versions[ $version_import ]['to_import']['media'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['fonts'] ) ) 
	                		$to_import['fonts'] = $this->versions[ $version_import ]['to_import']['fonts'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['options'] ) ) 
	                		$to_import['options'] = $this->versions[ $version_import ]['to_import']['options'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['products'] ) && !empty($this->versions[ $version_import ]['to_import']['products']) ) {
	                		$to_import['variation_taxonomy'] = true;
	                		$to_import['variations_trems']   = true;
	                		$to_import['variation_products'] = true;
	                	}

	                	if ( isset($this->versions[ $version_import ]['to_import']['smart-products'] ) ) 
	                		$to_import['smart-products'] = $this->versions[ $version_import ]['to_import']['smart-products'];;

	                	if ( isset($this->versions[ $version_import ]['to_import']['menu'] ) ) 
	                		$to_import['menu'] = $this->versions[ $version_import ]['to_import']['menu'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['slider'] ) ) 
	                		$to_import['slider'] = $this->versions[ $version_import ]['to_import']['slider'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['multiple_headers'] ) ) 
	                		$to_import['multiple_headers'] = $this->versions[ $version_import ]['to_import']['multiple_headers'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['multiple_conditions'] ) ) 
	                		$to_import['multiple_conditions'] = $this->versions[ $version_import ]['to_import']['multiple_conditions'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['multiple_single_product'] ) ) 
	                		$to_import['multiple_single_product'] = $this->versions[ $version_import ]['to_import']['multiple_single_product'];

	                	if ( isset($this->versions[ $version_import ]['to_import']['multiple_single_product_conditions'] ) ) 
	                		$to_import['multiple_single_product_conditions'] = $this->versions[ $version_import ]['to_import']['multiple_single_product_conditions'];

		                echo json_encode( $to_import ); ?></span>
					<?php if ( count( $plugins['all'] ) ) { ?>
				   	<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="et-button button-next"
					   data-continue="<?php esc_attr_e('Continue', 'xstore'); ?>"
					   data-callback="install_plugins"><?php esc_html_e( 'Install', 'xstore' ); ?>
					   <span class="et-loader">
	                    	<svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
	                	</span>
	                </a>
	                <?php } ?>
					<?php wp_nonce_field( 'envato-setup' ); ?>
				</p>
			</form>
			<?php
		}

		private function _list_plugins( $plugins, $all, $checked = false ) {
			foreach ($plugins as $slug => $plugin) {
				$this->_plugin_list_item( $slug, $plugin, $all, $checked );
			}
		}

		private function _plugin_list_item( $slug, $plugin, $plugins, $checked = false ) {
			?>
				<li data-slug="<?php echo esc_attr( $slug ); ?>" class="plugin-to-install">
					<label for="plugin-import[<?php echo esc_attr($slug); ?>]">
						<input type="checkbox" name="plugin-import[<?php echo esc_attr($slug); ?>]" id="plugin-import[<?php echo esc_attr($slug); ?>]" <?php if ( $plugin['required'] || $checked ): ?>checked="checked"<?php endif ?> <?php if ( $plugin['required'] ): ?>disabled="disabled"<?php endif ?>>
						<p><?php echo esc_html( $plugin['name'] ); ?> </p>
						<?php if ( ! empty( $plugin['details_url'] )): ?>
							<a href="<?php echo esc_url( $plugin['details_url'] ); ?>" target="_blank"> details</a>
						<?php endif ?>
						<span>
							<?php
						    // $keys = array();
						    // if ( isset( $plugins['install'][ $slug ] ) ) {
							   //  $keys[] = 'Installation';
						    // }
						    // if ( isset( $plugins['update'][ $slug ] ) ) {
							   //  $keys[] = 'Update';
						    // }
						    // if ( isset( $plugins['activate'][ $slug ] ) ) {
							   //  $keys[] = 'Activation';
						    // }
						    // echo implode( ' and ', $keys ) . ' required';
						    ?>
						</span>
					</label>
				</li>
			<?php
		}


		public function ajax_plugins() {
			if ( ! check_ajax_referer( 'envato_setup_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
				wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found', 'xstore' ) ) );
			}
			$json = array();
			// send back some json we use to hit up TGM
			$plugins = $this->_get_plugins();
			// what are we doing with this plugin?
			foreach ( $plugins['activate'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url'           => admin_url( $this->tgmpa_url ),
						'plugin'        => array( $slug ),
						'tgmpa-page'    => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
						'action'        => 'tgmpa-bulk-activate',
						'action2'       => - 1,
						'message'       => esc_html__( 'Activating Plugin', 'xstore' ),
					);
					break;
				}
			}
			foreach ( $plugins['update'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url'           => admin_url( $this->tgmpa_url ),
						'plugin'        => array( $slug ),
						'tgmpa-page'    => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
						'action'        => 'tgmpa-bulk-update',
						'action2'       => - 1,
						'message'       => esc_html__( 'Updating Plugin', 'xstore' ),
					);
					break;
				}
			}
			foreach ( $plugins['install'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url'           => admin_url( $this->tgmpa_url ),
						'plugin'        => array( $slug ),
						'tgmpa-page'    => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
						'action'        => 'tgmpa-bulk-install',
						'action2'       => - 1,
						'message'       => esc_html__( 'Installing Plugin', 'xstore' ),
					);
					break;
				}
			}

			if ( $json ) {
				$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
				wp_send_json( $json );
			} else {
				wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success', 'xstore' ) ) );
			}
			exit;

		}


		/**
		 * Page setup
		 */
		public function envato_setup_default_content() {

			$versions_imported = array();

            $pages = array_filter($this->versions, function( $el ) {
                return $el['type'] == 'page';
            });

            $demos = array_filter($this->versions, function( $el ) {
                return $el['type'] == 'demo';
            });

			?>
			<h1><?php esc_html_e( 'Choose Your Demo', 'xstore' ); ?></h1>
			<form method="post">
				<p><?php esc_html_e('Choose the appropriate demo version from the variants listed below. Once imported, this content can be managed from the WordPress dashboard.', 'xstore'); ?></p>
				<div class="etheme-search">
		            <input type="text" class="etheme-versions-search form-control" placeholder="Search for versions">
		            <i class="et-admin-icon et-zoom"></i>
		            <span class="spinner">
		            <div class="et-loader ">
		                <svg class="loader-circular" viewBox="25 25 50 50">
		                <circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
		                </svg>
		            </div>
		            </span>
		        </div>
	            <div class="import-demos-wrapper">
	                <div class="import-demos">
	                    <?php $i=0; foreach ($demos as $key => $version): $i++; ?>
	                        <div class="version-preview <?php if( $i==1 ) echo 'active-version '; echo ( in_array( $key, $versions_imported ) ) ? 'version-imported' : 'not-imported'; ?> version-preview-<?php echo esc_attr( $key ); ?>" data-version="<?php echo esc_attr( $key ); ?>">
                                <div class="version-screenshot">
			                        <img
			                            src="https://xstore.8theme.com/dashboard-images/<?php echo esc_attr( $key ); ?>/screenshot.jpg"
			                            alt="<?php echo esc_attr( $key ); ?>">
			                        <div class="version-footer">
			                            <span class="button-import-version et-button et-button-green no-loader" data-version="<?php echo esc_attr( $key ); ?>">
			                                <?php echo esc_html__('Choose', 'xstore'); ?>
			                            </span>
			                            <a href="<?php echo esc_url( $version['preview_url'] ); ?>" target="_blank" class="button-preview et-button et-button-dark-grey no-loader">
			                                <?php echo esc_html__('Preview', 'xstore'); ?>
			                            </a>
			                        </div>
			                    </div>
	                            <span class="version-title"><?php echo esc_html( $version['title'] ); ?></span>
	                        </div>
	                    <?php endforeach ?>
	                </div>
	            </div>

	            <input type="hidden" name="et-version" id="et-version" value="default">

				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="et-button button-active button-next"
					   data-callback="install_content"><?php esc_html_e( 'Continue', 'xstore' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span>
					   <span class="et-loader">
		                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
		                </span>
	                </a>
				</p>
					<?php wp_nonce_field( 'envato-setup' ); ?>
			</form>
			<?php
		}



		private function _imported_term_id( $original_term_id, $new_term_id = false ) {
			$terms = get_transient( 'importtermids' );
			if ( ! is_array( $terms ) ) {
				$terms = array();
			}
			if ( $new_term_id ) {
				if ( ! isset( $terms[ $original_term_id ] ) ) {
					$this->log( 'Insert old TERM ID ' . $original_term_id . ' as new TERM ID: ' . $new_term_id );
				} else if ( $terms[ $original_term_id ] != $new_term_id ) {
					$this->error( 'Replacement OLD TERM ID ' . $original_term_id . ' overwritten by new TERM ID: ' . $new_term_id );
				}
				$terms[ $original_term_id ] = $new_term_id;
				set_transient( 'importtermids', $terms, 60 * 60 * 24 );
			} else if ( $original_term_id && isset( $terms[ $original_term_id ] ) ) {
				return $terms[ $original_term_id ];
			}

			return false;
		}


		public function vc_post( $post_id = false ) {

			$vc_post_ids = get_transient( 'import_vc_posts' );
			if ( ! is_array( $vc_post_ids ) ) {
				$vc_post_ids = array();
			}
			if ( $post_id ) {
				$vc_post_ids[ $post_id ] = $post_id;
				set_transient( 'import_vc_posts', $vc_post_ids, 60 * 60 * 24 );
			} else {

				$this->log( 'Processing vc pages 2: ' );

				return;
				if ( class_exists( 'Vc_Manager' ) && class_exists( 'Vc_Post_Admin' ) ) {
					$this->log( $vc_post_ids );
					$vc_manager = Vc_Manager::getInstance();
					$vc_base    = $vc_manager->vc();
					$post_admin = new Vc_Post_Admin();
					foreach ( $vc_post_ids as $vc_post_id ) {
						$this->log( 'Save ' . $vc_post_id );
						$vc_base->buildShortcodesCustomCss( $vc_post_id );
						$post_admin->save( $vc_post_id );
						$post_admin->setSettings( $vc_post_id );
						//twice? bug?
						$vc_base->buildShortcodesCustomCss( $vc_post_id );
						$post_admin->save( $vc_post_id );
						$post_admin->setSettings( $vc_post_id );
					}
				}
			}

		}

		private function _imported_post_id( $original_id = false, $new_id = false ) {
			if ( is_array( $original_id ) || is_object( $original_id ) ) {
				return false;
			}
			$post_ids = get_transient( 'importpostids' );
			if ( ! is_array( $post_ids ) ) {
				$post_ids = array();
			}
			if ( $new_id ) {
				if ( ! isset( $post_ids[ $original_id ] ) ) {
					$this->log( 'Insert old ID ' . $original_id . ' as new ID: ' . $new_id );
				} else if ( $post_ids[ $original_id ] != $new_id ) {
					$this->error( 'Replacement OLD ID ' . $original_id . ' overwritten by new ID: ' . $new_id );
				}
				$post_ids[ $original_id ] = $new_id;
				set_transient( 'importpostids', $post_ids, 60 * 60 * 24 );
			} else if ( $original_id && isset( $post_ids[ $original_id ] ) ) {
				return $post_ids[ $original_id ];
			} else if ( $original_id === false ) {
				return $post_ids;
			}

			return false;
		}

		private function _post_orphans( $original_id = false, $missing_parent_id = false ) {
			$post_ids = get_transient( 'postorphans' );
			if ( ! is_array( $post_ids ) ) {
				$post_ids = array();
			}
			if ( $missing_parent_id ) {
				$post_ids[ $original_id ] = $missing_parent_id;
				set_transient( 'postorphans', $post_ids, 60 * 60 * 24 );
			} else if ( $original_id && isset( $post_ids[ $original_id ] ) ) {
				return $post_ids[ $original_id ];
			} else if ( $original_id === false ) {
				return $post_ids;
			}

			return false;
		}

		private function _cleanup_imported_ids() {
			// loop over all attachments and assign the correct post ids to those attachments.

		}

		private $delay_posts = array();

		private function _delay_post_process( $post_type, $post_data ) {
			if ( ! isset( $this->delay_posts[ $post_type ] ) ) {
				$this->delay_posts[ $post_type ] = array();
			}
			$this->delay_posts[ $post_type ][ $post_data['post_id'] ] = $post_data;

		}


		// return the difference in length between two strings
		public function cmpr_strlen( $a, $b ) {
			return strlen( $b ) - strlen( $a );
		}

		private function _parse_gallery_shortcode_content($content){
			// we have to format the post content. rewriting images and gallery stuff
			$replace      = $this->_imported_post_id();
			$urls_replace = array();
			foreach ( $replace as $key => $val ) {
				if ( $key && $val && ! is_numeric( $key ) && ! is_numeric( $val ) ) {
					$urls_replace[ $key ] = $val;
				}
			}
			if ( $urls_replace ) {
				uksort( $urls_replace, array( &$this, 'cmpr_strlen' ) );
				foreach ( $urls_replace as $from_url => $to_url ) {
					$content = str_replace( $from_url, $to_url, $content );
				}
			}
			if ( preg_match_all( '#\[gallery[^\]]*\]#', $content, $matches ) ) {
				foreach ( $matches[0] as $match_id => $string ) {
					if ( preg_match( '#ids="([^"]+)"#', $string, $ids_matches ) ) {
						$ids = explode( ',', $ids_matches[1] );
						foreach ( $ids as $key => $val ) {
							$new_id = $val ? $this->_imported_post_id( $val ) : false;
							if ( ! $new_id ) {
								unset( $ids[ $key ] );
							} else {
								$ids[ $key ] = $new_id;
							}
						}
						$new_ids                   = implode( ',', $ids );
						$content = str_replace( $ids_matches[0], 'ids="' . $new_ids . '"', $content );
					}
				}
			}
			// contact form 7 id fixes.
			if ( preg_match_all( '#\[contact-form-7[^\]]*\]#', $content, $matches ) ) {
				foreach ( $matches[0] as $match_id => $string ) {
					if ( preg_match( '#id="(\d+)"#', $string, $id_match ) ) {
						$new_id = $this->_imported_post_id( $id_match[1] );
						if ( $new_id ) {
							$content = str_replace( $id_match[0], 'id="' . $new_id . '"', $content );
						} else {
							// no imported ID found. remove this entry.
							$content = str_replace( $matches[0], '(insert contact form here)', $content );
						}
					}
				}
			}
			return $content;
		}

		private function _elementor_id_import( &$item, $key ) {
			if ( $key == 'id' && ! empty( $item ) && is_numeric( $item ) ) {
				// check if this has been imported before
				$new_meta_val = $this->_imported_post_id( $item );
				if ( $new_meta_val ) {
					$item = $new_meta_val;
				}
			}
			if ( $key == 'page' && ! empty( $item ) ) {

				if( false !== strpos( $item, "p." ) ){
					$new_id = str_replace('p.', '', $item);
					// check if this has been imported before
					$new_meta_val = $this->_imported_post_id( $new_id );
					if ( $new_meta_val ) {
						$item = 'p.' . $new_meta_val;
					}
				}else if(is_numeric($item)){
					// check if this has been imported before
					$new_meta_val = $this->_imported_post_id( $item );
					if ( $new_meta_val ) {
						$item = $new_meta_val;
					}
				}
			}
			if ( $key == 'post_id' && ! empty( $item ) && is_numeric( $item ) ) {
				// check if this has been imported before
				$new_meta_val = $this->_imported_post_id( $item );
				if ( $new_meta_val ) {
					$item = $new_meta_val;
				}
			}
			if ( $key == 'url' && ! empty( $item ) && strstr( $item, 'ocalhost' ) ) {
				// check if this has been imported before
				$new_meta_val = $this->_imported_post_id( $item );
				if ( $new_meta_val ) {
					$item = $new_meta_val;
				}
			}
			if ( ($key == 'shortcode' || $key == 'editor') && ! empty( $item ) ) {
				// we have to fix the [contact-form-7 id=133] shortcode issue.
				$item = $this->_parse_gallery_shortcode_content($item);

			}
		}


		private function _get_json( $file ) {
			if ( is_file( __DIR__ . '/content/' . basename( $file ) ) ) {
				WP_Filesystem();
				global $wp_filesystem;
				$file_name = __DIR__ . '/content/' . basename( $file );
				if ( file_exists( $file_name ) ) {
					return json_decode( $wp_filesystem->get_contents( $file_name ), true );
				}
			}

			return array();
		}

		private function _get_sql( $file ) {
			if ( is_file( __DIR__ . '/content/' . basename( $file ) ) ) {
				WP_Filesystem();
				global $wp_filesystem;
				$file_name = __DIR__ . '/content/' . basename( $file );
				if ( file_exists( $file_name ) ) {
					return $wp_filesystem->get_contents( $file_name );
				}
			}

			return false;
		}


		public $logs = array();

		public function log( $message ) {
			$this->logs[] = $message;
		}

		public $errors = array();

		public function error( $message ) {
			$this->logs[] = 'ERROR!!!! ' . $message;
		}


		/**
		 * Payments Step
		 */
		public function envato_setup_updates() {
			$this->process_form();
			?>
			<?php if ( etheme_is_activated() ): ?>
				<img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>success-icon.png" alt="eight theme" class="elogo">
				<h2>Thank you for activation</h2>
				<p>Now you have lifetime updates, 6 months of free top-notch support, 24/7 live support and more.</p>
					<p class="envato-setup-actions step">
						<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
						   class="et-button"><?php esc_html_e( 'Continue', 'xstore' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span>
						   <span class="et-loader">
	                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
	                </span></a>
						<?php wp_nonce_field( 'envato-setup' ); ?>
					</p>
			<?php else: ?>
				<h1><?php _e('Activate XStore', 'xstore'); ?></h1>
				<form method="post" class="activate-form">
                    <input type="text" name="purchase-code" placeholder="Example: f20b1cdd-ee2a-1c32-a146-66eafea81761" id="purchase-code" />
                    <input class="et-button no-loader et-button-green" name="xstore-purchase-code" type="submit" value="<?php esc_attr_e( 'Activate theme', 'xstore' ); ?>" />
                    <p>
                        <b><label for="form_agree">
                            <input id="form_agree" name="form_agree" type="checkbox"> <?php esc_attr_e('I agree that my purchase code and user data will be stored by', 'xstore') ?> 8theme.com
                        </label></b>
                    </p>
	            </form>
				<p><?php _e('Use your purchase code to activate XStore template. Please, note, that you won’t be able to use theme without activation.', 'xstore'); ?></p>
				<h3 class="h3"><?php _e('To find your Purchase code, please follow:', 'xstore'); ?></h3>

				<p class="purchase-code-bg"><a href="https://themeforest.net/downloads" target="blank"><?php esc_html_e('ThemeForest account', 'xstore'); ?></a><span class="dashicons dashicons-arrow-right-alt2"></span><a href="https://themeforest.net/downloads" target="blank"><?php esc_html_e('Downloads tab', 'xstore'); ?></a><span class="dashicons dashicons-arrow-right-alt2"></span><a href="https://themeforest.net/downloads" target="blank"><?php esc_html_e('Choose XStore', 'xstore'); ?></a><span class="dashicons dashicons-arrow-right-alt2"></span><a href="https://themeforest.net/downloads" target="blank"><?php esc_html_e('Download', 'xstore'); ?></a><span class="dashicons dashicons-arrow-right-alt2"></span><a href="https://themeforest.net/downloads" target="blank"><?php esc_html_e('License', 'xstore'); ?></a></p>
	            <p><a href="https://themeforest.net/downloads" target="blank"><img src="<?php echo ETHEME_CODE_IMAGES . 'purchase.jpg'; ?>" alt="purchase"></a></p>
	            <p class="et-message et-info last-item"><?php esc_html_e('A purchase code (license) is only valid for One Project. Do you want to use this theme for a one more project? Purchase a new license ', 'xstore'); ?> <a href="https://themeforest.net/item/xstore-responsive-woocommerce-theme/15780546?license=regular&open_purchase_for_item_id=8611976&purchasable=source&ref=8theme"><?php esc_html_e(' here', 'xstore'); ?></a><?php esc_html_e(' to get a new code.', 'xstore'); ?>
	            </p>
			<?php endif; ?>
			<?php
		}

		/**
		 * Payments Step save
		 */
		public function envato_setup_updates_save() {
			check_admin_referer( 'envato-setup' );

			// redirect to our custom login URL to get a copy of this token.
			$url = $this->get_oauth_login_url( $this->get_step_link( 'updates' ) );

			wp_redirect( esc_url_raw( $url ) );
			exit;
		}


		public function envato_setup_customize() {
		?>
			<h1><?php esc_html_e('Setup XStore Child Theme', 'xstore'); ?></h1>
	
			<p><?php esc_html_e('If you are planning to make any modifications in a theme source code, using Child theme is highly recommended. It will allow the parent theme to receive updates without overwriting   your source code changes.', 'xstore'); ?></p>
			<p class="et-message et-warning"><?php esc_html_e('Please, avoid changing the original theme HTML/CSS/PHP code.', 'xstore'); ?></p>

			<?php
				// Create Child Theme
				if(isset($_REQUEST['theme_name']) && isset($_REQUEST['theme_template']) && current_user_can('manage_options')){
					$this->_make_child_theme(esc_html($_REQUEST['theme_name']), esc_html($_REQUEST['theme_template'])); 
				}
				$theme = get_option('xstore_has_child') ? wp_get_theme(get_option('xstore_has_child') )->Name : 'XStore Child';
				$template = get_template();
			 ?>

			<?php if(!isset($_REQUEST['theme_name'])){ ?>

			<form action="<?php $_PHP_SELF ?>" method="POST">
				<div class="child-theme-input" style="margin-bottom: 20px;">
					 <label>Child Theme Title</label>
				 	 <input type="text" name="theme_name" value="<?php echo esc_attr($theme); ?>" />
			 	</div>
			 	<div class="child-theme-input" style="margin-bottom: 20px;">
					  <label>Parent Theme Template</label>
					  <input type="text" name="theme_template" value="<?php echo esc_attr($template); ?>" />
				</div>
			<p class="envato-setup-actions step">
				<a class="skip" href="<?php echo esc_url( $this->get_next_step_link() ); ?>"><?php _e( 'Skip this step', 'xstore' ); ?></a>
		        <button type="submit" id= type="submit" class="et-button button-active">
		        <span class="et-loader">
                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
                </span>
		         <?php _e( 'Create and Use Child Theme', 'xstore' ); ?>
		        </button>
			</p>
			</form>
			<?php } else { ?>
			<p class="envato-setup-actions step">
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="et-button button-active">
				<span class="et-loader">
                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
                </span>
                <?php _e( 'Continue', 'xstore' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span></a>
			</p>
			<?php } ?>
			<?php
		}

		public function system_requirements() {
		?>
			<h2><?php esc_html_e( 'System Requirements', 'xstore' ); ?></h2>
			<p class="et-message et-warning"><?php esc_html_e('Before using XStore, first of all, make certain that your server and WordPress meet theme\'s requirements. You can change them by yourself, or contact your hosting provider with a request to increase the following minimums.', 'xstore'); ?></p>

				<?php
					$system_requirements = new Etheme_System_Requirements();
					$system_requirements->html();
					$system = $system_requirements->get_system();
					$requirements = $system_requirements->get_requirements();
					$result = $system_requirements->result();
				?>

				<a href="" class="et-button et-button-grey last-button">
				<span class="et-loader">
                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
                </span>
                <?php echo esc_html('Check again', 'xstore'); ?></a>

				<p>
					<?php esc_html_e( 'Most  problems, such as white screen after theme installation, out of memory errors, fails when import demo content, etc., are usually related to server settings and excessively low PHP configuration limits.', 'xstore' ); ?>
				</p>

				<?php if( ($system['filesystem'] !== $requirements['filesystem']) || ($system['wp_remote_get'] !== $requirements['wp_remote_get']) || ($system['f_get_contents'] !== $requirements['f_get_contents']) ) : ?>
					<p class="et-message et-error">
						<?php echo esc_html__( 'Your system does not meet the server requirements. For more efficient result, we strongly recommend to contact your host provider and check the necessary settings.', 'xstore' ); ?>
					</p>

					<p class="envato-setup-actions step">
						<span class="et-button et-button-grey not-allowed no-loader"><?php esc_html_e( 'Continue', 'xstore' ); ?>
						<span class="et-loader">
	                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
	                </span>
	                 <span class="dashicons dashicons-arrow-right-alt2"></span></span>
						<?php wp_nonce_field( 'envato-setup' ); ?>
					</p>

				<?php else: ?>
					<p class="envato-setup-actions step">
						<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="et-button button-active"><?php esc_html_e( 'Continue', 'xstore' ); ?>
						<span class="et-loader">
	                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
	                </span>
	                 <span class="dashicons dashicons-arrow-right-alt2"></span></a>
						<?php wp_nonce_field( 'envato-setup' ); ?>
					</p>
				<?php endif;?>
		<?php
		}


		private function _make_child_theme( $new_theme_title, $new_theme_template ) {

				$parent_theme_title = 'XStore';
				$parent_theme_template = 'xstore';
				$parent_theme_name = get_stylesheet();
				$parent_theme_dir = get_stylesheet_directory();

				// Turn a theme name into a directory name
				$new_theme_name = sanitize_title( $new_theme_title );
				$theme_root = get_theme_root();

				// Validate theme name
				$new_theme_path = $theme_root.'/'.$new_theme_name;
				if ( file_exists( $new_theme_path ) ) {
					// Don't create child theme.
				} else{
					// Create Child theme
					wp_mkdir_p( $new_theme_path );

					$plugin_folder = get_template_directory().'/framework/thirdparty/envato_setup/child-theme/';

					// Make style.css
					ob_start();
					require $plugin_folder.'child-theme-css.php';
					$css = ob_get_clean();

					global $wp_filesystem;

			        if ( empty( $wp_filesystem ) ) {
			            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
			            WP_Filesystem();
			        }

					$wp_filesystem->put_contents( $new_theme_path.'/style.css', $css, FS_CHMOD_FILE );

					//file_put_contents( $new_theme_path.'/style.css', $css );

					// Copy functions.php 
					copy( $plugin_folder.'functions.php', $new_theme_path.'/functions.php' );
					
					// Copy screenshot
					copy( $plugin_folder.'screenshot.png', $new_theme_path.'/screenshot.png' );

					// Make child theme an allowed theme (network enable theme)
					$allowed_themes = get_site_option( 'allowedthemes' );
					$allowed_themes[ $new_theme_name ] = true;
					update_site_option( 'allowedthemes', $allowed_themes );
				}
				
				// Switch to theme
				if($parent_theme_template !== $new_theme_name){
					echo '<p class="lead success et-message">Child Theme <strong>'.$new_theme_title.'</strong> created and activated! Folder is located in <br/> wp-content/themes/<strong>'.$new_theme_name.'</strong></p>';
					update_option('xstore_has_child', $new_theme_name);
					switch_theme( $new_theme_name, $new_theme_name );
				}
		}

		/**
		 * Final step
		 */
		public function envato_setup_ready() {

			update_option( 'envato_setup_complete', time() );

			?>

			<img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>success-icon.png" alt="eight theme" class="elogo">
			<h1><?php esc_html_e( 'Congratulations, Your Website is Ready!', 'xstore' ); ?></h1>

			<p><?php echo sprintf( esc_html__('XStore theme has been installed on your website and ready to use. Go to your %s. Make all the necessary changes and upload your content.', 'xstore'), '<a href="' . esc_url(admin_url('admin.php?page=et-panel-welcome')) . '">' . esc_html__('WordPress dashboard', 'xstore') . '</a>' ); ?></p>

			<p>If you encounter any difficulties with our product we are ready to assist you via:</p>

			<ul class="support-blocks">
				<li>
					<a href="https://t.me/etheme" target="_blank">
						<img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>telegram.png">
						<span><?php esc_html_e( 'Telegram channel', 'xstore' ); ?></span>
					</a>
				</li>
				<li>
					<a href="https://www.8theme.com/forums/" target="_blank">
						<img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>support-icon.png">
						<span><?php esc_html_e( 'Support Forum', 'xstore' ) ?></span>
					</a>
				</li>
				<li>
					<a href="http://prntscr.com/d24xhu" target="_blank">
						<img src="<?php echo ETHEME_BASE_URI . ETHEME_CODE .'assets/images/'; ?>envato-icon.png">
						<span><?php esc_html_e( 'ThemeForest profile', 'xstore' ) ?></span>
					</a>
				</li>
			</ul>
	
			<div class="support-includes">
				<div class="includes">
					<p>Item Support includes:</p>
					<ul>
						<li>Answering technical questions</li>
						<li>Assistance with reported bugs and issues</li>
						<li>Help with bundled 3rd party plugins</li>
					</ul>
				</div>
				<div class="excludes">
					<p>Item Support <span class="red-color">DOES NOT</span> Include:</p>
					<ul>
						<li>Customization services</li>
						<li>Installation services</li>
						<li>Support for non-bundled 3rd party plugins. </li>
					</ul>
				</div>
			</div>

			<p><?php esc_html_e('XStore comes with 6 months item free support from purchase date (with the option to extend the support period). More details about item support can be found at ThemeForest', 'xstore');?> <a
					href="http://themeforest.net/page/item_support_policy" target="_blank"><?php esc_html_e('Item Support Policy', 'xstore'); ?></a>. </p>
			<p class="envato-setup-actions step">
				<?php if ( class_exists('WooCommerce')) { ?>
				<a class="et-button woo-button" href="<?php echo esc_url( admin_url( 'admin.php?page=wc-setup' ) ); ?>">
				<img src="<?php echo ETHEME_BASE_URI.'theme/assets/images/woo_label.png'; ?>" alt="woo_label" style="vertical-align: middle; max-width: 25px; margin-right: 3px;">
				<span class="et-loader">
                    <svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg>
                </span>
                <?php esc_html_e('Setup WooCommerce', 'xstore'); ?></a>
				<?php } ?>
				<a class="et-button no-loader" href="<?php echo home_url(); ?>" target="_blank"><img src="<?php echo ETHEME_BASE_URI.'theme/assets/images/Icon-white.png'; ?>" alt="icon-white" style="vertical-align: middle; max-width: 18px; margin-top: -3px; margin-right: 3px;"><?php esc_html_e( 'View your new website', 'xstore' ); ?></a>
			</p>


			<?php

		}

	

		/**
		 * @param $array1
		 * @param $array2
		 *
		 * @return mixed
		 *
		 *
		 * @since    1.1.4
		 */
		private function _array_merge_recursive_distinct( $array1, $array2 ) {
			$merged = $array1;
			foreach ( $array2 as $key => &$value ) {
				if ( is_array( $value ) && isset( $merged [ $key ] ) && is_array( $merged [ $key ] ) ) {
					$merged [ $key ] = $this->_array_merge_recursive_distinct( $merged [ $key ], $value );
				} else {
					$merged [ $key ] = $value;
				}
			}

			return $merged;
		}

		/**
		 * Helper function
		 * Take a path and return it clean
		 *
		 * @param string $path
		 *
		 * @since    1.1.2
		 */
		public static function cleanFilePath( $path ) {
			$path = str_replace( '', '', str_replace( array( '\\', '\\\\', '//' ), '/', $path ) );
			if ( $path[ strlen( $path ) - 1 ] === '/' ) {
				$path = rtrim( $path, '/' );
			}

			return $path;
		}

		public function is_submenu_page() {
			return ( $this->parent_slug == '' ) ? false : true;
		}


	    public function activate( $purchase, $args ) {
		    $data = array(
	            'api_key' => $args['token'],
	            'theme' => ETHEME_PREFIX,
	            'purchase' => $purchase,
	        );

	        foreach ( $args as $key => $value ) {
				$data['item'][$key] = $value;
	        }

	        update_option( 'envato_purchase_code_15780546', $purchase );
			update_option( 'etheme_activated_data', maybe_unserialize( $data ) );
        	update_option( 'etheme_is_activated', true );
	    }

	    public function get_api_key() {
	        $api_key = false;
	        $activated_data = get_option( 'etheme_activated_data' );
	        $stored = $activated_data['api_key'];
	        if( $stored && ! empty( $stored ) ) $api_key = $stored;
	        return $api_key;
	    }


	    public function get_stored_code() {
	        $code = false;

	        $stored = get_option( 'theme_purchase_code', false );

	        if( $stored ) $code = $stored;

	        return $code;
	    }

	    public function process_form() {
	        if( isset( $_POST['xstore-purchase-code'] ) && ! empty( $_POST['xstore-purchase-code'] ) ) {
	            $code = trim( $_POST['purchase-code'] );

	            if ( ! isset( $_POST['form_agree'] ) || $_POST['form_agree'] != 'on' ) {
	                echo  '<p class="et-message et-error">Oops, you should agree with data storage.</p>';
	                return;
	            }

	            if( empty( $code ) ) {
	               echo  '<p class="error et-message et-error">Oops, the code is missing, please, enter it to continue.</p>';
	                return;
	            }
				$theme_id = 15780546;
				$response = wp_remote_get( $this->api_url . 'activate/' . $code . '?envato_id='. $theme_id .'&domain=' .$this->domain() );

				if ( ! $response ) {
	                echo  '<p class="et-message et-error">API request call error. Can not connect to 8theme.com</p>';
	                return;
	            }

				$response_code = wp_remote_retrieve_response_code( $response );

	            if( $response_code != '200' ) {
	                echo  '<p class="et-message et-error">API request call error. Response code - <a href="https://en.wikipedia.org/wiki/List_of_HTTP_status_codes" target="_blank" rel="nofollow">' . $response_code . '</a></p>';
	                return;
	            }

	            $data = json_decode( wp_remote_retrieve_body($response), true );

	            if( isset( $data['error'] ) ) {
	               echo  '<p class="error et-message et-error">' . $data['error'] . '</p>';
	                return;
	            } 

	            if( ! $data['verified'] ) {
	               echo  '<p class="error et-message et-error">Sorry, the code is incorrect, try again.</p>';
	                return;
	            } 

	            $this->activate( $code, $data );

	        }
	    }

	    public function domain() {
	        $domain = get_option('siteurl'); //or home
	        $domain = str_replace('http://', '', $domain);
	        $domain = str_replace('https://', '', $domain);
	        $domain = str_replace('www', '', $domain); //add the . after the www if you don't want it
	        return urlencode($domain);
	    }


	}

}// if !class_exists

/**
 * Loads the main instance of Envato_Theme_Setup_Wizard to have
 * ability extend class functionality
 *
 * @since 1.1.1
 * @return object Envato_Theme_Setup_Wizard
 */
add_action( 'after_setup_theme', 'envato_theme_setup_wizard', 10 );
if ( ! function_exists( 'envato_theme_setup_wizard' ) ) :
	function envato_theme_setup_wizard() {
		Envato_Theme_Setup_Wizard::get_instance();
	}
endif;
