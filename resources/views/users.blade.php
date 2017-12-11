@extends('layouts.app')

@section('more')
  @include('header')
  <style>
    .table-bordered>thead>tr>th {
      /*color: #3c763d;*/
      color: #000;
    }

    .table-bordered>tbody>tr>th {
      color: #000;
    }

    h4 {
      font-weight: bold;
      font-size: 1.25em;
    }
  </style>
@endsection

@section('content')
  <div class="container-fluid">

    <div class="table-responsive">

      <h4 class="text-success" style="color: #f0ad4e;">Summary: </h4>
      <table class="table table-hover table-condensed table-bordered">
        <thead>
          <tr>
            <th>Accounts:</th>
            <th>Total</th>
            <th>Tanzania</th>
            <th>Kenya</th>
            <th>Uganda</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>User Accounts</th>
            <td>{{sprintf('%s', number_format($total_accounts))}}</td>
            <td>{{sprintf('%s', number_format($tz_accounts))}}</td>
            <td>{{sprintf('%s', number_format($kenya_accounts))}}</td>
            <td>{{sprintf('%s', number_format($uganda_accounts))}}</td>
          </tr>
          <tr>
            <th>Free Accounts</th>
            <td>{{sprintf('%s', number_format($free_accounts))}}</td>
            <td>{{sprintf('%s', number_format($free_tz_accounts))}}</td>
            <td>{{sprintf('%s', number_format($free_kenya_accounts))}}</td>
            <td>{{sprintf('%s', number_format($free_uganda_accounts))}}</td>
          </tr>
          <tr>
            <th>Premium Accounts</th>
            <td>{{sprintf('%s', number_format($premium_accounts))}}</td>
            <td>{{sprintf('%s', number_format($premium_tz_accounts))}}</td>
            <td>{{sprintf('%s', number_format($premium_kenya_accounts))}}</td>
            <td>{{sprintf('%s', number_format($premium_uganda_accounts))}}</td>
          </tr>
        </tbody>
      </table>


    </div>

  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        Users:
      </h3>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Country</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Subscription</th>
            <th>StartDate</th>
            <th>EndDate</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$user->username}}</td>
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
                <td>{{$country}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone_number}}</td>
                <td>{{$user->subscription}}</td>
                <td>{{$user->subscription_start_date}}</td>
                <td>{{$user->subscription_end_date}}</td>
                <td>
                  <a href="{{url('/users/' . $user->id . '/payments')}}"
                    class="btn btn-warning" title="view payment">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                </td>
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
                title: "Users",
                messageTop: "The List Of Users As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Users",
                 messageTop: "The List Of Users As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "Users",
                 messageTop: "The List Of Users As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });
  </script>
@endsection
