
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
              (form.action = "/perhitungan/create"))
            : undefined;

        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");
    }
};

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
        kebun,
        afdeling,
        ph,
        suhu_bawah,
        suhu_atas,
        hujan,
        ketinggian
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

const handleEdit = (item, kebunnn) => {
    const afdel = kebunnn.filter(
        (elemen) => elemen.id == item.afdeling.farm.id
    )[0];
    var kontenHtml = "";

    if (afdel) {
        afdel.afdeling.forEach((element) => {
            kontenHtml += `<option value="${element.id}">${element.name}</option>`;
        });
    }

    kontenHtml += `<option value="${item.afdeling.id}">${item.afdeling.name}</option>`

    afdeling.innerHTML = kontenHtml;

    id.value = item.id;
    kebun.value = item.afdeling.farm.id;
    afdeling.value = item.afdeling.id;
    ph.value = item.ph
    suhu_bawah.value = item.suhu_a
    suhu_atas.value = item.suhu_b
    hujan.value = item.hujan
    ketinggian.value = item.tinggi

    title.innerHTML = "Ubah Data";
    titleButton.innerHTML = "Ubah Data";

    form.action = "/perhitungan/update";

    handleModal();
};

const resetForm = () => {

    id.value = "";
    kebun.value = "";
    afdeling.value = "";
    ph.value = ""
    suhu_bawah.value = ""
    suhu_atas.value = ""
    hujan.value = ""
    ketinggian.value = ""

    afdeling.innerHTML = "";

};

const form = document.getElementById("form_perhitungan");
const id = document.getElementById("id");
const kebun = document.getElementById("kebun");
const afdeling = document.getElementById("afdeling");
const ph = document.getElementById("ph");
const suhu_bawah = document.getElementById("suhu_bawah");
const suhu_atas = document.getElementById("suhu_atas");
const hujan = document.getElementById("hujan");
const ketinggian = document.getElementById("ketinggian");

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
        location.replace("/perhitungan/" + $("#keyword").val());
    }
});

const pilihAfdeling = (e) => {
    if (e.children.length == 0) {
        Swal.fire(
            "Informasi",
            "Tidak ada data afdeling pada kebun yang dipilih",
            "info"
        );
    }
};

const pilihKebun = (e) => {
    const afdel = e.filter((elemen) => elemen.id == kebun.value)[0];
    var kontenHtml = "";

    if (afdel) {
        afdel.afdeling.forEach((element) => {
            kontenHtml += `<option value="${element.id}">${element.name}</option>`;
        });
    }

    afdeling.innerHTML = kontenHtml;
};

const addPerhitungan = (value) => {
    if(value == 0){
        Swal.fire({
            title: "Tidak ada parameter",
            text: "Butuh setidaknya terdapat satu data parameter",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonText: "Tutup",
            cancelButtonColor: "#d33",
            confirmButtonText: "Tambah parameter",
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '/parameter'
            }
        });
    } else {
        handleModal()
    }
}