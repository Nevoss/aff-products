<template lang="html">
  <div class="card">
    <div class="card-header">
      New Category
    </div>
    <div class="card-block loader__container">

      <loader :active="loader"></loader>

      <form @submit.prevent="send" @keyup="form.errors.clear($event.target.name)">
        <div class="form-group">
          <label> Name: </label>
          <input type="text" class="form-control" name="name" :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.name">
          <small class="form-text invalid-feedback" v-if="form.errors.has('name')">
            {{ form.errors.get('name') }}
          </small>
        </div>
        <div class="form-group">
          <label> Parent Category: </label>
            <select class="form-control" v-model="form.parent_id" name="parent_id" :class="{ 'is-invalid': form.errors.has('parent_id') }">
              <option value=""><b> ------------- </b></option>
              <option :value="category.id" v-for="category in categories"> {{ category.name }} </option>
            </select>
            <small class="form-text invalid-feedback" v-if="form.errors.has('parent_id')">
              {{ form.errors.get('parent_id') }}
            </small>
        </div>
        <div class="form-group">
          <label> Description </label>
          <textarea rows="4" class="form-control" v-model="form.description" name="description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
          <small class="form-text invalid-feedback" v-if="form.errors.has('description')">
            {{ form.errors.get('description') }}
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
import { mapGetters, mapActions } from 'vuex'
import { Form } from '../../../../services/Form'
import CategoryRecursiveMixin from '../../common/mixins/category_recursive'
import Loader from '../../common/components/Loader.vue'

export default {
  components: { Loader },
  mixins: [ CategoryRecursiveMixin ],
  data() {
    return {
      form: new Form({
        name: null,
        parent_id: '',
        description: null,
      })
    }
  },
  computed: {
    ...mapGetters({
      categories: 'categories/categories',
      loader: 'categories/listLoader',
    })
  },
  methods: {
    ...mapActions({
      store: 'categories/store'
    }),

    send() {
      this.store(this.form)
        .then(() => flash('Category created.'))
    },
  },
}
</script>
