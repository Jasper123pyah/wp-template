jQuery( document ).ready( function ( $ ) {
	$( '.reviews-red__content' ).slick( {
		infinite:       true,
		slidesToShow:   3,
		slidesToScroll: 3,
		arrows:         true,
		prevArrow:      ".reviews-red__arrow.reviews-red__arrow--left",
		nextArrow:      ".reviews-red__arrow.reviews-red__arrow--right",
		responsive:     [ {
			breakpoint: 1181,
			settings:   {
				slidesToShow: 2,
			}
		}, {
			breakpoint: 768,
			settings:   {
				slidesToShow: 1,
			}
		} ]
	} );

	const partialStars = document.querySelectorAll( '.partial-star' );

	partialStars.forEach( ( star ) => {
		const percentage = star.getAttribute( 'data-percentage' );
		star.style.setProperty( '--percentage-width', `${100 - percentage}%` );
	} );


	$('.reviews-red__open-modal').click(function() {
		const reviewId = $(this).data('id');

		// Get necessary data from the clicked post
		const reviewText = $(this).closest('.reviews-red-single').find('.reviews-red__text').html();
		const reviewTitle = $(this).closest('.reviews-red-single').find('.reviews-red__name').text();

		// Populate modal content
		$('#modalTitle').text(reviewTitle);
		$('#modalBody').html(reviewText);

		// Display the modal and darken background
		$('#dynamicModal').addClass('active');
		$('.reviews-red__overlay').addClass('active');

		// Disable scrolling
		$('body').css('overflow', 'hidden');
	});

	$('.reviews-red__overlay').click(function(event) {
		if (event.target !== this) {
			// Ignore clicks on the modal or its children
			return;
		}
		$('#dynamicModal').removeClass('active');
		$('.reviews-red__overlay').removeClass('active');
		$('body').css('overflow', 'auto');
	});

	$('.reviews-red__close-modal').click(function() {
		$('#dynamicModal').removeClass('active');
		$('.reviews-red__overlay').removeClass('active');
		$('body').css('overflow', 'auto');
	});
} );