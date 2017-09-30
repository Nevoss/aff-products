<template lang="html">
  <div class="mt-4">
    <div class="row">
      <div class="col-md-8">
        <admins-list></admins-list>
      </div>
      <div class="col-md-4">

      </div>
    </div>
  </div>
</template>

<script>
import AdminsList from './components/AdminsList.vue'

export default {
  components: { AdminsList }
}
</script>
