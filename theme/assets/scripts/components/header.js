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
