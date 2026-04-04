import tailwindcss from '@tailwindcss/vite';
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import tempest from 'vite-plugin-tempest';
import path from 'path';

export default defineConfig({
    plugins: [
        vue(),
        tailwindcss(),
        tempest()
    ],
    server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
            clientPort: 5173,
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './app'),
        },
    }
});
