<template lang="pug">
  grid(:cols="2")
    grid-item.grid-item(v-for="spu in spus", :key="spu.id")
      div.img-container
        img(:src="spu.image_thumbnail")
      div.label-container
        div
          p.name {{spu.name}}
        div.description
          p.description {{spu.description}}
</template>

<script>
  import { Grid, GridItem, Masker } from 'vux';
  import axios from 'axios';

  export default {
    components: { Grid, GridItem, Masker },
    data() {
      return {
        spus: false,
      };
    },
    created() {
      this.fetch();
    },
    methods: {
      fetch(page = 1) {
        axios.get(this.url(page)).then(this.refresh);
      },
      url(page) {
        return `/spu?page=${page}`;
      },
      refresh({ data }) {
        this.spus = data.data;
      },
    },
  };
</script>

<style lang="stylus" scoped>
  .grid-item
    overflow hidden
    padding 10px 5px
    position: static;
  div.img-container
    position relative
  div.img-container > img
    width 100%
    height 30vw
    position relative
  .label-container
    text-align center
  p.name
    font-size inherit
    color: #000000
    text-align left
  div.description
    height 10vw
    text-overflow ellipsis
  p.description
    font-size .32rem
    color #999999
    text-align left
    text-overflow ellipsis
    overflow: hidden
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
</style>