import { animate, inView } from "motion"

const flowers = () => {
	if ( document.getElementById( "flower-faq" ) ) {
		var element = document.querySelector( "#flower-faq" )
		inView( element, () => {
			animate(
				"#flower-faq",
				{ width: "530px" },
				{ duration: 2 }
			)
		} )
	}

	if ( document.getElementById( "flower-tm" ) ) {
		var element = document.querySelector( "#flower-tm" )
		inView( element, () => {
			animate(
				"#flower-tm",
				{ height: "100%" },
				{ duration: 2 }
			)
		} )
	}
	if ( document.getElementById( "flower-tcta" ) ) {
		var element = document.querySelector( "#flower-tcta" )
		inView( element, () => {
			animate(
				"#flower-tcta",
				{ height: "90%" },
				{ duration: 2 }
			)
		} )
	}

	if ( document.getElementById( "flower-form" ) ) {
		var element = document.querySelector( "#flower-form" )
		inView( element, () => {
			animate(
				"#flower-form",
				{ height: "90%" },
				{ duration: 2 }
			)
		} )
	}
}

const rectangles = () => {
	if ( document.getElementById( "itp-rectangle" ) ) {
		var element = document.querySelector( "#itp-rectangle" )
		inView( element, () => {
			animate(
				"#itp-rectangle",
				{ width: "50%" },
				{ duration: 2 }
			)
		} )
	}

	if ( document.getElementById( "tip-rectangle" ) ) {
		var element = document.querySelector( "#tip-rectangle-content" )
		inView( element, () => {
			animate(
				"#tip-rectangle",
				{ width: "60%" },
				{ duration: 2 }
			)
		} )
	}

	if ( document.getElementById( "quote" ) ) {
		var element = document.querySelector( "#quote" )
		inView( element, () => {
			element.classList.add( "animate" )
		} )
	}
}

if ( !window.matchMedia( "(max-width: 1181px)" ).matches ) {
	flowers();
	rectangles();
}