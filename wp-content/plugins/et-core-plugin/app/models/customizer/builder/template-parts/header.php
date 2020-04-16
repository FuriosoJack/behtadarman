<?php if ( ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );
/**
 * The template for displaying header builter of Wordpress customizer
 *
 * @since   1.0.0
 * @version 1.0.0
 */

$Etheme_Customize_Builder = new Etheme_Customize_header_Builder();

$ajax     = false;
$ajax     = apply_filters( 'Etheme_Customize_Builder_ajax', $ajax );
$elements = $Etheme_Customize_Builder->elements;

?>

<div class="et_customizer-builder et_customizer-builder-header hidden">
    <div class="et_header-head align-center flex valign-center equal-columns">
        <div class="flex-left align-left nowrap">
            <span class="et_button desktop active" data-device="desktop">
                <span class="dashicons dashicons-desktop"></span>
                <span><?php esc_html_e( 'Desktop', 'xstore-core' ); ?></span>
            </span>
            <span class="et_button mobile" data-device="mobile">
                <span class="dashicons dashicons-smartphone"></span>
                <span><?php esc_html_e( 'Mobile', 'xstore-core' ); ?></span>
            </span>
            <span class="et_button et_call-multiple-headers">
                <span class="dashicons dashicons-rest-api"></span>
                <span><?php esc_html_e( 'Multiple Headers', 'xstore-core' ); ?></span>
            </span>

        </div>
        <div data-name="<?php esc_html_e('Header builder', 'xstore-core'); ?>" data-mobile-name="<?php esc_html_e('Header builder (mobile)', 'xstore-core'); ?>"></div>
        <div class="multiple-header-name" data-name="" data-name-prefix="You are editing"></div>
        <div class="flex-right align-right nowrap">
            <?php do_action( 'etheme-builder-before-header-right-buttons' ); ?>
            <span class="et_button et_edit" data-section="header_presets_content_separator">
                <span class="dashicons dashicons-schedule"></span>
                <span><?php esc_html_e( 'Templates', 'xstore-core' ); ?></span>
            </span>
            <span class="et_button et_edit" data-section="header_sticky_content_separator">
                <span class="dashicons dashicons-paperclip"></span>
                <span><?php esc_html_e('Header Sticky', 'xstore-core'); ?></span>
            </span>
            <a class="et_button" href="https://www.youtube.com/watch?v=RbdKjQrFnO4&list=PLMqMSqDgPNmDu3kYqh-SAsfUqutW3ohlG&index=2&t=0s" target="_blank">
                <span class="dashicons">
                    <svg height="1.2em" viewBox="0 -77 512.00213 512" width="1.2em" xmlns="http://www.w3.org/2000/svg"><path d="m501.453125 56.09375c-5.902344-21.933594-23.195313-39.222656-45.125-45.128906-40.066406-10.964844-200.332031-10.964844-200.332031-10.964844s-160.261719 0-200.328125 10.546875c-21.507813 5.902344-39.222657 23.617187-45.125 45.546875-10.542969 40.0625-10.542969 123.148438-10.542969 123.148438s0 83.503906 10.542969 123.148437c5.90625 21.929687 23.195312 39.222656 45.128906 45.128906 40.484375 10.964844 200.328125 10.964844 200.328125 10.964844s160.261719 0 200.328125-10.546875c21.933594-5.902344 39.222656-23.195312 45.128906-45.125 10.542969-40.066406 10.542969-123.148438 10.542969-123.148438s.421875-83.507812-10.546875-123.570312zm0 0" fill="#f00"></path><path d="m204.96875 256 133.269531-76.757812-133.269531-76.757813zm0 0" fill="#fff"></path></svg>
                </span>
                <span><?php esc_html_e('Tutorials', 'xstore-core'); ?></span>
            </a>
            <span class="et_button et_collapse-builder" data-panel="header">
                <span class="dashicons dashicons-arrow-down-alt2"></span>
            </span>
        </div>
    </div>
    <div class="et_device et_desktop-mod">
        <?php
            $blocks = ( $ajax ) ? json_decode($ajax['connect_block_package'], true) : Kirki::get_option( 'connect_block_package' );
            if ( $blocks && count( $blocks ) ) {
                foreach ( $blocks as $block ) {
                    if ( $block['data'] ) {
                        $inside = json_decode( $block['data'] );
                        foreach ( $inside as $key => $value ) {
                            unset( $elements[$key] );
                        }
                    }
                }
            }
        ?>

        <div class="et_header-part et_header-top" data-name="Top Header" data-section="header_top_elements">
            <?php
                $data      = ( $ajax ) ? json_decode($ajax['header_top_elements'], true) : json_decode( Kirki::get_option( 'header_top_elements' ), true );
                $cols_html = '';

                if ( $data ) {
                    if ( ! is_array( $data ) ) {
                        $data = array();
                    }

                    uasort( $data, function ( $item1, $item2 ) {
                        return $item1['index'] <=> $item2['index'];
                    });

                    $_i = 0;

                    $count = count( $data );

                    foreach ( $data as $key => $value ) {
                        $_i++;

                        if ( $value['offset'] ) {
                            for ( $i=0; $i < $value['offset']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index'] - $value['offset']  + $i ) . '"></div>';
                            }
                        }

                        $element = $elements[$value['element']];

                        if ( $value['element'] != 'connect_block') {
                           unset( $elements[$value['element']] );
                        }

                        $args = array(
                            'index'    => $value['index'],
                            'offset'   => $value['offset'],
                            'size'     => $value['size'],
                            'element'  => $value['element'],
                            'id'       => $key,
                            'icon'     => ( isset($element['icon']) ) ? $element['icon'] : '',
                            'title'    => $element['title'],
                            'section'  => $element['section'],
                            'section2' => ( isset( $element['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$element['section2'].'"><span class="mt-mes">'.esc_html__('Dropdown settings', 'xstore-core').'</span></span>' : '',
                            'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                        );

                        $cols_html .= $Etheme_Customize_Builder->generate_html( $args, 'column' );

                        if ( $_i == $count) {
                            for ( $i = 1; $i <= 12 - $value['index']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        } else {
                            for ($i=1; $i < $value['size']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        }
                    } 
                } else {
                    for ($i=0; $i < 12; $i++) { 
                        $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $i+1 ) . '"></div>';
                    }
                }
                echo $cols_html;
            ?>
        </div>
        <span class="et_header-settings et_edit dashicons dashicons-admin-generic mtips mtips-left" data-section="top_header_style_separator">
            <span class="mt-mes"><?php esc_html_e( 'Top header settings', 'xstore-core' ); ?></span>
        </span>

        <div class="et_header-part et_header-main" data-name="Main Header" data-section="header_main_elements">
            <?php
                $data      = ( $ajax ) ? json_decode($ajax['header_main_elements'], true) : json_decode( Kirki::get_option( 'header_main_elements' ), true );
                $cols_html = '';

                if ( $data ) {
                    if ( ! is_array( $data ) ) {
                        $data = array();
                    }

                    uasort( $data, function ( $item1, $item2 ) {
                        return $item1['index'] <=> $item2['index'];
                    });

                    $_i = 0;

                    $count = count( $data );

                    foreach ( $data as $key => $value ) {
                        $_i++;

                        if ( $value['offset'] ) {
                            for ( $i=0; $i < $value['offset']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index'] - $value['offset']  + $i ) . '"></div>';
                            }
                        }

                        $element = $elements[$value['element']];

                        if ( $value['element'] != 'connect_block') {
                           unset( $elements[$value['element']] );
                        }

                        $args = array(
                            'index'    => $value['index'],
                            'offset'   => $value['offset'],
                            'size'     => $value['size'],
                            'element'  => $value['element'],
                            'id'       => $key,
                            'icon'     => ( isset($element['icon']) ) ? $element['icon'] : '',
                            'title'    => $element['title'],
                            'section'  => $element['section'],
                            'section2' => ( isset( $element['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$element['section2'].'"><span class="mt-mes">'.esc_html__( 'Dropdown settings', 'xstore-core' ).'</span></span>' : '',
                            'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                        );

                        $cols_html .= $Etheme_Customize_Builder->generate_html( $args, 'column' );

                        if ( $_i == $count) {
                            for ($i = 1; $i <= 12 - $value['index']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        } else {
                            for ($i=1; $i < $value['size']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        }
                    } 
                } else {
                    for ($i=0; $i < 12; $i++) { 
                        $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $i+1 ) . '"></div>';
                    }
                }
                echo $cols_html;
            ?>
        </div>
        <span class="et_header-settings et_edit dashicons dashicons-admin-generic mtips mtips-left" data-section="main_header_style_separator">
            <span class="mt-mes"><?php esc_html_e( 'Main header settings', 'xstore-core' ); ?></span>
        </span>

        <div class="et_header-part et_header-bottom" data-name="Bottom Header" data-section="header_bottom_elements">
            <?php
                $data      = ( $ajax ) ? json_decode($ajax['header_bottom_elements'], true) : json_decode( Kirki::get_option( 'header_bottom_elements' ), true );
                $cols_html = '';

                if ( $data ) {
                    if ( ! is_array( $data ) ) {
                        $data = array();
                    }

                    uasort( $data, function ( $item1, $item2 ) {
                        return $item1['index'] <=> $item2['index'];
                    });

                    $_i = 0;

                    $count = count( $data );

                    foreach ( $data as $key => $value ) {
                        $_i++;

                        if ( $value['offset'] ) {
                            for ( $i=0; $i < $value['offset']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index'] - $value['offset']  + $i ) . '"></div>';
                            }
                        }

                        $element = $elements[$value['element']];

                        if ( $value['element'] != 'connect_block') {
                           unset( $elements[$value['element']] );
                        }

                        $args = array(
                            'index'    => $value['index'],
                            'offset'   => $value['offset'],
                            'size'     => $value['size'],
                            'element'  => $value['element'],
                            'id'       => $key,
                            'icon'     => ( isset($element['icon']) ) ? $element['icon'] : '',
                            'title'    => $element['title'],
                            'section'  => $element['section'],
                            'section2' => ( isset( $element['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$element['section2'].'"><span class="mt-mes">'.esc_html__( 'Dropdown settings', 'xstore-core' ).'</span></span>' : '',
                            'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                        );

                        $cols_html .= $Etheme_Customize_Builder->generate_html($args, 'column');

                        if ( $_i == $count) {
                            for ($i = 1; $i <= 12 - $value['index']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        } else {
                            for ($i=1; $i < $value['size']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        }
                    } 
                } else {
                    for ( $i=0; $i < 12; $i++ ) { 
                        $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $i+1 ) . '"></div>';
                    }
                }
                echo $cols_html;
            ?>
        </div>
        <span class="et_header-settings et_edit dashicons dashicons-admin-generic mtips mtips-left" data-section="bottom_header_style_separator">
            <span class="mt-mes"><?php esc_html_e( 'Bottom header settings', 'xstore-core' ); ?></span>
        </span>
        <div class="et_header-part et_elements">
            <div class="et_column et_col-sm-12 align-center">
                <div class="et_column-inner">
                    <?php foreach ( $elements as $key => $value ): ?>
                        <?php if ( ! in_array( 'header', $value['location'] ) ) continue; ?>
                        <div class="et_customizer-element <?php echo $value['class']; ?> ui-state-default" data-id="element-<?php echo $Etheme_Customize_Builder->generate_random( 5 ); ?>" data-size="1" data-element="<?php echo $key; ?>">
                            <span class="et_name">
                                <span class="dashicons <?php echo $value['icon']; ?>"></span>
                                <?php echo $value['title']; ?>
                            </span>
                            <span class="et_actions">
                                <?php if ( isset($value['element_info']) ) { ?>
                                    <span class="dashicons dashicons-lightbulb mtips mtips-lg">
                                        <span class="mt-mes"><?php echo $value['element_info']; ?></span>
                                    </span>
                                <?php } ?>
                                <span class="dashicons dashicons-admin-generic et_edit mtips" data-section="<?php echo $value['section']; ?>"><span class="mt-mes"><?php esc_html_e( 'Settings', 'xstore-core' ); ?></span></span>
                                <?php if ( isset( $value['section2'] ) ) { ?>
                                    <span class="dashicons dashicons-networking et_edit mtips" data-section="<?php echo $value['section2']; ?>">
                                        <span class="mt-mes"><?php echo esc_html__( 'Dropdown settings', 'xstore-core' ); ?></span>
                                    </span>
                                <?php } ?>
                                <span class="dashicons dashicons-trash et_remove mtips"><span class="mt-mes"><?php esc_html_e( 'Remove', 'xstore-core' ); ?></span></span>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>  
            </div>
              
        </div>
    </div>

    <div class="et_device et_mobile-mod hidden">
        <?php 
            $elements = $Etheme_Customize_Builder->elements;
            // remove some elements on mobile header 
            unset($elements['all_departments']);
            unset($elements['main_menu']);
            unset($elements['secondary_menu']);
            unset($elements['newsletter']);
            unset($elements['contacts']);
            $blocks   = ( $ajax ) ? json_decode($ajax['connect_block_mobile_package'], true) : Kirki::get_option( 'connect_block_mobile_package' );

            if ( $blocks && count( $blocks ) ) {
                foreach ( $blocks as $block ) {
                    if ( $block['data'] ) {
                        $inside = json_decode( $block['data'] );
                        foreach ( $inside as $key => $value ) {
                            unset( $elements[$key] );
                        }
                    }
                }
            }
        ?>


        <div class="et_header-part et_header-top" data-name="Top Header" data-section="header_mobile_top_elements">
            <?php
                $data      = ( $ajax ) ? json_decode( $ajax['header_mobile_top_elements'], true ) : json_decode( Kirki::get_option( 'header_mobile_top_elements' ), true );
                $cols_html = '';

                if ( $data ) {
                    if ( ! is_array( $data ) ) {
                        $data = array();
                    }

                    uasort( $data, function ( $item1, $item2 ) {
                        return $item1['index'] <=> $item2['index'];
                    });

                    $_i = 0;

                    $count = count( $data );

                    foreach ( $data as $key => $value ) {
                        $_i++;

                        if ( $value['offset'] ) {
                            for ( $i=0; $i < $value['offset']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index'] - $value['offset']  + $i ) . '"></div>';
                            }
                        }

                        $element = $elements[$value['element']];

                        if ( $value['element'] != 'connect_block') {
                           unset( $elements[$value['element']] );
                        }

                        $args = array(
                            'index'    => $value['index'],
                            'offset'   => $value['offset'],
                            'size'     => $value['size'],
                            'element'  => $value['element'],
                            'id'       => $key,
                            'icon'     => ( isset($element['icon']) ) ? $element['icon'] : '',
                            'title'    => $element['title'],
                            'section'  => $element['section'],
                            'section2' => ( isset( $element['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$element['section2'].'"><span class="mt-mes">'.esc_html__( 'Dropdown settings', 'xstore-core' ).'</span></span>' : '',
                            'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                        );

                        $cols_html .= $Etheme_Customize_Builder->generate_html( $args, 'column' );

                        if ( $_i == $count) {
                            for ($i = 1; $i <= 12 - $value['index']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        } else {
                            for ($i=1; $i < $value['size']; $i++) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        }
                    } 
                } else {
                    for ($i=0; $i < 12; $i++) { 
                        $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $i+1 ) . '"></div>';
                    }
                }
                echo $cols_html;
            ?>
        </div>
        <span class="et_header-settings et_edit dashicons dashicons-admin-generic mtips mtips-left" data-section="top_header_style_separator">
            <span class="mt-mes"><?php esc_html_e( 'Top header settings', 'xstore-core' ); ?></span>
        </span>
        <div class="et_header-part et_header-main" data-name="Main Header" data-section="header_mobile_main_elements">
            <?php
                $data      = ( $ajax ) ? json_decode( $ajax['header_mobile_main_elements'], true ) : json_decode( Kirki::get_option( 'header_mobile_main_elements' ), true );
                $cols_html = '';

                if ( $data ) {
                    if ( ! is_array( $data ) ) {
                        $data = array();
                    }

                    uasort( $data, function ( $item1, $item2 ) {
                        return $item1['index'] <=> $item2['index'];
                    });

                    $_i = 0;

                    $count = count( $data );

                    foreach ( $data as $key => $value ) {
                        $_i++;

                        if ( $value['offset'] ) {
                            for ( $i=0; $i < $value['offset']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index'] - $value['offset']  + $i ) . '"></div>';
                            }
                        }

                        $element = $elements[$value['element']];

                        if ( $value['element'] != 'connect_block') {
                           unset( $elements[$value['element']] );
                        }

                        $args = array(
                            'index'    => $value['index'],
                            'offset'   => $value['offset'],
                            'size'     => $value['size'],
                            'element'  => $value['element'],
                            'id'       => $key,
                            'icon'     => ( isset($element['icon']) ) ? $element['icon'] : '',
                            'title'    => $element['title'],
                            'section'  => $element['section'],
                            'section2' => ( isset( $element['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$element['section2'].'"><span class="mt-mes">'.esc_html__( 'Dropdown settings', 'xstore-core' ).'</span></span>' : '',
                            'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                        );

                        $cols_html .= $Etheme_Customize_Builder->generate_html( $args, 'column' );

                        if ( $_i == $count) {
                            for ( $i = 1; $i <= 12 - $value['index']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        } else {
                            for ( $i=1; $i < $value['size']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        }
                    } 
                } else {
                    for ( $i=0; $i < 12; $i++ ) { 
                        $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $i+1 ) . '"></div>';
                    }
                }
                echo $cols_html;
            ?>
        </div>
        <span class="et_header-settings et_edit dashicons dashicons-admin-generic mtips mtips-left" data-section="main_header_style_separator">
            <span class="mt-mes"><?php esc_html_e('Main header settings', 'xstore-core'); ?></span>
        </span>

        <div class="et_header-part et_header-bottom" data-name="Bottom Header" data-section="header_mobile_bottom_elements">
            <?php
                $data      = ( $ajax ) ? json_decode( $ajax['header_mobile_bottom_elements'], true ) : json_decode( Kirki::get_option( 'header_mobile_bottom_elements' ), true );
                $cols_html = '';

                if ( $data ) {
                    if ( ! is_array( $data ) ) {
                        $data = array();
                    }

                    uasort( $data, function ( $item1, $item2 ) {
                        return $item1['index'] <=> $item2['index'];
                    });

                    $_i = 0;

                    $count = count( $data );

                    foreach ( $data as $key => $value ) {
                        $_i++;

                        if ( $value['offset'] ) {
                            for ( $i=0; $i < $value['offset']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index'] - $value['offset']  + $i ) . '"></div>';
                            }
                        }

                        $element = $elements[$value['element']];

                        if ( $value['element'] != 'connect_block') {
                           unset( $elements[$value['element']] );
                        }

                        $args = array(
                            'index'   => $value['index'],
                            'offset'  => $value['offset'],
                            'size'    => $value['size'],
                            'element' => $value['element'],
                            'id'      => $key,
                            'icon'     => ( isset($element['icon']) ) ? $element['icon'] : '',
                            'title'    => $element['title'],
                            'section'  => $element['section'],
                            'section2' => ( isset( $element['section2'] ) ) ? '<span class="dashicons dashicons-networking et_edit mtips" data-section="'.$element['section2'].'"><span class="mt-mes">'.esc_html__( 'Dropdown settings', 'xstore-core' ).'</span></span>' : '',
                            'element_info' => ( isset( $element['element_info'] ) ) ? '<span class="dashicons dashicons-lightbulb mtips mtips-lg"><span class="mt-mes">'.$element['element_info'].'</span></span>' : '',
                        );

                        $cols_html .= $Etheme_Customize_Builder->generate_html( $args, 'column' );

                        if ( $_i == $count ) {
                            for ( $i = 1; $i <= 12 - $value['index']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        } else {
                            for ( $i=1; $i < $value['size']; $i++ ) { 
                                $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $value['index']+$i ) . '"></div>';
                            }
                        }
                    } 
                } else {
                    for ( $i=0; $i < 12; $i++ ) { 
                        $cols_html .= '<div class="et_sortable et_column et_col-sm-1" data-index="' . ( $i+1 ) . '"></div>';
                    }
                }
                echo $cols_html;
            ?>
        </div>
        <span class="et_header-settings et_edit dashicons dashicons-admin-generic mtips mtips-left" data-section="bottom_header_style_separator">
            <span class="mt-mes"><?php esc_html_e( 'Bottom header settings', 'xstore-core' ); ?></span>
        </span>

        <div class="et_header-part et_elements">
            <div class="et_column et_col-sm-12 align-center">
                <div class="et_column-inner">
                    <?php foreach ( $elements as $key => $value ): ?>
                        <?php if ( ! in_array( 'header', $value['location'] ) ) continue; ?>
                        <div class="et_customizer-element <?php echo $value['class']; ?> ui-state-default" data-id="element-<?php echo $Etheme_Customize_Builder->generate_random( 5 ); ?>" data-size="1" data-element="<?php echo $key; ?>">
                            <span class="et_name">
                                <span class="dashicons <?php echo $value['icon']; ?>"></span>
                                <?php echo $value['title']; ?>
                            </span>
                            <span class="et_actions">
                                <?php if ( isset($value['element_info']) ) { ?>
                                    <span class="dashicons dashicons-lightbulb mtips mtips-lg">
                                        <span class="mt-mes"><?php echo $value['element_info']; ?></span>
                                    </span>
                                <?php } ?>
                                <span class="dashicons dashicons-admin-generic et_edit mtips" data-section="<?php echo $value['section']; ?>"><span class="mt-mes"><?php esc_html_e( 'Settings', 'xstore-core' ); ?></span></span>
                                <?php if ( isset( $value['section2'] ) ) { ?>
                                    <span class="dashicons dashicons-networking et_edit mtips" data-section="<?php echo $value['section2']; ?>">
                                        <span class="mt-mes"><?php echo esc_html__( 'Dropdown settings', 'xstore-core' ); ?></span>
                                    </span>
                                <?php } ?>
                                <span class="dashicons dashicons-trash et_remove mtips"><span class="mt-mes"><?php esc_html_e( 'Remove', 'xstore-core' ); ?></span></span>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>  
            </div>
        </div>
    </div>
    <span class="hidden et_options-data et_header-options-data">
        <?php echo json_encode( require( ET_CORE_DIR . 'app/models/customizer/builder/template-parts/options-data.php' ) ); ?>
    </span>
 </div>