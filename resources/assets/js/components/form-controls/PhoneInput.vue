<template lang="pug">
  div(:class="form_group_class")
    label(for="phone" class="col-md-4 control-label") 手机号
    div(class="col-md-6")
      input(id="phone" type="text" class="form-control" name="phone", :value="old" required autofocus)
      span(v-if="errors.phone" class="help-block")
        strong {{ errors.phone[0] }}
</template>

<script>
  export default {
    props: ['errors', 'old'],
    computed: {
      form_group_class: function () {
        if (this.errors.phone) {
          return 'form-group has-error';
        } else {
          return 'form-group';
        }
      },
    }
  }
</script>