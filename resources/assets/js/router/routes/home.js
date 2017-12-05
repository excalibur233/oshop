import Categories from '../../components/shop/Categories.vue';
import ShopIndex from '../../components/shop/ShopIndex.vue';
import Profile from '../../components/profile/Profile.vue';
import Cart from '../../components/cart/Cart.vue';
import TabBar from '../../components/partials/TabBar.vue';


export default [
  { path: '/', components: { default: ShopIndex, tab: TabBar } },
  { path: '/categories', components: { default: Categories, tab: TabBar } },
  { path: '/profile', components: { default: Profile, tab: TabBar } },
  { path: '/cart', components: { default: Cart, tab: TabBar } },
]