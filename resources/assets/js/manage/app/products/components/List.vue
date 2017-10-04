<template lang="html">
  <div class="card card-default">
    <div class="card-header d-flex align-items-center">
      Products
      <a href="#" class="btn btn-link btn-sm ml-auto" @click.prevent="get"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
    </div>
    <div class="card-block pb-0">
      <filters :page="page"></filters>
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
          <tr v-for="product in products" class="secretTd__hover">
            <td>
              <a :href="route('products.view', { search: product.title })" target="_blank">
                <img :src="product.image" :alt="product.title" width="50">
              </a>
            </td>
            <td> {{ product.id }} </td>
            <td>
              <a :href="product.link" target="_blank">
                {{ product.vendor.name }}
              </a>
            </td>
            <td> {{ product.title }} </td>
            <td class="nowrap">
              <span v-for="category in product.categories" class="tag tag-primary mr-1"> {{ category.name }} </span>
            </td>
            <td> {{ product.description }} </td>
            <td> ${{ product.price }} </td>
            <td class="secretTd__container">
              <div class="secretTd">
                <button type="button" class="btn btn-sm btn-outline-warning mr-2" @click="edit(product.id)">
                  <i class="icon-pencil"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger" @click="destroy({id: product.id, title: product.title })">
                  <i class="icon-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <pagination :data-meta="meta" :data-links="links" v-if="meta && links" @changed="page = $event"></pagination>

    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Pagination from '../../common/components/Pagination.vue'
import Loader from '../../common/components/Loader.vue'
import Filters from './Filters.vue'

export default {
  components: { Pagination, Loader, Filters },
  data() {
    return {
      columns: [ 'image', '#', 'vendor', 'title', 'categories', 'description', 'price', ],
      page: 1,
      filtersObj: {},
    }
  },
  computed: {
    ...mapGetters({
      products: 'products/products',
      meta: 'products/meta',
      links: 'products/links',
      loader: 'products/listLoader',
    }),
  },
  methods: {
    ...mapActions({
      get: 'products/get'
    }),

    changeFilters(filters) {
      this.filtersObj = filters

      this.get()
    },

    destroy({id, title}) {
      this.$emit('destroy', {id, title})
    },

    edit(id) {
      this.$emit('edit', id)
    }
  },
}
</script>
