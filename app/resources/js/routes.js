import TicketSearch from './components/TicketSearch.vue';
import RegisterUser from './components/RegisterUser.vue';
import LoginUser from './components/LoginUser.vue';

export const routes = [{
        name: 'home',
        path: '/',
        component: TicketSearch
    },
    {
        name: 'register',
        path: '/register',
        component: RegisterUser
    },
    {
        name: 'login',
        path: '/login',
        component: LoginUser
    }
];