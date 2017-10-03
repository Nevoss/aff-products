export default {

  get({ commit, state }) {
    commit('setListLoader', true)

    return axios.get(route('manage.admins.index'), {
      params: state.filters
    }).then((response) => {

      commit('setAdmins', response.data.data)
      commit('setMeta', response.data.meta)
      commit('setLinks', response.data.links)

    }).catch().then(() => {
      commit('setListLoader', false)

    })
  },

  single({ commit }, adminId) {
    commit('setSingleLoader', true)

    return axios.get(route('manage.admins.show', { admin: adminId }))
      .then((response) => {

        commit('setChoosenAdmin', response.data.data)

      }).catch().then(() => commit('setSingleLoader', false))
  },

  filtersChanged({ commit, dispatch }, filtersObject) {
    history.pushState(null, null, filtersObject.stringify())

    commit('setFilters', filtersObject.stripedData())

    dispatch('get')
  },

  store({ dispatch }, formObj) {
    formObj.isSending = true

    return axios.post(route('manage.admins.store'), formObj.data())
      .then((response) => {
        dispatch('get')
        formObj.isSending = false

        return Promise.resolve(response.data)
      }).catch((error) => {
        formObj.isSending = false

        return Promise.reject(error.response.data)
      })
  },

  update({ dispatch, state }, formObj) {
    formObj.isSending = true

    return axios.patch(route('manage.admins.update', { admin: state.choosenAdmin.id }), formObj.data())
      .then((response) => {
        dispatch('get')
        formObj.isSending = false

        return Promise.resolve(response)
      }).catch((error) => {
        formObj.isSending = false

        return Promise.reject(error.response)
      })
  },

  destroy({ dispatch }, id) {
    return axios.delete(route('manage.admins.destroy', { admin: id }))
      .then((response) => {
        dispatch('get')

        return Promise.resolve(id)
      }).catch(({response}) => Promise.reject(response))
  },

}
