document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.getElementById("nav-links");
    const toggleBtn = document.getElementById("toggle-btn");

    toggleBtn.addEventListener("click", function() {
        navLinks.classList.toggle("open");
    });
});