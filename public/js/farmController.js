
var map = L.map('map', {
}).setView([-8.171530486265675, 113.69888061802416], 12);


L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);