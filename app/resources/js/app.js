require('./bootstrap');

window.Vue = require('vue').default;

import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';

const APP_URL = process.env.APP_URL;
if (typeof APP_URL !== 'undefined') {
    Vue.axios.defaults.baseURL = APP_URL;
}
// let check = false
// let user = JSON.parse(localStorage.getItem("user"));
// if (user && user.token) {
//     // Vue.axios.defaults.headers.common['Authorization'] = `Bearer ${user.token}`;
//     axios.get(`/api/auth/check`, {
//             headers: { Authorization: 'Bearer ' + user.token }
//         }).then((response) => {
//             console.log(response.data.success)
//             if (response.data.data.success) {
//                 check = true
//             }
//         })
//         .catch((error) => {
//             check = false
//         });
// } else {

// }
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});