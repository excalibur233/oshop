<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Example Component</div>
          <div class="panel-body">
            {{ body }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['user'],
    mounted: function() {
      console.log('Component mounted.');
    },
    computed: {
      body: function() {
        return this.user;
      }
    }
  }
</script>
