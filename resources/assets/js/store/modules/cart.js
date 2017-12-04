export default {
  state: {
    goods_num: 5,
  },
  mutations: {
    change(state, n) {
      state.goods_num = n;
    },
  },
};
