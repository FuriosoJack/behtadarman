<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Etheme_ajax_search.
 *
 * Return data for ajax search request.
 *
 * @since   1.4.3
 * @version 1.0.0
 * @var     $request {array} list of all $_REQUEST data.
 */

class Etheme_ajax_search {
	// ! Declare default variables
	public $request = array();

	// ! Main construct/ setup variables
    function __construct(){
        $this->request = $_REQUEST;
    }

    /**
     * Add actions.
     *
     * Actions for ajax search.
     *
     * @since   1.4.3
     * @version 1.0.0
     */
    public function actions(){
		add_action( 'wp_ajax_etheme_ajax_search', array( $this, 'search_results' ));
		add_action( 'wp_ajax_nopriv_etheme_ajax_search', array( $this, 'search_results' ));
    }

	/**
	 * Search for posts and pages.
	 *
	 * @since   1.4.3
     * @version 1.0.0
	 * @param   {array} $args Query args.
	 * @return  {array}       Posts.
	 */
	public function get_posts_results( $args ) {
	    $args['s'] = $this->request['query'];
	    return get_posts( http_build_query( $args ) );
	}

	/**
	 * Gets products based on the search type specified.
	 *
	 * @since   1.4.3
     * @version 1.0.0
	 * @param   {string} $type Type of search.
	 * @param   {array}  $args Query args.
	 * @return  {array}        Posts.
	 */
	public function get_products_results( $type, $args = array() ) {
	    global $woocommerce;
	    $order_by      = 'relevance';
	    $ordering_args = $woocommerce->query->get_catalog_ordering_args( $order_by, 'ASC' );
	    $defaults      = $args;
	    $visibility    = wc_get_product_visibility_term_ids();

	    $args['post_type']  = 'product';
	    $args['orderby']    = $ordering_args['orderby'];
	    $args['order']      = $ordering_args['order'];
	    $args['meta_query'] = WC()->query->get_meta_query(); // WPCS: slow query ok.
	    $args['tax_query']  = array(); // WPCS: slow query ok.

	    $args['tax_query'][] = array(
	        'taxonomy' => 'product_visibility',
	        'field'    => 'term_taxonomy_id',
	        'terms'    => $visibility['exclude-from-search'],
	        'operator' => 'NOT IN',
	    );

	    if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
	        $args['tax_query'][] = array(
	            'taxonomy' => 'product_visibility',
	            'field'    => 'term_taxonomy_id',
	            'terms'    => $visibility['outofstock'],
	            'operator' => 'NOT IN',
	        );
	    }

	    if ( isset( $this->request['product_cat'] ) && $this->request['product_cat'] && $this->request['product_cat'] !=='0') {
	        $args['tax_query'][] = array(
	            'taxonomy' => 'product_cat',
	            'field'    => 'slug',
	            'terms'    => esc_attr( $this->request['product_cat'] ),
	        );
	    }

	    switch ( $type ) {
	        case 'product':
	            $args['s'] = $this->request['query'];
	            break;
	        case 'sku':
	            $query                = $this->request['query'];
	            $args['s']            = '';
	            $args['post_type']    = array( 'product', 'product_variation' );
	            $args['meta_query'][] = array(
	                'key'   => '_sku',
	                'value' => $query,
	                'compare' => 'LIKE',
	            );
	            break;
	    }

