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

import L from "leaflet/dist/leaflet.js";
import { latLng } from "leaflet";
const Chart = require("chart.js");

import place from "./blade-components/inputAlgolia";
import formAlgoliaHome from "./blade-components/formAlgoliaHome";
import guestIndexPage from "./blade-components/guestIndexPage";

if (document.querySelector(".inputAlgolia-page")) {
    place();
}

if (document.querySelector(".formAlgoliaHome-page")) {
    formAlgoliaHome();
}

if (document.querySelector(".formAlgoliaIndex-page")) {
    console.log("prova 1", lat);
    guestIndexPage(lat, lng);
}

try {
    let mobileNavbar = document.getElementById("mobile-navbar");

    let isMenuOpen = false
    let btnHamburger = document.getElementById('hamburger-btn');

    var btnLogin = document.querySelector('.hamburger #login-button');

    var btnRegister = document.querySelector('.hamburger #register-button');

    btnHamburger.addEventListener('click', function() {
        mobileNavbar.classList.toggle('show');
    })

    btnLogin.addEventListener('click', function() {
        if (mobileNavbar.classList.contains('show')) {
            mobileNavbar.classList.remove('show');
        }
    })

    btnRegister.addEventListener('click', function() {
        if (mobileNavbar.classList.contains('show')) {
            mobileNavbar.classList.remove('show');
        }
    })

} catch {} // do nothing

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
