import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const requireContext = require.context('./modules', false, /.*\.js$/);

const modules = requireContext.keys()
  .map(file => [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)])
  .reduce((_modules, [name, _module]) => {
    _modules[name] = _module;
    return _modules;
  }, {});

export default new Vuex.Store({
  modules,
});
