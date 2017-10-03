<template lang="html">
  <div class="mt-4">

    <admins-edit></admins-edit>
    <admins-delete :model-key="destroyObj.id" :model-name="destroyObj.name" @agree="destroyRequest"></admins-delete>

    <div class="row">
      <div class="col-md-8">
        <admins-list @edit="openEditModal" @destroy="askForDelete"></admins-list>
      </div>
      <div class="col-md-4">
        <admins-create></admins-create>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import AdminsList from './components/List.vue'
import AdminsCreate from './components/Create.vue'
import AdminsEdit from './components/Edit.vue'
import AdminsDelete from '../common/components/Delete.vue'


export default {
  components: { AdminsList, AdminsCreate, AdminsDelete, AdminsEdit },
  data() {
    return {
      destroyObj: {
        id: null,
        name: null
      },
    }
  },
  methods: {
    ...mapActions({
      destroy: 'admins/destroy',
      single: 'admins/single',
    }),

    askForDelete({id, name}) {
      this.destroyObj.id = id
      this.destroyObj.name = name

      $('#deleteModal').modal('show')
    },

    destroyRequest(id) {
      this.destroy(id)
        .then(() => flash('Admin was deleted'))
    },

    openEditModal(adminId) {
      this.single(adminId)

      $('#editAdminModal').modal('show')
    }
  },
}
</script>
