@extends('layouts.main')

@section('page-content')
    @include('shared.components.formAlgoliaApi')
        <style>
            #mapid {
                height: 300px
            };
        </style>

    @foreach ($flatsInRange as $flat)
    <a
        class="card"
        href="{{ route('flats.show', $flat->id)}}"
        data-coordinates="{{$flat->getLatLngAsStr() }}"
    >{{$flat->id}}</a>
    @endforeach

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


    <script>
        const form = document.getElementById('algoliaForm')

        function getLatLng(id) {
            return document.getElementById(id).value.split(',')
        }

        function getServices(className) {
            let services_array = []
            Array.from(document.getElementsByClassName(className)).forEach(item => {
                if (item.checked) {
                    services_array.push(item.value)
                }
            })
            return services_array.length ? services_array.join('-') : '0'
        }

        form.addEventListener('submit', e => {
            e.preventDefault()
            const base_url = window.location.protocol + '//' +  window.location.host + '/api/flats/?'
            let params = new URLSearchParams({
                lat: getLatLng('latlong')[0],
                lng: getLatLng('latlong')[1],
                rooms_min: document.querySelector('#rooms_min').value,
                beds_min: document.querySelector('#beds_min').value,
                required_services: getServices('service-checkbox'),
                distance: document.querySelector('#distance').value
            });
            console.log(base_url + params)
            fetch(base_url + params)
                .then(response => response.json())
                .then(data => console.log(data));
        })
    </script>
@endsection

