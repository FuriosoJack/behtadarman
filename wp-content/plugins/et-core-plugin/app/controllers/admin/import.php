<?php
namespace ETC\App\Controllers\Admin;

use ETC\App\Controllers\Admin\Base_Controller;

/**
 * Import controller.
 *
 * @since      1.4.5
 * @package    ETC
 * @subpackage ETC/Controller
 */
class Import extends Base_Controller {

    // ! Declare default variables
	private $_import_url = '';

	private $_widgets_counter = 0;

	private $_folder = '';

	private $_remote_folder = '';

	private $_version = '';

	private $_content = 'full';

	private $_all_widgets = array();

	public $versions = array();

        // ! Main construct/ setup variables
	public function hooks() {
		add_action( 'init', array( $this, 'init' ) );
	}

    /**
     * Add import init actions.
     *
     * Require files/add ajax actions callback.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    public function init() {
    	if( ! defined( 'ETHEME_THEME_SLUG' ) ) return;
    	$this->_import_url  = 'http://8theme.com/import/' . ETHEME_THEME_SLUG . '_versions/';
    	$this->_all_widgets = require apply_filters('etheme_file_url', ETHEME_THEME . 'widgets-import.php');
    	$this->versions     = require apply_filters('etheme_file_url', ETHEME_THEME . 'versions.php');

    	add_action('wp_ajax_etheme_import_ajax', array($this, 'import_data'));
    }

    /**
     * Import data router.
     *
     * Manage what data must be imported.
     *
     * @since   1.1.0
     * @version 1.1.3
     */
    public function import_data(){

    	$versions_imported = get_option('versions_imported');

    	if( empty( $versions_imported ) ) $versions_imported = array();

    	$xml_result = '';

    	if(!empty($_POST['version'])) {
    		$this->_version = $_POST['version'];
    	}

    	if( empty( $this->versions[ $this->_version ] ) ){
    		echo "wrong version";
    		die();
    	}



    	$to_import = $this->versions[ $this->_version ]['to_import'];


    	$this->_folder = ETHEME_THEME_DIR . 'assets/dummy/' . $this->_version . '/';
    	$this->_remote_folder = ETHEME_BASE_URI . 'theme/assets/dummy/' . $this->_version . '/';

    	do_action('et_before_data_import');

    	if ( isset($_POST['wizard']) && $_POST['wizard'] == 'true' ) {
    		$_POST['install']['value'] = $_POST['install'][0];
        }

        if ( isset( $to_import['single_product_builder'] ) ) {
           update_option( 'etheme_single_product_builder', true );
        }

    	switch ($_POST['type']) {
    		case 'xml':

    		if ( $_POST['install']['value'] != 'et_all' ) {

                if ( $_POST['engine'] == 'elementor' ) {
                    if ( $_POST['install']['value'] == 'pages' ) {
                        $_POST['install']['value'] = 'pages-elementor';
                    }

                    if ( $_POST['install']['value'] == 'posts' ) {
                        $_POST['install']['value'] = 'posts-elementor';
                    }

                    if ( $_POST['install']['value'] == 'static-blocks' ) {
                        $_POST['install']['value'] = 'static-blocks-elementor';
                    }

                    if ( $_POST['install']['value'] == 'products' ) {
                        $_POST['install']['value'] = 'products-elementor';
                    }
                    if ( $_POST['install']['value'] == 'projects' ) {
                        $_POST['install']['value'] = 'projects-elementor';
                    }

                    if ( $_POST['install']['value'] == 'media' ) {
                        $_POST['install']['value'] = 'media-elementor';
                    }
                }

    			$xml_result = $this->import_xml_file($_POST['install']['value'] . '.xml');
    		}


    		if ( $_POST['install']['value'] == 'products' ) {
    			$this->update_terms('brand');
    			$this->update_terms('product_cat');
    		}

    		break;
    		case 'options':
    		update_option( 'etheme_header_builder', true );

    		if ( in_array($this->_version, array('niche-market', 'eco-scooter') ) ) {
    			update_option('etheme_single_product_builder', true);
    		}

    		if( ! empty( $to_import['options'] ) ) {
    			$this->update_options();
    		}
    		break;


    		case 'slider':
    		if( ! empty( $to_import['slider'] ) ) {
    			for( $i = 0; $i < $to_import['slider']; $i++ ) {
    				$slider_result = $this->import_slider( $i );
    			}
    		}
    		break;


    		case 'home_page':
    		if( ! empty( $to_import['home_page'] ) ) {
    			$this->update_home_page();
    		}
    		break;

    		case 'widgets':
    		if( ! empty( $to_import['widgets'] ) ) {
    			$this->update_widgets();
    		}
    		break;


    		case 'menu':
    		$xml_result = $this->import_xml_file($_POST['install']['value'] . '.xml');
    		$this->update_menus();
    		break;


    		case 'fonts':
    		$this->import_custom_fonts();
                        // $xml_result = $this->import_xml_file($_POST['install']['value'] . '.xml');
                        // $this->update_menus();
    		break;

    		case 'variation_taxonomy':
    		$this->import_variation_taxonomy('product_variation_term');
                        // $xml_result = $this->import_xml_file($_POST['install']['value'] . '.xml');
                        // $this->update_menus();
    		break;


    		case 'variations_trems':
    		$this->import_variations_trems('product_variation_term');
                        // $xml_result = $this->import_xml_file($_POST['install']['value'] . '.xml');
                        // $this->update_menus();
    		break;


    		case 'variation_products':
    		$this->import_variation_products(3);
                        // $xml_result = $this->import_xml_file($_POST['install']['value'] . '.xml');
                        // $this->update_menus();
    		break;


            case 'et_multiple_headers':
                $this->import_multiple_conditions('et_multiple_headers', 'multiple_header_templates.json');
            break;

            case 'et_multiple_conditions':
                $this->import_multiple_conditions('et_multiple_conditions', 'multiple_header_conditions.json');
            break;

            case 'et_multiple_single_product':
                $this->import_multiple_conditions('et_multiple_single_product', 'multiple_single_product_templates.json');
            break;

            case 'et_multiple_single_product_conditions':
                $this->import_multiple_conditions('et_multiple_single_product_conditions', 'multiple_single_product_conditions.json');
            break;

            case 'elementor_globals':
                $this->import_elementor_globals();
            break;


    		case 'imported':
    		$versions_imported[] = $this->_version;
    		update_option('versions_imported', $versions_imported);
    		break;
    		default:
                    # code...
    		break;
    	}

    	do_action('et_after_data_import');



    	die();
    }

