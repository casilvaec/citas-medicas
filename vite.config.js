// import { defineConfig } from 'vite';
// import laravel, { refreshPaths } from 'laravel-vite-plugin';
// import browserSync from 'vite-plugin-browser-sync';

// export default defineConfig({
//     server: {
//         port: 3000, // Puerto para Vite
//     },
//     plugins: [
//         laravel({
//             input: [
//                 'resources/css/app.css',
//                 'resources/js/app.js',
//             ],
//             refresh: [
//                 ...refreshPaths,
//                 'app/Http/Livewire/**',
//             ],
//         }),
//         browserSync({
//             host: 'localhost',
//             port: 3001, // Puerto para BrowserSync
//             proxy: 'http://localhost:8000', // URL del servidor de Laravel
//             open: true, // Abre el navegador automáticamente
//             notify: false, // Desactiva las notificaciones de BrowserSync
//             files: [
//                 'resources/views/**/*.blade.php',
//                 'resources/css/**/*.css',
//                 'resources/js/**/*.js',
//                 'public/**/*.(js|css)'
//             ]
//         }),
//     ],
// });

// PARA ADMINLTE


import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import browserSync from 'vite-plugin-browser-sync';

export default defineConfig({
    // Configuración del servidor de desarrollo Vite
    server: {
        port: 3000, // Puerto en el que Vite servirá la aplicación
    },
    plugins: [
        // Configuración del plugin de Laravel para Vite
        laravel({
            input: [
                'resources/css/app.css', // Ruta del archivo principal CSS de la aplicación
                'resources/js/app.js',  // Ruta del archivo principal JS de la aplicación
                'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css', // Añadir el archivo CSS de DataTables para Bootstrap 5
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**', // Rutas adicionales para monitorear cambios y refrescar el navegador
            ],
        }),
        // Configuración del plugin BrowserSync para sincronización del navegador
        browserSync({
            host: 'localhost', // Host donde BrowserSync estará escuchando
            port: 3001, // Puerto en el que BrowserSync servirá la aplicación
            proxy: 'http://localhost:8000', // URL del servidor de Laravel para hacer el proxy
            open: true, // Abre automáticamente el navegador al iniciar BrowserSync
            notify: false, // Desactiva las notificaciones de BrowserSync en el navegador
            files: [
                'resources/views/**/*.blade.php', // Archivos Blade que monitoreará para cambios
                'resources/css/**/*.css', // Archivos CSS que monitoreará para cambios
                'resources/js/**/*.js', // Archivos JS que monitoreará para cambios
                'public/**/*.(js|css)', // Archivos JS y CSS en la carpeta public que monitoreará para cambios
            ]
        }),
    ],
});
