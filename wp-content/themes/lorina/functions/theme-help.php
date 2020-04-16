<?php
/**
 * Theme help
 *
 * Adds a simple Theme help page to the Appearance section of the WordPress Dashboard.
 *
 * @package Lorina
 */

// Add Theme help page to admin menu.
add_action( 'admin_menu', 'lorina_add_theme_help_page' );

function lorina_add_theme_help_page() {

	// Get Theme Details from style.css
	$theme = wp_get_theme();

	/* translators: %1$s: theme name, %2$s: theme version. */
	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'lorina' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), esc_html__( 'Theme Help', 'lorina' ), 'edit_theme_options', 'lorina', 'lorina_display_theme_help_page'
	);
}

// Display Theme help page.
function lorina_display_theme_help_page() {

	// Get Theme Details from style.css.
	$theme = wp_get_theme();
	?>

	<div class="wrap theme-help-wrap">

		<h1><?php
			/* translators: %1$s: theme name, %2$s: theme version. */
			printf( esc_html__( 'Welcome to %1$s %2$s', 'lorina' ), $theme->get( 'Name' ) , $theme->get( 'Version' ) ); ?>
		</h1>

		<div class="theme-description"><?php echo esc_html( $theme->get( 'Description' ) ); ?></div>

		<hr>
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Theme Links', 'lorina' ); ?>:</strong>
				<a href="<?php echo esc_url( 'https://uxlthemes.com/theme/lorina/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'lorina' ); ?></a>
				<a href="<?php echo esc_url( 'https://uxlthemes.com/demo/?demo=lorina' ); ?>" target="_blank"><?php esc_html_e( 'Theme Demo', 'lorina' ); ?></a>
				<a href="<?php echo esc_url( 'https://uxlthemes.com/docs/lorina-theme/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'lorina' ); ?></a>
				<a href="<?php echo esc_url( 'https://uxlthemes.com/forums/forum/lorina/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Support', 'lorina' ); ?></a>
			</p>
		</div>
		<hr>

		<div id="getting-started">

			<h3><?php
				/* translators: %s: theme name. */
				printf( esc_html__( 'Getting Started with %s', 'lorina' ), $theme->get( 'Name' ) ); ?>
			</h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'lorina' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Do you need help to setup, configure and customize this theme? Check out the extensive theme documentation on our website.', 'lorina' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'https://uxlthemes.com/docs/lorina-theme/' ); ?>" target="_blank" class="button button-secondary">
								<?php
								/* translators: %s: theme name. */
								printf( esc_html__( 'View %s Documentation', 'lorina' ), $theme->get( 'Name' ) ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'lorina' ); ?></h4>

						<p class="about">
							<?php
							/* translators: %s: theme name. */
							printf( esc_html__( '%s makes use of the Customizer for the theme settings.', 'lorina' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( wp_customize_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Theme', 'lorina' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Upgrade', 'lorina' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Upgrade to Lorina Pro for even more cool features and customization options.', 'lorina' ) ; ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'https://uxlthemes.com/theme/lorina-pro/' ); ?>" target="_blank" class="button button-pro">
								<?php esc_html_e( 'GO PRO', 'lorina' ); ?>
							</a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" />

				</div>

			</div>

		</div>

		<hr>

		<div id="theme-author">

			<p>
				<?php /* translators: %1$s: theme name, %2$s: theme author, %3$s: link to theme review page. */
				printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'lorina' ),  $theme->get( 'Name' ) , '<a target="_blank" href="https://uxlthemes.com/">' . $theme->get( 'Author' ) . '</a>', '<a target="_blank" href="https://wordpress.org/support/theme/lorina/reviews/?filter=5">' . __( 'rate it', 'lorina' ) . '</a>' ); ?>
			</p>

		</div>

	</div>

	<?php
}

// Add CSS for Theme help Panel.
add_action( 'admin_enqueue_scripts', 'lorina_theme_help_page_css' );

function lorina_theme_help_page_css( $hook ) {

	// Load styles and scripts only on theme help page.
	if ( 'appearance_page_lorina' != $hook ) {
		return;
	}

	// Embed theme help css style.
	wp_enqueue_style( 'lorina-theme-help-css', get_template_directory_uri() . '/css/theme-help.css' );
}
