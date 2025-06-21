const submenudrop = document.querySelectorAll(".menu-dropdown");
const barralateral = document.getElementById("barralateral");
const menu_btn = document.getElementById("btn-menu");


submenudrop.forEach(submenuitem => {
    submenuitem.addEventListener("click", function() {
        submenuitem.classList.toggle("toggle");
    });
});

menu_btn.addEventListener("click", function(){
    barralateral.classList.toggle("oculto");
    document.getElementById("index-main").classList.toggle("oculto");
})
