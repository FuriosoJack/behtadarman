var to_install = [],
	errors     = [];


jQuery(document).ready(function($){

	/* Promo banner in admin panel */
	
	jQuery('.et-extra-message .close-btn').click(function(){
		
		var confirmIt = confirm('Are you sure?');
		
		if(!confirmIt) return;
		
		var widgetBlock = jQuery(this).parent();
	
		var data =  {
			'action':'et_close_extra_notice',
			'close': widgetBlock.attr('data-etag')
		};
		
		widgetBlock.hide();
		
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function(response){
				widgetBlock.remove();
			},
			error: function(data) {
				alert('Error while deleting');
				widgetBlock.show();
			}
		});
	});
	
	/* UNLIMITED SIDEBARS */
	
	var delSidebar = '<div class="delete-sidebar">delete</div>';
	
	jQuery('.sidebar-etheme_custom_sidebar').find('.handlediv').before(delSidebar);
	
	jQuery('.delete-sidebar').click(function(){
		
		var confirmIt = confirm('Are you sure?');
		
		if(!confirmIt) return;
		
		var widgetBlock = jQuery(this).closest('.sidebar-etheme_custom_sidebar');
	
		var data =  {
			'action':'etheme_delete_sidebar',
			'etheme_sidebar_name': jQuery(this).parent().find('h2').text()
		};
		
		widgetBlock.hide();
		
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function(response){
				console.log(response);
				widgetBlock.remove();
			},
			error: function(data) {
				alert('Error while deleting sidebar');
				widgetBlock.show();
			}
		});
	});

	
	/* end sidebars */
    
	    // ! New wp.media for widgets
		jQuery(document).ready(function ($) {
			$(document).on("click", ".etheme_upload-image", function (e) {
				e.preventDefault();
				var $button = $(this);
		 
		      	// Create the media frame.
				var file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select or upload image',
					library: { // remove these to show all
				    	type: 'image' // specific mime
					},
					button: {
				    	text: 'Select'
					},
					multiple: false  // Set to true to allow multiple files to be selected
				});
		 
		      	// When an image is selected, run a callback.
			  	file_frame.on('select', function () {
					// We set multiple to false so only get one image from the uploader
					var attachment = file_frame.state().get('selection').first().toJSON();
					var parent = $button.parents( '.media-widget-control' );
					var thumb = '<img class="attachment-thumb" src="' + attachment.url + '">';

					parent.find( '.placeholder.etheme_upload-image' ).addClass( 'hidden' );
					parent.find( '.attachment-thumb' ).remove();
					parent.find( '.etheme_media-image' ).prepend( thumb );
					parent.find( 'input.widefat' ).attr( 'value', attachment.url );
					parent.find( 'input.widefat' ).change();	 
			  	});
		 
				// Finally, open the modal
				file_frame.open();
			});
		});

    $(document).ready(function(){
		setTimeout(function() {
			$('.et-tab-label.vc_tta-section-append').removeClass('vc_tta-section-append').addClass('et-tab-append');
		}, 1000);
	});

	$(document).on('click', '#et_tabs', function(event) {
		setTimeout(function() {
			$('.et-tab-label.vc_tta-section-append').removeClass('vc_tta-section-append').addClass('et-tab-append');
		}, 1000);
	});

    $(document).on('click', '.et-tab-label.et-tab-append', function(event) {
    	if( typeof vc == 'undefined' ) return;

        var newTabTitle = 'Tab', 
        	params, 
        	shortcode,
        	modelId = $(this).parents('.wpb_et_tabs').data('model-id'),
        	prepend = false;

        params = {
            shortcode: "et_tab",
            params: {
                title: newTabTitle
            },
            parent_id: modelId,
            order: _.isBoolean(prepend) && prepend ? vc.add_element_block_view.getFirstPositionIndex() : vc.shortcodes.getNextOrder(),
            prepend: prepend
        }

        shortcode = vc.shortcodes.create(params);

    });

    $('.et-button:not(.no-loader)').on('click', function() {
        $(this).addClass('loading');
    });

	// **********************************************************************//
	// ! Theme deactivating action
	// **********************************************************************//

	$( '.et_theme-deactivator' ).on( 'click', function(event) {
		event.preventDefault();

		var confirmIt = confirm( 'Are you sure that you want to deactivate theme on this domain?' );
		if( ! confirmIt ) return;

		var data =  {
			'action':'etheme_deactivate_theme',
		};

		var redirect = window.location.href;

		jQuery.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: ajaxurl,
			data: data,
			success: function(data){
				console.log(data);
				var out = ''
				if ( data == 'deleted' ) {
					redirect = redirect.replace( '_options&tab=1', 'xstore_activation_page' );
					redirect = redirect.replace( '_options', 'xstore_activation_page' );
					window.location.href=redirect;
				} else {
					$.each( data, function( e, t ){
						$( '#redux-header' ).prepend( '<span class="et_deactivate-error">' + t + '</span>' );
					});
				}
			},
			error: function(data) {
				alert( 'Error while deactivating' );
			},
		});
	});

	// ! Set major-update message
	if (  $( '.et_major-version' ).length > 0 && $( 'body' ).is( '.themes-php' ) ) {
		$.each( $( '.themes .theme' ), function( i, t ) {
			if ( $(this).data( 'slug' ) == 'xstore'){
				$(this).find( '.update-message' ).append( '<p class="et_major-update">' + $( '.et_major-version' ).data( 'message' ) + '</p>' );
			}
		});

		// ! show it for multisites
		$.each( $( '.plugin-update-tr.active' ), function( i, t ) {
			if ( $(this).is( '#xstore-update' ) ){
				$(this).find( '.update-message' ).append( '<p class="et_major-update">' + $( '.et_major-version' ).data( 'message' ) + '</p>' );
			}
		});

	};

	// Functions for updating et_content in menu item 

	function et_update_item () {

		var items = $("ul#menu-to-edit li.menu-item");
		// Go through all items and display link & thumb
		for ( var i = 0; i < items.length; i++ ) {
			var id = $(items[i]).children("#nmi_item_id").val();

			var sibling   = $("#edit-menu-item-attr-title-"+id).parent().parent();
			var image_div = $("li#menu-item-"+id+" .nmi-current-image");
			var link_div  = $("li#menu-item-"+id+" .nmi-upload-link");
			var other_fields  = $("li#menu-item-"+id+" .nmi-other-fields");

			if ( image_div ) {
				sibling.after( image_div );
				image_div.show();
			}
			if ( link_div ) {
				sibling.after( link_div );
				link_div.show();
			}
			if ( other_fields ) {
				sibling.after( other_fields );
				other_fields.show();
			}

		}

		// Save item ID on click on a link
		$(".nmi-upload-link").click( function() {
			window.clicked_item_id = $(this).parent().parent().children("#nmi_item_id").val();
		} );

		// Display alert when not added as featured
		window.send_to_editor = function( html ) {
			alert(nmi_vars.alert);
			tb_remove();
		};
	}

	function ajax_update_item_content () {
		$.ajax({
		    url: window.location.href, 
		    success: function() {
		    	if ( $('.add-to-menu .spinner').hasClass('is-active') ) {
		    		ajax_update_item_content();
		    	}
		    	else {
		    		et_update_item();
		    	}
		    },
		});
		$('.et_item-popup').hide();
	};

	$('.submit-add-to-menu').click(function(){

		ajax_update_item_content();

	});

	// end et_content items

	var menu_id = $('#menu').val();

	// Visibility option
	$(document).on('change', '.field-item_visibility select', function(){
		var item = $(this).closest('.menu-item');
		var id = $(item).find('.menu-item-data-db-id').val();
		var el_vis = $(item).find('.field-item_visibility select').val();
		changed_settings = true;
		function et_refresh_item_visibility (id, el_vis) {
			if ( $('ul#menu-to-edit').find('input.menu-item-data-parent-id[value="'+id+'"]').length > 0 ) {
				var child = $('ul#menu-to-edit').find('input.menu-item-data-parent-id[value="'+id+'"]').closest('.menu-item');
				var select = child.find('.field-item_visibility select');
				var c_vis = select.val();
				if ( c_vis != el_vis ) {
					select.val(el_vis).change();
					var id = child.find('.menu-item-data-db-id').val();
					et_refresh_item_visibility(id, el_vis);
				}
			}
		}
		et_refresh_item_visibility(id, el_vis);
	});

	// Open options

	$(document).on( 'click', '.item-type', function(){
		var parent = $(this).closest('.menu-item');
		parent.prepend('<div class="popup-back"></div>');
		var menu_setgs = $(parent).find('.menu-item-settings');
		var children = $(parent).find('.et_item-popup');
		$(children).addClass('popup-opened');
		$('body').addClass('et_modal-opened');
		if (  $(parent).hasClass('menu-item-edit-inactive') ) {
			$(parent).removeClass('menu-item-edit-inactive').addClass('menu-item-edit-active');
		}
		$(menu_setgs).css('display', 'block');
		$(children).show();
	});

	// Single item
	$(document).on( 'click', '.et-saveItem, .popup-back', function() {
		if ( $('body').hasClass('et_modal-opened') ) {

			var el = $(this).closest('.menu-item');
			var children = el.find('.et_item-popup');
			
			if ( $(this).hasClass('et-close-modal') ) {
				if ( $(children).hasClass('popup-opened') ) {
					$(children).removeClass('popup-opened').hide();
					$('body').removeClass('et_modal-opened');
					el.find('.popup-back').remove();
				}
				return;
			}

			$(children).addClass('et-saving');

			var db_id = anchor = design = dis_titles = column_width = column_height = columns = icon_type = 
			icon = item_label = background_repeat = background_position = background_position = use_img = open_by_click = sublist_width = '';

			db_id = el.find('.menu-item-data-db-id').val();
			

			anchor = el.find('.field-anchor input').val();
			design = el.find('.field-design select option:selected').val();
			design2 = el.find('.field-design2 select option:selected').val();
			dis_titles = el.find('.field-disable_titles input:checked').val() ? 1 : 0;
			column_width = el.find('.field-column_width input').val();
			column_height = el.find('.field-column_height input').val();
			sublist_width = el.find('.field-sublist_width input').val();
			columns = el.find('.field-columns select option:selected').val();
			icon_type = el.find('.field-icon_type select option:selected').val();
			icon = el.find('.field-icon input').val();
			item_label = el.find('.field-label select option:selected').val();
			background_repeat = el.find('.field-background_repeat select option:selected').val();
			background_position = el.find('.field-background_position select option:selected').val();
			widget_area = ( el.hasClass('menu-item-depth-1') || el.hasClass('menu-item-depth-2')) ? el.find('.field-widget_area select option:selected').val() : '';
			static_block = el.find('.field-static_block select option:selected').val();
			use_img = el.find('.field-use_img select option:selected').val();
			// open_by_click = el.find('.field-open_by_click input:checked').val() ? 1 : 0;
			// visibility = el.find('.field-item_visibility select option:selected').val();

		 	item_menu = { db_id: db_id, anchor : anchor,  design : design, design2: design2, column_width : column_width,  column_height : column_height,  columns : columns, icon_type : icon_type, icon : icon,  
			item_label : item_label,  background_repeat : background_repeat,  background_position : background_position, widget_area : widget_area, static_block : static_block, use_img : use_img, sublist_width : sublist_width };

			$.ajax({
				url: ajaxurl,
				method: 'POST',
				dataType: 'json',
				data: {
					'action' : 'et_update_menu_ajax',
					's_meta' : 'item',
					'item_menu' : item_menu,
					'menu_id' : menu_id,
				},
				success: function (data) {
					if ( $(children).hasClass('popup-opened') ) {
						$(children).removeClass('et-saving').removeClass('popup-opened').hide();
						$('body').removeClass('et_modal-opened');
						el.find('.popup-back').remove();
					}
				},
			});
		}
	});

	// Remove item 
	$("a.item-delete").addClass('custom-remove-item');
	$("a.custom-remove-item").removeClass('item-delete');

	$(document).on('click', '.custom-remove-item', function(e) {
		e.preventDefault();
		button = $(this);
		delid = button.attr('id');
		var itemID = parseInt(button.attr('id').replace('delete-', ''), 10);
		button.addClass('item-delete');
		ajaxdelurl = button.attr('href');
		$.ajax({
			type: 'GET',
			url: ajaxdelurl,
			beforeSend: function(xhr){
				button.text('Removing...');
			},
			success: function(data){
				button.text('Remove');
				$("#"+delid).trigger("click");
			}
		});
		return false;
	});

	/****************************************************/
	/* Search for versions */
	/****************************************************/
	$( '.etheme-versions-search' ).on( 'keyup', function(e){
		var value = $(this).val();

		$( '.etheme-search .spinner' ).addClass( 'is-active' );
    	$( '.etheme-search .et-zoom' ).addClass( 'et-invisible' );

    	if ( value.length >= 2 ) {
	    	$( '.version-preview' ).removeClass( 'et-show' ).addClass( 'et-hide' );
    		$.each( $( '.version-preview' ), function(){
    			var text = $(this).text();
	    		if ( text.toLowerCase().includes(value.toLowerCase()) ) {
	    			$(this).removeClass( 'et-hide' ).addClass( 'et-show' );
	    		}
	    	} );
    	} else {
    		$( '.version-preview' ).removeClass( 'et-hide' ).removeClass( 'et-show' );
    		$( '.versions-filter[data-filter="all"]' ).trigger('click');
    	}

    	setTimeout(function() {
    		$( '.etheme-search .spinner' ).removeClass( 'is-active' );
			$( '.etheme-search .et-zoom' ).removeClass( 'et-invisible' );
    	}, 500);

	});



	/****************************************************/
	/* versions filter  */
	/****************************************************/
	$( '.versions-filter' ).on( 'click', function(e){
		var filter = $(this).attr('data-filter');

		$( '.versions-filter' ).removeClass('active');
		$(this).addClass('active');
		$.each( $( '.version-preview' ), function(){
			$(this).attr('data-active-filter', filter);
			if ( $(this).attr('data-filter').indexOf(filter) != -1 ) {
				$(this).removeClass( 'et-hide' ).removeClass( 'et-show' );
			} else {
				$(this).removeClass( 'et-show' ).addClass( 'et-hide' );
			}
    	} );
	});

	/****************************************************/
	/* Import XML data */
	/****************************************************/

	var importSection = $('.etheme-import-section'),
		loading = false,
		additionalSection = importSection.find('.import-additional-pages'),
		pagePreview = additionalSection.find('img').first(),
		pagesSelect = additionalSection.find('select'),
		pagesPreviewBtn = additionalSection.find('.preview-page-button'),
		importPageBtn = additionalSection.find('.et-button');

	pagesSelect.change(function() {
		var url = $(this).data('url'),
			version = $(this).find(":selected").val(),
			previewUrl = $(this).find(":selected").data('preview');

		pagePreview.attr('src', url + version + '/screenshot.jpg');
		importPageBtn.data('version', version);
		pagesPreviewBtn.attr('href', previewUrl);
	}).trigger('select');

	importSection.on('click', '.button-import-version', function(e) {
		e.preventDefault();

		var version = $(this).data('version');

		importVersion(version);
	});

	$(document).on( 'click', '.et_close-popup', function(e){
		$('.et_panel-popup').html('').removeClass('active auto-size');
		$('body').removeClass('et_panel-popup-on');
	});

	var importVersion = function(version) {
		if( loading ) return false;

		loading = true;
		importSection.addClass('import-process');

		importSection.find('.import-results').remove();

		var data = {
			action:'et_ajax_panel_popup',
			// action:'etheme_import_ajax',
			version: version,
			pageid: 0
		};

		var popup = $('.et_panel-popup');


		popup.html('');

		$.ajax({
			method: "POST",
			url: ajaxurl,
			data: data,
			success: function(data){
				
				// popup-import-head
				popup.addClass('loading');


				$('body').addClass('et_panel-popup-on');
				
				popup.prepend('<span class="et_close-popup et-button-cancel et-button"><i class="et-admin-icon et-delete"></i></span>');
				popup.addClass('panel-popup-import').append(data.head);
				popup.addClass('panel-popup-import').append(data.content);

				popup.addClass('active').removeClass('loading');


				EtImportActiond(popup);
				// popup.find('.version-title').html()
				// importSection.prepend('<div class="import-results et-message et-success">' + data + '</div>');
				// if( version == 'default' ) {
				// 	importSection.removeClass('no-default-imported');
				// 	importSection.find('.et-default-content-info').remove();
				// }
				// importSection.find('.version-preview-' + version).removeClass('not-imported').addClass('version-imported just-imported').find('.et-button').remove();
			},
			complete: function(){
				importSection.removeClass('import-process');
				loading = false;
			}
		});
	};


	function EtImportActiond(popup){
		popup.find('.et_navigate-next').on( 'click', function(e){
			var step = popup.find('.et_popup-step.active');
			step.removeClass('active').addClass('hidden');
			step.next().addClass('active').removeClass('hidden');


			if ( step.hasClass('et_step-plugins') && $('.et_popup-import-plugin-btn:not(.et_plugin-installed)').length && ! confirm('This demo requires some plugins to be installed. Are you sure you want to continue?') ) {
				// $(document).find('.et_close-popup').trigger('click');
				return;
			} else if( step.hasClass('et_step-requirements')  && ! confirm('Your system does not meet the server requirements. Are you sure you want to continue?') ){
				// $(document).find('.et_close-popup').trigger('click');
				return;
			}



			if ( step.next().hasClass('et_step-type') ) {
				popup.find('.et_navigate-next').addClass('hidden');
				popup.find('.et_navigate-install').removeClass('hidden');
			}
		});

		popup.find('#et_all').on( 'change', function(e){
			if ( $(this).attr('checked') != 'checked' ) {
				popup.find('.et_manual-setup').addClass('active');

				popup.find('.et_manual-setup input').attr('checked', false);
			} else {
				popup.find('.et_manual-setup').removeClass('active');
				popup.find('.et_manual-setup input').attr('checked', 'checked');
			}


			popup.find('#pages').trigger('change');
		});


		popup.find('#pages').on( 'change', function(e){
			if ( $(this).attr('checked') != 'checked' ) {
				popup.find('.et_manual-setup-page').addClass('hidden');
			} else {
				popup.find('.et_manual-setup-page').removeClass('hidden');
			}
		});

		popup.find('.et_navigate-install').on( 'click', function(e){

			popup.find('.et_close-popup').addClass('hidden');
			
			to_install = popup.find( '.et_install-demo-form' ).serializeArray();

			if ( popup.find('#et_all').attr('checked') == 'checked' ) {
				to_install.shift();
			}

			popup.find('.et_progress').attr('data-step', parseInt(100/to_install.length));
			var data = {
				type    : 'xml',
				action  :'etheme_import_ajax',
				version : $(this).attr('data-version'),
			};

			popup.find('.et_popup-step.active').removeClass('active').addClass('hidden');
			popup.find('.et_step-processing').addClass('active').removeClass('hidden');

			
			install_part(popup, data, 0, false, '');
		});

		
	}


	/**
	 * After theme activate
	 *
	 * @version 1.0.0
	 * @since   6.2.2
	 */
	after_activate();
    function after_activate(){
    	if ( ! $('.et_popup-activeted-content').length ) {
    		return;
    	}

		$('.et_panel-popup').html( $('.et_popup-activeted-content').clone() );
		$('.et_panel-popup').find('.et_popup-activeted-content').removeClass('hidden');
		$('.et_popup-activeted-content.hidden').remove();
        $('body').addClass('et_panel-popup-on');
        $('.et_panel-popup').addClass('active');
    	install_plugin();
    }

    /**
	 * Install base plpugin after theme activate
	 *
	 * @version 1.0.0
	 * @since   6.2.2
	 */
    function install_plugin(){
        if ( ! $('.et_plugin-nonce').length ) {
            return;
        }
        var data  = {
                action  : 'envato_setup_plugins',
                slug    : 'et-core-plugin',
                wpnonce : $(document).find( '.et_plugin-nonce' ).attr( 'data-plugin-nonce' ),
            },
            current_item_hash = '',
            installing = $('.et_installing-base-plugin'),
            installed  = $('.et_installed-base-plugin');

        $.ajax({
            method: "POST",
            url: ajaxurl,
            data: data,
            success: function(response){
                if ( response.hash != current_item_hash ) {
                    $.ajax({
                        method: "POST",
                        url: response.url,
                        data :response,
                        success: function(response){
                            installing.addClass('et_installed hidden');
                            installed.removeClass('hidden');
                            $('.mtips').removeClass( 'inactive' );
                            $('.mt-mes').remove();
                        },
                        error : function(){
                            installing.addClass('et_error');
                        }, 
                        complete : function(){
                        }
                    });
                } else {
                    installing.addClass('et_error');
                }
            },
            error: function(response){
                installing.addClass('et_error');
            },
            complete: function(response){
            }
        });
    }


	/**
	 * Install plpugins
	 *
	 * @version 1.0.0
	 * @since   6.2.2
	 */
	install_plugins();
	function install_plugins(){
		$(document).on( 'click', '.et_popup-import-plugin-btn:not(.et_plugin-installing, .et_plugin-installed), .et_core-plugin', function(e){
			e.preventDefault();
			var popup = '';
			if ( $(this).hasClass('et_core-plugin') ) {
				popup = $( '.etheme-registration' );
			} else {
			 	popup = $( '.et_panel-popup.panel-popup-import.active, .et_panel-popup.et_popup-import-single-page' );
			}
			var $el = $(this),
				li    = $el.parents('li'),
				data  = {
					action  : 'envato_setup_plugins',
					slug    : $el.attr( 'data-slug' ),
					wpnonce : popup.find( '.et_plugin-nonce' ).attr( 'data-plugin-nonce' ),
				},
				current_item_hash = '';

			popup.find('.et_popup-import-plugins').addClass('ajax-processing');
			$el.addClass( 'et_plugin-installing' );
			li.addClass( 'processing');

			$.ajax({
				method: "POST",
				url: ajaxurl,
				data: data,
				success: function(response){
                    if ( response.hash != current_item_hash ) {
                    	$.ajax({
                    		method: "POST",
							url: response.url,
							data :response,
							success: function(response){
								li.addClass('activated');
								$el.removeClass( 'et_plugin-installing' ).addClass( 'et_plugin-installed green-color' ).text( 'Activated' ).attr('style', null);
								$el.parents('.et_popup-import-plugin').find('.dashicons').addClass('dashicons-yes-alt green-color').removeClass('dashicons-warning orange-color red-color');
								if ( $el.hasClass('et_core-plugin') ) {
									$('.etheme-page-nav .mtips').removeClass('inactive mtips');
									window.location = $('.etheme-page-nav .et-nav-portfolio').attr('href');
									$el.css('pointer-events', 'none');
									$('.mt-mes').remove();
								}
							},
							error : function(){
								$el.removeClass( 'et_plugin-installing' ).addClass( 'et_plugin-installed red-color' ).text( 'Failed' ).attr('style', null);
								$el.parents('.et_popup-import-plugin').find('.dashicons').addClass('red-color').removeClass('orange-color');
							}, 
							complete : function(){
								li.removeClass('processing');
								$el.removeClass('loading');
								popup.find('.et_popup-import-plugins').removeClass('ajax-processing');
								// second chance for plugins
								if ( ! $el.hasClass('et_second-try') ) {
									$el.removeClass('et_plugin-installed').addClass('et_second-try');
									$el.trigger('click');
								} else if( popup.hasClass('et_popup-import-single-page') ) {
									popup.find('.et_install-page-content').removeClass('et-button-grey2').addClass('et-button-green').html(popup.find('.et_install-page-content').attr('data-text'));
								}
							}
                    	});
                    } else {
                    	$el.removeClass( 'et_plugin-installing' ).addClass( 'et_plugin-installed installing-error red-color' ).text( 'Failed' ).attr('style', null);
                    }
				},
				error: function(response){
					$el.removeClass( 'et_plugin-installing' ).addClass( 'et_plugin-installed installing-error red-color' ).text( 'Failed' ).attr('style', null);
					li.removeClass('processing');
					$el.removeClass('loading');
					popup.find('.et_popup-import-plugins').removeClass('ajax-processing');
				},
				complete: function(response){
				}
			});
		});
	}

	/**
	 * Install version part
	 *
	 * @version 1.0.2
	 * @since   6.2.0
	 * @param {object}         popup     - doom element that hould popup
	 * @param {object}         data      - object vith ajax data
	 * @param {integer}        iteration - iteration number
	 * @param {string/boolean} error     - error part name
	 */
	function install_part(popup, data, iteration, error){

		if ( iteration == 0 ) {
			data.install = to_install.shift();
		} else {
			iteration = iteration - 1;
		}

		switch( data.install.value ) {
		  case 'options':
		    data.type = 'options';
		    break;
		  case 'menu':
		    data.type = 'menu';
		    break;
		  case 'home_page':
		    data.type = 'home_page';
		    break;

		   case 'slider':
		    data.type = 'slider';
		    break;

		   case 'widgets':
		    data.type = 'widgets';
		    break;

		    case 'fonts':
		    data.type = 'fonts';
		    break;

		    case 'variation_taxonomy':
		    data.type = 'variation_taxonomy';
		    break;

		    case 'variations_trems':
		    data.type = 'variations_trems';
		    break;

		    case 'variation_products':
		    data.type = 'variation_products';
		    break;

		    case 'et_multiple_headers':
		    data.type = 'et_multiple_headers';
		    break;

		    case 'et_multiple_conditions':
		    data.type = 'et_multiple_conditions';
		    break;

		    case 'et_multiple_single_product':
		    data.type = 'et_multiple_single_product';
		    break;

		    case 'et_multiple_single_product_conditions':
		    data.type = 'et_multiple_single_product_conditions';
		    break;

		  	default:
		    data.type = 'xml';
		}

		popup.find( '.et_progress-notice' ).html( 'Installing ' + $( '[for="' + data.install.value + '"]' ).html() );
		popup.find( '.et_navigate-install' ).addClass( 'hidden' );

		$.ajax({
			method: "POST",
			url: ajaxurl,
			data: data,
			success: function(response){
				if ( response ) {
					errors.push( '<p class="et_error-title"><b>' + data.install.name + ' not installed :(</b></p>' );
				}
				progress_setup(popup, data.install.name);
				if (to_install.length) {
					install_part(popup,data,0, false);
				} else {
					finish_setup(popup);
				}
				importSection.removeClass('import-process');
				loading = false;
			},
			error: function(){
				if ( to_install.length ) {
					// quick fix to prevent variations errors
					if ( data.type != 'variation_taxonomy' && data.type != 'variations_trems' && data.type != 'variation_products' ) {
						if ( data.type == 'xml' && data.install.name != 'menu' && data.install.name != 'media' ) {
							if ( iteration == 0 && data.install.name != error ) {
								install_part(popup,data,2, false);
							} else {
								install_part(popup,data,iteration, data.install.name);

								if (iteration == 0 && error && data.install.name != error ) {
									errors.push( '<p class="et_error-title"><b>' + error + ' not installed :(</b></p>' );

									progress_setup(popup, error);
								}
							}
						} else{
							errors.push( '<p class="et_error-title"><b>' + data.install.name + ' not installed :(</b></p>' );
							progress_setup(popup, data.install.name);
							install_part(popup,data,0, data.install.name);
						}
					}
					else {
						install_part(popup,data,0, data.install.name);
					}
				} else {
					finish_setup(popup);
				}

			},
			complete: function(response){
			}
		});
	}

	/**
	 * Installation progress
	 *
	 * @version 1.0.1
	 * @since   6.2.1
	 * @param {object} popup    - doom element that hould popup
	 * @param {string} progress - text for progress
	 */
	function progress_setup(popup, progress){
		var part = parseInt( popup.find('.et_progress').attr('value') ) + parseInt(popup.find('.et_progress').attr('data-step') );
		popup.find('.et_progress').attr('value', part );
		popup.find('.et_progress-notice').html('Installed ' + $('[for="' + part + '"]').html());
	}

	/**
	 * Finishvsetup
	 *
	 * @version 1.0.1
	 * @since   6.2.1
	 * @param {object} popup    - doom element that hould popup
	 */
	function finish_setup(popup){
		popup.find('.et_progress-notice').html('success install');
		popup.find('.et_progress').attr('value', 100 );

		if ( errors.length > 0 ) {
			$.each( errors, function(i, t){
				popup.find('.et_errors-list').append( '<li class="et_popup-import-plugin et-message et-warning">' + t + '</li>' );
		    });
			popup.find('.et_with-errors').removeClass('hidden');
		} else {
			popup.find('.et_all-success').removeClass('hidden');
		}

		popup.find('.et_close-popup').removeClass('hidden');
		popup.find('.et_popup-step.active').removeClass('active').addClass('hidden');
		popup.find('.et_step-final').addClass('active').removeClass('hidden');
	}

	// show video installation xstore 
	$('.et-open-installation-video').on('click', function(){
		$('body').addClass('et_panel-popup-on');
		var popup = $('.et_panel-popup');
		popup.addClass('auto-size').html('<iframe width="888" height="500" src="https://www.youtube.com/embed/UAlAkvoilfk?controls=0&showinfo=0&controls=0&rel=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
		popup.prepend('<span class="et_close-popup et-button-cancel et-button"><i class="et-admin-icon et-delete"></i></span>');
	});


	/****************************************************/
	/* Load YouTybe videos use youtube/v3 api*/
	/****************************************************/
	GetYouTybe();
	$('.et-button.more-videos').on('click', function(e){
 		e.preventDefault();
	 	GetYouTybe();
	});

	// ! Get data from YouTybe
	function GetYouTybe(){
		// ! Do it only on support page
		if ( $( '.etheme-support' ).length < 1 ) {
			return;
		}

	    var nextPageToken = $('.et-button.more-videos').attr( 'next-page' );
	    $.get(
	        "https://www.googleapis.com/youtube/v3/playlistItems",{
		        part : 'snippet', 
		        maxResults : 6,
		        playlistId : 'PLMqMSqDgPNmCCyem_z9l2ZJ1owQUaFCE3',
		        order: 'date',
		        pageToken : nextPageToken,
	        	key: 'AIzaSyBNsAxteDRIwO1A6Ainv8u-_vVYcPPRYB8'
	        },
	        function(data){
              	ShowFrames(data);
	        }        
	    );  
	}

	// ! Insert frames to the page
	function ShowFrames(data){
	    var spinner = '<span class="spinner is-active">\
            <div class="et-loader ">\
                <svg class="loader-circular" viewBox="25 25 50 50">\
                <circle class="loader-path" cx="50" cy="50" r="12" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>\
                </svg>\
            </div>\
            </span>';

	    $('.et-button.more-videos').attr( 'next-page', data['nextPageToken'] );

	    $.each( data.items, function(k, v){
	      	var rand = Math.floor((Math.random() * 100) + 1);
	      	$( '.etheme-videos' ).append( '<div class="etheme-video text-center holder-'+ rand +'">' + spinner + '<iframe src="https://www.youtube.com/embed/' + v['snippet']['resourceId']['videoId'] + '" allowfullscreen></iframe></div>' );
	      	$('.holder-' + rand + ' iframe').load(function(){
				$( '.holder-' + rand + ' .spinner' ).removeClass('is-active');
			});
	     });

      	if ( data.pageInfo.totalResults == $( '.etheme-video' ).length ) {
  			$('.et-button.more-videos').remove();
  			return;
  		} 
	}











	/****************************************************/
	/* Panel social functions
	/****************************************************/
	$(document).on('click', '.etheme-user .user-remove', function(e) {
		e.preventDefault();
		if ( ! confirm( 'Are you sure' ) ) {
			return;
		}
		var user = $(this).parents('.etheme-user');
		var data =  {
			'action':'et_instagram_user_remove',
			'token': user.find('.user-token').attr( 'data-token' )
		};
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data,
			success: function(data){
				if ( data != 'success' ){
					console.log(data);
				} else {
					if ( $( '.etheme-user' ).length < 2 ) {
						$( '.etheme-no-users' ).removeClass( 'hidden' );
					}
						
					user.remove();
				}
			},
			error: function(){
				alert('Error while deleting');
			},
			complete: function(){

			}
		});
	});


	$(document).on('click', '.etheme-instagram-settings .etheme-instagram-save', function(e) {
		e.preventDefault();
		if ( ! confirm( 'Are you sure ?' ) ) {
			return;
		}
		var data =  {
			'action':'et_instagram_save_settings',
			'time':$('#instagram_time').attr('value'),
			'time_type': $('#instagram_time_type').attr('value')
		};
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data,
			success: function(data){
				console.log(data);
			},
			error: function(){
				alert('Error while deleting');
			},
			complete: function(){

			}
		});
	});


	$(document).on('click', '.etheme-instagram-settings .etheme-instagram-reinit', function(e) {
		window.location.href = window.location.href + '&et_reinit_instagram=true';
	});

	$(document).on('click', '.etheme-instagram-manual', function(e) {
		e.preventDefault();
		if ( $( '.etheme-instagram-manual-form' ).hasClass( 'hidden' ) ) {
			$( '.etheme-instagram-manual-form' ).removeClass( 'hidden' );
		} else {
			$( '.etheme-instagram-manual-form' ).addClass( 'hidden' );
		}
	});


	$(document).on('click', '.etheme-manual-btn', function(e) {
		e.preventDefault();
		if ( ! confirm( 'Are you sure' ) ) {
			return;
		}
		var parent = $(this).parent();
		var data =  {
			'action': 'et_instagram_user_add',
			'token' : $( '#etheme-manual-token' ).attr( 'value' )
		};

		if ( ! data['token'] ) {
			parent.find( '.etheme-form-error' ).removeClass( 'hidden' );
			return;
		} else {
			parent.find( '.etheme-form-error' ).addClass( 'hidden' );
		}
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data,
			success: function(data){
				if ( data != 'success' ){
					parent.find( '.etheme-form-error-holder' ).text( '' );
					parent.find( '.etheme-form-error-holder' ).text( data );
					parent.find( '.etheme-form-error-holder' ).removeClass( 'hidden' );
				} else {
					location.reload();
				}
			},
			error: function(){
				alert('Error while deleting');
			},
			complete: function(){

			}
		});
	});

	$(document).on( 'click', '[name="xstore-purchase-code"]:not(.active)', function(e){
		e.preventDefault();
	});

	$(document).on( 'change', '#form_agree', function(e){
		if ( $(this).attr('checked') != 'checked' ) {
			$('[name="xstore-purchase-code"]').removeClass('active');
		} else {
			$('[name="xstore-purchase-code"]').addClass('active');
		}
	});

});
