import Vue from 'vue'
import router from '~/router'
import App from '~/components/App'

import '~/plugins'
import '~/components'

/* eslint-disable no-new */
new Vue({
  router,
  ...App
})
