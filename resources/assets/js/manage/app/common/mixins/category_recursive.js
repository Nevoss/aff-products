export default {
  methods: {
    recursiveCategories(categories, prefix = '') {
      var final = []

      categories.forEach((item) => {
        final.push({
          name: prefix + item.name,
          id: item.id
        })
        if (item.child_categories) {
          final = final.concat(
            this.recursiveCategories(item.child_categories, prefix + '-- ')
          );
        }
      })

      return final;
    },
  }
}
