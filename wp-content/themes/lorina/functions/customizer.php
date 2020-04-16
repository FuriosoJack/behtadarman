<?php
/**
 * Lorina Theme Customizer
 *
 * @package Lorina
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 */
function lorina_customize_register( $wp_customize ) {
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	$wp_customize->add_setting(
		'header_image_helper',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Lorina_Customize_Heading_Small(
			$wp_customize,
			'header_image_helper',
			array(
				'settings'		=> 'header_image_helper',
				'section'		=> 'header_image',
				'label'			=> esc_html__( 'Large image header uses default "Header Image" or page/post "Featured Image" if available.', 'lorina' )
			)
		)
	);

	lorina_customizer_controls();

	$wp_customize->add_setting(
		'grid_layout',
		array(
			'default'			=> '2',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'lorina_sanitize_radio_select'
		)
	);
	$wp_customize->add_control(
		new Lorina_Image_Radio_Control(
		$wp_customize,
		'grid_layout',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Blog - Grid Layout', 'lorina' ),
			'section' => 'layout_options',
			'settings' => 'grid_layout',
			'choices' => array(
				'1' => esc_url( get_template_directory_uri() ) . '/images/mag-layout-1.png',
				'2' => esc_url( get_template_directory_uri() ) . '/images/mag-layout-2.png',
				'3' => esc_url( get_template_directory_uri() ) . '/images/mag-layout-3.png',
				'4' => esc_url( get_template_directory_uri() ) . '/images/mag-layout-4.png',
				)
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar_position',
		array(
			'default'			=> 'right',
			'sanitize_callback'	=> 'lorina_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'sidebar_position',
		array(
			'label'		=> esc_html__( 'Sidebar Position', 'lorina' ),
			'type'		=> 'select',
			'section'	=> 'layout_options',
			'choices'	=> array(
				'left'	=> esc_html__( 'Left', 'lorina' ),
				'right'	=> esc_html__( 'Right', 'lorina' ),
			),
		)
	);

	$wp_customize->add_setting(
		'sticky_footer',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'lorina_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
			'sticky_footer',
			array(
				'settings'		=> 'sticky_footer',
				'section'		=> 'layout_options',
				'label'			=> esc_html__( 'Enable Sticky Footer', 'lorina' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_section(
		'homepage_options',
		array(
			'title'		=> esc_html__( 'Homepage Sections', 'lorina' ),
			'description'		=> esc_html__( 'You should first select a Static Homepage if you have not already done so. See: "Homepage Settings"', 'lorina' ),
			'priority'	=> 27,
		)
	);

	$wp_customize->add_setting(
		'woo_home_enable',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'lorina_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
			'woo_home_enable',
			array(
				'settings'		=> 'woo_home_enable',
				'section'		=> 'homepage_options',
				'label'			=> esc_html__( 'Activate Homepage Sections', 'lorina' ),
				'description'	=> esc_html__( 'Page Content is displayed by default if Homepage Sections is disabled.', 'lorina' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_setting(
		'woo_home[tabs]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'lorina_sanitize_woo_tabs',
			'transport'         => 'refresh',
			'capability'        => 'manage_options',
		)
	);

	$woo_home_choices = array();
	$woo_home_tabs = lorina_woo_home_tabs();
	foreach( $woo_home_tabs as $key => $val ){
		$woo_home_choices[$key] = $val['label'];
	}
	$wp_customize->add_control(
		new Lorina_Sortable_Checkboxes(
			$wp_customize,
			'woo_home',
			array(
				'section'     => 'homepage_options',
				'settings'    => 'woo_home[tabs]',
				'label'       => esc_html__( 'Homepage Sections', 'lorina' ),
				'description' => esc_html__( 'Check the box to display. Sortable: drag and drop into your preferred order.', 'lorina' ),
				'choices'     => $woo_home_choices,
			)
		)
	);

	$wp_customize->add_setting(
		'heading_featured_services',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Lorina_Customize_Heading_Large(
			$wp_customize,
			'heading_featured_services',
			array(
				'settings'		=> 'heading_featured_services',
				'section'		=> 'homepage_options',
				'label'			=> esc_html__( 'Featured Services', 'lorina' )
			)
		)
	);

	//FEATURES (MAX 3)
	for( $i = 1; $i < 4; $i++ ){
		$wp_customize->add_setting(
			'featured_header'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			new Lorina_Customize_Heading_Small(
				$wp_customize,
				'featured_header'.$i,
				array(
					'settings'		=> 'featured_header'.$i,
					'section'		=> 'homepage_options',
					'label'			=> esc_html__( 'Feature ', 'lorina' ).$i
				)
			)
		);

		$wp_customize->add_setting(
			'featured_page_icon'.$i,
			array(
				'default'			=> lorina_featured_icon_defaults($i),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			new Lorina_Icon_Choices(
			$wp_customize,
			'featured_page_icon'.$i,
			array(
				'settings'		=> 'featured_page_icon'.$i,
				'section'		=> 'homepage_options',
				'type'			=> 'select',
				'label'			=> esc_html__( 'Icon', 'lorina' ),
				'description'	=> 'featuredpageicon'.$i //not for display, no translation as using only for unique element name
			)
			)
		);

		$wp_customize->add_setting(
			'featured_page_link'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'featured_page_link'.$i,
			array(
				'settings'		=> 'featured_page_link'.$i,
				'section'		=> 'homepage_options',
				'type'			=> 'dropdown-pages',
				'label'			=> esc_html__( 'Select Page', 'lorina' ),
				'description'	=> esc_html__( 'Displays title and excerpt of selected page. You can add an optional hand-crafted excerpt in the page editor (make sure []excerpt is checked in Screen Options).', 'lorina' )
			)
		);
	}

	// SECTION - Typography
	$wp_customize->add_section(
		'typography',
		array(
			'title'		=> esc_html__( 'Typography & Fonts', 'lorina' ),
			'priority'	=> 42,
		)
	);

	// Setting - Font - Header
	$wp_customize->add_setting( 'font_site_title', array(
		'default'           => 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'lorina_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_site_title', array(
		'label'   => esc_html__( 'Site Title', 'lorina' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => lorina_google_fonts_array(),
	) );

	// Setting - Font - Navigation
	$wp_customize->add_setting( 'font_nav', array(
		'default'           => 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'lorina_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_nav', array(
		'label'   => esc_html__( 'Navigation', 'lorina' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => lorina_google_fonts_array(),
	) );

	// Setting - Font - Content
	$wp_customize->add_setting( 'font_content', array(
		'default'           => 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'lorina_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_content', array(
		'label'   => esc_html__( 'Content', 'lorina' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => lorina_google_fonts_array(),
	) );

	// Setting - Font - Headings
	$wp_customize->add_setting( 'font_headings', array(
		'default'           => 'Josefin Sans:100,100i,300,300i,400,400i,600,600i,700,700i',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'lorina_sanitize_choices',
	) );
	$wp_customize->add_control( 'font_headings', array(
		'label'   => esc_html__( 'Headings', 'lorina' ),
		'type'    => 'select',
		'section' => 'typography',
		'choices' => lorina_google_fonts_array(),
	) );

	$wp_customize->add_setting(
		'heading_font_site_title',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		new Lorina_Customize_Heading_Small(
			$wp_customize,
			'heading_font_site_title',
			array(
				'settings'		=> 'heading_font_site_title',
				'section'		=> 'typography',
				'label'			=> esc_html__( 'Site Title', 'lorina' )
			)
		)
	);

	$wp_customize->add_setting(
		'fs_site_title',
		array(
			'default'			=> '56',
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control(
			'fs_site_title',
			array(
				'settings'		=> 'fs_site_title',
				'section'		=> 'typography',
				'label'			=> esc_html__( 'Size', 'lorina' ),
				'type'       	=> 'number',
				'input_attrs' => array(
                'min'   => 14,
                'max'   => 80,
                'step'  => 1,
            ),
			)
	);


	// Section - Go Pro
	$wp_customize->add_section( 'go_pro_sec' , array(
		'title'      => esc_html__( 'Go Pro', 'lorina' ),
		'priority'   => 1,
		'description' => esc_html__( 'Upgrade to Lorina Pro for even more cool features and customization options.', 'lorina' ),
	) );
	$wp_customize->add_control(
		new Lorina_Customize_Extra_Control(
			$wp_customize,
			'go_pro',
			array(
				'section'   => 'go_pro_sec',
				'type'      => 'pro-link',
				'label'		=> esc_html__( 'Go Pro', 'lorina' ),
				'url'		=> 'https://uxlthemes.com/theme/lorina-pro/',
				'priority'	=> 10
			)
		)
	);

}
add_action('customize_register', 'lorina_customize_register');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lorina_customize_preview_js() {
	wp_enqueue_script('lorina_customizer', get_template_directory_uri() . '/functions/js/customizer.js', array('customize-preview'), '1.0', true );
}
add_action('customize_preview_init', 'lorina_customize_preview_js');


function lorina_customizer_script() {
	wp_enqueue_script('lorina-customizer-script', get_template_directory_uri() .'/functions/js/customizer-scripts.js', array("jquery","jquery-ui-draggable"),'', true  );
	wp_enqueue_script('lorina-sortable-checkbox', get_template_directory_uri() . '/functions/js/lorina-sortable-checkbox.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );
	wp_enqueue_style( 'lorina-fontawesome', get_template_directory_uri() . '/fontawesome/css/all.min.css' );
	wp_enqueue_style('lorina-customizer-style', get_template_directory_uri() .'/functions/css/customizer-style.css');	
}
add_action('customize_controls_enqueue_scripts', 'lorina_customizer_script');


if( class_exists('WP_Customize_Control') ):

class Lorina_Image_Radio_Control extends WP_Customize_Control {

	public function render_content() {

		if ( empty( $this->choices ) )
			return;

		$name = '_customize-radio-' . $this->id;

		?>
		<style>
			#lorina-img-container-<?php echo $this->id; ?> .lorina-radio-img-img {
			border: 2px solid #f5f5f5;
			cursor: pointer;
			margin: 0 4px 4px 0;
			}
			#lorina-img-container-<?php echo $this->id; ?> .lorina-radio-img-selected {
			border: 2px solid #0085BA;
			margin: 0 4px 4px 0;
			}
			input[type=checkbox]:before {
			content: '';
			margin: -3px 0 0 -4px;
			}
		</style>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if ( $this->description ) {
			echo '<span class="customize-control-description">' . esc_html( $this->description ) . '</span>';
		}
		?>
		<ul class="controls" id='lorina-img-container-<?php echo $this->id; ?>'>
		<?php
		foreach ( $this->choices as $value => $label ) :
			$class = ($this->value() == $value)?'lorina-radio-img-selected lorina-radio-img-img':'lorina-radio-img-img';
			?>
			<li style="display: inline;">
				<label>
					<input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<img src = '<?php echo esc_attr( $label ); ?>' class = '<?php echo esc_attr( $class ); ?>' />
				</label>
			</li>
			<?php
			endforeach;
		?>
		</ul>
	<?php
	}
}


class Lorina_Icon_Choices extends WP_Customize_Control{
	public $type = 'icon';

	public function render_content(){
		$func_append = $this->description;
		?>
            <label>
                <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
                </span>

                <div class="selected-icon">
                	<i class="<?php echo esc_attr($this->value()); ?>"></i>
                	<span><i class="fa fa-angle-down"></i></span>
                </div>

                <ul id="icon-box<?php echo esc_attr( $func_append ); ?>" class="icon-list">
				<form class="icon-search-input" action="#">
					<input id="input<?php echo esc_attr( $func_append ); ?>" class="" type="text" placeholder="<?php esc_attr_e( 'Search...', 'lorina' ); ?>">
				</form>
                	<?php
                	$fontawesome_array = lorina_fontawesome_array_all();
                	foreach ($fontawesome_array as $fontawesome_array_single) {
							$icon_class = $this->value() == $fontawesome_array_single ? 'icon-active' : '';
								if ($fontawesome_array_single == 'not-a-real-icon') {
									$zero_icon = 'NONE';
									$b_class = ' class="visible"';
								} else {
									$zero_icon = $fontawesome_array_single;
									$b_class = '';
								}
							echo '<li class='.esc_attr($icon_class).'><i class="'.esc_attr($fontawesome_array_single).'"></i><b'.$b_class.'>'.esc_html($zero_icon).'</b></li>';
						}
                	?>
                </ul>
                <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
            </label>
		<?php
	}
}


class Lorina_Customize_Heading_Large extends WP_Customize_Control {
    public function render_content() {
    	?>

        <?php if ( !empty( $this->label ) ) : ?>
            <h3 class="lorina-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <p class="lorina-accordion-section-paragraph"><?php echo esc_html( $this->description ); ?></p>
        <?php endif; ?>
    <?php }
}


class Lorina_Customize_Heading_Small extends WP_Customize_Control {
    public function render_content() {
    	?>

        <?php if ( !empty( $this->label ) ) : ?>
            <h5 class="lorina-accordion-section-title"><?php echo esc_html( $this->label ); ?></h5>
        <?php endif; ?>
        <?php if ( !empty( $this->description ) ) : ?>
            <p class="lorina-accordion-section-paragraph"><?php echo esc_html( $this->description ); ?></p>
        <?php endif; ?>
    <?php }
}


class Lorina_Customize_Extra_Control extends WP_Customize_Control {
	public $settings = 'blogname';
	public $description = '';
	public $url = '';
	public $group = '';

	public function render_content() {
		switch ( $this->type ) {
			default:

			case 'extra':
				echo '<p style="margin-top:40px;">' . sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'More options available', 'lorina' )
						) . '</p>';
				echo '<p class="description" style="margin-top:5px;">' . esc_html( $this->description ) . '</p>';
				break;

			case 'docs':
				echo sprintf(
							'<a href="%1$s" class="button-primary" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'Documentation', 'lorina' )
						);
				break;

			case 'pro-link':
				echo sprintf(
							'<a href="%1$s" class="button-primary" target="_blank">%2$s</a>',
							esc_url( $this->url ),
							esc_html__( 'Go Pro', 'lorina' )
						);
				break;
					
			case 'line' :
				echo '<hr />';
				break;
		}
	}
}


/**
 * Sortable multi check boxes custom control.
 * @since 0.1.0
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2015, Genbu Media
 * @license https://www.gnu.org/licenses/gpl-2.0.html
 */
class Lorina_Sortable_Checkboxes extends WP_Customize_Control {
	/**
	 * Control Type
	 */
	public $type = 'lorina-multicheck-sortable';
	/**
	 * Enqueue Scripts
	 */
	public function enqueue() {
		wp_enqueue_style( 'lorina-customize' );
		wp_enqueue_script( 'lorina-customize' );
	}
	/**
	 * Render Settings
	 */
	public function render_content() {
		/* if no choices, bail. */
		if ( empty( $this->choices ) ){
			return;
		} ?>

		<?php if ( !empty( $this->label ) ){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php } // add label if needed. ?>

		<?php if ( !empty( $this->description ) ){ ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php } // add desc if needed. ?>

		<?php
		/* Data */
		$values = explode( ',', $this->value() );
		$choices = $this->choices;
		/* If values exist, use it. */
		$options = array();
		if( $values ){
			/* get individual item */
			foreach( $values as $value ){
				/* separate item with option */
				$value = explode( ':', $value );
				/* build the array. remove options not listed on choices. */
				if ( array_key_exists( $value[0], $choices ) ){
					$options[$value[0]] = $value[1] ? '1' : '0'; 
				}
			}
		}
		/* if there's new options (not saved yet), add it in the end. */
		foreach( $choices as $key => $val ){
			/* if not exist, add it in the end. */
			if ( ! array_key_exists( $key, $options ) ){
				$options[$key] = '0'; // use zero to deactivate as default for new items.
			}
		}
		?>

		<ul class="lorina-multicheck-sortable-list">

			<?php foreach ( $options as $key => $value ){ ?>

				<li>
					<label>
						<input name="<?php echo esc_attr( $key ); ?>" class="lorina-multicheck-sortable-item" type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( $value ); ?> /> 
						<?php echo esc_html( $choices[$key] ); ?>
					</label>
					<i class="dashicons dashicons-menu lorina-multicheck-sortable-handle"></i>
				</li>

			<?php } // end choices. ?>

				<li class="lorina-hideme">
					<input type="hidden" class="lorina-multicheck-sortable" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				</li>

		</ul>


	<?php
	}
}


endif;


/**
 * Sanitization functions
 */

function lorina_sanitize_checkbox( $input ){
	//returns true if checkbox is checked
	return ( isset( $input ) ? true : false );
}


function lorina_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


function lorina_sanitize_radio_select( $input, $setting ) {
	// Ensuring that the input is a slug.
	$input = sanitize_key( $input );
	// Get the list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it, else, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


function lorina_sanitize_woo_tabs( $input ){

	/* Var */
	$output = array();

	/* Get valid tabs */
	$valid_tabs = lorina_woo_home_tabs();

	/* Make array */
	$tabs = explode( ',', $input );

	/* Bail. */
	if( ! $tabs ){
		return null;
	}

	/* Loop and verify */
	foreach( $tabs as $tab ){

		/* Separate tab and status */
		$tab = explode( ':', $tab );

		if( isset( $tab[0] ) && isset( $tab[1] ) ){
			if( array_key_exists( $tab[0], $valid_tabs ) ){
				$status = $tab[1] ? '1' : '0';
				$output[] = trim( $tab[0] . ':' . $status );
			}
		}

	}

	return trim( esc_attr( implode( ',', $output ) ) );
}
