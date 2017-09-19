<template lang="html">
  <div class="mt-4">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">
            Products
          </div>
          <div class="card-block">

            <table class="table">
              <thead>
                <tr>
                  <th v-for="column in columns"> {{ column }} </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products">
                  <td>
                    <img :src="product.image" :alt="product.title" width="50">
                  </td>
                  <td> {{ product.id }} </td>
                  <td> {{ product.vendor.name }} </td>
                  <td> {{ product.title }} </td>
                  <td>
                    <span v-for="category in product.categories" class="tag tag-primary"> {{ category.name }} </span>
                  </td>
                  <td> {{ product.description }} </td>
                  <td> ${{ product.price }} </td>
                </tr>
              </tbody>
            </table>

            <pagination :data-meta="meta" :data-links="links" v-if="meta && links" @changed="changePage"></pagination>

          </div>
        </div>
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
</template>

<script>
import Pagination from '../common/Pagination.vue'

export default {
  components: { Pagination },
  data() {
    return {
      columns: [
        'image', '#', 'vendor', 'title', 'categories', 'description', 'price',
      ],
      products: [],
      meta: null,
      links: null,
      pagination: { page: 1 },
    }
  },
  methods: {
    get() {
      axios.get(route('manage.products.index'), {
        params: Object.assign(this.pagination)
      })
        .then((response) => {
          this.products = response.data.data
          this.meta = response.data.meta
          this.links = response.data.links
        })
    },

    changePage(paginationObj) {
      this.pagination = paginationObj

      this.get()
    }

  },
  created() {
    this.get()
  }
}
</script>
