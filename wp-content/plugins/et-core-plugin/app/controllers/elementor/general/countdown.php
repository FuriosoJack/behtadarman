<?php
namespace ETC\App\Controllers\Elementor\General;

/**
 * Countdown widget.
 *
 * @since      2.1.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Countdown extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.1.3
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'etheme-countdown';
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
		return __( 'Countdown', 'xstore-core' );
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
		return 'eicon-countdown eight_theme-element-icon';
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
		return [ 'countdown' ];
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
	 * Register countdown widget controls.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Countdown Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'year',
			[
				'label' => __( 'Year', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2020,
						'max' => 2030,
						'step' => 1,
					],
				],
			]
		);

		$this->add_control(
			'month',
			[
				'label' 		=>	__( 'Month', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'January'		=>	esc_html__('January', 'xstore-core'),
					'February'		=>	esc_html__('February', 'xstore-core'),
					'March'			=>	esc_html__('March', 'xstore-core'),
					'April'			=>	esc_html__('April', 'xstore-core'),
					'May'			=>	esc_html__('May', 'xstore-core'),
					'June'			=>	esc_html__('June', 'xstore-core'),
					'July'			=>	esc_html__('July', 'xstore-core'),
					'August'		=>	esc_html__('August', 'xstore-core'),
					'September'		=>	esc_html__('September', 'xstore-core'),
					'October'		=>	esc_html__('October', 'xstore-core'),
					'November'		=>	esc_html__('November', 'xstore-core'),
					'December'		=>	esc_html__('December', 'xstore-core'),
				],
				'default'	=> 'January',
			]
		);

		$this->add_control(
			'day',
			[
				'label' => __( 'Day', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 31,
						'step' => 1,
					],
				],
			]
		);

		$this->add_control(
			'hour',
			[
				'label' => __( 'hour', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 24,
						'step' => 1,
					],
				],
			]
		);

		$this->add_control(
			'minute',
			[
				'label' => __( 'Minutes', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
						'step' => 1,
					],
				],
			]
		);

		$this->add_control(
			'type',
			[
				'label' 		=>	__( 'Display type', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'type1' => esc_html__('Circle', 'xstore-core'),
					'type2' => esc_html__('Simple', 'xstore-core'),
				],
				'default'	=> 'type1',
			]
		);

		$this->add_control(
			'scheme',
			[
				'label' 		=>	__( 'Scheme', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'white' => esc_html__('Light', 'xstore-core'),
					'dark' => esc_html__('Dark', 'xstore-core'),
				],
				'default'	=> 'dark',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render countdown widget output on the frontend.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['year']['size'] 	= isset( $settings['year']['size'] ) ? $settings['year']['size'] : 2025;
		$settings['day']['size'] 	= isset( $settings['day']['size'] ) ? $settings['day']['size'] : 1;
		$settings['hour']['size'] 	= isset( $settings['hour']['size'] ) ? : 00;
		$settings['minute']['size'] = isset( $settings['minute']['size'] ) ? : 00;

		echo do_shortcode( '[countdown 
			year="'. $settings['year']['size'] .'"
			month="'. $settings['month'] .'"
			day="'. $settings['day']['size'] .'"
			hour="'. $settings['hour']['size'] .'"
			minute="'. $settings['minute']['size'] .'"
			type="'. $settings['type'] .'"
			scheme="'. $settings['scheme'] .'"
			is_preview="'. ( \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false ) .'"]' 
		);

	}

}
