require('./bootstrap');

require('./manage/base')


window.Vue = require('vue');

// Events
window.events = new Vue()

window.flash = (body, status = 'success') => {
  window.events.$emit('flash', {
    body, status
  })
}

Vue.component('categories', require('./manage/categories/Categories.vue'));
Vue.component('products', require('./manage/products/Products.vue'));
Vue.component('flash', require('./manage/common/Flash.vue'));

const app = new Vue({
  el: '#manage'
});
