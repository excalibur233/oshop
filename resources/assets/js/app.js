import Vue from 'vue';

import App from './layouts/App.vue';
import router from './router';
import store from './store';


new Vue({
  el: '#app',
  components: {
    app: App,
  },
  store,
  router,
});

