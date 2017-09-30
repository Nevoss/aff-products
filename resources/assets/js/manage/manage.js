require('../bootstrap')
require('./base')

import Vue from 'vue'
import store from './store'

// Events
window.events = new Vue()

// Routes
Vue.prototype.route = route;

// Flash Message
window.flash = (body, status = 'success') => {
  window.events.$emit('flash', {
    body, status
  })
}

// Componenets
Vue.component('categories', require('./app/categories/Categories.vue'));
Vue.component('products', require('./app/products/Products.vue'));
Vue.component('admins', require('./app/Admins/Admins.vue'));
Vue.component('flash', require('./app/common/Flash.vue'));

const app = new Vue({
  el: '#manage',
  store
});
