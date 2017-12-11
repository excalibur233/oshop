<template>
  <div class="goods" v-cloak>
    <van-swipe class="goods-swipe">
      <van-swipe-item v-for="thumb in goods.image_slide" :key="thumb">
        <img :src="thumb">
      </van-swipe-item>
    </van-swipe>

    <van-cell-group>
      <van-cell>
        <div class="goods-title">{{ goods.name }}</div>
        <div class="goods-price">{{ formatPrice(goods.shown_price) }}</div>
      </van-cell>
      <!--<van-cell class="goods-express">-->
      <!--<van-col span="10">运费：{{ goods.express }}</van-col>-->
      <!--<van-col span="14">剩余：{{ goods.remain }}</van-col>-->
      <!--</van-cell>-->
      <van-cell>
        <div>{{ goods.description }}</div>
      </van-cell>
    </van-cell-group>

    <div class="goods-detail">
      <div class="text-center">商品详情</div>
      <div span="24" v-html="goods.detail"></div>
    </div>

    <van-goods-action>
      <van-goods-action-mini-btn icon="home">
        首页
      </van-goods-action-mini-btn>
      <van-goods-action-mini-btn icon="cart">
        购物车
      </van-goods-action-mini-btn>
      <van-goods-action-big-btn @click="add_cart">
        加入购物车
      </van-goods-action-big-btn>
      <van-goods-action-big-btn primary @click="buy">
        立即购买
      </van-goods-action-big-btn>
    </van-goods-action>
    <van-sku ref="sku"
             v-model="showBase"
             :sku="sku"
             :goods="goods"
             :goodsId="goodsId"
             :showAddCartBtn="showAddCartBtn"
             :disableStepperInput="disableStepperInput"
    >
      <template slot="sku-header"></template>
      <template slot="sku-actions" slot-scope="props">
        <div class="van-sku-actions">
          <!-- 直接触发sku内部事件，通过内部事件执行handleBuyClicked回调 -->
          <button v-if="!disableStepperInput" class="van-sku__buy-btn disabled">暂时无法购买</button>
          <button v-if="disableStepperInput" class="van-sku__buy-btn" @click="props.skuEventBus.$emit('sku:buy')">确定
          </button>
        </div>
      </template>
    </van-sku>
  </div>
</template>

<script>
  import axios from 'axios';
  import {
    Tag,
    Col,
    Icon,
    Cell,
    CellGroup,
    Sku,
    Swipe,
    SwipeItem,
    GoodsAction,
    GoodsActionBigBtn,
    GoodsActionMiniBtn
  } from 'vant';
  export default {
    components: {
      [Tag.name]: Tag,
      [Col.name]: Col,
      [Icon.name]: Icon,
      [Cell.name]: Cell,
      [CellGroup.name]: CellGroup,
      [Sku.name]: Sku,
      [Swipe.name]: Swipe,
      [SwipeItem.name]: SwipeItem,
      [GoodsAction.name]: GoodsAction,
      [GoodsActionBigBtn.name]: GoodsActionBigBtn,
      [GoodsActionMiniBtn.name]: GoodsActionMiniBtn
    },
    data() {
      return {
        showBase: false,
        showAddCartBtn: false,
        disableStepperInput: true,
        goods: {},
        goodsId: this.$route.params.id,
        goods_num: this.$store.state.cart.goods_num,
        sku: {},
      };
    },
    methods: {
      formatPrice(e) {
        if (e) {
          return '¥' + (e - 0).toFixed(2);
        } else {
          return '¥0.00'
        }
      },
      add_cart() {
        this.showBase = true;
      },
      buy() {
        this.showBase = true;
      }
    },
    beforeCreate() {
      axios.get('/api/spu/' + this.$route.params.id).then(({ data }) => {
        let info = data.data;
        this.goods = {
          name: info.name,
          shown_price: info.shown_price,
//          express: '免运费',
//          remain: 19,
          description: info.description,
          image_slide: JSON.parse(info.image_slide),
          detail: info.detail,
          picture: info.image_thumbnail
        };
        if (info.skus.length !== 0) {
          this.sku = {
            price: info.shown_price.toString,
            sold_count: info.sold_count,
            collection_id: '1', // 无规格商品skuId取collection_id，否则取所选sku组合对应的id
            none_sku: false, // 是否无规格商品
            hide_stock: true, // 是否隐藏剩余库存
            tree: [{
              "k": "规格", // skuKeyName：规格类目名称
              "v": info.skus.map((val) => {
                return {
                  "id": val.id,
                  "name": val.label,
                  "imgUrl": !val.img ? info.image_thumbnail : val.img
                }
              }),
              "k_s": "s1" // skuKeyStr：sku组合列表（下方list）中当前类目对应的key值，value值会是从属于当前类目的一个规格值id
            }],
            list: info.skus.map((val) => {
              return {
                "id": val.id, // skuId，下单时后端需要
                "price": val.price, // 价格（单位分）
                "s1": "1", // 规格类目k_s为s1的对应规格值id
                "stock_num": val.storage // 当前sku组合对应的库存
              }
            })
          }
        } else {
          this.disableStepperInput = false;
          this.sku = {
            price: info.shown_price,
            sold_count: info.sold_count,
            collection_id: '1', // 无规格商品skuId取collection_id，否则取所选sku组合对应的id
            none_sku: false, // 是否无规格商品
            hide_stock: true, // 是否隐藏剩余库存
            tree: [{
              "k": "规格", // skuKeyName：规格类目名称
              "v": [{
                "id": 0,
                "name": '无规格',
                "imgUrl": info.image_thumbnail
              }],
              "k_s": "s1" // skuKeyStr：sku组合列表（下方list）中当前类目对应的key值，value值会是从属于当前类目的一个规格值id
            }],
            list: [{
              "id": 0, // skuId，下单时后端需要
              "price": info.shown_price, // 价格（单位分）
              "s1": "1", // 规格类目k_s为s1的对应规格值id
              "stock_num": 0 // 当前sku组合对应的库存
            }]
          }
        }
      })
    },
    mounted() {
      this.$refs.sku.selectedSku = { s1: '1' };
    },
  };
</script>

<style lang="less">
  .goods {
    padding-bottom: 50px;
    &-swipe {
      img {
        width: 100%;
        display: block;
      }
    }
    &-title {
      font-size: 16px;
    }
    &-price {
      color: #f44;
    }
    &-express {
      color: #999;
      font-size: 12px;
      padding: 5px 15px 5px 0;
    }
    &-cell-group {
      margin: 15px 0;
      .van-cell__value {
        color: #999;
      }
    }

  }

  .van-goods-action {
    .van-goods-action__big-btn {
      color: #fff;
    }
  }

  .van-sku-body {
    height: 180px;
    .van-stepper__input {
      vertical-align: bottom;
    }
  }

  .disabled {
    background-color: #e5e5e5;
    color: #c9c9c9;
  }

  .goods-detail {
    img {
      width: 100%;
    }
  }
</style>