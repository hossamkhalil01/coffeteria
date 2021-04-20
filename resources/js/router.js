import { createWebHistory, createRouter } from "vue-router";

import NotFound from "./components/404.vue";

const loadComponent = (view, component) => {
    return import(`./components/${view}/${component}`);
};

const routes = [
    {
        path: "/",
        name: "Home",
        component: loadComponent("user", "Home"),
        children: [
            {
                path: "/order",
                name: "Order",
                component: loadComponent("user", "Order"),
            },
        ],
    },
    {
        path: "/admin",
        name: "Admin",
        component: loadComponent("admin", "Index"),
        redirect: "/admin/home",
        children: [
            {
                path: "/admin/home",
                component: loadComponent("admin", "Home"),
                name: "AdminHome",
            },
            {
                path: "/admin/checks",
                component: loadComponent("admin", "Checks"),
                name: "AdminChecks",
            },
            {
                path: "/admin/order",
                component: loadComponent("admin", "Order"),
                name: "AdminOrder",
            },
            {
                path: "/admin/products",
                component: loadComponent("admin", "Products"),
                name: "AdminProducts",
            },
            {
                path: "/admin/users",
                component: loadComponent("admin", "Users"),
                name: "AdminUsers",
            },
        ],
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
