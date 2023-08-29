const sidebar = document.getElementById("sidebar");
const bg = document.getElementById("bgsidebar");
const handleSidebar = () => {
    if (sidebar.classList.contains("-translate-x-[400px]")) {
        sidebar.classList.replace("-translate-x-[400px]", "translate-x-0");
        bg.classList.replace("opacity-0", "opacity-30");
        bg.classList.replace("pointer-events-none", "pointer-events-auto");
    } else {
        sidebar.classList.replace("translate-x-0", "-translate-x-[400px]");
        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");
    }
};

window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.replace("translate-x-0", "-translate-x-[400px]");
        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");
    }
});
