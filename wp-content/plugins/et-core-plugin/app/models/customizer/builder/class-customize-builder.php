<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Etheme Customize Builders.
 *
 * Add builders to Wordpress Customizer.
 * Enqueue style, sctipts and templates.
 * Declare callbacks for builders ajax functions.
 * Save and load data for presets.
 * Generate siple elements html.
 *
 * @since   1.0.0
 * @version 1.4.9
 * @var     $elements {array} list of all builder elements.
 * @var     $presets  {array} list of all presets to import/export.
 * @var     $post     {array} list of all $_POST data.
 */
class Etheme_Customize_header_Builder {

    // ! Declare default variables
    public $elements = array();
    public $presets  = array();
    public $post     = array();


    // ! Main construct/ setup variables
    function __construct(){
        $this->post = $_POST;
        $this->elements = require( ET_CORE_DIR . 'app/models/customizer/builder/elements.php' );
    }


    /**
     * Add builder actions.
     *
     * Actions to add builder template, scripts and ajax action to Wordpress Customizer.
     *
     * @since   1.4.4
     * @version 1.0.2
     */
    public function actions(){
        if ( is_admin() ) {
            // ! Add scripts and templates
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts' ) );

            // ! Add callbacks for ajax actions
            add_action( 'wp_ajax_et_ajax_popup', array( $this, 'et_ajax_popup' ) );
            add_action( 'wp_ajax_et_ajax_get_element', array( $this, 'et_ajax_get_element' ) );
            add_action( 'wp_ajax_et_ajax_get_presets', array( $this, 'et_ajax_get_presets' ) );
            add_action( 'wp_ajax_et_ajax_template', array( $this, 'template' ) );
            add_action( 'wp_ajax_et_ajax_switch_default', array( $this, 'switch_default' ) );
            add_action( 'wp_ajax_et_ajax_get_remote_preset', array( $this, 'et_ajax_get_remote_preset' ) );

            // ! Add callbacks for multiple headers/conditions ajax actions
            add_action( 'wp_ajax_et_ajax_multiple', array( $this, 'et_ajax_multiple' ) );
            add_action( 'wp_ajax_et_ajax_conditions_data', array( $this, 'et_ajax_conditions_data' ) );
            add_action( 'wp_ajax_et_ajax_conditions_actions', array( $this, 'et_ajax_conditions_actions' ) );
            add_action( 'wp_ajax_et_ajax_builder', array( $this, 'et_ajax_builder' ) );

            add_action( 'customize_controls_print_footer_scripts', array( $this, 'etheme_builders_ajax_notices' ) );
        } else {
            add_action('wp_head', array($this, 'et_multiple_headers'), 99 );
            add_action('wp_head', array($this, 'et_multiple_single_product'), 100 );

        }
    }

    /**
     * Ajax notices for builders
     *
     * @since   1.5.4
     * @version 1.0.0
     */
    public function etheme_builders_ajax_notices() {
        $notices = require_once( ET_CORE_DIR . 'app/models/customizer/builder/ajax-notices.php' );
        echo '<script type="text/html" id="etheme_ajax-notices">' . json_encode($notices) . '</script>';
    }

    /**
     * Add script and styles to Wordpress Customizer
     *
     * @since   1.0.0
     * @version 1.0.1
     */
    public function scripts() {
        wp_enqueue_style( 'builder',  ET_CORE_URL . 'app/models/customizer/builder/css/builder.css', array('etheme_admin_css') );

        wp_enqueue_script('etheme-builder', ET_CORE_URL . 'app/models/customizer/builder/js/builder.min.js', array(
            'customize-controls',
            'jquery-ui-resizable',
            'jquery-ui-droppable',
            'jquery-ui-draggable',
        ));
    }

    /**
     * Get remote preset
     *
     * @since   1.4.1
     * @version 1.0.0
     */
    public function et_ajax_get_remote_preset(){
        $url  = 'http://8theme.com/import/xstore-headers/';
        $url  = $url . $this->post['preset']  .'.json';
        $data = file_get_contents( $url );
        $data = json_encode( $data );
        echo $data;
        die();
    }

    /**
     * Get presets data.
     *
     * et_set_presets() callback.
     * This function in "framework/builder/js/builder.js".
     * Get data from preset files located in "framework/builder/presets".
     *
     * @since   1.0.0
     * @version 1.0.0
     * @return  {string} presets structure and settings on json string
     */
    public function et_ajax_get_presets(){
        $file = $this->post['preset'] . '.json';

        if ( isset( $this->post['header-for-version'] ) ) {
            $file = $this->post['preset'] . '.options.json';
            $url  = ET_CORE_DIR . 'app/models/customizer/builder/headers/' . $file;
        } else {
            $url  = ET_CORE_DIR . 'app/models/customizer/builder/presets/' . $file;
        }

        $data = file_get_contents( $url );
        $data = json_decode( $data, true );
        $this->post['template'] = 'header';
        $data['template'] = $this->template( $data );
        $data = json_encode( $data );
        echo $data;
        die();
    }

