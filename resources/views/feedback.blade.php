@extends('layouts.app')

@section('more')
  {{--<script src="{{asset('js/feedback.js')}}"></script>--}}
  <style>
    .feedback {
      /*background-color: #e7e7e7;*/
      background-color: #e7e7e7;
      padding-left: 0;
      padding-right: 0;
    }
    .feedback-container {
      width: 100%;
    }
    .feedback-container:hover {
      background-color: #cec;
      /*background-color: #ee7;*/
      cursor: pointer;
    }
    .header {
      /*border-bottom: thin solid #3c763d;*/
      padding: 10px;
      text-align: left;
      color: #555;
      /*color: #3c763d;*/
      font-size: 20px;
      font-weight: bold;
      width: 100%;
    }
    .header-border-bottom {
      border-bottom: thin solid #555;
      /*border-bottom: thin solid #3c763d;*/
      /*border-bottom: thin solid #f0ad4e;*/
      width: 100%;
    }
    .footer-border-bottom {
      border-bottom: thin solid #555;
      /*border-bottom: thin solid #3c763d;*/
      /*border-bottom: thin solid #f0ad4e;*/
      /*border-bottom: thin solid #e7e7e7;*/
      width: 100%;
    }
    .feedback-container:last-child .footer-border-bottom {
      border-bottom: none;
    }
    .content {
      padding: 10px;
      text-align: justify;
      color: #3c763d;
      width: 100%;
    }
    .footer {
      color: #f0ad4e;
      padding: 10px;
      text-align: right;
      /*border-top: thin solid #3c763d;*/
      width: 100%;
    }
    .email {
      float: left;
      cursor: pointer;
    }
    .date {
      /*float: right;*/
    }
    .no-feedback {
      text-align: center;
      font-size: 30px;
      font-weight: bold;
      /*color: #3c763d;*/
      color: #555;
    }
  </style>
@endsection

@section('content')
@include('modals.confirmation_modal',
  ['id' => 'delete_confirmation_modal',
  'title' => 'Confirm',
  'text' =>  'Delete this feedback!',
  'action' => 'Confirm',
  'function' => 'deleteFeedback()',])
  <div class="container">
    @if($feedbacks->count() > 0)
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8 feedback">

        @foreach($feedbacks as $feedback)
        <div class="feedback-container">
          <div class="header">
            {{$feedback->subject}}
          </div>
          <div class="header-border-bottom"></div>

          <div class="content">
            {{$feedback->feedback}}
          </div>

          <div class="footer">
            <span class="date">
              {{\Carbon\Carbon::parse($feedback->created_at)->format("j M \\'y")}}
            </span>
            <span class="email">{{$feedback->email}}</span>
          </div>
          <div class="footer-border-bottom"></div>

        </div>
        @endforeach

      </div>
      <div class="col-sm-2"></div>
    </div>
    @else
    <div class="row" style="height: 100%;">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 feedback" style="text-align: center;">
        <span class="no-feedback">No feedback yet</span>
      </div>
      <div class="col-sm-3"></div>
    </div>
    @endif
  </div>
@endsection
