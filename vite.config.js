import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // css 
                'resources/css/app.css',
                'resources/css/common.css',
                'resources/css/sb-admin-2.css',
                'resources/css/sb-admin-2.min.css',
                
                
                'resources/scss/app.scss',

                'resources/js/common.js',
                'resources/js/datatables-demo.js',
                'resources/js/sb-admin-2.js',
                'resources/js/sb-admin-2.min.js',
                'resources/js/mmisTable.js',
            ],
            refresh: true,
        }),
    ],
});
