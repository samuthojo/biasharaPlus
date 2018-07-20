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

      GoogleCharts.load(drawCountriesChart)
            
      function drawCountriesChart() {
        var data = GoogleCharts.api.visualization.arrayToDataTable([
            ['Country', 'Users'],
            ['Tanzania', $this.users.tanzania],
            ['Kenya', $this.users.kenya],
            ['Uganda', $this.users.uganda],
        ])
        var el = document.getElementById('countries_div')
        var options = {
          height: 200,
          // colors: ['#28a745', '#ffc107'],
          title: 'Users Per Country',
          titleTextStyle: {
            fontName: '<global-font-name>',
            fontSize: 12,
            bold: true
          }
        }
        var chart = new GoogleCharts.api.visualization.PieChart(el)
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
