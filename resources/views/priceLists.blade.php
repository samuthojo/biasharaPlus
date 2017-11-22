@extends('layouts.app')

@section('more')
  @include('header')
@endsection

@include('modals.add_pricelist_modal')
@include('modals.edit_pricelist_modal')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        PriceLists:
      </h3>
      <span class="pull-right text-success" title="add price-list"
        onclick="showModal('add_pricelist_modal')"
        style="cursor: pointer;">
        <i class="fa fa-plus-circle fa-2x"></i>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Effective Date</th>
            <th>Color</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($priceLists as $priceList)
              <tr class="{{($loop->index % 2 == 0) ? 'success' : ''}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$priceList->name}}</td>
                <td>{{$priceList->effective_date}}</td>
                <td>{{$priceList->color}}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning" title="edit price-list"
                      onclick="showModal('edit_pricelist_modal')">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-danger" title="delete price-list">
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
    $(document).ready(function () {
      $("#myTable").dataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'print',
                exportOptions: {
                  columns: ":not(:last-child)"
                },
                title: "PriceLists",
                messageTop: "The List Of PriceLists As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "PriceLists",
                 messageTop: "The List Of PriceLists As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: "PriceLists",
                 messageTop: "The List Of PriceLists As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });
    });
  </script>

@endsection
