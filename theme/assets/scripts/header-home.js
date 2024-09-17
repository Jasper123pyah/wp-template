document.addEventListener("DOMContentLoaded", function() {
	const headerHome = document.querySelector('.header-home');
	const headerImage = document.querySelector('.header-home__image');

	// Function to check if the screen width is greater than 1181px
	function isScreenWidthValid() {
		return window.innerWidth > 1181;
	}

	if (isScreenWidthValid()) {
		if (headerImage.complete) {
			setContainerHeight();
		} else {
			headerImage.addEventListener('load', setContainerHeight);
		}

		// Adjust height on window resize
		window.addEventListener('resize', function() {
			if (isScreenWidthValid()) {
				setContainerHeight();
			} else {
				headerHome.style.height = ''; // Reset height for smaller screens
			}
		});
	}

	function setContainerHeight() {
		headerHome.style.height = `${headerImage.clientHeight - 160}px`;
	}

	// Use MutationObserver to track changes in image's src
	const observer = new MutationObserver((mutations) => {
		mutations.forEach((mutation) => {
			if (mutation.attributeName === 'src' && isScreenWidthValid()) {
				setContainerHeight();
			}
		});
	});

	observer.observe(headerImage, { attributes: true });
});