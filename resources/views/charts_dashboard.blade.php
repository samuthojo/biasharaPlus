@extends('layouts.app')

@section('content')

<div id="our_charts">
  
  <div class="row">
    
    <div class="col-md-4">
      
      <accounts-chart/>
      
    </div>
    
    <div class="col-md-8">
      
      <payment-adaption-chart/>
      
    </div>
    
  </div>

  <div class="row">
    
    <div class="col-md-4">
      
      <!-- <new-users-chart/> -->
      
    </div>
    
    <div class="col-md-4">
      
      <!-- <os-types-chart/> -->
      
    </div>
    
    <div class="colmd-4">
      
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