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
        <button type="submit" class="btn btn-primary">
          <i class="icon-paper-plane"></i>
          Send
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { Form } from '../../services/Form'
import CategoryRecursiveMixin from '../mixins/category_recursive'
import Loader from '../common/Loader.vue'

export default {
  components: { Loader },
  props: [ 'data-categories' ],
  mixins: [ CategoryRecursiveMixin ],
  data() {
    return {
      categories: [],
      form: new Form({
        name: null,
        parent_id: '',
        description: null,
      })
    }
  },
  computed: {
    loader() {
      return this.dataCategories.length == 0
    }
  },
  watch: {
    dataCategories(categories) {
      this.categories = this.recursiveCategories(categories)
    }
  },
  methods: {
    send() {
      axios.post(route('manage.categories.store'), this.form.data())
        .then((response) => {

          this.$emit('created');
          this.form.reset();
          flash('Category created!')

        }).catch((error) => {
          this.form.errors.record(error.response.data.errors);
        })
    },
  },
}
</script>
