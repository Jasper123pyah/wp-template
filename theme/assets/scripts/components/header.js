document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.navbar__burger');
    const close = document.querySelector('.navbar--mobile__close');
    const mobileMenu = document.querySelector('.navbar--mobile');

    if (burger && close && mobileMenu) {
        burger.addEventListener('click', function() {
            mobileMenu.classList.add('open');
        });

        close.addEventListener('click', function() {
            mobileMenu.classList.remove('open');
        });
    }
});

document.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const scrollThreshold = 100;

    function handleScroll() {
    if (window.scrollY > scrollThreshold) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
        }
    }

    handleScroll();
});
