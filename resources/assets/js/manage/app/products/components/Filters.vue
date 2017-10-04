<template lang="html">
  <div class="">
    <div class="row">
      <div class="col-md-8">

      </div>
      <div class="col-md-4">
        <input type="text" name="search" v-model="filters.search" class="form-control" placeholder="Search" @input="search">
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Filters from '../../../../services/Filters'

export default {
  props: [ 'page' ],
  data() {
    return {
      searchTimer: 0,

      filters: new Filters({
        search: null,
        page: null,
      }),
    }
  },
  watch: {
    page(value) {
      this.filters.page = value
      this.filtersChanged(this.filters)
    }
  },
  methods: {
    ...mapActions({
      filtersChanged: 'products/filtersChanged'
    }),

    search(e) {
      this.filters.page = 1

      clearTimeout(this.searchInterval)
      this.searchInterval = setTimeout(() => this.filtersChanged(this.filters), 400)
    },

  },
  created() {
    this.filtersChanged(this.filters.parse(location.search))
  }
}
</script>
