export default {

  get({ commit, state }) {
    axios.get(route('manage.vendors.index'), { params: { active: 1 } })
      .then(response => commit('setVendors', response.data.data))
  },

}
