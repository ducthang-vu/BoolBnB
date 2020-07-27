function guestIndexPage(lat, lng) {
    function mapView(latitude, longitude) {
        const map = L.map("mapid").setView([latitude, longitude], 11);
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
        let cards = [...document.querySelectorAll(".card-flat")];
        let cardsData = cards.map(card => {
            return {
                cardElement: card,
                img: card
                    .querySelector(".card__img-wrapper > img")
                    .getAttribute("src"),
                address: card.querySelector(".card__desc__address").innerHTML,
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
            const {
                cardElement,
                img,
                address,
                linkShow,
                coordinates
            } = element;
            const [latitude, longitude] = coordinates
                .split("-")
                .map(item => parseFloat(item));
            let popup = L.popup().setContent(
                `<img class="popup__image" src="${img}">
                <p>${address}</p>
                <a href="${linkShow}">Clicca qui per i dettagli</a>`
            );
            let marker = L.marker([latitude, longitude], { icon: markerIcon })
                .addTo(map)
                .bindPopup(popup);
            cardElement.addEventListener("mouseover", () => marker.openPopup());
            document
                .querySelector(".index-search")
                .addEventListener("mouseleave", () => marker.closePopup());
        });
    }

    function getLatLng(id) {
        return document.getElementById(id).value.split(",");
    }

    function getServices(className) {
        let services_array = [];
        Array.from(document.getElementsByClassName(className)).forEach(item => {
            item.checked && services_array.push(item.value);
        });
        return services_array.length ? services_array.join("-") : "0";
    }

    function getUrlApi(latitude, longitude) {
        const base_url =
            window.location.protocol +
            "//" +
            window.location.host +
            "/api/flats/?";
        let params = new URLSearchParams({
            lat: latitude || getLatLng("inputAlgolia-search__latlong")[0],
            lng: longitude || getLatLng("inputAlgolia-search__latlong")[1],
            rooms_min: document.querySelector("#rooms_min").value,
            beds_min: document.querySelector("#beds_min").value,
            required_services: getServices("service-checkbox"),
            distance: document.querySelector("#distance").value
        });
        return base_url + params;
    }

    function triggerAnimation(elementClassName, animationClassName) {
        const messageElements = document.getElementsByClassName(
            elementClassName
        );
        for (const element of messageElements) {
            element.classList.remove(animationClassName);
            void element.offsetWidth;
            element.classList.add(animationClassName);
        }
    }

    function remakeMapElement() {
        document.querySelector(".map").classList.remove("no-visibility");
        document.querySelector(".map").innerHTML = '<div id="mapid"></div>';
    }

    class InvalidParameters extends Error {}

    function handlingApiError(e) {
        e instanceof InvalidParameters
            ? document
                  .querySelector(".search-index__error")
                  .classList.remove("no-visibility")
            : console.log(e);
    }

    const Handlebars = require("handlebars");
    const template = Handlebars.compile(
        document.getElementById("card-template").innerHTML
    );
    function repopulateCards(data) {
        let container = document.getElementById("search-cards");
        container.innerHTML = template({ flats: data.response });
    }

    function handlingApiSuccess(data, latitude, longitude) {
        if (data.number_records) {
            repopulateCards(data);
            remakeMapElement();
            let lat, lng;
            if (latitude && longitude) {
                [lat, lng] = [latitude, longitude];
            } else {
                [lat, lng] = getLatLng("inputAlgolia-search__latlong");
            }
            const map = mapView(lat, lng);
            populateMap(map);
        } else {
            document.getElementById("search-cards").innerHTML = "";
            document.querySelector(".map").innerHTML = "";
            triggerAnimation("error-message", "message-animation");
        }
    }

    function fetchData(latitude, longitude) {
        document
            .querySelector(".search-index__error")
            .classList.add("no-visibility");
        fetch(getUrlApi(latitude, longitude))
            .then(response => {
                if (!response.ok) throw new InvalidParameters();
                return response.json();
            })
            .then(data => handlingApiSuccess(data, latitude, longitude))
            .catch(e => handlingApiError(e));
    }

    /*  On page load */
    fetchData(lat, lng);
    document.getElementById("algoliaForm").addEventListener("submit", e => {
        e.preventDefault();
        fetchData();
    });

    // animazioni filtri ricerca
    document.getElementById("filter").addEventListener("click", function() {
        this.isOpen = this.isOpen || false;
        const animationService = document.getElementById("animation--service");
        this.isOpen
            ? animationService.classList.remove("animation--service--open")
            : animationService.classList.add("animation--service--open");
        this.isOpen = !this.isOpen;
    });
    let slider = document.getElementById("distance");
    let distanceOutput = document.querySelector(".distanceVal");

    distanceOutput.innerHTML = slider.value;
    slider.oninput = function() {
        distanceOutput.innerHTML = this.value;
    };
}

export default guestIndexPage;