    /**
     * Import slider.
     *
     * Import revolution slider.
     *
     * @since   1.1.1
     * @version 1.1.0
     */
    public function import_slider( $i = 0 ) {

    	$zip_file = ( $i > 0 ) ? 'slider' . $i . '.zip' : 'slider.zip' ;

    	$activated_data = get_option( 'etheme_activated_data' );
    	$key = $activated_data['api_key'];

    	if( ! $key || empty( $key ) ) return false;

    	$slider_url = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $zip_file;

    	try {
    		$zip_file = download_url( $slider_url );
    	} catch( Exception $e ) {
    		return false;
    	}

    	if(!class_exists('RevSlider')) return;

    	$revapi = new \RevSlider();

    	ob_start();

    	$slider_result = $revapi->importSliderFromPost(true, true, $zip_file);

    	ob_end_clean();

    	return $slider_result;

    }

    /**
     * Import xml files.
     *
     * Use WordPress importer to do it.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    public function import_xml_file($file) {

    	ini_set( 'max_execution_time', 900 );

    	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
    		define( 'WP_LOAD_IMPORTERS' , true );
    	}

    	include ET_CORE_DIR . 'packages/wordpress-importer/wordpress-importer.php';

    	$result = false;

        // Load Importer API
    	require_once ABSPATH . 'wp-admin/includes/import.php';

    	$importerError = false;

        //check if wp_importer, the base importer class is available, otherwise include it
    	if ( !class_exists( 'WP_Importer' ) ) {
    		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
    		if ( file_exists( $class_wp_importer ) )
    			require_once($class_wp_importer);
    		else
    			$importerError = true;
    	}


    	if($importerError !== false) {
    		echo ("The Auto importing script could not be loaded. Please use the wordpress importer and import the XML file that is located in your themes folder manually.");
    		return;
    	}


    	if(class_exists('WP_Importer')) {


    		$folder = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $file;

    		$uploads = wp_get_upload_dir();


            // $version_xml = $folder.'/content-' . $this->_content . '.xml';

    		$version_data = wp_remote_get($folder);

    		$tmpxml = '';

    		if( ! is_wp_error($version_data)) {

    			$tmpxml = $uploads['basedir']. '/xstore-tmp-data.xml';

    			file_put_contents($tmpxml, $version_data['body']);

                // return $this->import_xml_file();

    		}

    		try {

    			ob_start();

    			add_filter( 'intermediate_image_sizes', array( $this, 'sizes_array') );

    			$file_url = $tmpxml;

                //$file_url = 'http://8theme.com/demo/xstore-versions/furniture/' . $file;

    			$importer = new \WP_Import();

    			$importer->fetch_attachments = true;

    			$importer->import($file_url);

    			$result = ob_get_clean();

    		} catch (Exception $e) {
    			$result = false;
    			echo ("Error while importing");
    		}

    	}

    	return $result;

    }

    /**
     * Image sizes.
     *
     * Setup image sizes.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    public function sizes_array( $sizes ) {
    	return array();
    }

    /**
     * Update menus.
     *
     * Force update menus in theme options.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    public function update_menus(){


    	$menus = array();

    	$menus['main_menu_term'] = wp_get_nav_menu_object( 'Main menu' );
    	$menus['main_menu_2_term'] = wp_get_nav_menu_object( 'Secondary menu' );
    	$menus['secondary_menu_term'] = wp_get_nav_menu_object( 'All departments' );
    	$menus['mobile_menu_term'] = ( wp_get_nav_menu_object( 'Mobile menu' ) ) ? wp_get_nav_menu_object( 'Main menu' ) : $menus['main_menu_term'];
    	$menus['header_vertical_menu_term'] = ( wp_get_nav_menu_object( 'Vertical menu' ) ) ? wp_get_nav_menu_object( 'Vertical menu' ) : $menus['main_menu_term'];


    	foreach ($menus as $key => $value) {
    		if ( isset( $value->term_id ) ) {
    			set_theme_mod( $key, $value->term_id );
    		}
    	}
    }

    /**
     * Update widgets.
     *
     * Create custom widget areas/ Create widgets.
     *
     * @since   1.1.0
     * @version 1.1.1
     */
    private function update_widgets() {

    	$widgets = 'http://8theme.com/import/xstore-versions-new-widgets/' . $this->_version . '/widgets.php';

    	$widgets = json_decode( file_get_contents( $widgets ), true );


        // We don't want to undo user changes, so we look for changes first.
    	$this->_active_widgets = get_option( 'sidebars_widgets' );

    	$this->_widgets_counter = 1;

    	if( ! empty( $widgets['custom-sidebars'] ) ) {
    		foreach ($widgets['custom-sidebars'] as $customsidebar) {
    			etheme_add_sidebar( $customsidebar );
    		}
    	}

    	foreach ($widgets['sidebar-widgets'] as $area => $params) {
    		if ( ! empty ( $this->_active_widgets[$area] ) && $params['flush'] ) {
    			$this->_flush_widget_area($area);
    		} else if(! empty ( $this->_active_widgets[$area] ) && ! $params['flush'] ) {
    			continue;
    		}
    		foreach ($params['widgets'] as $widget => $args) {
    			$this->_add_widget($area, $args['widget'], $args['args']);
    		}
    	}

        // Now save the $active_widgets array.
    	update_option( 'sidebars_widgets', $this->_active_widgets );

    }

