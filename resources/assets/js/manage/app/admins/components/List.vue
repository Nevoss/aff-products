<template lang="html">
  <div class="card card-default">
    <div class="card-header d-flex align-items-center">
      Admins
    </div>
    <div class="card-block pb-0">
      <filters :page="page"></filters>
    </div>
    <div class="card-block loader__container">

      <loader :active="listLoader"></loader>

      <table class="table">
        <thead>
          <tr>
            <th v-for="column in columns"> {{ column }} </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="admin in admins" class="secretTd__hover">
            <td> {{ admin.id }} </td>
            <td> {{ admin.name }} </td>
            <td> {{ admin.email }} </td>

            <td class="secretTd__container">
              <div class="secretTd">
                <button type="button" class="btn btn-sm btn-outline-warning mr-2" @click="edit(admin.id)">
                  <i class="icon-pencil"></i>
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger" @click="destroy({id: admin.id, name: admin.name })">
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
import Loader from '../../common/components/Loader.vue'
import Pagination from '../../common/components/Pagination.vue'
import Filters from './Filters.vue'

export default {
  components: { Pagination, Filters, Loader },
  data() {
    return {
      columns: ['#', 'Name', 'Email'],
      page: 1,
    }
  },
  computed: {
    ...mapGetters({
      admins: 'admins/admins',
      links: 'admins/links',
      meta: 'admins/meta',
      listLoader: 'admins/listLoader'
    })
  },
  methods: {
    ...mapActions({
      get: 'admins/get'
    }),

    destroy({id, name}) {
      this.$emit('destroy', {id, name})
    },

    edit(id) {
      this.$emit('edit', id)
    }
  },
}
</script>
