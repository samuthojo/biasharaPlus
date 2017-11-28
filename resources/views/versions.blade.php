@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/versions.js')}}"></script>
  <style>
    td.details-control {
      background: url('../images/details_open.png') no-repeat center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('../images/details_close.png') no-repeat center;
    }
  </style>
@endsection

@section('content')

@include('modals.add_version_modal')
@include('modals.edit_version_modal')
{{--@include('modals.confirmation_modal',
  ['id' => 'deactivate_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Mark version as old!',
  'action' => 'Confirm',
  'function' => 'setInActive()',])
@include('modals.confirmation_modal',
  ['id' => 'activate_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Mark version as current!',
  'action' => 'Confirm',
  'function' => 'setActive()',])--}}

@include('alerts.success-alert')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        Versions:
      </h3>
      <span class="pull-right text-success"
        title="add version" style="cursor: pointer;"
        onclick="showModal('add_version_modal')">
        <i class="fa fa-plus-circle fa-2x"></i>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="versionsTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th></th>
            <th style="display: none;"></th>
            <th>No.</th>
            <th>Version</th>
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($versions as $version)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td class="details-control" title="view more"></td>
                <td style="display: none;">{{$version->id}}</td>
                <td>{{$loop->iteration}}</td>
                <td>{{$version->version_number}}</td>
                <td>{{($version->status) ? 'Current' : 'Old'}}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning" title="edit version"
                      onclick="showEditVersionModal({{$version}})">
                      <span class="glyphicon glyphicon-pencil"></span>
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
             title: "Versions",
             messageTop: "The List Of Versions As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'excel',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Versions",
              messageTop: "The List Of Versions As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'pdf',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: "Versions",
              messageTop: "The List Of Versions As Of {{date('d-m-Y')}}"
           }
       ],
       iDisplayLength: 8,
       bLengthChange: false
     });

     $(":text").keydown(function() {
       $(this).next().fadeOut(0);
     });

     $("textarea").keydown(function() {
       $(this).next().fadeOut(0);
     });

     // Add event listener for opening and closing details
     $('#myTable tbody').on('click', 'td.details-control', function () {
       var tr = $(this).closest('tr');
       var row = table.row( tr );

       var version_id = row.data()[1];

       if ( row.child.isShown() ) {
           // This row is already open - close it
           row.child.hide();
           tr.removeClass('shown');
       }
       else {
         var link = "/versions/" + version_id + "/version_details";
              $.getJSON(link)
               .done( function (version) {
                 row.child.hide();
                 tr.removeClass('shown');
                 row.child(format(version)).show();
                 tr.addClass('shown');
               })
               .fail( function (error) {
                 console.log(error);
               });
               row.child(format2()).show();
               tr.addClass('shown');
       }
     });
  }
</script>
@endsection
