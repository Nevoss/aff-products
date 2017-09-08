require('./bootstrap');

require('./manage/base')

window.Vue = require('vue');

const app = new Vue({
  el: '#manage'
});
