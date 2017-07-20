<template>
  <grid :rows="2">
    <grid-item v-for="product in products" :key="product.id">
      <masker>
        <div slot="default"></div>
        <div slot="content"></div>
      </masker>
    </grid-item>
  </grid>
</template>

<script>
  import { Grid, GridItem, Masker } from 'vux'

  export default {
    components: { Grid, GridItem, Masker },
    data() {
      return {
        products: false,
      }
    },
    created() {
      this.fetch();
    },
    methods: {
      fetch(page = 1) {
        axios.get(this.url(page)).then(this.refresh);
      },
      url(page) {
        return '/products?page=' + page;
      },
      refresh({data}) {
        this.products = data.data;
      },
    }
  };
</script>