    /**
     * Add widget.
     *
     * Create widgets.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    private function _add_widget( $sidebar, $widget, $options = array() ) {
    	$this->_active_widgets[ $sidebar ][] = $widget . '-' . $this->_widgets_counter;
    	$widget_content = get_option( 'widget_' . $widget );
    	$widget_content[ $this->_widgets_counter ] = $options;
    	update_option(  'widget_' . $widget, $widget_content );
    	$this->_widgets_counter++;
    }

    /**
     * Flush widget area.
     *
     * Flush widget area in area.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    private function _flush_widget_area( $area ) {
    	unset($this->_active_widgets[ $area ]);
    }

    /**
     * Update home page.
     *
     * Update show_on_front/page_on_front/page_for_posts.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    public function update_home_page() {
    	$blog_id = get_page_by_title('Blog');
    	$home_page = get_page_by_title('Home ' . str_replace('home-', '', $this->_version));
    	$pageid = $home_page->ID;
    	update_option( 'show_on_front', 'page' );
    	update_option( 'page_on_front', $pageid );
    	update_option( 'page_for_posts', $blog_id->ID );
    }

    /**
     * Update options.
     *
     * Update theme options by using set_theme_mod.
     *
     * @since   1.1.0
     * @version 1.1.0
     */
    public function update_options() {

    	$options_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/options.dat';

    	$new_options = wp_remote_get($options_file);

    	if( ! is_wp_error( $new_options ) ) {

    		$new_options = @unserialize( $new_options['body'] );

    		if ( isset($new_options['mods']) && is_array($new_options['mods'])) {

    			unset($new_options['mods']['0']);
    			unset($new_options['mods']['nav_menu_locations']);
    			unset($new_options['mods']['custom_css_post_id']);

    			foreach ( $new_options['mods'] as $key => $val ) {

    				if ( $key == 'footer_border_width' ) {
    					$val = intval($val);
    				}

                    // Save the mod.
    				set_theme_mod( $key, $val );
    			}
    		}
    	}
    }

