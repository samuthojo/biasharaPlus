<template lang="html">

  <div :id="id" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Redeem</h4>
          <button class="close" @click="$emit('close')">
            &times;
          </button>
        </div>
          <div class="modal-body">
            <div class="container">
              <form
                name="redeem_payment_form"
                id="redeem_payment_form"
                @submit.prevent="onRedeem"
                @keydown="form.errors.clear($event.target.name)">
                <div class="form-group">
                  <label for="date_payed">Date Paid:</label>
                  <input type="text" class="form-control"
                    placeholder="e.g. 2018-06-06"
                    name="date_payed" id="date_payed"
                    v-model = "form.date_payed" readonly>
                  <span
                    v-show="form.errors.has('date_payed')"
                    v-text="form.errors.get('date_payed')"
                    class="text-danger"></span>
                </div>
                <div class="form-group">
                  <label for="sender">Sender:</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="sender"
                    id="sender"
                    name="sender"
                    v-model = "form.sender" readonly>
                  <span
                    v-show="form.errors.has('sender')"
                    v-text="form.errors.get('sender')"
                    class="text-danger"></span>
                </div>
                <div class="form-group">
                  <label for="amount">Amount:</label>
                  <input type="text" class="form-control"
                    placeholder="amount"
                    name="amount" id="amount"
                    v-model = "form.amount">
                  <span
                    v-show="form.errors.has('amount')"
                    v-text="form.errors.get('amount')"
                    class="text-danger"></span>
                </div>
                <div class="form-group">
                  <label for="operator_type">Operator Type:</label>
                  <select id="operator_type" name="operator_type" style="width: 200px" 
                    v-model="form.operator_type" 
                    @change="form.errors.clear('operator_type')"
                    class="form-control">
                    <option value="">Choose operator</option>
                    <option value="M-PESA">M-PESA</option>
                    <option value="TIGO-PESA">TIGO-PESA</option>
                    <option value="AIRTEL MONEY">AIRTEL MONEY</option>
                    <option value="VOUCHER">VOUCHER</option>
                    <option value="CASH">CASH</option>
                  </select>
                  <span
                    v-show="form.errors.has('operator_type')"
                    v-text="form.errors.get('operator_type')"
                    class="text-danger"></span>
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-default"
                    @click="$emit('close')">Cancel</button>
                  <button
                    type="submit"
                    class="btn btn-success"
                    :disabled="isLoading">Redeem</button>
                  <span class="my_loader" v-show="isLoading">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw text-success"></i>
                  </span>
                </div>
                <div class="form-group" v-if="showMessage">
                  <span :class="responseClass">{{ serverMessage }}</span>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import {
  Form
} from '../ValidationFramework/Form'

export default {
  props: {
    showModal: {
      type: Boolean,
      required: true
    },

    payment: {
      type: Object,
      required: true
    },

    index: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      error: false,
      showMessage: false,
      serverMessage: '',
      id: "redeemPaymentModal",
      isLoading: false,
      form: new Form({
        sender: '',
        date_payed: '',
        amount: '',
        operator_type: '',
        total_to_date: 0
      })
    }
  },

  created() {
    this.id = this.id + this._uid  
  },

  computed: {
    responseClass: function() {
      if (this.error) {
        return 'text-danger';
      }
      return 'text-success';
    }
  },

  watch: {
    showModal: function(val) {
      if (val) {
        this.form.date_payed = globals.getMySqlDate(this.payment.date_payed)
        
        this.form.sender = this.payment.sender
        
        $("#" + this.id).modal({
          backdrop: 'static',
          keyboard: false,
          show: true
        })
      } else {
        $("#" + this.id).modal('hide');
        $('body').removeClass("modal-open");
        $('body').removeAttr('style');
        $(".modal-backdrop").remove();
      }
    }
  },

  methods: {
    onRedeem() {

      this.isLoading = true

      let url = '/payments/' + this.payment.id + '/redeem/'

      this.form.submit('PUT', url)

        .then(({
          data
        }) => {

          this.isLoading = false

          if (data.error) {
            this.error = data.error

            this.serverMessage = data.message

            this.showMessage = true

            return
          } else {

            let payload = {
              payment: data.payment,
              index: this.index
            }

            this.error = data.error

            this.serverMessage = data.message

            this.showMessage = true

            setTimeout(() => {
              this.showMessage = false
              this.form.reset()
              this.$emit('payment-redeemed', payload)
            }, 2000)

          }

        })

        .catch(error => {
          console.error(error)

          this.isLoading = false

          this.form.onFail(error)
        })
    }
  }

}
</script>

<style lang="css">
</style>
