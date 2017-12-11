<template>
  <div>
    <van-cell-group class="address-title">
      <div>
        收货地址
      </div>
    </van-cell-group>
    <van-cell-group class="address">
      <van-cell @click="getAddress" v-show="!address.userName" title="选择收货地址" is-link value=" ">
      </van-cell>
      <van-cell @click="getAddress" v-show="address.userName"
                :title="address.userName+'，'+address.telNumber" is-link value=" " icon="location"
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
        <van-cell v-for="(item, index) in goods" :key="item.id">
          <van-icon v-show="delete_button" class="delete-icon" name="clear" @click="deleteItem(index)"></van-icon>
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
            :disabled="!checked_goods.length || delete_button"
            :buttonText="submitBarText"
    />
  </div>
</template>

<script>
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
        goods: [{
          id: '1',
          title: '进口香蕉',
          desc: '约250g，2根',
          price: 200,
          num: 1,
          thumb: 'https://img.yzcdn.cn/public_files/2017/10/24/2f9a36046449dafb8608e99990b3c205.jpeg'
        }, {
          id: '2',
          title: '陕西蜜梨',
          desc: '约600g',
          price: 690,
          num: 1,
          thumb: 'https://img.yzcdn.cn/public_files/2017/10/24/f6aabd6ac5521195e01e8e89ee9fc63f.jpeg'
        }, {
          id: '3',
          title: '美国伽力果',
          desc: '约680g/3个',
          price: 2680,
          num: 1,
          thumb: 'https://img.yzcdn.cn/public_files/2017/10/24/320454216bbe9e25c7651e1fa51b31fd.jpeg'
        }],
        delete_button: false,
        address: {
//          userName: '张三',
//          telNumber: '13000000000',
//          provinceName: '浙江省',
//          cityName: '杭州市',
//          countryName: '西湖区',
//          detailInfo: '文三路 138 号东方通信大厦 7 楼 501 室'
        }
      };
    },
    methods: {
      formatPrice(price) {
        return (price / 100).toFixed(2);
      },
      deleteButton() {
        this.delete_button = !this.delete_button;
      },
      deleteItem(index) {
        Dialog.confirm({
          title: '确认删除',
        }).then(() => {
          this.goods.splice(index, 1);
        }).catch(() => {
          // on cancel
        });
      },
      getAddress() {
        let vm = this;
        wx.openAddress({
          success: function (res) {
            vm.address = res;
          }
        });
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
      this.checked_goods = this.goods.map(item => item.id)
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

  .checkbox-button
    position relative
    vertical-align top
    display inline-block
    margin-top 35px
    span
      vertical-align top

  .goods-card
    display inline-block
    width calc(98vw - 65px)
    margin-top 0 !important
    border-radius 5px
</style>