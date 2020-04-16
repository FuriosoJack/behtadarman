<?php
namespace ETC\Views;

use ETC\Core\View;

/**
 * View class to load elementor template
 *
 * @since      1.0.0
 * @package    ETC
 * @subpackage ETC/views
 */
class Elementor extends View {

	/**
	 * Prints brand fields.
	 *
	 * @param  array $args
	 * @return void
	 * @since 1.0.0
	 */
	public function elementor_version_requirment( $args = [] ) {
		echo $this->render_template(
			'elementor.php',
			$args
		);
	}

}
