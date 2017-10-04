export default {

  get({ commit, state }) {
    commit('setListLoader', true)

    return axios.get(route('manage.categories.index'))
      .then((response) => commit('setCategories', response.data.data) )
      .catch()
      .then(() => commit('setListLoader', false))

  },

  single({ commit }, slug) {
    commit('setSingleLoader', true)

    axios.get(route('manage.categories.show', {category: slug}))
      .then((response) => {
        commit('setChoosenCategory', response.data.data)
        commit('setSingleLoader', false)

      }).catch(() => commit('setSingleLoader', false))
  },


  store({ dispatch }, formObj) {
    formObj.isSending = true

    return axios.post(route('manage.categories.store'), formObj.data())
      .then((response) => {
        formObj.reset();
        dispatch('get')

        formObj.isSending = false

        return Promise.resolve()

      }).catch((error) => {
        this.form.errors.record(error.response.data.errors)

        formObj.isSending = false

        return Promise.reject()
      })
  },



  update({ dispatch, state }, formObj) {
    axios.patch(route('manage.categories.update', {category: state.choosenCategory.slug}), formObj.data())
      .then((response) => {

        dispatch('get')

        return Promise.resolve()

      })
  },



  destroy({ dispatch }, slug) {
    axios.delete(route('manage.categories.destroy', slug)).then(() => {
      dispatch('get')

      return Promise.resolve()
    })
  },



}
