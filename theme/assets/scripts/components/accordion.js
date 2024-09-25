document.addEventListener('DOMContentLoaded', function() {
    const accordionItems = document.querySelectorAll('.accordion__item');
    let openIndex = null;

    accordionItems.forEach(item => {
        item.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            
            if (openIndex === index) {
                this.classList.remove('open');
                openIndex = null;
            } else {
                if (openIndex !== null) {
                    accordionItems[openIndex].classList.remove('open');
                }
                this.classList.add('open');
                openIndex = index;
            }
        });
    });
});
