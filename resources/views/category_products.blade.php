@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/category_products.js')}}"></script>
  <style>
    td.details-control {
      background: url('../../../images/details_open.png') no-repeat center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('../../../images/details_close.png') no-repeat center;
    }
  </style>
@endsection

@section('content')

@include('modals.add_category_product_modal')
@include('modals.edit_category_product_modal')
@include('modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'You are about to delete this product!',
  'action' => 'Confirm',
  'function' => 'deleteCategoryProducts()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('alerts.success-alert')
<div class="panel panel-default">

  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      {{$category->name}} Products:
    </h3>
    <div class="btn-group pull-right">
      <a class="btn btn-success" href="{{url('/categories')}}"
        title="back">
        <i class="fa fa-arrow-left"
          style="font-size: 16px;"></i>
      </a>
      <button class="btn btn-success"
        title="add product"
        onclick="showModal('add_category_product_modal')">
        <i class="fa fa-plus-circle"
          style="font-size: 16px;"></i>
      </button>
    </div>
    <!-- <span onclick="showModal('add_product_modal')"
      title="add product" style="cursor: pointer;"
      class="pull-right text-success">
      <i class="fa fa-plus-circle fa-2x"></i>
    </span> -->
    <div class="clearfix"></div>
  </div>

  <div class="panel-body">
    <div id="categoryProductsTable" class="table-responsive">
      <table id="myTable" class="table table-hover">
        <thead>
          <th></th>
          <th style="display: none;"></th>
          <th>No.</th>
          <th>Name</th>
          <th>Code</th>
          <th>CC</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
              <td class="details-control" title="view more"></td>
              <td style="display: none;">{{$product->id}}</td>
              <td>{{$loop->iteration}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->code}}</td>
              <td>{{sprintf('%s', number_format($product->cc, 3))}}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-default" title="view prices"
                    href="{{url('/categories/' . $category->id . '/products/' . $product->id . '/prices')}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                  <button class="btn btn-warning" title="edit product"
                    onclick="showEditProductsModal({{$product}})">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                  <button class="btn btn-danger" title="delete product"
                    onclick="showProductsDeleteModal({{$product}})">
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
  $(function() {
    myDataTable('{{$category->name}}');
    $(":text").keydown(function() {
      $(this).next().fadeOut(0);
    });
  });
  function myDataTable(category_name) {
    table = $("#myTable").DataTable({
       dom: 'Bfrtip',
       buttons: [
           {
             extend: 'print',
             exportOptions: {
               columns: ":not(:last-child)"
             },
             title: category_name + " Products",
             messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'excel',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: category_name + " Products",
              messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
           },
            {
              extend: 'pdf',
              exportOptions: {
                columns: ":not(:last-child)"
              },
              title: category_name + " Products",
              messageTop: category_name + " Products As Of {{date('d-m-Y')}}"
           }
       ],
       iDisplayLength: 8,
       bLengthChange: false
     });

     // Add event listener for opening and closing details
     $('#myTable tbody').on('click', 'td.details-control', function () {
       var tr = $(this).closest('tr');
       var row = table.row( tr );

       var product_id = row.data()[1];

       if ( row.child.isShown() ) {
           // This row is already open - close it
           row.child.hide();
           tr.removeClass('shown');
       }
       else {
         var link = "/products/" + product_id + "/product_details";
              $.getJSON(link)
               .done( function (product) {
                 row.child.hide();
                 tr.removeClass('shown');
                 row.child(format(product)).show();
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
