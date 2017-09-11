let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/manage.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .sass('resources/assets/sass/manage.scss', 'public/css');
