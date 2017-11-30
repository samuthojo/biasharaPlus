@extends('layouts.app')

@section('more')
  {{--<script src="{{asset('js/send_payments.js')}}"></script>--}}
  <style>
    #error-alert {
      display: inline-block;
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
        method="post" action="">
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
            class="form-control" placeholder="Amount">
        </div>

        <div class="form-group">
          <label for="date_payed">Date Payed:</option>
          <input type="text" id="date_payed" name="date_payed"
            class="form-control" placeholder="Date Payed">
        </div>

        <div class="form-group">
          <label for="operator_type">Operator Type:</option>
          <input type="text" id="operator_type" name="operator_type"
            class="form-control" placeholder="Operator Type">
        </div>

        <div class="form-group">
          <label for="reference_no">Reference Number:</option>
          <input type="text" id="reference_no" name="reference_no"
            class="form-control" placeholder="Reference Number">
        </div>

        <div class="form-group">
          <label for="total_to_date">Total To Date:</option>
          <input type="text" id="total_to_date" name="total_to_date"
            class="form-control" placeholder="Total to date">
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
