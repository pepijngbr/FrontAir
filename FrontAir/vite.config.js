import { fileURLToPath, URL } from 'node:url';

import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import viteCompression from 'vite-plugin-compression';

// https://vitejs.dev/config/
export default defineConfig({
    base: '/FrontAir/',
    plugins: [
        vue(),
        viteCompression({
            verbose: true, // Optional: Outputs compression result in the console
            filter: /\.(js|mjs|json|css|html)$/i, // Optional: Default filter
            threshold: 1025, // Optional: Only compress files larger than this size (in bytes)
            algorithm: 'gzip', // Optional: Compression algorithm, can be 'gzip', 'brotliCompress', etc.
            ext: '.gz', // Optional: Suffix of the compressed files
        }),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url)),
        },
    },
});
