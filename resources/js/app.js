/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

const axios = require('axios');

import Clipboard from 'v-clipboard'
Vue.use(Clipboard)

import CookieLaw from 'vue-cookie-law'



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('profiletarget', require('./components/profileTarget.vue').default);
Vue.component('home', require('./components/HomeComponent.vue').default);
Vue.component('cookie', require('./components/CookieComponent.vue').default);
Vue.component('explaination', require('./components/ExplainationComponent.vue').default);






const app = new Vue({

    el: '#app',

});




