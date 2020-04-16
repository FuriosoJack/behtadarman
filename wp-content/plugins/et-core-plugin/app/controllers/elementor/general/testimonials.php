<?php
namespace ETC\App\Controllers\Elementor\General;

use ETC\App\Traits\Elementor;

/**
 * Testimonials widget.
 *
 * @since      2.1.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Testimonials extends \Elementor\Widget_Base {

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
		return 'testimonials';
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
		return __( 'Testimonials Widget', 'xstore-core' );
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
		return 'eicon-testimonial eight_theme-element-icon';
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
		return [ 'testimonials' ];
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
	 * Register Testimonials widget controls.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Testimonials Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'limit',
			[
				'label' 	  => __( 'Limit', 'xstore-core' ),
				'type' 		  => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'How many testimonials to show? Enter number', 'xstore-core' ),
				'default'	  => '5',
			]
		);

		$this->add_control(
			'type',
			[
				'label' 		=>	__( 'Display type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'0' 			=> 'Unset', 
					'slider' 	 	=> esc_html__('Slider', 'xstore-core'),
					'slider-grid' 	=> esc_html__('Slider with grid', 'xstore-core'),
					'grid' 			=> esc_html__('Grid', 'xstore-core') 
				],
				'default'	  => 'slider',
			]
		);

		$this->add_control(
			'interval',
			[
				'label' 	  => __( 'Interval', 'xstore-core' ),
				'type' 		  => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Interval between slides. In milliseconds. Default: 10000', 'xstore-core' ),
				'condition'   => ['type' => ['slider', 'slider-grid']],
			]
		);

		$this->add_control(
			'slider_columns',
			[
				'label' 		=>	__( 'Slider columns', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'1'	=> esc_html__( '1', 'xstore-core' ),
					'2'	=> esc_html__( '2', 'xstore-core' ),
					'3'	=> esc_html__( '3', 'xstore-core' ),
					'4'	=> esc_html__( '4', 'xstore-core' ),
				],
				'condition'   => ['type' => ['slider-grid']],
				'default'	  => '2',
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' 		=>	__( 'Show Control Navigation', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					false	=>	esc_html__('Hide', 'xstore-core'),
					true	=>	esc_html__('Show', 'xstore-core'),
				],
				'condition'   => ['type' => ['slider', 'slider-grid']],
			]
		);

		$this->add_control(
			'color_scheme',
			[
				'label' 		=>	__( 'Color scheme', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'dark'  => esc_html__('Dark', 'xstore-core'),
					'light' => esc_html__('Light', 'xstore-core')
				],
			]
		);

		$this->add_control(
			'category',
			[
				'label' 		=>	__( 'Category', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT2,
				'label_block'	=> 'true',
				'description' 	=>	__( 'Display testimonials from category', 'xstore-core' ),
				'multiple' 		=>	true,
				'options' 		=>	Elementor::get_terms( 'testimonial-category' ),
				'default'	  	=> '0',
				'condition'     => ['type' => ['slider', 'slider-grid']],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Testimonials widget output on the frontend.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['category'] 	 = !empty( $settings['category'] ) ? implode( ',', $settings['category'] ) : '';

		if ( function_exists( 'woothemes_testimonials_shortcode' ) ) {

			$atts = array();
			foreach ( $settings as $key => $setting ) {
				if ( '_' == substr( $key, 0, 1) ) {
					continue;
				}

				if ( 'category' == $key && $setting ) {
					$atts[$key] = !empty( $setting ) ? implode( ',', $setting ) : '';
					continue;
				}

				if ( $setting ) {
					$atts[$key] = $setting;
				}
			}

			echo woothemes_testimonials_shortcode($atts);
		}

	}

}
