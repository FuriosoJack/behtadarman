<?php
/**
 *	Static Blocks Post Type 
 */

add_filter( 'etc/add/post/args', 'etc_add_posttype_static_blocks_args' );
function etc_add_posttype_static_blocks_args( $args ) {

	if( ! function_exists( 'etheme_get_option' ) || ! get_theme_mod( 'static_blocks', true ) ) {
		return $args;
	}

	$args[] = array(
		'register_name'      => 'staticblocks',
		'name'          	 => esc_html_x( 'Static Blocks', 'post type general name', 'xstore-core' ),
		'singular_name' 	 => esc_html_x( 'Block', 'post type singular name', 'xstore-core' ),
		'add_new'       	 => esc_html_x( 'Add New', 'static block', 'xstore-core' ),
		'add_new_item'  	 => sprintf( esc_html__( 'Add New %s', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'edit_item' 		 => sprintf( esc_html__( 'Edit %s', 'xstore-core' ),esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'new_item' 			 => sprintf( esc_html__( 'New %s', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'all_items' 		 => sprintf( esc_html__( 'All %s', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'view_item' 		 => sprintf( esc_html__( 'View %s', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'search_items'  	 => sprintf( esc_html__( 'Search %a', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'not_found' 		 => sprintf( esc_html__( 'No %s Found', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'not_found_in_trash' => sprintf( esc_html__( 'No %s Found In Trash', 'xstore-core' ), esc_html__( 'Static Blocks', 'xstore-core' ) ),
		'parent_item_colon'  => '',
		'menu_name' 		 => esc_html__( 'Static Blocks', 'xstore-core' ),
		'public' 			 => true,
		'publicly_queryable' => true,
		'show_ui' 			 => true,
		'show_in_menu' 		 => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'staticblocks' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'			 => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
		'menu_icon'          => 'dashicons-welcome-widgets-menus',
		'menu_position'      => 8,
		'show_in_rest'       => true,
	);

	return $args;
}

/**
 *	Portfolio Post Type 
 */
add_filter( 'etc/add/post/args', 'etc_add_posttype_portfolio_args' );
function etc_add_posttype_portfolio_args( $args ) {

	$slug  = get_option( 'portfolio_base' ) ? get_option( 'portfolio_base' ) : 'project';
	$slug .= get_option( 'portfolio_custom_base' );

	if( ! function_exists( 'etheme_get_option' ) || ! get_theme_mod( 'portfolio_projects', true ) ) {
		return $args;
	}

	$args[] = array(
		'register_name'      => 'etheme_portfolio',
		'name'               => esc_html_x( 'Projects', 'post type general name', 'xstore-core' ),
		'singular_name'      => esc_html_x( 'Project', 'post type singular name', 'xstore-core' ),
		'add_new'            => esc_html_x( 'Add New', 'project', 'xstore-core' ),
		'add_new_item'       => esc_html__( 'Add New Project', 'xstore-core' ),
		'edit_item'          => esc_html__( 'Edit Project', 'xstore-core' ),
		'new_item'           => esc_html__( 'New Project', 'xstore-core' ),
		'view_item'          => esc_html__( 'View Project', 'xstore-core' ),
		'search_items'       => esc_html__( 'Search Projects', 'xstore-core' ),
		'not_found'          => esc_html__( 'No projects found', 'xstore-core' ),
		'not_found_in_trash' => esc_html__( 'No projects found in Trash', 'xstore-core' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Portfolio',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title','editor','author','thumbnail','excerpt','comments'),
		'menu_icon'          => 'dashicons-images-alt2',
		'rewrite'            => array( 'slug' => $slug ),
		'show_in_rest'       => true,
		'slug'       		 => $slug,
		'taxonomies'         => array(
			array(
				'register_name'     => 'portfolio_category',
				'post_types'     	=> 'etheme_portfolio',
				'name'              => esc_html_x( 'Portfolio categories', 'taxonomy general name', 'xstore-core' ),
				'singular_name'     => esc_html_x( 'Portfolio category', 'taxonomy singular name', 'xstore-core' ),
				'search_items'      => esc_html__( 'Search types', 'xstore-core' ),
				'all_items'         => esc_html__( 'All categories', 'xstore-core' ),
				'parent_item'       => esc_html__( 'Parent category', 'xstore-core' ),
				'parent_item_colon' => esc_html__( 'Parent category:', 'xstore-core' ),
				'edit_item'         => esc_html__( 'Edit categories', 'xstore-core' ),
				'update_item'       => esc_html__( 'Update category', 'xstore-core' ),
				'add_new_item'      => esc_html__( 'Add new category', 'xstore-core' ),
				'new_item_name'     => esc_html__( 'New category name', 'xstore-core' ),
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => ( get_option( 'portfolio_cat_base' ) ) ? get_option( 'portfolio_cat_base' ) : 'portfolio-category' ),
			),
		),
	);

	return $args;
}

/**
 *	Testimonials Post Type 
 */
add_filter( 'etc/add/post/args', 'etc_add_posttype_testimonial_args' );
function etc_add_posttype_testimonial_args( $args ) {

	if( ! function_exists( 'etheme_get_option' ) || ! get_theme_mod( 'testimonials_type', true ) ) {
		return $args;
	}

	$args[] = array(
		'register_name'      => 'testimonials',
		'name'               => esc_html_x( 'Testimonials', 'post type general name', 'xstore-core' ),
		'singular_name'      => esc_html_x( 'Testimonial', 'post type singular name', 'xstore-core' ),
		'add_new'            => esc_html_x( 'Add New', 'testimonial', 'xstore-core' ),
		'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'xstore-core' ), esc_html__( 'Testimonial', 'xstore-core' ) ),
		'edit_item'          => sprintf( esc_html__( 'Edit %s', 'xstore-core' ), esc_html__( 'Testimonial', 'xstore-core' ) ),
		'new_item'           => sprintf( esc_html__( 'New %s', 'xstore-core' ), esc_html__( 'Testimonial', 'xstore-core' ) ),
		'all_items'          => sprintf( esc_html__( 'All %s', 'xstore-core' ), esc_html__( 'Testimonials', 'xstore-core' ) ),
		'view_item'          => sprintf( esc_html__( 'View %s', 'xstore-core' ), esc_html__( 'Testimonial', 'xstore-core' ) ),
		'search_items'       => sprintf( esc_html__( 'Search %a', 'xstore-core' ), esc_html__( 'Testimonials', 'xstore-core' ) ),
		'not_found'          => sprintf( esc_html__( 'No %s Found', 'xstore-core' ), esc_html__( 'Testimonials', 'xstore-core' ) ),
		'not_found_in_trash' => sprintf( esc_html__( 'No %s Found In Trash', 'xstore-core' ), esc_html__( 'Testimonials', 'xstore-core' ) ),
		'parent_item_colon'  => '',
		'menu_name'          => esc_html__( 'Testimonials', 'xstore-core' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-format-status',
		'show_in_rest'       => true,
		'taxonomies'         => array(
			array(
				'register_name'       => 'testimonial-category',
				'post_types'     	  => 'testimonials',
				'name'                => sprintf( esc_html_x( '%s', 'taxonomy general name', 'xstore-core' ), 'Categories' ),
				'singular_name'       => sprintf( esc_html_x( '%s', 'taxonomy singular name', 'xstore-core' ), 'Category' ),
				'search_items'        => sprintf( esc_html__( 'Search %s', 'xstore-core' ), 'Categories' ),
				'all_items'           => sprintf( esc_html__( 'All %s', 'xstore-core' ), 'Categories' ),
				'parent_item'         => sprintf( esc_html__( 'Parent %s', 'xstore-core' ), 'Category' ),
				'parent_item_colon'   => sprintf( esc_html__( 'Parent %s:', 'xstore-core' ), 'Category' ),
				'edit_item'           => sprintf( esc_html__( 'Edit %s', 'xstore-core' ), 'Category' ),
				'update_item'         => sprintf( esc_html__( 'Update %s', 'xstore-core' ), 'Category' ),
				'add_new_item'        => sprintf( esc_html__( 'Add New %s', 'xstore-core' ), 'Category'),
				'new_item_name'       => sprintf( esc_html__( 'New %s Name', 'xstore-core' ), 'Category' ),
				'menu_name'           => sprintf( esc_html__( '%s', 'xstore-core' ), 'Categories' ),
				'public'              => true, 
				'hierarchical'        => true, 
				'show_ui'             => true, 
				'show_admin_column'   => true,
				'query_var'           => true, 
				'show_in_nav_menus'   => false, 
				'show_tagcloud'       => false,
			),
		),
	);

	return $args;
}

/**
 *	Brand taxonomy 
 */
add_filter( 'etc/add/tax/args', 'etc_add_brand_taxonomies' );
function etc_add_brand_taxonomies( $args ) {

	$brand_slug = get_option( 'brand_custom_base' ) ? ( get_option( 'brand_custom_base' ) . '/' ): '';

	$brand_slug .= get_option( 'brand_base' ) ? get_option( 'brand_base' ) : 'brand';

	if( ! function_exists( 'etheme_get_option' ) || ! get_theme_mod( 'enable_brands', true ) ) {
		return $args;
	}

	$args[] = array(
		'register_name'     => 'brand',
		'post_types'     	=> 'product',
		'name'              => esc_html__( 'Brands', 'xstore-core' ),
		'singular_name'     => esc_html__( 'Brand', 'xstore-core' ),
		'search_items'      => esc_html__( 'Search Brands', 'xstore-core' ),
		'all_items'         => esc_html__( 'All Brands', 'xstore-core' ),
		'parent_item'       => esc_html__( 'Parent Brand', 'xstore-core' ),
		'parent_item_colon' => esc_html__( 'Parent Brand:', 'xstore-core' ),
		'edit_item'         => esc_html__( 'Edit Brand', 'xstore-core' ),
		'update_item'       => esc_html__( 'Update Brand', 'xstore-core' ),
		'add_new_item'      => esc_html__( 'Add New Brand', 'xstore-core' ),
		'new_item_name'     => esc_html__( 'New Brand Name', 'xstore-core' ),
		'menu_name'         => esc_html__( 'Brands', 'xstore-core' ),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => false,
		'post_types'        => 'product',
		'capabilities'			=> array(
			'manage_terms' 		=> 'manage_product_terms',
			'edit_terms' 		=> 'edit_product_terms',
			'delete_terms' 		=> 'delete_product_terms',
			'assign_terms' 		=> 'assign_product_terms',
		),
		'rewrite'           => array( 'slug' => $brand_slug ),
		'slug'       		=> $brand_slug
	);

	return $args;
}

