<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Etheme Customize Search.
 *
 * Add custom search form for wordpress customizer.
 *
 * @since   0.0.1
 * @version 0.0.1
 */
class Etheme_Customize_Search {

    // ! Main construct/ just leave it empty
    function __construct(){}


    /**
     * Add search actions.
     *
     * Actions to add search template and scripts
     *
     * @since   0.0.1
     * @version 0.0.1
     */
    public function actions(){
        if ( is_admin() ) {
            // // ! Add scripts and templates
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts' ) );
            add_action( 'customize_controls_print_footer_scripts', array( $this, 'template' ) );
        }  
    }

    /**
     * Add script and styles to Wordpress Customizer
     *
     * @since   0.0.1
     * @version 0.0.1
     */
    public function scripts() {
        wp_enqueue_style( 'et_customize-search',  get_template_directory_uri() . '/framework/customizer/search/css/search.css', array( 'etheme_admin_css' ) );

        wp_enqueue_script( 'et_customize-search', get_template_directory_uri() . '/framework/customizer/search/js/search.js' );
    }

    /**
     * Get search template.
     *
     * @since   0.0.1
     * @version 0.0.1
     */
    public function template(){ 
        get_template_part( 'framework/customizer/search/template-parts/search' );
    }
}

$Etheme_Customize_header_Builder = new Etheme_Customize_Search();
$Etheme_Customize_header_Builder -> actions();