<template lang="html">
  
  <div id="countries_div">
    
    <i 
      v-if="loading"
      class="fa fa-spinner fa-spin fa-3x fa-fw text-success"></i>

  </div>
  
</template>

<script>
import {GoogleCharts} from 'google-charts'

export default {
  data() {
    return {
      loading: false,
      users: {}
    }
  },
  created() {
    this.loading = true
    
    axios.get('/api/users')
         
         .then(({data}) => {
           this.users = data
           
           this.draw()
         })
         
         .catch(error => {
           console.error(error)
           
           this.loading = false
         })
  },
  methods: {
    draw() {
      var $this = this
      
      GoogleCharts.load(drawAccountsChart, 'table')
                  
      function drawAccountsChart() {
        var data = new GoogleCharts.api.visualization.DataTable()
        data.addColumn('string', 'Country')
        data.addColumn('string', 'Premium')
        data.addColumn('string', 'Free')
        // data.addColumn('string', 'Total')
        var countries = $this.users.countries
        data.addRows([
          [
            'Tanzania', 
            countries.tanzania.premium + '', 
            countries.tanzania.free + '',
            // countries.tanzania.total + ''
          ], 
          [
            'Kenya', 
            countries.kenya.premium + '', 
            countries.kenya.free + '',
            // countries.kenya.total + ''
          ],
          [
            'Uganda', 
            countries.uganda.premium + '', 
            countries.uganda.free + '',
            // countries.uganda.total + ''
          ], 
        ])
        var el = document.getElementById('countries_div')
        var options = {}
        var chart = new GoogleCharts.api.visualization.Table(el)
        GoogleCharts.api.visualization.events.addListener(chart, 'ready', myReadyHandler);
        chart.draw(data, options)
      }
      
      function myReadyHandler() {
        $this.loading = false
      }
    }
  }
}
</script>

<style lang="css">
</style>
