<template lang="pug">
  div(class="form-group")
    label(for="password-confirm", class="col-md-4 control-label") 确认密码
    div(class="col-md-6")
      input(id="password-confirm" type="password" class="form-control" name="password_confirmation" required)
</template>

<script>
  export default {}
</script>