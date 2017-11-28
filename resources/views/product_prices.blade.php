@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/product_prices.js')}}"></script>
@endsection

@section('content')

@include('modals.edit_price_modal')

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif
@include('alerts.success-alert')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title pull-left">
        {{$product->name}} Prices:
      </h3>
      <a class="btn btn-success pull-right" title="back"
        href="{{'../'}}"
        style="cursor: pointer;">
        <i class="fa fa-arrow-left" style="font-size: 18px;"></i>
      </a>
      <!-- <span class="pull-right text-success" title="add price-list"
        onclick="showModal('add_price_modal')"
        style="cursor: pointer;">
        <i class="fa fa-plus-circle fa-2x"></i>
      </span> -->
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div id="productPricesTable" class="table-responsive">
        <table id="myTable" class="table table-hover">
          <thead>
            <th>No.</th>
            <th>PriceList</th>
            <th>Price</th>
            <th>TanzaniaPrice</th>
            <th>KenyaPrice</th>
            <th>UgandaPrice</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($prices as $price)
              <tr class="{{($loop->index % 2 == 0) ? 'active' : ''}}">
                <td>{{$loop->iteration}}</td>
                <td id="{{'pricelist_name_' . $price->id}}">{{$price->pricelist_name}}</td>
                <td id="{{'price_' . $price->id}}">
                  {{sprintf("%s", number_format($price->price))}}
                </td>
                <td id="{{'tanzania_' . $price->id}}">
                  {{sprintf("%s", number_format($price->tanzania))}}
                </td>
                <td id="{{'kenya_' . $price->id}}">
                  {{sprintf("%s", number_format($price->kenya))}}
                </td>
                <td id="{{'uganda_' . $price->id}}">
                  {{sprintf("%s", number_format($price->uganda))}}
                </td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning" title="update price"
                      onclick="showEditPriceModal({{$price}})">
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
    $(function () {
      myDataTable('{{$product->name}}');
      $(":text").keydown(function() {
        $(this).next().fadeOut(0);
      });
    });
    function myDataTable(product_name) {
      $("#myTable").dataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'print',
                exportOptions: {
                  columns: ":not(:last-child)"
                },
                title: product_name + "Prices",
                messageTop: product_name + " Prices As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'excel',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: product_name + "Prices",
                 messageTop: product_name + " Prices As Of {{date('d-m-Y')}}"
              },
               {
                 extend: 'pdf',
                 exportOptions: {
                   columns: ":not(:last-child)"
                 },
                 title: product_name + "Prices",
                 messageTop: product_name + " Prices As Of {{date('d-m-Y')}}"
              }
          ],
          iDisplayLength: 8,
          bLengthChange: false
      });

    }
  </script>

@endsection
