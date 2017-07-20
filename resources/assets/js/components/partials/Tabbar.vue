<template>
  <tabbar>
    <tabbar-item link="/">
      <i class="fa-home" slot="icon"></i>
      <span slot="label">首页</span>
    </tabbar-item>
    <tabbar-item link="/categories" show-dot>
      <i class="fa-bars" slot="icon"></i>
      <span slot="label">分类</span>
    </tabbar-item>
    <tabbar-item link="/cart">
      <i class="fa-shopping-cart" slot="icon"></i>
      <span slot="label">购物车</span>
    </tabbar-item>
    <tabbar-item link="/profile" badge="2">
      <i class="fa-user" slot="icon"></i>
      <span slot="label">我的</span>
    </tabbar-item>
  </tabbar>
</template>


<script>
  import { Tabbar, TabbarItem } from 'vux';

  export default {
    components: {
      'tabbar': Tabbar,
      'tabbar-item': TabbarItem,
    }
  }
</script>