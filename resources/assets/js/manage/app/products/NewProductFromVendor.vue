<template lang="html">
  <div class="card card-default">
    <div class="card-header">
      Fetch Product From Vendor
    </div>
    <div class="card-block loader__container">

      <loader :active="loader"></loader>

      <form  @submit.prevent="send" @keyup="form.errors.clear($event.target.name)">
        <div class="form-group" v-if="form.errors.has('vendor_integration')">
          <small class="form-text invalid-feedback d-block mt-0">
            {{ form.errors.get('vendor_integration') }}
          </small>
        </div>
        <div class="form-group">
          <label> Vendor: </label>
          <select class="form-control" name="vendor" v-model="choosenVendor">
            <option v-for="vendor in vendors" :value="vendor.id"> {{ vendor.name }} </option>
          </select>
        </div>
        <div class="form-group">
          <label> Item ID: </label>
          <input class="form-control" type="text" name="item_id" v-model="form.item_id" :class="{ 'is-invalid': form.errors.has('item_id') }">
          <small class="form-text invalid-feedback" v-if="form.errors.has('item_id')">
            {{ form.errors.get('item_id') }}
          </small>
        </div>
        <div class="form-group">
          <label> Title </label>
          <input type="text" name="title" class="form-control" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }">
          <small class="form-text invalid-feedback" v-if="form.errors.has('title')">
            {{ form.errors.get('title') }}
          </small>
        </div>
        <div class="form-group">
          <label> Description </label>
          <textarea name="description" rows="4" class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
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
        <button type="submit" class="btn btn-primary" :disabled="this.form.isSending">
          <i class="icon-paper-plane" v-if="!this.form.isSending"></i>
          <i class="fa fa-spinner fa-pulse fa-fw" v-else></i>
          Fetch
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { Form } from '../../../services/Form'
import Loader from '../common/components/Loader.vue'

export default {
  components: { Loader },
  props: [ 'categories', 'vendors' ],
  data() {
    return {
      choosenVendor: 1,
      form : new Form({
        item_id: null,
        title: null,
        description: null,
        categories_ids: [],
      }),
    }
  },
  computed: {
    loader() {
      return this.categories.length == 0 || this.vendors.length == 0
    }
  },
  methods: {
    send() {
      this.form.isSending = true

      axios.post(route('manage.vendors.products.store', { vendor: this.choosenVendor }), this.form.data())
        .then((response) => {

          window.events.$emit('products.get')
          flash('Product was created')

        }).catch((errors) => {
          this.form.errors.record(errors.response.data.errors)
        })
        .then(() => this.form.isSending = false)
    }
  }
}
</script>
