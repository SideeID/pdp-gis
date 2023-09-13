// const handleData = () => {
//     const err = cekJikaKosong([
//         nama,
//         email,
//         id,
//     ]);

//     if (err) {
//         Swal.fire("Informasi", err, "warning");
//     } else {
//         // jika tidak kosong
//         Swal.fire({
//             title: "Konfirmasi",
//             text: `Apakah anda yakin ingin ${
//                 title.innerHTML == "Tambah Data" ? "menambah" : "mengubah"
//             } data?`,
//             icon: "question",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Ya",
//             cancelButtonText: "Tidak",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 form.submit();
//             }
//         });
//     }
// };

// const cekJikaKosong = (array) => {
//     for (let index = 0; index < array.length; index++) {
//         const element = array[index];
//         if (element.value == "") {
//             return "Field " + element.name + " tidak boleh kosong";
//         }
//     }
//     return;
// };

// // const handleEdit = (item) => {

// //     nama.value = item.name;
// //     email.value = item.email;
// //     nomor.value = item.id;

// //     title.innerHTML = "Ubah Data";
// //     titleButton.innerHTML = "Ubah Data";


// //     form.action = "/user/update";

// //     handleModal();
// // };

// const handleEdit = (item) => {
//     nama.value = item.name;
//     email.value = item.email;
//     id.value = item.id;

//     title.innerHTML = "Ubah Data";
//     titleButton.innerHTML = "Ubah Data";

//     form.action = "/user/update";

//     handleModal();
// };


// const resetForm = () => {
//     nama.value = "";
//     email.value = "";
//     id.value = "";
//     div_text.lastElementChild.innerHTML = "";

//     div_text.lastElementChild.classList.replace("flex", "hidden");
//     div_text.firstElementChild.classList.replace("hidden", "flex");
// };

// const form = document.getElementById("form_user");
// const id = document.getElementById("id");
// const nama = document.getElementById("nama");
// const email = document.getElementById("email");
// const title = document.getElementById("titleModal");
// const titleButton = document.getElementById("titleButton");
// const div_text = document.getElementById("geojsonCon");

// const handleModal = () => {
//     const bg = document.getElementById("bg_modal");
//     const konten = document.getElementById("konten_modal");

//     if (bg.classList.contains("opacity-0")) {
//         bg.classList.replace("opacity-0", "opacity-30");
//         bg.classList.replace("pointer-events-none", "pointer-events-auto");
//         konten.classList.replace("scale-0", "scale-100");
        
//     } else {
//         // console.log("Tombol 'X' diklik");
//         title.innerHTML == "Ubah Data"
//             ? (resetForm(),
//               (title.innerHTML = "Tambah Data"),
//               (titleButton.innerHTML = "Tambah Data"),
//               (form.action = "/user/create"))
//             : undefined;

//         bg.classList.replace("opacity-30", "opacity-0");
//         bg.classList.replace("pointer-events-auto", "pointer-events-none");
//         konten.classList.replace("scale-100", "scale-0");
        
//     }
// };

// const validateNumberInput = (input) => {
//     input.value = input.value.replace(/[^0-9]/g, "");
// };

// const deleteSelection = () => {
//     if ($("table").find("tbody :checkbox:checked").length == 0) {
//         Swal.fire("Informasi", "Pilih data yang ingin dihapus", "info");
//     } else {
//         Swal.fire({
//             title: "Konfirmasi",
//             text: "Apakah anda yakin ingin menghapus data yang dipilih?",
//             icon: "question",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Ya",
//             cancelButtonText: "Tidak",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $("#form_delete").trigger("submit");
//             }
//         }); 
//     }
// };

// const deleteData = (url) => {
//     Swal.fire({
//         title: "Hapus Data",
//         text: "Apakah anda yakin ingin menghapus data?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonText: "Tidak",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Ya",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             location.href = window.location.origin + url;
//         }
//     });
// };

// $("#checkAll").on("click", function () {
//     $(this)
//         .closest("table")
//         .find("tbody :checkbox")
//         .prop("checked", this.checked)
//         .closest("tr")
//         .toggleClass("selected", this.checked);
// });

