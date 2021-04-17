

export const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
export const user = JSON.parse(document.querySelector('meta[name="user"]').getAttribute("content"));
// Require Vue
// import axios from 'axios';
import { createApp } from 'vue';
// import App from './components/App.vue';
import adminallusers from './components/admin/AllUsers.vue';

// const routes=[
//     {path:'/',component:adminallusers}
// ]
createApp(adminallusers).mount("#app");
