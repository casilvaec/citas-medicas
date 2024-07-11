// webpack.mix.js
const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .webpackConfig({
       plugins: [
           new BrowserSyncPlugin({
               proxy: 'http://localhost:8000', // URL del servidor de desarrollo de Laravel
               files: [
                   'resources/views/**/*.blade.php',
                   'public/js/**/*.js',
                   'public/css/**/*.css'
               ]
           })
       ]
   });
