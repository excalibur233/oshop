<template lang="pug">
  div
    .scoll(v-waterfall-lower="loadMore",
    waterfall-disabled="waterfallDisabled",
    waterfall-offset="400")
      form.search-bar
        van-search(placeholder="请输入商品名称", v-model="searchValue")
      van-row
        van-col(span="12", v-for="spu in spus", :key="spu.id"): router-link(to="/goods")
          .spu-box
            div.spu-image
              img(:src="spu.image_thumbnail")
            div.spu-text-box
              div.spu-name
                p {{spu.name}}
              div.spu-description
                p {{spu.description}}
              div.spu-info
                span.spu-price-tag ￥
                span.spu-price-number {{spu.shown_price}}&emsp;
                span.spu-paid-count {{spu.paid_count}} 人购买
                span.spu-more ...
</template>

<script>
  import axios from 'axios';
  import { Row, Col, Waterfall, Toast, Search } from 'vant';


  export default {
    components: {
      'van-col': Col,
      'van-row': Row,
      'van-search': Search,
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
        searchValue: ''
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
      fetch(page) {
        axios.get(this.url(page)).then(this.refresh);
      },
      url(page) {
        return `/api/spu?page=${page}&perPage=${this.perPage}`;
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
  .scoll
    height 100vh
    overflow-y auto

  .search-bar
    height 42px;
    .van-search
      position fixed
      width 100vw

  .spu-box
    margin 5px
    background-color #fff
    border-radius 5px
    .spu-image
      margin 5px
      img
        width 100%
    .spu-text-box
      margin 5px
      .spu-name > p
        margin-bottom 5px
        font-size 1.5rem
        color #000000
        text-overflow ellipsis
        overflow hidden
        display -webkit-box
        -webkit-line-clamp 1
        -webkit-box-orient vertical
      .spu-description > p
        margin-bottom 5px
        font-size 1rem
        color #999999
        text-overflow ellipsis
        overflow hidden
        display -webkit-box
        -webkit-line-clamp 2
        -webkit-box-orient vertical
      .spu-info
        .spu-price-tag
          font-size 1.5rem
        .spu-price-number
          color #ff0000
          font-size 2rem
        .spu-paid-count
          font-size 1rem
        .spu-more
          float right
          line-height 3.5rem


</style>