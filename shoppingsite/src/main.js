import Vue from 'vue'
import App from './App.vue'
import router from './Router'
import Vuelidate from 'vuelidate'
import store from './Store/store'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.config.productionTip = false
Vue.use(Vuelidate);
Vue.use(VueSweetalert2);
new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
