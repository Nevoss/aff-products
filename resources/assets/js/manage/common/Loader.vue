<template lang="html">

  <transition name="fade" mode="out-in">
    <div class="loader" v-if="active">
      <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </div>
  </transition>

</template>

<script>
export default {
  props: ['active']
}
</script>