    /**
     * Import custom fonts.
     *
     * Load font file and update it in wp_options.
     *
     * @since   1.5.1
     * @version 1.0.0
     */
    public function import_custom_fonts(){

    	$fonts = get_option( 'etheme-fonts', false );

    	if ( ! is_array( $fonts ) ) {
    		$fonts = array();
    	}

    	$remote_folder = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/';

    	$new_fonts = $remote_folder . 'fonts.json';
    	$new_fonts = file_get_contents( $new_fonts );
    	$new_fonts = json_decode( $new_fonts, true);

    	foreach ($new_fonts as $key => $value) {
    		$id  = array_search($value['id'], array_column($fonts, 'id'));

    		if ( $id !== false ) {
    			continue;
    		}

            // Get remote font
    		$file         = $value['file'];
    		$file['time'] = current_time( 'mysql' );
    		$remote_file  = $file['url'];
    		$content      = file_get_contents( $remote_file );
    		$uploads      = wp_get_upload_dir();

            // Setup right font folder
    		$time         = current_time( 'mysql' );
    		$y            = substr( $time, 0, 4 );
    		$m            = substr( $time, 5, 2 );
    		$subdir       = "/$y/$m";

    		$fonts_uploads = array(
    			'path'   => $uploads['basedir'] . '/custom-fonts' . $subdir,
    			'url'    => $uploads['baseurl'] . '/custom-fonts' . $subdir ,
    			'subdir' => '/custom-fonts' . $subdir,
    		);

            // Create custom fonts folder
    		$is_dir = is_dir( $fonts_uploads['path'] );
    		if ( ! $is_dir ) {
    			$resoult = wp_mkdir_p( $fonts_uploads['path'] );
    			if ( ! $resoult ){
    				return esc_html__( 'Can not create custom fonts folder', 'xstore-core' );
    			}
    		}

            // Put remote file content into the folder/ reset file url
    		if ( ! file_exists( $fonts_uploads['path'] . '/' . $file['name'] ) ) {
    			file_put_contents( $fonts_uploads['path'] . '/' . $file['name'], $content );
    		}
            $file['url'] = $fonts_uploads['url'] . '/' . $file['name'];
            
    		$value['file'] = $file;
    		$fonts[] = $value;
    	}

    	update_option( 'etheme-fonts', $fonts );
    }

