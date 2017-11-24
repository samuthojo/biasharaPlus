@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/products.js')}}"></script>
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

@include('modals.add_product_modal')
@include('modals.edit_product_modal')
@include('modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'You are about to delete this product!',
  'action' => 'Confirm',
  'function' => 'deleteProduct()',])

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('alerts.success-alert')
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        Products:
      </h3>
      <span class="pull-right text-success"
        title="add product" style="cursor: pointer;"
        onclick="showModal('add_product_modal')">
        <i class="fa fa-plus-circle fa-2x"></i>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th></th>
            <th style="display: none;"></th>
            <th>No.</th>
            <th>Name</th>
            <th>Category</th>
            <th>Code</th>
            <th>CC</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr class="{{($loop->index % 2 == 0) ? 'success' : ''}}">
                <td class="details-control" title="view more"></td>
                <td style="display: none;">{{$product->id}}</td>
                <td>{{$loop->iteration}}</td>
                <td id="{{'product_name_' . $product->id}}">{{$product->name}}</td>
                <td id="{{'category_name_' . $product->id}}">{{$product->category_name}}</td>
                <td id="{{'product_code_' . $product->id}}">{{$product->code}}</td>
                <td id="{{'product_cc_' . $product->id}}">{{$product->cc}}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-default" title="view prices"
                      href="{{url('/products/' . $product->id . '/prices')}}">
                      <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <button class="btn btn-warning" title="edit product"
                      onclick="showEditProductModal({{$product->id}})">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-danger" title="delete product"
                      onclick="showProductDeleteModal({{$product->id}})">
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
@endsection
