<template lang="html">
  <div class="card">
    <div class="card-header">
      Create New Admin
    </div>
    <div class="card-block">

      <form @submit.prevent="send" @keyup="form.errors.clear($event.target.name)">

        <div class="form-group">
          <label> Name: </label>
          <input type="text" class="form-control" name="name" :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.name">
          <small class="form-text invalid-feedback" v-if="form.errors.has('name')">
            {{ form.errors.get('name') }}
          </small>
        </div>

        <div class="form-group">
          <label> Email: </label>
          <input type="text" class="form-control" name="email" :class="{ 'is-invalid': form.errors.has('email') }" v-model="form.email">
          <small class="form-text invalid-feedback" v-if="form.errors.has('email')">
            {{ form.errors.get('email') }}
          </small>
        </div>

        <div class="form-group">
          <label> Password: </label>
          <input type="text" class="form-control" name="password" :class="{ 'is-invalid': form.errors.has('password') }" v-model="form.password">
          <small class="form-text invalid-feedback" v-if="form.errors.has('password')">
            {{ form.errors.get('password') }}
          </small>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="this.form.isSending">
          <i class="icon-paper-plane" v-if="!this.form.isSending"></i>
          <i class="fa fa-spinner fa-pulse fa-fw" v-else></i>
          Send
        </button>

      </form>

    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { Form } from '../../../../services/Form'

export default {
  data() {
    return {
      form: new Form({
        name: null,
        email: null,
        password: null,
      }),
    }
  },
  computed: {
    ...mapGetters({
      loader: 'admins/storeLoader'
    })
  },
  methods: {
    ...mapActions({
      store: 'admins/store',
    }),

    send() {
      this.store(this.form)
        .then(() => {
          flash('Admin was added')
        })
        .catch((response) => {
          this.form.errors.record(response.errors)
        })
    },
  }
}
</script>
