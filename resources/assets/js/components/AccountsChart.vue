<template lang="html">
  
  <div id="accounts_div">
    
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
      accounts: {},
      loading: false
    }
  },
  created() {
    this.loading = true
    
    axios.get('/api/accounts')
    
         .then(({data}) => {
           this.accounts = data.accounts
           
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

      GoogleCharts.load(drawAccountsChart)
            
      function drawAccountsChart() {
        var data = GoogleCharts.api.visualization.arrayToDataTable([
            ['Type', 'Number'],
            ['Premium', $this.accounts.premium.number],
            ['Free', $this.accounts.free.number],
        ])
        // var data = new GoogleCharts.api.visualization.DataTable()
        // data.addColumn('string', 'Accounts')
        // data.addColumn('string', 'Number')
        // data.addColumn('string', 'Percent')
        // data.addRows([
        //   ['Premium', $this.accounts.premium.number + '', $this.accounts.premium.percent + '%'],
        //   ['Free', $this.accounts.free.number + '', $this.accounts.free.percent + '%'], 
        //   // ['Total', ($this.accounts.total) + '', '100%']
        // ])
        var el = document.getElementById('accounts_div')
        var options = {
          height: 400,
          chartArea: {left:30, width:'100%'},
          pieHole: 0.5,
          title: 'Premium Vs Free Accounts',
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
