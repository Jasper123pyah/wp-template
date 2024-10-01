document.addEventListener('DOMContentLoaded', () => {
    const carouselContainers = document.querySelectorAll('.cards__container.carousel');

    if (carouselContainers.length > 0) {
        carouselContainers.forEach(container => {
            const swiper = new Swiper(container.querySelector('.swiper'), {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    }
});