    /**
     * Return elements html.
     *
     * et_connect_block.removeAllInside() callback.
     * This function in "framework/builder/js/builder.js".
     *
     * @since   1.0.0
     * @version 1.0.0
     * @return  {html} html of element
     */
    public function et_ajax_get_element(){
        $elements = array();
        $html     = '';
        if ( $this->post['elements'] == 'product-column' ) {
            $args = array(
                'id'     => $this->post['id'],
                'index'  => $this->post['index'],
                'sticky' => $this->post['sticky']
            );
            $html .= $this->generate_html( $args, 'product-column' );
        } else {
            if ( $this->post['elements'] && count( $this->post['elements'] ) ) {       
                foreach ($this->post['elements'] as $key => $value) {
                    $elements[$key] = $this->elements[$key];
                }

                foreach ($elements as $key => $value){
                    $args = array(
                        'id'       => $this->generate_random( 5 ),
                        'element'  => $key,
                        'icon'     => $value['icon'],
                        'title'    => $value['title'],
                        'section'  => $value['section'],
                        'section2' => ( isset( $value['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$value['section2'].'"><span class="mt-mes">'.esc_html__( 'Dropdown settings', 'xstore-core' ).'</span></span>' : '',
                        'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                    );

                    $html .= $this->generate_html( $args );
                }
            }
        }

        echo $html;
        die();
    }

    /**
     * Return popup html.
     *
     * et_connect_block.popup() callback.
     * This function in "framework/builder/js/builder.js".
     *
     * @since   1.0.0
     * @version 1.0.0
     * @return  {html} html of connect_block popup
     */
    public function et_ajax_popup(){
        require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/popup-connect-block.php' );
        die();
    }

    /**
     * Get builder template.
     *
     * Used to display builder html.
     * et_ajax_get_presets() callback when load preset.
     * This function in "framework/builder/js/builder.js".
     *
     * @since   1.0.0
     * @version 1.0.0
     * @return  {html} html of builder templates
     */
    public function template( $ajax = false ) {
        ob_start();
            add_filter( 'Etheme_Customize_Builder_ajax', function($type) use ($ajax){ return $ajax; } );

            switch ( $this->post['template'] ) {
                case 'header':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/header.php' );
                    break;
                case 'popup-headers':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/popup-headers.php' );
                    break;
                case 'popup-headers-mob':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/popup-headers-mob.php' );
                    break;
                case 'popup-presets':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/popup-presets.php' );
                    break;
                case 'popup-preset':
                    if ( isset( $this->post['type'] ) && $this->post['type'] == 'edit' ) {
                        $preset_id = $this->post['id'];
                        add_filter( 'popup_preset_type', function($type){ return 'edit'; } );
                        add_filter( 'popup_preset_id', function($id) use ($preset_id){ return $preset_id; } );
                    }
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/popup-preset.php' );
                    break;
                case 'presets-custom':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/presets-custom.php' );
                    break;
                case 'multiple-section':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/multiple-section.php' );
                    break;
                case 'multiple-headers':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/multiple-headers.php' );
                    break;
                case 'multiple-condition':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/multiple-condition.php' );
                    break;
                case 'product-single':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/product-single.php' );
                    break;
                case 'product-archive':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/product-archive.php' );
                    break;
                case 'popup-section-options':
                    require_once( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/popup-section-options.php' );
                    break;
                default:
                    # code...
                    break;
            }
        if ( $ajax ) {
            return ob_get_clean();
        }
        die();
    }

    /**
     * Multiple headers
     *
     * Setup Multiple headers for frontend.
     *
     * @since   1.4.4
     * @version 1.0.0
     * @return  {boolean} false or nothing.
     */
    public function et_multiple_headers(){
        if ( is_customize_preview() ) {
           return false;
        }

        $headers   = $this->get_json_option('et_multiple_headers');
        $condition = $this->get_current_condition();
        if ( count( $condition ) ) {
            $condition = end( $condition );
            if ( isset( $headers[$condition['header']] ) ) {
                $opt = $headers[$condition['header']];
                $this->set_theme_mods($opt['options'], 'header');
            }
        }
    }

    /**
     * Multiple single product
     *
     * Setup Multiple headers for frontend.
     *
     * @since   1.5.0
     * @version 1.0.0
     * @return  {boolean} false or nothing.
     */
    public function et_multiple_single_product(){
        if ( is_customize_preview() ) {
           return false;
        }

        $headers   = $this->get_json_option('et_multiple_single_product');
        $condition = $this->get_current_condition_single_product();
        if ( count( $condition ) ) {
            $condition = end( $condition );
            if ( isset( $headers[$condition['header']] ) ) {
                $opt = $headers[$condition['header']];
                $this->set_theme_mods($opt['options'], 'single-product');
            }
        }
    }

    /**
     * Get current condition single product
     *
     * Filter conditions and return page custom header condition.
     *
     * @since   1.5.0
     * @version 1.0.0
     * @return  {array} current conditions data.
     */
    public function get_current_condition_single_product(){
        $condition  = array();
        if ( class_exists('WooCommerce') && is_product() ) {

            $conditions = $this->get_json_option( 'et_multiple_single_product_conditions' );
            $condition = array_filter( $conditions, function($var){
                if ( is_array($var['primary']) && isset( $var['primary']['post_type'] ) && $var['third'] != '' ) {
                    return( $var['primary']['post_type'] == get_post_type( get_the_ID() ) && $var['third'] == get_the_ID() );
                }
            });

            if ( ! count($condition) ) {
                $condition = array_filter( $conditions,function($var){
                    if ( is_array($var['primary']) && isset( $var['primary']['post_type'] ) && $var['third'] != '' && $var['primary']['type'] == 'in' ) {
                        $isd = wp_get_post_terms( get_the_ID(), $var['primary']['slug'], array('fields' => 'ids'));
                        return( $var['primary']['post_type'] == get_post_type( get_the_ID() ) && in_array($var['third'], $isd) );
                    }
                });
            }

            if ( ! count($condition) ) {
                $condition = array_filter($conditions,function($var){
                    return( $var['primary']['type'] == 'all' && $var['primary']['slug'] != 'in_product' );
                });
            }

        }
        return $condition;
    }

    /**
     * Get current condition
     *
     * Filter conditions and return page custom header condition.
     *
     * @since   1.4.4
     * @version 1.0.1
     * @return  {array} current conditions data.
     */
    public function get_current_condition(){
        $condition  = array();
        $conditions = $this->get_json_option( 'et_multiple_conditions' );

        if ( is_singular() ) {
            $condition = array_filter( $conditions,  function($var){
                return($var['primary'] == 'singular');
            });

            $condition = array_filter( $condition, function($var){
                if ( is_array($var['secondary']) && isset( $var['secondary']['post_type'] ) && $var['third'] != '' ) {
                    return( $var['secondary']['post_type'] == get_post_type( get_the_ID() ) && $var['third'] == get_the_ID() );
                }
            });

            if ( ! count($condition) ) {
                $condition = array_filter( $conditions,function($var){
                    if ( is_array($var['secondary']) && isset( $var['secondary']['post_type'] ) && $var['third'] != '' && $var['secondary']['type'] == 'in' ) {
                        $isd = wp_get_post_terms( get_the_ID(), $var['secondary']['slug'], array('fields' => 'ids'));
                        return( $var['secondary']['post_type'] == get_post_type( get_the_ID() ) && in_array($var['third'], $isd) );
                    }
                });
            }

            if ( ! count($condition) ) {
                $condition = array_filter($conditions,function($var){
                    if ( is_array($var['secondary']) && isset( $var['secondary']['post_type'] ) && $var['third'] == '' ) {
                        return( $var['secondary']['post_type'] == get_post_type( get_the_ID() ) );
                    }
                });
            }

            if ( ! count($condition) && is_front_page() ) {
                $condition = array_filter($conditions,function($var){
                    return( $var['secondary'] == 'front_page' );
                });
            }

            if ( ! count($condition) && is_attachment() ) {
                $condition = array_filter($conditions, function($var){
                return( $var['secondary'] == 'attachment' );
                });
            }

            if ( ! count($condition) ) {
                $condition = array_filter($conditions,function($var){
                    return( $var['secondary'] == 'all_singular' );
                });
            }
        } elseif( is_404() ){
            $condition = array_filter( $conditions,  function($var){
                return( $var['secondary'] == 'not_found' );
            });
        } elseif( is_archive() ) {

            $condition = array_filter( $conditions,  function($var){
                return($var['primary'] == 'archives');
            });

            $condition = array_filter( $condition, function($var){
                if ( is_array($var['secondary']) && isset( $var['secondary']['type'] ) && $var['third'] != '' ) {
                    return( $var['secondary']['type'] == 'taxonomy' && is_tax($var['secondary']['slug'], $var['third']) );
                }
            });

            if ( ! count($condition) && is_category() ) {
                $condition = array_filter( $conditions,  function($var){
                    if ( is_array($var['secondary']) && isset( $var['secondary']['type'] ) && $var['secondary']['post_type'] == 'post' && $var['third'] != '' ) {
                        return( is_category($var['third']) );
                    }
                });
            }

            if ( ! count($condition) && is_tag() ) {
                $condition = array_filter( $conditions,  function($var){
                    if ( is_array($var['secondary']) && isset( $var['secondary']['type'] ) && $var['secondary']['post_type'] == 'post' && $var['third'] != '' ) {
                        return( is_tag($var['third']) );
                    }
                });
            }

            if ( ! count($condition) && is_author() ) {
                $condition = array_filter( $conditions,  function($var){
                    return($var['secondary'] == 'author');
                });
            }

            if ( ! count($condition) && ( is_day() || is_month() || is_year() ) ) {
                $condition = array_filter( $conditions,  function($var){
                    return($var['secondary'] == 'date');
                });
            }

            if ( ! count($condition) && is_search() ) {
                $condition = array_filter( $conditions,  function($var){
                    return($var['secondary'] == 'search');
                });
            }

            if ( ! count($condition) ) {
                $condition = array_filter( $conditions,  function($var){
                    if ( is_array($var['secondary']) && isset( $var['secondary']['type'] ) && $var['secondary']['type'] == 'post_type_archive') {
                        return( is_post_type_archive($var['secondary']['post_type']) );
                    }
                });
            }

            if ( ! count($condition) ) {
                $condition = array_filter($conditions,function($var){
                    return( $var['secondary'] == 'all_archives' );
                });
            }

            if ( ! count($condition) ) {
                $condition = array_filter( $conditions,  function($var){
                    if ( is_array($var['secondary']) && isset( $var['secondary']['type'] ) && $var['third'] == '' ) {
                        return( $var['secondary']['type'] == 'taxonomy' && is_tax($var['secondary']['slug']) );
                    }
                });
            }
        }

        $page          = (array) get_query_var('et_page-id');
        $page_id       = (int) $page['id'];
        $posts_page_id = (int) get_option( 'page_for_posts' );
        $wc_shop_page_id = ( function_exists('wc_get_page_id') ) ? wc_get_page_id('shop') : false;

        if ( $page_id === $posts_page_id ) {
            if ( ! count($condition) ) {
                $condition = array_filter($conditions,function($var){
                    $page          = (array) get_query_var('et_page-id');
                    $page_id       = $page['id'];
                    return( ( !is_array($var['secondary']) && $var['secondary'] == 'all_archives' ) || $var['third'] == $page_id );
                });
            }
        }
        elseif ( $wc_shop_page_id && $page_id === $wc_shop_page_id ) {
            if ( ! count($condition) ) {
                $condition = array_filter($conditions,function($var){
                    $page          = (array) get_query_var('et_page-id');
                    $page_id       = $page['id'];
                    return( $var['third'] == $page_id );
                });
            }
        }
        return $condition;
    }

    /**
     * Setup theme mods
     *
     * Setup header options for a current page based on it condition.
     *
     * @since   1.4.4
     * @version 1.0.2
     * @param   {array} $data Header options for a current condition.
     */
    public function set_theme_mods($data, $type){
        foreach ($data as $key => $value) {         
            if ( in_array( $key, array('header_socials_package_et-desktop', 'contacts_package_et-desktop', 'promo_text_package') ) ) {
                if ( ! is_array($value) ) {
                    $value = json_decode(urldecode($value), true);
                }
            }

            if ( ! in_array( $key, array('header_top_elements', 'header_main_elements', 'header_bottom_elements', 'connect_block_package','header_mobile_top_elements','header_mobile_main_elements','header_mobile_bottom_elements','connect_block_mobile_package') ) ) {

                if ( strpos($key, 'fonts_et-desktop') ) {
                    if ( ! empty( $value['font-family'] ) ) {
                        $value['font-family'] = str_replace( '\\', '', $value['font-family'] );
                        $etheme_fonts = get_option( 'etheme-fonts', false );
                        if ( is_array( $etheme_fonts ) && array_search( str_replace('"', '', $value['font-family']), array_column( $etheme_fonts, 'name') ) === false ) {
                            if ( ! isset( $value['font-weight'] ) ) {
                                $value['font-weight'] = '';
                            }
                            $family = $value['font-family'] . ':' . $value['font-weight'] . '|' . $value['font-family'] . ':' . $value['variant'];
                            if ( ! in_array( $value['font-family'], array( 'initial', 'inherit' ) ) ) {
                                $this->enqueue_google_fonts( $family, str_replace( ' ', '', $value['font-family'] ) );
                            }
                        }
                    }
                }

                add_filter( "theme_mod_" . $key, function($current_mod) use ($value){
                    if ( $value == 'false' ){
                        $value = false;
                    } elseif ( $value == 'true' ){
                        $value = true;
                    }
                    return $value;
                } );
            }
            
        }
                
        if ( $type == 'header' ) {
             add_filter( 'theme_mod_connect_block_package', function($current_mod) use ($data){
            return json_decode(base64_decode($data['connect_block_package']), true);
            } );

            add_filter( 'theme_mod_connect_block_mobile_package', function($current_mod) use ($data){
                return json_decode(base64_decode($data['connect_block_mobile_package']), true);
            } );

            add_filter( 'theme_mod_header_top_elements', function($current_mod) use ($data){
                return base64_decode($data['header_top_elements']);
            } );
            add_filter( 'theme_mod_header_main_elements', function($current_mod) use ($data){
                return base64_decode($data['header_main_elements']);
            } );
            add_filter( 'theme_mod_header_bottom_elements', function($current_mod) use ($data){
                return base64_decode($data['header_bottom_elements']);
            } );
            add_filter( 'theme_mod_header_mobile_top_elements', function($current_mod) use ($data){
                return base64_decode($data['header_mobile_top_elements']);
            } );
            add_filter( 'theme_mod_header_mobile_main_elements', function($current_mod) use ($data){
                return base64_decode($data['header_mobile_main_elements']);
            } );
            add_filter( 'theme_mod_header_mobile_bottom_elements', function($current_mod) use ($data){
                return base64_decode($data['header_mobile_bottom_elements']);
            } );
        } elseif($type == 'single-product'){
            add_filter( 'theme_mod_product_single_elements', function($current_mod) use ($data){
                return base64_decode($data['product_single_elements']);
            } );
            add_filter( 'theme_mod_connect_block_product_single_package', function($current_mod) use ($data){
                return json_decode(base64_decode($data['connect_block_product_single_package']), true);
            } );
        }
    }

    /**
     * Enqueue google fonts
     *
     * @since   2.0.1
     * @version 1.0.0
     * @param   {string} $family args for wp_register_style() function.
     * @param   {string} $handle font name.
     */
    public function enqueue_google_fonts($family, $handle) {
        $query_args = array(
            'family' => $family
        );

        $handle = 'et-multiple-google-fonts-' . $handle;

        wp_register_style( 
            $handle, 
            add_query_arg( $query_args, '//fonts.googleapis.com/css' ), 
            array(), 
            null 
        );
        wp_enqueue_style( $handle );
    }

    /**
     * Get builder template
     *
     * Ajax action for import export.
     * etThemeBuilder.etPresets.import_export() callback.
     * This functions in "framework/builder/js/builder.js".
     *
     * @since   1.4.4
     * @version 1.0.0
     * @return  {json} string with data needed for action.
     */
    public function et_ajax_builder(){
        $this->post['template'] = 'header';
        $options = array_merge( $this->post['options'] , $this->decode_special_options( $this->post['options'] ) );
        $data['builder'] = $this->template( $options );
        echo json_encode( $data );
        die();
    }
  
    /**
     * Multiple ajax actions 
     *
     * Ajax actions for header part of multiple headers.
     * etThemeBuilder.etMultipleHeaders.et_headers_actions(), etThemeBuilder.etMultipleHeaders.et_load() callbacks.
     * This functions in "framework/builder/js/builder.js".
     * Callbacks for add/save/edit/configurate/remove actions.
     *
     * @since   1.5.1
     * @version 1.0.2
     * @return  {json} string with data needed for action.
     */
    public function et_ajax_multiple(){
        if (  $this->post['builder'] == 'header' ) {
            $headers = $this->get_json_option('et_multiple_headers');
        } elseif( $this->post['builder'] == 'single-product' ){
            $headers = $this->get_json_option('et_multiple_single_product');
        }

        switch ( $this->post['type'] ) {
            case 'add':
                $id = $this->generate_random( 5 );
                $headers[$id]['title'] = $this->post['header'];
                $headers[$id]['options'] = $this->post['options'];

                $headers[$id]['options']['html_block1'] =  base64_decode( $this->post['options']['html_block1'] );
                $headers[$id]['options']['html_block2'] =  base64_decode( $this->post['options']['html_block2'] );
                $headers[$id]['options']['html_block3'] =  base64_decode( $this->post['options']['html_block3'] );

               

                //'html_block3', 'html_block2', 'html_block1'

                break;
            case 'save':
                $headers[$this->post['header']]['options'] = $this->post['options'];

                $headers[$this->post['header']]['options']['html_block1'] =  base64_decode( $this->post['options']['html_block1'] );
                $headers[$this->post['header']]['options']['html_block2'] =  base64_decode( $this->post['options']['html_block2'] );
                $headers[$this->post['header']]['options']['html_block3'] =  base64_decode( $this->post['options']['html_block3'] );

                if (  $this->post['builder'] == 'header' ) {
                    $options = get_option('et_multiple_headers_old', false);
                } elseif( $this->post['builder'] == 'single-product' ){
                    $options = get_option('et_multiple_single_product_old', false);
                }

                if (  $this->post['builder'] == 'header' ) {
                    $this->post['template'] = 'header';
                } elseif( $this->post['builder'] == 'single-product' ){
                    $this->post['template'] = 'product-single';
                }

                $data['builder'] = $this->template( $options );
                $data['options'] = $options;
                break;
            case 'edit':
                $header          = $headers[$this->post['header']];
                $data['options'] = $header['options'];
                $data['options'] = array_merge( $header['options'] , $this->decode_special_options( $header['options'] ) );

                 if (  $this->post['builder'] == 'header' ) {
                    $this->post['template'] = 'header';
                } elseif( $this->post['builder'] == 'single-product' ){
                    $this->post['template'] = 'product-single';
                }
                
                $data['builder']        = $this->template( $data['options'] );

                $this->post['template'] = 'multiple-condition';
                $data['conditions']     = $this->template( $this->post['header'] );

                break;
            case 'remove':
                unset($headers[$this->post['header']]);

                if (  $this->post['builder'] == 'header' ) {
                    $conditions = $this->get_json_option('et_multiple_conditions');
                } elseif( $this->post['builder'] == 'single-product' ){
                    $conditions = $this->get_json_option('et_multiple_single_product_conditions');
                }

                foreach ( $conditions as $key => $value ) {
                    if ( $value['header'] == $this->post['header'] ) {
                        unset($conditions[$key]);
                    }
                    
                }

                foreach ( $conditions as $key => $value ) {
                    if ( ! is_array( $value ) ) {
                        unset($conditions[$key]);
                    }
                }

                if (  $this->post['builder'] == 'header' ) {
                    update_option('et_multiple_conditions', json_encode($conditions));

                } elseif( $this->post['builder'] == 'single-product' ){
                    update_option('et_multiple_single_product_conditions', json_encode($conditions));
                }
                break;
            case 'old':
                $this->post['options'] = array_merge( $this->post['options'] , $this->decode_special_options($this->post['options']) );

                $this->post['options']['html_block1'] =  base64_decode( $this->post['options']['html_block1'] );
                $this->post['options']['html_block2'] =  base64_decode( $this->post['options']['html_block2'] );
                $this->post['options']['html_block3'] =  base64_decode( $this->post['options']['html_block3'] );


                if (  $this->post['builder'] == 'header' ) {
                    update_option('et_multiple_headers_old', $this->post['options'] );
                } elseif( $this->post['builder'] == 'single-product' ){
                    update_option('et_multiple_single_product_old', $this->post['options'] );
                }
                break;
            default:
                die();
                break;
        }

        $new_option = json_encode($headers);

        if ( $this->post['type'] == 'remove' || $new_option ) {
            if (  $this->post['builder'] == 'header' ) {
                update_option('et_multiple_headers', $new_option);
            } elseif( $this->post['builder'] == 'single-product' ){
                update_option('et_multiple_single_product', $new_option);
            }
        }
        

        $this->post['template'] = 'multiple-headers';
        $data['headers'] = $this->template( true );

        echo json_encode( $data );
        die();
    }

    /**
     * Decode special options
     *
     * use base64_decode() to decode array of options.
     *
     * @since   1.4.4
     * @version 1.0.1
     * @param   {array} $data options for decode.
     * @return  {array}       array with base64 decoded options.
     */
    public function decode_special_options($data){
        $return  = array();
        $options = array( 'header_top_elements','header_main_elements','header_bottom_elements','connect_block_package','header_mobile_top_elements','header_mobile_main_elements','header_mobile_bottom_elements','connect_block_mobile_package', 'product_single_elements', 'connect_block_product_single_package' );

        foreach ( $options as $value ) {
            if ( isset( $data[$value] ) ) {
                $return[$value] = base64_decode( $data[$value] );
            }
        }
        return $return;
    }

    /**
     * Multiple headers conditions ajax actions 
     *
     * Ajax actions for conditions part of multiple headers.
     * etThemeBuilder.etMultipleHeaders.et_headers_actions(), etThemeBuilder.etMultipleHeaders.et_conditions_actions() callbacks.
     * This functions in "framework/builder/js/builder.js".
     * Callbacks for add/save_all actions.
     *
     * @since   1.4.4
     * @version 1.0.1
     * @return  {json} string with data needed for action.
     */
    public function et_ajax_conditions_actions(){
        switch ( $this->post['type'] ) {
            case 'add':
                $this->post['template'] = 'multiple-condition';
                $data['template']       = $this->template( 'et_add' );
                break;
            case 'save_all':

                if (  $this->post['builder'] == 'header' ) {
                    $conditions = $this->get_json_option('et_multiple_conditions');
                } elseif( $this->post['builder'] == 'single-product' ){
                    $conditions = $this->get_json_option('et_multiple_single_product_conditions');
                }

                if ( isset( $this->post['data_save'] ) && is_array( $this->post['data_save'] ) ) {
                    foreach ($this->post['data_save'] as $key => $value) {
                        $id = ( ! $value['condition'] ) ? $this->generate_random(7) : $value['condition'];
                        $conditions[$id] = $value;
                    }
                }

                if ( isset( $this->post['data_remove'] ) && is_array( $this->post['data_remove'] ) ) {
                    foreach ( $this->post['data_remove'] as $key => $value ) {
                        unset($conditions[$value]);
                    }
                }

                foreach ( $conditions as $key => $value ) {
                    if ( ! is_array( $value ) ) {
                        unset($conditions[$key]);
                    }
                }


                if (  $this->post['builder'] == 'header' ) {
                    $data['result'] = update_option('et_multiple_conditions', json_encode($conditions));

                } elseif( $this->post['builder'] == 'single-product' ){
                    $data['result'] = update_option('et_multiple_single_product_conditions', json_encode($conditions));

                }


                $this->post['template'] = 'multiple-headers';
                $data['headers']        = $this->template( true );
                break;
            default:
                die();
                break;
        }
        echo json_encode($data);
        die();
    }

    /**
     * Ajax conditions select2 data
     *
     * Return data for condition selects
     * etThemeBuilder.etMultipleHeaders.et_conditions() callbacks.
     * This functions in "framework/builder/js/builder.js".
     *
     * @since   1.4.4
     * @version 1.0.0
     * @return  {json} string with data needed for action.
     */
    public function et_ajax_conditions_data(){
        echo json_encode( $this->condition_select_data( $_REQUEST ) );
        die();
    }


    /**
     * Conditions select2 data
     *
     * Return data for condition selects
     *
     * @since   1.4.4
     * @version 1.0.1
     * @param   {array} $atts data for WP_Query or get_terms.
     * @return  {array}       data for select2
     */
    public function condition_select_data($atts){
        $data = array();
        if ( $atts['data'] ) {
            if ( $atts['data']['type'] == 'all' || $atts['data']['type'] == 'child_of' ) {
                 $args = array(
                    'post_type'      => $atts['data']['post_type'],
                    'post_status'    => 'any',
                    'posts_per_page' => -1,
                    'orderby'        => 'ID',
                    'order'          => 'asc',
                );

                if ( $atts['search'] ) {
                    $args['s'] = $atts['search'];
                }
                if ( $atts['selected'] ) {
                    $args['post__in'] = array($atts['selected']);
                }

                if ( defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') ) {
                    $args['suppress_filters'] = true;
                }

                if( defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') && $atts['selected'] ){
                    global $wpdb;

                    $where = "WHERE post_type = '".$atts['data']['post_type']."'";
                    $and   = "AND ID = '" . $atts['selected'] . "'";

                    $posts = $wpdb->get_results ( " SELECT ID,post_title FROM  $wpdb->posts " . $where . $and );

                } else {
                    $query = new WP_Query();
                    $posts = $query->query($args);
                }
            
                foreach ($posts as $key => $value) {
                    if( defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') ){
                        $language_details = apply_filters( 'wpml_post_language_details', NULL, $value->ID ) ;
                        $value->post_title = $value->post_title . ' (' . $language_details['language_code'] . ')';
                    }

                    $data[] = array(
                        'id' => $value->ID,
                        'text' => $value->post_title
                    );
                }
            } elseif ( $atts['data']['type'] == 'in' || $atts['data']['type'] == 'taxonomy' ) {
                $args = array(
                    'taxonomy' => $atts['data']['slug']
                );
                if ($atts['search']) {
                    $args['name__like'] = $atts['search'];
                }
                if ( $atts['selected'] ) {
                    $args['include'] = $atts['selected'];
                }

                $terms = get_terms( $args );

                foreach ($terms as $key => $value) {
                    $data[] = array(
                        'id' => $value->term_id,
                        'text' => $value->name
                    );
                }
            } 
        }
        return $data;
    }

    /**
     * Get all single
     *
     * Return data for condition all singular select
     *
     * @since   1.4.4
     * @version 1.0.0
     * @return  {array} data for condition all singular select
     */
    public function get_all_single($type = false) {
        $post_types = get_post_types(
            array(
                'show_in_nav_menus' => true,
            ),
            'objects'
        );

        $options = array();

        if ( ! $type ) {
            $options = array(
                'select' => array(
                    'title' => __( 'Select', 'xstore-core' )
                ),
                'all_singular' => array(
                    'title' => __( 'All Singular', 'xstore-core' )
                ),
                'front_page' => array(
                    'title' => __( 'Front page', 'xstore-core' )
                ),
            );
        }

        foreach ( $post_types as $post_type => $post_type_object ) {

            if ( $type && $type != $post_type ) {
                continue;
            }

            $post_type_taxonomies = get_object_taxonomies( $post_type, 'objects' );
            $post_type_taxonomies = wp_filter_object_list(
                $post_type_taxonomies,
                array(
                    'public'             => true,
                    'show_in_nav_menus'  => true,
                    'publicly_queryable' => true,
                )
            );

            $tax = array();

            if ( count( $post_type_taxonomies ) ) {
                foreach ( $post_type_taxonomies as $slug => $object ) {
                    $tax[] = array(
                        'post_type' => $post_type,
                        'type' => 'in',
                        'slug' => $slug,
                        'title' => sprintf( __( 'In %s', 'xstore-core' ), $object->labels->singular_name )
                    );
                }
            }

            if ( $post_type_object->hierarchical ) {

                $tax[] = array(
                    'post_type' => $post_type,
                    'type' => 'child_of',
                    'slug' => 'child',
                    'title' => sprintf( __( 'Child of %s', 'xstore-core' ), $post_type_object->labels->name )
                );
            }

            if ( count( $tax ) ) {
                $options[ $post_type ] = array(
                    'label' => $post_type_object->labels->singular_name,
                    'options' => array_merge(
                        array( array(
                            'post_type' => $post_type,
                            'type' => 'all',
                            'slug' => 'all',
                            'title' => sprintf( __( 'All %s', 'xstore-core' ), $post_type_object->labels->name )
                        ) ),
                        $tax
                    ),
                );
            }
        }

        if ( ! $type ) {
            $options['attachment'] = array(
                'title' => __( 'Attachment', 'xstore-core' )
            );
            $options['not_found'] = array(
                'title' => __( 'Not found(404)', 'xstore-core' )
            );
        }
        return $options;
    }

    /**
     * Get all archives
     *
     * Return data for condition all archives select
     *
     * @since   1.4.4
     * @version 1.0.0
     * @return  {array} data for condition all archives select
     */
    public function get_all_archive() {
        $post_type_args = array(
            'show_in_nav_menus' => true,
        );

        if ( ! empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }

        $_post_types = get_post_types( $post_type_args, 'objects' );
        $post_types  = [];

        foreach ( $_post_types as $post_type => $object ) {
            $post_types[ $post_type ] = $object->label;
        }

        $taxonomies =  array(
            'select' => array(
                'title' => __( 'Select', 'xstore-core' )
            ),
            'all_archives' => array(
                'title' => __( 'All Archives', 'xstore-core' )
            ),
            'author' => array(
                'title' => __( 'Author Archive', 'xstore-core' )
            ),
            'date' => array(
                'title' => __( 'Date Archive', 'xstore-core' )
            ),
            'search' => array(
                'title' => __( 'Search Results', 'xstore-core' )
            ),
        );

        foreach ( $post_types as $post_type => $label ) {
            $post_type_object = get_post_type_object( $post_type );
            $post_type_taxonomies = get_object_taxonomies( $post_type, 'objects' );
            $post_type_taxonomies = wp_filter_object_list(
                $post_type_taxonomies,
                array(
                    'public' => true,
                    'show_in_nav_menus' => true,
                )
            );
            $tax = array();

            if ( $post_type_object->has_archive ) {
                $tax[] = array(
                    'post_type' => $post_type,
                    'type' => 'post_type_archive',
                    'slug' => 'post_type_archive',
                    'title' => $post_type_object->label
                );
            }

            if ( count( $post_type_taxonomies ) ) {
                foreach ( $post_type_taxonomies as $slug => $object ) {
                    $tax[] = array(
                        'post_type' => $post_type,
                        'type' => 'taxonomy',
                        'slug' => $slug,
                        'title' => $object->label
                    );
                }
            }

            if ( count( $tax ) ) {
                $taxonomies[ $post_type ] = array(
                    'label' => $post_type_object->labels->name . ' ',
                    'post_type' => $post_type,
                    'options' => $tax,
                );
            }
        }
        return $taxonomies;
    }

    /**
     * Condition default select data
     *
     * Used to get titles of Condition default select data.
     *
     * @since   1.4.4
     * @version 1.0.0
     * @return  {array} titles for default select data
     */
    public function condition_default_select_data(){
        return array(
            'select' => array(
                'title' => __( 'Select', 'xstore-core' )
            ),
            'all_archives' => array(
                'title' => __( 'All Archives', 'xstore-core' )
            ),
            'author' => array(
                'title' => __( 'Author Archive', 'xstore-core' )
            ),
            'date' => array(
                'title' => __( 'Date Archive', 'xstore-core' )
            ),
            'search' => array(
                'title' => __( 'Search Results', 'xstore-core' )
            ),
            'attachment' => array(
                'title' => __( 'Attachment', 'xstore-core' )
            ),
            'attachment' => array(
                'title' => __( 'Attachment', 'xstore-core' )
            ),'not_found' => array(
                'title' => __( 'Not found(404)', 'xstore-core' )
            ),
            'all_singular' => array(
                'title' => __( 'All Singular', 'xstore-core' )
            ),
            'front_page' => array(
                'title' => __( 'Front page', 'xstore-core' )
            ),
            'site' => array(
                'title' => __( 'Entire Site', 'xstore-core' )
            ),
            'archives' => array(
                'title' => __( 'Archives', 'xstore-core' )
            ),
            'singular' => array(
                'title' => __( 'Singular', 'xstore-core' )
            )
        );
    }

    /**
     * Condition default select data
     *
     * Get option from wp_option and json_decode() it.
     *
     * @since   1.4.4
     * @version 1.0.0
     * @param   {string} $option wp_options option name
     * @return  {array}          json decoded option or empty array
     */
    public function get_json_option($option){
        if ( ! $option  ) {
            return array();
        }
        $option = get_option($option, false);
        $option = json_decode($option, true);
        if ( ! is_array($option) ) {
            $option = array();
        }
        return $option;
    }

    /**
     * Generate random string.
     *
     * @since   1.0.0
     * @version 1.0.0
     * @param   {integer} $length  length of random string
     * @return  {string} random string
     */
    public function generate_random( $length = 5 ){
        $string = '';
        $characters = '23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz';
        for ( $i = 0; $i < $length; $i++ ) {
            $string .= $characters[mt_rand( 0, strlen( $characters ) -1 )];
        }
        return $string;
    }

    /**
     * Generate html.
     *
     * Generate html blocks by params
     *
     * @since   1.0.1
     * @version 1.0.1
     * @param   {string} $element element that should be generated
     * @param   {array}  $args    params for element
     * @return  {html} html block
     */
    public function generate_html( $args, $element = 'element' ){
        if ( $element == 'element' ) {
            return sprintf(
                '<div class="et_customizer-element ui-state-default %s" data-size="1" data-id="%s" data-element="%s">
                    <span class="et_name"><span class="dashicons %s"></span>%s</span>
                    <span class="et_actions">
                        %s
                        <span class="dashicons dashicons-admin-generic et_edit mtips" data-section="%s"><span class="mt-mes">'.esc_html__('Settings', 'xstore-core').'</span></span>%s
                        <span class="dashicons dashicons-trash et_remove mtips"><span class="mt-mes">'.esc_html__('Remove', 'xstore-core').'</span></span>
                    </span>
                </div>',
                isset( $args['class'] ) ? $args['class'] : '',
                $args['id'],
                $args['element'],
                $args['icon'],
                $args['title'],
                isset( $args['element_info'] ) ? $args['element_info'] : '',
                $args['section'],
                $args['section2']
            );
        } elseif( $element == 'product-column' ){
            $width = 30;
            return sprintf(
                '<div class="et_column et_col-sm-3 et_product-block ui-sortable-handle" data-id="element-%1$s" data-index="%2$s" data-title="%3$s" data-sticky="false">
                    <div class="et_column-actions">
                        <span class="dashicons dashicons-move"></span>
                        <span class="dashicons dashicons-admin-generic et_style-column"></span>
                        <span>%3$s</span>
                        <span class="et_remove-column dashicons dashicons-trash"></span>
                    </div>
                    <div class="et_column-content-wrapper"><div class="et_column-content" data-name="%4$s">%5$s</div></div>
                    <div class="et_column-settings">
                        %7$s
                        <div class="block-setting block-align customize-control-kirki-radio-buttonset flex align-items-center">
                            <span class="et-title">%8$s</span>
                            <div class="buttonset">
                                <input class="switch-input screen-reader-text" type="radio" value="start" name="_customize-radio-block_align-%2$s" id="block_alignstart-%2$s" checked>

                                <label for="block_alignstart-%2$s" class="switch-label switch-label-off">
                                    <span class="dashicons dashicons-editor-alignleft"></span>
                                    <span class="image-clickable"></span>
                                </label>
                                <input class="switch-input screen-reader-text" type="radio" value="center" name="_customize-radio-block_align-%2$s" id="block_aligncenter-%2$s">
                                    <label for="block_aligncenter-%2$s" class="switch-label switch-label-off">
                                        <span class="dashicons dashicons-editor-aligncenter"></span>
                                    <span class="image-clickable"></span>
                                </label>
                                <input class="switch-input screen-reader-text" type="radio" value="end" name="_customize-radio-block_align-%2$s" id="block_alignend-%2$s">
                                    <label for="block_alignend-%2$s" class="switch-label switch-label-off">
                                        <span class="dashicons dashicons-editor-alignright"></span>
                                    <span class="image-clickable"></span>
                                </label>        
                            </div>
                        </div>
                        <div class="block-setting block-width customize-control-kirki-slider flex align-items-center" data-default="' . $width . '">
                            <div class="et-title">%6$s (&#37)</div>
                            <div class="wrapper">
                                <input type="range" min="0" max="100" step="1" value="' . $width . '" data-customize-setting-link="top_header_height">
                                <span class="value">
                                    <input type="text" value="' . $width . '">
                                    <span class="suffix"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>',
                $this->generate_random( 5 ),
                $args['index'],
                esc_html__('Section', 'xstore-core') . $args['index'],
                esc_html__('Drop here', 'xstore-core'),
                '',
                esc_html__('Width', 'xstore-core'),
                ( $args['sticky'] === 'true' ) ? 
                '<div class="customize-control-kirki-toggle et_column-edit et-custom-toggle">
                    <label class="block-setting">
                        <span class="et-title">'.esc_html__('Sticky', 'xstore-core').'</span>
                        <span class="switch"></span>
                    </label>
                 </div>' : '',
                 esc_html__('Alignment', 'xstore-core')
            );
        } else {
            return sprintf(
                '<div class="et_sortable et_column et_has-element et_col-sm-1" data-index="%s">
                    <div class="et_customizer-element ui-state-default" data-offset="%s" data-size="%s" data-element="%s" data-id="%s">
                        <span class="et_name"><span class="dashicons %s"></span>%s</span>
                        <span class="et_actions">
                            %s
                            <span class="dashicons dashicons-admin-generic et_edit mtips" data-section="%s"><span class="mt-mes">'.esc_html__('Settings', 'xstore-core').'</span></span>%s
                            <span class="dashicons dashicons-trash et_remove mtips"><span class="mt-mes">'.esc_html__('Remove', 'xstore-core').'</span></span>
                        </span>
                    </div>
                </div>',
                $args['index'],
                $args['offset'],
                $args['size'],
                $args['element'],
                $args['id'],
                $args['icon'],
                $args['title'],
                isset( $args['element_info'] ) ? $args['element_info'] : '',
                $args['section'],
                $args['section2']
            );
        }
    }

    /**
     * Switch options.
     *
     * et_switch_default_header() callback.
     * This function in "builder/js/builder.js".
     * Switch default/builder header options
     *
     * @since   1.0.0
     * @version 1.0.0
     */
    public function switch_default(){
        if ( $this->post['value'] === 'false' ) {
            $this->post['value'] = false;
        }
        update_option( 'etheme_'.$this->post['type'], $this->post['value'] );
        die();
    }
}

$Etheme_Customize_header_Builder = new Etheme_Customize_header_Builder();
$Etheme_Customize_header_Builder -> actions();