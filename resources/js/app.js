require('./bootstrap');

// Require Vue
window.Vue = require('vue').default;

import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
 
const router = new VueRouter({
    mode: 'history',
    routes: routes
});


// Register Vue Components
Vue.component('test-component', require('./components/TestComponent.vue').default);
// Vue.component('test-component', require('./components/AllProduct.vue').default);




// Initialize Vue
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
    router
});





