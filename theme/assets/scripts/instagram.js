jQuery(document).ready(function($) {
	var checkExist = setInterval(function() {
		if ($('#sb_instagram').length) {

			var customPrevArrow = '<div class="instagram__arrow instagram__arrow--left"></div>';
			var customNextArrow = '<div class="instagram__arrow instagram__arrow--right"></div>';
			$('.sbi-owl-prev').html(customPrevArrow);
			$('.sbi-owl-next').html(customNextArrow);

			clearInterval(checkExist);
		}
	}, 100);
});