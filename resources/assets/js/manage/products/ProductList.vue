<template lang="html">
  <div class="card card-default">
    <div class="card-header d-flex align-items-center">
      Products
      <a href="#" class="btn btn-link btn-sm ml-auto" @click.prevent="get"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
    </div>
    <div class="card-block pb-0">
      Search Here
    </div>
    <div class="card-block loader__container">

      <loader :active="loader"></loader>

      <table class="table">
        <thead>
          <tr>
            <th v-for="column in columns"> {{ column }} </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" class="secretTd__container">
            <td>
              <img :src="product.image" :alt="product.title" width="50">
            </td>
            <td> {{ product.id }} </td>
            <td> {{ product.vendor.name }} </td>
            <td> {{ product.title }} </td>
            <td class="nowrap">
              <span v-for="category in product.categories" class="tag tag-primary mr-1"> {{ category.name }} </span>
            </td>
            <td> {{ product.description }} </td>
            <td> ${{ product.price }} </td>
            <td class="secertTd">

            </td>
          </tr>
        </tbody>
      </table>

      <pagination :data-meta="meta" :data-links="links" v-if="meta && links" @changed="changePage"></pagination>

    </div>
  </div>
</template>

<script>
import Pagination from '../common/Pagination.vue'
import Loader from '../common/Loader.vue'

export default {
  components: { Pagination, Loader },
  data() {
    return {
      columns: [
        'image', '#', 'vendor', 'title', 'categories', 'description', 'price',
      ],
      products: [],
      meta: null,
      links: null,
      pagination: { page: 1 },

      loader: false,
    }
  },
  methods: {
    get() {
      this.loader = true

      axios.get(route('manage.products.index'), {
        params: Object.assign(this.pagination)
      }).then((response) => {
        this.products = response.data.data
        this.meta = response.data.meta
        this.links = response.data.links
      }).catch().then(() => this.loader = false)
    },

    changePage(paginationObj) {
      this.pagination = paginationObj

      this.get()
    }
  },
  created() {
    this.get()

    window.events.$on('products.get', this.get)
  }
}
</script>
