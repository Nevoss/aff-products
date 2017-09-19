<template lang="html">
  <ul class="pagination">

    <li class="page-item" :class="{ disabled: !dataLinks.prev }">
      <a class="page-link" href="#" @click.prevent="change(dataMeta.current_page - 1)">Prev</a>
    </li>

    <li v-if="dataMeta.current_page > 1 + gap">
      <a class="page-link" href="#" @click.prevent="change(1)"> .. </a>
    </li>

    <li class="page-item" :class="{ active: dataMeta.current_page == pageNum }" v-for="pageNum in pageLinks">
      <a class="page-link" href="#" @click.prevent="change(pageNum)"> {{ pageNum }} </a>
    </li>

    <li v-if="dataMeta.current_page < dataMeta.last_page - gap">
      <a class="page-link" href="#" @click.prevent="change(dataMeta.last_page)"> .. </a>
    </li>

    <li class="page-item" :class="{ disabled: !dataLinks.next }">
      <a class="page-link" href="#" @click.prevent="change(dataMeta.current_page + 1)">Next</a>
    </li>

  </ul>
</template>

<script>
export default {
  props: [ 'data-meta', 'data-links' ],
  data() {
    return {
      gap: 1
    }
  },
  computed: {
    pageLinks() {

      var links = []
      var currentPage = this.dataMeta.current_page

      for (let i = currentPage - this.gap; i <= currentPage + this.gap; i++ ) {
        if (this.isExists(i)) {
          links.push(i)
        }
      }

      return links
    }
  },
  methods: {
    change(pageNum) {
      if (this.isExists(pageNum)) {
        this.$emit('changed', { page: pageNum })
      }
    },

    isExists(pageNum) {
      return (pageNum >= 1 && pageNum <= this.dataMeta.last_page)
    }
  },
}
</script>
