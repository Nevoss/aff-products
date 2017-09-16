<template lang="html">
  <transition name="popFromRight" mode="out-in">
    <div class="alert alert-flash" :class="alertClass" v-if="show">
      <strong v-if="status == 'success'"> Success: </strong>
      <strong v-if="status == 'danger'"> Error: </strong>
      {{ msg }}
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    'data-msg': {
      default: null
    },
    'data-status': {
      default: 'success',
    }
  },
  data() {
    return {
      msg: null,
      status: 'success',
      show: false,
    }
  },
  computed: {
    alertClass() {
      return 'alert-' + this.status
    }
  },
  created() {

    if (this.dataMsg) {
      setTimeout(() => {
        this.flash(this.dataMsg, this.dataStatus)
      }, 500)
    }

    window.events.$on('flash', (msg) => this.flash(msg.body, msg.status))
  },
  methods: {

    flash(msg, status) {
      this.msg = msg
      this.status = status
      this.show = true

      this.hide()
    },

    hide() {
      setTimeout(() => {
        this.show = false
      }, 3000)
    }

  }
}
</script>

<style lang="scss">
  .alert-flash {
    z-index: 9990;
    position: fixed;
    bottom: 0;
    right: 0;
    margin-bottom: 1em;
    margin-right: 1em;
  }

  .popFromRight {
    &-enter-active, &-leave-active {
      transition: 0.3s all;
    }

    &-enter-to, &-leave {
      opacity: 1;
      transform: translateX(0%);
    }

    &-enter, &-leave-to {
      opacity: 0.5;
      transform: translateX(150%);
    }
  }
</style>
