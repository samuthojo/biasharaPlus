<template lang="html">

  <div id="allPaymentsTable" class="table-responsive">

    <table id="myTable" class="table table-hover">
      <thead>
        <th>Date</th>
        <th>Sender</th>
        <th>Amount</th>
        <th>ReferenceNo.</th>
        <th>Operator</th>
        <th>Status</th>
        <th>Total To Date (Tshs)</th>
      </thead>
      <tbody>
          <tr v-for="(payment, n) in payments">
            <td>{{ payment.date_payed }}</td>
            <td>{{ payment.sender }}</td>
            <td>{{ payment.amount | numberFormat }}</td>
            <td>{{ payment.reference_no }}</td>
            <td>{{ payment.operator_type }}</td>
            <td>
              <span v-show="payment.redeemed" class="text-success">
                Redeemed
              </span>
              <button
                type="button"
                v-show="!payment.redeemed"
                class="btn btn-danger"
                @click="onRedeemPayment(payment, n)">
                Pending
              </button>
            </td>
            <td>{{ payment.total_to_date | numberFormat }}</td>

          </tr>
      </tbody>
    </table>

    <payment-redeem-modal
      :show-modal="showRedeemModal"
      :index = paymentIndex
      :payment="payment"
      @payment-redeemed="onPaymentRedeemed"/>

  </div>

</template>

<script>
export default {
  props: {
    payments: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      showRedeemModal: false,
      payment: {},
      paymentIndex: 0
    }
  },

  methods: {
    onRedeemPayment(payment, index) {
        this.payment = payment

        this.paymentIndex = index

        this.showRedeemModal = true
    },

    onPaymentRedeemed(payload) {
      this.payments.splice(payload.index, 1, payload.data)

      this.showRedeemModal = false
    }
  },

  filters: {

    numberFormat(number, decimals, dec_point, thousands_sep) {
       number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
       var n = !isFinite(+number) ? 0 : +number,
       prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
       sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
       dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
       s = '',
       toFixedFix = function (n, prec)
       {
           var k = Math.pow(10, prec);
           return '' + Math.round(n * k) / k;
       };
       // Fix for IE parseFloat(0.55).toFixed(0) = 0;
       s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
       if (s[0].length > 3)
       {
           s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
       }
       if ((s[1] || '').length < prec)
       {
           s[1] = s[1] || '';
           s[1] += new Array(prec - s[1].length + 1).join('0');
       }
       return s.join(dec);
    }

  }

}
</script>

<style lang="css">
</style>
