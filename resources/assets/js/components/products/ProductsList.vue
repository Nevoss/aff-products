<template lang="html">
  <div>
    <div class="row">
      <div class="col-md-12">
        <filters @changed="get($event)"></filters>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 mt-4" v-for="product in products">
        <product :data="product"></product>
      </div>
    </div>
  </div>
</template>

<script>
import Filters from './Filters'
import Product from './Product'

export default {
  components: { Filters, Product },
  props: [ 'dataCategory' ],
  data() {
    return {
      products: [],
    }
  },
  methods: {
    get(filters = {}) {
      axios.get(route('api.products.index', this.withCategory()), {
        params: filters
      })
        .then((response) => this.products = response.data.data)
    },

    withCategory() {
      return (this.dataCategory) ? { category: this.dataCategory.slug } : {}
    }

  },
}
</script>
