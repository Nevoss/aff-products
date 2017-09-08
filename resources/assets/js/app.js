require('./bootstrap');

window.Vue = require('vue');

Vue.component('products-list', require('./components/products/ProductsList.vue'));

const app = new Vue({
  el: '#app'
});
