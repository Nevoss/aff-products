<template lang="html">
  <div class="card h-100">
    <div class="card-img-top">
      <img :src="data.image" :alt="data.title" class="img-fluid">
    </div>
    <div class="card-body">
      <p class="d-flex mb-0">
        <a :href="data.link" target="_blank" class="mr-auto"> {{ data.title }} </a>
        <strong> ${{ data.price }} </strong>
      </p>
      <p>
        <small class="text-muted">
          Categories:
          <span v-for="category in data.categories">
            <a :href="categoryUrl(category)"> {{ category.name }} </a>,
          </span>
        </small>
      </p>
      <small class="text-muted">
        {{ data.description }}
      </small>
      <div class="text-right mt-3">
        <a :href="data.link" target="_blank" class="btn btn-sm btn-outline-primary"> Buy it now </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [ 'data' ],
  methods: {
    categoryUrl(category) {
      return route('products.index', { category: category.slug })
    },
  }
}
</script>