    /**
     * Update brands.
     *
     * Update theme brands.
     *
     * @since   1.5.2
     * @version 1.0.0
     */
    public function update_terms($terms) {
        if ( $_POST['engine'] == 'elementor' ) {
            $remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $terms . 's-elementor.json';
        } else {
            $remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $terms . 's.json';
        }

    	$remote_data = json_decode( file_get_contents( $remote_file ), true );

    	if (! $remote_data ) {
    		return;
    	}

    	foreach ($remote_data as $key => $value) {
    		$term = get_term_by('slug', $value['term']['slug'], $terms);

    		if ( $term ) {
    			$id = $term->term_id;

                // Update brand parent
    			if ($value['term']['parent']) {

    				$parent = array_filter($remote_data,function($var) use ($value){
    					return( $var['term']['term_id'] == $value['term']['parent'] );
    				});

    				if ( $parent ) {
    					$parent = end($parent);
    					if ( $parent['term'] && $parent['term']['term_id'] ) {
    						$parent = get_term_by('slug', $parent['term']['slug'], $terms);
    						wp_update_term( $id, $terms, array(
    							'parent' => $parent->term_id,
    						));
    					}
    				}
    			}

                // Update brand thumbnail_id
    			if ($value['meta'] && $value['meta']['thumbnail_id'] && $value['meta']['thumbnail_id'][0] ) {
    				update_term_meta( $id, 'thumbnail_id', $value['meta']['thumbnail_id'][0] );
    			}

                // Update brand description
    			if ($value['term']['description']) {
    				wp_update_term( $id, $terms, array(
    					'description' => $value['term']['description'],
    				));
    			}

    			if ( $terms == 'product_cat' ) {
    				if (isset($value['meta']['_et_second_description']) && isset($value['meta']['_et_second_description'][0])) {
    					update_term_meta( $id, '_et_second_description', $value['meta']['_et_second_description'][0] );
    				}


    				if ($value['meta'] && isset($value['meta']['_et_page_heading_id']) && isset($value['meta']['_et_page_heading_id'][0] ) ) {
    					update_term_meta( $id, '_et_page_heading_id', $value['meta']['_et_page_heading_id'][0] );
    				}

    				if (
    					$value['meta'] && 
    					isset($value['meta']['_et_page_heading']) && 
    					isset($value['meta']['_et_page_heading'][0]) && 
    					isset($value['meta']['_et_page_heading_id']) && 
    					isset($value['meta']['_et_page_heading_id'][0] ) ) {
    					update_term_meta( $id, '_et_page_heading', wp_get_attachment_url($value['meta']['_et_page_heading_id'][0]) ) ;
    				}
    			}
    		}
    	};      
    }

    /**
     * import variation taxonomy.
     *
     * create taxonomy for product attributes.
     *
     * @since   1.5.3
     * @version 1.0.0
     */
    public function import_variation_taxonomy($terms){
    	$remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $terms . 's.json';
    	$remote_data = json_decode( file_get_contents( $remote_file ), true );

    	foreach ($remote_data as $taxonomie) {
    		$args = array(
    			'id'      => '',
    			'name'    => $taxonomie['taxonomie']['attribute_name'],
    			'label'   => $taxonomie['taxonomie']['attribute_label'],
    			'type'    => $taxonomie['taxonomie']['attribute_type'],
    			'orderby' => $taxonomie['taxonomie']['attribute_orderby'],
    			'public'  => false
    		);
    		wc_create_attribute( $args );
    	}
    }

    /**
     * import variation trems.
     *
     * create trems for product attributes.
     *
     * @since   1.5.3
     * @version 1.0.0
     */
    public function import_variations_trems($terms){
    	$remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $terms . 's.json';
    	$remote_data = json_decode( file_get_contents( $remote_file ), true );

    	foreach ($remote_data as $taxonomie) {
    		foreach ($taxonomie['taxonomie']['terms'] as $term) {
    			$args = array(
    				'description' => $term['term']['description'],
    				'parent'      => 0,
    				'slug'        => $term['term']['slug'],
    			);

    			$insert_data = wp_insert_term( $term['term']['name'], 'pa_' . $taxonomie['taxonomie']['attribute_name'], $args );

    			foreach ($term['meta'] as $key => $value) {
    				$swatches = array(
    					'st-color-swatch-sq',
    					'st-color-swatch',
    					'st-label-swatch-sq',
    					'st-label-swatch',
    					'st-image-swatch-sq',
    					'st-image-swatch'
    				);
    				if ( in_array($key, $swatches) ) {
    					update_term_meta( $insert_data['term_id'], $key, $value[0] );

    				}
    			}
    		}
    	}
    }


    /**
     * import products variations.
     *
     * create variations for products.
     *
     * @since   1.5.3
     * @version 1.0.0
     */
    public function import_variation_products($count){
    	$remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/data_product_variations.json';
    	$remote_data = json_decode( file_get_contents( $remote_file ), true );
    	$_i = 0;

    	foreach ($remote_data as $key => $value) {
    		if ( $_i == $count ) {
    			return;
    		}
    		$_i++;

    		$args = array(
    			'post_type'      => 'product',
    			'posts_per_page' => 1,
    			'post_name__in'  => array($key),
    			'fields'         => 'ids' 
    		);
    		$q  = get_posts( $args );
    		$id = $q[0];

    		foreach ($value as $variation) {
    			$attributes = array();

    			foreach ($variation['attributes'] as $attribute_key => $attribute) {
    				$attributes[str_replace( 'attribute_pa_', '', $attribute_key )] = $attribute;
    			}

    			$variation_data =  array(
    				'attributes' => $attributes,
                    // 'sku'           => $variation['sku'],
    				'regular_price' => $variation['display_regular_price'],
    				'sale_price'    => $variation['display_price'],
    				'stock_qty'     => $variation['max_qty'],
                    // 'stock' => $variation['is_in_stock'],
    				'image_id' => $variation['image_id'],

    			);
    			$this->create_product_variation( $id, $variation_data );
    		}
    	}
    }

