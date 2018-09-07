<template lang="html">

  <div :id="id" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm</h4>
          <button class="close" @click="$emit('close')">
            &times;
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <p v-show="!showMessage">You are about to delete this record!</p>
            <p v-show="showMessage" :class="responseClass">
              {{ serverMessage }}</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="$emit('close')">Cancel</button>
          <button type="button" class="btn btn-success" @click="onDelete" :disabled="isLoading">Okay</button>
          <span class="my_loader" v-show="isLoading">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw text-success"></i>
          </span>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    showModal: {
      type: Boolean,
      required: true
    },

    payment: {
      type: Object,
      required: true
    },

    index: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      error: false,
      showMessage: false,
      serverMessage: '',
      id: "deletePaymentModal",
      isLoading: false
    }
  },

  created() {
    this.id = this.id + this._uid
  },

  computed: {
    responseClass: function() {
      if (this.error) {
        return 'text-danger';
      }
      return 'text-success';
    }
  },

  watch: {
    showModal: function(val) {
      if (val) {
        $("#" + this.id).modal({
          backdrop: 'static',
          keyboard: false,
          show: true
        })
      } else {
        $("#" + this.id).modal('hide');
        $('body').removeClass("modal-open");
        $('body').removeAttr('style');
        $(".modal-backdrop").remove();
      }
    }
  },

  methods: {
    onDelete() {

      this.isLoading = true

      axios.delete('/payments/' + this.payment.id)

        .then(({
          data
        }) => {

          this.isLoading = false

          if (data.error) {
            this.error = data.error

            this.serverMessage = data.message

            this.showMessage = true

            return
          } else {

            let payload = {
              index: this.index
            }

            this.error = data.error

            this.serverMessage = data.message

            this.showMessage = true

            setTimeout(() => {
              this.showMessage = false
              this.$emit('payment-deleted', payload)
            }, 2000)

          }

        })

        .catch(error => {
          console.error(error)

          this.isLoading = false

        })
    }
  }

}
</script>

<style lang="css">
</style>
