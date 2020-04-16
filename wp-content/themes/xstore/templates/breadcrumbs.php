<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
/**
 * The template for displaying theme breadcrumbs
 *
 * @since   6.4.5
 * @version 1.0.0
 */

global $post;

    if( function_exists( 'is_bbpress' ) && is_bbpress() ) {
        bbp_breadcrumb();
        return;
    }

    $args = array(
        'delimiter'   => '<span class="delimeter"><i class="et-icon et-right-arrow"></i></span>',
        'home'        => esc_html__( 'Home', 'xstore' ),
        'showCurrent' => 0,
        'before'      => '<span class="current">',
        'after'       => '</span>',
    );

    $post_page    = get_option( 'page_for_posts' );
    $title_at_end = '<a href="' . get_permalink( $post_page ) . '">' . esc_html__( 'Blog', 'xstore' ) . '</a>';
    $homeLink     = home_url();
    $title        = '';
    $html         = '';

    if( is_home() ) {
        if( empty( $post_page ) && ! is_single() && ! is_page() ) $title = esc_html__( 'Blog', 'xstore' );
        $title = get_the_title( $post_page );
    }

    if ( is_front_page() ) {
        $title = '';
    } else if ( class_exists( 'bbPress' ) && is_bbpress() ) {
        $title    = esc_html__( 'Forums', 'xstore' );
        $bbp_args = array(
            'before' => '<div class="breadcrumbs" id="breadcrumb">',
            'after'  => '</div>'
        );
        bbp_breadcrumb($bbp_args);
    } else {
        $html .= '<div class="breadcrumbs">';
        $html .= '<div id="breadcrumb">';
        $html .= '<a href="' . $homeLink . '">' . $args['home'] . '</a> ' . $args['delimiter'] . ' ';

        if ( is_category() ) {
            $title        = esc_html__( 'Category: ', 'xstore' ) . single_cat_title( '', false );
            $title_at_end = '';
            $thisCat      = get_category( get_query_var( 'cat' ), false );
            $cat_id       = get_cat_ID( single_cat_title( '', false ) );

            if ( $thisCat->parent != 0 ){
                $html .= get_category_parents( $thisCat->parent, true, ' ' . $args['delimiter'] . ' ' );
            }

            $html .= sprintf( 
                '<a class="current" href="%s">%s%s "%s"%s</a>',
                get_category_link( $cat_id ),
                $args['before'],
                esc_html__( 'Archive by category', 'xstore' ),
                single_cat_title( '', false ),
                $args['after']
            );
        } elseif ( is_search() ) {
            $title = esc_html__( 'Search Results for: ', 'xstore' ) . get_search_query();
        } elseif ( is_day() ) {
            $title        = esc_html__( 'Daily Archives: ', 'xstore' ) . get_the_date();
            $title_at_end = '';

            $html .= sprintf( 
                '<a href="%s">%s</a> %s',
                get_year_link( get_the_time( 'Y' ) ),
                get_the_time( 'Y' ),
                $args['delimiter']
            );
            $html .= sprintf( 
                '<a href="%s">%s</a> %s',
                get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
                get_the_time( 'F' ),
                $args['delimiter']
            );
            $html .= sprintf( 
                '<a class="current" href="%s">%s%s%s</a>',
                get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'j' ) ),
                $args['before'],
                get_the_time( 'd' ),
                $args['after']
            );
        } elseif ( is_month() ) {
            $title        = esc_html__( 'Monthly Archives: ', 'xstore') . get_the_date( _x( 'F Y', 'monthly archives date format', 'xstore' ) );
            $title_at_end = '';

            $html .= sprintf( 
                '<a href="%s">%s</a> %s',
                get_year_link( get_the_time( 'Y' ) ),
                get_the_time( 'Y' ),
                $args['delimiter']
            );
            $html .= sprintf( 
                '<a class="current" href="%s">%s%s%s</a>',
                get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
                $args['before'],
                get_the_time( 'F' ),
                $args['after']
            );
        } elseif ( is_year() ) {
            $title        = esc_html__( 'Yearly Archives: ', 'xstore' ) . get_the_date( _x( 'Y', 'yearly archives date format', 'xstore' ) );
            $title_at_end = '';

            $html .= sprintf( 
                '<a class="current" href="%s">%s%s%s</a>',
                get_year_link( get_the_time( 'Y' ) ),
                $args['before'],
                get_the_time( 'Y' ),
                $args['after']
            );
        } elseif ( is_single() && ! is_attachment() ) {
            $title = get_the_title();
            if ( get_post_type() == 'etheme_portfolio' ) {
                $portfolioId   = etheme_get_option( 'portfolio_page' );
                $portfolioLink = get_permalink( $portfolioId );
                $post_type     = get_post_type_object( get_post_type() );
                $page          = get_page( $portfolioId );
                $slug          = $post_type->rewrite;
                $title_at_end  = $page->post_title;

                $html .= '<a href="' . $portfolioLink . '">' . $title_at_end . '</a>';
                $title_at_end = '<a href="' . $portfolioLink . '">' . $title_at_end . '</a>';

                if ( $args['showCurrent'] == 1 ){
                    $html .= ' ' . $args['delimiter'] . ' ' . $args['before'] . get_the_title() . $args['after'];
                }
            } elseif ( get_post_type() != 'post' ) {
                $post_type    = get_post_type_object( get_post_type() );
                $slug         = $post_type->rewrite;
                $title_at_end = $post_type->labels->singular_name;
                $title_at_end = '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $title_at_end . '</a>';

                $html .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $title_at_end . '</a>';
                if ( $args['showCurrent'] == 1 ){
                    $html .= ' ' . $args['delimiter'] . ' ' . $args['before'] . get_the_title() . $args['after'];
                } 
            } else {
                $cat = get_the_category();
                if( isset( $cat[0] ) ) {
                    $cat  = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $args['delimiter'] . ' ');

                    if ( $args['showCurrent'] == 0 ) {
                        $cats = $title_at_end = preg_replace("#^(.+)\s" . $args['delimiter'] . "\s$#", "$1", $cats);
                    }
                    $html .= $cats;
                }
                if ( $args['showCurrent'] == 1 ) {
                    $html .= $args['before'] . get_the_title() . $args['after'];
                } 
            }
        } elseif ( is_tax('portfolio_category') ) {
            $title         = single_term_title( '', false );
            $portfolioId   = etheme_get_option( 'portfolio_page' );
            $post          = get_page( $portfolioId );
            $portfolioLink = get_permalink($portfolioId);
            $title_at_end  = $post->post_title;

            $html .= '<a href="' . $portfolioLink . '">' . $title_at_end . '</a>' . $args['delimiter'];
            $title_at_end = '<a href="' . $portfolioLink . '">' . $title_at_end . '</a>' . $args['delimiter'];
        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
            $post_type    = get_post_type_object( get_post_type() );
            $title_at_end = $post_type->labels->singular_name;

            $html .= $args['before'] . $title_at_end . $args['after'];
        } elseif ( is_attachment() ) {
            $parent = get_post( $post->post_parent );
            $title  = get_the_title();

            if ( $args['showCurrent'] == 1 ) {
                $title_at_end = get_the_title();
                $html .= ' '  . $args['before'] . $title_at_end . $args['after'];
            }
        } elseif ( is_page() && ! $post->post_parent ) {
            $title = get_the_title();

            if ( $args['showCurrent'] == 1 ) {
                $title_at_end = get_the_title();
                $html .= $args['before'] . $title_at_end . $args['after'];
            }
        } elseif ( is_page() && $post->post_parent ) {
            $title       = get_the_title();
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page          = get_page( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>' . $args['delimiter'];
                $parent_id     = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs) ;

            for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
                $html .= $breadcrumbs[$i];
                if ( $i != count( $breadcrumbs ) -1 ) $html .= ' ' . $args['delimiter'] . ' ';
            }
            if  ($args['showCurrent'] == 1 ) $html .= ' ' . $args['delimiter'] . ' ' . $args['before'] . get_the_title() . $args['after'];
        } elseif ( is_tag() ) {
            $title        = esc_html__( 'Tag: ', 'xstore' ) . single_tag_title( '', false );
            $title_at_end = single_tag_title( '', false );

            $html .= $args['before'] . 'Posts tagged "' . $title_at_end . '"' . $args['after'];
        } elseif ( is_author() ) {
            global $author;

            $title        = esc_html__( 'All posts by ', 'xstore' ) . get_the_author();
            $userdata     = get_userdata($author);
            $title_at_end = $userdata->display_name;

            $html .= $args['before'] . 'Articles posted by ' . $args['after'] . get_the_author_posts_link();
        } elseif ( is_404() ) {
            $title = esc_html__( 'Page not found', 'xstore' );
            $html .= $args['before'] . 'Error 404' . $args['after'];
        } elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = esc_html__( 'Asides', 'xstore' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = esc_html__( 'Videos', 'xstore' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = esc_html__( 'Audio', 'xstore' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = esc_html__( 'Quotes', 'xstore' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = esc_html__( 'Galleries', 'xstore' );
        } elseif( is_archive() ) {
            $title = esc_html__( 'Archives', 'xstore' );  
        }

        if ( get_query_var( 'paged' ) ) {
            $title = esc_html__( 'Page', 'xstore' ) . ' ' . get_query_var( 'paged' );
            $html .= ( ! empty( $title_at_end ) ) ? $title_at_end . ' ' . $args['delimiter'] : '';
        }

        $html .= '</div>';
            if( etheme_get_option('return_to_previous') ) $html .= etheme_back_to_page();
        $html .= '</div>';

        $html .= ' <h1 class="title"><span>' . $title . '</span></h1>';

        do_action( 'etheme_before_breadcrumbs' );
        echo $html; // All data escaped 
        do_action( 'etheme_after_breadcrumbs' );

    }
