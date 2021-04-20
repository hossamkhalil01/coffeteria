import { createWebHistory, createRouter } from "vue-router";

import NotFound from "@components/404.vue";
import { role } from "@helpers/currentUser.js";

const loadComponent = (view, component) => {
    return () => import(`@components/${view}/${component}`);
};

const loadPage = (view, page) => {
    return () => import(`@pages/${view}/${page}`);
};

const routes = [
    {
        path: "/",
        name: "UserView",
        component: loadPage("user", "UserView"),
        redirect: { name: "UserHome" },
        children: [
            {
                path: "/home",
                name: "UserHome",
                component: loadComponent("user", "Home"),
            },
            {
                path: "/order",
                name: "UserOrder",
                component: loadComponent("user", "Order"),
            },
            {
                path: "/neworder",
                name: "newOrder",
                component: loadComponent("user", "newOrder"),
            },
        ],
    },
    {
        path: "/admin",
        name: "AdminView",
        component: loadPage("admin", "AdminView"),
        redirect: { name: "AdminHome" },
        beforeEnter: (to, from, next) => {
            // check if admin
            if (role == "admin") {
                next();
            } else {
                next({
                    name: "UserHome",
                });
            }
        },
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
                path: "/admin/users",
                component: loadComponent("admin", "Users"),
                name: "AdminUsers",
            },
            {
                path: "admin/products",
                name: "AdminProducts",
                component: loadComponent("admin", "Products"),
            },
            {
                path: "admin/product/create",
                name: "AdminCreateProduct",
                component: loadComponent("admin", "CreateProduct"),
            },
            {
                path: "admin/category/add",
                name: "AdminAddCategory",
                component: loadComponent("admin", "AddCategory"),
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
        redirect: { name: "NotFound" },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
