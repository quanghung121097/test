import TicketSearch from './components/TicketSearch.vue';
import RegisterUser from './components/RegisterUser.vue';
import LoginUser from './components/LoginUser.vue';
import detailTicket from './components/detailTicket.vue';

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
    },
    {
        name: 'detail',
        path: '/detail/:id',
        component: detailTicket
    },
];