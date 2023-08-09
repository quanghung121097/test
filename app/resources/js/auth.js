import bearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import axios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import router from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'auth-token',
    tokenStore: ['cookie'],
    notFoundRedirect: {
        path: '/home'
    },
    registerData: {
        url: '/api/auth/register',
        method: 'POST',
        redirect: null,
    },
    loginData: {
        url: '/api/auth/login',
        method: 'POST',
        redirect: '/home',
        fetchUser: true,
    },
    logoutData: {
        url: '/api/auth/logout',
        method: 'POST',
        redirect: '/login',
        makeRequest: true
    },
    parseUserData (data) {
        return data || {}
    },
};

export default config;
