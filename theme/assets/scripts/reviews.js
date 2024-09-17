jQuery(document).ready(function($) {
	$('.reviews__content').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		prevArrow: ".reviews__arrow--left",
		nextArrow: ".reviews__arrow--right",
	});
});