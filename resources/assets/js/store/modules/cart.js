export default {
  namespaced: true,
  state: {
    goods: {},
    skus: {},
    address: {},
  },
  mutations: {
    addAddress(state, address) {
      state.goods.address = address;
    },
    addGoods(state, item) {
      state.goods[item.sku] = item;
      state.goods_num = _.keys(state.goods).length;
    },
    removeGoods(state, sku) {
      delete state.goods[sku];
      state.goods_num = _.keys(state.goods).length;
    },
    addSku(state, item) {
      state.skus[item.sku] = item;
    },
  },
};