	    return get_posts( http_build_query( $args ) );
	}

	/**
     * Search_results.
     *
     * etheme_ajax_search callback.
     * This function in "app/models/customizer/frontend/sctipts.js".
     *
     * @since   1.4.3
     * @version 1.0.0
     * @return  {json} array of suggestions for search
     */
	public function search_results() {
	    $query          = $this->request['query'];
	    $products       = array();
	    $posts          = array();
	    $pages          = array();
	    $portfolio          = array();
	    $sku_products   = array();
	    $suggestions    = array();
	    $results        = array();
        $search_options = Kirki::get_option( 'search_results_content_et-desktop' );
        $search_sku     = Kirki::get_option( 'search_by_sku_et-desktop' );

        if ( !class_exists('WooCommerce') ) $search_options = array_diff($search_options, array('products'));

	    $args = array(
	        's'                   => $query,
	        'orderby'             => '',
	        'post_type'           => array(),
	        'post_status'         => 'publish',
	        'posts_per_page'      => 100,
	        'ignore_sticky_posts' => 1,
	        'post_password'       => '',
	        'suppress_filters'    => false,
	    );

	    if ( in_array( 'products', $search_options ) ) {
	        $products     = $this->get_products_results( 'product', $args );
	        if ( $search_sku ) {
	        	$sku_products = $this->get_products_results( 'sku', $args );
	        }
	    }

	    if ( in_array( 'posts', $search_options ) ) {
	    	$args['post_type'] = 'post';
	        $posts = $this->get_posts_results( $args );
	    }

		if ( in_array( 'pages', $search_options ) ) {
	        $args['post_type'] = 'page';
	        $pages = $this->get_posts_results( $args );
		}

		if ( in_array( 'portfolio', $search_options ) ) {
	        $args['post_type'] = 'etheme_portfolio';
	        $portfolio = $this->get_posts_results( $args );
		}

		$products = array_merge( $products, $sku_products );

		foreach ( $search_options as $key => $value ) {
			switch ( $value ) {
				case 'products':
					$results = array_merge( $results, $products );
					break;
				case 'posts':
					$results = array_merge( $results, $posts );
					break;
				case 'pages':
					$results = array_merge( $results, $pages );
					break;
				case 'portfolio':
					$results = array_merge( $results, $portfolio );
					break;
			}
		}

	    foreach ( $results as $key => $post ) {
	        if ( in_array( $post->post_type, array( 'product', 'product_variation' ) ) ) {
	            $product       = wc_get_product( $post );
	            $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ) );

	            $suggestions[] = array(
	                'type'  => 'Product',
	                'id'    => $product->get_id(),
	                'value' => $product->get_title(),
	                'url'   => $product->get_permalink(),
	                'img'   => ( $product_image[0] ) ? $product_image[0] : wc_placeholder_img_src( 'woocommerce_thumbnail' ),
	                'arrow' => '<svg version="1.1" class="arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M99.1186676,94.8567734L10.286458,6.0255365h53.5340881c1.6616173,0,3.0132561-1.3516402,3.0132561-3.0127683
	S65.4821625,0,63.8205452,0H3.0137398c-1.6611279,0-3.012768,1.3516402-3.012768,3.0127683v60.8068047
	c0,1.6616135,1.3516402,3.0132523,3.012768,3.0132523s3.012768-1.3516388,3.012768-3.0132523V10.2854862L94.8577423,99.117691
	C95.4281311,99.6871109,96.1841202,100,96.9886856,100c0.8036041,0,1.5595856-0.3128891,2.129982-0.882309
	C100.2924805,97.9419327,100.2924805,96.0305862,99.1186676,94.8567734z"></path></svg>',
	                'price' => $product->get_price_html(),
	                'date'  => '',
	            );
	        } elseif( in_array( $post->post_type, array( 'page', 'post', 'etheme_portfolio' ) ) ) {
	            $suggestions[] = array(
	                'type'  => ucfirst( str_replace( array('page', 'post', 'etheme_portfolio'), array('Pages', 'Posts', 'Portfolio'), $post->post_type) ),
	                'id'    => $post->ID,
	                'value' => get_the_title( $post->ID ),
	                'url'   => get_the_permalink( $post->ID ),
	                'img'   => get_the_post_thumbnail_url( $post->ID, 'thumbnail' ),
	                'arrow' => '<svg version="1.1" class="arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M99.1186676,94.8567734L10.286458,6.0255365h53.5340881c1.6616173,0,3.0132561-1.3516402,3.0132561-3.0127683
	S65.4821625,0,63.8205452,0H3.0137398c-1.6611279,0-3.012768,1.3516402-3.012768,3.0127683v60.8068047
	c0,1.6616135,1.3516402,3.0132523,3.012768,3.0132523s3.012768-1.3516388,3.012768-3.0132523V10.2854862L94.8577423,99.117691
	C95.4281311,99.6871109,96.1841202,100,96.9886856,100c0.8036041,0,1.5595856-0.3128891,2.129982-0.882309
	C100.2924805,97.9419327,100.2924805,96.0305862,99.1186676,94.8567734z"></path></svg>',
	                'price' => '',
	                'date'  => get_the_date( '', $post->ID ),
	            );
	        }
	    }

	    $suggestions = $this->parse_suggestions( $products, $suggestions );

	    wp_send_json( array( 'suggestions' => $suggestions ) );
	}


	/**
	 * Parse suggestions
	 *
	 * Parse products suggestions to prevent it duplication.
	 *
	 * @since   1.4.3
     * @version 1.0.0
	 * @param   {array} $results     Search results.
	 * @param   {array} $suggestions Unparsed suggestions.
	 * @return  {array}              Unique(parsed) suggestions.
	 */
	public function parse_suggestions( $results = array(), $suggestions = array() ) {
	    $results         = array_map( function ( $n ) { return $n ? true : false; }, $results );
	    $needs_filtering = count( array_filter( $results ) ) > 1;

	    if ( $needs_filtering ) {
	        $suggestions = array_map( 'unserialize', array_unique( array_map( 'serialize', $suggestions ) ) );
	    }

	    return $suggestions;
	}
}

$Etheme_ajax_search = new Etheme_ajax_search();
$Etheme_ajax_search -> actions();