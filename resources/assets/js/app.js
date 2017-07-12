import './bootstrap';
import router from './routes';
import RegisterForm from './components/forms/RegisterForm.vue';

Vue.component('register-form', RegisterForm);

new Vue({
  el: '#app',
  router
});
