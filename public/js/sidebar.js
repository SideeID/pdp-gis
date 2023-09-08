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

// It's best to inline this in `head` to avoid FOUC (flash of unstyled content) when changing pages or themes
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}

var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

// Change the icons inside the button based on previous settings
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    themeToggleLightIcon.classList.remove("hidden");
} else {
    themeToggleDarkIcon.classList.remove("hidden");
}

var themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    // if set via local storage previously
    if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        }

        // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        } else {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        }
    }
});
