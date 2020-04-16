jQuery(window).on('elementor:init', function () {

	var ethemeIconControlItem = elementor.modules.controls.BaseData.extend({
		onReady: function () {
			var self = this;

			setTimeout(function () {

				jQuery('.elementor-control-field .etheme-icons-wrap li input').on('click', function(event) {
					let checked = jQuery(this).data('name');
					let path = jQuery(this).data('path');
					jQuery('.etheme-icon-selected').prop('src',path + checked);
					jQuery('.elementor-control-field .etheme-icons-wrap li').css('border', 'solid 1px transparent');
					jQuery(this).parent().parent().css('border', 'solid 1px #000');
					self.setValue(checked);
				});
            }, 100);

		},
	});

	elementor.addControlView('etheme-icon-control', ethemeIconControlItem);
});
