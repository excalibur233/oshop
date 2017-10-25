<template lang="pug">
  tabbar.tab-bar
    tabbar-item(link="/")
      i.fa.fa-home(slot="icon")
      span(slot="label") 首页
    tabbar-item(link="/categories" show-dot)
      i.fa.fa-bars(slot="icon")
      span(slot="label") 分类
    tabbar-item(link="/cart" show-dot)
      i.fa.fa-shopping-cart(slot="icon")
      span(slot="label") 购物车
    tabbar-item(link="/profile" badge="2")
      i.fa.fa-user(slot="icon")
      span(slot="label") 我的
</template>


<script>
  import { Tabbar, TabbarItem } from 'vux';

  export default {
    components: {
      tabbar: Tabbar,
      'tabbar-item': TabbarItem,
    },
  };
</script>

<style lang="stylus" scoped>
  .tab-bar
    position fixed
  .tab-bar > a
    padding-top 0
  .tab-bar > a >>> p
    margin 0
</style>
