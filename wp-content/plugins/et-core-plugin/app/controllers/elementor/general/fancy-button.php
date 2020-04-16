<?php
namespace ETC\App\Controllers\Elementor\General;

use ETC\App\Traits\Elementor;
use ETC\App\Controllers\Shortcodes\Fancy_Button as Fancy_Button_Shortcode;

/**
 * Fancy button widget.
 *
 * @since      2.1.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Fancy_Button extends \Elementor\Widget_Base {

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
		return 'et_fancy_button';
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
		return __( 'Fancy button', 'xstore-core' );
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
		return 'eicon-button eight_theme-element-icon';
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
		return [ 'et_fancy_button', 'Fancy button' ];
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
	 * Register Fancy button widget controls.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'settings',
			[
				'label' => __( 'Fancy button Settings', 'xstore-core' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'on_click',
			[
				'label' 		=>	__( 'On click action', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'link' 	=> esc_html__('Open custom link', 'xstore-core'),
					'popup' => esc_html__('Open promo popup', 'xstore-core'),
				],
				'default'		=> 'link'
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'on_click' => 'popup' ],
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content text', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'condition' => [ 'on_click' => 'popup' ],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Custom Link', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::URL,
				'condition' => [ 'on_click' => 'link' ],
			]
		);

		$this->add_control(
			'link_title',
			[
				'label' => __( 'Link Title', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'on_click' => 'link' ],
			]
		);

		$this->add_control(
			'staticblocks',
			[
				'label' 		=>	__( 'Use staticblock instead of content ?', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>	__( 'Hide', 'xstore-core' ),
				'label_off' 	=>	__( 'Show', 'xstore-core' ),
				'return_value'  =>	'true',
				'default' 		=>	'',
				'condition' => [ 'on_click' => 'popup' ],
			]
		);

		$this->add_control(
			'staticblock',
			[
				'label' 		=>	__( 'Choose prebuilt static blocks', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	Elementor::get_static_blocks(),
				'condition' 	=> [ 'staticblocks' => 'true' ],
			]
		);

		$this->add_control(
			'add_icon',
			[
				'label' 		=>	__( 'Add icon ?', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>	__( 'Hide', 'xstore-core' ),
				'label_off' 	=>	__( 'Show', 'xstore-core' ),
				'return_value'  =>	'true',
				'default' 		=>	'',
			]
		);

		$this->add_control(
			'type',
			[
				'label' 		=>	__( 'Icon library', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'svg'			=>	esc_html__( 'Icon', 'xstore-core' ),
					'image'			=>	esc_html__( 'Upload image', 'xstore-core' ),
				],
				'default'		=> 'svg',
				'condition' => [ 'add_icon' => 'true' ],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 	=> __( 'Icon', 'xstore-core' ),
				'type' 		=> 'etheme-icon-control',
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'attach_image',
			[
				'label' => __( 'Image', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'image'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'img_size',
			[
				'label' 	=> __( 'Image size', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'image'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'xstore-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'position',
			[
				'label' 		=>	__( 'Position of the icon', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'left' 	=>	esc_html__('Left', 'xstore-core'), 
					'top'  	=>	esc_html__('Top', 'xstore-core'),
					'right'	=>	esc_html__('Right', 'xstore-core'), 
				],
				'default'		=> 'left',
				'condition' 	=> [ 'add_icon' => 'true' ],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' 	=> __( 'Icon size', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' 	=> __( 'Spacing between icon and title', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'default' 	=> '5px',
				'condition' => [ 'add_icon' => 'true' ],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 	=> __( 'Icon color', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' 	=> __( 'Icon color (hover)', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' 	=> __( 'Icon background color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' 	=> __( 'Icon background color (hover)', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'advanced_icon_settings',
			[
				'label' 		=>	__( 'Icon Styles', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>	__( 'Hide', 'xstore-core' ),
				'label_off' 	=>	__( 'Show', 'xstore-core' ),
				'return_value'  =>	'true',
				'default' 		=>	'',
				'conditions' 	=> [
					'terms' 	=> [
						[
							'name' 		=> 'type',
							'operator'  => '=',
							'value' 	=> 'svg'
						],						
						[
							'name' 		=> 'add_icon',
							'operator'  => '=',
							'value' 	=> 'true'
						],
					]
				]
			]
		);

		$this->add_control(
			'divider1',
			[
				'label' => __( 'Icon Padding', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::HEADING,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_padding_top',
			[
				'label' => __( 'Top', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_padding_right',
			[
				'label' => __( 'Right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_padding_bottom',
			[
				'label' => __( 'Bottom', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_padding_left',
			[
				'label' => __( 'Left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'divider2',
			[
				'label' => __( 'Icon Border Radius', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::HEADING,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_radius_top_left',
			[
				'label' => __( 'Top left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_radius_top_right',
			[
				'label' => __( 'Top right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_radius_bottom_right',
			[
				'label' => __( 'Bottom right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_radius_bottom_left',
			[
				'label' => __( 'Bottom left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'Icon Border', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::HEADING,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_top',
			[
				'label' => __( 'Top', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_right',
			[
				'label' => __( 'Right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_bottom',
			[
				'label' => __( 'Bottom', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_left',
			[
				'label' => __( 'Left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_style',
			[
				'label' 		=>	__( 'Border style', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'' 		 => __('Unset', 'xstore-core'),
					'solid'  => __('Solid', 'xstore-core'),
					'dashed' => __('Dashed', 'xstore-core'),
					'dotted' => __('Dotted', 'xstore-core'),
					'double' => __('Double', 'xstore-core'),
					'groove' => __('Groove', 'xstore-core'),
					'ridge'  => __('Ridge', 'xstore-core'),
					'inset'  => __('Inset', 'xstore-core'),
					'outset' => __('Outset', 'xstore-core'),
				],
				'condition' 	=> [ 'advanced_icon_settings' => 'true' ],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' 	=> __( 'Border color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'advanced_icon_settings' => 'image' ],
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label' 		=>	__( 'Style', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'default'	=>	esc_html__('Default', 'xstore-core'),
					'active'	=>	esc_html__('Active', 'xstore-core'),
					'bordered'	=>	esc_html__('Bordered', 'xstore-core'),
					'white'		=>	esc_html__('White', 'xstore-core'),
					'black'		=>	esc_html__('Black', 'xstore-core'),
					'custom'	=>	esc_html__('Custom', 'xstore-core'),
				],
				'default'		=> 'default',
			]
		);

		$this->add_control(
			'btn_size',
			[
				'label' 		=>	__( 'Size', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					 'default'	=>	esc_html__('Default', 'xstore-core'),
					 'small'	=>	esc_html__('Small', 'xstore-core'),
					 'medium'	=>	esc_html__('Medium', 'xstore-core'),
					 'big'		=>	esc_html__('Big', 'xstore-core'),
					 'custom'	=>	esc_html__('Custom', 'xstore-core'),
				],
				'default'		=> 'medium'
			]
		);

		$this->add_control(
			'size',
			[
				'label' => __( 'Button font size', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_size' => 'custom' ],
			]
		);

		$this->add_control(
			'padding_top',
			[
				'label' => __( 'Top', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_size' => 'custom' ],
			]
		);
		
		$this->add_control(
			'padding_right',
			[
				'label' => __( 'Right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_size' => 'custom' ],
			]
		);
		
		$this->add_control(
			'padding_bottom',
			[
				'label' => __( 'Bottom', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_size' => 'custom' ],
			]
		);
		
		$this->add_control(
			'padding_left',
			[
				'label' => __( 'Left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_size' => 'custom' ],
			]
		);	

		$this->add_control(
			'border_radius_top_left',
			[
				'label' => __( 'Top left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_radius_top_right',
			[
				'label' => __( 'Top right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_radius_bottom_right',
			[
				'label' => __( 'Bottom right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);	

		$this->add_control(
			'border_radius_bottom_left',
			[
				'label' => __( 'Bottom left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_top',
			[
				'label' => __( 'Top', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_right',
			[
				'label' => __( 'Right', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_bottom',
			[
				'label' => __( 'Bottom', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_left',
			[
				'label' => __( 'Left', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_style',
			[
				'label' 		=>	__( 'Border style', 'xstore-core' ),
				'type' 			=>	\Elementor\Controls_Manager::SELECT,
				'options' 		=>	[
					'' 			=> __('Unset', 'xstore-core'),
					'solid' 	=> __('Solid', 'xstore-core'),
					'dashed' 	=> __('Dashed', 'xstore-core'),
					'dotted' 	=> __('Dotted', 'xstore-core'),
					'double' 	=> __('Double', 'xstore-core'),
					'groove' 	=> __('Groove', 'xstore-core'),
					'ridge' 	=> __('Ridge', 'xstore-core'),
					'inset' 	=> __('Inset', 'xstore-core'),
					'outset' 	=> __('Outset', 'xstore-core'),
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' 	=> __( 'Border color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'border_color_hover',
			[
				'label' 	=> __( 'Border color (hover)', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'color',
			[
				'label' 	=> __( 'Button color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'color_hover',
			[
				'label' 	=> __( 'Button color (hover)', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' 	=> __( 'Button background color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'bg_color_hover',
			[
				'label' 	=> __( 'Button background color (hover)', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 		=> \Elementor\Scheme_Color::get_type(),
					'value' 	=> \Elementor\Scheme_Color::COLOR_1,
				],
				'condition' => [ 'btn_style' => 'custom' ],
			]
		);

		$this->add_control(
			'class',
			[
				'label' => __( 'Extra Class', 'xstore-core' ),
				'type' 	=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Fancy button widget output on the frontend.
	 *
	 * @since 2.1.3
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Url link
		if ( $settings['link']['nofollow'] ) {
			$settings['link']['nofollow'] = 'nofollow';
		}		
		if ( $settings['link']['is_external'] ) {
			$settings['link']['is_external'] = '%20_blank';
		}		

		$url = 'url:' . $settings['link']['url'] . '|target:' . $settings['link']['is_external'] . '|rel:' . $settings['link']['nofollow'] . '|title:' . $settings['link_title'];

		$icon_type = ET_CORE_DIR . 'app/assets/icon-fonts/svg/' . $settings['icon'];
		// icon svg code
		if ( isset( $settings['icon'] ) && strpos( $settings['icon'], 'svg' ) ) {
			$icon_type = file_get_contents( $icon_type );
			$icon_type = base64_encode( $icon_type );
		} else {
			$icon_type = '';
		}

		$atts = array( 
			'on_click'							=>	$settings['on_click'],
			'title'								=>	$settings['title'],
			'link'								=>	$url,
			'staticblocks'						=>	$settings['staticblocks'],
			'staticblock'						=>	$settings['staticblock'],
			'add_icon'							=>	$settings['add_icon'],
			'type'								=>	$settings['type'],
			'svg'								=>	$icon_type,
			'position'							=>	$settings['position'],
			'img'								=>	$settings['attach_image']['id'],
			'img_size'							=>	$settings['img_size'],
			'icon_size'							=>	$settings['icon_size'],
			'icon_spacing'						=>	$settings['icon_spacing'],
			'icon_color'						=>	$settings['icon_color'],
			'icon_color_hover'					=>	$settings['icon_color_hover'],
			'icon_bg_color'						=>	$settings['icon_bg_color'],
			'icon_bg_color_hover'				=>	$settings['icon_bg_color_hover'],
			'advanced_icon_settings'			=>	$settings['advanced_icon_settings'],
			'icon_padding_top'					=>	$settings['icon_padding_top'],
			'icon_padding_right'				=>	$settings['icon_padding_right'],
			'icon_padding_bottom'				=>	$settings['icon_padding_bottom'],
			'icon_padding_left'					=>	$settings['icon_padding_left'],
			'icon_border_radius_top_left'		=>	$settings['icon_border_radius_top_left'],
			'icon_border_radius_top_right'		=>	$settings['icon_border_radius_top_right'],
			'icon_border_radius_bottom_right'	=>	$settings['icon_border_radius_bottom_right'],
			'icon_border_radius_bottom_left'	=>	$settings['icon_border_radius_bottom_left'],
			'icon_border_top'					=>	$settings['icon_border_top'],
			'icon_border_right'					=>	$settings['icon_border_right'],
			'icon_border_bottom'				=>	$settings['icon_border_bottom'],
			'icon_border_left'					=>	$settings['icon_border_left'],
			'icon_border_style'					=>	$settings['icon_border_style'],
			'icon_border_color'					=>	$settings['icon_border_color'],
			'btn_style'							=>	$settings['btn_style'],
			'btn_size'							=>	$settings['btn_size'],
			'size'								=>	$settings['size'],
			'padding_top'						=>	$settings['padding_top'],
			'padding_right'						=>	$settings['padding_right'],
			'padding_bottom'					=>	$settings['padding_bottom'],
			'padding_left'						=>	$settings['padding_left'],
			'border_radius_top_left'			=>	$settings['border_radius_top_left'],
			'border_radius_top_right'			=>	$settings['border_radius_top_right'],
			'border_radius_bottom_right'		=>	$settings['border_radius_bottom_right'],
			'border_radius_bottom_left'			=>	$settings['border_radius_bottom_left'],
			'border_top'						=>	$settings['border_top'],
			'border_right'						=>	$settings['border_right'],
			'border_bottom'						=>	$settings['border_bottom'],
			'border_left'						=>	$settings['border_left'],
			'border_style'						=>	$settings['border_style'],
			'border_color'						=>	$settings['border_color'],
			'border_color_hover'				=>	$settings['border_color_hover'],
			'color'								=>	$settings['color'],
			'color_hover'						=>	$settings['color_hover'],
			'bg_color'							=>	$settings['bg_color'],
			'bg_color_hover'					=>	$settings['bg_color_hover'],
			'class'								=>	$settings['class'],
			'is_preview'						=>	( \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false ),
		);

		$Fancy_Button_Shortcode = Fancy_Button_Shortcode::get_instance();
		echo $Fancy_Button_Shortcode->fancy_button_shortcode( $atts, $settings['content'] );

	}

}
