export const initAccordion = () => {
    const accordionTitles = document.querySelectorAll('.accordion__title');

    accordionTitles.forEach((title) => {
        title.addEventListener('click', () => {
            let activeTitle = document.querySelector('.accordion__title.is-active');
            if (activeTitle) {
                activeTitle.classList.remove('is-active');
                const content = activeTitle.nextElementSibling;
                if (!content.classList.contains('is-active')) {
                    content.style.height = content.scrollHeight + 'px';
                } else {
                    content.style.height = '0px';
                }
                content.classList.toggle('is-active');
            }

            if (title === activeTitle) {
                return;
            }

            title.classList.toggle('is-active');

            const content = title.nextElementSibling;
            if (!content.classList.contains('is-active')) {
                content.style.height = content.scrollHeight + 'px';
            } else {
                content.style.height = '0px';
            }
            content.classList.toggle('is-active');
        });
    });
};
