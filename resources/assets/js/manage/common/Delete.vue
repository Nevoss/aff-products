<template lang="html">

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Do you want to delete "{{ modelName }}"?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" v-if="this.$slots.default">
        <slot></slot>
      </div>
      <div class="modal-body text-right">
        <button type="button" class="btn btn-danger" @click="agree">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</template>

<script>
export default {
  props: [ 'model-name', 'model-key'],
  methods: {
    agree() {
      $('#deleteModal').modal('hide')
      this.$emit('agree', this.modelKey);
    }
  }
}
</script>
