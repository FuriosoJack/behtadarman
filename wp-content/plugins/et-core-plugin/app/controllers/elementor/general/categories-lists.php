<?php
namespace ETC\App\Controllers\Elementor\General;

use ETC\App\Traits\Elementor;
use ETC\App\Controllers\Shortcodes\Categories_lists as Categories_lists_Shortcodes;

/**
 * Categories Lists widget.
 *
 * @since      2.1.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Categories_lists extends \Elementor\Widget_Base {

	use Elementor;

	/**
	 * Get widget name.
	 *
	 * @since 2.1.3
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'etheme_categories_lists';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.3
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Product Categories Lists', 'xstore-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.3
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-product-categories eight_theme-element-icon';
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 2.1.3
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'categories-Lists', 'product-categories-Lists' ];
	}

    /**
     * Get widget categories.
     *
     * @since 2.1.3
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
    	return ['eight_theme_general'];
    }

	/**
	 * Register Categories Lists widget controls.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'general_settings',
			[
				'label' => __( 'General Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number',
			[
				'label' => __( 'Number of categories', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::NUMBER,
				'min' 	=> '',
				'max' 	=> '',
				'step' 	=> '5',
			]
		);

		$this->add_control(
			'ids',
			[
				'label' 		=>	__( 'Categories', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT2,
				'label_block'	=> 'true',
				'description' 	=>	__( 'List of product categories', 'xstore-core' ),
				'multiple' 		=>	true,
				'options' 		=>	Elementor::get_terms('product_cat'),
			]
		);

		$this->add_control(
			'quantity',
			[
				'label' 		=>	__( 'Subcategories limit', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::TEXT,
				'default' 		=>	'',
			]
		);

		$this->add_control(
			'exclude',
			[
				'label' 		=>	__( 'Exclude Categories', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT2,
				'label_block'	=> 'true',
				'description' 	=>	__( 'List of product categories to exclude', 'xstore-core' ),
				'multiple' 		=>	true,
				'options' 		=>	Elementor::get_terms('product_cat'),
				'default' 		=>	'',
			]
		);

		$this->add_control(
			'display_type',
			[
				'label' 		=>	__( 'Display type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'grid' 		=> esc_html__('Grid', 'xstore-core'),
					'slider' 	=> esc_html__('Slider', 'xstore-core'),
				],
				'default'		=> 'grid'
			]
		);

		$this->add_control(
			'columns',
			[
				'label' 		=>	__( 'Columns', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 		=>	false,
				'options' 		=>	[
					2	=>	esc_html__('2', 'xstore-core'),
					3	=>	esc_html__('3', 'xstore-core'),
					4	=>	esc_html__('4', 'xstore-core'),
					5	=>	esc_html__('5', 'xstore-core'),
					6	=>	esc_html__('6', 'xstore-core'),
				],
				'condition' => ['display_type' => 'grid'],
				'default'		=> 2
			]
		);

		$this->add_control(
			'img_position',
			[
				'label' 		=>	__( 'Image position', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 		=>	false,
				'options' 		=>	[
					'top'		=>	esc_html__('Top', 'xstore-core'),
					'left'		=>	esc_html__('Left', 'xstore-core'),
					'right'		=>	esc_html__('Right', 'xstore-core'),
				],
				'default'		=> 'left',
			]
		);

		$this->add_control(
			'hover_type',
			[
				'label' 		=>	__( 'Hover type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 		=>	false,
				'options' 		=>	[
					'default' 	=> esc_html__('Default', 'xstore-core'),
					'disable' 	=> esc_html__('Disable', 'xstore-core'),
				],
				'default' 	=>	'default',
			]
		);

		$this->add_control(
			'class',
			[
				'label' 		=>	__( 'Extra Class', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'data_settings',
			[
				'label' => __( 'Data Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 	=>	__( 'Order by', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'description' 	=>	sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'xstore-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'multiple' 	=>	true,
				'options' 	=>	array(
					'ids_order' => esc_html__( 'As IDs provided order', 'xstore-core' ),
					'ID'  		=> esc_html__( 'ID', 'xstore-core' ),
					'name'  	=> esc_html__( 'Title', 'xstore-core' ),
					'count' 	=> esc_html__( 'Quantity', 'xstore-core' ),
				),
				'default' 	=>	'name',
			]
		);

		$this->add_control(
			'order',
			[
				'label' 	=>	__( 'Order way', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'description' 	=> sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'xstore-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'multiple' 	=>	true,
				'options' 	=>	array(
                    'ASC' 	=> esc_html__( 'Ascending', 'xstore-core' ),
                    'DESC' 	=> esc_html__( 'Descending', 'xstore-core' ),
				),
				'default' 	=>	'ASC',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => __( 'Slider Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Get slider controls from trait
		Elementor::get_slider_params( $this );

		$this->end_controls_section();

	}

	/**
	 * Render Categories Lists widget output on the frontend.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$atts = array();
		foreach ( $settings as $key => $setting ) {
			if ( '_' == substr( $key, 0, 1) ) {
				continue;
			}

			if ( $setting ) {

				switch ($key) {
					case 'ids':
					case 'exclude':
						$atts[$key] = !empty( $setting ) ? implode( ',',$setting ) : '';
						// $atts[$key] = $setting;
					break;
					case 'slides':
						$atts['large'] = $atts['notebook'] = $setting;
						break;
					case 'slides_tablet':
						$atts['tablet_land'] = $atts['tablet_portrait'] = $setting;
						break;
					case 'slides_mobile':
						$atts['mobile'] = $setting;
						break;
					default:
						$atts[$key] = $setting;
						break;
				}

			}

		}

		$atts['is_preview'] = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false );

		$Categories_lists_Shortcodes = Categories_lists_Shortcodes::get_instance();
		echo $Categories_lists_Shortcodes->categories_lists_shortcode( $atts );

	}

}
