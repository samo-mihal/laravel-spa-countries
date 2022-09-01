import Vue from 'vue'
import 'bootstrap'
import router from '~/router'
import App from '~/components/App'
import '~/components'

/* eslint-disable no-new */
new Vue({
  router,
  ...App
})
