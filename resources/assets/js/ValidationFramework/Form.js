import { Errors } from './Errors.js';

export class Form {

  constructor(data) {

    this.originalData = data;

    for(let field in data) {
      this[field] = data[field];
    }

    this.errors = new Errors();

  }

  submit(requestType, url) {
    requestType = _.toLower(requestType);
    return new Promise((resolve, reject) => {
      axios[requestType](url, this.data())
        .then(response => resolve(response))
        .catch(error => reject(error));
    })
  }

  data() {
    let data = _.clone(this);

    delete data.originalData;

    delete data.errors;

    return data;
  }

  onSuccess() {
    this.errors.clear();
  }

  reset() {
    for(let field in this.originalData) {
      this[field] = "";
    }
  }

  onFail(error) {
    this.errors.record(error.response.data.errors);
  }
}
