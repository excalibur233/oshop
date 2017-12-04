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
  }
</style>