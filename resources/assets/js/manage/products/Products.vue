<template lang="html">
  <div class="mt-4">

    <edit-product :categories="categories" :product-id="currentEditedId"></edit-product>
    <delete-product :model-key="destroyObj.id" :model-name="destroyObj.title" @agree="destroy"></delete-product>

    <div class="row">
      <div class="col-md-8">
        <product-list @destroy="askForDelete" @edit="openEditModal"></product-list>
      </div>
      <div class="col-md-4">
        <new-product-from-vendor :vendors="vendors" :categories="categories"></new-product-from-vendor>
      </div>
    </div>
  </div>
</template>

<script>
import CategoryRecursiveMixin from '../mixins/category_recursive'
import NewProductFromVendor from './NewProductFromVendor.vue'
import ProductList from './ProductList.vue'
import EditProduct from './EditProduct.vue'
import DeleteProduct from '../common/Delete.vue'

export default {
  components: { NewProductFromVendor, ProductList, DeleteProduct, EditProduct },
  mixins: [ CategoryRecursiveMixin ],
  data() {
    return {
      categories: [],
      vendors: [],
      destroyObj: {
        id: null,
        title: null,
      },
      currentEditedId: null,
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

    askForDelete({id, title}) {
      this.destroyObj.id = id
      this.destroyObj.title = title

      $('#deleteModal').modal('show')
    },

    destroy(productId) {
      axios.delete(route('manage.products.destroy', { product: productId }))
        .then(() => {

          flash('Product was deleted')
          window.events.$emit('products.get')

        })
    },

    openEditModal(productId) {

      this.currentEditedId = productId
      $('#editProductModal').modal('show')

    }
  },
  created() {
    this.getVendors();
    this.getCategories();
  }
}
</script>
