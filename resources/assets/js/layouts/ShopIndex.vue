<template lang="pug">
  van-pull-refresh(v-model="isLoading")
    van-row(gutter="8")
      van-col(span="12", v-for="spu in spus", :key="spu.id")
        div.spu-box
          div.spu-image
            img(:src="spu.image_thumbnail")
          div.spu-text-box
            div.spu-name
              p {{spu.name}}
            div.spu-description
              p {{spu.description}}
            div.spu-info
              span.spu-price-tag ￥
              span.spu-price-number {{spu.shown_price}}
              span.spu-paid-count {{spu.paid_count}} 人购买
              span.spu-more ...
</template>

<script>
  import axios from 'axios';
  import { Row, Col, PullRefresh, Toast } from 'vant';

  export default {
    components: {
      'van-col': Col,
      'van-row': Row,
      'van-pull-refresh': PullRefresh,
    },
    data() {
      return {
        spus: false,
        count: 0,
        isLoading: false,
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
    watch: {
      isLoading() {
        if (this.isLoading) {
          setTimeout(() => {
            Toast('刷新成功');
            this.isLoading = false;
            this.count += this.count;
          }, 500);
        }
      },
    },
  };
</script>

<style lang="stylus" scoped>
  .grid-item
    overflow hidden
    padding 10px 5px
    position: static;
  div.spu-box
    padding 5px
    position relative
  div.spu-image > img
    width 100%
    height 30vw
    position relative
  div.spu-name > p
    font-size 1.5rem
    color: #000000
    text-align left
    text-overflow ellipsis
    overflow: hidden
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  div.spu-description
    height 10vw
    text-overflow ellipsis
  span.spu-price-tag
    font-size 1.5rem
  span.spu-price-number
    color #ff0000
    font-size 2rem
  span.spu-paid-count
    font-size 1rem
  span.spu-more
    float right
  div.spu-description> p
    font-size 1rem
    color #999999
    text-align left
    text-overflow ellipsis
    overflow: hidden
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
</style>