    /**
     * import products variations.
     *
     * create variations for products.
     *
     * @since   1.5.3
     * @version 1.0.0
     */
    public function create_product_variation( $product_id, $variation_data ){
        // Get the Variable product object (parent)
    	$product = wc_get_product($product_id);

    	$variation_post = array(
    		'post_title'  => $product->get_title(),
    		'post_name'   => 'product-'.$product_id.'-variation',
    		'post_status' => 'publish',
    		'post_parent' => $product_id,
    		'post_type'   => 'product_variation',
    		'guid'        => $product->get_permalink()
    	);

    	$variation_id = wp_insert_post( $variation_post );
    	$variation    = new WC_Product_Variation( $variation_id );

    	foreach ($variation_data['attributes'] as $attribute => $term_name ){
    		$taxonomy = 'pa_'.$attribute; 

    		if( ! taxonomy_exists( $taxonomy ) ) {
    			register_taxonomy(
    				$taxonomy,
    				'product_variation',
    				array(
    					'hierarchical' => false,
    					'label'        => ucfirst( $attribute ),
    					'query_var'    => true,
    					'rewrite'      => array( 'slug' => sanitize_title($attribute) ), 
    				)
    			);
    		}

    		if( ! term_exists( $term_name, $taxonomy ) ) {
    			wp_insert_term( $term_name, $taxonomy ); 
    		}

    		$term_slug       = get_term_by('name', $term_name, $taxonomy )->slug; 
    		$post_term_names = wp_get_post_terms( $product_id, $taxonomy, array('fields' => 'names') );

    		if( ! in_array( $term_name, $post_term_names ) ){
    			wp_set_post_terms( $product_id, $term_name, $taxonomy, true );
    		}

    		update_post_meta( $variation_id, 'attribute_'.$taxonomy, $term_slug );
    	}

    	if( ! empty( $variation_data['sku'] ) ){
    		$variation->set_sku( $variation_data['sku'] );
    	}

    	if( empty( $variation_data['sale_price'] ) ){
    		$variation->set_price( $variation_data['regular_price'] );
    	} else {
    		$variation->set_price( $variation_data['sale_price'] );
    		$variation->set_sale_price( $variation_data['sale_price'] );
    	}
    	$variation->set_regular_price( $variation_data['regular_price'] );

    	if( ! empty($variation_data['stock_qty']) ){
    		$variation->set_stock_quantity( $variation_data['stock_qty'] );
    		$variation->set_manage_stock(true);
    		$variation->set_stock_status('');
    	} else {
    		$variation->set_manage_stock(false);
    	}

    	if ( ! empty( $variation_data['image_id'] ) ) {
    		$variation->set_image_id($variation_data['image_id']);
    	}

    	$variation->set_weight(''); 
    	$variation->save(); 
    }

    /**
     * import products variations.
     *
     * create variations for products.
     *
     * @since   2.2.1
     * @version 1.0.0
     */
    public function import_multiple_conditions($option,$file){
        $local = json_decode( get_option( $option ), true );
        if ( ! is_array($local) ) {
            $local = array();
        }

        $remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/' . $file;
        $remote_data = json_decode( file_get_contents( $remote_file ), true );

        foreach ($remote_data as $key => $value) {
            if ( ! isset( $local[$key] ) ) {
                $local[$key] = $value;
            } 
        }
        update_option( $option, json_encode($local) );
    }

    /**
     * import elementor globals.
     *
     * @since   2.3.0
     * @version 1.0.0
     */
    public function import_elementor_globals(){
        $remote_file = 'http://8theme.com/import/xstore-versions/' . $this->_version . '/elementor_defaults.json';
        $remote_data = json_decode( file_get_contents( $remote_file ), true );

        if ($remote_data) {
           foreach ($remote_data as $key => $value) {
               update_option( $key, $value );
           }
        }

        if (class_exists('CSS_Manager')) {
            $CSS_Manager = new CSS_Manager();
            $CSS_Manager->save_settings();
        }
    }

}