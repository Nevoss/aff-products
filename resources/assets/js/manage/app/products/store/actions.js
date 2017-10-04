export default {

  get({ commit, state }) {
    commit('setListLoader', true)

    axios.get(route('manage.products.index'), {
      params: state.filters
    }).then((response) => {
      commit('setProducts', response.data.data)
      commit('setMeta', response.data.meta)
      commit('setLinks', response.data.links)
    }).catch().then(() => commit('setListLoader', false))
  },



  single({ commit }, id) {
    commit('setSingleLoader', true)

    axios.get(route('manage.products.show', { product: id }))
      .then((response) => {
        commit('setChoosenProduct', response.data.data)
      }).catch().then(() => commit('setSingleLoader', false))
  },



  filtersChanged({ commit, dispatch }, filtersObject) {
    history.pushState(null, null, filtersObject.stringify())

    commit('setFilters', filtersObject.stripedData())

    dispatch('get')
  },



  store({ dispatch }, { formObj, choosenVendor } ) {
    formObj.isSending = true

    return axios.post(route('manage.vendors.products.store', { vendor: choosenVendor }), formObj.data())
      .then((response) => {
        formObj.isSending = false
        dispatch('get')

        return Promise.resolve()
      }).catch((errors) => {
        formObj.isSending = false
        formObj.errors.record(errors.response.data.errors)

        return Promise.reject()
      })
  },



  update({ dispatch, state }, formObj) {
    return axios.patch(route('manage.products.update', {product: state.choosenProduct.id}), formObj.data())
      .then((response) => {
        dispatch('get')

        return Promise.resolve()
      }).catch(() => Promise.reject())
  },



  destroy({ dispatch }, id) {
    return axios.delete(route('manage.products.destroy', { product: id }))
      .then(() => {
        dispatch('get')

        return Promise.resolve()
      }).catch(() => Promise.reject())
  },



}
