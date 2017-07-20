import Router from 'vue-router';

import Categories from './components/layouts/Categories.vue';
import ShopIndex from './components/layouts/ShopIndex.vue';
import Profile from './components/layouts/Profile.vue';


const routes = [
  { path: '/', component: ShopIndex },
  { path: '/categories', component: Categories },
  { path: '/profile', component: Profile },
];

export default new Router({
  routes,
});
