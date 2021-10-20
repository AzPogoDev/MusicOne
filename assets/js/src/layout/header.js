window.addEventListener("scroll", () => {
    let header = document.querySelector(".header");
    header.classList.toggle("sticky", window.scrollY > 0);
});

// Burger Menu

var menuButton = document.querySelector('#menu-button');
var menu = document.querySelector('#menu');

// show or hide
menuButton.addEventListener('click',function(){
    menu.classList.toggle('show-menu');
    menuButton.classList.toggle('close');
});