export const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
export const user = JSON.parse(document.querySelector('meta[name="user"]').getAttribute("content"));
// Require Vue
import axios from 'axios';
import VueAxios from 'v-axios';
import { createApp } from 'vue';
// import App from './components/App.vue';
import adminallusers from './components/admin/AllUsers.vue';
import router from './router';
// const routes=[
//     {path:'/',component:adminallusers}
// ]
createApp(adminallusers).use(router, axios, VueAxios).mount("#app");
// import App from './components/App.vue';


// createApp(App).use(router).mount("#app");
