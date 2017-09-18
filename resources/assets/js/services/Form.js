import { Errors } from './Errors'

export class Form {

  constructor (data) {

    this.originalData = data;

    for (let field in data) {
      this[field] = data[field]
    }

    this.errors = new Errors()
  }

  data () {
    return _.omit(this, ['errors', 'originalData'])
  }

  reset () {
    for (var field in this.originalData) {
      this[field] = this.originalData[field]
    }

    this.errors.clear();
  }

  set(data) {
    for (var field in this.originalData) {
      if (data.hasOwnProperty(field)) {
        this[field] = data[field];
      }
    }

    return this
  }

}
