import 'leaflet/dist/leaflet.css'
import L from 'leaflet'

let map = document.querySelector('#map')
let center = [map.dataset.lat, map.dataset.lng]

map = L.map('map').setView(center, 13)

let icon = L.icon({
    iconUrl: '/images/marker-icon.png',
    shadowUrl: '/images/marker-shadow.png',
});

// MapBox
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    minZoom: 12,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoibmtveWFuIiwiYSI6ImNqdzNtajNtdDAxZ240YW1zbDZwZDl1ZWEifQ.df5D8AuLfYR6sRUzy83V0A'
}).addTo(map);

// OpenSreetMap
/*L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 18,
    minZoom: 12
}).addTo(map);*/

// Marker
L.marker(center, {icon: icon}).addTo(map)