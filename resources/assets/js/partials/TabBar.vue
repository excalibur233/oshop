<template lang="pug">
  tabbar(v-model="active")
    tabbar-item(to="/", icon="shop", replace) 首页
    tabbar-item(to="/categories", icon="records", replace) 分类
    tabbar-item(to="/cart", icon="cart", :info="cart_info") 购物车
    tabbar-item(to="/profile", icon="contact", replace) 我的
</template>


<script>
  import { Tabbar, TabbarItem } from 'vant';

  export default {
    components: {
      'tabbar': Tabbar,
      'tabbar-item': TabbarItem,
    },
    data() {
      return {
        active: 0,
        cart_info: this.$store.state.cart.goods_num.toString(),
      }
    }
  };
</script>

