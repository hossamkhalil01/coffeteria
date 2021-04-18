import { createRouter, createWebHistory } from 'vue-router';
import NotFound from './components/404.vue';
import adminUsers from './components/admin/AllUsers.vue';
import adminEditUser from './components/admin/editUser.vue';
import Home from './components/Home.vue';
import Order from './components/Order.vue';
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
        path: '/admin/getusers',
        name: 'adminUsers',
        component: adminUsers,
    },
    { 
        path: '/admin/edituser/:id',
        name: 'adminEditUser',
        component: adminEditUser
    },
    {
        path: '/404',
        name: 'NotFound',
        component: NotFound,
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
