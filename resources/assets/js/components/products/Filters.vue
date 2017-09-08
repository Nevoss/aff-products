<template lang="html">
<div>
  <div class="row align-item-center">
    <div class="col-md-9">
      <div class="d-flex align-items-center">
        Order By:
        <div class="small-box d-flex ml-3">

          <div class="px-3 orderItem" :class="{active: filters.get('latest') == 1}" @click="chooseOrder('latest', '1')">
            Newest <i class="icon-arrow-down"></i>
          </div>

          <div class="px-3 bl-1 orderItem"
            :class="{active: filters.get('price') == 'desc' || filters.get('price') == 'asc'}"
            @click="chooseOrder('price', priceOrder)">
            Price
            <i class="icon-arrow-up" v-if="filters.get('price') == 'asc'"></i>
            <i class="icon-arrow-down" v-else></i>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="icon-magnifier"></i>
        </span>
        <input type="text" class="form-control" placeholder="Search" :value="filters.get('search')" @input="search">
      </div>
    </div>
  </div>
</div>
</template>

<script>
import Filters from '../../services/Filters'

export default {
  data() {
    return {
      searchTimer: 0,
      orders: [ 'latest', 'price' ],
      filters: new Filters({
        latest: 1,
        price: null,
        search: null,
      })
    }
  },
  computed: {
    priceOrder() {
      return (!this.filters.get('price') || this.filters.get('price') == 'asc') ? 'desc' : 'asc'
    }
  },
  methods: {
    chooseOrder(key, value) {
      this.filters.clearKeys(this.orders)
      this.filters.set(key, value)

      this.filtersChanged()
    },

    search(e) {
      clearTimeout(this.searchTimer)
      this.searchTimer = setTimeout(() => {

        this.filters.set('search', e.target.value)
        this.filtersChanged()

      }, 400)
    },

    filtersChanged() {
      history.pushState(null, null, this.filters.stringify())

      this.$emit('changed', this.filters.get())
    },
  },
  created() {
    this.filters.parse(location.search)

    this.$emit('changed', this.filters.get())
  }
}
</script>

<style lang="scss">
  .bl-1 {
    display: block;
    border-left: 1px solid #ddd;
  }

  .orderItem {
    cursor: pointer;

    &.active {
      color: #007bff;
    }
  }
</style>
