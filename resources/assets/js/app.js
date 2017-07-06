import Vue from 'vue';
import './bootstrap';
import Example from './components/Example.vue';
import PhoneInput from './components/form-controls/PhoneInput.vue';
import PasswordInput from './components/form-controls/PasswordInput.vue';
import PasswordConfirmationInput from './components/form-controls/PasswordConfirmationInput.vue';
import RegisterForm from './components/forms/RegisterForm.vue';

Vue.component('example', Example);
Vue.component('phone-input', PhoneInput);
Vue.component('password-input', PasswordInput);
Vue.component('password-confirmation-input', PasswordConfirmationInput);

Vue.component('register-form', RegisterForm);

const app = new Vue({
  el: '#app',
});
