<?php
namespace ETC\App\Controllers\Vc;

use ETC\App\Controllers\VC;

/**
 * Special Offer shortcode.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Controllers/VC
 */
class Special_Offer extends VC {

	function hooks() {
		$this->register_offer();
	}

	function register_offer() {
		add_filter( 'vc_autocomplete_et_offer_include_callback', 'et_vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
		add_filter( 'vc_autocomplete_et_offer_include_render', 'et_vc_include_field_render', 10, 1 ); // Render exact product. Must return an array(label,value)

      	// Narrow data taxonomies
		add_filter( 'vc_autocomplete_et_offer_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
		add_filter( 'vc_autocomplete_et_offer_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

		$strings = $this->etheme_vc_shortcodes_strings();
		$counter = 0;
		$params = array(
			'name' => 'Best Offer',
			'base' => 'et_offer',
			'category' => $strings['category'],
			'content_element' => true,
			'icon' => ETHEME_CODE_IMAGES . 'vc/Best-offer.png',
			'description' => esc_html__('Display product with accent design', 'xstore-core'),
			'params' => array(
                array(
                    'type' => 'xstore_title_divider',
                    'title' => esc_html__( 'Data settings', 'xstore-core' ),
                    'param_name' => 'divider'.$counter++
                ),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Product', 'xstore-core' ),
					'param_name' => 'include',
					'settings' => array(
						'multiple' => false,
						'sortable' => true,
						'groups' => true,
					),
				),
				array(
					'type' => 'textfield', // notice @omid - you can try to do it as this type http://prntscr.com/qf90ae if elementor has such field type  ( limit from -1 to about 20 ) 
					'heading' => esc_html__('Limit', 'xstore-core'),
					'param_name' => 'items_per_page',
					'hint' => esc_html__( 'Use "-1" to show all products.', 'xstore-core' )
				),
                array(
                    'type' => 'xstore_title_divider',
                    'title' => esc_html__( 'Image', 'xstore-core' ),
                    'param_name' => 'divider'.$counter++
                ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Image size', 'xstore-core' ),
					'param_name' => 'img_size',
					'hint' => $strings['hint']['img_size'],
					// 'dependency' => array(
					// 	'element' => 'hide_img',
					// 	'value_not_equal_to' => 'yes'
					// ),
					'edit_field_class' => 'vc_col-md-9 vc_column',
				),
				array(
					'type' => 'checkbox', 
					'heading' => esc_html__('Hide image', 'xstore-core'),
					'param_name' => 'hide_img',
					'hint' => esc_html__('Disable product image', 'xstore-core'),
					'edit_field_class' => 'vc_col-md-3 vc_column',
				),
				array(
					'type' => 'xstore_button_set',
					'heading' => esc_html__('Hover effect', 'xstore-core'),
					'param_name' => 'hover',
					'value' => array(
						esc_html__('Disable', 'xstore-core') => 'disable',
						esc_html__('Swap', 'xstore-core') => 'swap',
						esc_html__('Slider', 'xstore-core') => 'slider'
					),
				),
                array(
                    'type' => 'xstore_title_divider',
                    'title' => esc_html__( 'Layout', 'xstore-core' ),
                    'param_name' => 'divider'.$counter++
                ),
				array(
					'type' => 'xstore_image_select',
					'heading' => esc_html__('Display type', 'xstore-core'),
					'param_name' => 'dis_type',
				    'value' => array( 
						esc_html__( 'Default', 'xstore-core' ) => 'default',
						esc_html__( 'Advanced', 'xstore-core' ) => 'type2',
					),
					'images_value' => array(
						'default'   => ET_CORE_SHORTCODES_IMAGES . 'special-offer/Default.svg',
						'type2'   => ET_CORE_SHORTCODES_IMAGES . 'special-offer/Advanced.svg',
					),
					'et_tooltip' => true,
					'hint' => esc_html__('Select display type', 'xstore-core'),
				),
                array(
                    'type' => 'xstore_title_divider',
                    'title' => esc_html__( 'Stock colors', 'xstore-core' ),
                    'param_name' => 'divider'.$counter++,
					'dependency' => array(
						'element' => 'dis_type',
						'value' => 'type2'
					),
                ),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Full stock', 'xstore-core'),
					'param_name' => 'product_stock_color_step1',
					'value' => '#2e7d32',
					'dependency' => array(
						'element' => 'dis_type',
						'value' => 'type2'
					),
					'edit_field_class' => 'vc_col-md-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Middle stock (sold more than 50%)', 'xstore-core' ),
					'param_name' => 'product_stock_color_step2',
					'value' => '#f57f17',
					'dependency' => array(
						'element' => 'dis_type',
						'value' => 'type2'
					),
					'edit_field_class' => 'vc_col-md-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Low stock', 'xstore-core' ),
					'param_name' => 'product_stock_color_step3',
					'value' => '#c62828',
					'dependency' => array(
						'element' => 'dis_type',
						'value' => 'type2'
					),
					'edit_field_class' => 'vc_col-md-4 vc_column',
				),
			),   
		);  
		vc_map($params);
	}

}
