<?php

get_header();

if ( 'page' == get_option( 'show_on_front' ) ) {
?>

	<div id="primary" class="content-area full-width">
		<main id="main" class="site-main" role="main">

		<?php
		if ( get_theme_mod( 'woo_home_enable' ) ) {
			if ( class_exists( 'WooCommerce' ) ) {
				lorina_home_woo_section();
			} else {
				lorina_home_nonwoo_section();
			}
		} else {
			lorina_homepage_content();
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

<?php
} else {

	get_template_part( 'home' );

}
?>