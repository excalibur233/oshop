import Vue from 'vue';
import './bootstrap';
import Example from './components/Example.vue';
import RegisterForm from './components/forms/RegisterForm.vue';

Vue.component('example', Example);
Vue.component('register-form', RegisterForm);

const app = new Vue({
  el: '#app',
});
