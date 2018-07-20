@extends('layouts.app2')

@section('content')

<div id="our_charts">
  
  <div class="row mb-2">
    
    <div class="col-md-4">
      <div class="callout callout-info b-t-1 b-r-1 b-b-1">
        <span style="font-weight: bold;">Total Users</span><br>
        <strong class="h4">9,123</strong>
      </div>
    </div>
    
    <div class="col-md-4 mt-2 mt-md-0">
      <div class="callout callout-info b-t-1 b-r-1 b-b-1">
        <span style="font-weight: bold;">Android Users</span><br>
        <strong class="h4">9,123</strong>
      </div>
    </div>
    
    <div class="col-md-4 mt-2 mt-md-0">
      <div class="callout callout-info b-t-1 b-r-1 b-b-1">
        <span style="font-weight: bold;">iOS Users</span><br>
        <strong class="h4">9,123</strong>
      </div>
    </div>
    
  </div>
  
  <div class="row mb-2">
    
    <div class="col-lg-4">
      
      <accounts-chart/>
      
    </div>
    
    <div class="col-lg-8 mt-2 mt-lg-0">
      
      <payment-adaption-chart/>
      
    </div>
    
  </div>

  <div class="row mb-2">
    
    <div class="col-md-4">
      
      <!-- <new-users-chart/> -->
      
    </div>
    
    <div class="col-md-4">
      
      <!-- <os-types-chart/> -->
      
    </div>
    
    <div class="col-md-4">
      
      <!-- <countries-chart/> -->
      
    </div>
    
  </div>

  <div class="row">
    
    <div class="col-md-6">
      
      <!-- <total-payments-chart/> -->
      
    </div>
    
    <div class="col-md-6">
      
      <!-- <service-providers-chart/> -->
      
    </div>
    
  </div>
  
</div>

<script type="text/javascript">
new Vue({
  el: '#our_charts',
})
</script>

@endsection