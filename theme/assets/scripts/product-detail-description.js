jQuery(document).ready(function() {
	function adjustImageHeight() {
		if (jQuery(window).width() >= 1181) {
			var textHeight = jQuery('#pdd-second-text').height();

			var marginsAndPaddings = 80 + 68;
			var underneathImage = 138;
			jQuery('.product-detail-description__image').height(textHeight + marginsAndPaddings + underneathImage);
		} else {
			jQuery('.product-detail-description__image').css('height', '');
		}
	}

	adjustImageHeight();

	jQuery(window).on('resize', adjustImageHeight);
});