<template lang="html">
  
  <div id="adaption_div">
    
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
      payments:[],
      loading: false
    }
  },
  created() {
    this.loading = true
    
    axios.get('/api/payments')
         
         .then(({data}) => {
           this.payments = data
                      
           this.draw()
         })
         
         .catch(error => {
           console.error(error.response)
           
           this.loading = false
         })
  },
  methods: {
    draw() {
      var $this = this

      GoogleCharts.load(drawAdaptionChart)
            
      function drawAdaptionChart() {
        // Create our data table out of JSON data loaded from server.
        var data = new GoogleCharts.api.visualization.DataTable()
        data.addColumn('string', 'Date')
        data.addColumn('number', 'Total')
        data.addRows($this.getRows())
        var el = document.getElementById('adaption_div')
        var options = {
          title: 'Payment Adaption Rate',
          height: 400
        }
        var chart = new GoogleCharts.api.visualization.ColumnChart(el)
        GoogleCharts.api.visualization.events.addListener(chart, 'ready', myReadyHandler);
        chart.draw(data, options)
      }
      
      function myReadyHandler() {
        $this.loading = false
      }
    },
    getRows() {
      let rows = []
      let payments = this.payments
      for(let i = 0; i < payments.length; i++) {
        rows.push([payments[i].date_payed, {v: parseInt(payments[i].total)}])
      }
      return rows
    }
  }
}
</script>

<style lang="css">
</style>
