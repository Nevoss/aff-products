export class Errors {

  constructor () {
    this.errors = {}
  }

  get (field) {

    if (!_.isEmpty(field) && this.errors[field]) {
      var error = this.errors[field]
    } else {
      let firstProp = Object.keys(this.errors)[0]
      var error = this.errors[firstProp]
    }

    return (_.isArray(error)) ?
      error[0] :
      error
  }

  any () {
    return !_.isEmpty(this.errors)
  }

  has (field) {
    return _.has(this.errors, field);
  }

  record (errors) {
    this.errors = errors
  }

  clear (field) {
    if (field) {
      this.errors = _.omit(this.errors, field)
      return;
    }
    this.errors = {}
  }

}
