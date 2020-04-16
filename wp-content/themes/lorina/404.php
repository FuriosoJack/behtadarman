<?php
/**
 * The template for displaying 404 page
 *
 * @package Lorina
 */

get_header();
?>

	<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'lorina' ); ?></p>

	<p><?php esc_html_e( 'Maybe try a search?', 'lorina' ); ?> <?php get_search_form(); ?></p>

	<p><?php esc_html_e( 'Browse our pages.', 'lorina' ); ?></p>
	<ul>
	<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
	</ul>		

<?php get_footer(); ?>
