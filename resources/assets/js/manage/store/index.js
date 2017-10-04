import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import categories from '../app/categories/store'
import products from '../app/products/store'
import admins from '../app/admins/store'
import vendors from '../app/vendors/store'

const store = new Vuex.Store({
  modules: {
    admins, categories, products, vendors
  }
})

export default store
