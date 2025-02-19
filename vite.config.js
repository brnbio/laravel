import vue              from '@vitejs/plugin-vue';
import laravel          from 'laravel-vite-plugin';
import path             from 'path';
import { defineConfig } from 'vite';

const rootPath = process.cwd();

export default defineConfig({
    css: {
        devSourcemap: true,
        preprocessorOptions: {
            scss: {
                quietDeps: true,
            }
        }
    },
    resolve: {
        alias: {
            "@": path.resolve(rootPath, "./resources/js/"),
            "ziggy-js": "/vendor/tightenco/ziggy/src/js",
        },
        extensions: [".ts", ".tsx", ".vue", ".js"],
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.scss",
                "resources/js/app.ts"
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
        watch: {
            usePolling: true
        }
    }
});
