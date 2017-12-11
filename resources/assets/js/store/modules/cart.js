export default {
  namespaced: true,
  state: {
    goods_num: 0,
    goods: [],
    skus: {},
  },
  mutations: {
    addGoods(state, item) {
      state.goods.push(item);
      state.goods_num = state.goods.length;
    },
    removeGoods(state, index) {
      state.goods.slice(index, 1);
      state.goods_num = state.goods.length;
    },
    addSku(state, item) {
      state.sku[item.sku] = item;
    },
  },
};
