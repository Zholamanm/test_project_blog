import Vue from 'vue';
import axios from 'axios';
import LoginComponent from './components/LoginComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import DashboardComponent from './components/DashboardComponent.vue';

axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const csrfToken = document.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
} else {
    console.error('CSRF token not found.');
}
Vue.component('login-component', LoginComponent);
Vue.component('register-component', RegisterComponent);
Vue.component('dashboard-component', DashboardComponent);

const app = new Vue({
    el: '#app',
});
