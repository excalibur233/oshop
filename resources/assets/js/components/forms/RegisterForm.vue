<template lang="pug">
  form(class="form-horizontal" method="POST", :action="action")
    csrf-token-field(:csrfToken="csrfToken")
    phone-input(:errors="errors.phone", :old="old.phone")
    password-input(:errors="errors.password")
    password-confirmation-input
    submit-button
</template>

<script>
  import CsrfTokenField from '../form-controls/CsrfTokenField.vue';
  import PhoneInput from '../form-controls/PhoneInput.vue';
  import PasswordInput from '../form-controls/PasswordInput.vue';
  import PasswordConfirmationInput from '../form-controls/PasswordConfirmationInput.vue';
  import SubmitButton from '../form-controls/SubmitButton.vue';

  export default {
    props: ['action', 'csrfToken', 'errors', 'old'],
    components: {
      CsrfTokenField,
      PhoneInput,
      PasswordInput,
      PasswordConfirmationInput,
      SubmitButton,
    }
  }
</script>