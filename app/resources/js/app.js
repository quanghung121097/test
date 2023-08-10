require('./bootstrap');

window.Vue = require('vue').default;

import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';
import Vuex from 'vuex';
import store from './store';

const APP_URL = process.env.APP_URL;
if (typeof APP_URL !== 'undefined') {
    axios.defaults.baseURL = APP_URL;
}
axios.defaults.withCredentials = true
Vue.config.productionTip = false
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
Vue.use(Vuex);
const app = new Vue({
    store,
    router,
    render: h => h(App)
  }).$mount('#app')