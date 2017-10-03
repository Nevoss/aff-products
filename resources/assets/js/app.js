require('./bootstrap');

import Vue from 'vue'
import Vuex from 'vuex'

// Events
window.events = new Vue()

// Routes
Vue.prototype.route = route;

// Vuex
Vue.use(Vuex)

Vue.component('products-list', require('./components/products/ProductsList.vue'));

const app = new Vue({
  el: '#app'
});
