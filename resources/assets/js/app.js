require('./bootstrap');

Vue.component('products-list', require('./components/products/ProductsList.vue'));

const app = new Vue({
  el: '#app'
});
