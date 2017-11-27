import Vue from 'vue';

import router from './router';
import App from './layouts/App.vue';
import './store';


new Vue({
  el: '#app',
  components: {
    app: App,
  },
  router,
});
