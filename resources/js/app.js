import Vue from 'vue';
import router from './routes';
import "./bootstrap";

window.Vue = Vue;

const app = new Vue({
    router,
}).$mount('#app');
