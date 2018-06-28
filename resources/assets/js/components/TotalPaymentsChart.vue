<template lang="html">

  <div id="payments_div">
    
    <i 
      v-if="loading"
      class="fa fa-spinner fa-spin fa-3x fa-fw text-success"></i>

  </div>
    
</template>

<script>
export default {
  data() {
    return {
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
  }
}
</script>

<style lang="css">
</style>
