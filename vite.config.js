import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: [
                '**/public/images/**',
                '**/public/favicon/**',
                '**/public/storage/**',
                '**/storage/**',
                '**/node_modules/**',
                '**/vendor/**',
                '**/.git/**'
            ]
        },
    },
});
