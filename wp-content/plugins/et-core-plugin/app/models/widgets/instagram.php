<?php
namespace ETC\App\Models\Widgets;

use ETC\App\Models\Widgets;

/**
 * Instagram widget.
 *
 * @since      1.4.4
 * @package    ETC
 * @subpackage ETC/Models/Widgets
 */
class Instagram extends Widgets {



    function __construct() {

        $API_type     = 'personal';
        $account_type = 'PERSONAL';
        $this->force_tag    = apply_filters( 'et_instagram_force_tag', false );
        $global_user = '';
        $widget_ops  = array(
            'classname'   => 'null-instagram-feed',
            'description' => esc_html__('Displays your latest Instagram photos', 'xstore-core')
        );
        parent::__construct('null-instagram-feed', '8theme - ' . esc_html__('Instagram', 'xstore-core'), $widget_ops);
    }

    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        $title    = empty( $instance['title'] ) ? '' : $instance['title'];
        $username = empty( $instance['username'] ) ? '' : $instance['username'];
        $limit    = empty( $instance['number'] ) ? 9 : $instance['number'];
        $columns  = empty( $instance['columns'] ) ? 3 : (int) $instance['columns'];
        $size     = empty( $instance['size'] ) ? 'thumbnail' : $instance['size'];
        $img_type = empty( $instance['img_type'] ) ? 'default' : $instance['img_type'];
        $target   = empty( $instance['target'] ) ? '_self' : $instance['target'];
        $user     = empty( $instance['user'] ) ? '' : $instance['user'];
        $link     = empty( $instance['link'] ) ? '' : $instance['link'];
        $slider   = empty( $instance['slider'] ) ? false : true;
        $spacing  = empty( $instance['spacing'] ) ? false : true;
        $type     = empty( $instance['type'] ) ? 'widget' : $instance['type'];
        $tag_type = empty( $instance['tag_type'] ) ? false : $instance['tag_type'];

        // slider args
        $large           = empty( $instance['large'] ) ? 5 : $instance['large'];
        $notebook        = empty( $instance['notebook'] ) ? 4 : $instance['notebook'];
        $tablet_land     = empty( $instance['tablet_land'] ) ? 3 : $instance['tablet_land'];
        $tablet_portrait = empty( $instance['tablet_portrait'] ) ? 2 : $instance['tablet_portrait'];
        $mobile          = empty( $instance['mobile'] ) ? 1 : $instance['mobile'];
        $slider_autoplay = empty( $instance['slider_autoplay'] ) ? false : true;
        $slider_stop_on_hover = empty( $instance['slider_stop_on_hover'] ) ? false : true;
        $slider_speed    = empty( $instance['slider_speed'] ) ? 300 : $instance['slider_speed'];
        $slider_interval = empty( $instance['slider_interval'] ) ? 3000 : $instance['slider_interval'];
        $slider_loop     = empty( $instance['slider_loop'] ) ? false : true;
        $pagination_type = empty( $instance['pagination_type'] ) ? 'hide' : $instance['pagination_type'];
        $default_color   = empty( $instance['default_color'] ) ? '#e6e6e6' : $instance['default_color'];
        $active_color    = empty( $instance['active_color'] ) ? '#b3a089' : $instance['active_color'];
        $hide_fo         = empty( $instance['hide_fo'] ) ? '' : $instance['hide_fo'];
        $hide_buttons    = empty( $instance['hide_buttons'] ) ? false : true;
        $hide_buttons_for = empty( $instance['hide_buttons_for'] ) ? '' : $instance['hide_buttons_for'];
        $is_preview      = empty( $instance['is_preview'] ) ? false : true;


        if ( $type == 'widget' ) {
            $before_widget = str_replace('widget', 'sidebar-widget', $before_widget);
            $before_widget = str_replace('sidebar-sidebar-widget', 'sidebar-widget', $before_widget);
            $img_type = 'squared';
        }

        echo $before_widget;
        if(!empty($title)) { echo $before_title . $title . $after_title; };

        do_action( 'etheme_before_widget', $instance );

            $instagram['data'] = array();

