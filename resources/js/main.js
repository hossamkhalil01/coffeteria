export const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
export const user = JSON.parse(document.querySelector('meta[name="user"]').getAttribute("content"));
// Require Vue
import  vAxios  from  'v-axios' ; 
import  axios  from  'axios' ;
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';

// import Pagination from 'v-pagination-3';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App).use(router)
app.use(vAxios, axios);
// app.component('pagination', Pagination);
app.use(VueSweetalert2);
app.mount("#app");

