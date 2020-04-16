var etTheme;

;(function($) {

    "use strict";

    var _functions = {}, swipers = [], winW, winH, fontSize, winScr, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i), _isPhoneW, _isTabletW, bLazy;

    var initIterator = 0;
    function setParams(swiper, dataValue, returnValue){
        return (swiper.is('[data-'+dataValue+']'))?((typeof swiper.data(dataValue)!="string")?parseInt(swiper.data(dataValue), 10):swiper.data(dataValue)):returnValue;
    }

    etTheme = {
        init: function() {
            this.resizeVideo();
            this.addSwiperLazy();
            this.swiperFunc();
            this.isotope();
            this.sitePreloader();
            this.secondaryMenu();
            // this.nanoScroll();
            this.breadcrumbs();
            // this.affixJS();
            this.onePageMenu();
            this.fixedHeader();
            this.fixedFooter();
            this.windowsPhoneFix();
            this.popup();
            this.imagesLightbox();
            this.loadInView();
            this.cleanSpaces();
            this.contentProdImages();
            this.navMenuSmart();
            this.mainNavigation();
            this.backToTop();
            this.portfolio();
            this.searchform();
            this.tabs();
            this.categoriesAccordion();
            this.CustomMenuAccordion();
            this.widgetsOpenCloseDefault();
            this.widgetsOpenClose();
            this.toggles();
            this.closeParentBtn();
            this.commentsForm();
            this.mobileMenu();
            this.topPanel();
            this.menuPosts();
            this.postLayout();
            this.photoSwipe();
            this.ajaxSearch();
            this.stickySidebar();
            this.sidebarMobile();
            this.sidebarMobileToggle();
            this.countdown();
            // this.vcRTLRows();
            this.heightFixMassive();
            this.hamburgerIcon();
            this.scrollMenu();
            this.NavbarHeader();
            this.customCss();
            this.customCssOne();
            this.PostProductAjaxLoad();
            this.AjaxElement();
            this.sliderVertical();
            this.global_image_lazy();
            if( etConfig.woocommerce ) {
                this.wishlist();
                this.woocommerce();
                this.quantityIncrements( false );
                this.ajaxAddToCartInit();
                this.variationsThumbs();
                this.videoPopup();
                this.quickView();
                this.theLook();
                this.filtersArea();
                this.stickyProductImages();
                this.ForCompare();
                this.tooltips();
                this.jumpToSlide();
                this.ReinitForInfiniteScroll();
                this.ajaxFilters();
                this.after_cart_refreshed();
            }

            setTimeout(function() {
                $('body').addClass('cart-widget-show');
            }, 1000);

            $(window).resize();
        },

        // ! Shop page ajax filters and pagination
        ajaxFilters: function(){
            if ( $( 'body' ).hasClass( 'et-ajax-product-filter' ) ) {
                // ! Most of all filters
                $(document).on( 'click', '.etheme_swatches_filter ul li a, .woocommerce-widget-layered-nav ul li a, .widget_rating_filter ul li a, .widget_layered_nav_filters ul li a', function(e) {
                    e.preventDefault();
                    if ( $( 'body' ).hasClass( 'ajax-progress' ) ) return;
                    var href    = $(this).attr('href');
                    var current = window.location.href;

                    if ( ! $(this).hasClass('remove-brand') && ! $(this).parents( '.widget_layered_nav_filters' ).hasClass( 'etheme-active-filters' ) ) {
                        if ( current.indexOf('filter_brand') > 1 ) {
                            var url = new URL( current );
                            var params = url.searchParams.get( 'filter_brand' );
                            href = href.replace( '?', '?filter_brand=' + params + '&' );
                        }
                    }
                    load_data( href );
                });

                // ! Brand filter
                $(document).on( 'click cnahge', '.etheme_widget_brands_filter ul li a, .dropdown_product_brand', function(e) {
                    e.preventDefault();
                    //var start_time = new Date().getTime();

                    var href = '';

                    if ( $(this).is('.dropdown_product_brand') ) {
                        href = $(this).find( 'option:selected' ).data( 'url' );
                        if ( ! href ) {
                            return;
                        }
                    } else {
                        href = $(this).attr( 'href' );
                    }

                    if ( $(this).parents( '.etheme_widget_brands_filter' ).hasClass( 'on_brand' ) ) {

                        var shop_url = $(this).parents( '.etheme_widget_brands_filter' ).attr( 'data-shop-url' );
                        var params = get_url_params(href);
                        var i = 0;

                        shop_url = shop_url + '?';

                        $.each( params, function( e, t ) {
                            i++;
                            if ( Object.keys(params).length > i ) {
                                shop_url = shop_url + e + "=" + t + '&';
                            } else {
                                shop_url = shop_url + e + "=" + t;
                            }
                        });

                        load_data( shop_url );
                        
                    } else {
                        load_data( href );
                    }
                });

                // ! Reset price filter
                $(document).on( 'click', '.et-reset-price', function(e) {
                    e.preventDefault();
                    if ( $( 'body' ).hasClass( 'ajax-progress' ) ) return;
                    var form = $(this).parents( '.etheme-price-filter form' );
                    var min  = form.find( '#min_price').data( 'min' );
                    var max  = form.find( '#max_price').data( 'max' );

                    form.find( '#min_price' ).val( min );
                    form.find( '#max_price' ).val( max );

                    $( document.body ).trigger( 'price_slider_slide', [ min, max ] );

                    $.each( $('.etheme-price-filter .ui-slider-handle'), function( i, val ) {
                        if ( i != 1) {
                            reset_position( $( val ), false, true );
                        } else {
                            reset_position( $( val ), true, true );
                        }
                    });

                    reset_position( $( '.etheme-price-filter .ui-slider-range' ), false, false );

                    var action = form.attr( 'action' );
                    var href   = action + '?' + form.find( 'input' ).not( '#min_price, #max_price' ).serialize();
    
                    load_data( href );
                });

                // ! Price filter when price set
                $(document).on( 'price_slider_change', function(e) {

                    $( '.et-reset-price' ).removeClass( 'hidden' );

                    if ( $( 'body' ).hasClass( 'ajax-progress' ) ) return;

                    var form = $(this).find( '.etheme-price-filter form' ).first();

                    if ( ! form || form.length < 1 ) return

                    //$( 'body' ).addClass('ajax-price-progress');

                    var action = form.attr( 'action' );
                    var href   = action + '?' + form.serialize();

                    load_data( href );
                 });

                // ! Price filter
                $(document).on( 'click', '.widget_price_filter .button:not(".et-reset-price")', function(e) {
                    e.preventDefault();
                    if ( $( 'body' ).hasClass( 'ajax-progress' ) ) return;
                    var form   = $(this).closest( 'form' );
                    var action = form.attr( 'action' );
                    var href   = action + '?' + form.serialize();

                    load_data( href );
                });

                // WooCommerce select type filters
                $(document).on( 'change', 'select.woocommerce-widget-layered-nav-dropdown', function(e) {
                    e.preventDefault();
                    if ( $( 'body' ).hasClass( 'ajax-progress' ) ) return;

                    var $this   = $(this),
                        current = window.location.href,
                        calss   = $this.attr('class'),
                        filter  = '',
                        href    = '';

                    calss = calss.split(' ');

                    $.each( calss, function(i,t) {
                        if ( t.includes('dropdown_layered_nav_') ) {
                            filter = t.replace("dropdown_layered_nav_", "");
                        }
                    });

                    filter = 'filter_'+filter;

                    if ( current.includes(filter) ) {
                        var old_var = $this.parents('form').find('input[name=' + filter + ']').attr('value');

                        href = current.replace( filter + '=' + old_var, filter + '=' + $this.val() );
                     }else{
                        if ( current.includes( '?' ) ) {
                           href = current.replace( '?', '?' + filter + '=' + $this.val() + '&' );
                        } else {
                           href = current + '?' + filter + '=' + $this.val();
                        }
                    }
                    if ( href ) {
                        load_data( href );
                    }
                });
            }

            // ! Pagination
            if ( $( 'body' ).hasClass( 'et-ajax-product-pagination' ) ) {
                $(document).on( 'click', '.woocommerce-pagination ul li a', function(e) {
                    e.preventDefault();
                    if ( $( 'body' ).hasClass( 'ajax-progress' ) ) return;
                    load_data( $(this).attr( 'href' ) );
                });
            }

            // ! Get params from url
            function get_url_params( url ) {
                var params  = {};
                var parser  = document.createElement( 'a' );
                parser.href = url;
                var query   = parser.search.substring( 1 );
                var vars    = query.split( '&' );
                for ( var i = 0; i < vars.length; i++ ) {
                    var pair = vars[i].split( '=' );
                    params[pair[0]] = decodeURIComponent( pair[1] );
                }
                return params;
            };

            // ! Load data
            function load_data( href ){
                $( '.et-loader.product-ajax' ).addClass( 'loading' );
                $( 'body' ).addClass('ajax-progress');

                var o_href = href;

                o_href = o_href.replace( '?et_ajax=true&', '?' );
                o_href = o_href.replace( '?et_ajax=true', '?' );
                o_href = o_href.replace( 'et_ajax=true&', '' );
                o_href = o_href.replace( 'et_ajax=true', '' );

                if ( ! href.includes('?') ) {
                    href = href + '?et_ajax=true';
                } else {
                    href = href.replace( '?', '?et_ajax=true&' );
                }

                $.ajax({
                    url: href,
                    method: 'GET',
                    timeout: 100000,
                    dataType: 'text',
                    beforeSend: function () {
                        $('.sidebar.et-mini-content.active').removeClass('active');
                        $('.et-toggle-mob-sidebars-wrapper').removeClass('et-content-shown');

                        // var container = $('html, body'),
                        // offsetTop = $(document).find('.content-page').offset().top - 50;
                        // container.animate({
                        //     scrollTop: offsetTop
                        // });
                    },
                    success: function(response) {
                        var products   = $( response ).find( '.products-loop' ).html();
                        var sidebar    = $( response ).find( '.sidebar' ).html();
                        var filter     = $( response ).find( '.shop-filters' ).html();
                        var pagination = $( response ).find( '.after-shop-loop' ).html();
                        var empty      = $( response ).find( '.empty-category-block' ).html();

                        pagination = pagination.replace( '?et_ajax=true', '?' );
                        pagination = pagination.replace( 'et_ajax=true', '' );

                        if ( empty ) {
                            $( '.products-loop' ).html( '' );
                            if ( $( '.empty-category-block' ).length ) {
                                $( '.empty-category-block' ).html( empty );
                                $( '.empty-category-block' ).removeClass( 'hidden' );
                            } else {
                                $( '.products-loop' ).after( '<div class="empty-category-block">' + empty + '</div>' );
                            }
                        } else {
                            $( '.empty-category-block' ).html( '' ).addClass( 'hidden' );
                            $( '.products-loop' ).html( products );
                        }

                        $( '.sidebar' ).html( sidebar );

                        $( '.shop-filters' ).html( filter );

                        // added in v6.2.6
                        // Reinit selectWoo after widgets refresh
                        // if ( jQuery().selectWoo ) {
                            $.each( $('select.woocommerce-widget-layered-nav-dropdown'), function() {
                                var $this = $(this);
                                var wc_layered_nav_select = function() {
                                    jQuery( $this ).selectWoo( {
                                        minimumResultsForSearch: 5,
                                        width: '100%',
                                        language: {
                                            noResults: function() {
                                                return 'No matches found';
                                            }
                                        }
                                    } );
                                };
                                wc_layered_nav_select();
                            });
                        // }

                        etTheme.categoriesAccordion();

                        if ( ! pagination ) {
                            $( '.after-shop-loop' ).html( '' );
                        } else {
                            $( '.after-shop-loop' ).html( pagination );
                        }

                        window.history.pushState( '', '', o_href );
                    },
                    error: function(response) {
                        etTheme.et_notice('ajax-filters', 'error');
                    },
                    complete: function(response) {
                        $( '.et-loader.product-ajax' ).removeClass( 'loading' );

                        if ( $( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                            ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                        }
                        etTheme.contentProdImages();
                        etTheme.countdown(); // refresh product timers
                        $('body').removeClass('swc-default-done');
                        etTheme.widgetsOpenCloseDefault();
                        reinit_price_filter();

                        etTheme.sidebarMobile();
                        etTheme.stickySidebar();

                        $( 'body' ).removeClass('ajax-progress');

                        etTheme.global_image_lazy();

                        var top = $('.main-products-loop > .products-loop').offset().top;

                        if ( $('.filter-wrap').length ) 
                            top -= $('.filter-wrap').outerHeight()

                        // extra space to scroll 
                        top -= 110;

                        // added in v6.2.6
                        $('html, body').animate({
                            scrollTop: top
                        }, 1000);

                        // var request_time = new Date().getTime() - start_time;
                        // console.log(request_time);
                        // console.log(convertMS(request_time));
                    }
                });
            }

            // function convertMS( milliseconds ) {
            //     var day, hour, minute, seconds;
            //     seconds = (milliseconds / 1000);
            //     // minute = (seconds / 60);
            //     // seconds = seconds % 60;
            //     // hour = (minute / 60);
            //     // minute = minute % 60;
            //     // day = (hour / 24);
            //     // hour = hour % 24;
            //     return {
            //         // day: day,
            //         // hour: hour,
            //         // minute: minute,
            //         seconds: seconds
            //     };
            // }

            // ! Reinit price filter
            function reinit_price_filter() {
                if ( $( '.price_slider' ).length ) {
                    // ! woocommerce_price_slider_params is required to continue, ensure the object exists
                    if ( typeof woocommerce_price_slider_params === 'undefined' ) {
                        return false;
                    }

                    $( 'input#min_price, input#max_price' ).hide();
                    $( '.price_slider, .price_label' ).show();

                    var min_price = $( '.price_slider_amount #min_price' ).data( 'min' );
                    var max_price = $( '.price_slider_amount #max_price' ).data( 'max' );
                    var current_min_price = parseInt( $( '.price_slider_amount #min_price').val() ? $( '.price_slider_amount #min_price').val() : min_price, 10 );
                    var current_max_price = parseInt( $( '.price_slider_amount #max_price').val() ? $( '.price_slider_amount #max_price').val() : max_price, 10 );

                    $( '.price_slider' ).slider({
                        range: true,
                        animate: true,
                        min: min_price,
                        max: max_price,
                        values: [ current_min_price, current_max_price ],
                        create: function() {

                            $( '.price_slider_amount #min_price' ).val( current_min_price );
                            $( '.price_slider_amount #max_price' ).val( current_max_price );

                            $( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
                        },
                        slide: function( event, ui ) {
                            $( 'input#min_price' ).val( ui.values[0] );
                            $( 'input#max_price' ).val( ui.values[1] );

                            $( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
                        },
                        change: function( event, ui ) {
                            $( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
                        }
                    });
                }
            };

            // ! Reset price slider width
            function resrt_width(){
                var width = $( '.etheme-price-filter .ui-slider-range' ).get(0).style.width;

                if ( parseFloat( width ) + 0.300 >= 100 ) {
                    $( '.etheme-price-filter .ui-slider-range' ).css( 'width', '100%' );
                } else {
                    $( '.etheme-price-filter .ui-slider-range' ).css( 'width', parseFloat( width ) + 0.300 + '%' );
                }
            }

            // ! Reset price slider position
            function reset_position(elem, type, width){
                var interval = setInterval(function() {
                    var left = parseFloat( elem.get(0).style.left );

                    if ( type ) {
                        if ( left + 0.300 >= 100 ) {
                            elem.css( 'left', '100%' );
                            clearInterval( interval );
                        } else {
                            elem.css( 'left', left + 0.300 + '%' );
                        }

                    } else {
                        if ( left - 0.300 <= 0 ) {
                            elem.css( 'left', 0 );
                            clearInterval( interval );
                        } else {
                            elem.css( 'left', left - 0.300 + '%' );
                        }
                    }
                    if ( width ) resrt_width();
                }, 1 );
            }
        },

        ReinitForInfiniteScroll: function() {
             $( document ).on( 'click', '#sb-infinite-scroll-load-more a', function(e){
                var count = $( '.products-loop .product' ).length;
                if ( $(this).attr( 'data-count' ) >= count ) {
                    return;
                } else {
                    var swatchInit = setInterval( timer, 300 );
                    function timer() {
                        if ( $( '#sb-infinite-scroll-load-more' ).hasClass( 'finished' ) ) {
                            clearInterval( swatchInit );
                        }
                        if ( $( '.products-loop .product' ).length > count ) {
                            if ( $( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                                ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                            }
                            etTheme.contentProdImages();
                            etTheme.countdown(); // refresh product timers
                            etTheme.global_image_lazy();
                            clearInterval( swatchInit );
                        }
                    }
                    $(this).attr( 'data-count', count );
                }
            } );
        },

        hamburgerIcon: function() {
            $(document).on('click', '.hamburger-icon', function(){
                $( 'body' ).toggleClass( 'fullscreen-menu-opened' );

            });

            // ! Close menu for vertical header types
            $( '.content-page, footer.footer, .et-footers-wrapper, .header-wrapper.vertical-mod, .page-heading' ).on( 'click', function(e){
                if ( $( 'body' ).is( '.fullscreen-menu-opened.et-vertical-fixed' ) ) {
                    $( 'body' ).toggleClass( 'fullscreen-menu-opened' );
                }
            });

            var navList = $('.fullscreen-menu-container .menu');
            var opener = '<span class="open-child">(open)</span>';

            navList.find('li:has(ul)',this).each(function() {
                var $this = $(this);
                $this.find(' > a').wrap('<div class="inside" />').parent().append(opener);
                // $this.prepend(opener);
            });

            navList.on('click', '.open-child', function(){
                if ($(this).parent().hasClass('over')) {
                    $(this).parent().removeClass('over').parent().find(' > .nav-sublist-dropdown, > .nav-sublist').stop().slideUp(300);
                }else{
                    // $(this).parent().parent().parent().find('>li>.over').removeClass('over');
                    $(this).parent().addClass('over').parent().find(' > .nav-sublist-dropdown, > .nav-sublist').stop().slideDown(300);
                }
            });

            // heightSubmenu();

            // $( ".fullscreen-menu .container.fullscreen-menu-container" ).nanoScroller({
            //     contentClass: 'fullscreen-menu-collapse'
            // });

            if ( navList.parent().hasClass('one-page-menu') ) {
                navList.on('click', '.item-link', function(){
                    $( 'body' ).toggleClass( 'fullscreen-menu-opened' );
                });
            }
        },

        sitePreloader: function() {
            setTimeout(function() {
                $('body').removeClass('et-preloader-on').addClass('et-preloader-hide');
            }, 500);
        },


        addSwiperLazy: function() {
            //$('.block-srcset > img').addClass('swiper-lazy');
        },

        swiperFunc: function(){

            $('.swiper-container').not('.initialized').each(function(){
                var $t = $(this);

                var index = 'swiper-unique-id-'+initIterator;

                $t.addClass('swiper-'+index+' initialized').attr('id', index);
                $t.find('.swiper-pagination').addClass('swiper-pagination-'+index);
                $t.parent().find('.swiper-button-prev, .swiper-custom-left').addClass('swiper-button-prev-'+index);
                $t.parent().find('.swiper-button-next, .swiper-custom-right').addClass('swiper-button-next-'+index);

                if ( $t.parents().is( '.mpc-container' ) && ! $t.parents( '.mpc-container' ).data( 'active' ) ) {
                    $t.find( 'img' ).removeClass( 'swiper-lazy' ).addClass( 'swiper-pre-lazy' );
                }

                var autoplay = false;

                if ( setParams($t,'autoplay',false) ) {
                    autoplay = {
                        delay: setParams($t,'autoplay',false),
                    };   
                }

                swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
                    pagination: {
                        el: '.swiper-pagination-'+index,
                        clickable : true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next-'+index,
                        prevEl: '.swiper-button-prev-'+index,
                    },
                    autoplay: autoplay,
                    loop: ($t.is('[data-loop]'))?true:false,
                    slidesPerView: setParams($t,'slides-per-view',true), // +
                    slidesPerGroup: setParams($t,'slides-per-group',true), // +
                    autoHeight: ($t.is('[data-autoheight]'))?true:false, // +
                    centeredSlides: setParams($t,'center',false), // +

                    breakpoints: ($t.is('[data-breakpoints]')) ? {
                        767: { 
                            slidesPerView: ($t.attr('data-xs-slides')!='auto')?parseInt($t.attr('data-xs-slides'), 10):'auto'
                            // slidesPerGroup: ($t.attr('data-xs-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-xs-slides'), 10):1 
                        },
                        991: { 
                            slidesPerView: ($t.attr('data-sm-slides')!='auto')?parseInt($t.attr('data-sm-slides'), 10):'auto'
                            // slidesPerGroup: ($t.attr('data-sm-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-sm-slides'), 10):1 
                        },
                        1199: { 
                            slidesPerView: ($t.attr('data-md-slides')!='auto')?parseInt($t.attr('data-md-slides'), 10):'auto'
                            // slidesPerGroup: ($t.attr('data-md-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-md-slides'), 10):1 
                        },
                        1370: { 
                            slidesPerView: ($t.attr('data-lt-slides')!='auto')?parseInt($t.attr('data-lt-slides'), 10):'auto'
                            // slidesPerGroup: ($t.attr('data-lt-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-lt-slides'), 10):1 
                        } 
                    } : {}, // ?

                    initialSlide: setParams($t,'initialslide',0), // +
                    speed: setParams($t,'speed',500), // +
                    // parallax: setParams($t,'parallax',false), //+
                    // slideToClickedSlide: setParams($t,'clickedslide',0),// + ?
                    // mousewheelControl: setParams($t,'mousewheel',0),
                    direction: ($t.is('[data-direction]'))?$t.data('direction'):'horizontal',
                    spaceBetween: ($t.is('[data-space]'))?$t.data('space'):10,
                    watchSlidesProgress: true,
                    //autoplayDisableOnInteraction: true, // ?
                    //keyboardControl: true, // ?
                    //mousewheelReleaseOnEdges: true, // ?
                    preloadImages: false,
                    lazy: true,
                    // lazyLoadingInPrevNext: true,
                    // lazyLoadingInPrevNextAmount: 1,
                    // lazyLoadingOnTransitionStart: true,
                    // loopedSlides: 3,
                    // roundLengths: true, temporary because in some cases loop brokes
                    watchSlidesVisibility: true,
                    slidesPerColumn: setParams($t,'slidespercolumn',1),
                    effect: ($t.is('[data-effect]'))?$t.data('effect'):'slide',
                    on : {
                        init: function() {
                            setTimeout(function() {
                                if ($( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                                    ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                                }
                            }, 300);
                        },

                        transitionStart: function() {
                            if ($( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                                ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                            }
                        }
                    }
                });


                // ! Switcher ON/OFF mobile optimization carousel.

                // $(window).resize(function(){

                //    if( $(window).width() > 768 ) {
                //         $t.find( '.image-swap img' ).removeClass( 'lazy-off hidden' );
                //         $t.find( '.image-swap img' ).addClass( 'swiper-lazy' );
                //         swipers['swiper-'+index].init();
                //    }

                //    if( $(window).width() <= 768 ) {
                //         $t.find( '.image-swap img' ).addClass( 'lazy-off hidden' );
                //         $t.find( '.image-swap img' ).removeClass( 'swiper-lazy' );
                //         swipers['swiper-'+index].init();
                //    }
                // });


                $( document ).on('click', '.mpc-tabs__nav-item', function(){

                    $t.parents( '.mpc-container' ).addClass('et_load-tab');

                        $t.find( 'img.swiper-pre-lazy' ).not( '.lazy-off' ).addClass('swiper-lazy');
                        swipers['swiper-'+index].lazy.load();
                        // setTimeout(function() {
                        //     if ( $t.find( '.swiper-lazy-loaded' ).height() ) {
                        //         $t.find( '.product-content-image' ).height( $t.find( '.swiper-lazy-loaded' ).height() );
                        //     }
                        // }, 500);

                    if ( $t.find( 'img.swiper-lazy-loaded' ) ) {
                        $t.parents( '.mpc-container' ).removeClass('et_load-tab');
                        $t.parents( '.mpc-container' ).addClass('et_loaded-tab');
                    }

                });

                $( document ).on('click', '.vc_tta-tab', function(){
                    swipers['swiper-'+index].init();
                    swipers['swiper-'+index].update();
                    // setTimeout(function() {
                    //     $t.find( '.product-content-image' ).height( $t.find( '.swiper-lazy-loaded' ).height() );
                    // }, 500);
                });

                // $( document ).on('click', '.et-tabs-wrapper .tab-title', function(){
                //     setTimeout(function() {
                //         $t.find( '.product-content-image' ).height( $t.find( '.swiper-lazy-loaded' ).height() );
                //     }, 500);

                // });

                $(document).ready(function(){
                     $('.fadeIn-slide').each(function() {
                        $(this).addClass('fadedIn-slide');
                        setTimeout(function() {
                            $('.fadeIn-slide').removeClass('fadedIn-slide').removeClass('fadeIn-slide');
                        }, 700);
                    });
                });

                // $(document).ready(function(){

                //     $('.swiper-bg-image-lazy').each(function(){
                //         var lazy_slide = '.slider-item-'+$(this).attr('data-slide-id');
                //         if ( $(lazy_slide).attr('data-bg-img') != '' ) {
                //             var e = $(this).parent()[0];
                //             var bg_lazy_observer = new MutationObserver(function (event) {
                //                 if ( $(lazy_slide).parent().hasClass('swiper-slide-active') ) {
                //                     if ( !$(lazy_slide).is('.bg-img-loaded') ) {
                //                         $(lazy_slide).closest('.swiper-container').find('.et-loader').css({
                //                             'visibility': 'visible',
                //                             'opacity' : '1',
                //                             'z-index': '9'
                //                         })
                //                     }
                //                     if ($(lazy_slide).css({'background-image': $(lazy_slide).attr('data-bg-image') }) ) {
                //                         $(lazy_slide).removeAttr('data-bg-image');
                //                     }

                //                     if ( !$(lazy_slide).is('.bg-img-loaded') ) {
                //                         setTimeout(function(){
                //                             $(lazy_slide).addClass('bg-img-loaded');
                //                             $(lazy_slide).closest('.swiper-container').find('.et-loader').attr('style', '');
                //                         }, 500);
                //                     }
                //                 }
                //             });

                //             bg_lazy_observer.observe(e, {
                //               attributes: true, 
                //               attributeFilter: ['class'],
                //               childList: false, 
                //               characterData: false
                //             });
                //         }
                //     });
                // });

                // ! for swipers inside tabs with autoplay
                $('.vc_tta-tab').each(function() {
                    var e = $(this)[0];
                    var observer = new MutationObserver(function (event) {
                        swipers['swiper-'+index].init();
                        swipers['swiper-'+index].update(); 
                    })

                    observer.observe(e, {
                      attributes: true, 
                      attributeFilter: ['class'],
                      childList: false, 
                      characterData: false
                    });

                    // setTimeout(function() {
                    //     if ( $t.find( '.swiper-lazy-loaded' ).height() ) {
                    //         $t.find( '.product-content-image' ).height( $t.find( '.swiper-lazy-loaded' ).height() );
                    //     }
                    // }, 500);
                });

                $(window).load(function () {
                    swipers['swiper-'+index].init();
                    swipers['swiper-'+index].update();
                    swipers['swiper-'+index].lazy.load();
                    // if ( $t.find( '.swiper-lazy-loaded' ).height() ) {
                    //     $t.find( '.product-content-image' ).height( $t.find( '.swiper-lazy-loaded' ).height() );
                    // }
                });

                $('.swiper-container.stop-on-hover').on('mouseenter', function(e){
                    swipers['swiper-'+($(this).attr('id'))].autoplay.stop();
                })
                $('.swiper-container.stop-on-hover').on('mouseleave', function(e){
                    swipers['swiper-'+($(this).attr('id'))].autoplay.start();
                })

                setTimeout(function() {
                    $('.vc_tta-tab.vc_active').click();
                }, 500);

                $( window ).bind( "vc_js", function() {
                    swipers['swiper-'+index].update();
                    // if ( $t.find( '.swiper-lazy-loaded' ).height() ) {
                    //     $t.find( '.product-content-image' ).height( $t.find( '.swiper-lazy-loaded' ).height() );
                    // }
                });

                $(document).on( 'found_variation' ,'form.variations_form', function() {
                    swipers['swiper-'+index].slideTo(0);
                });
                $(document).on( 'reset_image', 'form.variations_form', function() {
                    swipers['swiper-'+index].slideTo(0);
                });

                if ( etConfig.variationGallery ) {

                    $( '.variations_form' ).on('found_variation', function( event, variation ) {
                        setTimeout(function() {
                            swipers['swiper-'+index].init();
                            swipers['swiper-'+index].update();
                            swipers['swiper-'+index].lazy.load(); 
                        }, 300);
                    })
                    .on('reset_data', function() {
                        setTimeout(function() {
                            swipers['swiper-'+index].init();
                            swipers['swiper-'+index].update();
                            swipers['swiper-'+index].lazy.load(); 
                        }, 300);
                    });

                    $(document).on( 'click', '.quick-view-popup .st-swatch-preview li, .quick-view-popup .sten-reset-loop-variation', function() {
                        setTimeout(function() {
                            swipers['swiper-'+index].init();
                            swipers['swiper-'+index].update();
                            swipers['swiper-'+index].lazy.load(); 
                        }, 300); 
                    });

                }

                $(document).on( 'click' ,'.quick-view-info .sten-reset-loop-variation, .quick-view-info .st-swatch-preview li', function(e) {
                   swipers['swiper-'+index].slideTo(0);
                });

                swipers['swiper-'+index].update();
                initIterator++;
            });
    
            $(window).load(function(){
                // need because when slow network, loop slider, and full width then it showed for sec 2 slides and reinit then
                var initIterator2 = 0;
                $('.swiper-container').not('.second-initialized').each(function() {
                    var $t = $(this);

                    var prev = $t.parent().find('.swiper-button-prev.swiper-button-disabled, .swiper-custom-left.swiper-button-disabled');
                    var next = $t.parent().find('.swiper-button-next.swiper-button-disabled, .swiper-custom-right.swiper-button-disabled');

                    if ( $t.parent().hasClass('swipers-couple-wrapper') ) {
                        prev = $t.find('.swiper-button-prev.swiper-button-disabled, .swiper-custom-left.swiper-button-disabled');
                        next = $t.find('.swiper-button-next.swiper-button-disabled, .swiper-custom-right.swiper-button-disabled');
                    }

                    if ( next.length > 0 && prev.length > 0 ) {
                        next.remove();
                        prev.remove();
                    }

                    $t.addClass('second-initialized');
                });

                if ( $( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                    ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                }
            });

            $('.swiper-wrapper.thumbnails-list .swiper-slide').eq(0).addClass('active-thumbnail');

            $(document).on('click', '.thumbnail-item', function () {
                $(this).toggleClass('active-thumbnail');
                $(this).siblings( $(this) ).removeClass('active-thumbnail');

                var switchIndex = $(this).closest('.swipers-couple-wrapper').find('.thumbnail-item').index(this);
                swipers['swiper-' + $(this).closest('.swipers-couple-wrapper').find('.swiper-control-top').attr('id')].slideTo(switchIndex);
                return false;
            });

            etTheme.resizeVideo();

            // $(document).on( 'click', '.swiper-custom-right', function () {
            //     swipers['swiper-'+$(this).siblings('.swiper-container').attr('id')].slideNext();
            // });
            //
            // $(document).on('click', '.swiper-custom-left', function () {
            //     swipers['swiper-'+$(this).siblings('.swiper-container').attr('id')].slidePrev();
            // });

        },

        sliderVertical : function () {
            if ( $('body').hasClass('single-product') && $('.swiper-entry').hasClass('swiper-vertical-images') ) {

                var is_rtl = $('.thumbnails').is('.slick-rtl') ? true : false;

                $('.thumbnails-list').slick({
                      slidesToScroll: 1,
                      autoplay: false,
                      vertical: true,
                      verticalSwiping: true,
                      infinite: false,
                      rtl : is_rtl,
                      adaptiveHeight: true,
                      lazyLoad: 'ondemand',
                      nextArrow: '<div class="swiper-custom-right"></div>',
                      prevArrow: '<div class="swiper-custom-left"></div>',
                      responsive: [
                        {
                          breakpoint: 650,
                          settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            vertical: false,
                            verticalSwiping: false,
                            adaptiveHeight: false,
                          }
                        }
                      ]
                });
                $('.thumbnails-list .slick-current').eq(0).addClass('active-thumbnail');
            }
        },

        heightFixMassive: function() {

            $(document).on( 'click', '.mpc-toggled .vc_tta-panel-heading', function(evt) {

                var height = $( this ).parents( '.vc_tta-panel' ).children( '.vc_tta-panel-body' ).height();
                var data_height = $( this ).parents( '.mpc-toggled' ).data( 'height' );
                height = data_height + height;

                $( this ).parents( '.mpc-toggled' ).css( 'max-height', height );
            });
        },

        secondaryMenu: function() {

            $(document).on('click', '.et-secondary-visibility-on_click .secondary-title', function() {
                secondaryShowHide();
            });
            $(document).on('mouseover', '.et-secondary-visibility-on_hover.et-secondary-darkerning-on .secondary-menu-wrapper', function() {
                secondaryShow();
            });
            $(document).on('mouseleave', '.et-secondary-visibility-on_hover.et-secondary-darkerning-on .secondary-menu-wrapper', function() {
                secondaryHide();
            });

            var secondaryShowHide = function() {
                if($('body').hasClass('et-secondary-shown')) {
                    secondaryHide();
                } else {
                    secondaryShow();
                }
            };

            var secondaryShow = function () {
                $('body').addClass('et-secondary-shown');
            }
            var secondaryHide = function () {
                $('body').removeClass('et-secondary-shown');
            }

            $(document).on('click touchstart', function(event) {
                if( !$(event.target).closest('.secondary-menu-wrapper').length ) {
                    if($('body').hasClass('et-secondary-shown')) {
                        $('body').removeClass('et-secondary-shown');
                    }
                }
            })
        },

        breadcrumbs: function() {
            if($(window).width() < 1200) return;

            var previousScroll = 0,
                deltaY = 0,
                breadcrumbs = $('.bc-effect-text-scroll').find('.container'),
                opacity = 1,
                finalOpacity = 0.3,
                scale = 1,
                finalScale = 0.8,
                scrollTo = 300;

            $(window).scroll(function(){
                var currentScroll = $(this).scrollTop();

                if(currentScroll > 1 && currentScroll < scrollTo) {

                    opacity = 1 - ( 1 - finalOpacity ) * ( currentScroll / scrollTo );
                    scale   = 1 - ( 1 - finalScale )   * ( currentScroll / scrollTo );

                    opacity = opacity.toFixed(3);
                    scale   = scale.toFixed(3);

                    breadcrumbsAnimation(breadcrumbs);
                } else if(currentScroll < 10) {
                    opacity = 1;
                    scale   = 1;

                    breadcrumbsAnimation(breadcrumbs);
                }

                var scrolledY = $(window).scrollTop();
                // $('.bc-type-8').css('background-position', 'left ' + ((scrolledY)/1.5) + 'px');

            });

            var breadcrumbsAnimation = function(el) {
                if(deltaY >= 0 || $(window).scrollTop() < 1) deltaY = 0;
                el.css({
                    'transform': 'scale(' + scale + ')',
                    '-webkit-transform': 'scale(' + scale + ')',
                    'opacity' : opacity
                });
            };

            /* Parallax on mouse move */

            var mouseParallax = $('.bc-effect-mouse'),
                x0 = 50,
                y0 = 0,
                koef = 0.35,
                time = 350;

            mouseParallax.mousemove(function(e){
                var width = $(window).width(),
                    height = $(this).outerHeight();

                var dX = width/2-e.pageX,
                    dY = height/2-e.pageY;

                var x = x0 + dX/width*100*koef,
                    y = y0 - dY/height*100*koef;

                if( x < 0 ) x = 0;
                if( y < 0 ) y = 0;

                $(this).stop().animate({
                    backgroundPositionX: x + '%',
                    backgroundPositionY: y + '%'
                }, time, 'linear');
            })
                .mouseleave(function() {
                    $(this).stop().animate({
                        backgroundPositionX: x0 + '%',
                        backgroundPositionY: y0 + '%',
                    }, time);
                });

        },

        photoSwipe: function() {

            setTimeout(function() {
                $('.zoom-images-button, .open-video-popup, .open-360-popup').addClass('showed');
            }, 400);

            // **********************************************************************//
            // ! init photoswipe
            // **********************************************************************//

            var pswpElement = document.querySelectorAll('.pswp')[0],
                mainImages = $('.images-wrapper');

            if ( !mainImages.hasClass('with-pswp') ) return;

            mainImages.on('click', '.main-images a.zoom, .main-images .zoomImg', function(e) {
                e.preventDefault();

                var index     = 0;
                var items     = [];
                var mainImage = $(this);

                if ( $(this).hasClass('.zoom') != true ) {
                    mainImage = $(this).parent().find('.woocommerce-main-image');
                }
                
                    var additionalImages = '';
                if ( mainImages.find('.images').hasClass('gallery-slider-on') ) {
                    additionalImages = $('.pswp-additional');
                } else {
                    additionalImages = $('.woocommerce-main-image').not('.pswp-main-image');
                    var firstImg = $('.woocommerce-main-image.pswp-main-image');
                    items.push({
                        src: firstImg.attr('href'),
                        w: firstImg.data('width'),
                        h: firstImg.data('height'),
                    });
                }

                additionalImages.each(function() {
                    items.push({
                        src: $(this).attr('data-large'),
                        w: $(this).data('width'),
                        h: $(this).data('height'),
                    });
                });

                if ( ! additionalImages.length && mainImages.find('.images').hasClass('gallery-slider-on') ) {
                    items.push({
                        src: mainImage.attr('href'),
                        w: mainImage.data('width'),
                        h: mainImage.data('height'),
                    });
                }

                // define options (if needed)
                var options = {
                    // optionName: 'option value'
                    // for example:
                    index: mainImage.data('index') // start at first slide
                };

                // Initializes and opens PhotoSwipe
                var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();

                if ( etConfig.variationGallery ) {
                    gallery.listen('destroy', function() { $('.pswp > *').addClass('dt-hide mob-hide'); setTimeout(function() { $('.pswp').attr('class', 'pswp'); $('.pswp > *').removeClass('dt-hide mob-hide'); }, 300); });
                }

            });
        },

        ajaxSearch: function() {
            var form = $('.header-wrapper:not(.mob-hide) .ajax-search-form'),
                click = false,
                request = false;

            form.on('keyup', 'input[type="text"]', function(e) {

                var thisForm = $(this).parents('.ajax-search-form'),
                    results = thisForm.find('.ajax-results'),
                    s = thisForm.find('input[type="text"]').val();

                if( s.length < 1 && ! click ) {
                    results.html('').hide();
                    return;
                }

                var cat = $(this).parents( '.ajax-search-form' ).find( 'select' ).val();
                if ( ! cat ) cat = 0;

                request = $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'et_ajax_search',
                        's': s,
                        'cat' : cat
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        thisForm.addClass('ajax-in-action');
                        results.hide();
                    },
                    complete: function() {
                        thisForm.removeClass('ajax-in-action');
                        click = true;
                    },
                    success: function(response){
                        results.html(response.html).css('display', 'flex');
                    },
                    error: function() {
                    }
                });

                $('body').on('click', function(event) {
                    if ( ! $(event.target).is('.search-form-wrapper') && $(event.target).closest('.search-form-wrapper').length ) return;
                    results.hide();
                });

            });

        },

        stickySidebar: function() {

            if( $(window).width() < 992 ) return;

            $('body').addClass('sticky-sidebar-loaded');

            $(document).on( 'click' , '.sidebar.sticky-sidebar' , function(){
                var initHeight = $( '.sidebar.sticky-sidebar' ).height();
                setTimeout(function(){
                    var currentHeight = $( '.sidebar.sticky-sidebar' ).height();
                    if ( initHeight != currentHeight ) {
                        $(document.body).trigger( 'sticky_kit:recalc' );
                    }
                }, 100 );
            });

            var args = {
                offset_top: 50
            }

            if ( ! $( '.content-page' ).hasClass( 'shop-full-width' ) && $( 'body' ).hasClass( 'woocommerce-page' ) ) {
                args['parent'] = '.container.content-page';
            }

            $('.sidebar.sticky-sidebar').stick_in_parent( args );

            if( ! $('.sidebar.sticky-sidebar').hasClass('sidebar-left') ) return;

            $('.sidebar.sticky-sidebar')
                .on('sticky_kit:stick sticky_kit:unbottom', function() {
                    var parent = $(this).parents('.row'),
                        left = parent.offset().left;
                    $(this).css('left', left);
                })
                .on('sticky_kit:unstick', function() {
                    $(this).css('left', 'auto');
                    $(this).css('position', 'relative');
                })
                .on('sticky_kit:bottom', function() {
                    $(this).css('left', 0);
                })
                .on('sticky_kit:unbottom', function() {
                    var parent = $(this).parents('.row'),
                        left = parent.offset().left;
                    $(this).css('left', left);
                });

            $('.sidebar.sticky-sidebar.sidebar-left').css({
                'position': 'relative'
            });

            $('head').append('<style type="text/css">.content + .sticky-sidebar.sidebar-left {left: auto !important;position: relative;}</style>');

        },

        // affixJS: function() {

        //     if( $(window).width() < 992 ) return;

        //     if ( ! $( '.product-images .images' ).is( '.gallery-slider-off' ) ) {
        //         $( '.fixed-product-block' ).css({ 
        //             'height': $( '.product-content' ).height(), 
        //             'min-height': $( '.product-content' ).height() + 20
        //         });
        //     };

        //     if ( $( '.fixed-product-block' ).height() > $( '.product-images' ).height() ) return;

        //     $('.fixed-product-block').each(function() {
        //         var el = $(this),
        //             parent = el.parent(),
        //             heightOffsetEl = $('.product-images'),
        //             parentHeight = heightOffsetEl.outerHeight(),
        //             firstImg = heightOffsetEl.find('img').first(),
        //             firstImgHeight = firstImg.outerHeight();

        //         $(window).resize(function() {
        //             parentHeight = heightOffsetEl.outerHeight();
        //             firstImgHeight = firstImg.outerHeight();
        //             el.css({
        //                 'maxWidth': parent.width(),
        //                 'minHeight': firstImgHeight,
        //             });
        //             parent.height(parentHeight);
        //         });

        //         $(window).resize();

        //         $(this).stick_in_parent({
        //             offset_top: 100
        //         });

        //     });

        // },

        sidebarMobile: function() {
            if ( $('body').is('.archive.woocommerce-page') && $('.sidebar-mobile-off_canvas').length > 0 && $(window).width() < 768 ) {
                var sidebars_toggles = '';
                $('.sidebar').each(function() {
                    sidebars_toggles += '<div class="et-toggle-mob-sidebar et-off-canvas flex-inline align-items-center et-fadeIn">'+
                        '<span class="et-toggle flex-inline align-items-center" data-hide-text="Hide filter" data-show-text="Show filter">'+
                        '<span class="et-icon"><svg version="1.1" width="1em" height="1em" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">'+
                        '<path d="M94.8,0H5.6C4,0,2.6,0.9,1.9,2.3C1.1,3.7,1.3,5.4,2.2,6.7l32.7,46c0,0,0,0,0,0c1.2,1.6,1.8,3.5,1.8,5.5v37.5'+
                        'c0,1.1,0.4,2.2,1.2,3c0.8,0.8,1.8,1.2,3,1.2c0.6,0,1.1-0.1,1.6-0.3l18.4-7c1.6-0.5,2.7-2.1,2.7-3.9V58.3c0-2,0.6-3.9,1.8-5.5'+
                        'c0,0,0,0,0,0l32.7-46c0.9-1.3,1.1-3,0.3-4.4C97.8,0.9,96.3,0,94.8,0z M61.4,49.7c-1.8,2.5-2.8,5.5-2.8,8.5v29.8l-16.8,6.4V58.3'+
                        'c0-3.1-1-6.1-2.8-8.5L7.3,5.1h85.8L61.4,49.7z"></path>'+
                        '</svg></span></span>'+
                        '</div>';
                    $(this).addClass('et-mini-content et-content-left');
                    $(this).after('<span class="et-close-sidebar et-icon et-delete"></span>');
                });
                if ( sidebars_toggles != '' && $('.et-toggle-mob-sidebar').length < 1 ) {
                    $('body').append('<div class="et-toggle-mob-sidebars-wrapper"><div class="et-toggle-mob-sidebars-inner pos-fixed et-content-left">'+sidebars_toggles+'</div></div>');
                }
            }
        },
        sidebarMobileToggle: function() {
            $(document).on('click touchstart', '.et-toggle-mob-sidebar .et-toggle', function() {
                var parent = $(this).parent();
                var sidebar = parent.data('toggle-sidebar-class');
                if ( $('.sidebar').is('.loaded') ) {
                    $('.sidebar').toggleClass('active');
                }
                else {
                    $('.sidebar').addClass('loaded');
                    setTimeout(function(){
                        $('.sidebar').toggleClass('active');
                    }, 20);
                }
                $(this).parents('.et-toggle-mob-sidebars-wrapper').toggleClass('et-content-shown');
                // $('html').toggleClass('et-overflow-hidden');
            });
            $(document).on('click touchstart', '.et-close-sidebar', function() {
                setTimeout(function(){
                    $('.sidebar').removeClass('active');
                    $('.et-toggle-mob-sidebars-wrapper').removeClass('et-content-shown');
                }, 300 );
            });
        },
        onePageMenu: function() {
            // **********************************************************************//
            // ! One page hash navigation
            // **********************************************************************//

            // Click on menu item with hash
            $(document).on('click', '.one-page-menu a', function(e){
                if($(this).attr('href').split('#')[0] == window.location.href.split('#')[0]) {
                    e.preventDefault();
                    var hash = $(this).attr('href').split('#')[1];
                    changeActiveItem(hash);
                    scrollToId(hash);
                }

                if ( $( 'body' ).hasClass( 'mobile-menu-opened' ) ) {
                    $( 'body' ).removeClass( 'mobile-menu-opened' );
                    $( 'body' ).addClass( 'mobile-menu-closed' );
                }

                // for core plugin header builder 
                if ( $('.et-popup-wrapper.mobile-menu-popup').length ) {
                    $('.et-popup-wrapper').remove();
                    $('html').removeClass('et-overflow-hidden');
                }

                if ( $('.et_b_header-mobile-menu .et-mini-content.active').length ) {
                    $('.et_b_header-mobile-menu .et-mini-content.active').removeClass('active');
                    $('.et_b_header-mobile-menu.et-content-shown').removeClass('et-content-shown');
                    setTimeout(function() {
                        $('html').removeClass('et-overflow-hidden');
                    }, 700);
                }
            });

            $('[data-scroll-to]').click(function() {
                var hash = $(this).attr('data-scroll-to');
                changeActiveItem(hash);
                scrollToId(hash);
            });

            // if loaded page with hash
            var windowHash = window.location.hash.split('#')[1];

            if(window.location.hash.length > 1) {
                setTimeout(function(){
                    scrollToId(windowHash);
                }, 600);
            }

            function scrollToId(id){
                var offset = ( $( 'body' ).hasClass( 'et-header-fixed' ) ) ? 65 : 0; // 130
                var position = 0;
                if(id != 'top'){
                    if($('#'+id).length < 1) {
                        return;
                    }
                    position = $('#'+id).offset().top - offset;


                }

                if($(window).width() < 992) {
                    $('body').removeClass('show-nav');
                }

                $('html, body').stop().animate({
                    scrollTop: position
                }, 1000, function() {
                    changeActiveItem(id);
                });
            }

            function changeActiveItem(hash) {
                var itemId;
                var menu = $('.menu');
                if(!menu.parent().hasClass('one-page-menu')) return;

                menu.find('.current-menu-item').removeClass('current-menu-item');

                if(hash == 'top') {
                    menu.each(function() {
                        $(this).find('li').first().addClass('current-menu-item');
                    });
                    return;
                }

                menu.find('li').each(function() {
                    if($(this).find('>a').attr('href')) {
                        var thisHash = $(this).find('>a').attr('href').split('#')[1];
                        if(thisHash == hash) {
                            itemId = $(this).attr('id');
                        }
                    }
                });

                $('.'+itemId).addClass('current-menu-item');
            }


            $(window).scroll(function() {
                if($(window).scrollTop() < 200) {
                    changeActiveItem('top');
                }
            });
            changeActiveItem('top');

            // change active link on scroll
            $('.vc_row[id]').waypoint(function() {
                var id = $(this).attr('id');
                changeActiveItem(id);
            }, { offset: 150 });



        },

        NavbarHeader: function($location){

            // **********************************************************************//
            // ! Get header navbar data
            // **********************************************************************//

            if ( ! $( 'body' ).hasClass( 'shop-top-bar' ) || $(window).width() > 992 && $location !='fixed' ) return;

            var navbar = {};

            navbar['out'] = '';

            $( '.navbar-header' ).each( function(e){

                // ! Get wishlist
                if ( $(this).find( '.et-wishlist-widget' ).html() != null ) {
                    navbar['wishlist'] = '<div class="' + $(this).find( '.et-wishlist-widget' ).attr( 'class' ) + '">';
                    navbar['wishlist'] += $(this).find( '.et-wishlist-widget' ).html();
                    navbar['wishlist'] += '</div>';
                }

                // ! Get search
                if ( $(this).find( '.header-search' ).html() != null ) {
                    navbar['search'] = '<div class="' + $(this).find( '.header-search' ).attr( 'class' ) + '">';
                    navbar['search'] += $(this).find( '.header-search' ).html();
                    navbar['search'] += '</div>';
                }

                // ! Get search for unstandard header types
                if ( ( $( 'body' ).hasClass( 'global-header-center' ) || $( 'body' ).hasClass( 'global-header-center3' ) || $( 'body' ).hasClass( 'global-header-advanced' ) ) && $(this).parents().find( '.header-search' ).html() != null ) {
                    if ( !$(this).parents().find( '.header-search' ).parent('.menu') ) {
                        navbar['search'] = '<div class="header-search act-full-width">';
                        navbar['search'] += $(this).parents().find( '.header-search' ).html();
                        navbar['search'] += '</div>';
                    }
                }

                // ! Get cart
                if ( $(this).find( '.shopping-container' ).html() != null ) {
                    navbar['cart'] = '<div class="' + $(this).find( '.shopping-container' ).attr( 'class' ) + '">';
                    navbar['cart'] += $(this).find( '.shopping-container' ).html();
                    navbar['cart'] += '</div>';
                }

                // ! Get account
                if ( $(this).find( '.my-account-link' ).html() != null ) {
                    navbar['account'] = '<div class="' + $(this).find( '.my-account-link' ).attr( 'class' ) + '">';
                    navbar['account'] += $(this).find( '.my-account-link' ).html();
                    navbar['account'] += '</div>';
                }

                // ! Get account unlogged
                if ( $(this).find( '.login-link' ).html() != null ) {
                    navbar['account'] = '<div class="' + $(this).find( '.login-link' ).attr( 'class' ) + '">';
                    navbar['account'] += $(this).find( '.login-link' ).html();
                    navbar['account'] += '</div>';
                }

                // ! Get hamburger icon for hamburger header type
                if ( $( 'body' ).is( '.global-header-hamburger-icon' ) && $(this).find( '.hamburger-icon' ).html() != null ) {
                    navbar['hamburger'] = '<div class="' + $(this).find( '.hamburger-icon' ).attr( 'class' ) + '">';
                    navbar['hamburger'] += $(this).find( '.hamburger-icon' ).html();
                    navbar['hamburger'] += '</div>';
                }

            });

            if ( $location != 'fixed' ) $( '.navbar-header.show-in-header' ).remove();

            // ! Create out data
            navbar['out'] += ( $location != 'fixed' ) ? '<div class="navbar-header show-in-header">' : '';
            navbar['out'] += ( navbar['search'] != null ) ? navbar['search'] : '';
            navbar['out'] += ( navbar['account'] != null ) ? navbar['account'] : '';
            navbar['out'] += ( navbar['wishlist'] != null ) ? navbar['wishlist'] : '';
            navbar['out'] += ( navbar['cart'] != null ) ? navbar['cart'] : '';
            navbar['out'] += ( navbar['hamburger'] != null ) ? navbar['hamburger'] : '';
            navbar['out'] += ( $location != 'fixed' ) ? '</div>' : '';

            // ! Do it for fixed header
            if ( $location == 'fixed' ) return navbar['out'];

            // ! Do it for mobile menu
            $( 'header.main-header .navbar-toggle' ).before( navbar['out'] );
        },

        fixedHeader: function() {

            // **********************************************************************//
            // ! Fixed header
            // **********************************************************************//

            if ( $( 'body' ).hasClass( 'et-fixed-disable' ) ) return;
            if ( $( 'body' ).hasClass( 'et-vertical-fixed' ) && $(window).width() > 992 ) return;

            var header = $('.header-wrapper'),
            startOffset = 120;
            function et_fixed_header_content() {
                var logo = header.find('.header-logo').html(),
                    menu = header.find('.menu-wrapper').first(),
                    menuClass = menu.attr('class'),
                    menuRight = header.find('.menu-wrapper-right'),
                    navbar = header.find('.navbar-header').html(),
                    menuBtn = header.find('.navbar-toggle').html(),
                    color = $('.page-wrapper').data('fixed-color'),
                    menuHtml;
                // Do it for non standard navbar
                if ( $( 'body' ).hasClass( 'shop-top-bar' ) ){
                    navbar = etTheme.NavbarHeader( 'fixed' );
                }

                if( menuRight.length > 0 ) {
                    menuHtml = menu.html() + menuRight.html();
                } else {
                    menuHtml = menu.html();
                }

                if ( $( '.woocommerce-mini-cart__buttons' ).hasClass( 'wcppec-cart-widget-spb' ) ) {
                    navbar = navbar.replace( $( '.wcppec-cart-widget-spb' ).html(), '' );
                }

                // Check values for "Toolset Layouts" plugin
                if ( logo == null ) logo = '';
                if ( menuHtml == null ) menuHtml = '';
                if ( navbar == null ) navbar = '';
                if ( menuBtn == null ) menuBtn = '<span class="sr-only">Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';

                var fixedHeaderHtml = '<div class="fixed-header header-color-' + color + '"><div class="container"><div class="container-wrapper"><div class="navbar-toggle">' + menuBtn + '</div><div class="header-logo">' + logo + '</div><div class="' + menuClass + '">' + menuHtml + '</div><div class="navbar-header">' + navbar + '</div></div></div></div>';
                return fixedHeaderHtml; 
            }

            var fixedHeaderHtml = et_fixed_header_content();
            header.after(fixedHeaderHtml);

            if ($(window).width() < 768 ) { startOffset = 80; }

            if ( $('body').hasClass('et-header-fixed') ) {
                $(window).scroll(function(){

                    var currentScroll = $(this).scrollTop();

                    // if ( $('.fixed-header').length < 1 ) {
                        // var fixedHeaderHtml = et_fixed_header_content();
                        // header.after(fixedHeaderHtml);
                    //     etTheme.mainNavigation();
                    // }

                    if( currentScroll > startOffset ) {
                        $('.fixed-header').addClass('fixed-enabled');
                    } else {
                        $('.fixed-header').removeClass('fixed-enabled');
                    }

                });
            } else {
                if ( $('body').hasClass('et-header-sticky') ) {
                    var previousScroll = 0,
                    animatedTimer = 0,
                    stickyHeight = $('.fixed-header').outerHeight(),
                    stickyAfter = $('.fixed-header').outerHeight() + 20;
                    $(window).scroll(function() {
                        var currentScroll = $(this).scrollTop();

                        // if ( $('.fixed-header').length < 1 ) {
                            
                        //     var fixedHeaderHtml = et_fixed_header_content();

                        //     header.after(fixedHeaderHtml);
                        //     etTheme.mainNavigation();
                        // }

                        // sticky header
                        if( ( currentScroll < previousScroll ) && ( currentScroll > startOffset ) ) {
                            $('.fixed-header').addClass('sticky-header-enabled');
                        } else {
                            $('.fixed-header').removeClass('sticky-header-enabled');
                        }

                        /*if (currentScroll < previousScroll){
                            // Scroll up
                        } else {
                            //Scroll down
                        }*/

                        previousScroll = currentScroll;
                    });
                }
            }
        },

        fixedFooter: function() {
            if( ! $('body').hasClass('et-footer-fixed-on')) return;
            var footer = $('.et-footers-wrapper');
            var pageWrapper = $('.page-wrapper');

            pageWrapper.css('marginBottom', footer.outerHeight() );
            $(window).resize(function() {
                pageWrapper.css('marginBottom', footer.outerHeight() );
            });

        },
        resizeVideo: function() {
            $(document).find('.single-product .product-video-popup iframe[src*="youtube.com"], .single-product .product-video-popup iframe[src*="vimeo.com"], article.blog-post iframe[src*="youtube.com"], article.blog-post iframe[src*="vimeo.com"]').each(function() {
                var video = $(this);
                video.attr('width', '100%');
                var videoWidth = video.width();
                video.css('height', videoWidth * 0.56, 'important');
            });
        },
        windowsPhoneFix: function() {
            // **********************************************************************//
            // ! Windows Phone Responsive Fix
            // **********************************************************************//
            if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement("style");
                msViewportStyle.appendChild(
                    document.createTextNode("@-ms-viewport{width:auto!important}")
                );
                document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
            }
        },
        popup: function() {
            var et_popup_closed = $.cookie('etheme_popup_closed');
            $('.etheme-popup').magnificPopup({
                items: {
                    src: '#etheme-popup-wrapper',
                    type: 'inline'
                },
                removalDelay: 300, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = 'mfp-zoom-out';
                        $('body').addClass('newsletter-open');
                        $('html').addClass('et-mfp-opened');
                    },
                    beforeClose: function() {
                        //if($('#showagain:checked').val() == 'do-not-show')
                        $.cookie('etheme_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
                        setTimeout(function(){
                            $('body').removeClass('newsletter-open');
                        }, 300)
                    },
                    afterClose: function() {
                        $('html').removeClass('et-mfp-opened');
                    }
                }
            });
            if(et_popup_closed != 'do-not-show' && $('.etheme-popup').length > 0 ) {
                if( $('body').hasClass('scroll-popup') ) {
                    var localShown = false;
                    $(window).scroll(function() {
                        if( localShown ) return false;
                        if( $(document).scrollTop() > $(document).height() - $(window).height() - 300 ) {
                            var delay = $('#etheme-popup-holder').attr('data-delay');
                            setTimeout(function(){
                                $('.etheme-popup').magnificPopup('open');
                            }, delay);
                            localShown = true;
                        }
                    });
                } else if( $('body').hasClass('open-popup') ) {
                    var delay = $('#etheme-popup-holder').attr('data-delay');
                    setTimeout(function(){
                        $('.etheme-popup').magnificPopup('open');
                    }, delay);
                }
            }
        },


        imagesLightbox: function() {
            // **********************************************************************//
            // ! Images lightbox
            // **********************************************************************//
            $("a[rel^='lightboxGall']").magnificPopup({
                type:'image',
                gallery:{
                    enabled:true
                },
                beforeOpen: function() {
                    $('html').addClass('et-mfp-opened');
                },
                afterClose: function () {
                    $('html').removeClass('et-mfp-opened');
                }
            });

            $("a[rel='lightbox'], a[rel='pphoto']").magnificPopup({
                type:'image',
                closeBtnInside: true,
                midClick: true,
                image: {
                    verticalFit: false, // Fits image in area vertically
                },
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function() {
                        $('html').addClass('et-mfp-opened et-lightbox-opened');
                        // just a hack that adds mfp-anim class to markup
                        this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                        this.st.mainClass = 'mfp-zoom-out';
                    },
                    afterClose: function () {
                        $('html').removeClass('et-mfp-opened et-lightbox-opened');
                    }
                },
            });
        },
        animateCounter: function(el) {
            // **********************************************************************//
            // ! Animated Counters
            // **********************************************************************//
            var initVal = parseInt(el.text());
            var finalVal = el.data('value');
            if(finalVal <= initVal) return;
            var intervalTime = 1;
            var time = 200;
            var step = parseInt((finalVal - initVal)/time.toFixed());
            if(step < 1) {
                step = 1;
                time = finalVal - initVal;
            }
            var firstAdd = (finalVal - initVal)/step - time;
            var counter = parseInt((firstAdd*step).toFixed()) + initVal;
            var i = 0;
            var interval = setInterval(function(){
                i++;
                counter = counter + step;
                el.text(counter);
                if(i == time) {
                    clearInterval(interval);
                }
            }, intervalTime);
        },
        loadInView: function() {
            // **********************************************************************//
            // ! Load in view
            // **********************************************************************//

            var counters = $('.animated-counter');

            counters.each(function(){
                $(this).waypoint(function(){
                    etTheme.animateCounter($(this));
                }, { offset: '100%' });
            });

            var progressBars = $('.progress-bars');
            progressBars.waypoint(function() {
                i = 0;
                $(this).find('.progress-bar').each(function () {
                    i++;

                    var el = $(this);
                    var width = $(this).data('width');
                    setTimeout(function(){
                        el.find('div').animate({
                            'width' : width + '%'
                        },400);
                        el.find('span').css({
                            'opacity' : 1
                        });
                    },i*300, "easeOutCirc");

                });
            }, { offset: '85%' });

        },
        cleanSpaces: function() {
            // **********************************************************************//
            // ! Remove some br and p
            // **********************************************************************//
            $('.toggle-element ~ br').remove();
            $('.toggle-element ~ p').remove();
            $('.block-with-ico h5').next('p').remove();
            $('.tab-content .row-fluid').next('p').remove();
            $('.tab-content .row-fluid').prev('p').remove();
        },
        contentProdImages: function() {
            // **********************************************************************//
            // ! Products grid images slider
            // **********************************************************************//

            $('.hover-effect-slider').each(function() {
                var slider = $(this),
                    index = 0,
                    process = false,
                    time = 300,
                    autoSlide,
                    imageLink = slider.find('.product-content-image'),
                    imagesWrapper = slider.find('.images-slider-wrapper'),
                    image = imageLink.find('img'),
                    imagesList = imageLink.attr('data-images').split(","),
                    arrowsHTML = '<div class="sm-arrow arrow-left"></div><div class="sm-arrow arrow-right"></div>',
                    counterHTML = '<div class="slider-counter"><span class="current-index">1</span>/<span class="slides-count">' + imagesList.length + '</span></div>';

                if(imagesList.length > 1) {
                    if ( !imagesWrapper.is('.arrows-added') ) {
                        imagesWrapper.addClass('arrows-added');
                        imagesWrapper.prepend(arrowsHTML);
                        // slider.prepend(counterHTML);
                    }

                    slider.find('.sm-arrow').mouseover(function() {
                        slider.addClass('is_arrows-hovered');
                    });

                    slider.find('.sm-arrow').mouseleave(function() {
                        slider.removeClass('is_arrows-hovered');
                    });

                    // Previous image on click on left arrow
                    slider.find('.arrow-left').click(function(event) {
                        if( process ) return;
                        process = true;
                        prevImage();
                    });

                    // Next image on click on left arrow
                    slider.find('.arrow-right').click(function(event) {
                        if( process ) return;
                        process = true;
                        nextImage();
                    });
                }

                function nextImage() {
                    if(index < imagesList.length - 1) {
                        index++;
                    } else {
                        index = 0; // if the last image set it to first
                    }
                    changeImage(index);
                }

                function prevImage() {
                    if(index > 0) {
                        index--;
                    } else {
                        index = imagesList.length-1; // if the first item set it to last
                    }
                    changeImage(index);
                }

                function changeImage(index) {

                    process = false;
                    image.attr('src', imagesList[index]).attr('srcset','');
                    image.removeAttr('srcset');
                    //slider.find('.current-index').text(index);// update slider counter
                }

            });

            $(document).on('mouseover', '.st-swatch-in-loop', function() {
                $(this).parents('.content-product').find('.product-image-wrapper').addClass('is_arrows-hovered');
            });
            $(document).on('mouseleave', '.st-swatch-in-loop', function() {
                $(this).parents('.content-product').find('.product-image-wrapper').removeClass('is_arrows-hovered');
            });

        },
        wishlist: function() {
            // **********************************************************************//
            // ! Wishlist
            // **********************************************************************//
            if( $('.et-wishlist-widget').length == 0 ) return;

            setTimeout(function() {
                $('body').addClass('wishlist-show');
            }, 1000);

            $('.yith-wcwl-add-button.show').each(function(){
                var wishListText = $(this).find('a').text();
                $(this).find('a').attr('data-hover',wishListText);
            });

            var $fragment_refresh = {
                url: etConfig.ajaxurl,
                data: {
                    action: 'etheme_wishlist_fragments'
                },
                method: 'get',
                success: function(data) {
                    setWishlist(data.wishlist);
                }
            };
 
            function refresh_wishlist_fragment() {
                $.ajax( $fragment_refresh );
            }

            $( document.body ).bind( 'added_to_cart added_to_wishlist removed_from_wishlist', function() {
                refresh_wishlist_fragment();
            });

            function setWishlist( wishlist ) {
                $('.et-wishlist-widget').replaceWith(wishlist);
            }

            var timeout = 0;

            $( document.body ).bind( 'added_to_wishlist', function() {
                var navbar = $('.header .navbar-header');

                clearTimeout(timeout);

                if( $('body').hasClass('et-header-fixed') && $('.fixed-header').hasClass('fixed-enabled') ) {
                    navbar = $('.fixed-header .navbar-header');
                }

                navbar.addClass('wishlist-widget-show');

                setTimeout(function() {
                    navbar.addClass('wishlist-widget-show');
                }, 1000);

                timeout = setTimeout(function() {
                    navbar.removeClass('wishlist-widget-show');
                }, 4500);
            });

            $(document).on('click', '.add_to_wishlist', function(e) {
                e.preventDefault();
                var r = 12;
                var view_default = $(this).parents('.content-product').parent().hasClass('product-view-default');
                if(view_default) {
                    r = 16;
                }
                
                // var yith_premium = $(this).parent().find('.yith-wcwl-popup').length > 0 ? true : false;
                $(this).parent().parent().prepend('<div class="et-loader"><svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="'+r+'" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg></div>');
                $(this).parent().parent().find('a').fadeTo(100, 0);
                var el = $(this);
    
                setTimeout(function(){
                    el.parent().parent().find('.et-loader').hide(300);  
                    el.parent().parent().find('a').fadeTo(300, 1);
                }, 1000);

                // $(this).parent().parent().find('.et-loader').delay(700).remove();
                // $(this).parent().parent().find('a').delay(700).show(100);
            });

        },
        mainNavigation: function() {
            // **********************************************************************//
            // ! Main Navigation plugin
            // **********************************************************************//
            $.fn.et_menu = function ( options ) {
                var methods = {
                    init: function(el) {
                        methods.el = el;

                        if ( $(window).width() <= 1024 ) {
                            methods.responsive();
                        }

                        if ( $(window).width() <= 1440 ) {
                            methods.TouchHoverDropdown();
                        }

                        if ( $(window).width() >= 993 ) {
                            methods.openByClick();
                        }

                        $(window).resize(function() {
                            if ( ! $( 'body' ).hasClass( 'et-vertical-fixed' ) || $('.et_b_header-menu').length > 0 ) methods.setOffsets();
                            methods.sideMenu();
                        });

                        if ( ! $( 'body' ).hasClass( 'et-vertical-fixed' ) || $('.et_b_header-menu').length > 0 ) methods.setOffsets();
                        // methods.alignLeft();

                        el.find('a').has('.nav-item-tooltip').hover(function() {
                            var newContent = '';
                            var tooltip = $(this).find('.nav-item-tooltip');
                            var src = tooltip.find('>div').first().attr('data-src');
                            if(src.length > 10) {
                                newContent = '<img src="' + src + '" />';
                                tooltip.html(newContent);
                            }
                        });

                    },
                    responsive: function(){
                        $( '.header-wrapper:not(.mob-hide) .menu-main-container li a' ).on( 'click', function(e){
                            if ( ! $(this).parent('li').hasClass( 'menu-item-has-children' ) ) return;
                            if ( ! $(this).is('[q]') ) {
                                $(this).attr( 'q', 0 );
                            } 
                            var q = $(this).attr( 'q' );
                            if ( q < 1 ) {
                                q++;
                                $(this).attr( 'q', q );
                                e.preventDefault();
                            }
                        });
                    },
                    setOffsets: function() {

                        methods.el.find('.item-design-mega-menu > .nav-sublist-dropdown, .item-design-posts-subcategories > .nav-sublist-dropdown').each(function() {

                            if ( $('body').hasClass('mega-menus-full-width') && $(this).parent().hasClass('item-design-mega-menu') ) {
                                return;
                            }

                            var boxed = ($('body').hasClass('boxed') || $('body').hasClass('framed'));
                            var extraBoxedOffset = 0;
                            if(boxed) {
                                extraBoxedOffset = $('.page-wrapper').offset().left;
                            }

                            var li = $(this).parent();
                            var liOffset = li.offset().left - extraBoxedOffset;
                            var liOffsetTop = li.offset().top;
                            var liWidth = $(this).parent().width();
                            var dropdowntMarginLeft = liWidth/2;
                            var dropdownWidth = $(this).outerWidth();
                            var dropdowntLeft = liOffset - dropdownWidth/2;
                            var dropdownBottom = liOffsetTop - $(window).scrollTop() + $(this).outerHeight();
                            var left = 0;
                            var fitHeight = false;

                            if(dropdowntLeft < 0) {
                                left = liOffset - 10;
                                dropdowntMarginLeft = 0;
                            } else {
                                left = dropdownWidth/2;
                            }
                            
                            if ( $('body').is('.rtl') ) {
                                $(this).css({
                                    'right': - left,
                                    'marginLeft': dropdowntMarginLeft
                                });
                            }
                            else {
                                $(this).css({
                                    'left': - left,
                                    'marginLeft': dropdowntMarginLeft
                                });   
                            }

                            var dropdownRight = ($(window).width() - extraBoxedOffset*2) - (liOffset - left + dropdownWidth + dropdowntMarginLeft);

                            if(dropdownRight < 0) {
                                $(this).css({
                                    'left': 'auto',
                                    'right': - ($(window).width() - liOffset - liWidth - 10) + extraBoxedOffset*2
                                });
                            }

                            if(fitHeight && dropdownBottom > $(window).height()) {
                                $(this).css({
                                    'top': 'auto',
                                    'bottom': - ($(window).height() - (liOffsetTop - $(window).scrollTop() + li.outerHeight())) + 15
                                });
                            }

                        });

                    },

                    openByClick: function () {

                        var singleClickTimer = 0; //define a var to hold timer event in parent scope
                        methods.el.find('.menu-item-has-children.menu-open-by-click > a').click(function(e){ //using jquery click handler
                            e.preventDefault();
                             var parent = $(this).parent();
                            if (e.detail == 1) { //ensure this is the first click
                                singleClickTimer = setTimeout(function(){ //create a timer
                                    parent.toggleClass('opened'); //run your single click code
                                },250); //250 or 1/4th second is about right to know that check if sublist is opened or closed 
                            }
                        })

                        .dblclick(function(e){ //using jquery dblclick handler
                            e.preventDefault();
                            clearTimeout(singleClickTimer); //cancel the single click
                            window.location = $(this).attr('href'); //run your double click code
                        });

                    },

                    // alignLeft: function() {
                        //var li = $('.item-design-posts-subcategories');
                        //
                        //if(li.length < 1) return;
                        //
                        //var dropdown = li.find('.nav-sublist-dropdown'),
                        //    dropdownOffset = li.offset().left,
                        //    contentOffset = $('.page-wrapper').find('> .container').first().offset().left,
                        //    dropdownContainerOffset = dropdownOffset - contentOffset;
                        //
                        //dropdown.css({
                        //    'left': - dropdownContainerOffset + 30
                        //});

                    // },

                    sideMenu: function() {
                        if($(window).height() < 800) {
                            $('.header-wrapper:not(.mob-hide)').addClass('header-scrolling');
                        } else {
                            $('.header-wrapper:not(.mob-hide)').removeClass('header-scrolling');
                        }
                    },

                    TouchHoverDropdown: function () {
                        if ( $(window).width() < 992 ) return;
                        var times = 0;
                        var isTouch = ('ontouchstart' in document.documentElement);
                        if( isTouch ) {
                            $('.menu-item-has-children a').click(function(e) {
                                if (times == 0) {
                                    e.preventDefault();
                                    times = 1;
                                }
                                else {
                                    $('.menu-item-has-children a').dblclick(function() {
                                        window.location = $(this).attr('href');
                                    });
                                }
                            });
                        }
                    }
                };

                var settings = $.extend({
                    type: "default"
                }, options );

                methods.init(this);


                return this;
            }

            // First Type of column Menu
            $('.menu-main-container .menu:not(.header-type-vertical .menu, .header-type-vertical2 .menu), .et_b_header-menu .menu').et_menu({
                type: "default"
            });

        },
        backToTop: function() {
            // **********************************************************************//
            // ! "Top" button
            // **********************************************************************//

            var scroll_timer;
            var displayed = false;
            var $message = $('.back-top');

            $(window).scroll(function () {
                // window.clearTimeout(scroll_timer);
                // scroll_timer = window.setTimeout(function () {
                    if($(window).scrollTop() <= 0) {
                        displayed = false;
                        $message.addClass('backOut').removeClass('backIn');
                    }
                    else if(displayed == false) {
                        displayed = true;
                        $message.stop(true, true).removeClass('backOut').addClass('backIn').click(function () { $message.addClass('backOut').removeClass('backIn'); });
                    }
                // }, 0); // was 400
            });

            $('.back-top').click(function(e) {
                $('html, body').animate({scrollTop:0}, 600);
                return false;
            });
        },
        portfolio: function() {
            // **********************************************************************//
            // ! Portfolio
            // **********************************************************************//

            // if ( ! $( 'body').is( '.etheme_masonry_on' ) ) return;
            var masonry = true;
            if ( ! $( 'body').is( '.etheme_masonry_on' ) ) masonry = false;

            var $portfolio = $('.portfolio');

            $portfolio.each(function() {

                if ( !masonry ) {
                    var $grid = $(this);
                }
                else {

                    var $grid = $(this).isotope({
                        itemSelector: '.portfolio-item',
                        isOriginLeft: ! $('body').hasClass('rtl'),
                        masonry: {
                            columnWidth: '.grid-sizer'
                        }
                    });

                    // layout Isotope after each image loads
                    $grid.imagesLoaded().progress( function() {
                        $grid.isotope('layout');
                    });
                }

                $grid.parents('.brands-list, .page-template-portfolio').find('.portfolio-filters a').click(
                    function(e) {
                    e.preventDefault();
                    et_portfolio_filters($(this));
                });

                if ( $('.page-template-portfolio').length < 1 ) {
                    $grid.parent().prev('.portfolio-filters').find('a').click(
                        function(e) {
                        e.preventDefault();
                            et_portfolio_filters($(this));
                        }
                    );
                }

                function et_portfolio_filters (_this){
                    var selector = _this.attr('data-filter'),
                    element_with_attr = _this.parents('.portfolio-filters').next('.portfolio-wrapper').find('.et-load-portfolio');

                    var limit = element_with_attr.attr('data-limit'),
                    portfolio_class = element_with_attr.attr('data-class'),
                    cat = _this.attr('data-category-id'),
                    is_cat = element_with_attr.attr('data-portfolio-category-page'),
                    cat_name = element_with_attr.attr('data-portfolio-category-page-name'),
                    columns = element_with_attr.attr('data-columns');
                    // $(document).find('.'+portfolio_class).parent().find('.portfolio-filters a').removeClass('active');
                    _this.parents('.portfolio-filters').find('li a').removeClass('active');
                    if(!_this.hasClass('active')) {
                        _this.addClass('active');
                    }

                    if ( ( ! limit || limit == -1 ) && masonry ) {
                        $grid.isotope({ filter: selector });
                        // $(document).find( '.'+portfolio_class ).find('.portfolio').isotope({ filter: selector });
                    }
                    else {
                        $.ajax( {
                            url: etConfig.ajaxurl,
                            method: 'POST',
                            dataType: 'json',
                            data: { 
                                'action': 'et_portfolio_ajax',
                                'limit': limit, 
                                'category': cat,
                                'is_category': is_cat,
                                'category_name': cat_name,
                                'class': portfolio_class,
                                'url': window.location.href,
                                'columns': columns
                            },
                            before: function() {
                                $('body').removeClass('et-preloader-hide').addClass('et-preloader-on');
                            },
                            success: function( result ) {
                                $('.portfolio-wrapper').replaceWith(result.html);
                            },
                            complete: function() {
                                if ( masonry ) {
                                    var currect_block = $(document).find( '.'+portfolio_class ).find('.portfolio');
                                    currect_block.isotope({
                                        itemSelector: '.portfolio-item',
                                        isOriginLeft: ! $('body').hasClass('rtl'),
                                        masonry: {
                                            columnWidth: '.grid-sizer'
                                        }
                                    });
                                    setTimeout(function(){
                                        currect_block.addClass('with-transition');
                                        currect_block.find('.portfolio-item').addClass('with-transition');
                                        currect_block.isotope('layout');
                                    },300);
                                }
                                setTimeout(function(){
                                    etTheme.global_image_lazy();
                                    etTheme.imagesLightbox();
                                }, 200);
                            },
                            after: function() {
                            },
                            error: function() {
                                etTheme.et_notice('portfolio', 'error');
                            }
                        } );
                    }
                    return false;
                }

                $(document).on('click', '.portfolio-pagination a', function(e){
                    e.preventDefault();
                    var $this = $(this),
                    portfolio = $this.parents('.portfolio-wrapper');

                    var element_with_attr = portfolio.find('.et-load-portfolio');

                    var portfolio_class = element_with_attr.attr('data-class'),
                    url_string = $(this).attr('href'),
                    url        = new URL(url_string),
                    paged      = url.searchParams.get("et-paged"),
                    cat = element_with_attr.attr('data-portfolio-category-page-name'),
                    category  = url.searchParams.get("et-cat"),
                    is_cat = element_with_attr.attr('data-portfolio-category-page'),
                    limit = element_with_attr.attr('data-limit'),
                    columns = element_with_attr.attr('data-columns'),
                    data = element_with_attr.find('span').text(),
                    args       = JSON.parse( data );

                    $.ajax( {
                        url: etConfig.ajaxurl,
                        method: 'POST',
                        dataType: 'json',
                        data: { 
                            'action': 'et_portfolio_ajax_pagination', 
                            'url': window.location.href,
                            'class': portfolio_class,
                            'limit': limit,
                            'is_category': is_cat,
                            'category': category,
                            'cat': cat,
                            'paged': paged,
                            'columns': columns
                        },
                        before: function() {
                        },
                        success: function( result ) {
                            $('.portfolio-wrapper').replaceWith(result);
                        },
                        complete: function() {

                            setTimeout(function(){
                                etTheme.global_image_lazy();
                                etTheme.imagesLightbox();
                            }, 200);

                            if ( masonry ) {
                                var currect_block = $(document).find( '.'+portfolio_class ).find('.portfolio');
                                setTimeout(function(){
                                    currect_block.isotope({
                                        itemSelector: '.portfolio-item',
                                        isOriginLeft: ! $('body').hasClass('rtl'),
                                        masonry: {
                                            columnWidth: '.grid-sizer'
                                        }
                                    });
                                    currect_block.addClass('with-transition');
                                    currect_block.find('.portfolio-item').addClass('with-transition');
                                },200);
                            }

                            var scroll_to = $(document).find( '.'+portfolio_class ).offset().top;
                            if ($(document).find( '.'+portfolio_class ).prev('.portfolio-filters').length) {
                                scroll_to -= $(document).find( '.'+portfolio_class ).prev('.portfolio-filters').outerHeight(true);
                            }
                            if ( $(document).find('.fixed-header').length ) {
                                scroll_to -= $(document).find('.fixed-header').outerHeight(true);
                            }
                            $('html, body').animate({
                                scrollTop: scroll_to
                            }, 1000);
                        },
                        after: function() {
                        },
                        error: function() {
                            etTheme.et_notice('portfolio-pagination', 'error');
                        }
                    } );

                });

            });

            setTimeout(function(){
                $('.portfolio').addClass('with-transition');
                $('.portfolio-item').addClass('with-transition');
                $(window).resize();
            },500);
        },

        isotope: function() {
            // **********************************************************************//
            // ! Blog isotope
            // **********************************************************************//
            if ( ! $( 'body').is( '.etheme_masonry_on' ) ) return;
            $(window).load(function () {
                var $blog = $('.blog-masonry');

                if ( $blog.find('.post-grid').length < 1 ) return; 

                $blog.each(function() {

                    var $grid = $(this).isotope({
                        isOriginLeft: ! $('body').hasClass('rtl'),
                        itemSelector: '.post-grid'
                    });

                    // layout Isotope after each image loads
                    // $grid.imagesLoaded().progress( function() {
                        $grid.isotope('layout');
                    // });

                });
            });

            // **********************************************************************//
            // ! Other elements isotope
            // **********************************************************************//

            $(window).load(function () {
                var $container = $('.isotope-container');
                var $isotope = $('.et-isotope');

                $isotope.each(function() {

                    var $grid = $(this).isotope({
                        itemSelector: '.et-isotope-item',
                        isOriginLeft: ! $('body').hasClass('rtl'),
                        masonry: {
                            columnWidth: '.grid-sizer'
                        }
                    });

                    // layout Isotope after each image loads
                    // $grid.imagesLoaded().progress( function() {
                        $grid.isotope('layout').trigger('layout-changed');
                    // });

                });
            });

            //$isotope.imagesLoaded( function() {
            //});
        },
        woocommerce: function() {
            // **********************************************************************//
            // ! WooCommerce
            // **********************************************************************//

            $(window).load(function(){

                if ( $( 'body' ).is( '.single-product' ) && document.URL.split( '#reviews' ).length == 2 ) {
                    $('#tab_reviews').click();
                    setTimeout(function() {
                        $('html, body').animate({scrollTop: $('.woocommerce-tabs').offset().top }, 300);
                    },  300 );
                }

                if ( $( 'body' ).is( '.single-product' ) && document.URL.split( '#comment' ).length == 2 ) {
                    var id = document.URL.split( '#' )[1];
                    $('#tab_reviews').click();
                    setTimeout(function() {
                        $('html, body').animate({scrollTop: $('#' + id).offset().top }, 300);
                    },  300 );
                }
            });

            $('.woocommerce-review-link').click(function(e) {
                e.preventDefault();
                if( ! $('#tab_reviews').hasClass('opened')) $('#tab_reviews').click();
                $('html, body').animate({scrollTop: $('.woocommerce-tabs').offset().top }, 300);
            });

        },

        quantityIncrements: function( reinit ) {
            if ( $( 'body' ).is( '.et_quantity-off' ) ) return;

            // Quantity buttons
            // $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<span value="+" class="plus" >+</span>' ).prepend( '<span value="-" class="minus" >-</span>' );

            if( reinit ) return;

            $( document ).on( 'click', '.plus, .minus', function() {

                // Get values
                var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
                    currentVal  = parseFloat( $qty.val() ),
                    max         = parseFloat( $qty.attr( 'max' ) ),
                    min         = parseFloat( $qty.attr( 'min' ) ),
                    step        = $qty.attr( 'step' );
                // Format values
                if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                if ( max === '' || max === 'NaN' ) max = '';
                if ( min === '' || min === 'NaN' ) min = 0;
                if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

                // Change the value
                if ( $( this ).is( '.plus' ) ) {

                    if ( max && ( max == currentVal || currentVal > max ) ) {
                        $qty.val( max );
                    } else {
                        $qty.val( currentVal + parseFloat( step ) );
                    }

                } else {

                    if ( min && ( min == currentVal || currentVal < min ) ) {
                        $qty.val( min );
                    } else if ( currentVal > 0 ) {
                        $qty.val( currentVal - parseFloat( step ) );
                    }

                }

                // Trigger change event
                $qty.trigger( 'change' );

            });

            $( document.body ).on( 'updated_wc_div', function() {
                etTheme.quantityIncrements( true );
            } );
        },

        isIE: function  () {
            if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
                return true;
            }
            return false;
        },

        ajaxAddToCartInit: function() {
            var timeout = 0;

            $( document.body )
                .on( 'adding_to_cart', function(event, $thisbutton, data) {

                    if ( $thisbutton == null ) return;

                    var product = $thisbutton.parents('.content-product, form.cart');

                    product.addClass('adding-to-cart').addClass('et-vpf'); // et-visible-product-footer

                    // if($thisbutton.hasClass('single_add_to_cart_button')) {
                        $thisbutton.prepend('<div class="et-loader"><svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg></div>');
                    // }

                })
                .on( 'added_to_cart', function(event, fragments, cart_hash, $thisbutton) {

                    etTheme.global_image_lazy();

                    var product = $thisbutton.parents('.content-product, .type-product, form.cart'),
                        name = product.find('.product-title a').text(),
                        imageSrc = product.find('.wp-post-image').attr('src'),
                        cart = $('.header .shopping-container'),
                        et_notify = $('.et-notify');

                    if ( etConfig.ajaxProductNotify ) {
                        // to show mini text when added to cart with ajax 
                        et_notify.removeClass('removing').attr('data-type', 'success').html(etConfig.successfullyAdded);
                    }

                    clearTimeout(timeout);

                    if( $('body').hasClass('et-header-fixed') && $('.fixed-header').hasClass('fixed-enabled') ) {
                        cart = $('.fixed-header .shopping-container');
                    }  

                    // if($thisbutton.hasClass('single_add_to_cart_button')) {
                        $thisbutton.find('.et-loader').remove();
                    // }

                    if (  $('html').is('.quick-view-open') ) {
                        $('.quick-view-popup').magnificPopup('close');
                    }

                    setTimeout( function() {
                        product.removeClass('adding-to-cart').removeClass('et-vpf');
                    }, 400 );

                    cart.addClass('cart-show');
                    timeout = setTimeout(function() {
                        cart.removeClass('cart-show');                        
                        // tooltip.removeClass('tooltip-shown');
                    }, 3500);

                    if ( etConfig.ajaxProductNotify ) {

                        setTimeout(function(){
                            et_notify.addClass('removing');
                        }, 2000);

                        setTimeout(function(){
                            et_notify.removeClass('removing').attr('data-type', null).html('');;
                        }, 2400);
                        
                    }

                } );

            /* Quantity sync */
            $(document).on('change', 'form.cart input.qty', function() {
                $(this).parents('form').find('button[data-quantity]').attr('data-quantity', this.value);
            });

        },

        variationsThumbs: function() {
            /* Variations images */

            var firstThumb = $('.thumbnails-list .thumbnail-item').first().find('a');

            if( ! firstThumb ) return;

            var img = firstThumb.find('img'),
                origSrc = img.attr('src'),
                origSrcset = img.attr('srcset'),
                origHref = firstThumb.attr('href'),
                origWidth = firstThumb.attr('data-width'),
                origHeight = firstThumb.attr('data-height'),
                defaultEmptySlider = $('.swiper-control-top').attr('data-default-empty') == "true";

            $( '.variations_form' ).on('found_variation', function( event, variation ) {

                if( variation.image_link ) {
                    firstThumb.attr('href', variation.image_link);
                }

                if( variation.image_src ) {
                    img.attr('src', variation.image_src);
                }

                if( variation.image_srcset ) {
                    img.attr('srcset', variation.image_srcset);
                }

                etTheme.setVariationsGallery(this, variation);

                goToFirst();
            })
                .on('reset_data', function() {

                    firstThumb.attr('href', origHref);
                    img.attr('src', origSrc);
                    img.attr('srcset', origSrcset);

                    etTheme.resetVariationsGallery(this, defaultEmptySlider);

                    if ( $('.images-wrapper').hasClass('swiper-vertical-images')) {
                        $('.thumbnails-list').slick('slickGoTo', 0);
                    }

                });

            var goToFirst = function() {
                var swiperMain = $(".main-images").data('Swiper');
                if ( $('.images-wrapper').hasClass('swiper-vertical-images')) {
                    $('.thumbnails-list').slick('slickGoTo', 0);
                }
                else {
                    if( typeof swiperMain != 'undefined') {
                        swipers['swiper-'+index].slideTo(0);
                    }
                }
            };

        },

        reinitVariationsGallery: function(thumbnails, main_images, reset) {

            var quick_view = $(document).find('.quick-view-popup');

            var thumbnails_slider = $('.swiper-control-bottom');
            var vertical_thumbnails_slider = $('.vertical-thumbnails-wrapper');
            var main_slider = $('.swiper-control-top');

            if ( quick_view.length ) {
                var thumbnails_slider = $(quick_view).find('.swiper-control-bottom');
                var vertical_thumbnails_slider = $(quick_view).find('.vertical-thumbnails-wrapper');
                var main_slider = $(quick_view).find('.swiper-control-top');
            }
            var main_slider_arrows = $(main_slider).find('.swiper-custom-left, .swiper-custom-right');
            $(thumbnails_slider).removeClass('initialized swiper-container-initialized second-initialized');
            $(main_slider).removeClass('initialized swiper-container-initialized second-initialized');
            $(thumbnails_slider).find('.thumbnails').html(thumbnails);
            $(vertical_thumbnails_slider).find('.vertical-thumbnails .slick-track').html(thumbnails);

            $(thumbnails_slider, vertical_thumbnails_slider, main_slider_arrows).removeClass('dt-hide mob-hide');
            $(main_slider_arrows).removeClass('dt-hide mob-hide');
            
            if ( reset ) {
                $(thumbnails_slider, vertical_thumbnails_slider).addClass('dt-hide mob-hide');
                $(main_slider_arrows).addClass('dt-hide mob-hide');
            }

            $(main_slider).find('.main-images').html(main_images);

            etTheme.global_image_lazy();
            etTheme.resizeVideo();

            if ( vertical_thumbnails_slider.length ) {
                $('.thumbnails-list').find('.slick-arrow').remove();
                $('.thumbnails-list').slick('reinit');
                // setTimeout(function() {
                //     $('.thumbnails-list').find('.slick-arrow').remove();
                //     $('.thumbnails-list').slick('reinit');
                // }, 700);
            }

            var prev = thumbnails_slider.find('.swiper-button-prev.swiper-button-disabled, .swiper-custom-left.swiper-button-disabled');
            var next = thumbnails_slider.find('.swiper-button-next.swiper-button-disabled, .swiper-custom-right.swiper-button-disabled');

            if ( next.length > 0 && prev.length > 0 ) {
                next.remove();
                prev.remove();
            }

            setTimeout(function() {
                thumbnails_slider.addClass('second-initialized');
                main_slider.addClass('second-initialized');
            }, 300);

            if ( $.fn.zoom && !quick_view.length ) {

                var zoomEnabled  = wc_single_product_params.zoom_enabled;

                if ( ! zoomEnabled ) {
                    return false;
                }

                $( '.woocommerce-main-image' ).each( function( index, target ) {
                    var galleryWidth = $(target).width(),
                    image = $( target ).find( 'img' );

                    // But only zoom if the img is larger than its container.
                    if ( image.data( 'large_image_width' ) > galleryWidth ) {

                        var zoom_options = $.extend( {
                            touch: false
                        }, wc_single_product_params.zoom_options );

                        // $(target).addClass('with-zoom');
                        // $(target).trigger( 'zoom.destroy' );

                        if ( 'ontouchstart' in document.documentElement ) {
                            zoom_options.on = 'click';
                        }
                        else {
                            $(target).zoom( zoom_options );
                        }

                    }
                } );
            }
        },

        setVariationsGallery: function($this, variation) {

            if ( etConfig.variationGallery ) {

                if ( $($this).data('et_variation_gallery_images_default') === undefined ) {
                    
                    $($this).data('et_variation_gallery_images_default', JSON.stringify(variation.variation_gallery_images_default));
              
                }                    

                if ( $($this).data('et_variation_main_gallery_images_default') === undefined ) {
            
                    $($this).data('et_variation_main_gallery_images_default', JSON.stringify(variation.variation_main_gallery_images_default));
                
                }

                if ( variation.variation_gallery_images.length > 1 ) {
                    var thumbnails_images = variation.variation_gallery_images;
                }
                else {
                    var thumbnails_images = variation.variation_gallery_images_default;
                }

                if ( variation.variation_main_gallery_images.length > 1 ) {
                    var main_images = variation.variation_main_gallery_images;
                }
                else {
                    var main_images = variation.variation_main_gallery_images_default;
                }

                var thumbnails = thumbnails_images.map(function (image) {
                    var template = wp.template('et-variation-gallery-slider-template');
                    return template(image);
                }).join('');

                var main = main_images.map(function (image) {
                    var template = wp.template('et-variation-gallery-slider-template');
                    return template(image);
                }).join('');

                if ( thumbnails_images.length > 1 ) {
                    etTheme.reinitVariationsGallery(thumbnails, main, false);
                }
                else {
                    etTheme.reinitVariationsGallery(thumbnails, main, true);
                }
            }
        },

        resetVariationsGallery: function($this, defaultEmptySlider) {

            if ( etConfig.variationGallery ) {

                var variation_gallery_images_default = $($this).data('et_variation_gallery_images_default');
                var variation_main_gallery_images_default = $($this).data('et_variation_main_gallery_images_default');

                if ( variation_gallery_images_default !== undefined && variation_main_gallery_images_default !== undefined ) {

                    var thumbnails = JSON.parse(variation_gallery_images_default).map(function (image) {
                        var template = wp.template('et-variation-gallery-slider-template');
                        return template(image);
                    }).join('');

                    var main_images = JSON.parse(variation_main_gallery_images_default).map(function (image) {
                        var template = wp.template('et-variation-gallery-slider-template');
                        return template(image);
                    }).join('');

                    if ( variation_gallery_images_default.length > 1 ) {
                        etTheme.reinitVariationsGallery(thumbnails, main_images, defaultEmptySlider);
                    }
                }
            }
        },

        videoPopup: function() {
            $('.open-360-popup').magnificPopup({
                type:'inline',
                midClick: true,
                beforeOpen: function() {
                    $('html').addClass('et-mfp-opened');

                },
                afterClose: function() {
                    $('html').removeClass('et-mfp-opened');
                }
            });
        },

        quickView: function() {
            // **********************************************************************//
            // ! AJAX Quick View
            // **********************************************************************//
            $(document).on('click', '.show-quickly, .show-quickly-btn', (function() {
                var $thisbutton = $(this);
                var $productCont = $(this).parent().parent().parent();
                var prodid = $thisbutton.data('prodid');

                $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'etheme_product_quick_view',
                        'prodid': prodid,
                        'variationGallery': etConfig.variationGallery

                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $productCont.addClass('loading').addClass('et-vpf'); // visible product footer 
                        $thisbutton.addClass('loading').prepend('<div class="et-loader"><svg class="loader-circular" viewBox="25 25 50 50"><circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg></div>');
                    },
                    complete: function() {
                        $thisbutton.find('.et-loader').remove();
                        $thisbutton.removeClass('loading');
                        $productCont.removeClass('loading').removeClass('et-vpf');
                        etTheme.quantityIncrements( true );

                        etTheme.global_image_lazy();
                    },
                    success: function(response){  
                        $.magnificPopup.open({
                            items: { src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">' + response + '</div></div>' },
                            type: 'inline',
                            removalDelay: 500,
                            callbacks: {
                                beforeOpen: function() {
                                    // just a hack that adds mfp-anim class to markup
                                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                                    this.st.mainClass = 'mfp-zoom-out';
                                    $('html').addClass('quick-view-open et-mfp-opened');

                                },
                                afterClose: function() {
                                    $('html').removeClass('quick-view-open et-mfp-opened');
                                }
                            },
                        }, 0);

                        if ( $( '.quick-view-popup .product-images' ).attr( 'data-image_height' ) ) {
                            $( '.quick-view-popup img' ).css({
                                'min-height': $( '.quick-view-popup .product-images' ).attr( 'data-image_height' ),
                                'object-fit': 'cover'
                            });
                        }

                        $('.images').addClass('shown');

                        var excerpt = $('.quick-view-excerpts'),
                            info = $('.quick-view-info');

                        excerpt.on('click', '.excerpt-title', function() {
                            if( ! info.hasClass('info-hidden') ) {
                                info.slideUp(300).addClass('info-hidden');
                            } else {
                                info.slideDown(300).removeClass('info-hidden');
                            }
                            excerpt.toggleClass('show-content');
                        });

                        etTheme.swiperFunc();

                        if ( $( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                            ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                        }
                    },
                    error: function() {
                        $.magnificPopup.open({
                            items: {
                                src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">Error with AJAX request</div></div>'
                            },
                            type: 'inline',
                            removalDelay: 500, //delay removal by X to allow out-animation
                            callbacks: {
                                beforeOpen: function() {
                                    $('html').addClass('et-mfp-opened');
                                    this.st.mainClass = 'mfp-zoom-in-to-left-out';
                                },
                                afterClose: function() {
                                    $('html').removeClass('et-mfp-opened');
                                }
                            }
                        }, 0);
                    }
                });

            }));

            $('body').on('click', '.quick-view-popup .main-images a', function(e) {
                e.preventDefault();
            });
        },
        searchform: function() {
            // **********************************************************************//
            // ! Search form
            // **********************************************************************//

            var search = $('.header-search');

            search.each(function(){
                var s = $(this);

                s.on('click', '.search-btn', function( e ) {
                    e.preventDefault();

                    if( search.hasClass('search-open') ) {
                        closeSearch();
                    } else {
                        openSearch();
                    }
                });

                $('body').on("click", ".page-wrapper", function(event) {

                    if ( ! $(event.target).is('.header-search') && $(event.target).closest('.header-search').length ) return;

                    if( s.hasClass('search-open') ) {
                        closeSearch();
                    }
                });

                var openSearch = function() {
                    //$('body').addClass('global-search-open');
                    s.closest($('.navbar-header')).addClass('search-active');
                    s.parents('.header-wrapper, .fixed-header').addClass('search-now-opened');
                    s.addClass('search-open');
                    s.find('.search-form-wrapper').fadeIn(200);
                    s.find('input[type="text"]').focus();
                };

                var closeSearch = function() {
                    //$('body').removeClass('global-search-open');
                    s.parents('.header-wrapper, .fixed-header').removeClass('search-now-opened');
                    s.removeClass('search-open');
                    s.find('.search-form-wrapper').fadeOut(200);
                    s.closest($('.navbar-header')).removeClass('search-active');
                };
            });

        },
        tabs: function() {
            // **********************************************************************//
            // ! Tabs
            // **********************************************************************//

            var tabs = $('.tabs');
            $('.tabs > p > a').unwrap('p');

            var leftTabs = $('.left-bar, .right-bar');
            var newTitles;
            var time = 50;

            leftTabs.each(function(){

                var $this = $(this);

                newTitles = $this.find('.tabs-nav').clone();

                newTitles.removeClass('tabs-nav').find('a').addClass('tab-title-left');

                newTitles.first().addClass('opened');

                var tabNewTitles = $('<div class="left-titles"></div>').prependTo($this);
                tabNewTitles.html(newTitles);

                $this.find('.tab-content').css({
                    'minHeight' : tabNewTitles.height()
                });
            });


            tabs.each(function(){
                var $this = $(this);
                var href = [];
                var id = '';
                var tab_closed = ($this.find('.tab-title').first().parent().hasClass('tab_closed') != true) ? true : false;

                if( $('.tabs').find('.swiper-container').length ) {
                    swipers['swiper-'+tabs.first('.et-tab').find('.swiper-container').attr('id')].init();
                    swipers['swiper-'+tabs.first('.et-tab').find('.swiper-container').attr('id')].update();
                    $this.find('.tab-title').on('click', function(){
                        swipers['swiper-'+tabs.first('.et-tab').find('.swiper-container').attr('id')].init();
                        swipers['swiper-'+tabs.first('.et-tab').find('.swiper-container').attr('id')].update();

                    });
                }

                if( tabs.hasClass('accordion') || tabs.hasClass('left-bar') ) {
                    $this.find('.tabs-nav').remove();
                    if ( tab_closed ) {
                        $this.find('.accordion-title').first().addClass('opened-parent');
                    }
                }

                $.each( $this.find('.tab-title'), function( i, val ) {
                    href[i] = val.href;
                });

                if ( $.inArray( document.URL, href ) != -1 ) {
                    id = document.URL.split( '#' );
                    $( '#' + id[1] ).addClass( 'opened' ).parent().addClass( 'et-opened' );
                    $this.find('.accordion-title').first().addClass( 'opened' );
                    $this.addClass('tabs-ready');
                    $this.find('#content_' + id[1] + '.et-tab').show();
                } else {
                    if ( tab_closed ) {
                        $this.find('.tab-title').first().addClass('opened').parent().addClass('et-opened');
                        $this.find('.accordion-title').first().addClass('opened');
                        $this.find('.et-tab').first().show();
                    }
                    $this.addClass('tabs-ready');
                }


                // fast fix tabs asap 
                if ( $(window).width() < 993 ) {
                    $this.on('click', '.tab-contents .accordion-title', function(e){
                    e.preventDefault();
                    
                        //if ( $this.parents( '.woocommerce-tabs' ).length > 0 ) return;
                        var tabId = $(this).attr('data-id');

                        if(tabOpened(tabId)){
                            closeTab($this, tabId, false);
                        }else{
                            var reopen = ( $(this).parents( '.tabs' ).first().find( '.et-tabs-wrapper' ).length > 0 ) ? tabReopen( $(this) ) : '';

                            closeAllTabs( $this, $(this) );
                            setTimeout(function() {
                                if ( $this.parent().hasClass('tab_closed') ) {
                                    $this.parent().removeClass('tab_closed');
                                }
                                else {
                                    openTab($this, tabId);
                                    setTimeout(function() {
                                       scrollToId(tabId);
                                    }, time + 150 );
                                    if ( reopen != '' ) {
                                        openTab($this, reopen);
                                        setTimeout(function() {
                                           scrollToId(tabId);
                                        }, time + 150 );
                                    }
                                }
                            }, time );
                        }
                    });
                    function scrollToId(id){
                        var offset = ($('.fixed-header').length > 0) ? $('.fixed-header').outerHeight() : 0;
                        var position = 0;

                        position = $('[data-id='+id+']').offset().top - offset;

                        $('html, body').animate({
                            scrollTop: position
                        }, 1000);
                    }
                }


                if ( $this.hasClass('accordion') ) {
                    $this.on('click', '.accordion-title', function(e){
                        e.preventDefault();
                        if ( $this.parents( '.woocommerce-tabs' ).length > 0 ) return;
                        var tabId = $(this).find('.tab-title').attr('id');

                        if(tabOpened(tabId)){
                            closeTab($this, tabId, false);
                        }else{
                            var reopen = ( $(this).parents( '.tabs' ).first().find( '.et-tabs-wrapper' ).length > 0 ) ? tabReopen( $(this) ) : '';

                            closeAllTabs( $this, $(this) );
                            setTimeout(function() {
                                if ( $this.parent().hasClass('tab_closed') ) {
                                    $this.parent().removeClass('tab_closed');
                                }
                                else {
                                    openTab($this, tabId);
                                    if ( reopen != '' ) openTab($this, reopen);
                                    if ( $this.parents('.fixed-content').length > 0 ) {}
                                    else scrollToId(tabId);
                                }
                            }, time + 500 );
                        }

                        function scrollToId(id){
                            var offset = ($('.fixed-header').length > 0) ? $('.fixed-header').outerHeight() : 0;
                            var position = 0;

                            position = $('#'+id).offset().top - offset;

                            $('html, body').animate({
                                scrollTop: position
                            }, 1000);
                        }
                    });
                }
                else {
                    $this.on('click', '.tab-title, .tab-title-left', function(e){
                        e.preventDefault();
                        var tabId = $(this).attr('id');

                        if(tabOpened(tabId)){
                            //closeTab($this, tabId, false);
                        }else{
                            var reopen = ( $(this).parents( '.tabs' ).first().find( '.et-tabs-wrapper' ).length > 0 ) ? tabReopen( $(this) ) : '';

                            closeAllTabs( $this, $(this) );
                            setTimeout(function() {
                                if ( $this.parent().hasClass('tab_closed') ) {
                                    $this.parent().removeClass('tab_closed');
                                }
                                else {
                                    openTab($this, tabId);
                                    if ( reopen != '' ) openTab($this, reopen);
                                }

                                // Init slider inside etheme tabs
                                var content  = $( '#content_'+tabId );
                                if ( content.find( '.swiper-container' ).length > 0) {
                                    var slide_id = content.find( '.swiper-container' ).attr( 'id' );
                                    swipers['swiper-'+slide_id].init();
                                    swipers['swiper-'+slide_id].update();
                                }
                            }, time );

                            // if ( $(this).parent().is( '.accordion-title' ) ) {
                            //     setTimeout(function() {
                            //        scrollToId(tabId);
                            //     }, time + 150 );
                            // };
                        }
                    });
                }

            });

            var tabReopen = function( tab ) {
                var reopen = '';
                tab.parents( '.tabs' ).first().find( '.et-tabs-wrapper .tab-title, .et-tabs-wrapper .tab-title-left' ).each(function(){
                    if ( $(this).hasClass( 'opened' ) ) {
                        reopen = $(this).attr('id');
                    }

                });
                return reopen;
            };

            var tabOpened = function(id) {
                return $('#' + id).hasClass('opened');
            };

            var openTab = function(tabs, id) {
                if( tabs.hasClass('accordion') || ($(window).width() < 767 && ! tabs.hasClass('products-tabs')) ) {
                    $('#' + id).parent().addClass('opened-parent');
                    $('#content_'+id).slideDown(300); // Fix it
                } else {
                    $('#content_' + id).fadeIn(100);
                }

                $('#' + id).addClass('opened').parent().addClass('et-opened');
                $('[data-id="' + id +'"]').addClass('opened');

                if( $('.tabs').find('.swiper-container').length ) {
                    swipers['swiper-'+$('#content_' + id).find('.swiper-container').attr('id')].init();
                }

                setTimeout(function() {
                    $(window).resize();
                    var content  = $( '#content_'+id );
                    if ( content.find( '.swiper-container' ).length > 0) {
                        var slide_id = content.find( '.swiper-container' ).attr( 'id' );
                        swipers['swiper-'+slide_id].init();
                        swipers['swiper-'+slide_id].update();
                    }
                }, 100 );
            };

            var closeTab = function(tabs, id, forceClose) {
                if( tabs.hasClass('accordion') || ($(window).width() < 767 && ! tabs.hasClass('products-tabs'))){
                    $('#' + id).removeClass('opened').parent().removeClass('et-opened');
                    $('#' + id).parent().removeClass('opened-parent');
                    $('[data-id="' + id +'"]').removeClass('opened');
                    $('#content_' + id).slideUp(300);
                } else if(forceClose) {
                    $('#' + id).removeClass('opened').parent().removeClass('et-opened');
                    $('[data-id="' + id +'"]').removeClass('opened');
                    $('#content_' + id).fadeOut(100);
                }

            };

            var closeAllTabs = function( tabs, curretTab ) {
                curretTab.parents( '.tabs' ).first().find( '.tab-title, .tab-title-left' ).each(function(){
                    var tabId = $(this).attr('id');
                    if(tabOpened(tabId)) {
                        closeTab(tabs, tabId, true);
                    }
                });
            };

            // $('.tabs-with-scroll .tab-content-inner').nanoScroller({
            //     contentClass: 'tab-content-scroll',
            //     preventPageScrolling: true
            // });
        },
        categoriesAccordion: function() {
            // **********************************************************************//
            // ! Categories Accordion
            // **********************************************************************//

            $.fn.etAccordionMenu = function ( options ) {

                var $this = $(this);

                var etCats = $('.content-page .product-categories');
                $this.addClass('with-accordion');
                var openerHTML = ' <i class="et-icon et-down-arrow open-this"></i>';

                $this.find('> li').has('.children, .nav-sublist-dropdown').has('li').addClass('parent-level0');
                $this.find('li').has('.children, .nav-sublist-dropdown').prepend(openerHTML);
                
                if($this.find('.current-cat, .current-cat-parent').length > 0) {
                    $this.find('.current-cat, .current-cat-parent').find('> .open-this').removeClass( 'et-down-arrow' ).addClass('et-up-arrow').parent().addClass('opened').find('> ul.children').show();
                } else if ($this.closest('.sidebar').hasClass('first-category-closed') !== true) {
                    $this.find('>li').find('> .open-this').removeClass( 'et-down-arrow' ).addClass('et-up-arrow').parent().addClass('opened').find('> ul.children').show();
                }

                $this.find('.open-this').click(function() {
                    if($(this).parent().hasClass('opened')) {
                        $(this).removeClass( 'et-up-arrow' ).addClass('et-down-arrow').parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                    }else {
                        $(this).removeClass( 'et-down-arrow' ).addClass('et-up-arrow').parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                    }
                });

                return this;
            }

            if(etConfig.catsAccordion) {
                $('.content-page .product-categories').etAccordionMenu();
            }
        },

        CustomMenuAccordion: function() {
            // **********************************************************************//
            // ! Custom Menu Accordion
            // **********************************************************************//

            $.fn.etAccordionMenu = function ( options ) {

                var $this = $(this);

                if ( $this.parents('.et_b_header-widget').length > 0 ) {
                    // $this.parents('.et_b_header-widget').find('.sidebar-widget, .topbar-widget, .mobile-sidebar-widget, .top-panel-widget').removeClass('sidebar-widget topbar-widget mobile-sidebar-widget top-panel-widget');
                    return;
                }

                $this.addClass('with-accordion');
                var openerHTML = ' <i class="et-icon et-down-arrow open-this"></i>';

                $this.find('> li').has('.menu-item-has-children, .sub-menu').has('li').addClass('parent-level0');
                $this.find('li').has('.menu-item-has-children, .sub-menu').prepend(openerHTML);

                if($this.find('.current-menu-item').length > 0) {
                    $this.find('.current-menu-item').find('> .open-this').removeClass( 'et-down-arrow' ).addClass('et-up-arrow').parent().addClass('opened').find('> ul.children, > ul.sub-menu').show();
                } else {
                    $this.find('>li').first().find('> .open-this').removeClass( 'et-down-arrow' ).addClass('et-up-arrow').parent().addClass('opened').find('> ul.children, > ul.sub-menu').show();
                }

                $this.find('.open-this').click(function() {
                    if($(this).parent().hasClass('opened')) {
                        $(this).removeClass( 'et-up-arrow' ).addClass('et-down-arrow').parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                    }else {
                        $(this).removeClass( 'et-down-arrow' ).addClass('et-up-arrow').parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                    }
                });

                return this;
            }

            $( '.sidebar-widget.widget_nav_menu .menu' ).etAccordionMenu();
        },

        widgetsOpenClose: function () {

            if ( $('body').is('.s_widgets-open-close') ) {
                $(document).on('click', '.sidebar-widget .widget-title', function() {
                    $(this).parent().toggleClass('et_widget-closed');
                    $(this).parent().find('> ul, > select:not(.select2-hidden-accessible), > .select2-container, > div:not(.widget-title), > p:not(.widget-title), > form').slideToggle(300);
                });
            }
            if ( $('body').is('.f_widgets-open-close') ) { 
                $(document).on('click', '.footer-widget > .widget-title', function() {
                    $(this).parent().toggleClass('et_widget-closed');
                    $(this).parent().find('> ul, > select:not(.select2-hidden-accessible), > .select2-container, > div:not(.widget-title), > p:not(.widget-title), > form').slideToggle(300);
                });
            }
        },

        widgetsOpenCloseDefault: function () {

            if ( $('body').is('.s_widgets-open-close.swc-default') && !$('body').is('.swc-default-done') ) {
                $('.sidebar-widget .widget-title').parent().addClass('et_widget-closed');
                $('.sidebar-widget .widget-title').parent().find('> ul, > select:not(.select2-hidden-accessible), > .select2-container, > div:not(.widget-title), > p:not(.widget-title), > form').hide();
                $('body').addClass('swc-default-done');
            }

            if ( $('body').is('.f_widgets-open-close.fwc-default') && !$('body').is('.fwc-default-done') ) {
                $('.footer-widget > .widget-title').parent().addClass('et_widget-closed');
                $('.footer-widget > .widget-title').parent().find('> ul, > select:not(.select2-hidden-accessible), > .select2-container, > div:not(.widget-title), > p:not(.widget-title), > form').hide();
                $('body').addClass('fwc-default-done');
            }

        },

        toggles: function() {
            // **********************************************************************//
            // ! Toggle elements
            // **********************************************************************//

            var etoggle = $('.toggle-block');
            var etoggleEl = etoggle.find('.toggle-element');

            var plusIcon = '+';
            var minusIcon = '&ndash;';

            //etoggleEl.first().addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').show();

            etoggleEl.click(function(e) {
                e.preventDefault();
                if($(this).hasClass('opened')) {
                    $(this).removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
                }else {
                    if($(this).parent().hasClass('noMultiple')){
                        $(this).parent().find('.toggle-element').removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
                    }
                    $(this).addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').slideDown(200);
                }
            });
        },
        closeParentBtn: function() {
            // **********************************************************************//
            // ! Alerts
            // **********************************************************************//
            var closeParentBtn = $('.close-parent');

            closeParentBtn.click(function(e){
                closeParent(this);
            });

            function closeParent(el) {
                $(el).parent().slideUp(100);
            }
        },

        commentsForm: function() {
            // **********************************************************************//
            // ! Custom Comment Form Validation
            // **********************************************************************//
            var commentForm = $('#commentform');

            commentForm.on('click', '#submit', function(e){
                $('#commentsMsgs').html('');

                commentForm.find('.required-field').each(function(){
                    if($(this).val() == '') {
                        $(this).addClass('validation-failed');
                        e.preventDefault();
                    }
                });

            });
        },
        mobileMenu: function() {
            // **********************************************************************//
            // ! Mobile Menu
            // **********************************************************************//
            $(document).on( 'click', '.navbar-toggle', function(){
                if($('body').hasClass('mobile-menu-opened')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            var navList = $('.mobile-menu-wrapper .menu');
            var opener = '<span class="open-child"></span>';

            navList.find('li:has(ul)',this).each(function() {
                var $this = $(this),
                    backtext,
                    allLink;
                // if ( $this.parents( '.navbar-collapse' ).hasClass( 'fullscreenMenu-collapse' ) ) {
                //     var thisHtml = $this.html();
                //     $this.html('');
                //     $this.prepend( '<div class="inside">' + opener + thisHtml + '</div><!-- .insid -->' );
                // } else {
                $this.prepend(opener);
                // }

                //if( $this.hasClass('item-level-0') ) {
                //    backtext = etConfig.menuBack;
                //} else {
                //    backtext = $this.parents('li').find('> a').text();
                //}
                backtext = etConfig.menuBack;
                allLink = $this.find('> a').clone();
                $this.find('> ul').prepend('<li class="menu-show-all">' + allLink.wrap('<div>').parent().html() + '</li>');
                $this.find('> ul').prepend('<li class="menu-back"><a href="javascript:void(0);">' + backtext + '</a></li>');
            });
            
            navList.on('click', '.open-child, .open-child+a', function(e){
                e.preventDefault();
                if ($(this).parent().hasClass('over')) {
                    $(this).parent().removeClass('over');
                    if($(this).parent().hasClass('item-level-0')) {
                        navList.removeClass('moves-out');
                    }
                }else{
                    $(this).parent().parent().find('>li.over').removeClass('over');
                    $(this).parent().addClass('over');
                    if($(this).parent().hasClass('item-level-0')) {
                        navList.addClass('moves-out');
                    }
                }
            });

            navList.on('click', '.menu-back', function(){
                var $parent = $(this).parent().parent();
                if ($parent.hasClass('over')) {
                    $parent.removeClass('over');
                    if($parent.hasClass('item-level-0')) {
                        navList.removeClass('moves-out');
                    }
                }
            });

            $('.template-content').on('click', function(event) {
                if(!$(event.target).closest('.mobile-menu-wrapper').length && ! $(event.target).closest('.navbar-toggle').length) {
                    if($('body').hasClass('mobile-menu-opened')) {
                        closeMenu();
                    }
                }
            })

            // topSubmenuMargin();

            $( '.mobile-menu-wrapper .open-child' ).on('click touchstart', function(event) {
                setTimeout(function(){ $('.navbar-collapse').animate({scrollTop:0}, 600); }, 500);
            });

            // if ( ! $( '.mobile-menu-wrapper' ).hasClass( 'fullscreenMenu' ) ) {
            //     $( ".mobile-menu-wrapper > .container" ).nanoScroller({
            //         contentClass: 'navbar-collapse'
            //     });
            // } 
            // if ($( '.mobile-menu-wrapper' ).hasClass( 'fullscreenMenu' )) {
            //     $( "#fullscreenMenu > .container.fullscreenMenu-container" ).nanoScroller({
            //         contentClass: 'fullscreenMenu-collapse'
            //     })
            // }

            function openMenu() {
                $('body').removeClass('mobile-menu-closed').addClass('mobile-menu-opened');
                $('.navbar-toggle').addClass('show-nav');
                //$('html, body').animate({scrollTop:0}, 0);
            }

            function closeMenu() {
                $('.navbar-toggle').removeClass('show-nav');
                $('body').removeClass('mobile-menu-opened').addClass('mobile-menu-closed');
            }

            // function topSubmenuMargin() {
            //     var m_top = $('.mobile-menu-wrapper .mobile-menu-header').outerHeight(true);
            //     navList.find(' > li > .sub-menu').css({marginTop: m_top});
            // }

        },
        topPanel: function() {
            // **********************************************************************//
            // ! Top panel
            // **********************************************************************//
            $('.top-panel-open').click(function(){
                if($('body').hasClass('top-panel-opened')) {
                    closePanel();
                } else {
                    openPanel();
                }
            });

            $('.close-panel').click(function() {
                $('.template-content').click();
            });

            function openPanel() {
                $('body').removeClass('top-panel-closed').addClass('top-panel-opened');

                setTimeout(function() {
                    $('.template-content').one('click', function(event) {
                        if($('body').hasClass('top-panel-opened')) {
                            closePanel();
                        }
                    });
                }, 1);
            }

            function closePanel() {
                $('body').removeClass('top-panel-opened').addClass('top-panel-closed');
            }
        },
        menuPosts: function () {
            var widget      = $('.posts-subcategories'),
                nav         = widget.find('.subcategories-tabs'),
                content     = widget.find('.posts-content'),
                ajaxProcess = false,
                activeClass = 'active';

            nav.on('mouseover', 'li', function() {
                if( ajaxProcess || $(this).hasClass(activeClass) ) return;

                ajaxProcess = true;
                widget.addClass('loading-posts');
                nav.find('li').removeClass(activeClass);
                $(this).addClass(activeClass);
                var cat = $(this).data('cat');

                $.ajax( {
                    url: etConfig.ajaxurl,
                    type: 'GET',
                    dataType: 'html',
                    cache   : true,
                    data: { action: 'menu_posts', cat: cat },
                    success: function( data ) {
                        content.html(data);
                    },
                    complete: function() {
                        widget.removeClass('loading-posts');
                        ajaxProcess = false;
                    },
                    error: function() {
                        etTheme.et_notice('menu', 'error');
                    }
                } );
            });
        },

        postLayout: function() {
            var postImage = $('.post-template-large .wp-picture img, .post-template-large2 .wp-picture img, .content-article .post-gallery-slider img, .post-template-large img, .post-template-large2 img').first(),
                postHead = $(".single-post-large");
            if( postImage.length > 0 && postImage.attr('src') ) {
                if ( postImage.attr('data-src') ) {
                    postHead.backstretch(postImage.attr('data-src'));
                } else {
                    postHead.backstretch(postImage.attr('src'));
                }
            }

            $(window).scroll(function(){
                var scrolledY = $(window).scrollTop();
                $(".single-post-large img").css('transform', 'translate3d(0px, ' + scrolledY/1.2 + 'px, 0px)');

            });

            $('.swiper-entry').closest('.blog-post').find('> div').addClass('swiper-class-blog');
        },

        theLook: function() {
            var looks = $('.et-looks'),
                nav = looks.find('.et-looks-nav'),
                content = looks.find('.et-looks-content'),
                openedClass = 'active-look',
                productClass = 'product-ready',
                originalTimeout = 100,
                timeout = 0;

            var recalcul = function() {
                var look = content.find('.' + openedClass ).first();
                if( look.length < 1 ) {
                    look = content.find('.et-look').first();
                }
                var height = look.attr('style','').outerHeight();
                looks.height(height);
            };

            $(window).resize(function() {
                recalcul();
            });

            looks.find('.et-isotope').on('layout-changed', function() {
                recalcul();
            })

            nav.find('li').first().addClass('active');

            nav.on('click', 'a', function(e) {

                e.preventDefault();

                var index = $(this).parent().index(),
                    openLook = content.find('.et-look').eq(index);

                timeout = originalTimeout;

                if(openLook.hasClass(openedClass)) return;

                content.removeClass('has-no-active-item');

                content.find('.' + openedClass).removeClass(openedClass);
                openLook.addClass(openedClass);

                content.find('.' + productClass).removeClass(productClass);
                openLook.find('.et-isotope-item').each(function() {
                    var product = $(this).find('.content-product');
                    setTimeout(function() {
                        product.addClass(productClass);
                    }, timeout);
                    timeout = timeout + originalTimeout;
                });

                nav.find('.active').removeClass('active');
                $(this).parent().addClass('active');

                if ( $( 'body').is( '.etheme_masonry_on' ) ) {
                    etTheme.isotope();
                }

            });
        },

        filtersArea: function() {
            var filters = $('.shop-filters'),
                time = 200;
            $('.open-filters-btn').on('click', 'a', function(e) {
                e.preventDefault();
                if(filters.is(':visible')) {
                    $(this).removeClass('active');
                    filters.slideUp(time);
                } else {
                    $(this).addClass('active');
                    filters.slideDown(time);
                    if ( $( 'body').is( '.etheme_masonry_on' ) ) {
                        $('.shop-filters-area').isotope({
                            itemSelector: '.sidebar-widget',
                            isOriginLeft: ! $('body').hasClass('rtl'),
                            masonry: {
                                columnWidth: '.sidebar-widget'
                            }
                        });
                    }
                }
            });
        },

        stickyProductImages: function() {
            if( $(window).width() < 992 ) return;

            $(window).load(function(){

            var imgHeight = $('.single-product .product-fixed-images .images-wrapper').innerHeight();
            var infHeight = $('.single-product .product-information').innerHeight();

                if ( !$( '.product-images .images .swiper-control-top' ).is( '.gallery-slider-off' ) ) {
             //     $(window).load(function(){

                        var ProductImgsHeight = $('.product-images').outerHeight();

                        $( '.fixed-product-block' ).css({ 
                            'minHeight': ProductImgsHeight - 30
                        });

             //       });       

                } 
            
                if ( imgHeight >= infHeight ) return;

                $('.product-fixed-images .images-wrapper').stick_in_parent({
                    offset_top: 150
                });

                $('.product-fixed-content .product-information-inner').stick_in_parent({
                    offset_top: 150
                });

                $('.fixed-product-block').each(function() {
                    $(this).stick_in_parent({
                        offset_top: 150
                    });
                });

            });
        },

        countdown: function() {
            $('.et-timer').each(function () {
                var countdown = $(this),
                    update = function() {

                        var eventDate = Date.parse(countdown.data('final')) / 1000;
                        var currentDate = Math.floor($.now() / 1000);
                        var startDate = Date.parse(countdown.data('start')) / 1000;
                        if ( startDate > currentDate ) {
                            eventDate = startDate;
                            countdown.find('.timer-info').text('Sale starts in');
                        }
                        else if (currentDate > eventDate) {
                            // countdown.find('.timer-info').text('This sale already finished');
                            countdown.remove();   
                        }
                        else {
                            countdown.find('.timer-info').remove();
                        }
                        var days = countdown.find('.days');
                        var hours = countdown.find('.hours');
                        var minutes = countdown.find('.minutes');
                        var seconds = countdown.find('.seconds');

                        var remindSeconds = eventDate - currentDate;

                        if (remindSeconds > 0) {
                            var remindDays = Math.floor(remindSeconds / (60 * 60 * 24));
                            remindSeconds -= remindDays * 60 * 60 * 24;
                            var remindHours = Math.floor(remindSeconds / (60 * 60));
                            remindSeconds -= remindHours * 60 * 60;
                            var remindMinutes = Math.floor(remindSeconds / (60));
                            remindSeconds -= remindMinutes * 60;

                            updateCircle($('.days').parent().find('circle'), remindDays);
                            updateCircle($('.hours').parent().find('circle'), remindHours);
                            updateCircle($('.minutes').parent().find('circle'), remindMinutes);
                            updateCircle($('.seconds').parent().find('circle'), remindSeconds);

                            if (remindDays < 10) remindDays = '0' + remindDays;
                            if (remindHours < 10) remindHours = '0' + remindHours;
                            if (remindMinutes < 10) remindMinutes = '0' + remindMinutes;
                            if (remindSeconds < 10) remindSeconds = '0' + remindSeconds;

                            if (days < 1 || remindDays == '00') {
                                days.parent().hide().next().hide();
                            } else {
                                days.text(remindDays);
                            }
                            hours.text(remindHours);
                            minutes.text(remindMinutes);
                            seconds.text(remindSeconds);
                        }
                    };
                setInterval(update, 1000);
                update();
            });

            function updateCircle(circle, value){
                var val = parseInt((value/parseInt(circle.data('max-val')))*100, 10);
                var r = parseInt(circle.attr('r'), 10);
                var c = Math.PI*(r*2);
                circle.attr('stroke-dasharray', c);
                var pct = ((val)/100)*c;
                circle.css({ strokeDashoffset: pct});
            }
        },

        // For Compare
        ForCompare: function() {

            // Reinit lazy for new compare
            $(document).on( 'yith_woocompare_render_table', function(){
                etTheme.global_image_lazy();
            });

            $(document).on( 'click', 'a.compare.button', function() {

                $('body').addClass('et-compare');

            });

            $(document).on( 'click', '#cboxOverlay, #cboxClose', function() {

                $('body').removeClass('et-compare');

            });

            $(document).on( 'click', '.et-open', function(e) {
                e.preventDefault();

                var c_name = $(this).attr("class").match(/to_open[\w-]*\b/),
                open_what = c_name[0].split('to_open-')[1];
                // is_opened = $('.'+open_what).is('.opened');
                // if ( is_opened ) {
                    $(this).parent().find('.'+open_what).slideToggle(300);
                // }
                // else {
                //     $(this).parent().find('.'+open_what).fadeToggle(300).toggleClass('opened');
                // }

            });

        },

        tooltips: function() {

            var $tooltipHTML = $('<span class="et-tooltip"></span>'),
                $product = $('.single-product'),
                $compare = $product.find('.compare'),
                $wishlist = $product.find('.add_to_wishlist');


            // $compare.prepend($tooltipHTML.html($compare.text()));
            // $wishlist.prepend($tooltipHTML.clone().text($wishlist.text()));

        },

        // vcRTLRows: function() {
        //     if( ! $('body').hasClass('rtl') ) return;
        //     $(document).on("vc-full-width-row", function(event, el) {
        //         var $elements = $('[data-vc-full-width="true"]');
        //         $elements.each(function() {
        //             var $el = $(this);
        //             var left = parseInt($el.css("left"), 10);
        //             $el.css({
        //                 left: -left
        //             });
        //         });
        //     })
        // },

        // **********************************************************************//
        // ! Jump to first slide for variable product
        // **********************************************************************//
        jumpToSlide: function() {

            $(document).on( 'found_variation' ,'form.variations_form', function( evt, variation ) {

                if ( $( '.main-slider-on' ).hasClass( 'gallery-slider-on' ) ) {
                    if ($('.images-wrapper').hasClass('swiper-vertical-images')) {
                        $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).attr( 'src', variation.image.thumb_src );
                        var parent = $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).parent();

                        if ( ! parent.attr( 'data-o_large') ) {
                            parent.attr( 'data-o_large', parent.attr('data-large') );
                        }

                        parent.attr( 'data-large', variation.image.full_src );

                        if (variation.image.srcset) {
                            $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).attr( 'srcset', variation.image.thumb_src );
                        } else {
                            $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).attr( 'srcset', variation.image.thumb_src );
                        }

                    } else {
                        var parent = $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).parent();

                        if ( ! parent.attr( 'data-o_large') ) {
                            parent.attr( 'data-o_large', parent.attr('data-large') );
                        }

                        parent.attr( 'data-large', variation.image.full_src );

                        $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'src', variation.image.thumb_src );
                        if (variation.image.srcset) {
                            $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'srcset', variation.image.thumb_src );
                        } else {
                            $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'srcset', variation.image.thumb_src );
                        }
                    }
                }
            });

            $(document).on( 'reset_image', 'form.variations_form', function( evt ) {
                if ( $( '.main-slider-on' ).hasClass( 'gallery-slider-on' ) ) {

                    if ($('.images-wrapper').hasClass('swiper-vertical-images')) {
                        var parent = $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).parent();
                        parent.attr( 'data-large', parent.attr('data-o_large') );

                        var thumbnail_default = $( '.main-images .swiper-slide.swiper-slide-active .woocommerce-product-gallery__image' ).data( 'thumb' );
                        $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).attr( 'src', thumbnail_default );
                        $( '.slick-slider.thumbnails-list .slick-slide.slick-current img' ).attr( 'srcset', thumbnail_default );
                    }
                    else {
                        var parent = $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).parent();
                        parent.attr( 'data-large', parent.attr('data-o_large') );

                        var thumbnail_default = $( '.main-images .swiper-slide.swiper-slide-active .woocommerce-product-gallery__image' ).data( 'thumb' );
                        $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'src', thumbnail_default );
                        $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'srcset', thumbnail_default );
                    }
                }
            });

            $(document).on( 'click', '.swiper-wrapper.thumbnails-list .swiper-slide img', function (e) {
                e.preventDefault();
            });
        },

        // **********************************************************************//
        // ! ScrollMenu
        // **********************************************************************//
        scrollMenu: function(){
            var scrollMenuInside = jQuery('.header-vertical .item-design-mega-menu > .nav-sublist-dropdown > .container, .header-vertical2 .item-design-mega-menu > .nav-sublist-dropdown > .container');

            scrollMenuInside.each(function() {
                var $this = jQuery(this);
                var innerContent = $this.find('> ul');

                $this.on('mousemove', function(e) {
                    var parentOffset = $this.offset();

                    var relY = e.pageY - parentOffset.top;

                    var deltaHeight = innerContent.outerHeight() - $this.height();

                    if( deltaHeight < 0 ) return;

                    var percentY = relY / $this.height();

                    var margin = 0;

                    if( percentY <= 0 ) {
                        margin = 0;
                    } else if( percentY >= 1 ) {
                        margin = - deltaHeight;
                    } else {
                        margin = - percentY * deltaHeight;
                    }

                    margin = parseInt(margin);

                    innerContent.css({
                        'position': 'relative',
                        'top': margin
                    });
                });
            });
        },
        customCss: function () {
            var shortcodeCss = $('.etheme-css');
            if( shortcodeCss.length > 0 ){
                var css='';
                shortcodeCss.each( function(i, e){
                    var $e = $(e), data = $e.data('css');
                    if(data){
                        css += data;
                        $e.attr('data-css','');
                    }
                });
                $('head').append('<style>'+css+'</style>');
            }
        },

        customCssOne: function () {
            var products_row = $('.products-with-custom-template');
            if ( products_row.length > 0 ) {
                products_row.each( function () {
                    var parent = $(this).attr('data-post-id');
                    var shortcodeCss = $(this).find('.etheme-css-one');
                    if( shortcodeCss.length > 0 ){
                        var css='';
                        var elements = [];
                        shortcodeCss.each( function(i, e){
                            if ( $.inArray($(e).attr('class'), elements ) < 0) {
                                var $e = $(e), data = $e.data('css');
                                if(data){
                                    var el_css = data.split('}');
                                    for (var i = 0; i < el_css.length -1; i++) {
                                        css +='.products-template-'+parent+' ';
                                        css += el_css[i] + '}';
                                    };
                                    elements.push($e.attr('class'));
                                }
                            }
                        });
                        $('head').append('<style>'+css+'</style>');
                    }
                    shortcodeCss.attr('data-css', '');
                });
               
            }
        },


        // **********************************************************************//
        // ! PostProductAjaxLoad
        // **********************************************************************//        
        PostProductAjaxLoad: function() {
            // ! Loading for blog VC elements pagination
            $( 'body' ).on( 'click', '.et-blog .etheme-pagination a', function(e){
                e.preventDefault();
                var $this      =  $(this),
                    url_string = $(this).attr('href'),
                    url        = new URL(url_string),
                    paged      = url.searchParams.get("et-paged"),
                    data       = $this.parents( '.et-blog' ).find('.et-load-blog .et-element-args').text(),
                    element    = $this.parents( '.et-blog' ).find('.et-load-blog .et-element-args').attr('data-element'),
                    args       = JSON.parse( data ),
                    top_offset = $this.parents( '.et-blog' ).offset().top;

                if ( $(document).find('.fixed-header').length ) {
                    top_offset -= $(document).find('.fixed-header').outerHeight(true);
                }

                $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'et_ajax_blog_element',
                        'args': args,
                        'element': element,
                        'paged' :  paged,
                    },
                    dataType: 'html',
                    success: function(respond) {

                        $this.parents( '.et-blog' ).html(respond);
                        
                    },
                    complete: function() {
                        $('html, body').animate({
                            scrollTop: top_offset
                        }, 1000);
                        etTheme.global_image_lazy();
                    },
                    error: function(data) {
                        etTheme.et_notice('post-product', 'error');
                    },
                });
            });


            // ! Loading for post button
            $( 'body' ).on( 'click', '.et_load-posts a', function(e){
                e.preventDefault();

                if ( $(this).is( '.loading' ) ) return;

                $(this).addClass( 'loading' );

                var url = $(this).attr( 'href' );

                if( $(this).length > 0 ) {
                    et_load_posts( url );
                }
            });

            // ! Loading for product button
            $( 'body' ).on( 'click', '.et_load-products a', function(e){
                e.preventDefault();
                load_products($(this));
            });

            // ! Lazy(scroll) loading for post/products
            // if ( $('.et_load-products').is( '.lazy-loading' ) ) {
            //     var load_btn = $('.et_load-products');
            //     loading_by_scroll(load_btn);
            // } else if( $('.et_load-posts').is( '.lazy-loading' ) ){
            //     var load_btn = $('.et_load-posts');
            //     loading_by_scroll(load_btn);
            // };
            $('.lazy-loading').each(function() {
                if ( $(this).is('.et_load-products') ) {
                    var load_btn = $(this);;
                    loading_by_scroll(load_btn);
                } else if ($(this).is('.et_load-posts') ) {
                    var load_btn = $(this);
                    loading_by_scroll(load_btn);
                }
            });


            function loading_by_scroll(load_btn){
                $(window).scroll(function(){
                    if ( load_btn.length < 1 ) return;

                    if ( load_btn.parents().hasClass( 'vc_tta-panel' ) && ! load_btn.parents( '.vc_tta-panel' ).hasClass( 'vc_active' ) ) {
                        return;
                    }

                    var btn_top = load_btn.offset().top;
                    var btn_height = load_btn.outerHeight();
                    var window_height = $(window).height();
                    var window_scroll = $(this).scrollTop();

                    if ( window_scroll < ( btn_top + btn_height - window_height ) ) return;
                    if ( ! load_btn ) return;
                    if ( load_btn.is( '.loading' ) ) return;

                    load_btn.addClass( 'loading' );

                    if ( load_btn.is( '.et_load-posts' ) ) {
                        var url = load_btn.find( 'a' ).attr( 'href' );
                        et_load_posts( url );
                    } else {
                        load_products(load_btn.find( 'a' ));
                    }
                });
            }

            function load_products(btn){
                var parent = btn.parents( '.etheme_products' );
                var paged = btn.attr( 'paged' );
                var max_paged = btn.attr( 'max-paged' );

                //btn.addClass( 'hidden' );
                //parent.find( '.et-loader' ).removeClass( 'hidden' );
                parent.find('.et-load-block').addClass( 'loading' );
                paged = parseInt(paged);

                if ( paged >= max_paged ) return;

                paged = paged + 1;

                var attr = {
                    'paged' : paged,
                    'per-page' : parent.attr( 'per-page' ),
                    'columns' : parent.attr( 'columns' ),
                    'ids' : parent.attr( 'ids' ),
                    'orderby' : parent.attr( 'orderby' ),
                    'order' : parent.attr( 'order' ),
                    'stock' : parent.attr( 'stock' ),
                    'type' : parent.attr( 'type' ),
                    'taxonomies' : parent.attr( 'taxonomies' ),
                    'product_view' : parent.attr( 'product_view' ),
                    // 'custom_template' : parent.attr( 'custom_template' ),
                    'product_view_color' : parent.attr( 'product_view_color' ),
                    'hover' : parent.attr( 'hover' ),
                    'show_counter' : parent.attr( 'show_counter' ),
                    'show_stock' : parent.attr( 'show_stock' )
                };

                var next = parseInt( parent.find( '.product' ).length ) + parseInt( parent.attr( 'per-page' ) );

                if ( btn.attr( 'limit' ) && next >= btn.attr( 'limit' ) ) {
                    attr['limit'] = parseInt( parent.attr( 'per-page' ) ) - ( next - btn.attr( 'limit' ) );
                }

                $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'etheme_ajax_products',
                        'attr': attr,
                        'context': 'frontend'
                    },
                    dataType: 'html',
                    success: function(respond) {
                        var p_loop = btn.parents( '.etheme_products' ).find( '.products-loop' );
                        if ( p_loop.is('.with-ajax') ) {
                            p_loop = p_loop.find('.ajax-content');
                        }
                        p_loop.append(respond);
                        setTimeout(function(){
                            p_loop.find('.productAnimated').addClass('product-faded').removeClass('product-fade');
                        },300);  // 300 is compatible with transition in css
                        if ( $( 'body' ).hasClass( 'et-enable-swatch' ) ) {
                            ST_WC_FRONT_SWATCH.productLoop.itemSwatches();
                        }
                        etTheme.contentProdImages();
                        etTheme.countdown(); // refresh product timers
                    },
                    error: function(data) {
                        etTheme.et_notice('products', 'error');
                    },
                    complete: function() {
                        btn.attr( 'paged', paged );
                        if ( paged >= max_paged || ( btn.attr( 'limit' ) && next >= btn.attr( 'limit' ) ) ){
                            parent.find('.et_load-products').remove();
                        } else {
                            parent.find('.et-load-block').removeClass( 'loading' ).addClass( 'loaded' );
                        }
                        etTheme.isotope();
                    }
                });
            }
                                            
            function et_load_posts( url ){
                // ! Page elements
                var load_posts = $( '.et_blog-ajax' );
                var load_btn = $( '.et_load-posts' );
                var loader = load_btn.find( '.slide-loader' );

                if ( load_btn.find( 'a' ).length < 1 ) return;

                load_btn.removeClass( 'loaded' ).addClass( 'loading' );
                loader.css( 'opacity', '1' );

                $.ajax({
                    url: url,
                    method: 'GET',
                    timeout: 10000,
                    dataType: 'text',
                    success: function(respond) {
                        // ! Respond elements
                        ///console.log(respond);
                        var respond_load_btn =  $( respond ).find( '.et_load-posts' );
                        var respond_posts = $( respond ).find( '.et_blog-ajax' ).html();

                        // ! Add articles to page content
                        if ( load_posts.is( '.blog-masonry' ) ) {
                            load_posts.isotope( 'insert', $( respond_posts ) );
                        } else {
                            // ! Change article class
                            respond_posts = respond_posts.replace( /article class="/g, 'article class="loading ' );
                            load_posts.append(  respond_posts );
                        }

                        // ! Add more post btn
                        if ( $( respond ).find( '.et_load-posts a' ).length < 1 ){
                            load_btn.html( '<p>' + load_btn.attr('data-loaded') + '</p>' );
                            load_btn.addClass( 'all-loaded' );
                        } else {
                            load_btn.html( respond_load_btn.html() );
                        };

                        load_btn.removeClass( 'loading' ).addClass( 'loaded' );
                    },
                    error: function(data) {
                        etTheme.et_notice('posts', 'error');
                    },
                    complete: function() {
                        load_btn.removeClass('loading');
                        setTimeout(function(){ 
                            $( 'article.loading' ).removeClass( 'loading' ).addClass( 'loaded' );
                            $(window).resize();
                            etTheme.resizeVideo();
                            etTheme.swiperFunc();
                            if ( load_posts.is( '.blog-masonry' ) ) {

                                if ( load_posts.find('.post-grid').length < 1 ) return; 

                                load_posts.each(function() {

                                    var $grid = $(this).isotope({
                                        isOriginLeft: ! $('body').hasClass('rtl'),
                                        itemSelector: '.post-grid'
                                    });

                                    $grid.imagesLoaded().progress( function() {
                                        $grid.isotope('layout');
                                    });

                                });
                            };
                            loader.css( 'opacity', '0' );
                            etTheme.global_image_lazy();
                        }, 300);
                    }
                });
            }
        },

        // **********************************************************************//
        // ! Shortcodes/VC elements ajax loading
        // **********************************************************************//  
        AjaxElement: function(){
            $.each( $( '.et-ajax-element' ), function(){
                loading_by_scroll( $(this) );
            });

            function loading_by_scroll(load_btn){
                $(window).scroll(function(){
                    if ( load_btn.length < 1 ) return;

                    var btn_top = load_btn.offset().top;
                    var btn_height = load_btn.outerHeight();
                    var window_height = $(window).height();
                    var window_scroll = $(this).scrollTop();

                    if ( window_scroll < ( btn_top + btn_height - window_height ) ) return;
                    if ( ! load_btn ) return;
                    if ( load_btn.is( '.loading' ) ) return;

                    load_btn.addClass( 'loading' );

                    load_element(load_btn);
                });
            }

            function load_element(element){
                var shortcode = element.attr( 'element' );
                var attr  = element.find( 'span.et-element-args' ).text();
                var content = element.find( 'span.et-element-content' ).html();
                var args  = JSON.parse( attr );
                var extra = element.attr( 'extra' );

                $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'et_ajax_element',
                        'args': args,
                        'element': shortcode,
                        'content' : content,
                        'archiveVariationGallery' : etConfig.archiveVariationGallery
                    },
                    dataType: 'html',
                    success: function(response) {
                        $( element ).after( response );
                        if ( extra == 'slider' ) {
                            etTheme.swiperFunc();
                        }
                        etTheme.contentProdImages();
                        etTheme.countdown(); // refresh product timers
                    },
                    error: function(data) {
                        etTheme.et_notice('element', 'error');
                    },
                    complete: function() {
                        $( element ).remove();
                        etTheme.global_image_lazy();
                    }
                });
            }
        },

        /* Navigation smart */
        navMenuSmart: function () {
            if ($('body').hasClass('global-header-vertical') || $('body').hasClass('global-header-vertical2') || $('body').hasClass('global-header-hamburger-icon')) {
                return;
            }
            if (window.innerWidth > 991 && ($('body').hasClass('header-smart-responsive')) ) {
                $('.menu-wrapper > .menu-main-container .menu').append('<li class="more menu-more item-design-dropdown"><div class="menu-more-toggle"><span></span></div><div class="nav-sublist-dropdown"><div class="container"><ul></ul></div></div></li>');
                $('.header-wrapper').addClass('header-resizing');
                $(document).on('click', '.menu-more', function(){
                    if ($(this).hasClass('opened')) {
                        $(this).removeClass('opened');
                    }
                    else {
                        $(this).addClass('opened');
                    }
                });
                function calcWidth() {
                    if (window.innerWidth < 993) return;
                    // Prefix '_f' for fixed headers 
                    var fixed_check = false,
                        double_header = false,
                        secondaryMenu = false,
                        items_f,
                        availablespace_h;

                    var menu_wrapper = $('.header-wrapper .menu-wrapper');

                    var each_item_of = $(menu_wrapper).find(' .menu > .menu-item');
                    if ($('body').hasClass('et-fixed-disable') !== true ) {
                        var fixed_check = true;
                        each_item_of = $('.header-wrapper .menu-wrapper .menu > .menu-item, .fixed-header .menu-wrapper .menu > .menu-item');
                    }

                    if ( $('body').hasClass('et-secondary-menu-on') ) {
                        secondaryMenu = true;
                    }

                    $(each_item_of).each(function() {
                        $(this).attr('data-width', $(this).outerWidth(true));
                    }); 

                    var morewidth_f = $('.fixed-header .menu-wrapper .menu .more').outerWidth(true); 
                    var morewidth = $(menu_wrapper).find(' .menu .more').outerWidth(true);
                    var extra_space = morewidth,
                    extra_space_f = morewidth_f;

                    // Save the origin size of toggle into the attribute just one time
                    $(document).one('ready', function (){
                        $('.header-wrapper .menu-main-container .menu .more').attr('data-width', morewidth);
                        if (fixed_check) {
                            $('.fixed-header .menu-main-container .menu .more').attr('data-width', morewidth_f);
                        }
                    });

                    //var availablespace = $('nav').outerWidth(true) - morewidth;
                    var extra_space = $(menu_wrapper).find(' .menu .more').attr('data-width');
                    var extra_space_f = $('.fixed-header .menu-main-container .menu .more').attr('data-width');
                    var availablespace_h = $('.header-wrapper .menu-wrapper > .menu-main-container').outerWidth(true) - extra_space*1.5;

                    if ($('body').hasClass('global-header-xstore')) {
                        availablespace_h = availablespace_h - extra_space/2; // only for these header types 
                    }

                    else if ($('body').hasClass('global-header-double-menu')) {

                        double_header = true;
                        availablespace_h = [];
                        var i = 0;
                        $(menu_wrapper).each( function() {
                            availablespace_h.push($(this).outerWidth(true) - extra_space*1.5 );
                            i+=1;
                        });

                        var children_width = 0;
                        $('.menu-wrapper:eq('+i+')').next('.navbar-header').children().each(function(){
                            children_width +=  $(this).outerWidth(true);
                        });

                        availablespace_h[availablespace_h.length-1] = $('.menu-wrapper:eq('+i+')').outerWidth(true) - Math.ceil(children_width) - extra_space*1.5;

                    }

                    else if ( $('body').hasClass('global-header-advanced') && secondaryMenu ) {
                        availablespace_h = $('.header-wrapper .menu-inner').outerWidth(true) - $(menu_wrapper).prevAll().outerWidth(true) - extra_space*2;
                    }
                    else if ( ($('body').hasClass('global-header-center3') || $('body').hasClass('global-header-standard')) && secondaryMenu ) {
                        availablespace_h = $('.header-wrapper .menu-inner').outerWidth(true) - $(menu_wrapper).find('> .menu-main-container').prevAll().outerWidth(true) - $(menu_wrapper).nextAll().outerWidth(true) - extra_space*2;
                    }
                    else if ($('body').hasClass('global-header-center3') || $('body').hasClass('global-header-standard') || $('body').hasClass('global-header-advanced')) {
                        availablespace_h = $('.header-wrapper .menu-inner').outerWidth(true) - $(menu_wrapper).nextAll().outerWidth(true) - extra_space*2;
                    }

                    if (availablespace_h < 0) {return;}

                    /* check the length of all items */
                    function et_checking_h () {
                        var navwidth = 0;

                        if (double_header) {

                            var i = 0;
                            var array = [];

                            // For multiple menu in header let's count the width of each one 
                            $(menu_wrapper).each( function() {
                                var navwidth = 0;
                                $(this).find('.menu > .menu-item').each( function() {
                                    navwidth += $(this).data('width'); 
                                });
                                array.push(navwidth);
                                i += 1;
                            });
                            navwidth = array;

                        }

                        else {
                            $(menu_wrapper).find('> .menu-main-container .menu > .menu-item').each( function (){
                                navwidth += $(this).data('width'); 
                            });;
                        }
                        return navwidth;
                    }
                    /* remove item and place in submenu if their width is more than available*/
                    function et_removing_h () {
                        var navwidth = et_checking_h();
                        // if ( navwidth < 0 ) { return; }

                        if ($.isArray(navwidth)) {
                            var i = 0; // for array 
                            var j = 1; // for menu number 
                            $($(menu_wrapper)).each( function() {

                                // Remove items in each menu of header and add on resize if there is enought space 
                                function et_multiple_removing () {
                                    navwidth = et_checking_h();
                                    if ( navwidth[i] > availablespace_h[i] || navwidth[i] == availablespace_h[i]) {
                                            var lastitem = $( '.menu-wrapper:eq('+(j)+') > .menu-main-container .menu > .menu-item').last();
                                            lastitem.prependTo( $('.menu-wrapper:eq('+(j)+') > .menu-main-container .menu .more ul').first());
                                            et_multiple_removing();
                                        }

                                    else {
                                        var firstItem = $('.menu-wrapper:eq('+(j)+') > .menu-main-container .menu .more ul').first().find('.menu-item').first();
                                        var firstItemWidth = firstItem.data('width');
                                        if ( (navwidth[i] + firstItemWidth ) < availablespace_h[i] ) {
                                            firstItem.insertBefore($('.menu-wrapper:eq('+(j)+') > .menu-main-container .menu .more'));
                                        }
                                    }
                                }
                                et_multiple_removing();
                                i += 1;
                                j += 1;
                            });
                        }
                        else {
                            if ( navwidth > availablespace_h || navwidth == availablespace_h) {
                                var lastitem = $(menu_wrapper).find('.menu > .menu-item').last();
                                lastitem.prependTo($(menu_wrapper).find('.menu .more ul').first());
                                et_removing_h();
                            }
                            else {
                                var firstItem = $(menu_wrapper).find('.menu .more ul').first().find('.menu-item').first();
                                var firstItemWidth = firstItem.data('width');
                                if ( (navwidth + firstItemWidth ) < availablespace_h ) {
                                    firstItem.insertBefore($('.header-wrapper .menu .more'));
                                }
                            }
                        }
                    }
                    et_removing_h();
                    if ( fixed_check ) {
                        var availablespace_f = $('.fixed-header .menu-wrapper > .menu-main-container').outerWidth(true) - extra_space_f*2; // extra space ( morewidth_f * 2), because sometimes there is enought space but toggle jumps down ( because of padd )
                        if (double_header) {
                            var availablespace_f = $('.fixed-header .menu-wrapper').outerWidth(true) - extra_space_f*2;
                            var toggle_check = $('.fixed-header').find('.menu-main-container:eq(1)').find('.more ul .menu-item').length;
                            availablespace_f = availablespace_f - extra_space_f/2;
                            if ( toggle_check < 0 || toggle_check == 0 ) {
                                $('.fixed-header').find('.menu-main-container:eq(1)').find('.more').remove();
                            }
                        }
                        function et_checking_f () {
                            var navwidth = 0;
                                $('.fixed-header .menu-wrapper > .menu-main-container .menu > .menu-item').each( function (){
                                    navwidth += $(this).outerWidth(true); 
                                });
                                return navwidth;
                        }
                        function et_removing_f () {
                            var navwidth = et_checking_f();
                            if ( navwidth < 0 ) { return; } 
                            if ( navwidth > availablespace_f || navwidth == availablespace_f ) {
                                var lastitem = $('.fixed-header .menu-wrapper .menu > .menu-item').last();
                                lastitem.prependTo($('.fixed-header .menu-wrapper .menu .more ul').first());
                                et_removing_f();
                            }
                            else {
                                var firstItem = $('.fixed-header .menu-wrapper .menu .more ul').first().find('.menu-item').first();
                                var firstItemWidth = firstItem.data('width');
                                if ( (navwidth + firstItemWidth ) < availablespace_f ) {
                                    firstItem.insertBefore($('.fixed-header .menu .more'));
                                }
                            }
                        }
                        et_removing_f();
                        
                        header_toggle('.fixed-header .menu-wrapper .menu .more');
                    }

                    // header_toggle - remove or show more toggle  

                    function header_toggle (header) {
                        if ($( header ).find('ul .menu-item').length > 0) {
                            if ($( header ).hasClass('hidden')) {
                                $( header ).removeClass('hidden');
                            }
                        }
                        else {
                            if ($( header ).hasClass('hidden') === false) {
                                $( header ).addClass('hidden');
                            }
                        }
                    }

                    // if double header let's check each menu for overcount items in it 

                    if (double_header) {
                        var i = 0;
                        $.each($(menu_wrapper), function() {
                            header_toggle($('.header-wrapper .menu-wrapper:eq('+i+')').find('.menu .more'));
                            i += 1;
                        });
                    }
                    else {
                        header_toggle('.header-wrapper .menu-wrapper .menu .more');
                    }
                } // end calcWidth
                $(window).on('load resize', function(){
                    var header_wrap = $('.header-wrapper');
                    var s_height = $(header_wrap).height();
                    if ( header_wrap.hasClass('header-resizing') ) {
                        if ( header_wrap.attr('data-height') ) {
                            calcWidth();
                            var e_height = header_wrap.height();
                            header_wrap.css('height', header_wrap.attr('data-height'));
                            // if ( header_wrap.attr('data-end-height') ) {
                                // header_wrap.animate({
                                //     height: header_wrap.attr('data-end-height')
                                // }, 300); 
                                // header_wrap.removeAttr('data-height').removeAttr('data-end-height');
                                // setTimeout(function(){
                                //     header_wrap.removeClass('header-resizing').attr('style', '');
                                // }, 1500);
                            // }
                            // else {
                                // header_wrap.attr('data-end-height', e_height);
                                header_wrap.animate({
                                    height: e_height
                                }, 300); 
                                header_wrap.removeAttr('data-height');
                                setTimeout(function(){
                                    header_wrap.removeClass('header-resizing').attr('style', '').addClass('header-resized');
                                }, 1500);
                            // }
                        }
                        else {
                            header_wrap.attr('data-height', s_height);
                            calcWidth();
                        }
                    }
                    else {
                        calcWidth();
                    }
                    
                });
            } // end check for window width 
        },

        /**
         * Get notice
         *
         * @version 1.0.0
         * @since 6.2.4
         *
         * @param  {string} $key - notice key
         * @return {string}      - notice text
         */
        et_get_notice: function(key){
            var notices = etConfig.notices;
            return notices[key];
        },// End of et_get_notice

        /**
         * Show notice
         *
         * @version 1.0.0
         * @since 6.2.4
         *
         * @param  {string} $key  - notice key
         * @param  {string} $type - how to show notice
         * @param  {string} $text - extra tex for notice
         */
        et_notice: function(key, type, text){
            if ( ! text ) {
                text = '';
            }
            var notice = etTheme.et_get_notice(key);
            switch (type) {
                case 'error':
                    console.error(notice + text);
                    break;
                case 'warning':
                    console.warn(notice + text);
                    break;
                case 'log':
                    console.log(notice + text);
                    break;
                case 'alert':
                    alert(notice + text);
                    break;
                default:
                    console.log(notice + text);
            }
        },// End of et_notice


        /**
         * Global image lazy
         *
         * @version 1.0.0
         * @since 6.2.4
         */
        global_image_lazy: function(){
            // alert('global image');
            $.each( $(document).find( '.lazyload:not(.swiper-lazy, .zoomImg)' ), function( e ) {
                var img    = $(this),
                    src    = img.attr( 'data-src' ),
                    srcset = img.attr( 'data-srcset' );

                    if ( img.attr('data-l-src') ) {
                        src = img.attr('data-l-src');
                    }

                if ( img.attr('data-lazy_timeout') ) {
                    setTimeout(function() {
                        img.attr( { 'src': src, 'srcset': srcset } ).removeAttr( 'data-src data-srcset' ).removeClass( 'lazyload' ).addClass('lazyloaded');
                    }, img.attr('data-lazy_timeout'));
                } else {
                    // img.attr( { 'src': src, 'srcset': srcset } ).removeAttr( 'data-src data-srcset' ).removeClass( 'lazyload' ).addClass('lazyloaded');
                    if ( img.parents('.wpb_content_element').hasClass('wpb_images_carousel') ) {
                        img.attr( { 'src': src } ).removeClass( 'lazyload' ).addClass('lazyloaded');
                    } else {
                        img.attr( { 'src': src, 'srcset': srcset } ).removeClass( 'lazyload' ).addClass('lazyloaded');
                    }
                }
            });
        },// End of global_image_lazy


        /**
         * After cart refreshed
         *
         * @version 1.0.1
         * @since 6.2.4
         */
        after_cart_refreshed : function(){
            $( document.body ).on( 'wc_fragments_loaded wc_fragments_refreshed added_to_cart removed_from_cart', function() {
               etTheme.global_image_lazy();
            });
        },
    };

    $(document).ready(function(){
        etTheme.init();
    });

})(jQuery);