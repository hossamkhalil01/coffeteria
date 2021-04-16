import 'bootstrap';

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('test-component', require('./components/TestComponent.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});
