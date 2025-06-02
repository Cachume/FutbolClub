const submenudrop = document.querySelectorAll(".menu-dropdown");

submenudrop.forEach(submenuitem => {
    submenuitem.addEventListener("click", function() {
        submenuitem.classList.toggle("toggle");
    });
});
