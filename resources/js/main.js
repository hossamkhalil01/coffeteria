import "bootstrap";

// Require Vue
import { createApp } from "vue";
import App from "@components/App.vue";
import router from "@src/router.js";

// import Pagination from 'v-pagination-3';

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

const app = createApp(App).use(router);

// app.component('pagination', Pagination);
app.use(VueSweetalert2);
app.mount("#app");
