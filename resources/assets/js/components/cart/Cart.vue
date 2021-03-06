<template>
  <div>
    <van-cell-group class="address-title">
      <div>
        收货地址
      </div>
    </van-cell-group>
    <van-cell-group class="address">
      <van-cell style="padding-top: 8px;" @click="getAddress" v-show="!address.userName" title="选择收货地址" is-link
                value=" ">
      </van-cell>
      <van-cell style="padding-top: 8px;" @click="getAddress" v-show="address.userName"
                :title="address.userName+'，'+address.telNumber" is-link value=" "
                :label="address.provinceName+' '+address.cityName+' '+address.countryName+' '+address.detailInfo">
      </van-cell>
    </van-cell-group>
    <van-cell-group>
      <van-cell title="购物车">
        <template slot="right-icon">
          <div class="van-cell__right-icon">
            <van-button :class="!delete_button ? 'delete-button' : 'finish-button'" @click="deleteButton" size="small">
              {{ !delete_button ? "编辑" : "完成"}}
            </van-button>
          </div>
        </template>
      </van-cell>
    </van-cell-group>
    <van-checkbox-group v-model="checked_goods">
      <van-cell-group>
        <van-cell v-for="item in goods" :key="item.id">
          <van-icon v-show="delete_button" class="delete-icon" name="clear" @click="deleteItem(item.id)"></van-icon>
          <van-checkbox v-show="!delete_button" class="checkbox-button" :name="item.id"></van-checkbox>
          <van-card class="goods-card"
                    :title="item.title"
                    :desc="item.desc"
                    :num="item.num"
                    :price="formatPrice(item.price)"
                    :thumb="item.thumb"
          >
            <div slot="footer">
              <van-stepper v-model="item.num" max="9999"/>
            </div>
          </van-card>
        </van-cell>
      </van-cell-group>
    </van-checkbox-group>
    <van-submit-bar
            :price="totalPrice"
            :disabled="!checked_goods.length || !address.userName || delete_button"
            :buttonText="submitBarText"
            @submit="buy(checked_goods)"
    />
  </div>
</template>

<script>
  import axios from 'axios';
  import {
    AddressList,
    Icon,
    Col,
    Checkbox,
    CheckboxGroup,
    Card,
    Dialog,
    SubmitBar,
    Cell,
    CellGroup,
    Button,
    Stepper
  } from 'vant';
  export default {
    components: {
      [AddressList.name]: AddressList,
      [Icon.name]: Icon,
      [Col.name]: Col,
      [Card.name]: Card,
      [Checkbox.name]: Checkbox,
      'van-dialog': Dialog,
      [SubmitBar.name]: SubmitBar,
      [CheckboxGroup.name]: CheckboxGroup,
      [Cell.name]: Cell,
      [CellGroup.name]: CellGroup,
      [Button.name]: Button,
      [Stepper.name]: Stepper,
    },
    data() {
      return {
        checked_goods: [],
        goods: _.values(this.$store.state.cart.goods).map((e) => {
          let k = this.$store.state.cart.skus[e.sku];
          return {
            id: e.sku,
            title: k.title,
            desc: k.desc,
            price: k.price,
            num: e.number,
            thumb: k.thumb
          }
        }),
        delete_button: false,
        address: this.$store.state.cart.address
      };
    },
    methods: {
      formatPrice(price) {
        return (price / 100).toFixed(2);
      },
      deleteButton() {
        this.delete_button = !this.delete_button;
      },
      deleteItem(sku) {
        Dialog.confirm({
          title: '确认删除',
        }).then(() => {
          this.$store.commit('cart/removeGoods', sku);
          this.$store.commit('cart/removeSkus', sku);
          this.goods.splice(this.checked_goods.indexOf(sku), 1);
        }).catch(() => {
          // on cancel
        });
      },
      getAddress() {
        let vm = this;
        wx.openAddress({
          success: function (res) {
            vm.address = res;
            vm.$store.commit('cart/addAddress', res);
          }
        });
      },
      buy(skus) {
        let vm = this;
        axios({
          method: 'post',
          url: '/api/order',
          headers: {
            Accept: "application/json"
          },
          data: {
            openid: user.id,
            goodsList: _.filter(vm.goods, (val) => {
              return skus.indexOf(val.id) >= 0;
            }).map((val) => {
              return {
                sku_id: val.id,
                buy_num: val.num
              }
            }),
            address: vm.address,
          }
        }).then(function (res) {
            if (res.status === 200) {
              Dialog.confirm({
                title: '购买成功',
              });
              _.forEach((skus), function (sku) {
                vm.$store.commit('cart/removeGoods', sku);
                vm.$store.commit('cart/removeSku', sku);
              });
              vm.goods = _.filter(vm.goods, function (item) {
                return vm.checked_goods.indexOf(item.id) < 0;
              });
              vm.checked_goods = [];
            } else {
              Dialog.confirm({
                title: '购买失败',
              });
            }
          }
        );
      }
    },
    computed: {
      submitBarText() {
        const count = this.checked_goods.length;
        return '结算' + (count ? `(${count})` : '');
      },
      totalPrice() {
        return this.goods.reduce((total, item) => total + (this.checked_goods.indexOf(item.id) !== -1 ? item.price * item.num : 0), 0);
      }
    },
    created() {
      this.checked_goods = this.goods.map(item => item.id);

      let u = navigator.userAgent;
      let isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
      let isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

      axios({
        method: 'get',
        url: '/api/wechat/config',
        headers: {
          Accept: "application/json"
        },
        params: {
          url: isiOS ? window.initUrl : window.location.href
        }
      }).then(function (res) {
        if (res.status === 200) {
          res.data.debug = false;
          wx.config(res.data);
          wx.ready(function () {
            console.log('jssdk ok')
          })
        }
      })
    }
  };
</script>

<style lang="stylus">
  .address-title
    padding 5px 15px
    background-color transparent
    color #8C999F

  .address
    margin-bottom 2rem

  .finish-button
    color white
    background-color #f85
    border none

  .delete-button
    color white
    background-color red
    border none

  .delete-icon
    vertical-align top
    display inline-block
    width 30px
    margin-top 35px
    font-size 2rem
    font-weight bolder
    color red

  .van-checkbox-group
    margin-bottom 50px

  .checkbox-button
    position relative
    vertical-align top
    display inline-block
    margin-top 35px
    span
      vertical-align top

  .goods-card
    display inline-block
    width calc(100vw - 66px)
    margin-top 0 !important
    border-radius 8px
</style>