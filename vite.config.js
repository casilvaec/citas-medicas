import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import browserSync from 'vite-plugin-browser-sync';

export default defineConfig({
    server: {
        port: 3000, // Puerto para Vite
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
        browserSync({
            host: 'localhost',
            port: 3001, // Puerto para BrowserSync
            proxy: 'http://localhost:8000', // URL del servidor de Laravel
            open: true, // Abre el navegador automáticamente
            notify: false, // Desactiva las notificaciones de BrowserSync
            files: [
                'resources/views/**/*.blade.php',
                'resources/css/**/*.css',
                'resources/js/**/*.js',
                'public/**/*.(js|css)'
            ]
        }),
    ],
});


