import Vue from 'vue';
import Router from 'vue-router';

import Categories from './layouts/Categories.vue';
import ShopIndex from './layouts/ShopIndex.vue';
import Profile from './layouts/Profile.vue';
import NotFound from './components/NotFound.vue';

Vue.use(Router);

const routes = [
  { path: '*', component: NotFound },
  { path: '/', component: ShopIndex },
  { path: '/categories', component: Categories },
  { path: '/profile', component: Profile },
];

const router = new Router({
  mode: 'history',
  routes,
});

router.beforeEach((to, from, next) => {
  console.log(to, from);
  next();
});

export default router;
