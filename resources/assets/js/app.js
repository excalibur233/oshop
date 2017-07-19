import Vue from 'vue';
import './bootstrap';
import RegisterForm from './components/forms/RegisterForm.vue';

Vue.component('register-form', RegisterForm);

new Vue({
  el: '#app',
});
