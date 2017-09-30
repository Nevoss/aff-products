<template lang="html">
  <div class="card card-default">
    <div class="card-header d-flex align-items-center">
      Admins
    </div>
    <div class="card-block pb-0">
      
    </div>
    <div class="card-block loader__container">

      <table class="table">
        <thead>
          <tr>
            <th v-for="column in columns"> {{ column }} </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="admin in admins">
            <td> {{ admin.id }} </td>
            <td> {{ admin.name }} </td>
            <td> {{ admin.email }} </td>
          </tr>
        </tbody>
      </table>

      <pagination :data-meta="meta" :data-links="links" v-if="meta && links" @changed="page = $event"></pagination>

    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Pagination from '../../common/Pagination.vue'

export default {
  components: { Pagination },
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
      meta: 'admins/meta'
    })
  },
  methods: {
    ...mapActions({
      get: 'admins/get'
    })
  },
  created() {
    this.get()
  }
}
</script>
