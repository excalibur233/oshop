<template lang="pug">
  div
    router-view
    router-view(name="tab")
</template>

<script>
  export default {
    components: {
    },
  };
</script>

<style>
  html, body {
    height: 100%;
    width: 100%;
    overflow-x: hidden;
    font-family: "Microsoft YaHei", "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
  }
  a, a:hover, a:focus {
    text-decoration: none!important;
    color: inherit;
  }
  .text-center {
    text-align: center;
  }

  /** {*/
    /*transition: all .1s;*/
  /*}*/
</style>