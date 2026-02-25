import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import tailwindcss from "@tailwindcss/vite";
import react from '@vitejs/plugin-react';
import path from 'path';

export default defineConfig({
    base: '/',
    plugins: [
        react(),
        tailwindcss(),
        symfonyPlugin(),
    ],
    build: {
        outDir: path.resolve(__dirname, "public/build"),
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, "assets/main.jsx"),
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './assets'),
        },
    },
    server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
    },
});
