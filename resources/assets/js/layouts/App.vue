<template lang="pug">
  div
    view-box
      router-view
      tab-bar
</template>

<script>
  import { ViewBox } from 'vux';
  import TabBar from '../partials/Tabbar.vue';

  export default {
    components: {
      ViewBox,
      'tab-bar': TabBar,
      'view-box': ViewBox,
    },
  };
</script>

<style lang="less">
  @import "~vux/src/styles/1px.less";

  html, body {
    height: 100%;
    width: 100%;
    overflow-x: hidden;
  }
</style>