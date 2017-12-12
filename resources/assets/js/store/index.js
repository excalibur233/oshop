import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

const requireContext = require.context('./modules', false, /.*\.js$/);

const modules = requireContext.keys()
  .map(file => [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)])
  .reduce((_modules, [name, _module]) => {
    _modules[name] = _module.default;
    return _modules;
  }, {});

export default new Vuex.Store({
  modules,
  plugins: [createPersistedState()],
});
