import Router from 'vue-router';

import Categories from './layouts/Categories.vue';
import ShopIndex from './layouts/ShopIndex.vue';
import Profile from './layouts/Profile.vue';
import NotFound from './components/NotFound.vue';


const routes = [
  { path: '*', component: NotFound },
  { path: '/', component: ShopIndex },
  { path: '/categories', component: Categories },
  { path: '/profile', component: Profile },
];

export default new Router({
  mode: 'history',
  routes,
});
