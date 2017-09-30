import queryString from 'query-string'

export default class Filter {

  /**
   * Create Filter class
   *
   * @param  array filters
   * @return void
   */
  constructor(filters) {
    this.filters = filters;
  }

  /**
   * Get all or by key
   *
   * @param  mixed key
   * @return mixed
   */
  get(key = false) {
    if (!key)
      return this.filters

    if (this.exists(key))
      return this.filters[key]

    return null
  }

  /**
   * set key to filters
   *
   * @param string key
   * @param string value
   * @return this
   */
  set(key, value) {
    this.filters[key] = (!!value) ? value : null

    return this
  }

  /**
   * Run over object and set all his keys
   *
   * @param Object object
   * @return this
   */
  setAll(object) {
    _.each(this.filters, (value, key) => {
      if (_.hasIn(object, key)) {
        this.filters[key] = (!object[key]) ? null : object[key]
      }
    })

    return this
  }

  /**
   * make query string from fiters array
   *
   * @return string
   */
  stringify() {
    return '?' + queryString.stringify(this.stripedFilters())
  }

  /**
   * parse query string and set it into the filters array
   *
   * @param  string string
   * @return this
   */
  parse(string) {
    this.setAll(queryString.parse(string))

    return this;
  }

  /**
   * set the given keys to null
   *
   * @param  array keys
   * @return this
   */
  clearKeys(keys = []) {
    _.each(keys, (value) => {
      this.filters[value] = null
    })

    return this
  }

  /**
   * check if key exists in the filters array
   *
   * @param  string key
   * @return boolean
   */
  exists(key) {
    return (_.hasIn(this.filters, key)) ? true : false
  }

  /**
   * return filters array without the null
   *
   * @return object
   */
  stripedFilters() {
    return _.omitBy(this.filters, _.isNull)
  }

}
