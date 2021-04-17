export const csrf = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
export const user = JSON.parse(
    document.querySelector('meta[name="user"]').getAttribute("content")
);

// Require Vue
import { createApp } from "vue";
import App from "./components/App.vue";
import router from "./router";

createApp(App).use(router).mount("#app");
