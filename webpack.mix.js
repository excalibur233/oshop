const { mix } = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
  .extract([
    'vue',
    'vuex',
    'axios',
    'jquery',
    'vue-router',
  ])
  .sass('resources/assets/sass/app.scss', 'public/css');

mix.autoload({
  jquery: ['$', 'jQuery', 'window.jQuery'],
  lodash: ['_', 'window.lodash'],
});

mix.copy('resources/assets/img', 'public/images');
