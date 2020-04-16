<?php
namespace ETC\App\Models\Widgets;

use ETC\App\Models\Widgets;
use ETC\App\Controllers\Shortcodes\Follow;

/**
 * Recent socials Widget.
 * 
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models/Widgets
 */
class Socials extends Widgets {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_socials', 'description' => esc_html__( "Social links widget", 'xstore-core') );
        parent::__construct('etheme-socials', '8theme - '.esc_html__('Social links', 'xstore-core'), $widget_ops);
        $this->alt_option_name = 'etheme_widget_socials';
    }

    function widget($args, $instance) {
        extract($args);

        if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            $title = '';
        }

        if ( empty( $instance['number'] ) || !$number = (int) $instance['number'] ){
            $number = 10;
        } else if ( $number < 1 ){
            $number = 1;
        } else if ( $number > 15 ){
            $number = 15;
        }

        echo $before_widget;
        if( ! $title == '' ){
            echo $before_title . $title . $after_title;
        }

        $Follow = Follow::get_instance();

        echo $Follow->follow_shortcode(array(
            'size'        => ( ! empty( $instance['size'] ) ) ? $instance['size'] : '',
            'align'       => ( ! empty( $instance['align'] ) ) ? $instance['align'] : '',
            'target'      => ( ! empty( $instance['target'] ) ) ? $instance['target'] : '',
            'facebook'    => ( ! empty( $instance['facebook'] ) ) ? $instance['facebook'] : '',
            'twitter'     => ( ! empty( $instance['twitter'] ) ) ? $instance['twitter'] : '',
            'instagram'   => ( ! empty( $instance['instagram'] ) ) ? $instance['instagram'] : '',
            'google'      => ( ! empty( $instance['google'] ) ) ? $instance['google'] : '',
            'pinterest'   => ( ! empty( $instance['pinterest'] ) ) ? $instance['pinterest'] : '',
            'linkedin'    => ( ! empty( $instance['linkedin'] ) ) ? $instance['linkedin'] : '',
            'tumblr'      => ( ! empty( $instance['tumblr'] ) ) ? $instance['tumblr'] : '',
            'youtube'     => ( ! empty( $instance['youtube'] ) ) ? $instance['youtube'] : '',
            'vimeo'       => ( ! empty( $instance['vimeo'] ) ) ? $instance['vimeo'] : '',
            'rss'         => ( ! empty( $instance['rss'] ) ) ? $instance['rss'] : '',
            'vk'          => ( ! empty( $instance['vk'] ) ) ? $instance['vk'] : '',
            'houzz'       => ( ! empty( $instance['houzz'] ) ) ? $instance['houzz'] : '',
            'tripadvisor' => ( ! empty( $instance['tripadvisor'] ) ) ? $instance['tripadvisor'] : '',
            'slider'      => ( ! empty( $instance['slider'] ) ) ? $instance['slider'] : false,
            'image'       => ( ! empty( $instance['image'] ) ) ? $instance['image'] : false,
        ));

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['size']        = ( ! empty( $instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';
        $instance['align']       = ( ! empty( $instance['align'] ) ) ? strip_tags( $new_instance['align'] ) : '';
        $instance['target']      = ( ! empty( $instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '';
        $instance['number']      = ( ! empty( $instance['number'] ) ) ? (int) $new_instance['number'] : '';
        $instance['slider']      = ( ! empty( $instance['slider'] ) ) ? (int) $new_instance['slider'] : '';
        $instance['image']       = ( ! empty( $instance['image'] ) ) ? (int) $new_instance['image'] : '';
        $instance['facebook']    = ( ! empty( $instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['twitter']     = ( ! empty( $instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['instagram']   = ( ! empty( $instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        $instance['google']      = ( ! empty( $instance['google'] ) ) ? strip_tags( $new_instance['google'] ) : '';
        $instance['pinterest']   = ( ! empty( $instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : '';
        $instance['linkedin']    = ( ! empty( $instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['tumblr']      = ( ! empty( $instance['tumblr'] ) ) ? strip_tags( $new_instance['tumblr'] ) : '';
        $instance['youtube']     = ( ! empty( $instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
        $instance['vimeo']       = ( ! empty( $instance['vimeo'] ) ) ? strip_tags( $new_instance['vimeo'] ) : '';
        $instance['rss']         = ( ! empty( $instance['rss'] ) ) ? strip_tags( $new_instance['rss'] ) : '';
        $instance['vk']          = ( ! empty( $instance['vk'] ) ) ? strip_tags( $new_instance['vk'] ) : '';
        $instance['houzz']       = ( ! empty( $instance['houzz'] ) ) ? strip_tags( $new_instance['houzz'] ) : '';
        $instance['tripadvisor'] = ( ! empty( $instance['tripadvisor'] ) ) ? strip_tags( $new_instance['tripadvisor'] ) : '';

        return $instance;
    }

    function form( $instance ) {
        $title       = ( ! isset( $instance['title'] ) ) ? '' : esc_attr( $instance['title'] );
        $size        = ( ! isset( $instance['size'] ) ) ? '' : esc_attr( $instance['size'] );
        $align       = ( ! isset( $instance['align'] ) ) ? '' : esc_attr( $instance['align'] );
        $target      = ( ! isset( $instance['target'] ) ) ? '' : esc_attr( $instance['target'] );
        $facebook    = ( ! isset( $instance['facebook'] ) ) ? '' : esc_attr( $instance['facebook'] );
        $twitter     = ( ! isset( $instance['twitter'] ) ) ? '' : esc_attr( $instance['twitter'] );
        $instagram   = ( ! isset( $instance['instagram'] ) ) ? '' : esc_attr( $instance['instagram'] );
        $google      = ( ! isset( $instance['google'] ) ) ? '' : esc_attr( $instance['google'] );
        $pinterest   = ( ! isset( $instance['pinterest'] ) ) ? '' : esc_attr( $instance['pinterest'] );
        $linkedin    = ( ! isset( $instance['linkedin'] ) ) ? '' : esc_attr( $instance['linkedin'] );
        $tumblr      = ( ! isset( $instance['tumblr'] ) ) ? '' : esc_attr( $instance['tumblr'] );
        $youtube     = ( ! isset( $instance['youtube'] ) ) ? '' : esc_attr( $instance['youtube'] );
        $vimeo       = ( ! isset( $instance['vimeo'] ) ) ? '' : esc_attr( $instance['vimeo'] );
        $rss         = ( ! isset( $instance['rss'] ) ) ? '' : esc_attr( $instance['rss'] );
        $vk          = ( ! isset( $instance['vk'] ) ) ? '' : esc_attr( $instance['vk'] );
        $houzz       = ( ! isset( $instance['houzz'] ) ) ? '' : esc_attr( $instance['houzz'] );
        $tripadvisor = ( ! isset( $instance['tripadvisor'] ) ) ? '' : esc_attr( $instance['tripadvisor'] );
        $slider      = ( ! isset( $instance['slider'] ) ) ? '' : esc_attr( $instance['tripadvisor'] );
        $image       = ( ! isset( $instance['image'] ) ) ? '' : esc_attr( $instance['tripadvisor'] );

        parent::widget_input_text( esc_html__( 'Title', 'xstore-core' ), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );
        parent::widget_input_dropdown( esc_html__( 'Size', 'xstore-core' ), $this->get_field_id( 'size' ), $this->get_field_name( 'size' ), $size, array(
            'small'  => 'Small',
            'normal' => 'Normal',
            'large'  => 'Large',
        ));

        parent::widget_input_dropdown( esc_html__( 'Align', 'xstore-core' ), $this->get_field_id( 'align' ), $this->get_field_name( 'align' ), $align, array(
            'left'   => 'Left',
            'center' => 'Center',
            'right'  => 'Right',
        ));

        parent::widget_input_text( esc_html__( 'Facebook link', 'xstore-core' ), $this->get_field_id( 'facebook' ), $this->get_field_name( 'facebook' ), $facebook );
        parent::widget_input_text( esc_html__( 'Twitter link', 'xstore-core' ), $this->get_field_id( 'twitter' ), $this->get_field_name( 'twitter' ), $twitter );
        parent::widget_input_text( esc_html__( 'Instagram link', 'xstore-core' ), $this->get_field_id( 'instagram' ), $this->get_field_name( 'instagram' ), $instagram );
        parent::widget_input_text( esc_html__( 'Google + link', 'xstore-core' ), $this->get_field_id( 'google' ), $this->get_field_name( 'google' ), $google);
        parent::widget_input_text( esc_html__( 'Pinterest link', 'xstore-core' ), $this->get_field_id( 'pinterest' ), $this->get_field_name( 'pinterest' ), $pinterest );
        parent::widget_input_text( esc_html__( 'LinkedIn link', 'xstore-core' ), $this->get_field_id( 'linkedin' ), $this->get_field_name( 'linkedin' ), $linkedin );
        parent::widget_input_text( esc_html__( 'Tumblr link', 'xstore-core' ), $this->get_field_id( 'tumblr' ), $this->get_field_name( 'tumblr' ), $tumblr );
        parent::widget_input_text( esc_html__( 'YouTube link', 'xstore-core' ), $this->get_field_id( 'youtube' ), $this->get_field_name( 'youtube' ), $youtube );
        parent::widget_input_text( esc_html__( 'Vimeo link', 'xstore-core' ), $this->get_field_id( 'vimeo' ), $this->get_field_name( 'vimeo' ), $vimeo );
        parent::widget_input_text( esc_html__( 'RSS link', 'xstore-core' ), $this->get_field_id( 'rss' ), $this->get_field_name( 'rss' ), $rss );
        parent::widget_input_text( esc_html__( 'VK link', 'xstore-core' ), $this->get_field_id( 'vk' ), $this->get_field_name( 'vk' ), $vk );
        parent::widget_input_text( esc_html__( 'Houzz link', 'xstore-core' ), $this->get_field_id( 'vk' ), $this->get_field_name( 'houzz' ), $houzz );

        parent::widget_input_text( esc_html__( 'Tripadvisor link', 'xstore-core' ), $this->get_field_id( 'tripadvisor' ), $this->get_field_name( 'tripadvisor' ), $tripadvisor );

        parent::widget_input_dropdown( esc_html__( 'Link Target', 'xstore-core' ), $this->get_field_id('target'),$this->get_field_name('target'), $target, array(
            '_self'  => 'Current window',
            '_blank' => 'Blank',
        ));
    }
}