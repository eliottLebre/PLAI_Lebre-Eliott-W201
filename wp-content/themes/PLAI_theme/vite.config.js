import { defineConfig } from "vite";
import { globSync } from "glob";
import fs from "fs";
import path from "path";

export default defineConfig({
    base: "/plai_theme/public/",
    publicDir: 'static',

    plugins: [
        {
            name: 'bundle-js',
            buildStart() {
                const jsFiles = globSync('./assets/js/app/*.js');
                const combinedJs = jsFiles.map(file => fs.readFileSync(file, 'utf8')).join('\n');
                const outputDir = './assets/js';
                if (!fs.existsSync(outputDir)){
                    fs.mkdirSync(outputDir, { recursive: true });
                }
                fs.writeFileSync(path.join(outputDir, 'main.js'), combinedJs);
            }
        }
    ],

    build: {
        manifest: true,
        outDir: './public',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                style: './assets/css/styles.scss',
                main: './assets/js/main.js'
            },
            output: {
                entryFileNames: '[name].js',
                assetFileNames: '[name].[ext]',
            }
        },
        assetsInlineLimit: 0,
        target: ["es2015"],
    }
});