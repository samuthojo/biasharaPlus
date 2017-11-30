@extends('layouts.app')

@section('more')
  @include('header')
  <style>
    .sub-title {
      color: #3c763d;
    }
    .value {
      font-weight: bold;
    }
    .summary {
      line-height: 30px;
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="container-fluid summary" style="margin-bottom: 10px;">
      <span class="text-success" style="font-weight: bold;">Summary:</span><br>
      <span class="sub-title">Total User Accounts: </span>
        <span class="value">{{sprintf('%s', number_format($total_accounts))}}</span><br>
      <span class="sub-title">Total Free Accounts: </span>
      <span class="value">{{sprintf('%s', number_format($free_accounts))}}</span><br>
      <span class="sub-title">Total Premium Accounts: </span>
      <span class="value">{{sprintf('%s', number_format($premium_accounts))}}</span><br>
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
                <td>{{$user->country}}</td>
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