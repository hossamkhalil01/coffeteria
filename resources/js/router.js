import NotFound from "@components/404.vue";
import { role } from "@helpers/currentUser.js";
import { createRouter, createWebHistory } from "vue-router";

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
        beforeEnter: (to, from, next) => {
            // check if admin
            if (role == "user") {
                next();
            } else {
                next({
                    name: "AdminHome",
                });
            }
        },
        children: [
            {
                path: "/home",
                name: "UserHome",
                component: loadComponent("home", "Home"),
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
            {
                path: "/profile",
                name: "UserProfile",
                component: loadComponent("user", "userProfile"),
            },
            {
                path: "/profile/settings",
                name: "UserProfileSettings",
                component: loadComponent("user", "UserProfileSettings"),
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
                component: loadComponent("home", "Home"),
                name: "AdminHome",
            },
            {
                path: "/admin/checks",
                component: loadPage("admin", "ChecksView"),
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
                path: "/admin/products",
                name: "AdminProducts",
                component: loadComponent("admin", "Products"),
            },
            {
                path: "/admin/product/create",
                name: "AdminCreateProduct",
                component: loadComponent("admin", "CreateProduct"),
            },
            {
                path: "/admin/category/add",
                name: "AdminAddCategory",
                component: loadComponent("admin", "AddCategory"),
            },
            {
                path: "/admin/users",
                name: "AdminUsers",
                component: loadComponent("admin", "AllUsers"),
            },
            {
                path: "/admin/edituser/:id",
                name: "AdminEditUser",
                component: loadComponent("admin", "EditUser"),
            },
            {
                path: "/admin/createuser",
                name: "AdminCreateUser",
                component: loadComponent("admin", "CreateUser"),
            },
            {
                path: "/admin/product/edit/:id",
                name: "AdminEditProduct",
                component: loadComponent("admin", "EditProduct"),
            },
            {
                path: "/admin/profile",
                name: "AdminProfile",
                component: loadComponent("user", "userProfile"),
            },
            {
                path: "/admin/profile/settings",
                name: "AdminProfileSettings",
                component: loadComponent("user", "UserProfileSettings"),
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
