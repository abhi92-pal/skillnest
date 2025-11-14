import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/sass/app.scss',
                // 'resources/js/app.js',
                'resources/css/app.css',
                'resources/js/student-app/main.jsx',
                'resources/js/exam-app/main.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
});
