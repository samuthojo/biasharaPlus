@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/pay_bill_numbers.js')}}"></script>
@endsection

@section('content')

@include('modals.add_number_modal')
@include('modals.edit_number_modal')
@include('modals.confirmation_modal',
['id' => 'delete_confirmation_modal',
'title' => 'Confirm',
'text' =>  'You are about to delete this number!',
'action' => 'Confirm',
'function' => 'deleteNumber()',])

@include('alerts.success-alert')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        PayBill Numbers:
      </h3>
      <span class="text-success pull-right"
        onclick="showModal('add_number_modal')" style="cursor:pointer;">
        <i class="fa fa-plus-circle fa-2x"></i>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="numbersTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>No.</th>
            <th>Service provider</th>
            <th>Phone Number</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($numbers as $number)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$number->service_provider}}</td>
                <td>{{$number->phone_number}}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning" title="edit number"
                      onclick="showEditNumberModal({{$number}})">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-danger" title="delete number"
                      onclick="showDeleteNumberModal({{$number->id}})">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
  $(document).ready( function() {

    callMe();

    $(":text").keydown(function() {
      $(this).next().fadeOut(0);
    });

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
             title: "PayBill Numbers",
             messageTop: "The List Of PayBill Numbers As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'excel',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "PayBill Numbers",
              messageTop: "The List Of PayBill Numbers As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'pdf',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "PayBill Numbers",
              messageTop: "The List Of PayBill Numbers As Of {{date('d-m-Y')}}"
           }
       ],
       iDisplayLength: 8,
       bLengthChange: false
     });

  }
</script>
@endsection
