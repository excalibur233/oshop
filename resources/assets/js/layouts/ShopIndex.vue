<template lang="pug">
  div(v-waterfall-lower="loadMore",
      waterfall-disabled="waterfallDisabled",
      waterfall-offset="100")
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
  import { Row, Col, Waterfall, Toast } from 'vant';

  export default {
    components: {
      'van-col': Col,
      'van-row': Row,
    },
    directives: {
      WaterfallLower: Waterfall('lower'),
      WaterfallUpper: Waterfall('upper'),
    },
    data() {
      return {
        spus: [],
        count: 0,
        max: 0,
        lastPage: 0,
        perPage: 10,
        page: 1,
        waterfallDisabled: false,
      };
    },
    created() {
      this.fetch();
    },
    methods: {
      loadMore() {
        this.waterfallDisabled = true;
        if (this.page === this.lastPage) {
          Toast('没有更多了');
          return;
        }
        this.fetch(this.page + 1);
      },
      fetch(page = 1) {
        axios.get(this.url(page)).then(this.refresh);
      },
      url(page) {
        return `/spu?page=${page}&perPage=${this.perPage}`;
      },
      refresh({ data }) {
        this.spus = _.concat(this.spus, data.data);
        this.page = data.meta.current_page;
        this.count += (data.meta.to - data.meta.from + 1);
        this.lastPage = data.meta.last_page;
        this.max = data.meta.total;
        this.waterfallDisabled = false;
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