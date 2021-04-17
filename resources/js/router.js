import { createWebHistory, createRouter } from 'vue-router';
import Home from './components/Home.vue';
import Order from './components/Order.vue';
import NotFound from './components/404.vue';
import Product from './components/Product.vue';


const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/order',
        name: 'Order',
        component: Order,
    },
    {
        path: '/404',
        name: 'NotFound',
        component: NotFound,
    },
    {
        path: '/products',
        name: 'products',
        component: Product,
    },
    {
        path: "/:catchAll(.*)",
        redirect: '/404',
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
