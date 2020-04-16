<?php
namespace ETC\App\Models\Widgets;

use ETC\App\Models\Widgets;

/**
 * Recent + Popular posts Widget.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models/Widgets
 */
class Posts_Tabs extends Widgets {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_entries_tabs', 'description' => esc_html__( 'The most recent and popular posts on your blog', 'xstore-core') );
        parent::__construct('etheme-posts-tabs', '8theme - '.esc_html__('Posts Tabs Widget', 'xstore-core'), $widget_ops);
        $this->alt_option_name = 'etheme_widget_entries_tabs';
    }

    function widget($args, $instance) {

        ob_start();

        extract($args);

        $title = apply_filters('widget_title', empty( $instance['title'] ) ? false : $instance['title'] );

        if ( ! $number = (int) $instance['number'] )
                $number = 10;
        else if ( $number < 1 )
                $number = 1;
        else if ( $number > 15 )
                $number = 15;

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title; 

        ?>

            <div class="tabs">
                <a href="#" id="tab-recent" class="tab-title opened">
                    <?php esc_html_e( 'Recent', 'xstore-core' ); ?>
                </a>
                <a href="#" id="tab-popular" class="tab-title">
                    <?php esc_html_e( 'Popular', 'xstore-core' ); ?>
                </a>

                <div id="content_tab-recent" class="tab-content" style="display:block;">
                    <?php the_widget( 'ETC\App\Models\Widgets\Recent_Posts', array(
                        'number' => $number,
                        'image'  => true
                    )); ?>
                </div>
                <div id="content_tab-popular" class="tab-content">
                    <?php the_widget( 'ETC\App\Models\Widgets\Recent_Posts', array(
                        'number' => $number,
                        'image'  => true,
                        'query'  => 'popular'
                     )); ?>
                </div>
            </div>

        <?php 

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']  = strip_tags( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];

        return $instance;
    }

    function form( $instance ) {
        $title = ( ! isset( $instance['title'] ) ) ? '' : esc_attr( $instance['title'] );
        $number = ( isset( $instance['number'] ) && (int) $instance['number'] ) ? esc_attr( $instance['number'] ) : 5 ;
        parent::widget_input_text( esc_html__( 'Title:', 'xstore-core' ), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );
        parent::widget_input_text( esc_html__( 'Number of posts:', 'xstore-core' ), $this->get_field_id( 'number' ), $this->get_field_name( 'number' ), $number );
    }
}