            $tag = str_replace('#', '', $username);

            // Remove it after instagram update
            if ( ! $user ) {
                $user = apply_filters( 'et_escape_instagram_user', $user );
            }

            if ( ! $user ) {
                echo '<p class="woocommerce-info">' . esc_html__( 'To use this element select instagram user' ) . '</p>';
            } else {
                $instagram = $this->et_get_instagram($limit, $tag, '', $user, $type, $tag_type);

                if ( is_wp_error( $instagram ) ) {
                    echo $instagram->get_error_message();
                } else {

                    $box_id   = rand(1000,10000);

                    $imgclass = $swiper_container = $swiper_wrapper ='';
                    $attr = array();

                    if($slider) {
                        $swiper_container = 'swiper-container';
                        $swiper_container .= ( $slider_stop_on_hover ) ? ' stop-on-hover' : '';
                        $swiper_container .= ' slider-' . $box_id;
                        $swiper_container .= ( $pagination_type == 'lines' ) ? ' swiper-pagination-lines' : '';
                        $swiper_wrapper   = 'swiper-wrapper';

                        switch ($instance['size']) {
                            case 'thumbnail':
                                $tablet_land = 6;
                                break;
                            case 'medium':
                                $notebook = 5;
                                break;
                        }

                        $autoplay = '';
                        $speed = '300';

                        if ( $slider_autoplay ) {
                            $autoplay = $slider_interval;
                            $speed    = $slider_speed;
                        }

                        $attr = array(
                            'data-breakpoints="1"',
                            'data-xs-slides="' . esc_attr($mobile) . '"',
                            'data-sm-slides="' . esc_attr($tablet_land) . '"',
                            'data-md-slides="' . esc_attr($notebook) . '"',
                            'data-lt-slides="' . esc_attr($large) . '"',
                            'data-slides-per-view="' . esc_attr($large) . '"',
                            'data-autoplay="' . esc_attr($autoplay) . '"',
                            'data-speed="' . esc_attr($speed) . '"'
                        );
                        if ( $slider_loop )
                            $attr[] = 'data-loop="true"';
                    }

                    ?>
                    <div class="swiper-entry">

                    <div
                        class="widget null-instagram-feed <?php echo esc_attr($swiper_container); ?><?php if($spacing) echo ' instagram-no-space'; ?>"
                        <?php echo implode(' ', $attr); ?>
                    >

                    <ul class="<?php echo esc_attr($swiper_wrapper); ?> instagram-pics clearfix instagram-size-<?php echo esc_attr( $size ); ?> instagram-columns-<?php echo esc_attr( $columns ); ?>" data-force-tag="<?php echo esc_attr($this->force_tag); ?>">
                        <?php

                            foreach ( $instagram['data'] as $item ) {

                                if ( $this->API_type == 'old' || $this->force_tag ) {
                                // if ( $this->API_type == 'old' ) {
                                    switch ( $size ) {
                                        case 'thumbnail':
                                            $image_src = $item['images']['thumbnail']['url'];
                                            break;
                                        case 'medium':
                                            $image_src = $item['images']['low_resolution']['url'];
                                            break;
                                        case 'large':
                                            $image_src = $item['images']['standard_resolution']['url'];
                                            break;
                                        default:
                                            $image_src = $item['images']['low_resolution']['url'];
                                            break;
                                    }
                                } else {
                                    if ( isset($item['thumbnail_url']) ) {
                                        $image_src = $item['thumbnail_url'];
                                    } elseif( isset($item['media_url']) && ! empty( $item['media_url'] ) ){
                                        $image_src = $item['media_url'];
                                    } else {
                                        $image_src = ET_CORE_URL . 'app/controllers/images/instagram/placeholder.jpg';
                                    }
                                }
                                

                                    if ( $link != '' ) {
                                        if ( $this->API_type == 'old' ) {
                                            $username = $item['user']['username'];
                                        } else {
                                            $username = $this->global_user;
                                        }
                                    }

                                    $src = 'src="' . esc_url( $image_src ) . '"';

                                    $slider_src = 'class="swiper-lazy" data-src="'. esc_url( $image_src ) .'"';

                                    $style = 'background: url('.esc_url( $image_src ).');background-size: cover;height: 100%;background-repeat: no-repeat;background-position: center;width: 100%;padding-top: 100%;';

                                    $img_style = 'visibility: hidden; opacity: 0; position: absolute;';

                                    if ( $img_type == 'default' )
                                        $style = $img_style = '';

                                    if ( $this->API_type == 'old' || $this->force_tag ) {
                                        printf(
                                            '<li %s>
                                                <a href="%s" target="%s" rel="noopener" style="%s">
                                                    %s
                                                    <img %s  alt="%s" title="%s" width="1080" height="1080" class="%s" style="%s"/>
                                                     <div class="insta-info">
                                                        <span class="insta-likes">%s</span>
                                                        <span class="insta-comments">%s</span>
                                                    </div>
                                                </a>
                                            </li>',
                                            ($slider) ? 'class="swiper-slide"' : '',
                                            esc_url( $item['link'] ),
                                            esc_attr( $target ),
                                            $style,
                                            ($slider) ? etheme_loader(false, 'swiper-lazy-preloader') : '',
                                            ($slider) ? $slider_src : $src,
                                            esc_attr( $item['caption']['text'] ),
                                            esc_attr( $item['caption']['text'] ),
                                            $imgclass,
                                            $img_style,
                                            $item['likes']['count'],
                                            $item['comments']['count']
                                        );
                                    } else {
                                        if ( $this->account_type == 'PERSONAL' ) {
                                            printf(
                                                '<li %s>
                                                    <a href="%s" target="%s" rel="noopener" style="%s">
                                                        %s
                                                        <img %s  alt="%s" title="%s" width="1080" height="1080" class="%s" style="%s"/>
                                                        <i class="et-icon et-gallery et-inst-media-type media-type-%s"></i>
                                                    </a>
                                                </li>',
                                                ($slider) ? 'class="swiper-slide"' : '',
                                                esc_url( $item['permalink'] ),
                                                esc_attr( $target ),
                                                $style,
                                                ($slider) ? etheme_loader(false, 'swiper-lazy-preloader') : '',
                                                ($slider) ? $slider_src : $src,
                                                // esc_attr( $item['caption'] ),
                                                '',
                                                // esc_attr( $item['caption'] ),
                                                '',
                                                $imgclass,
                                                $img_style,
                                                strtolower($item['media_type'])
                                            );
                                        } else {
                                            printf(
                                                '<li %s>
                                                    <a href="%s" target="%s" rel="noopener" style="%s">
                                                        %s
                                                        <img %s  alt="%s" title="%s" width="1080" height="1080" class="%s" style="%s"/>
                                                         <div class="insta-info">
                                                            <span class="insta-likes">%s</span>
                                                            <span class="insta-comments">%s</span>
                                                        </div>
                                                        <i class="et-icon et-gallery et-inst-media-type media-type-%s"></i>
                                                    </a>
                                                </li>',
                                                ($slider) ? 'class="swiper-slide"' : '',
                                                esc_url( $item['permalink'] ),
                                                esc_attr( $target ),
                                                $style,
                                                ($slider) ? etheme_loader(false, 'swiper-lazy-preloader') : '',
                                                ($slider) ? $slider_src : $src,
                                                '',
                                                '',
                                                $imgclass,
                                                $img_style,
                                                $item['like_count'],
                                                $item['comments_count'],
                                                strtolower($item['media_type'])
                                            );
                                        }
                                        
                                }
                            }
                        ?>
                        
                    </ul>
                    <?php if ($slider && $pagination_type != "hide") { 
                            $pagination_class = '';
                            if ( $hide_fo == 'mobile' )
                                $pagination_class = ' mob-hide';
                            elseif ( $hide_fo == 'desktop' )
                                $pagination_class = ' dt-hide';
                            echo '<div class="swiper-pagination etheme-css ' . esc_html( $pagination_class ) . '" data-css=".slider-'.$box_id.' .swiper-pagination-bullet{background-color:'.$default_color.';} .slider-'.$box_id.' .swiper-pagination-bullet:hover{ background-color:'.$active_color.'; } .slider-'.$box_id.' .swiper-pagination-bullet-active{ background-color:'.$active_color.'; }"></div>'; 
                        } ?>
                    </div>
                    <?php 
                        if ( $slider && ( ! $hide_buttons || ( $hide_buttons && $hide_buttons_for != 'both' ) ) ) {
                            $navigation_class = '';
                            if ( $hide_buttons_for == 'desktop' ) 
                                $navigation_class = ' dt-hide';
                            elseif ( $hide_buttons_for == 'mobile' ) 
                                $navigation_class = ' mob-hide';
                            ?>
                            <div class="swiper-custom-left swiper-nav <?php echo esc_attr($navigation_class); ?>"></div>
                            <div class="swiper-custom-right swiper-nav <?php echo esc_attr($navigation_class); ?>"></div>
                    <?php } ?>
                    </div>
                    <?php
                    if($slider) {
                        $large_items = 6;
                        switch ($instance['size']) {
                            case 'thumbnail':
                                $large_items = 8;
                            break;
                            case 'medium':
                                $large_items = 6;
                            break;
                            case 'large':
                                $large_items = 4;
                            break;
                        }
                    }
                }
            }
            
