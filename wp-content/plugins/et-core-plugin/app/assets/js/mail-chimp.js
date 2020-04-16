jQuery(document).ready(function (event) {
	"use strict";
	jQuery('.etheme_mailchimpform').on('submit', function (e) {
		e.preventDefault();

			let email = jQuery('.etheme_mail_email').val(),
			firstname = jQuery('.etheme_user_first').val(),
			lastname = jQuery('.etheme_user_last').val(),
			phone = jQuery('.etheme_mail_phone').val(),
			nonce = jQuery(this).attr('data-nonce'),
			listed = jQuery(this).attr('data-listed'),
			message = jQuery(this).attr('data-success-message'),
			messageBox = jQuery('.etheme-mail-message');

		jQuery.ajax({
			type: "POST",
			url: etheme_mailchimp.adminajax,
			data: {
				action: 'etheme_mailchimp',
				security: nonce,
				email: email,
				firstname: firstname,
				lastname: lastname,
				phone: phone,
				listed: listed,
			},
			success: function (response) {
				messageBox.show();
				if ( true == response.error) {
					messageBox.removeClass('success');
					messageBox.addClass('error').html(response.msg);
					return;
				}
				if ( false == response.error ) {
					messageBox.removeClass('error');
					messageBox.addClass('success').html(response.msg);
					return;
				}			
			}
		});
	});

});