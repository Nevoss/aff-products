export default {

  get({ commit }) {
    return axios.get(route('manage.admins.index'))
      .then((response) => {
        commit('setAdmins', response.data.data)
        commit('setMeta', response.data.meta)
        commit('setLinks', response.data.links)

      }).catch()
  }

}