        if ( $link != '' ) { ?>
            <p class="clear">
                <a href="//instagram.com/<?php echo trim($username); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>">
                    <?php echo $link; ?>
                </a>
            </p><?php
        }

        do_action( 'etheme_after_widget', $instance );

        if ( $is_preview ) 
            echo '<script>jQuery(document).ready(function(){ etTheme.global_image_lazy(); etTheme.addSwiperLazy(); etTheme.swiperFunc(); }); </script>';

        echo $after_widget;
    }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__('Instagram', 'xstore-core'), 'username' => '', 'link' => esc_html__('Follow Us', 'xstore-core'), 'number' => 12, 'size' => 'thumbnail', 'target' => '_self', 'user' =>'') );
        $title    = esc_attr( $instance['title'] );
        $username = esc_attr( $instance['username'] );
        $number   = absint( $instance['number'] );
        $size     = esc_attr( $instance['size'] );
        $columns  = ( ! isset( $instance['columns'] ) ) ? '' : $instance['columns'];
        $target   = esc_attr( $instance['target'] );
        $user     = esc_attr( $instance['user'] );
        $link     = esc_attr( $instance['link'] );
        $spacing  = ( ! isset( $instance['spacing'] ) ) ? '' : esc_attr( $instance['spacing'] );
        $tag_type = ( ! isset( $instance['tag_type'] ) ) ? 'recent_media' : esc_attr( $instance['tag_type'] );
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'xstore-core'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('user'); ?>"><?php esc_html_e('Choose Instagram account', 'xstore-core'); ?>:</label>
            <select id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" class="widefat">
                <option value="" <?php selected( '', $user ); ?>> </option>
                <?php
                    $api_data = get_option( 'etheme_instagram_api_data' );
                    $api_data = json_decode($api_data, true);

                    if ( is_array($api_data) && count( $api_data ) ) {
                        foreach ( $api_data as $key => $value ) {
                            $value = json_decode( $value, true );
                            ?>
                            <option value="<?php echo $key ?>" <?php selected( $key, $user ); ?>><?php echo $value['data']['username']; ?></option>
                        <?php 
                        }
                    }
                ?>
            </select>
        </p>
        <p>
            <a href="<?php echo admin_url('admin.php?page=et-panel-social') ?>" target="_blank"><?php esc_html_e('Add Instagram account?', 'xstore-core'); ?></a>
        </p>

        <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php esc_html_e('Hashtag', 'xstore-core'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></label></p>
            
        <p><label for="<?php echo $this->get_field_id('tag_type'); ?>"><?php esc_html_e('Sort by', 'xstore-core'); ?>:</label>
            <select id="<?php echo $this->get_field_id('tag_type'); ?>" name="<?php echo $this->get_field_name('tag_type'); ?>" class="widefat">
                <option value="recent_media" <?php selected('recent_media', $tag_type) ?>>Recent media</option>
                <option value="top_media" <?php selected('top_media', $tag_type) ?>>Top media</option>
            </select>
        </p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number of photos', 'xstore-core'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('size'); ?>"><?php esc_html_e('Image size', 'xstore-core'); ?>:</label>
            <select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="widefat">
                <option value="thumbnail" <?php selected('thumbnail', $size) ?>><?php esc_html_e('Thumbnail', 'xstore-core'); ?></option>
                <option value="medium" <?php selected('medium', $size) ?>><?php esc_html_e('Medium', 'xstore-core'); ?></option>
                <option value="large" <?php selected('large', $size) ?>><?php esc_html_e('Large', 'xstore-core'); ?></option>
            </select>
        </p>

        <p><label for="<?php echo $this->get_field_id('target'); ?>"><?php esc_html_e('Open links in', 'xstore-core'); ?>:</label>
            <select id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" class="widefat">
                <option value="_self" <?php selected('_self', $target) ?>><?php esc_html_e('Current window (_self)', 'xstore-core'); ?></option>
                <option value="_blank" <?php selected('_blank', $target) ?>><?php esc_html_e('New window (_blank)', 'xstore-core'); ?></option>
            </select>
        </p>
        <p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php esc_html_e('Columns', 'xstore-core'); ?>:</label>
            <select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" class="widefat">
                <option value="2" <?php selected(2, $columns) ?>>2</option>
                <option value="3" <?php selected(3, $columns) ?>>3</option>
                <option value="4" <?php selected(4, $columns) ?>>4</option>
            </select>
        </p>
        <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php esc_html_e('Link text', 'xstore-core'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>

        <p>
            <input type="checkbox" <?php checked( true, $spacing, true); ?> id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>">
            <label for="<?php echo $this->get_field_id('spacing'); ?>"><?php esc_html_e('Without spacing', 'xstore-core'); ?></label>
        </p>
        <?php

    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']    = strip_tags( $new_instance['title'] );
        $instance['username'] = trim( strip_tags( $new_instance['username'] ) );
        $instance['tag_type'] =  ( $new_instance['tag_type'] ) ? $new_instance['tag_type'] : 'recent_media';
        $instance['number']   = ! absint( $new_instance['number'] ) ? 12 : $new_instance['number'];
        $instance['columns']  = ! absint( $new_instance['columns'] ) ? 4 : $new_instance['columns'];
        $instance['size']     = ( in_array( $new_instance['size'], array( 'thumbnail', 'medium', 'large', 'small' ) ) ) ? $new_instance['size'] : 'thumbnail';
        $instance['target']   = ( ( in_array( $new_instance['target'], array('_self', '_blank') ) ) ? $new_instance['target'] : '_self' );
        $instance['user']     =  ( $new_instance['user'] ) ? $new_instance['user'] : '' ;
        $instance['link']     = strip_tags( $new_instance['link'] );
        $instance['slider']   = ( $new_instance['slider'] != '' ) ? true : false;
        $instance['spacing']  = ( $new_instance['spacing'] != '' ) ? true : false;
       
        
        return $instance;
    }

    function et_get_instagram( $number = '' , $tag, $last = '', $token = false, $type, $tag_type ){
        $count    = $number;
        $api_data = get_option( 'etheme_instagram_api_data' );
        $api_data = json_decode($api_data, true);
        $username = '';

        if ( ! is_array($api_data) ) {
            $api_data = array();
        }

        if ( ! count($api_data) ) {
            return new \WP_Error('error', esc_html__( 'Error: To use this element select instagram user', 'xstore-core' ) );
        }

        foreach ( $api_data as $key => $value ) {
            $value = json_decode( $value, true );

            if ( $key == $token ) {
                $this->api_type($value);

                if ( $this->API_type == 'old' ) {
                    $username = $value['data']['username'];
                    $user_id  = '';

                } else {
                    $username = $value['username'];
                    $user_id  = $value['id'];
                    $this->global_user = $username;
                }
            }
        }

        if ( ! $username ) {
           return new \WP_Error('error', esc_html__( 'Error: To use this element select instagram user', 'xstore-core' ) );
        }

        if ( $tag ) {
            $instagram = get_transient('etheme-instagram-data-tag-' . $tag . '-' . $type);
        } else {
            if ( $username ) {
                $instagram = get_transient( 'etheme-instagram-data-user-' . $username . '-' . $type);
            } else {
                return new \WP_Error('error', esc_html__( 'Error: To use this element select instagram user', 'xstore-core' ) );
            }
        }

        $callback = $instagram;

        if ( $last ) {
            $instagram = false;
        }

        if ( $instagram === false || isset( $_GET['et_reinit_instagram'] ) ) {
            $api_settings = get_option( 'etheme_instagram_api_settings' );
            $api_settings = json_decode($api_settings, true);
            
            $insta_time = etheme_get_option( 'instagram_time' );

            switch ( $api_settings['time_type'] ) {
                case 'min':
                    $insta_time = $api_settings['time'] * MINUTE_IN_SECONDS;
                    break;

                case 'hour':
                    $insta_time = $api_settings['time'] * HOUR_IN_SECONDS;
                    break;

                case 'day':
                    $insta_time = $api_settings['time'] * DAY_IN_SECONDS;
                    break;
                default:
                    $insta_time = 2*HOUR_IN_SECONDS;
                    break;
            }

            if ( ! $token ) {
                return new \WP_Error('error', esc_html__( 'Error: To use this element enter instagram access token', 'xstore-core' ) );
            }

            if ( ! $number ) {
                $number = '&count=33';
            } else {
                $number = '&count=' . $number;
            }

            if ( $last ) {
                $last = '&max_id=' . $last;
            }

            if ( $this->API_type == 'old' ) {
                $url = $this->old_api_url($token,$last,$number,$tag);
            } else {
                $url = $this->new_api_url($number,$user_id,$token,$tag,$tag_type);
            }

            // if (!empty( $tag )) {
            if (!empty( $tag ) && ( $this->API_type == 'old' || $this->force_tag ) ) {
                $callback = $this->old_api_url($token,$last,$number,$tag);

            } else {
                $callback = $this->instagram_callback($url,$tag);
            }

            if ( $tag ) {
                set_transient( 'etheme-instagram-data-tag-' . $tag . '-' . $type, $callback, $insta_time );
            } else {
                set_transient( 'etheme-instagram-data-user-' . $username . '-' . $type, $callback, $insta_time );
            }
        }
        return $callback;
    }

    function api_type($data){
        if ( isset($data['data']['username']) ) {
            $this->API_type = 'old';
        } else {
            $this->API_type = 'personal';
            $this->account_type = $data['account_type'];
        }
    }

    private function new_api_url($number,$user_id,$token,$tag,$tag_type){
        $number = str_replace('count', 'limit', $number);
                    
        if ( $this->account_type == 'PERSONAL' ) {
            $url = 'https://graph.instagram.com/'.$user_id.'/media?fields=id,media_type,media_url,permalink,thumbnail_url,caption&access_token=' . $token . $number;
        } else {

            if ( !empty( $tag ) ) {
                //hashtag ID by user ID
                $tag_url = 'https://graph.facebook.com/v6.0/ig_hashtag_search?user_id='.$user_id.'&q='. $tag .'&access_token=' . $token;
                $tag_data = wp_remote_get($tag_url);
                $tag_data = wp_remote_retrieve_body( $tag_data );
                $tag_data = json_decode($tag_data, true);

                $tag_type = ($tag_type) ? $tag_type : 'recent_media';

                $url = 'https://graph.facebook.com/'.$tag_data['data'][0]['id'].'/'. $tag_type .'?user_id='.$user_id.'&fields=id,media_type,comments_count,like_count,media_url,permalink&access_token=' . $token . $number;
            } else {
                $url = 'https://graph.facebook.com/v6.0/'.$user_id.'/media?fields=id,media_type,media_url,like_count,permalink,comments_count,thumbnail_url&access_token=' . $token . $number;
            }
        }
        return $url;
    }

    private function old_api_url($token,$last,$number,$tag){
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $token . $last . $number;

        if ( ! $tag ) {
            return $url;
        }

        $count = str_replace('&count=', '', $number);

        global $wp_version;
        $url = 'https://www.instagram.com/explore/tags/' . $tag . '/?__a=1';

        $callback = wp_remote_get( $url, array(
            'user-agent' => 'Instagram/' . $wp_version . '; ' . home_url()
        ) );

        if ( is_wp_error( $callback ) ){
            return new \WP_Error( 'error', esc_html__( 'Unable to communicate with Instagram.', 'xstore-core' ) );

        }
        if ( 200 != wp_remote_retrieve_response_code( $callback ) ){
            return new \WP_Error( 'error', esc_html__( 'Instagram did not return a 200.', 'xstore-core' ) );

        }

        $callback = wp_remote_retrieve_body( $callback );
        $callback = json_decode($callback, true);

        if ( isset( $callback['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
            $images = $callback['graphql']['user']['edge_owner_to_timeline_media']['edges'];
        } elseif ( isset( $callback['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
            $images = $callback['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
        } else {
            return new \WP_Error( 'error', esc_html__( 'Instagram has returned invalid data.', 'wp-instagram-widget' ) );
        }

        $i = 0;

        $instagram = array();
        foreach ( $images as $image ) {
            
            if ( $i == $count ) {
                break;
            }

            $i++;
            $caption = __( 'Instagram Image', 'wp-instagram-widget' );
            if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
                $caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
            }
            $instagram['data'][] = array(
                'images' => array(
                    'thumbnail' => array(
                        'url' => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
                        'width' => '150',
                        'height' => '150',
                    ), 
                    'low_resolution' => array(
                        'url' => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
                        'width' => '320',
                        'height' => '320',
                    ), 
                    'standard_resolution' => array(
                        'url' => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
                        'width' => '640',
                        'height' => '640',
                    ), 
                ),
                'caption'     => array(
                    'text' => $caption
                ),
                $caption,
                'user' => array(
                    'username' => ''
                ),
                'link'        => trailingslashit( '//www.instagram.com/p/' . $image['node']['shortcode'] ),
                'comments'    => array(
                    'count' => $image['node']['edge_media_to_comment']['count'],
                ), 
                'likes'       => array(
                    'count' => $image['node']['edge_liked_by']['count'],
                ), 
            );
        }

        $callback = $instagram;

        return $callback;
    }

    private function instagram_callback($url, $tag){
        $callback = wp_remote_get( $url );

        if ( ! isset($callback['response']) ) {
            return new \WP_Error('error', esc_html__( 'Error: Can not get response', 'xstore-core' ));
        } elseif( ! isset( $callback['response']['code'] ) ){
            return new \WP_Error('error', esc_html__( 'Error: Can not get response code', 'xstore-core' ));
        } elseif( $callback['response']['code'] != 200 ){

            $callback = wp_remote_retrieve_body( $callback );
            $callback = json_decode($callback);

            return new \WP_Error('error', esc_html__( 'Error: ', 'xstore-core' ) . $callback->meta->error_message);
        }

        $callback = wp_remote_retrieve_body( $callback );
        $callback = json_decode($callback, true);
            
        if ( empty( $callback ) ) {
            return new \WP_Error('error', esc_html__( 'Error: instagram did not return any dada', 'xstore-core' ));
        } 
        // To show more than 50 posts
        // else {
        //     if ( count($callback['data']) < $count && $this->API_type == 'old' ) {
        //         $number = $count - count($callback['data']);
        //         $last_id = end($callback['data']);
        //         $new_callback = $this->et_get_instagram($number , $tag, $last_id['id'], $token, $type);
        //         $callback['data'] = array_merge($callback['data'], $new_callback['data']);
        //     }
        // }

        if ($tag) {
            foreach ($callback['data'] as $key => $value) {
                if ($value['media_type'] === 'CAROUSEL_ALBUM' || $value['media_type'] === 'VIDEO') {
                    $callback['data'][$key]['media_url'] = $value['permalink'] . 'media?size=l';
                }
            }
        }
        return $callback;
    }
}