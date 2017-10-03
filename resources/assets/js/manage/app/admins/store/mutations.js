export default {

  setAdmins(state, payload) {
    state.admins = payload
  },

  setChoosenAdmin(state, payload) {
    state.choosenAdmin = payload
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
