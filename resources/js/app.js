/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import page from "./adminFlatStatistics";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if (document.querySelector(".adminFlatStatistics")) {
    const app = new Vue({
        el: "#root",
        render: h => h(page)
    });
}

import L from "leaflet/dist/leaflet.js";
import { latLng } from "leaflet";
const Chart = require("chart.js");

import place from "./blade-components/inputAlgolia";
import mapView from "./blade-components/inputAlgolia";
import formAlgoliaHome from "./blade-components/formAlgoliaHome";
import guestIndexPage from "./blade-components/guestIndexPage";
import showRequestMessage from "./blade-components/requestsIndex";
import adminSponsorshipsCreate from "./blade-components/adminSponsorshipCreate";
import hamburgerHeader from "./blade-components/hamburgerHeader";

if (document.querySelector(".main-header")) {
    hamburgerHeader();
}

if (document.querySelector(".inputAlgolia-page")) {
    place();
}

if (document.querySelector(".formAlgoliaHome-page")) {
    formAlgoliaHome();
}

if (document.querySelector(".formAlgoliaIndex-page")) {
    guestIndexPage(lat, lng); // lat lng in mapAlgolia.blade
}

if (document.querySelector(".requestsIndex-page")) {
    showRequestMessage();
}

if (document.querySelector(".adminSponsorshipsCreate")) {
    adminSponsorshipsCreate();
}

if (document.querySelector(".cardFlatShow-page")) {
    let lat = document.querySelector("#lat").value;
    let lng = document.querySelector("#lng").value;
    let iconPath = "../markerIcon/real-estate.png";
    if (window.location.href.indexOf("admin")) {
        iconPath = "../" + iconPath;
    }
    mapShow(lat, lng, iconPath);
}

/***********
 * Functions
 **********/

// Show map on flat details page
function mapShow(lat, lng, iconPath) {
    const map = L.map("mapid").setView([lat, lng], 13);
    L.tileLayer(
        "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
        {
            attribution:
                'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: "mapbox/streets-v11",
            tileSize: 512,
            zoomOffset: -1,
            accessToken:
                "pk.eyJ1IjoibXJycmNyIiwiYSI6ImNrY2s5bzR6bTB3M2YycnA1NWw5aHA4OHkifQ.7HEn8X3Ar9s98VkVMiKcVw"
        }
    ).addTo(map);

    let markerIcon = L.icon({
        iconUrl: iconPath,
        iconSize: [50, 50],
        iconAnchor: [25, 50]
    });

    L.marker([lat, lng], { icon: markerIcon }).addTo(map);

    return map;
}
