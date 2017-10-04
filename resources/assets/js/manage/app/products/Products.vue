<template lang="html">
  <div class="mt-4">

    <products-edit></products-edit>
    <products-delete :model-key="destroyObj.id" :model-name="destroyObj.title" @agree="del"></products-delete>

    <div class="row">
      <div class="col-md-8">
        <products-list @destroy="askForDelete" @edit="openEditModal"></products-list>
      </div>
      <div class="col-md-4">
        <products-create-from-vendor></products-create-from-vendor>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import ProductsList from './components/List.vue'
import ProductsEdit from './components/Edit.vue'
import ProductsDelete from '../common/components/Delete.vue'
import ProductsCreateFromVendor from './components/CreateFromVendor.vue'


export default {
  components: { ProductsEdit, ProductsList, ProductsDelete, ProductsCreateFromVendor },
  data() {
    return {
      destroyObj: {
        id: null,
        title: null,
      },
      currentEditedId: null,
    }
  },
  methods: {
    ...mapActions({
      getCategories: 'categories/get',
      getVendors: 'vendors/get',
      destroy: 'products/destroy',
      single: 'products/single',
    }),

    askForDelete({id, title}) {
      this.destroyObj.id = id
      this.destroyObj.title = title

      $('#deleteModal').modal('show')
    },

    del(productId) {
      this.destroy(productId).then(() => flash('Product deleted.'))
    },

    openEditModal(productId) {

      this.single(productId)
      $('#editProductModal').modal('show')

    }
  },
  created() {
    this.getVendors();
    this.getCategories();
  }
}
</script>
