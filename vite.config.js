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

                // scss
                'resources/scss/app.scss',

                // JS
                'resources/js/datatables-demo.js',
                'resources/js/sb-admin-2.js',
                'resources/js/sb-admin-2.min.js',
                
                'resources/js/app.js',
                'resources/js/admin/federation-officers.js',
                'resources/js/admin/federation-point-persons.js',
                'resources/js/admin/proivisions.js',
                'resources/js/admin/regional-distributions.js',
                'resources/js/admin/trade-federations-details.js',
                'resources/js/admin/trade-federations.js',
                'resources/js/admin/users.js',
                'resources/js/users.js',
            ],
            refresh: true,
        }),
    ],
});
