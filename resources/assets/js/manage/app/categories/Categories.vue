<template lang="html">
<div class="mt-4">

  <categories-edit></categories-edit>

  <categories-delete :model-key="destroyObj.slug" :model-name="destroyObj.name" @agree="sendDestroy">
    if there this category has child categories they will be removed
  </categories-delete>

  <div class="row">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header d-flex align-items-center">
          Categories
        </div>
        <div class="card-block loader__container">
          <categories-list :data-categories="categories" @destroy="askForDelete" @edit="openEditModal"></categories-list>
          <loader :active="loader"></loader>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <categories-create></categories-create>
    </div>
  </div>
</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Loader from '../common/components/Loader.vue'
import CategoriesList from './components/List.vue'
import CategoriesDelete from '../common/components/Delete.vue'
import CategoriesCreate from './components/Create.vue'
import CategoriesEdit from './components/Edit.vue'

export default {
  components: {
    CategoriesList, CategoriesCreate, CategoriesDelete, CategoriesEdit, Loader
  },
  data() {
    return {
      destroyObj: {
        slug: null,
        name: null,
      },
    }
  },
  computed: {
    ...mapGetters({
      categories: 'categories/categories',
      loader: 'categories/listLoader',
    }),
  },
  methods: {

    ...mapActions({
      get: 'categories/get',
      destroy: 'categories/destroy',
      single: 'categories/single',
    }),

    askForDelete({slug, name}) {
      this.destroyObj.slug = slug
      this.destroyObj.name = name

      $('#deleteModal').modal('show')
    },

    sendDestroy(slug) {
     this.destroy(slug).then(() => flash('Category deleted.'))
    },

    openEditModal(slug) {
      this.single(slug)

      $('#editCategoryModal').modal('show')
    },
  },
  created() {
    this.get()
  }
}
</script>
