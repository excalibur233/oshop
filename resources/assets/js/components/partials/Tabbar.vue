<template>
  <tabbar>
    <tabbar-item link="/">
      <i class="fa fa-home" slot="icon"></i>
    </tabbar-item>
    <tabbar-item link="/categories" show-dot>
      <i class="fa fa-bars" slot="icon"></i>
    </tabbar-item>
    <tabbar-item link="/cart">
      <i class="fa fa-shopping-cart" slot="icon"></i>
    </tabbar-item>
    <tabbar-item link="/profile" badge="2">
      <i class="fa fa-user" slot="icon"></i>
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