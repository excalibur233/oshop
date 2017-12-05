import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const requireContext = require.context('./routes', false, /.*\.js$/);

const routes = requireContext
  .keys()
  .map(file => requireContext(file).default)
  .reduce(((_routes, route) => _routes.concat(route)), []);

const router = new Router({
  mode: 'history',
  routes,
});

router.beforeEach((to, from, next) => {
  console.log(to, from);
  next();
});

export default router;
