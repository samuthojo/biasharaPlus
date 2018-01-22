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
    <div class="panel-body">
      <div id="allPaymentsTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>Date</th>
            <th>Sender</th>
            <th>Amount</th>
            <th>ReferenceNo.</th>
            <th>Operator</th>
            <th>Total To Date (Tshs)</th>
          </thead>
          <tbody>
            @foreach($payments as $payment)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>
                  {{\Carbon\Carbon::parse($payment->date_payed)->format('d-m-Y')}}
                </td>
                <td>{{$payment->sender}}</td>
                <td>{{number_format($payment->amount)}}</td>
                <td>{{$payment->reference_no}}</td>
                <td>{{$payment->operator_type}}</td>
                <td>{{number_format($payment->total_to_date)}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $("#myTable").dataTable({
          dom: 'Bfrtip',
          "order": [[ 1, "desc" ]] ,
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
  </script>

@endsection
