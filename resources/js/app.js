/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


import places from 'places.js';

place();

function place() {
    var address = document.querySelector('#address');
    
    var latlng = {
        lat: 0,
        lng: 0
    };

    var placesAutocomplete = places({
        appId: 'pl9SBUILJO03',
        apiKey: '707374d54fdaf7af334afaba53bce3c3',
        container: address,
        accessibility: {
            pinButton: {
                'aria-label': 'use browser geolocation',
                'tab-index': 12,
            },
            clearButton: {
                'tab-index': 13,
            }
        }
    });

    var address = document.querySelector('#address-value');

    placesAutocomplete.on('change', function (e) {
        latlng = {
            lat: e.suggestion.latlng.lat,
            lng: e.suggestion.latlng.lng
        };

        address = e.suggestion;
        console.log(latlng, address.value);
        console.log(address);
        console.log(this);
        
        // this.configure({
        //     aroundLatLng: latlng.lat + ',' + latlng.lng,
        //     aroundRadius: 20 * 1000
        // });
        document.querySelector('#latlong').value = [latlng.lat, latlng.lng];
        console.log(typeof(latlng.lat));
        
    });
    
    placesAutocomplete.on('clear', function () {
        address.textContent = 'none';
    });

}