// $("tbody :checkbox").on("click", function () {
//     $(this).closest("tr").toggleClass("selected", this.checked);

//     $(this)
//         .closest("table")
//         .find("#checkAll")
//         .prop(
//             "checked",
//             $(this).closest("table").find("tbody :checkbox:checked").length ==
//                 $(this).closest("table").find("tbody :checkbox").length
//         );
// });

// $(document).keyup(function (event) {
//     if ($("#keyword").is(":focus") && event.key == "Enter") {
//         location.replace("/user/" + $("#keyword").val());
//     }
// });


// const form = document.getElementById("form_user");
// const idInput = document.getElementById("id");
// const namaInput = document.getElementById("nama");
// const emailInput = document.getElementById("email");
// const title = document.getElementById("titleModal");
// const titleButton = document.getElementById("titleButton");
// const div_text = document.getElementById("geojsonCon");


const handleModal = () => {
    const bg = document.getElementById("bg_modal");
    const konten = document.getElementById("konten_modal");

    if (bg.classList.contains("opacity-0")) {
        bg.classList.replace("opacity-0", "opacity-30");
        bg.classList.replace("pointer-events-none", "pointer-events-auto");

        konten.classList.replace("scale-0", "scale-100");
    } else {
        title.innerHTML == "Ubah Data"
            ? (resetForm(),
              (title.innerHTML = "Tambah Data"),
              (titleButton.innerHTML = "Tambah Data"),
              (form.action = "/user/create"))
            : undefined;

        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");
    }
};


function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, ""); // Remove non-numeric characters
}

const handleData = () => {
    const err = cekJikaKosong([
        nama,
        email,
    ]);

    if (err) {
        Swal.fire("Informasi", err, "warning");
    } else {
        // jika tidak kosong
        Swal.fire({
            title: "Konfirmasi",
            text: `Apakah anda yakin ingin ${
                title.innerHTML == "Tambah Data" ? "menambah" : "mengubah"
            } data?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
};


const cekJikaKosong = (array) => {
    for (let index = 0; index < array.length; index++) {
        const element = array[index];
        if (element.value == "") {
            return "Field " + element.name + " tidak boleh kosong";
        }
    }

    return;
};

const handleEdit = (item) => {
    nama.value = item.name;
    email.value = item.email;
    id.value = item.id;

    title.innerHTML = "Ubah Data";
    titleButton.innerHTML = "Ubah Data";

    form.action = "/user/update";

    handleModal();
};

const resetForm = () => {
    nama.value = "";
    email.value = "";
    id.value = "";
};


const form = document.getElementById("form_user");
const id = document.getElementById("id");
const nama = document.getElementById("nama");
const email = document.getElementById("email");

const title = document.getElementById("titleModal");
const titleButton = document.getElementById("titleButton");

$("#checkAll").on("click", function () {
    $(this)
        .closest("table")
        .find("tbody :checkbox")
        .prop("checked", this.checked)
        .closest("tr")
        .toggleClass("selected", this.checked);
});

$("tbody :checkbox").on("click", function () {
    $(this).closest("tr").toggleClass("selected", this.checked); //Classe de seleção na row

    $(this)
        .closest("table")
        .find("#checkAll")
        .prop(
            "checked",
            $(this).closest("table").find("tbody :checkbox:checked").length ==
                $(this).closest("table").find("tbody :checkbox").length
        ); //Tira / coloca a seleção no .checkAll
});

const deleteSelection = () => {
    if ($("table").find("tbody :checkbox:checked").length == 0) {
        Swal.fire("Informasi", "Pilih data yang ingin dihapus", "info");
    } else {
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data yang dipilih?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form_delete").trigger("submit");
            }
        }); 
    }
};

const deleteData = (url) => {
    Swal.fire({
        title: "Hapus Data",
        text: "Apakah anda yakin ingin menghapus data?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonText: "Tidak",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = window.location.origin + url;
        }
    });
};

$(document).keyup(function (event) {
    if ($("#keyword").is(":focus") && event.key == "Enter") {
        location.replace("/user/" + $("#keyword").val());
    }
});