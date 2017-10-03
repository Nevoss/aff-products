<template lang="html">
  <!-- Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="update" @keyup="form.errors.clear($event.target.name)">
          <div class="modal-body loader__container">

            <loader :active="loader"></loader>

            <div class="form-group">
              <label> Title: </label>
              <input type="text" name="title" v-model="form.title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
              <small class="form-text invalid-feedback" v-if="form.errors.has('title')">
                {{ form.errors.get('title') }}
              </small>
            </div>

            <div class="form-group">
              <label> Description: </label>
              <textarea name="description" rows="4" v-model="form.description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
              <small class="form-text invalid-feedback" v-if="form.errors.has('description')">
                {{ form.errors.get('description') }}
              </small>
            </div>

            <div class="form-group">
              <label> Categories </label>
              <select class="form-control" name="categories_ids" multiple v-model="form.categories_ids">
                <option v-for="category in categories" :value="category.id"> {{ category.name }} </option>
              </select>
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
import {Form} from '../../../services/Form'
import Loader from '../common/components/Loader.vue'

export default {
  components: { Loader },
  props: [ 'categories', 'productId' ],
  data() {
    return {
      loader: true,
      form: new Form({
        title: null,
        description: null,
        categories_ids: [],
      })
    }
  },
  watch: {
    productId() {
      this.get()
    }
  },
  methods: {
    get() {
      this.loader = true

      axios.get(route('manage.products.show', { product: this.productId }))
        .then((response) => {
          this.form.set(response.data.data)
        }).catch().then(() => this.loader = false)
    },

    update() {
      axios.patch(route('manage.products.update', {product: this.productId}), this.form.data())
        .then((response) => {

          flash('The product was updated')
          window.events.$emit('products.get')
          $('#editProductModal').modal('hide')

        })
    }
  }
}
</script>
