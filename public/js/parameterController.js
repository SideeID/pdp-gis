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
              (form.action = "/parameter/create"))
            : undefined;

        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");

    }
};

$(function () {
    $("#cp")
        .colorpicker({
            inline: true,
            container: true,
            extensions: [
                {
                    name: "swatches",
                    options: {
                        colors: {
                            tetrad1: "#000",
                            tetrad2: "#000",
                            tetrad3: "#000",
                            tetrad4: "#000",
                        },
                        namesAsValues: false,
                    },
                },
            ],
        })
        .on("colorpickerChange colorpickerCreate", function (e) {
            e.preventDefault();
            var colors = e.color.generate("tetrad");

            colors.forEach(function (color, i) {
                var colorStr = color.string(),
                    swatch = e.colorpicker.picker.find(
                        '.colorpicker-swatch[data-name="tetrad' + (i + 1) + '"]'
                    );

                swatch
                    .attr("data-value", colorStr)
                    .attr("title", colorStr)
                    .find("> i")
                    .css("background-color", colorStr);
            });
        });
});

function validateNumberInput(input) {
    var inputValue = input.value;

    // Menghilangkan semua karakter selain angka dan titik (.)
    inputValue = inputValue.replace(/[^0-9.]/g, "");

    // Memastikan hanya ada satu titik (.) dalam input
    if (inputValue.startsWith(".")) {
        inputValue = inputValue.substring(1); // Hapus titik di awal karakter
    }

    var parts = inputValue.split(".");
    if (parts.length > 2) {
        // Jika terdapat lebih dari satu titik (.), maka hanya gunakan yang pertama
        inputValue = parts[0] + "." + parts.slice(1).join("");
    }

    // Mengganti nilai input dengan hasil yang sudah diubah
    input.value = inputValue;
}

const handleData = () => {
    const err = cekJikaKosong([
        ph_bawah, 
        ph_atas,
        suhu_bawah,
        suhu_atas,
        hujan_bawah,
        hujan_atas,
        ketinggian_bawah,
        ketinggian_atas,
        warna,
    ]);

    if (err) {
        Swal.fire("Informasi", err, "warning")
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
            return "Field " + element.getAttribute('key') + " tidak boleh kosong";
        }
    }

    return;
};

const handleEdit = (item) => {
    console.log(item);
    id.value = item.id;
    ph_bawah.value = item.ph_a
    ph_atas.value = item.ph_b
    suhu_bawah.value = item.suhu_a
    suhu_atas.value = item.suhu_b
    hujan_bawah.value = item.hujan_a
    hujan_atas.value = item.hujan_b
    ketinggian_bawah.value = item.tinggi_a
    ketinggian_atas.value = item.tinggi_b
    warna.value = item.color;

    title.innerHTML = "Ubah Data";
    titleButton.innerHTML = "Ubah Data";

    form.action = "/parameter/update";

    handleModal();
};

const resetForm = () => {

    id.value = "";
    ph_bawah.value = ""
    ph_atas.value = ""
    suhu_bawah.value = ""
    suhu_atas.value = ""
    hujan_bawah.value = ""
    hujan_atas.value = ""
    ketinggian_bawah.value = ""
    ketinggian_atas.value = ""
    warna.value = "";
};

const form = document.getElementById("form_parameter");
const id = document.getElementById("id");
const ph_bawah = document.getElementById("ph_bawah");
const ph_atas = document.getElementById("ph_atas");
const suhu_bawah = document.getElementById("suhu_bawah");
const suhu_atas = document.getElementById("suhu_atas");
const hujan_bawah = document.getElementById("hujan_bawah");
const hujan_atas = document.getElementById("hujan_atas");
const ketinggian_bawah = document.getElementById("ketinggian_bawah");
const ketinggian_atas = document.getElementById("ketinggian_atas");
const warna = document.getElementById("color");

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
        location.replace("/parameter/" + $("#keyword").val());
    }
});
