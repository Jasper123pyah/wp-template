document.addEventListener( 'DOMContentLoaded', function () {
	var faqContainer = document.querySelector( '.faq' );

	if ( !faqContainer ) return;

	var faqContent = faqContainer.querySelectorAll( '.faq__content' );

	faqContent.forEach( function ( item ) {
		item.addEventListener( 'click', function () {
			item.classList.toggle( 'faq__content--active' );
		} );
	} );
} );