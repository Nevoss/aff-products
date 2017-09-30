import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import admins from '../app/admins/store'

const store = new Vuex.Store({
  modules: {
    admins
  }
})

export default store
