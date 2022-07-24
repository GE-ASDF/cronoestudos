const menu = document.querySelector(".menu");
const headerNav = document.querySelector(".right .nav-header");

menu.addEventListener("click", function(){
    menu.innerHTML == "menu" ? menu.innerHTML = "close":menu.innerHTML="menu";
    headerNav.getAttribute("style") ? headerNav.removeAttribute("style"):headerNav.setAttribute("style", "top:72px");
})