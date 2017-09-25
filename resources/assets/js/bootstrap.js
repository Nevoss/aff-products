window._ = require('lodash');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

window.jQuery = window.$ = require('jquery')
require('bootstrap')

window.Vue = require('vue');

// Events
window.events = new Vue()

// Routes
window.Vue.prototype.route = route;
