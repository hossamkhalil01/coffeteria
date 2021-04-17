import { createRouter, createWebHistory } from "vue-router";
import NotFound from "./components/404.vue";
import Home from "./components/Home.vue";
import newOrder from "./components/newOrder";
import Order from "./components/Order.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/order",
        name: "Order",
        component: Order,
    },
    {
        path: "/neworder",
        name: "newOrder",
        component: newOrder,
    },
    {
        path: "/404",
        name: "NotFound",
        component: NotFound,
    },
    {
        path: "/:catchAll(.*)",
        redirect: "/404",
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
