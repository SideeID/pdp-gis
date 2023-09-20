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

document.getElementById('logout-button').addEventListener('click', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Keluar',
        text: 'Apakah Anda yakin ingin keluar dari akun Anda?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-logout').submit();
        }
    });
});