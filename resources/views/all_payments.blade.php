@extends('layouts.app')

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
    <div class="panel-body" id="paymentsSection">

      <payment-table :payments="{{ $payments }}"></payment-table>

    </div>
  </div>
  <script>
    $(document).ready(function () {
      $.fn.dataTable.moment('DD-MM-YYYY'); //Sort the date column if present
      $("#myTable").dataTable({
          dom: 'Bfrtip',
          "order": [[0, "desc"]],
          buttons: [
              {
                extend: 'print',
                exportOptions: {
                  columns: ":not(:last-child)"
                },
                title: "Payments",
                messageTop: "Payments As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Payments",
                 messageTop: "Payments As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Payments",
                 messageTop: "Payments As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });

    new Vue({
      el: '#paymentsSection'
    })
  </script>

@endsection
