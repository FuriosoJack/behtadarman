<?php
namespace ETC\App\Models\Widgets;

use ETC\App\Models\Widgets;

/**
 * Static block Widget.
 * 
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models/Widgets
 */
class Static_Block extends Widgets {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_satick_block', 'description' => esc_html__( "Insert a static block", 'xstore-core') );
        parent::__construct('etheme-static-block', '8theme - '.esc_html__('Static Block', 'xstore-core'), $widget_ops);
        $this->alt_option_name = 'etheme_widget_satick_block';
    }

    function widget($args, $instance) {
        extract($args);

        $title = empty($instance['title']) ? false : $instance['title'];
        $block_id = isset( $instance['block_id'] ) ? $instance['block_id'] : false;

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;

        if ( function_exists( 'etheme_static_block' ) && get_theme_mod('static_blocks', true) ) {
            etheme_static_block( $block_id, true );
        }
        else {
            echo '<p class="woocommerce-info">'.esc_html__('To use this widget, please enable static block via Customizer settings', 'xstore-core').'</p>';
        }

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']    = strip_tags($new_instance['title']);
        $instance['block_id'] = $new_instance['block_id'];
        return $instance;
    }

    function form( $instance ) {
        $block_id = 0;
        $title = isset($instance['title']) ? $instance['title'] : '';
        $sb    = array();
        $sb    = etheme_get_static_blocks();
        if(!empty($instance['block_id']))
            $block_id = esc_attr($instance['block_id']); 
        ?>
        <?php parent::widget_input_text( esc_html__( 'Widget title:', 'xstore-core' ), $this->get_field_id( 'title' ),$this->get_field_name( 'title' ), $title ); ?>
        <p><label for="<?php echo $this->get_field_id( 'block_id' ); ?>"><?php esc_html_e( 'Block name:', 'xstore-core' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'block_id' ); ?>" id="<?php echo $this->get_field_id( 'block_id' ); ?>">
                <option>--Select--</option>
                <?php if ( count( $sb ) > 0 ): ?>
                    <?php foreach ($sb as $key): ?>
                        <option value="<?php echo $key['value']; ?>" <?php selected( $block_id, $key['value'] ); ?>><?php echo $key['label'] ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </p>
<?php
    }
}