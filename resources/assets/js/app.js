import Vue from 'vue';

import './bootstrap';
import router from './router';
import App from './layouts/App.vue';


new Vue({
  el: '#app',
  components: {
    app: App,
  },
  router,
});
