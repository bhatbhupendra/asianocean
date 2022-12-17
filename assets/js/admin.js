//clickeing tab buttion

var overview = document.getElementsByClassName("overview")[0]
var menu = document.getElementsByClassName("menu")[0]
var categories = document.getElementsByClassName("categories")[0]

var overviewBody = document.getElementsByClassName("dashboard-item-overview")[0];
var menuBody = document.getElementsByClassName("dashboard-item-menu")[0];
var categoriesBody = document.getElementsByClassName("dashboard-item-categories")[0];

overview.addEventListener('click', ()=>{
    overview.classList.add("active");
    menu.classList.remove("active");
    categories.classList.remove("active");

    overviewBody.style.display = "block";
    menuBody.style.display = "none";
    categoriesBody.style.display = "none";
});

menu.addEventListener('click', ()=>{
    overview.classList.remove("active");
    menu.classList.add("active");
    categories.classList.remove("active");

    overviewBody.style.display = "none";
    menuBody.style.display = "block";
    categoriesBody.style.display = "none";
});

categories.addEventListener('click', ()=>{
    overview.classList.remove("active");
    menu.classList.remove("active");
    categories.classList.add("active");

    overviewBody.style.display = "none";
    menuBody.style.display = "none";
    categoriesBody.style.display = "block";
});