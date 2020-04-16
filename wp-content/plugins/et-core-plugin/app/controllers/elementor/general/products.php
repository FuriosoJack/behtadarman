<?php
namespace ETC\App\Controllers\Elementor\General;

use ETC\App\Traits\Elementor;
use ETC\App\Controllers\Shortcodes\Products as Products_Shortcode;

/**
 * Products widget.
 *
 * @since      2.1.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Products extends \Elementor\Widget_Base {

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
		return 'etheme_products';
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
		return __( 'Products', 'xstore-core' );
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
		return 'eight_theme-elementor-icon et-elementor-products';
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
		return [ 'products' ];
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
	 * Register Products widget controls.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'settings',
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
			'type',
			[
				'label' 		=>	__( 'Display type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'slider'		=>	esc_html__('Slider', 'xstore-core'),
					'grid'			=>	esc_html__('Grid', 'xstore-core'),
					'list'			=>	esc_html__('List', 'xstore-core'),
					'full-screen'	=>	esc_html__('Full screen', 'xstore-core'),
				],
				'default'		=> 'slider'
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=>	__( 'Product layout for this slider', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'default'	=>	esc_html__('Grid', 'xstore-core'), 
					'advanced'	=>	esc_html__('List', 'xstore-core')
				],
				'condition'		=> ['type' => 'slider'],
				'default'		=> 'default'
			]
		);

		$this->add_control(
			'no_spacing',
			[
				'label' 		=>	__( 'Remove space between slides', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>	'yes',
				'default' 		=>	'',
				'condition'		=> ['type' => 'slider']
			]
		);
		
		$this->add_control(
			'columns_grid',
			[
				'label' 		=>	__( 'Columns', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'1'	=>	esc_html__('1', 'xstore-core'),
					'2'	=>	esc_html__('2', 'xstore-core'),
					'3'	=>	esc_html__('3', 'xstore-core'),
					'4'	=>	esc_html__('4', 'xstore-core'),
					'5'	=>	esc_html__('5', 'xstore-core'),
					'6'	=>	esc_html__('6', 'xstore-core'),
				],
				'condition'		=> ['type' => 'grid'],
				'default'		=> '4'
			]
		);

		$this->add_control(
			'columns_list',
			[
				'label' 		=>	__( 'Columns', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'1'	=>	esc_html__('1', 'xstore-core'),
					'2'	=>	esc_html__('2', 'xstore-core'),
					'3'	=>	esc_html__('3', 'xstore-core'),
				],
				'condition'		=> ['type' => 'list'],
				'default'		=> '4'
			]
		);	

		$this->add_control(
			'navigation',
			[
				'label' 		=>	__( 'Navigation', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'off'	=>	esc_html__( 'Off', 'xstore-core' ),
					'btn'	=>	esc_html__( 'Load More button', 'xstore-core' ),
					'lazy'	=>	esc_html__( 'Lazy loading', 'xstore-core' ),
				],
				'condition'		=> ['type' => 'grid'],
				'default'		=> 'off'
			]
		);

		$this->add_control(
			'per_iteration',
			[
				'label' 		=>	__( 'Products per view', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::TEXT,
				'description' 	=>	__( 'Number of products to show per view and after every loading', 'xstore-core' ),
				'condition'		=>	['navigation' => array( 'btn', 'lazy' )]
			]
		);

		$this->add_control(
			'show_counter',
			[
				'label' 		=>	__( 'Show sale counter', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>	'yes',
				'default' 		=>	'',
			]
		);

		$this->add_control(
			'show_stock',
			[
				'label' 		=>	__( 'Show stock count bar', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>	'yes',
				'default' 		=>	'',
			]
		);

		$this->add_control(
			'ajax',
			[
				'label' 		=>	__( 'Lazy loading for this element', 'xstore-core' ),
				'description' 	=>	__( 'Works for live mode, not for the preview', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>	'true',
				'default' 		=>	'',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_data_section',
			[
				'label' => __( 'Product Data Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'products',
			[
				'label' 		=>	__( 'Products type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					''					=>	esc_html__('All', 'xstore-core'),
					'featured'			=>	esc_html__('Featured', 'xstore-core'),
					'sale'				=>	esc_html__('Sale', 'xstore-core'),
					'recently_viewed'	=>	esc_html__('Recently viewed', 'xstore-core'),
					'bestsellings'		=>	esc_html__('Bestsellings', 'xstore-core'),
				],
			]
		);		

		$this->add_control(
			'orderby',
			[
				'label' 		=>	__( 'Order by', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'description'  => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s. Default by Date', 'xstore-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'options' 		=>	[
					'date'			=>	esc_html__( 'Date', 'xstore-core' ),
					'ID'			=>	esc_html__( 'ID', 'xstore-core' ),
					'post__in'		=>	esc_html__( 'As IDs provided order', 'xstore-core' ),
					'author'		=>	esc_html__( 'Author', 'xstore-core' ),
					'title'			=>	esc_html__( 'Title', 'xstore-core' ),
					'modified'		=>	esc_html__( 'Modified', 'xstore-core' ),
					'rand'			=>	esc_html__( 'Random', 'xstore-core' ),
					'comment_count'	=>	esc_html__( 'Comment count', 'xstore-core' ),
					'menu_order'	=>	esc_html__( 'Menu order', 'xstore-core' ),
					'price'			=>	esc_html__( 'Price', 'xstore-core' ),
				],
				'default'		=> 'date'
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=>	__( 'Order way', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'description'   => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s. Default by ASC', 'xstore-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'options' 		=>	[
                    'ASC'		=>	esc_html__( 'Ascending', 'xstore-core' ),
                    'DESC'		=>	esc_html__( 'Descending', 'xstore-core' ),
				],
				'default'		=> 'ASC'
			]
		);
		
		$this->add_control(
			'hide_out_stock',
			[
				'label' 		=>	__( 'Hide out of stock products', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>	'yes',
				'default' 		=>	'',
			]
		);

		$this->add_control(
			'ids',
			[
				'label' 		=>	__( 'Products', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT2,
				'description'   =>  esc_html__( 'Enter List of Products.', 'xstore-core' ),
				'label_block'	=> 'true',
				'multiple' 	=>	true,
				'options' 	=>	Elementor::get_products(),
			]
		);

		$this->add_control(
			'taxonomies',
			[
				'label' 		=>	__( 'Categories', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT2,
				'description'   =>  esc_html__( 'Enter categories.', 'xstore-core' ),
				'label_block'	=> 'true',
				'multiple' 	=>	true,
				'options' 		=> Elementor::get_terms('product_cat'),
			]
		);

		$this->add_control(
			'limit',
			[
				'label' 		=>	__( 'Limit', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::TEXT,
				'description'   =>  esc_html__( 'Use "-1" to show all products.', 'xstore-core' ),
				'limit' 		=>	'20',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => __( 'Slider Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
				'condition'		=> ['type' => 'slider'],
			]
		);

		// Get slider controls from trait
		Elementor::get_slider_params( $this );

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
	        \Elementor\Group_Control_Typography::get_type(),
	        [
	            'name'        	=> 'title_typography',
	            'label'       	=> __( 'Typography', 'xstore-core' ),
	            'scheme'      	=> \Elementor\Scheme_Typography::TYPOGRAPHY_1,
	            'selector'    	=> '{{WRAPPER}} h3.title',
				'separator'   	=> 'before',
	        ]
	    );

		$this->add_control(
			'title_color',
			[
				'label' 	=> __( 'Color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 	=> \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_3,
				],
				'selectors'    => [
					'{{WRAPPER}} h3.title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_align',
			[
				'label' 		=>	__( 'Alignment', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'xstore-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'xstore-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xstore-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default'		=> 'center',
				'selectors'    => [
					'{{WRAPPER}} h3.title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_view_section',
			[
				'label' => __( 'Product view Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_view',
			[
				'label' 		=>	__( 'Product view', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					 ''			=>	esc_html__('Inherit', 'xstore-core'),
					'default'	=>	esc_html__('Default', 'xstore-core'),
					'mask3'		=>	esc_html__('Buttons on hover middle', 'xstore-core'),
					'mask'		=>	esc_html__('Buttons on hover bottom', 'xstore-core'),
					'mask2'		=>	esc_html__('Buttons on hover right', 'xstore-core'),
					'info'		=>	esc_html__('Information mask', 'xstore-core'),
					'booking'	=>	esc_html__('Booking', 'xstore-core'),
					'light'		=>	esc_html__('Light', 'xstore-core'),
					'custom'	=>	esc_html__('Custom', 'xstore-core'),
					'Disable'	=>	esc_html__('Disable', 'xstore-core'),
				],
				'condition'		=> ['type' => array('grid', 'list', 'slider')]
			]
		);

		$this->add_control(
			'product_view_color',
			[
				'label' 		=>	__( 'Product view color', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					''			=>	esc_html__('Default', 'xstore-core'),
					'white'	=>	esc_html__('White', 'xstore-core'),
					'dark'	=>	esc_html__('Dark', 'xstore-core'),
					'transparent'	=>	esc_html__('Transparent', 'xstore-core'),
				],
				'condition'		=> ['type' => array('grid', 'list', 'slider')]
			]
		);

		$this->add_control(
			'custom_template',
			[
				'label' 		=>	__( 'Custom product templates', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	Elementor::product_templates(),
				'condition'		=>  ['product_view' => 'custom']
			]
		);

		$this->add_control(
			'product_img_hover',
			[
				'label' 		=>	__( 'Image hover effect', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'' 			=> 	esc_html__( 'Default', 'xstore-core' ),
					'disable'	=>	esc_html__( 'Disable', 'xstore-core' ),
					'swap'		=>	esc_html__( 'Swap', 'xstore-core' ),
					'slider'	=>	esc_html__( 'Images Slider', 'xstore-core' ),
				],
				'condition'		=> ['product_view' => array( '', 'default', 'mask3', 'mask', 'mask2', 'info', 'booking', 'light', 'Disable' ) ]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Products widget output on the frontend.
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
				switch ( $key ) {
					case 'ids':
					case 'taxonomies':
						$atts[$key] = !empty( $setting ) ? implode( ',',$setting ) : array();
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

		if ( in_array( $atts['type'], array('grid', 'list') ) ) 
			$atts['columns'] = $atts['columns_'.$atts['type']];

		$atts['is_preview'] = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false );

		$Products_Shortcode = Products_Shortcode::get_instance();
		echo $Products_Shortcode->products_shortcode($atts, '');
	}

}
