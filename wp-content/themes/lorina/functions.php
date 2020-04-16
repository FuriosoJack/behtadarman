<?php
/**
 * Lorina functions and definitions
 *
 * @package Lorina
 */

if ( ! function_exists( 'lorina_setup' ) ) :

//Sets up theme defaults and registers support for various WordPress features

function lorina_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'lorina', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Support for WooCommerce
	add_theme_support( 'woocommerce', array(
		'product_grid' => array(
			'min_columns' => 2,
			'max_columns' => 8,
		),
	) );

	//Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'lorina' ),
		'footer' => esc_html__( 'Footer Menu', 'lorina' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for post formats
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',
	) );

	// Set up the WordPress core custom background feature
	add_theme_support( 'custom-background', apply_filters( 'lorina_custom_background_args', array(
		'default-color' => 'fcfcfc',
		'default-image' => '',
	) ) );

	// Enable support for Custom Logo
	add_theme_support( 'custom-logo', array(
		'width'		=> '',
		'height'	=> '',
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Enable support for widgets selective refresh
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Style the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', lorina_editor_fonts_url() ) );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Support for Gutenberg (5.0+ block editor)
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', lorina_custom_color_palette() );

	// https://jetpack.com/support/infinite-scroll/
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer' => false,
	) );

}
endif; // lorina_setup
add_action( 'after_setup_theme', 'lorina_setup' );

function lorina_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lorina_content_width', 1160 );
}
add_action( 'after_setup_theme', 'lorina_content_width', 0 );

// Set up the WordPress core custom header feature
function lorina_custom_header_setup() {
	register_default_headers( array(
		'woman' => array(
			'url'           => '%s/images/header-image.jpg',
			'thumbnail_url' => '%s/images/header-image-thumbnail.jpg',
			'description'   => esc_html__( 'Photographer: Capucine Moda', 'lorina' ),
		),
		'beach' => array(
			'url'           => '%s/images/header-image-2.jpg',
			'thumbnail_url' => '%s/images/header-image-2-thumbnail.jpg',
			'description'   => esc_html__( 'Photographer: Flo Dahm', 'lorina' ),
		),
		' 	aromatherapy' => array(
			'url'           => '%s/images/header-image-3.jpg',
			'thumbnail_url' => '%s/images/header-image-3-thumbnail.jpg',
			'description'   => esc_html__( 'Photographer: Marina Pershina', 'lorina' ),
		)
	) );

	add_theme_support( 'custom-header', apply_filters( 'lorina_custom_header_args', array(
		'default-image'			=> get_template_directory_uri().'/images/header-image.jpg',
		'default-text-color'	=> '414141',
		'header_text'			=> true,
		'width'					=> '1920',
		'height'				=> '600',
		'flex-height'			=> false,
		'flex-width'			=> false,
		'wp-head-callback'		=> '',
	) ) );
}
add_action( 'after_setup_theme', 'lorina_custom_header_setup' );

// Enables the Excerpt meta box in Page edit screen
function lorina_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'lorina_add_excerpt_support_for_pages' );

// Register widget area
function lorina_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'lorina' ),
		'id'            => 'lorina-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'lorina' ),
		'id'            => 'lorina-sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="page-sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'lorina' ),
		'id'            => 'lorina-sidebar-shop',
		'description'   => esc_html__( 'Requires WooCommerce plugin.', 'lorina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="shop-sidebar-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Filters', 'lorina' ),
		'id'            => 'lorina-sidebar-shop-filters',
		'description'   => esc_html__( 'Horizontal widget area for product archives. Requires WooCommerce plugin.', 'lorina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="shop-filters-widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar', 'lorina' ),
		'id'            => 'lorina-top-bar',
		'description'   => esc_html__( 'Add your own content above the header.', 'lorina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="top-bar-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Offers Bar', 'lorina' ),
		'id'            => 'lorina-offers-bar',
		'description'   => esc_html__( 'Add your own content below the site masthead.', 'lorina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="offers-bar-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Slider/Hero Section', 'lorina' ),
		'id'            => 'lorina-homepage-large-area',
		'description'   => esc_html__( 'The large image/hero/slider area below the masthead on the homepage. Add more than one Image Widget to automatically create a slider.', 'lorina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="hero-widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer', 'lorina' ),
		'description'   => esc_html__( 'Full width area above the footer columns.', 'lorina' ),
		'id'            => 'lorina-above-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="above-footer-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'lorina' ),
		'id'            => 'lorina-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'lorina' ),
		'id'            => 'lorina-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'lorina' ),
		'id'            => 'lorina-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

}
add_action( 'widgets_init', 'lorina_widgets_init' );

