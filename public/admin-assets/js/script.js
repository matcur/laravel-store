function toggleClass(el, className) {
  if (el.classList.contains(className)) {
    el.classList.remove(className);
  } else {
    el.classList.add(className);
  }
}

let burgerMenu = document.querySelector('.burger-menu');
burgerMenu.addEventListener('click', () => {
  let dropMenu = document.querySelector('.drop-menu');
  toggleClass(dropMenu, 'show-drop-down-menu');
});

let leftBurgerMenu = document.querySelector('.left-menu-wrapper').querySelector('.burger-menu-wrapper');
leftBurgerMenu.addEventListener('click', () => {
  let dropRightMenu = document.querySelector('.drop-right');
  toggleClass(dropRightMenu, 'show-drop-right-menu')
})