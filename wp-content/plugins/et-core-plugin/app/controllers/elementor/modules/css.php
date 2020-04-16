<?php
namespace ETC\App\Controllers\Elementor\Modules;

/**
 * Custom Css option.
 *
 * @since      2.0.0
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor/Modules
 */
class CSS {


    function __construct(){
        // Add new controls to advanced tab globally
        add_action( "elementor/element/after_section_end", array( $this, 'add_custom_css_controls_section'), 25, 3 );

        // ecute
        if ( ! defined('ELEMENTOR_PRO_VERSION') ) {
            add_action( 'elementor/element/parse_css', array( $this, 'add_post_css' ), 10, 2 );
        }
    }

    /**
     * Add custom css control to all elements
     *
     * @return void
     */
    public function add_custom_css_controls_section( $widget, $section_id, $args ){

        if( 'section_custom_css_pro' !== $section_id ){
            return;
        }

        if( ! defined('ELEMENTOR_PRO_VERSION') ) {

            $widget->start_controls_section(
                'fancify_advanced_custom_css',
                array(
                    'label'     => __( 'Xstore Custom CSS', 'xstore-core' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_ADVANCED
                )
            );

            $widget->add_control(
                'custom_css',
                array(
                    'type'        => \Elementor\Controls_Manager::CODE,
                    'label'       => __( 'Custom CSS', 'xstore-core' ),
                    'label_block' => true,
                    'language'    => 'css'
                )
            );
            ob_start();?>
<pre>
Example:
selector .child-element{ color: blue; }
</pre>
            <?php
            $message = ob_get_clean();

            $widget->add_control(
                'custom_css_description',
                array(
                    'raw'             => __( 'Use "selector" keyword to target wrapper element.', 'xstore-core' ). $message,
                    'type'            => \Elementor\Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-descriptor',
                    'separator'       => 'none'
                )
            );

            $widget->end_controls_section();
        }

    }

    /**
     * Render custom css
     *
     * @return renderd css
     */
    public function add_post_css( $post_css, $element ) {
        $element_settings = $element->get_settings();

        if ( empty( $element_settings['custom_css'] ) ) {
            return;
        }

        $css = trim( $element_settings['custom_css'] );

        if ( empty( $css ) ) {
            return;
        }
        $css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );

        // Add a css comment
        $css = sprintf( '/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector() ) . $css . '/* End custom CSS */';

        $post_css->get_stylesheet()->add_raw_css( $css );
    }


}
