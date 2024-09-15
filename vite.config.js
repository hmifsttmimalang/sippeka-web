import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/hasil_simulasi.css',
                'resources/css/seleksi.css',
                'resources/css/simulasi.css',
                'resources/css/selesai.css',
                'resources/css/terkirim.css',
                'resources/css/waktu_habis.css',
                'resources/js/app.js',
                'resources/js/seleksi.js',
                'resources/js/simulasi.js',
            ],
            refresh: true,
        }),
    ],
});
