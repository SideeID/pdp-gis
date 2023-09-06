
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
    input.value = input.value.replace(/[^0-9\d.]/g, ""); // Remove non-numeric characters
}

const handleData = () => {
    const err = cekJikaKosong([
        nama,
        alamat,
        geojson,
        kecamatan,
        kota,
        luas,
        warna,
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

    id.value = item.id;
    nama.value = item.name;
    alamat.value = item.address;
    kecamatan.value = item.subdistrict;
    kota.value = item.city;
    luas.value = item.area;
    warna.value = item.color;

    title.innerHTML = "Ubah Data";
    titleButton.innerHTML = "Ubah Data";


    form.action = "/parameter/update";

    handleModal();
};

const resetForm = () => {
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    id.value = "";
    nama.value = "";
    alamat.value = "";
    kecamatan.value = "";
    kota.value = "";
    luas.value = "";
    warna.value = "";

};

const form = document.getElementById("form_farm");
const id = document.getElementById("id");
const nama = document.getElementById("nama");
const alamat = document.getElementById("alamat");
const kecamatan = document.getElementById("kecamatan");
const kota = document.getElementById("kota");
const luas = document.getElementById("luas");
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
        location.replace("/farm/" + $("#keyword").val());
    }
});
