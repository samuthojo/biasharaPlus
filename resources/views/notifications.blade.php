@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/notifications.js')}}"></script>
@endsection

@section('content')
<div id="error-alert" class="alert alert-danger"
  style="display: none;">
</div>

@if(request()->session()->has('message'))
<div id="alert-success" class="alert alert-success">
  {{request()->session()->pull('message')}}
</div>
@endif

@include('alerts.success-alert')
@if ($errors->any())
  <div class="alert alert-danger" style="display: inline-block;">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;"class="panel-title pull-left">
      Notifications: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">

      <form name="notification_form" id="notification_form"
        method="post" action="{{url('/notifications')}}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="type">Notification Type: </label>
          <select id="type" name="type" onchange="generalNews()"
            class="form-control">
            <option value="" selected disabled>Choose Type</option>
            <option value="1">New Products</option>
            <option value="2">General News</option>
          </select>
        </div>

        <div class="form-group" id="notification_title" style="display:none;">
          <label for="title">Title:</option>
          <input type="text" id="title" name="title" class="form-control"
            placeholder="title" value="{{ old('title')}}">
        </div>

        <div class="form-group" id="general_news" style="display:none;">
          <label for="news">News:</option>
          <textarea id="news" name="news"
            class="form-control" placeholder="news"
            rows="3" style="width: 180px" value="{{ old('news') }}"></textarea>
        </div>

        <div class="form-group" id="submit_button">
          <button class="btn btn-success" type="submit">
            Send
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
<script>
  $(function() {
    $("#type").val("{{old('type')}}");
  });
</script>
@endsection
