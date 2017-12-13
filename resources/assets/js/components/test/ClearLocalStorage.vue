<template>
  <h1>清除localStorage</h1>
</template>

<script>
  export default {
    data() {
      return {};
    },
    created() {
      localStorage.clear();
    },
  };
</script>