require('./bootstrap');

require('./manage/base')

window.Vue = require('vue');

Vue.component('categories', require('./manage/categories/Categories.vue'));

const app = new Vue({
  el: '#manage'
});
