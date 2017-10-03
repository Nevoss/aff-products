<template lang="html">
  <!-- Modal -->
  <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="update" @keyup="form.errors.clear($event.target.name)">
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
              <label> Description: </label>
              <textarea name="description" rows="4" v-model="form.description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
              <small class="form-text invalid-feedback" v-if="form.errors.has('description')">
                {{ form.errors.get('description') }}
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
import { Form } from '../../../services/Form'
import Loader from '../common/components/Loader.vue'

export default {
  components: { Loader },
  props: ['category-slug'],
  data() {
    return {
      loader: true,
      form: new Form({
        name: null,
        description: null,
      })
    }
  },
  watch: {
    categorySlug() {
      this.get()
    }
  },
  methods: {

    get() {
      this.loader = true

      axios.get(route('manage.categories.show', {category: this.categorySlug}))
        .then((response) => {
          this.loader = false
          this.form.set(response.data.data)
        })
    },

    update() {
      axios.patch(route('manage.categories.update', {category: this.categorySlug}), this.form.data())
        .then((response) => {

          $('#editCategoryModal').modal('hide')
          this.$emit('updated');
          flash('Category updated!')

        })
    }
  }
}
</script>
