var map = L.map("container_map", {
}).setView(
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
        polygon: false,
        polyline: false,
        rectangle: false,
        circle: false,
        marker: true,
        circlemarker: false,
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
    // console.log(geojsonMap);

    if (geojsonMap.features.length != 0) {
        div_text.lastElementChild.innerHTML = JSON.stringify(geojsonMap);
        geojson.value = JSON.stringify(geojsonMap);

        latitude.value = geojsonMap.features[0].geometry.coordinates[1];
        longtitude.value = geojsonMap.features[0].geometry.coordinates[0];

        div_text.firstElementChild.classList.replace("flex", "hidden");
        div_text.lastElementChild.classList.replace("hidden", "flex");
    } else {
        div_text.lastElementChild.innerHTML = "";
        geojson.value = "";

        latitude.value = "";
        longtitude.value = "";

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
              (form.action = "/afdeling/create"))
            : undefined;

        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");
    }
};

const handleMap = () => {
    const bg = document.getElementById("bg_modal_map");
    const konten = document.getElementById("konten_modal_map");
    map.removeLayer(allMap);

    if (bg.classList.contains("opacity-0")) {
        divmap.lastElementChild.classList.replace("hidden", "flex");
        map.addControl(drawControl);
        bg.classList.replace("opacity-0", "opacity-30");
        bg.classList.replace("pointer-events-none", "pointer-events-auto");

        konten.classList.replace("scale-0", "scale-100");
    } else {
        map.removeControl(drawControl);
        bg.classList.replace("opacity-30", "opacity-0");
        bg.classList.replace("pointer-events-auto", "pointer-events-none");

        konten.classList.replace("scale-100", "scale-0");

        allMap.eachLayer(function (layer) {
            allMap.removeLayer(layer);
        });
    }
};

function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9\d.]/g, ""); // Remove non-numeric characters
}

const handleData = () => {
    const err = cekJikaKosong([
        kebun,
        afdeling,
        deskripsi,
        latitude,
        longtitude,
        ketinggian,
        luas,
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

const handleEdit = (item, kebunnn) => {
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    var ly = L.marker([item.latitude, item.longtitude]);


    const afdel = kebunnn.filter(
        (elemen) => elemen.id == item.afdeling.farm.id
    )[0];
    var kontenHtml = "";

    if (afdel) {
        afdel.afdeling.forEach((element) => {
            kontenHtml += `<option value="${element.id}">${element.name}</option>`;
        });
    }

    afdeling.innerHTML = kontenHtml;

    drawnItems.addLayer(ly);
    id.value = item.id;
    kebun.value = item.afdeling.farm.id;
    afdeling.value = item.afdeling.id;

    deskripsi.value = item.description;
    blok.value = item.name;
    latitude.value = item.latitude;
    longtitude.value = item.longtitude;
    ketinggian.value = item.elevation;
    luas.value = item.area;

    title.innerHTML = "Ubah Data";
    titleButton.innerHTML = "Ubah Data";

    form.action = "/block/update";

    handleModal();
};

const resetForm = () => {
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    id.value = "";
    kebun.value = "";
    afdeling.value = "";
    deskripsi.value = "";
    blok.value = "";
    latitude.value = "";
    longtitude.value = "";
    geojson.value = "";
    ketinggian.value = "";
    luas.value = "";

    afdeling.innerHTML = "";

    div_text.lastElementChild.innerHTML = "";

    div_text.lastElementChild.classList.replace("flex", "hidden");
    div_text.firstElementChild.classList.replace("hidden", "flex");
};

const div_text = document.getElementById("geojsonCon");

const form = document.getElementById("form_block");
const id = document.getElementById("id");
const blok = document.getElementById("blok");
const kebun = document.getElementById("kebun");
const deskripsi = document.getElementById("deskripsi");
const afdeling = document.getElementById("afdeling");
const latitude = document.getElementById("latitude");
const geojson = document.getElementById("geojson");
const longtitude = document.getElementById("longtitude");
const ketinggian = document.getElementById("ketinggian");
const luas = document.getElementById("luas");

const title = document.getElementById("titleModal");
const titleButton = document.getElementById("titleButton");

const divmap = document.getElementById("konten_modal_map");

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
        location.replace("/block/" + $("#keyword").val());
    }
});

const showMap = (data) => {
    handleMap();
    map.removeControl(drawControl);
    map.addLayer(allMap);
    drawnItems.eachLayer(function (layer) {
        drawnItems.removeLayer(layer);
    });

    divmap.lastElementChild.classList.replace("flex", "hidden");

    console.log(data);

    data.forEach((element) => {
        L.marker([element.latitude, element.longtitude])
            .bindPopup(element.name)
            .bindTooltip(element.name, {
                permanent: true,
            })
            .addTo(allMap);
    });
};
const dataFarm = (data, afdeling) => {
    afdeling.forEach((element) => {
        var layer = L.geoJSON(JSON.parse(element.geojson_data), {
            style: {
                color: element.color,
                fillColor: element.color,
                fillOpacity: 0.5,
            },
        })
            .bindTooltip(element.name, {
                permanent: true,
            })
            .bindPopup(element.name)
            .addTo(map);
    });

    data.forEach((element) => {
        var layer = L.geoJSON(JSON.parse(element.geojson_data), {
            style: {
                color: element.color,
                fillColor: element.color,
                fillOpacity: 0.5,
            },
        })
            .bindTooltip(element.name, {
                permanent: true,
            })
            .bindPopup(element.name)
            .addTo(map);
    });
};

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
