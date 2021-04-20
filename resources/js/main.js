import "bootstrap";

// Require Vue
import { createApp } from "vue";
import App from "@components/App.vue";
import router from "@src/router.js";

createApp(App).use(router).mount("#app");
