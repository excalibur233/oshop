export default {
  namespaced: true,
  state: {
    goods: {},
    skus: {},
  },
  mutations: {
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
