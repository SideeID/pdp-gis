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

var street = L.tileLayer(
    "https://tile.openstreetmap.org/{z}/{x}/{y}.png",
    {}
).addTo(map);
var dark = L.tileLayer(
    "https://{s}.tile.jawg.io/jawg-dark/{z}/{x}/{y}{r}.png?access-token={accessToken}",
    {
        attribution: "",
        minZoom: 0,
        maxZoom: 22,
        subdomains: "abcd",
        accessToken:
            "PyTJUlEU1OPJwCJlW1k0NC8JIt2CALpyuj7uc066O7XbdZCjWEL3WYJIk6dnXtps",
    }
);
var light = L.tileLayer(
    "https://{s}.tile.jawg.io/jawg-light/{z}/{x}/{y}{r}.png?access-token={accessToken}",
    {
        attribution: "",
        minZoom: 0,
        maxZoom: 22,
        subdomains: "abcd",
        accessToken:
            "PyTJUlEU1OPJwCJlW1k0NC8JIt2CALpyuj7uc066O7XbdZCjWEL3WYJIk6dnXtps",
    }
);

var world = L.tileLayer(
    "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
    {}
);

var baseMap = {
    Street: street,
    Light: light,
    Dark: dark,
    World: world,
};

L.control.layers(baseMap).addTo(map);

const setDataMap = (data, kebun) => {
    console.log(data);
    kebun.forEach((element) => {
        var ly = L.geoJSON(JSON.parse(element.geojson_data), {
            style: {
                color: "#ffffff",
                fillColor: "#ffffff",
                fillOpacity: 0.5,
            },
        })
            .bindTooltip(element.name, {
                permanent: true,
            })
            .bindPopup(
                `<table>
                    <tr>
                        <td class="font-poppins-semibold" colspan="3">${element.name}</td>
                    </tr>
                    <tr>
                        <td class="">Kecamatan</td>
                        <td class="pr-1">:</td>
                        <td class="">${element.subdistrict}</td>
                    </tr>
                    <tr>
                        <td class="">Kota</td>
                        <td class="pr-1">:</td>
                        <td class="">${element.city}</td>
                    </tr>
                    <tr>
                        <td class="">Luas</td>
                        <td class="pr-1">:</td>
                        <td class="">${element.area}</td>
                    </tr>
                    
                </table>`
            )
            .addTo(map);
    });

    data.data.forEach((element) => {
        var ph = data.kriteria
            .filter((item) => item.id == 4)[0]
            .detail_criteria.filter(
                (item) => item.class == element.ph_kelas
            )[0];
        var suhu = data.kriteria
            .filter((item) => item.id == 3)[0]
            .detail_criteria.filter(
                (item) => item.class == element.suhu_kelas
            )[0];
        var hujan = data.kriteria
            .filter((item) => item.id == 2)[0]
            .detail_criteria.filter(
                (item) => item.class == element.hujan_kelas
            )[0];
        var tinggi = data.kriteria
            .filter((item) => item.id == 1)[0]
            .detail_criteria.filter(
                (item) => item.class == element.tinggi_kelas
            )[0];

        if (!ph) {
            ph = "Tidak diketahui";
        } else if (!suhu) {
            suhu = "Tidak diketahui";
        } else if (!hujan) {
            hujan = "Tidak diketahui";
        } else if (!tinggi) {
            tinggi = "Tidak diketahui";
        }

        var ly = L.geoJSON(JSON.parse(element.afdeling.geojson_data), {
            style: {
                color: element.parameter.plant.color,
                fillColor: element.parameter.plant.color,
                fillOpacity: 0.5,
            },
        })
            .bindTooltip(element.afdeling.name, {
                permanent: true,
            })
            .bindPopup(
                `<table>
                    <tr>
                        <td class="font-poppins-semibold" colspan="3">${element.afdeling.name}</td>
                    </tr>
                    <tr>
                        <td class="">pH Tanah</td>
                        <td class="pr-1">:</td>
                        <td class="">${ph.description}</td>
                    </tr>
                    <tr>
                        <td class="">Suhu</td>
                        <td class="pr-1">:</td>
                        <td class="">${suhu.description}</td>
                    </tr>
                    <tr>
                        <td class="">Curah Hujan</td>
                        <td class="pr-1">:</td>
                        <td class="">${hujan.description}</td>
                    </tr>
                    <tr>
                        <td class="">Ketinggian</td>
                        <td class="pr-1">:</td>
                        <td class="">${tinggi.description}</td>
                    </tr>
                    <tr>
                        <td class="font-poppins-semibold">Hasil</td>
                        <td class="pr-1">:</td>
                        <td class="">${element.parameter.plant.name}</td>
                    </tr>
                </table>`
            )
            .addTo(map);
    });
};
