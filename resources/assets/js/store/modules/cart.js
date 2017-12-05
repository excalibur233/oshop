export default {
  state: {
    goods_num: 0,
  },
  mutations: {
    change(state, n) {
      state.goods_num = n;
    },
  },
};
