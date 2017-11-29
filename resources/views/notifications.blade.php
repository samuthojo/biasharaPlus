@extends('layouts.app')

@section('more')
  @include('header')
  <script src="{{asset('js/notifications.js')}}"></script>
@endsection

@section('content')
<div id="error-alert" class="alert alert-danger"
  style="display: none;">
</div>

@include('alerts.success-alert')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 style="font-weight: bold;"class="panel-title pull-left">
      Notifications: </h3>
     <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="container">

      <form name="notification_form" id="notification_form">

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
            placeholder="title">
        </div>

        <div class="form-group" id="general_news" style="display:none;">
          <label for="news">News:</option>
          <textarea id="news" name="news"
            class="form-control" placeholder="news"
            rows="3" style="width: 180px"></textarea>
        </div>

        <div class="form-group" id="submit_button">
          <button class="btn btn-success" type="button"
            onclick="sendNotification()">
            Send
          </button>
          @include('inline_loader')
        </div>

      </form>

    </div>
  </div>
</div>
@endsection
