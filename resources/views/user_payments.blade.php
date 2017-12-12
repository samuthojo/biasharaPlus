@extends('layouts.app')

@section('more')
  @include('header')
@endsection

@section('content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        @php
          $myCountry = $user->country;
          if($myCountry == '0') {
            $country = 'Tanzania';
          }
          else if($myCountry == '1') {
            $country = 'Kenya';
          }
          else if($myCountry == '2') {
            $country = 'Uganda';
          }
          else {
            $country = $myCountry;
          }
        @endphp
        Payments, User: {{$user->username. ', Country: '.  $country}}
      </h3>
      <div class="btn-group pull-right">
        <a class="btn btn-success" href="{{url('/users')}}"
          title="back">
          <i class="fa fa-arrow-left"
            style="font-size: 16px;"></i>
        </a>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="paymentsTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>No.</th>
            <th>Date</th>
            <th>Amount</th>
            <th>ReferenceNo.</th>
            <th>Operator</th>
          </thead>
          <tbody>
            @foreach($payments as $payment)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{$loop->iteration}}</td>
                <td>
                  {{\Carbon\Carbon::parse($payment->date_payed)->format('d-m-Y')}}
                </td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->reference_no}}</td>
                <td>{{$payment->operator_type}}</td>
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
          buttons: [
              {
                extend: 'print',
                exportOptions: {
                  columns: ":not(:last-child)"
                },
                title: "Payments By {{$user->username}}",
                messageTop: "{{$user->username}} As Of Payments As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Payments By {{$user->username}}",
                 messageTop: "{{$user->username}} As Of Payments As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Payments By {{$user->username}}",
                 messageTop: "{{$user->username}} As Of Payments As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });
  </script>

@endsection
