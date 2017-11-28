const elixir = require('laravel-elixir');

require('laravel-elixir-eslint');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
});

elixir(function(mix) {
  mix.eslint([
  'public/assets/js/modules/**/*.js',
  'public/js/**/*.js',
  'resources/assets/js/**/*.js',
  'packages/contus/base/src/assets/js/**/*.js'
]);
});
