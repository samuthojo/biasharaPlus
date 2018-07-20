@extends('layouts.app2')

@section('more')
  <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
  <script src="{{asset('js/datepicker.js')}}"></script>
  <script>
    $(document).ready( function() {
      $('[data-toggle="datepicker"]').datepicker({
          format: 'yyyy-mm-dd'
          autoclose: true
      });
    });
  </script>
  <style>
    #error-alert {
      display: inline-block;
    }
    form {
      width: 100%;
    }
  </style>
@endsection

@section('content')

@if(request()->session()->has('message'))
  <div id="alert-success" class="alert alert-success">
    {{request()->session()->pull('message')}}
  </div>
@endif

@include('alerts.success-alert')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;" class="panel-title pull-left">
      Send Payments: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">

      <div id="error-alert" class="alert alert-danger"
        style="display: none;">
      </div>

      @if ($errors->any())
        <div class="alert alert-danger" style="display: inline-block;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form name="send_payment_form" id="send_payment_form"
        method="post" action="{{ route('post_payments') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="sender">Sender:</option>
          <input type="text" id="sender"
            name="sender" class="form-control"
            placeholder="Sender"
            value="{{ old('sender') }}" autofocus>
        </div>

        <div class="form-group">
          <label for="amount">Amount:</option>
          <input type="text" id="amount" name="amount"
            class="form-control" placeholder="Amount"
            value="{{ old('amount') }}">
        </div>

        <div class="form-group">
          <label for="date_payed">Date Payed:</option>
          <input type="text" id="date_payed" name="date_payed"
            class="form-control" placeholder="Date Payed"
            value="{{ old('date_payed') }}" data-toggle="datepicker">
        </div>

        <div class="form-group">
          <label for="operator_type">Operator Type:</label>
          <select id="operator_type" name="operator_type" style="width: 200px"
            class="form-control">
            <option value="">Choose operator</option>
            <option value="M-PESA">M-PESA</option>
            <option value="TIGO-PESA">TIGO-PESA</option>
            <option value="AIRTEL MONEY">AIRTEL MONEY</option>
            <option value="VOUCHER">VOUCHER</option>
            <option value="CASH">CASH</option>
          </select>
        </div>

        <div class="form-group">
          <label for="reference_no">Reference Number:</option>
          <input type="text" id="reference_no" name="reference_no"
            class="form-control" placeholder="Reference Number"
            value="{{ old('reference_no') }}">
        </div>

        <div class="form-group">
          <label for="total_to_date">Total To Date:</option>
          <input type="text" id="total_to_date" name="total_to_date"
            class="form-control" placeholder="Total to date"
            value="0" readonly>
        </div>

        <div class="form-group">
          <button class="btn btn-success" type="submit">
            Submit
          </button>
          @include('inline_loader')
        </div>

      </form>

    </div>
  </div>
</div>
<script>
  $(function() {
    $(":text").keydown(function() {
      $(".alert-danger").fadeOut(0);
    });
  });
</script>
@endsection
