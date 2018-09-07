@extends('layouts.app2')

@section('more')
  @include('header')
    
  <!-- DataTable Date Sorting functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js">
  </script>

  <!-- DataTable Date Sorting functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js">
  </script>
@endsection

@section('content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title">
        All Payments:
      </h3>
    </div>
    @verbatim
    <div class="panel-body" id="vue-container">
      <div id="allPaymentsTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>Date</th>
            <th>Sender</th>
            <th>Amount</th>
            <th>ReferenceNo.</th>
            <th>Operator</th>
            <th>Status</th>
            <th>Done</th>
          </thead>
          <tbody>
            <tr v-for="(payment, n) in items">
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
              <td>
                <button
                  v-if="!payment.redeemed"
                  type="button"
                  class="btn btn-warning"
                  @click="onDeletePayment(payment, n)">
                  Done
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        
        <payment-redeem-modal
          :show-modal="showRedeemModal"
          :index = paymentIndex
          :payment="payment"
          @payment-redeemed="onPaymentRedeemed"
          @close="showRedeemModal = false"/>

        <payment-delete-confirmation-modal
          :show-modal="showDeleteModal"
          :index = paymentIndex
          :payment="payment"
          @payment-deleted="onPaymentDeleted"
          @close="showDeleteModal = false"/>
          
      </div>
    </div>
    @endverbatim
    {{--<div class="panel-body" id="paymentsSection">

      <payment-table :payments="{{ $payments }}"></payment-table>

    </div>--}}
  </div>
  {{--<script>
    new Vue({
      el: '#paymentsSection'
    })
  </script>--}}
  
  <script>
  $(document).ready( function() {
    callMe();
  });

  function callMe() {
    table = $("#myTable").DataTable({
       dom: 'Bfrtip',
       buttons: [
           {
             extend: 'print',
             exportOptions: {
               columns: ":not(:last-child)"
             },
             title: "Payments",
             messageTop: "The List Of Payments As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'excel',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Payments",
              messageTop: "The List Of Payments As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'pdf',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Payments",
              messageTop: "The List Of Payments As Of {{date('d-m-Y')}}"
           }
       ],
       iDisplayLength: 20,
       bLengthChange: false
     });

     $(":text").keydown(function() {
       $(this).next().fadeOut(0);
     });
     
     $(":radio").keydown(function() {
       $(this).next().fadeOut(0);
     });

     $("textarea").keydown(function() {
       $(this).next().fadeOut(0);
     });
  }
  
  var vm = new Vue({
    el: "#vue-container",
    data: {
      items: [],
      showRedeemModal: false,
      showDeleteModal: false,
      payment: {},
      paymentIndex: 0,
      isLoading: false,
    },
    created() {
      this.items = {!! json_encode($payments) !!}
    },
    methods: {
      onRedeemPayment(payment, index) {
        this.payment = payment

        this.paymentIndex = index

        this.showRedeemModal = true
      },

      onDeletePayment(payment, index) {
        this.payment = payment

        this.paymentIndex = index

        this.showDeleteModal = true
      },

      onPaymentRedeemed(payload) {
        this.items.splice(payload.index, 1, payload.payment)

        this.showRedeemModal = false
      },

      onPaymentDeleted(payload) {
        this.items.splice(payload.index, 1)

        this.showDeleteModal = false
      },
    },
    filters: {

      numberFormat(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
          prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
          sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
          dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
          s = '',
          toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
          };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
          s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
          s[1] = s[1] || '';
          s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
      },

    },
  })
     
  </script>

@endsection
