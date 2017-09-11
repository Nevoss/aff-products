<template lang="html">
<div class="mt-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header d-flex align-items-center">
          Categories
          <!-- <button type="button" class="btn btn-sm btn-outline-success ml-auto"> <i class="icon-plus"></i> New Category </button> -->
        </div>
        <div class="card-block">
          <categories-list :data-categories="categories"></categories-list>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <new-category :data-categories="categories"></new-category>
    </div>
  </div>
</div>
</template>

<script>
import CategoriesList from './CategoriesList.vue'
import NewCategory from './NewCategory.vue'

export default {
  components: {
    CategoriesList, NewCategory
  },
  data() {
    return {
      categories: [],
    }
  },
  methods: {
    get() {
      axios.get(route('manage.api.categories.index'))
        .then((response) => this.categories = response.data.data )
    }
  },
  created() {
    this.get()
  }
}
</script>
