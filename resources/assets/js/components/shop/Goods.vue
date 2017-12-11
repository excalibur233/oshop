<template>
  <div class="goods">
    <van-swipe class="goods-swipe">
      <van-swipe-item v-for="thumb in goods.image_slide" :key="thumb">
        <img :src="thumb">
      </van-swipe-item>
    </van-swipe>

    <van-cell-group>
      <van-cell>
        <div class="goods-title">{{ goods.name }}</div>
        <div class="goods-price">{{ formatPrice(goods.price) }}</div>
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
    <van-sku
            v-model="showBase"
            :sku="sku"
            :goods="goods"
            :goodsId="goodsId"
            :showAddCartBtn="showAddCartBtn"
            resetStepperOnHide
    >
      <template slot="sku-header"></template>
      <template slot="sku-actions" slot-scope="props">
        <div class="van-sku-actions">
          <!-- 直接触发sku内部事件，通过内部事件执行handleBuyClicked回调 -->
          <button class="van-sku__buy-btn" @click="props.skuEventBus.$emit('sku:buy')">确定</button>
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
        showBase: true,
        showAddCartBtn: false,
        goods: {
          name: '诺和针®32G',
          price: 545.86,
//          express: '免运费',
//          remain: 19,
          description: "诺和针®32G Tip ETW位一次性使用无菌注射针，与诺和诺德胰岛素注射系统配合使用。",
          image_slide: JSON.parse("[\"http:\/\/o93nlp231.bkt.clouddn.com\/f78385376b0cd9f395467df04f049fb5.png\", \"http:\/\/o93nlp231.bkt.clouddn.com\/f78385376b0cd9f395467df04f049fb5.png\"]"),
          detail: "<p><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490072863273.png\" title=\"1466490072863273.png\" alt=\"0.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490075792569.png\" title=\"1466490075792569.png\" alt=\"1.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490078984291.png\" title=\"1466490078984291.png\" alt=\"2.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490083205168.png\" title=\"1466490083205168.png\" alt=\"3.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490087537075.png\" title=\"1466490087537075.png\" alt=\"4.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490091971519.png\" title=\"1466490091971519.png\" alt=\"5.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490094523465.png\" title=\"1466490094523465.png\" alt=\"6.png\"\/><img src=\"http:\/\/o93nlp231.bkt.clouddn.com\/uploads\/ueditor\/php\/upload\/image\/20160621\/1466490097750109.png\" title=\"1466490097750109.png\" alt=\"7.png\"\/><\/p>",
          image_thumbnail: "http:\/\/o93nlp231.bkt.clouddn.com\/f78385376b0cd9f395467df04f049fb5.png",
        },
        goodsId: this.$route.params.id,
        goods_num: this.$store.state.cart.goods_num,
        sku: {
          // 所有sku规格类目与其值的从属关系，比如商品有颜色和尺码两大类规格，颜色下面又有红色和蓝色两个规格值。
          // 可以理解为一个商品可以有多个规格类目，一个规格类目下可以有多个规格值。
          tree: [{
            "k": "规格", // skuKeyName：规格类目名称
            "v": [{
              "id": "1", // skuValueId：规格值id
              "name": "红色", // skuValueName：规格值名称
              "imgUrl": "https:\/\/img.yzcdn.cn\/upload_files\/2017\/02\/21\/FjKTOxjVgnUuPmHJRdunvYky9OHP.jpg" // 规格类目图片，只有第一个规格类目可以定义图片
            }, {
              "id": "2",
              "name": "蓝色",
              "imgUrl": "https:\/\/img.yzcdn.cn\/upload_files\/2017\/03\/16\/Fs_OMbSFPa183sBwvG_94llUYiLa.jpeg"
            }],
            "k_s": "s1" // skuKeyStr：sku组合列表（下方list）中当前类目对应的key值，value值会是从属于当前类目的一个规格值id
          }],
          list: [{
            "id": 1, // skuId，下单时后端需要
            "price": 100, // 价格（单位分）
            "s1": "1", // 规格类目k_s为s1的对应规格值id
            "stock_num": 110 // 当前sku组合对应的库存
          }, {
            "id": 2, // skuId，下单时后端需要
            "price": 200, // 价格（单位分）
            "s1": "2", // 规格类目k_s为s1的对应规格值id
            "stock_num": 110 // 当前sku组合对应的库存
          }],
          price: "1.00", // 默认价格（单位元）后端单位暂时有点不统一
          stock_num: 227, // 商品总库存
          collection_id: '1', // 无规格商品skuId取collection_id，否则取所选sku组合对应的id
          none_sku: false, // 是否无规格商品
          hide_stock: false, // 是否隐藏剩余库存
        },
      };
    },
    methods: {
      formatPrice() {
        return '¥' + (this.goods.price / 100).toFixed(2);
      },
      add_cart() {
        this.showBase = true;
      },
      buy() {
        this.showBase = true;
      }
    },
    created() {
//      axios.get('/api/spu/' + this.$route.params.id).then(({ data }) => {
//        this.goods.title = data.name;
//        this.goods.title = data.name;
//        this.goods.title = data.name;
//        this.goods.title = data.name;
//        this.goods.title = data.name;
//      })
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

  .goods-detail {
    img {
      width: 100%;
    }
  }
</style>