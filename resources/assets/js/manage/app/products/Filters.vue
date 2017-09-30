<template lang="html">
  <div class="">
    <div class="row">
      <div class="col-md-8">

      </div>
      <div class="col-md-4">
        <input type="text" name="search" placeholder="search" class="form-control" :value="filters.get('search')" @input="search">
      </div>
    </div>
  </div>
</template>

<script>
import Filters from '../../../services/Filters'

export default {
  props: [ 'page' ],
  data() {
    return {
      searchTimer: 0,
      filters: new Filters({
        search: null,
        page: 1,
      }),
    }
  },
  watch: {
    page() {
      this.filters.set('page', this.page);
      this.filtersChanged()
    }
  },
  methods: {
    search(e) {
      this.filters.set('page', 1)

      clearTimeout(this.searchTimer)
      this.searchTimer = setTimeout(() => {

        this.filters.set('search', e.target.value)
        this.filtersChanged()

      }, 400)
    },

    filtersChanged() {
      history.pushState(null, null, this.filters.stringify())

      this.$emit('changed', this.filters.get())
    },
  },
  created() {
    this.filters.parse(location.search)

    this.$emit('changed', this.filters.get())
  }
}
</script>
