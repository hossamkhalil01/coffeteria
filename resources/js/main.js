import App from "@components/App.vue";
import router from "@src/router.js";
import "bootstrap";
import "./bootstrap";
import "sweetalert2/dist/sweetalert2.min.css";
// Require Vue
import { createApp } from "vue";
// import Pagination from 'v-pagination-3';
import VueSweetalert2 from "vue-sweetalert2";
import "./bootstrap";

const app = createApp(App).use(router);

// app.component('pagination', Pagination);
app.use(VueSweetalert2);
app.mount("#app");
