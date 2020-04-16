<?php
namespace ETC\App\Controllers\Elementor\Controls;

/**
 * Icon control.
 *
 * @since 2.0.0
 */
class Icon_Control extends \Elementor\Base_Data_Control {

    /**
     * Registered icons.
     *
     * @since 1.0.0
     *
     * @var array
     */
    public static $icons = NULL;

	/**
	 * Get select control type.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'etheme-icon-control';
	}

    /**  
     * Register icons args  
     *  
     * @return mixed|null|void  
     */  
    public static function icons_args() {  

    	if ( ! is_null( self::$icons ) ) {
    		return self::$icons;
    	}

    	return self::$icons = apply_filters( 'etc/add/elementor/control/icon', array() );
    }

	public function enqueue() {

		wp_enqueue_script( 
			'etheme-icon-control',
			ET_CORE_URL . 'app/assets/js/icon-control.js', 
			array('jquery'), 
			ET_CORE_VERSION, 
			false 
		);

		wp_enqueue_style( 			
			'etheme-icon-control', 			
			ET_CORE_URL . 'app/assets/css/icon-control.css',
			'', 
			ET_CORE_VERSION
		);

	}

	/**
	 * Render icons control output in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		$icons = self::icons_args();

		?>
		<div class="elementor-control-field">
			<div class="etheme-icons-select">
				<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
				<select onchange="ethemeChangeIcon(this);" id="<?php echo esc_attr( $control_uid ); ?>">
					<?php foreach ( $icons as $icon_key => $icon_name ) : ?>
						<#
						var dirname = '';
						if ( data.controlValue ) {
							dirname = data.controlValue.match(/(.*)[\/\\]/)[1]||'';
						}
						 
						var folder = <?php echo wp_json_encode( $icon_key ); ?>;
						if ( folder == dirname ) { #>
							<option value="<?php echo esc_attr( $icon_key ); ?>" selected><?php echo esc_html( $icon_name ); ?></option>
						<# } else { #>
							<option value="<?php echo esc_attr( $icon_key ); ?>"><?php echo esc_html( $icon_name ); ?></option>
						<# } #>
						<?php endforeach; ?>
				</select>

				<# if ( data.controlValue ) { #>
				<img class="etheme-icon-selected" src="<?php echo esc_attr( ET_CORE_URL . 'app/assets/icon-fonts/svg/' ); ?>{{{ data.controlValue }}}">
				<# } else { #>
				<img src="" data-src="">
				<# } #>
			</div>

			<div class="etheme-icons-wrap">
				<?php 
				$dir 	= ET_CORE_DIR . 'app/assets/icon-fonts/svg/';
				$svgdir = list_files( $dir, 2 );

				foreach ( (array) $svgdir as $svgsub ) :
					$svg 		= basename( $svgsub );
					$folder 	= basename( dirname( $svgsub ) );
					$icon 		= ET_CORE_DIR . 'app/assets/icon-fonts/svg/' . $folder .'/'. $svg;
					$folderpath = ET_CORE_URL . 'app/assets/icon-fonts/svg/';

					$icon = rawurldecode( file_get_contents($icon) );

					?> <# 
					var dirname = '';
					if ( data.controlValue ) {
						dirname = data.controlValue.match(/(.*)[\/\\]/)[1]||'';
					}
					var folder = <?php echo wp_json_encode( $folder ); ?>;

					if ( folder == dirname ) { #><?php
						echo '
						<li data-family="' . $folder .'">
						<label><input data-path="'. $folderpath .'" type="radio" name="icon" data-name="' . $folder . '/' . $svg . '" value="' . $folder . '/' . $svg . '">
						<i class="etheme-elementor-admin-icon-svg">' . $icon . '</i>
						</li>';
					?><# } else { #><?php
						echo '
						<li style="display:none;" data-family="' . $folder .'">
						<label><input data-path="'. $folderpath .'" type="radio" name="icon" data-name="' . $folder . '/' . $svg . '" value="' . $folder . '/' . $svg . '">
						<i class="etheme-elementor-admin-icon-svg">' . $icon . '</i>
						</li>';
					?><# } #><?php
				endforeach;

				?>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<script type="text/javascript">
			function ethemeChangeIcon(selectObject) {
				var value = selectObject.value;
				if ( 'empty' == value ) { return; }
				jQuery('.etheme-icons-wrap li').css('display', 'none');
				jQuery('.etheme-icons-wrap li[data-family="'+value+'"]').css('display', 'inline-block');
			}

			jQuery('.etheme-icons-wrap li').css('display', 'none');
			jQuery('.etheme-icons-wrap li[data-family="7-stroke"]').css('display', 'inline-block');

		</script>
		<?php

	}
}
