import queryString from 'query-string'

export default class Filter {

  /**
   * Create Filter class
   *
   * @param  array filters
   * @return void
   */
  constructor(filters) {
    this.originalData = filters

    for (let field in filters) {
      this[field] = filters[field]
    }
  }

  /**
   * Run over object and set all his keys
   *
   * @param Object object
   * @return this
   */
  setAll(object) {

    _.each(this.originalData, (value, key) => {
      if (_.hasIn(object, key)) {
        this[key] = (!object[key]) ? null : object[key]
      }
    })

    return this
  }

  /**
   * Return all the data of the filters
   *
   * @return Object
   */
  data() {
    return _.pick(this, Object.keys(this.originalData))
  }

  /**
   * striped the object from falsy data
   *
   * @return Object
   */
  stripedData() {
    return _.omitBy(this.data(), (value) => !value)
  }

  /**
   * make query string from fiters array
   *
   * @return string
   */
  stringify() {
    return (_.isEmpty(this.stripedData())) ? '' : '?' + queryString.stringify(this.stripedData())
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
      this[value] = null
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
    return (_.hasIn(this.originalData, key)) ? true : false
  }


}
