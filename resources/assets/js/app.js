import Vue from 'vue';
import './bootstrap';
import Example from './components/Example.vue';

Vue.component('example', Example);

const app = new Vue({
  el: '#app',
});
