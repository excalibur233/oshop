<template lang='pug'>
  doctype html
  div
    img.user-poster(src="https://img.yzcdn.cn/public_files/2017/10/23/8690bb321356070e0b8c4404d087f8fd.png")
    van-row.user-links
      van-col(span="6")
        van-icon(name="pending-payment")/
        |待付款
      van-col(span="6")
        van-icon(name="pending-orders")/
        |待接单
      van-col(span="6")
        van-icon(name="pending-deliver")/
        |待发货
      van-col(span="6")
        van-icon(name="logistics")/
        |待确认
    van-cell-group.user-group
      van-cell(icon="records" title="全部订单" isLink)/
    van-cell-group
      van-cell(icon="exchange" title="我的积分" isLink)/
      van-cell(icon="gold-coin" title="我的优惠券" isLink)/
      van-cell(icon="gift" title="我收到的礼物" isLink)/
</template>

<script>
  import { Icon, Cell, CellGroup, Row, Col } from 'vant';

  export default {
    components: {
      'van-icon': Icon,
      'van-cell': Cell,
      'van-cell-group': CellGroup,
      'van-row': Row,
      'van-col': Col,
    },
  };
</script>

<style lang="less">
  .user {
    &-poster {
      width: 100%;
      display: block;
    }
    &-group {
      margin-bottom: .3rem;
    }
    &-links {
      padding: 15px 0;
      font-size: 12px;
      text-align: center;
      background-color: #fff;
      .van-icon {
        display: block;
        font-size: 24px;
      }
    }
  }
</style>