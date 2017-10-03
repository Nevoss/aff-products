<template lang="html">
<div class="mt-4">

  <edit-category :category-slug="currentEditedSlug" @updated="get"></edit-category>

  <delete-category :model-key="destroyObj.slug" :model-name="destroyObj.name" @agree="destroy">
    if there this category has child categories they will be removed
  </delete-category>

  <div class="row">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header d-flex align-items-center">
          Categories
          <!-- <button type="button" class="btn btn-sm btn-outline-success ml-auto"> <i class="icon-plus"></i> New Category </button> -->
        </div>
        <div class="card-block loader__container">
          <categories-list :data-categories="categories" @destroy="askForDelete" @edit="openEditModal"></categories-list>
          <loader :active="loader"></loader>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <new-category :data-categories="categories" @created="get"></new-category>
    </div>
  </div>
</div>
</template>

<script>
import Loader from '../common/components/Loader.vue'
import DeleteCategory from '../common/components/Delete.vue'
import CategoriesList from './CategoriesList.vue'
import NewCategory from './NewCategory.vue'
import EditCategory from './EditCategory.vue'

export default {
  components: {
    CategoriesList, NewCategory, DeleteCategory, EditCategory, Loader
  },
  data() {
    return {
      categories: [],
      loader: false,
      destroyObj: {
        slug: null,
        name: null,
      },
      currentEditedSlug: null,
    }
  },
  methods: {
    get() {
      this.loader = true

      axios.get(route('manage.categories.index'))
        .then((response) => this.categories = response.data.data )
        .catch()
        .then(() => this.loader = false)
    },

    askForDelete({slug, name}) {
      this.destroyObj.slug = slug
      this.destroyObj.name = name

      $('#deleteModal').modal('show')
    },

    destroy(slug) {
      axios.delete(route('manage.categories.destroy', slug)).then(() => {
        this.get()
        flash('Category Deleted')
      })
    },

    openEditModal(slug) {
      this.currentEditedSlug = slug

      $('#editCategoryModal').modal('show')
    },
  },
  created() {
    this.get()
  }
}
</script>
