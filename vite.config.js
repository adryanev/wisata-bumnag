import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
export default defineConfig({
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~perfect-scrollbar': path.resolve(__dirname, 'node_modules/perfect-scrollbar'),
            '~font-awesome': path.resolve(__dirname, 'node_modules/font-awesome')
        }
    },
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
