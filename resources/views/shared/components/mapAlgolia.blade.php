<div id="mapid"></div>

    <script>
        let lat = '{{ $latlong[0] }}';
        let lng = '{{ $latlong[1] }}';

        function mapView(lat, lng) {
        // Leaflet Map
        const map = L.map('mapid').setView([lat, lng], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibXJycmNyIiwiYSI6ImNrY2s5bzR6bTB3M2YycnA1NWw5aHA4OHkifQ.7HEn8X3Ar9s98VkVMiKcVw'
        }).addTo(map);

        let cards = [...document.querySelectorAll('.card')];
        let cardsData = cards.map(card => {
            return {
                linkShow: card.getAttribute('href'),
                coordinates: card.getAttribute('data-coordinates')
            }
        });

        cardsData.forEach(element => {
            const { linkShow, coordinates } = element;
            [ lat, lng ] = coordinates.split('-');
            let popup = L.popup().setContent('<a href="' + linkShow + '">Appartamento</a>');
            L.marker([lat, lng]).addTo(map).bindPopup(popup);
            });
        }
    </script>
