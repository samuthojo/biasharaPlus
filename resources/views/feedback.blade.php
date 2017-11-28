@extends('layouts.app')

@section('more')
  @include('header')
  {{--<script src="{{asset('js/feedback.js')}}"></script>--}}
  <style>
    body {
      width: 850px;
      margin: 20px auto;
      text-align: center;
      background-color: transparent;
    }
    .container {
      /*background-color: #000;*/
    }
    .row {
      /*background-color: #fff;*/
    }
    .col-sm-6 {
      /*background-color: #555;*/
    }
    .col-sm-12 {
      text-align: left;
      margin-bottom: 20px;
    }
    .col-sm-12.title {
      height: auto;
      margin-bottom: 0;
    }
    .col-sm-12.feedback {
      height: auto;
      margin-bottom: 0;
    }
    .col-sm-12.footer {
      height: auto;
      margin-bottom: 0;
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
  <div class="row">

    <div class="col-sm-6">
      @if($feedbacks->count() > 0)
        @foreach($feedbacks as $feedback)
          <div class="col-sm-12">
            <div class="col-sm-12 title">
              <span class="text-success" style="float:left; font-weight: bold;">
                {{$feedback->subject}}
              </span>
            </div>
            <div class="col-sm-12 feedback">
              {{$feedback->feedback}}
            </div>
            <div class="col-sm-12 footer">
              <span class="text-white" style="float:left; font-weight: bold;">
                {{$feedback->email}}
              </span>
            </div>
          </div>
        @endforeach

      @else
      <h4 style="font-weight: bold; color: #777;">No feedback yet</h4>
      @endif
    </div>

  </div>
</div>

@endsection
