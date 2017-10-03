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
