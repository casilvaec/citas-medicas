// browser-sync.js
const mix = require('laravel-mix');
require('browser-sync').create();

mix.browserSync({
    proxy: 'http://localhost:8000', // URL del servidor de desarrollo de Laravel
    files: [
        'resources/views/**/*.blade.php',
        'public/js/**/*.js',
        'public/css/**/*.css'
    ]
});
