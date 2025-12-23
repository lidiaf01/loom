import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // <--- Esta es la línea que fallaba

export default defineConfig({
    plugins: [
        tailwindcss(), // <--- Y esta es la función que lo activa
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});