/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

/**
 * Next, we will register Vue application components.
 *
 */

Vue.component('payment-table', require('./components/PaymentTable.vue'))

var paymentRedeemModal = require('./components/PaymentRedeemModal.vue')

Vue.component('payment-redeem-modal', paymentRedeemModal)

var deleteConfirm = require('./components/PaymentDeleteConfirmationModal.vue')

Vue.component('payment-delete-confirmation-modal', deleteConfirm)

Vue.component('accounts-chart', require('./components/AccountsChart.vue'))

var paymentAdaption = require('./components/PaymentsAdaptionChart.vue')

Vue.component('payment-adaption-chart', paymentAdaption)

Vue.component('new-users-chart', require('./components/NewUsersChart.vue'))

Vue.component('os-types-chart', require('./components/OsTypesChart.vue'))

Vue.component('countries-chart', require('./components/CountriesChart.vue'))

var totalPayments = require('./components/TotalPaymentsChart.vue')

Vue.component('total-payments-chart', totalPayments)

var serviceProviders = require('./components/ServiceProvidersChart.vue')

Vue.component('service-providers-chart', serviceProviders)