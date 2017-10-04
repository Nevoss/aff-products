export default {
  setProducts(state, payload) {
    state.products = payload
  },

  setChoosenProduct(state, payload) {
    state.choosenProduct = payload
  },

  setMeta(state, payload) {
    state.meta = payload
  },

  setLinks(state, payload) {
    state.links = payload
  },

  setFilters(state, payload) {
    state.filters = payload
  },

  setListLoader(state, payload) {
    state.listLoader = payload
  },

  setSingleLoader(state, payload) {
    state.singleLoader = payload
  },

}
