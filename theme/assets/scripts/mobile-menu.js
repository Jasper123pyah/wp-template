import { animate } from "motion"

const burger          = document.querySelector( '.header__burger' );
const mobileMenuClose = document.querySelector( '.mobile-menu__close' );

burger.addEventListener( 'click', async () => {
	await animate(
		".mobile-menu",
		{ width: "100vw", height: "100vh", display: "block" },
		{ duration: 1 }
	);

	await new Promise( resolve => setTimeout( resolve, 1000 ) );
	document.querySelector( '.mobile-menu__content' ).style.display = "flex";
} );

mobileMenuClose.addEventListener( 'click', async () => {
	document.querySelector( '.mobile-menu__content' ).style.display = "none";

	animate(
		".mobile-menu",
		{ width: "0vw", height: "0vh",  display: "none" },
		{ duration: 1 }
	);

} );