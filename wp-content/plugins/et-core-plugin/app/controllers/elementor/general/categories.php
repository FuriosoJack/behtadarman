<?php
namespace ETC\App\Controllers\Elementor\General;

use ETC\App\Traits\Elementor;
use ETC\App\Controllers\Shortcodes\Categories as Categories_Shortcodes;

/**
 * Categories widget.
 *
 * @since      2.1.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Categories extends \Elementor\Widget_Base {

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
		return 'etheme_categories';
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
		return __( 'Product Categories', 'xstore-core' );
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
		return [ 'categories', 'product-categories' ];
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
	 * Register Categories widget controls.
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
			'title',
			[
				'label' => __( 'Title', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'sorting',
			[
				'label' 		=>	__( 'Text fields', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT2,
				'label_block'	=> 'true',
				'description' 	=> esc_html__( 'Sorting the texts layout', 'xstore-core' ),
				'multiple' 		=>	true,
				'options' 		=>	[
					'name' 		=> esc_html__( 'Category name', 'xstore-core' ),
					'products' 	=> esc_html__( 'Products', 'xstore-core' ),
				],
				'default' 		=>	'name,products',
			]
		);

		$this->add_control(
			'hide_all',
			[
				'label' 		=> __( 'Disable category name and products count', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'xstore-cores' ),
				'label_off' 	=> __( 'No', 'xstore-cores' ),
				'return_value' 	=> 'yes',
				'default' 		=> '',
			]
		);

		$this->add_control(
			'no_space',
			[
				'label' 		=> __( 'Remove space between items', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'xstore-cores' ),
				'label_off' 	=> __( 'No', 'xstore-cores' ),
				'return_value' 	=> 'yes',
				'default' 		=> '',
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
			'columns',
			[
				'label' 		=>	__( 'Columns', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 		=>	false,
				'options' 		=>	[
					'2'	=>	esc_html__('2', 'xstore-core'),
					'3'	=>	esc_html__('3', 'xstore-core'),
					'4'	=>	esc_html__('4', 'xstore-core'),
					'5'	=>	esc_html__('5', 'xstore-core'),
					'6'	=>	esc_html__('6', 'xstore-core'),
				],
				'condition' => ['display_type' => 'grid'],
				'default'	=> '3',
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
				'default' 		=>	'',
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

		$this->add_control(
			'number',
			[
				'label' => __( 'Number of categories', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::NUMBER,
				'min' 	=> '',
				'max' 	=> '',
				'step' 	=> '1',
			]
		);

		$this->add_control(
			'parent',
			[
				'label' 		=> __( 'Parent ID', 'xstore-core' ),
				'type' 			=> \Elementor\Controls_Manager::NUMBER,
				'description' 	=> 'Get direct children of this term (only terms whose explicit parent is this value). If 0 is passed, only top-level terms are returned. Default is an empty string.',
				'min' 			=> '',
				'max' 			=> '',
				'step' 			=> '1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'design_settings',
			[
				'label' => __( 'Design Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=>	__( 'Style', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 	=>	false,
				'options' 	=>	array(
					'default' 	=>	esc_html__( 'Default','xstore-core'),
					'with-bg' 	=>	esc_html__( 'Title with background','xstore-core'),
					'zoom' 		=>	esc_html__( 'Zoom','xstore-core'),
					'diagonal'	=>	esc_html__( 'Diagonal','xstore-core'),
					'classic' 	=>	esc_html__( 'Classic','xstore-core'),
				),
			]
		);

		$this->add_control(
			'count_label',
			[
				'label' 		=> __( 'Products count as label', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'xstore-cores' ),
				'label_off' 	=> __( 'No', 'xstore-cores' ),
				'return_value' 	=> 'yes',
				'default' 		=> '',
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' 	=>	__( 'Horizontal align', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 	=>	false,
				'options' 	=>	[
					'left'  	=>	esc_html__('Left', 'xstore-core'), 
					'center'	=>	esc_html__('Center', 'xstore-core'),
					'right' 	=>	esc_html__('Right', 'xstore-core'), 
				],
				'default'	=> 'center'
			]
		);

		$this->add_control(
			'valign',
			[
				'label' 	=>	__( 'Vertical align', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 	=>	false,
				'options' 	=>	[
					'center'  	=>	esc_html__('Center', 'xstore-core'), 
					'top'		=>	esc_html__('Top', 'xstore-core'),
					'bottom' 	=>	esc_html__('Bottom', 'xstore-core'), 
				],
				'default'	=> 'center'
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' 	=>	__( 'Design', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 	=>	false,
				'options' 	=>	[
					'uppercase'  	=>	esc_html__('Uppercase', 'xstore-core'), 
					'lowercase'		=>	esc_html__('Lowercase', 'xstore-core'),
					'capitalize' 	=>	esc_html__('Capitalize', 'xstore-core'), 
					'none' 			=>	esc_html__('None', 'xstore-core'), 
				],
				'default'	=> 'uppercase'
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' 	=>	__( 'Color scheme', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 	=>	false,
				'options' 	=>	[
					'white'  	=>	esc_html__('White', 'xstore-core'), 
					'dark'		=>	esc_html__('Dark', 'xstore-core'),
					'custom' 	=>	esc_html__('Custom', 'xstore-core'), 
				],
				'default'	=> 'white'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 	=>	__( 'Category name color', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::COLOR,
				'scheme' 	=>	[
					'type' 	=>	\Elementor\Scheme_Color::get_type(),
					'value' =>	\Elementor\Scheme_Color::COLOR_1,
				],
				'condition' =>	['text_color' => 'custom'],
				'default' 	=>	'#000',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' 	=>	__( 'Product count color', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::COLOR,
				'scheme' 	=>	[
					'type' 	=>	\Elementor\Scheme_Color::get_type(),
					'value' =>	\Elementor\Scheme_Color::COLOR_1,
				],
				'condition' =>	['text_color' => 'custom'],
				'default' 	=>	'#000',
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' 	=>	__( 'Background color', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::COLOR,
				'scheme' 	=>	[
					'type' 	=>	\Elementor\Scheme_Color::get_type(),
					'value' =>	\Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' 		=>	__( 'Category name font size', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::TEXT,
				'description' 	=>	esc_html__('Write font size for element with dimentions. Example 14px, 15em, 20%', 'xstore-core'),
				'condition' 	=>	['text_color' => 'custom'],
			]
		);

		$this->add_control(
			'subtitle_size',
			[
				'label' 		=>	__( 'Product count font size', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::TEXT,
				'description' 	=>	esc_html__('Write font size for element with dimentions. Example 14px, 15em, 20%', 'xstore-core'),
				'condition' 	=>	['text_color' => 'custom'],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'display_settings',
			[
				'label' => __( 'Display Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'display_type',
			[
				'label' 		=>	__( 'Display type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'multiple' 		=>	false,
				'options' 		=>	[
					'grid' 		=> esc_html__('Grid', 'xstore-core'),
					'slider' 	=> esc_html__('Slider', 'xstore-core'),
					'menu' 		=> esc_html__('Menu', 'xstore-core'),
				],
				'default'		=> 'grid'
			]
		);

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => __( 'Slider Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => ['display_type' => 'slider'],
			]
		);

		// Get slider controls from trait
		Elementor::get_slider_params( $this );

		$this->end_controls_section();

	}

	/**
	 * Render Categories widget output on the frontend.
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
						$atts[$key] = !empty( $setting ) ? implode( ',',$setting ) : '';
					break;
					case 'sorting':
						if ( is_array( $setting ) ) {
							$atts[$key] = !empty( $setting ) ? implode( ',',$setting ) : '';
						}
						else {
							$atts[$key] = $setting;
						}
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

		$Categories_Shortcodes = Categories_Shortcodes::get_instance();
		echo $Categories_Shortcodes->categories_shortcode( $atts );

	}

}
