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

import places from "places.js";
import L from "leaflet/dist/leaflet.js";
import { latLng } from "leaflet";
const Chart = require("chart.js");

try {
    function place() {
        var inputAlgolia = document.querySelector("#address");
        var latlng = {
            lat: 0,
            lng: 0
        };
        var placesAutocomplete = places({
            appId: "pl9SBUILJO03",
            apiKey: "707374d54fdaf7af334afaba53bce3c3",
            container: inputAlgolia,
            accessibility: {
                pinButton: {
                    "aria-label": "use browser geolocation",
                    "tab-index": 12
                },
                clearButton: {
                    "tab-index": 13
                }
            }
        });

        var address = document.querySelector("#address-value");

        placesAutocomplete.on("change", function(e) {
            latlng = {
                lat: e.suggestion.latlng.lat,
                lng: e.suggestion.latlng.lng
            };

            address = e.suggestion;
            console.log(latlng, address.value);
            //console.log(address);
            //console.log(this);
            document.querySelector("#latlong").value = [latlng.lat, latlng.lng];
        });

        placesAutocomplete.on("clear", function() {
            address.textContent = "none";
        });
    }
    place();
} catch {} //do nothing

try {
    let mobileNavbar = document.getElementById("mobile-navbar");

    let isMenuOpen = false;
    let btnHamburger = document.getElementById("hamburger-btn");
    btnHamburger.addEventListener("click", function() {
        if (isMenuOpen) {
            mobileNavbar.classList.remove("mobile-navbar--open");
        } else {
            mobileNavbar.classList.add("mobile-navbar--open");
        }
        isMenuOpen = !isMenuOpen;
    });
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

try {
    let animationService = document.getElementById("animation--service");

    let isFilterOpen = false;
    let btnFilter = document.getElementById("filter");
    btnFilter.addEventListener("click", function() {
        if (isFilterOpen) {
            animationService.classList.remove("animation--service--open");
        } else {
            animationService.classList.add("animation--service--open");
        }
        isFilterOpen = !isFilterOpen;
    });
} catch {} // do nothing

try {
    console.log(lat, lng);
    let map = mapView(lat, lng);
    populateMap(map);

    const Handlebars = require("handlebars");
    const source = document.getElementById("card-template").innerHTML;
    const template = Handlebars.compile(source);

    const form = document.getElementById("algoliaForm");

    function getLatLng(id) {
        return document.getElementById(id).value.split(",");
    }

    function getServices(className) {
        let services_array = [];
        Array.from(document.getElementsByClassName(className)).forEach(item => {
            if (item.checked) {
                services_array.push(item.value);
            }
        });
        return services_array.length ? services_array.join("-") : "0";
    }

    function getUrlApi() {
        const base_url =
            window.location.protocol +
            "//" +
            window.location.host +
            "/api/flats/?";
        let params = new URLSearchParams({
            lat: getLatLng("latlong")[0],
            lng: getLatLng("latlong")[1],
            rooms_min: document.querySelector("#rooms_min").value,
            beds_min: document.querySelector("#beds_min").value,
            required_services: getServices("service-checkbox"),
            distance: document.querySelector("#distance").value
        });
        return base_url + params;
    }

    function repopulateCards(data) {
        let container = document.getElementById("search-cards");
        container.innerHTML = template({ flats: data.response });
    }

    form.addEventListener("submit", e => {
        e.preventDefault()
        fetch(getUrlApi())
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok')
                }
                return response.json()
            })
            .then(data => {
                repopulateCards(data)
                document.querySelector(".map").innerHTML = '<div id="mapid"></div>'
                const [lat, lng] = document.getElementById("latlong").value.split(",")
                map = mapView(lat, lng)
                populateMap(map)
            })
            .catch(e => console.log(e))
    });
} catch {} // do nothing
