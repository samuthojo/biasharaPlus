@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/category_products.js')}}"></script>
@endsection

<style>
  td.details-control {
    background: url('../images/details_open.png') no-repeat center;
    cursor: pointer;
  }
  tr.shown td.details-control {
    background: url('../images/details_close.png') no-repeat center;
  }
</style>
@include('modals.add_product_modal')
@include('modals.edit_product_modal')
@include('modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'You are about to delete this product!',
  'action' => 'Confirm',
  'function' => '',])

@section('content')
<div class="panel panel-default">

  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Products, {{$category->name}}
    </h3>
    <span onclick="showModal('add_product_modal')"
      title="add product" style="cursor: pointer;"
      class="pull-right text-success">
      <i class="fa fa-plus-circle fa-2x"></i>
    </span>
    <div class="clearfix"></div>
  </div>

  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-hover">
        <thead>
          <th></th>
          <th>No.</th>
          <th>Name</th>
          <th>Code</th>
          <th>CC</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr class="{{($loop->index % 2 == 0) ? 'success' : ''}}">
              <td class="details-control" title="view more"></td>
              <td>{{$loop->iteration}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->code}}</td>
              <td>{{$product->cc}}</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning" title="edit product"
                    onclick="">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                  <button class="btn btn-default" title="view price"
                    onclick="">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
                  <button class="btn btn-danger" title="delete product"
                    onclick="">
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
    myDataTable({{$category->name}});
  });
</script>
@endsection
