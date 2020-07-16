import places from "places.js";

function place() {
    const inputAlgolia = document.querySelector("#address");

    // init places
    let placesAutocomplete = places({
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

    // get lat long
    placesAutocomplete.on("change", function(e) {
        document.querySelector("#inputAlgolia-search__latlong").value = [
            e.suggestion.latlng.lat,
            e.suggestion.latlng.lng
        ];
    });

    placesAutocomplete.on("clear", function() {
        address.textContent = "none";
    });
}

export default place;
