<template lang="html">
  <!-- Modal -->
  <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="send" @keyup="form.errors.clear($event.target.name)">
          <div class="modal-body loader__container">

            <loader :active="loader"></loader>

            <div class="form-group">
              <label> Name: </label>
              <input type="text" name="name" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
              <small class="form-text invalid-feedback" v-if="form.errors.has('name')">
                {{ form.errors.get('name') }}
              </small>
            </div>

            <div class="form-group">
              <label> Email: </label>
              <input type="text" name="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
              <small class="form-text invalid-feedback" v-if="form.errors.has('email')">
                {{ form.errors.get('email') }}
              </small>
            </div>

            <hr>

            <label class="mb-2 small"> Create a new password or stay with the old one </label>
            <div class="custom-controls">
              <label class="custom-control custom-radio">
                <input name="is_new_password" type="radio" class="custom-control-input" :value="false" v-model="form.is_new_password">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description"> Old Password </span>
              </label>
              <label class="custom-control custom-radio">
                <input name="is_new_password" type="radio" class="custom-control-input" :value="true" v-model="form.is_new_password">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description"> New Password </span>
              </label>
            </div>

            <div class="form-group" v-if="this.form.is_new_password">
              <input type="text" name="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Type a new password">
              <small class="form-text invalid-feedback" v-if="form.errors.has('password')">
                {{ form.errors.get('password') }}
              </small>
            </div>

          </div>
          <div class="modal-body text-right">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Loader from '../../common/components/Loader.vue'
import { Form } from '../../../../services/Form'

export default {
  components: { Loader },
  data() {
    return {
      form: new Form({
        name: null,
        email: null,
        is_new_password: false,
        password: null,
      }),
    }
  },
  watch: {
    admin(admin) {
      this.form.name = admin.name
      this.form.email = admin.email
    }
  },
  computed: {
    ...mapGetters({
      admin: 'admins/choosenAdmin',
      loader: 'admins/singleLoader',
    }),
  },
  methods: {

    ...mapActions({
      update: 'admins/update',
    }),

    send() {
      this.update(this.form)
        .then(() => {
          flash('Admin was updated.')
          $('#editAdminModal').modal('hide')
        })
    },
  }
}
</script>
