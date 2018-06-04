export class Errors {

  constructor() {
    this.errors = {};
  }

  has(field) {
    return _.has(this.errors, field);
  }

  any() {
    return !(_.isEmpty(this.errors));
  }

  get(field) {
    if(this.errors[field]) {
      return this.errors[field][0];
    }
  }

  clear(field) {
    if(field) {
      Vue.delete(this.errors, field);

      return;
    }
    this.errors = {};
  }

  record(errors) {
    this.errors = errors;
  }

}
