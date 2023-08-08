import TicketSearch from './components/TicketSearch.vue';
import CreateProduct from './components/CreateProduct.vue';
import EditProduct from './components/EditProduct.vue';

export const routes = [{
        name: 'home',
        path: '/',
        component: TicketSearch
    },
    {
        name: 'detail',
        path: '/detail',
        component: CreateProduct
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct
    }
];