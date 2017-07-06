<template lang="pug">
  div(:class="form_group_class")
    label(for="password" class="col-md-4 control-label") 密码
    div(class="col-md-6")
      input(id="password" type="password" class="form-control" name="password" required)
      span(v-if="errors.password" class="help-block")
        strong {{ errors.password[0] }}

</template>

<script>
  export default {
    props: ['errors'],
    computed: {
      form_group_class: function () {
        if (this.errors.password) {
          return 'form-group has-error';
        } else {
          return 'form-group';
        }
      },
    }
  }
</script>