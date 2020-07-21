function guestIndexPage(lat, lng) {
    function mapView(lat, lng) {
        const map = L.map("mapid").setView([lat, lng], 11);
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
        return map;
    }

    // inserimento marker su mappa
    function populateMap(map) {
        let cards = [...document.querySelectorAll(".card-row")];
        let cardsData = cards.map(card => {
            return {
                linkShow: card.getAttribute("href"),
                coordinates: card.getAttribute("data-coordinates")
            };
        });

        let markerIcon = L.icon({
            iconUrl: "../markerIcon/real-estate.png",
            iconSize: [50, 50],
            iconAnchor: [25, 50],
            popupAnchor: [0, -45]
        });

        cardsData.forEach(element => {
            const { linkShow, coordinates } = element;
            const [latitude, longitude] = coordinates
                .split("-")
                .map(item => parseFloat(item));
            let popup = L.popup().setContent(
                '<a href="' + linkShow + '">Appartamento</a>'
            );
            L.marker([latitude, longitude], { icon: markerIcon })
                .addTo(map)
                .bindPopup(popup);
        });
    }

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
            lat: getLatLng("inputAlgolia-search__latlong")[0],
            lng: getLatLng("inputAlgolia-search__latlong")[1],
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

    class InvalidParameters extends Error {}

    form.addEventListener("submit", e => {
        e.preventDefault();
        document
            .querySelector(".search-index__error")
            .classList.add("no-visibility");
        fetch(getUrlApi())
            .then(response => {
                if (!response.ok) throw new InvalidParameters();
                return response.json();
            })
            .then(data => {
                if (data.number_records !== 0) {
                    document.getElementById("less-flats").classList.remove('show');
                    repopulateCards(data);
                    document.querySelector(".map").innerHTML = '<div id="mapid"></div>';
                    const [lat, lng] = document.getElementById("inputAlgolia-search__latlong").value.split(",");
                    map = mapView(lat, lng);
                    populateMap(map);
                }
                else {
                    let container = document.getElementById("search-cards");
                    container.innerHTML = "";
                    document.querySelector(".map").innerHTML = "";
                    document.getElementById("less-flats").classList.add('show');
                }
            })
            .catch(e => {
                e instanceof InvalidParameters ?
                    document.querySelector(".search-index__error").classList.remove("no-visibility"):
                    console.log('Api error');
            });
    });

    // animazioni filtri ricerca
    let animationService = document.getElementById("animation--service");

    let isFilterOpen = false;
    let btnFilter = document.getElementById("filter");
    btnFilter.addEventListener("click", function() {
        isFilterOpen
            ? animationService.classList.remove("animation--service--open")
            : animationService.classList.add("animation--service--open");
        isFilterOpen = !isFilterOpen;
    });
}

export default guestIndexPage;
