import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

Vue.config.productionTip = false

axios.defaults.baseURL = process.env.VUE_APP_API_URL;

var Basic = btoa(process.env.VUE_APP_API_USER + ':' + process.env.VUE_APP_API_PASSWORD);
axios.defaults.headers.common['Authorization'] = 'Basic '+Basic;


Vue.use(BootstrapVue);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
