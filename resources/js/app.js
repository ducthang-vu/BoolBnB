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

// place();


// /***********
//  * FUNCTIONS
//  ***********/

// // Geolocation searchbar
// function place() {
//     var places = require('places.js');
//     var address = document.querySelector('#address');

//     var placesAutocomplete = places({
//         appId: 'pl9SBUILJO03',
//         apiKey: '707374d54fdaf7af334afaba53bce3c3',
//         container: address,
//         accessibility: {
//             pinButton: {
//                 'aria-label': 'use browser geolocation',
//                 'tab-index': 12,
//             },
//             clearButton: {
//                 'tab-index': 13,
//             }
//         }
//     });

//     var address = document.querySelector('#address-value');
    
//     placesAutocomplete.on('change', function (e) {
//         // acquisizione lat e long
//         address = e.suggestion.latlng;
//         // passa lat e long all'input nascosto
//         document.querySelector('#latlong').value = [address.lat, address.lng];
//     });

//     placesAutocomplete.on('clear', function () {
//         address.textContent = 'none';
//     });
// }