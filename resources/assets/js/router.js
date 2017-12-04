import Vue from 'vue';
import Router from 'vue-router';

import Categories from './layouts/Categories.vue';
import ShopIndex from './layouts/ShopIndex.vue';
import Profile from './layouts/Profile.vue';
import Cart from './layouts/Cart.vue';
import NotFound from './components/NotFound.vue';
import Goods from './layouts/Goods.vue';
import TabBar from './partials/TabBar.vue';

Vue.use(Router);

const routes = [
  { path: '*', component: NotFound },
  { path: '/', components: { default: ShopIndex, tab: TabBar } },
  { path: '/categories', components: { default: Categories, tab: TabBar } },
  { path: '/profile', components: { default: Profile, tab: TabBar } },
  { path: '/cart', components: { default: Cart, tab: TabBar } },
  { path: '/goods', component: Goods },
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
