<template lang="pug">
  input(type="hidden" name="_token", :value="csrfToken")
</template>

<script>
  export default {
    props: ['csrfToken']
  }
</script>