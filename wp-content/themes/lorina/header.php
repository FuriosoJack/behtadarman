<?php
/**
 * The theme header.
 *
 * @package Lorina
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lorina' ); ?></a>
<?php
	if ( get_theme_mod( 'sticky_footer' ) ) {
		$page_class = ' class="sticky-footer"';
	} else {
		$page_class = '';
	}
?>
<div id="page"<?php echo $page_class; ?>>

	<header id="masthead" class="site-header">

		<?php if ( is_active_sidebar( 'lorina-top-bar' ) ) : ?>
		<div id="top-bar">
			<div class="container">
				<?php dynamic_sidebar( 'lorina-top-bar' ); ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="container">
		<?php lorina_header_content(); ?>
		<?php lorina_header_menu(); ?>
		</div>

		<?php if ( is_active_sidebar( 'lorina-offers-bar' ) ) : ?>
		<div id="site-usp" class="clearfix">
			<div class="container">
				<?php dynamic_sidebar( 'lorina-offers-bar' ); ?>
			</div>
		</div>
		<?php endif; ?>

	</header><!-- #masthead -->

<?php if ( is_front_page() && 'page' == get_option( 'show_on_front' ) && is_active_sidebar( 'lorina-homepage-large-area' ) ) { ?>
	<div id="hero-above-wrapper"></div>
	<div id="home-hero-section" class="clearfix">
		<?php dynamic_sidebar( 'lorina-homepage-large-area' ); ?>
	</div>
<?php } else {
	lorina_header_title();
	}?>

	<div id="content" class="site-content clearfix">
		<div class="container clearfix">
