<template lang="html">
  <div class="mt-4">
    <div class="row">
      <div class="col-md-8">
        <product-list></product-list>
      </div>
      <div class="col-md-4">
        <new-product-from-vendor :vendors="vendors" :categories="categories"></new-product-from-vendor>
      </div>
    </div>
  </div>
</template>

<script>
import NewProductFromVendor from './NewProductFromVendor.vue'
import ProductList from './ProductList.vue'
import CategoryRecursiveMixin from '../mixins/category_recursive'

export default {
  components: { NewProductFromVendor, ProductList },
  mixins: [ CategoryRecursiveMixin ],
  data() {
    return {
      categories: [],
      vendors: [],
    }
  },
  methods: {
    getVendors() {
      axios.get(route('manage.vendors.index'), { params: { active: 1 } })
        .then(response => this.vendors = response.data.data)
    },
    getCategories() {
      axios.get(route('manage.categories.index'))
        .then(response => this.categories = this.recursiveCategories(response.data.data))
    },
  },
  created() {
    this.getVendors();
    this.getCategories();
  }
}
</script>