if ( ! function_exists( 'lorina_fonts_url' ) ) :
/**
 * Register Google fonts for Lorina
 * @return string Google fonts URL for the theme
 */
function lorina_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'lorina' ) ) {

		$fonts[] = get_theme_mod( 'font_site_title', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );
		$fonts[] = get_theme_mod( 'font_nav', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );
		$fonts[] = get_theme_mod( 'font_content', 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
		$fonts[] = get_theme_mod( 'font_headings', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );

		$fonts = str_replace('Arial, Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Impact, Charcoal, sans-serif', '', $fonts);
		$fonts = str_replace('"Lucida Sans Unicode", "Lucida Grande", sans-serif', '', $fonts);
		$fonts = str_replace('Tahoma, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('"Trebuchet MS", Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Verdana, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('Georgia, serif', '', $fonts);
		$fonts = str_replace('"Palatino Linotype", "Book Antiqua", Palatino, serif', '', $fonts);
		$fonts = str_replace('"Times New Roman", Times, serif', '', $fonts);

	}

	$fonts = array_filter( $fonts );

	if ( empty( $fonts ) ) {
		$google_fonts_empty = 1;
	} else {
		$google_fonts_empty = 0;
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'lorina' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $google_fonts_empty == 0 ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode( '|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
		return esc_url_raw($fonts_url);
	} else {
		return;
	}
}
endif;

if ( ! function_exists( 'lorina_editor_fonts_url' ) ) :
/**
 * Register Google fonts for Lorina
 * @return string Google fonts URL for the tinyMCE editor
 */
function lorina_editor_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'lorina' ) ) {

		$fonts[] = get_theme_mod( 'font_site_title', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );
		$fonts[] = get_theme_mod( 'font_nav', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );
		$fonts[] = get_theme_mod( 'font_content', 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
		$fonts[] = get_theme_mod( 'font_headings', 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i' );

		$fonts = str_replace('Arial, Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Impact, Charcoal, sans-serif', '', $fonts);
		$fonts = str_replace('"Lucida Sans Unicode", "Lucida Grande", sans-serif', '', $fonts);
		$fonts = str_replace('Tahoma, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('"Trebuchet MS", Helvetica, sans-serif', '', $fonts);
		$fonts = str_replace('Verdana, Geneva, sans-serif', '', $fonts);
		$fonts = str_replace('Georgia, serif', '', $fonts);
		$fonts = str_replace('"Palatino Linotype", "Book Antiqua", Palatino, serif', '', $fonts);
		$fonts = str_replace('"Times New Roman", Times, serif', '', $fonts);

	}

	$fonts = array_filter( $fonts );

	if ( empty( $fonts ) ) {
		$google_fonts_empty = 1;
	} else {
		$google_fonts_empty = 0;
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'lorina' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $google_fonts_empty == 0 ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode( '|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
		return esc_url_raw($fonts_url);
	} else {
		return;
	}
}
endif;

/**
 * Enqueue scripts and styles.
 */
function lorina_scripts() {
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array( 'jquery' ), '4.1.2', true );
	wp_enqueue_script( 'lorina-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'lorina-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );
	wp_enqueue_style( 'lorina-fonts', lorina_fonts_url(), array(), null );
	wp_enqueue_style( 'lorina-fontawesome', get_template_directory_uri() . '/fontawesome/css/all.min.css' );
	wp_enqueue_style( 'lorina-bx-slider', get_template_directory_uri() . '/css/bx-slider.css' );
	wp_enqueue_style( 'lorina-style', get_stylesheet_uri() );
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'lorina-customize-preview', get_template_directory_uri() . '/css/customize-preview.css' );
	}
	wp_add_inline_style( 'lorina-style', lorina_dynamic_style() );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lorina_scripts' );

/**
 * Enqueue scripts and styles for Block Editor.
 */
function lorina_enqueue_gutenberg_block_editor_assets() {
	wp_enqueue_style( 'lorina-block-editor-fonts', lorina_editor_fonts_url() );
	wp_enqueue_style( 'lorina-block-editor-style', get_template_directory_uri() . '/css/block-editor-style.css' );
	wp_add_inline_style( 'lorina-block-editor-style', lorina_block_editor_dynamic_style() );
}
add_action( 'enqueue_block_editor_assets', 'lorina_enqueue_gutenberg_block_editor_assets' );

/**
 * Custom block editor color palette.
 */
if ( !function_exists( 'lorina_custom_color_palette' ) ) {
	function lorina_custom_color_palette() {
		return array(
			array(
				'name' => __( 'Custom color 1', 'lorina' ),
				'slug' => 'custom-color-1',
				'color' => get_theme_mod( 'color1', '#faeded' ),
			),
			array(
				'name' => __( 'Custom color 2', 'lorina' ),
				'slug' => 'custom-color-2',
				'color' => get_theme_mod( 'color2', '#e08b8b' ),
			),
			array(
				'name' => __( 'Default text - very dark grey', 'lorina' ),
				'slug' => 'very-dark-grey',
				'color' => '#414141',
			),
			array(
				'name' => __( 'Default background - very light grey', 'lorina' ),
				'slug' => 'very-light-grey',
				'color' => '#fcfcfc',
			),
			array(
				'name' => __( 'Pale pink', 'lorina' ),
				'slug' => 'pale-pink',
				'color' => '#f78da7'
			),
			array(
				'name' => __( 'Vivid red', 'lorina' ),
				'slug' => 'vivid-red',
				'color' => '#cf2e2e',
			),
			array(
				'name' => __( 'Luminous vivid orange', 'lorina' ),
				'slug' => 'luminous-vivid-orange',
				'color' => '#ff6900',
			),
			array(
				'name' => __( 'Luminous vivid amber', 'lorina' ),
				'slug' => 'luminous-vivid-amber',
				'color' => '#fcb900',
			),
			array(
				'name' => __( 'Light green cyan', 'lorina' ),
				'slug' => 'light-green-cyan',
				'color' => '#7bdcb5',
			),
			array(
				'name' => __( 'Vivid green cyan', 'lorina' ),
				'slug' => 'vivid-green-cyan',
				'color' => '#00d084',
			),
			array(
				'name' => __( 'Pale cyan blue', 'lorina' ),
				'slug' => 'pale-cyan-blue',
				'color' => '#8ed1fc',
			),
			array(
				'name' => __( 'Vivid cyan blue', 'lorina' ),
				'slug' => 'vivid-cyan-blue',
				'color' => '#0693e3',
			),
			array(
				'name' => __( 'Vivid purple', 'lorina' ),
				'slug' => 'vivid-purple',
				'color' => '#9b51e0',
			),
			array(
				'name' => __( 'Very light gray', 'lorina' ),
				'slug' => 'very-light-gray',
				'color' => '#eeeeee',
			),
			array(
				'name' => __( 'Cyan bluish gray', 'lorina' ),
				'slug' => 'cyan-bluish-gray',
				'color' => '#abb8c3',
			),
			array(
				'name' => __( 'Very dark gray', 'lorina' ),
				'slug' => 'very-dark-gray',
				'color' => '#313131',
			),
		);
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/functions/template-tags.php';

/**
 * Custom functions.
 */
require get_template_directory() . '/functions/extras.php';
require get_template_directory() . '/functions/style-output.php';
require get_template_directory() . '/functions/header-title.php';
require get_template_directory() . '/functions/fonts.php';
require get_template_directory() . '/functions/icons.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/functions/customizer-controls.php';
require get_template_directory() . '/functions/customizer.php';

/**
 * Theme help page.
 */
if ( is_admin() ) {
	require get_template_directory() . '/functions/theme-help.php';
}

if ( !function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
