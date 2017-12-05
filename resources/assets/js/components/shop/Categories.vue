<template lang="pug">
  div
    van-button(type="primary") Default
</template>

<script>
  import { Button } from 'vant';

  export default {
    components: {
      'van-button': Button,
    },
  };
</script>