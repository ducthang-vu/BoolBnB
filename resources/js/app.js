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

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
const app = new Vue({
    el: '#app',
});
*/
import hamburgerHeader from "./blade-components/hamburgerHeader";

import L from "leaflet/dist/leaflet.js";
import { latLng } from "leaflet";
const Chart = require("chart.js");

import place from "./blade-components/inputAlgolia";
import formAlgoliaHome from "./blade-components/formAlgoliaHome";
import guestIndexPage from "./blade-components/guestIndexPage";
import showRequestMessage from "./blade-components/requestsIndex";
import adminSponsorshipsCreate from "./blade-components/adminSponsorshipCreate";


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
    guestIndexPage(lat, lng);
}

if (document.querySelector(".request-message-handler")) {
    showRequestMessage();
}

if (document.querySelector('.adminSponsorshipsCreate')) {
    adminSponsorshipsCreate()
}

try {
    const canvasVisualisations = document.getElementById(
        "chart-visualisations"
    );
    const canvasNumberOfRequests = document.getElementById(
        "chart-numberOfRequests"
    );

    const chartVisualisations = new Chart(canvasVisualisations, {
        type: "bar",
        data: {
            datasets: [
                {
                    //barPercentage: 0.5,
                    //barThickness: 6,
                    //maxBarThickness: 8,
                    //minBarLength: 2,
                    data: [visualisations],
                    labels: ["visualisations"]
                }
            ]
        }
    });

    const chartNumberOfRequests = new Chart(canvasNumberOfRequests, {
        type: "bar",
        data: {
            datasets: [
                {
                    //barPercentage: 0.5,
                    //barThickness: 6,
                    //maxBarThickness: 8,
                    //minBarLength: 2,
                    data: [numberOrRequests],
                    labels: ["number or requests"]
                }
            ]
        }
    });
} catch {} // do nothing
