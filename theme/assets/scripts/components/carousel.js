document.addEventListener('DOMContentLoaded', () => {
    const carouselContainers = document.querySelectorAll('.cards.carousel');

    if (carouselContainers.length > 0) {
        carouselContainers.forEach(container => {
            const swiperElement = container.querySelector('.swiper');
            const carouselColumns = parseInt(container.dataset.carouselColumns) || 1;

            const swiper = new Swiper(swiperElement, {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                allowTouchMove: true,
                navigation: {
                    nextEl: container.querySelector('.swiper-button-next'),
                    prevEl: container.querySelector('.swiper-button-prev'),
                },
                pagination: false,
                breakpoints: {
                    640: {
                        slidesPerView: carouselColumns,
                    },
                },
            });

            swiperElement.addEventListener('mouseenter', () => {
                swiper.autoplay.stop();
            });

            swiperElement.addEventListener('mouseleave', () => {
                swiper.autoplay.start();
            });
        });
    }
});
