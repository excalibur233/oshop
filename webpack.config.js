const vuxLoader = require('vux-loader');
const webpackConfig = require('laravel-mix/setup/webpack.config');

module.exports = vuxLoader.merge(webpackConfig, {
  options: {},
  plugins: [
    'vux-ui',
    {
      name: 'style-parser',
      fn(source) {
        return source.replace('stylus', 'less');
      },
    },
  ],
});
