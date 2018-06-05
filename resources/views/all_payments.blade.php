@extends('layouts.app')

@section('more')
  @include('header')
  <!-- DataTable Date Sorting functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js">
  </script>

  <!-- DataTable Date Sorting functionality-->
  <script type="text/javascript" charset="utf8"
    src="//cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js">
  </script>
@endsection

@section('content')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 style="font-weight: bold;" class="panel-title">
        All Payments:
      </h3>
    </div>
    <div class="panel-body" id="paymentsSection">

      <payment-table :payments="{{ $payments }}"></payment-table>

    </div>
  </div>
  <script>
    new Vue({
      el: '#paymentsSection'
    })
  </script>

@endsection
