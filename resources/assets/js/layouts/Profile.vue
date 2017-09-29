<template lang="pug">
  div
    blur.blur(:height=150, :blur-amount=20, :url="url")
      p.center
        img(:src="url")
    card.card
      div.card-content(slot="content")
        div.vux-1px-r
          span 1130
          br
          | 积分
        div
          span 1130
          br
          | 优惠券
</template>

<script>
  import { Blur, Card } from 'vux';

  export default {
    components: {
      Blur,
      Card,
    },
    methods: {
      onImageError(item, $event) {
        console.log(item, $event);
      },
    },
    data() {
      return {
        url: 'https://o3e85j0cv.qnssl.com/tulips-1083572__340.jpg',
      };
    },
    method: {
      fetch() {

      },
    },
    mounted() {

    },
  };
</script>

<style lang="stylus" scoped>
  .center
    text-align center
    padding-top 40px
    font-size 18px
  .center img
    width 100px
    height 100px
    border-radius 50%
    border 4px solid #ebcccc
  .card-content
    display flex
    padding: 10px 0
  .card-content > div
    flex 1
    text-align center
    font-size 12px
  .card
    margin-top 0
</style>
