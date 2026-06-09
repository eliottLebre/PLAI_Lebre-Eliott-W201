/*affichage du sous menu*/
const $navToggleBtn = document.querySelector('.js-main-nav__toggle-btn')
const $navOverlay = document.querySelector('.js-main-nav__overlay')

$navToggleBtn.addEventListener('click', () => {
    if (window.matchMedia('(hover: hover)').matches) {
        return;
    }
    $navOverlay.classList.toggle('is-hidden')
    $navOverlay.classList.toggle('is-open')
    $navToggleBtn.classList.toggle('is-open')
})


/*affichage du burgeur menu*/
const $navContainer = document.querySelector('.main-nav')
const $mainNavList = $navContainer.querySelector('.main-nav__list')
const $navItems = $mainNavList.querySelectorAll('.main-nav__list > li:not(.is-mobile)')

let totalWidthItems = 0;
const gapSize = 16
const totalGaps = ($navItems.length - 1) * gapSize

document.fonts.ready.then(() => {
    $navItems.forEach(item => {

        totalWidthItems += item.getBoundingClientRect().width
    })

    const requiredWidth = totalWidthItems + totalGaps

    const resizeObserver = new ResizeObserver(entries => {
        for (let entry of entries) {

            const availableSpace = entry.contentRect.width

            if (availableSpace <= requiredWidth) {
                $navContainer.classList.add('is-mobile');
            } else {
                $navContainer.classList.remove('is-mobile');
                $navContainer.classList.remove('is-open');
            }
        }
    });
    resizeObserver.observe($navContainer);
});

/*ouverture du burger menu*/
const $burgerMenu = $navContainer.querySelector('.js-nav-burger')

$burgerMenu.addEventListener('click', () => {
    $navContainer.classList.toggle('is-open')
})