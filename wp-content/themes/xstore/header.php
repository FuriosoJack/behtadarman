<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php echo (is_customize_preview()) ? 'class="no-scrollbar"' : ''; ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<?php wp_head(); ?>
</head>
<?php $mode = etheme_get_option('dark_styles') ? 'dark' : 'light'; ?>
<body <?php body_class(); ?> data-mode="<?php echo esc_attr( $mode ); ?>">
<?php if ( function_exists('wp_body_open') ) { 
	wp_body_open(); 
} ?>
<?php do_action( 'et_after_body', true ); ?>

<div class="template-container">

	<?php
		/**
		 * Hook: etheme_header_before_template_content.
		 *
		 * @hooked etheme_top_panel_content - 10
		 * @hooked etheme_mobile_menu_content - 20
		 *
		 * @version 6.0.0 +
		 * @since 6.0.0 +
		 *
		 */
		do_action( 'etheme_header_before_template_content' );
	 ?>
	<div class="template-content">
		<div class="page-wrapper" data-fixed-color="<?php etheme_option( 'fixed_header_color' ); ?>">
			<?php 
			/**
			 * Hook: etheme_header.
			 *
			 * @hooked etheme_header_content - 10
			 *
			 * @version 6.0.0 +
			 * @since 6.0.0 +
			 *
			 */
			do_action( 'etheme_header' );
			do_action( 'etheme_header_mobile' );