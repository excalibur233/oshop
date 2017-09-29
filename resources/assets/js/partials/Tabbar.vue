<template lang="pug">
  tabbar.tab-bar
    tabbar-item(link="/")
      i.fa.fa-home(slot="icon")
    tabbar-item(link="/categories" show-dot)
      i.fa.fa-bars(slot="icon")
    tabbar-item(link="/cart" show-dot)
      i.fa.fa-shopping-cart(slot="icon")
    tabbar-item(link="/profile" badge="2")
      i.fa.fa-user(slot="icon")
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
    position: fixed
</style>