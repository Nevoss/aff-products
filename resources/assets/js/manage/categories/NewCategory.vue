<template lang="html">
  <div class="card">
    <div class="card-header">
      New Category
    </div>
    <div class="card-block">
      <form>
        <div class="form-group">
          <label> Name: </label>
          <input type="text" class="form-control">
        </div>
        <div class="form-group">
          <!-- <label> Parent Category: </label>
            <select class="form-control">
            <option value="">  </option>
          </select> -->
        </div>
        <div class="form-group">
          <label> Description </label>
          <textarea rows="4" class="form-control"></textarea>
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
export default {
  props: [ 'data-categories' ],
  data() {
    return {

    }
  },
  computed: {
    categories() {

    },
  },
}
</script>
