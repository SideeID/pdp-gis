var map = L.map("container_map", {}).setView(
    [-8.171530486265675, 113.69888061802416],
    12
);

L.control
    .fullscreen({
        position: "topright",
        title: "View Fullscreen",
    })
    .addTo(map);

var street = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {}).addTo(map)
var dark =  L.tileLayer('https://{s}.tile.jawg.io/jawg-dark/{z}/{x}/{y}{r}.png?access-token={accessToken}', {
	attribution: '',
	minZoom: 0,
	maxZoom: 22,
	subdomains: 'abcd',
	accessToken: 'PyTJUlEU1OPJwCJlW1k0NC8JIt2CALpyuj7uc066O7XbdZCjWEL3WYJIk6dnXtps'
});
var light = L.tileLayer('https://{s}.tile.jawg.io/jawg-light/{z}/{x}/{y}{r}.png?access-token={accessToken}', {
	attribution: '',
	minZoom: 0,
	maxZoom: 22,
	subdomains: 'abcd',
	accessToken: 'PyTJUlEU1OPJwCJlW1k0NC8JIt2CALpyuj7uc066O7XbdZCjWEL3WYJIk6dnXtps'
});

var world = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',{}); 

var baseMap = {
    "Street": street,
    "Light": light,
    "Dark": dark,
    "World": world
}

L.control.layers(baseMap).addTo(map);


// FeatureGroup is to store editable layers
var drawnItems = new L.FeatureGroup();
var allMap = new L.layerGroup();
map.addLayer(drawnItems);
var drawControl = new L.Control.Draw({
    draw: {
        polygon: true,
        polyline: true,
        rectangle: true,
        circle: false,
        marker: true,
        circlemarker: false
    },
    edit: {
        featureGroup: drawnItems,
    },
});
map.addControl(drawControl);

map.on("draw:created", function (e) {
    var layer = e.layer,
        feature = (layer.feature = layer.feature || {});

    feature.type = feature.layerType || "Feature";
    var props = (feature.properties = feature.properties || {});
    drawnItems.addLayer(layer);
});

const setDataMap = () => {
    var geojsonMap = drawnItems.toGeoJSON();

    if (geojsonMap.features.length != 0) {
        div_text.lastElementChild.innerHTML = JSON.stringify(geojsonMap);
        geojson.value = JSON.stringify(geojsonMap);

        div_text.firstElementChild.classList.replace("flex", "hidden");
        div_text.lastElementChild.classList.replace("hidden", "flex");
    } else {
        div_text.lastElementChild.innerHTML = "";
        geojson.value = "";

        div_text.lastElementChild.classList.replace("flex", "hidden");
        div_text.firstElementChild.classList.replace("hidden", "flex");
    }
    handleMap();
};

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
              (form.action = "/farm/create"))
            : undefined;

        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");
    }
};

const handleMap = () => {
    const bg = document.getElementById("bg_modal_map");
    const konten = document.getElementById("konten_modal_map");
    map.removeLayer(allMap)
    
    if (bg.classList.contains("opacity-0")) {
        divmap.lastElementChild.classList.replace('hidden', 'flex')
        map.addControl(drawControl)
        bg.classList.replace("opacity-0", "opacity-30");
        bg.classList.replace("pointer-events-none", "pointer-events-auto");

        konten.classList.replace("scale-0", "scale-100");
    } else {
        map.removeControl(drawControl)
        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");

        allMap.eachLayer(function(layer){
            allMap.removeLayer(layer)
        })
    }
};

$(function () {
    $("#cp")
        .colorpicker({
            inline: true,
            container: true,
            customClass: 'colorpicker-2x',
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
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    var ly = L.geoJSON(JSON.parse(item.geojson_data), {
        style: {
            color: item.color,
            fillColor: item.color,
            fillOpacity: 0.5,
        },
    }).bindPopup(item.name);

    // Aktifkan mode edit
    ly.eachLayer(function (layer) {
        drawnItems.addLayer(layer);
    });

    id.value = item.id;
    nama.value = item.name;
    alamat.value = item.address;
    geojson.value = item.geojson_data;
    kecamatan.value = item.subdistrict;
    kota.value = item.city;
    luas.value = item.area;
    warna.value = item.color;

    title.innerHTML = "Ubah Data";
    titleButton.innerHTML = "Ubah Data";

    div_text.lastElementChild.innerHTML = item.geojson_data;

    div_text.firstElementChild.classList.replace("flex", "hidden");
    div_text.lastElementChild.classList.replace("hidden", "flex");

    form.action = "/farm/update";

    handleModal();
};

const resetForm = () => {
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    id.value = "";
    nama.value = "";
    alamat.value = "";
    geojson.value = "";
    kecamatan.value = "";
    kota.value = "";
    luas.value = "";
    warna.value = "";

    div_text.lastElementChild.innerHTML = "";

    div_text.lastElementChild.classList.replace("flex", "hidden");
    div_text.firstElementChild.classList.replace("hidden", "flex");
};

const div_text = document.getElementById("geojsonCon");

const form = document.getElementById("form_farm");
const id = document.getElementById("id");
const nama = document.getElementById("nama");
const alamat = document.getElementById("alamat");
const geojson = document.getElementById("geojson");
const kecamatan = document.getElementById("kecamatan");
const kota = document.getElementById("kota");
const luas = document.getElementById("luas");
const warna = document.getElementById("color");

const title = document.getElementById("titleModal");
const titleButton = document.getElementById("titleButton");

const divmap = document.getElementById("konten_modal_map")

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

const showMap = (data) => {
    
    handleMap()
    map.removeControl(drawControl)
    map.addLayer(allMap)
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    divmap.lastElementChild.classList.replace('flex', 'hidden')

    data.forEach(element => {
        var layer = L.geoJSON(JSON.parse(element.geojson_data), {
            style: {
                color: element.color,
                fillColor: element.color,
                fillOpacity: 0.5,
            },
        }).bindTooltip(element.name, {
            permanent: true,
        }).bindPopup(element.name).addTo(allMap)
    });
}