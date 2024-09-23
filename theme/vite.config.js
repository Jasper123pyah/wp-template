import { defineConfig } from 'vite';
import { resolve } from 'path';
import fs from 'fs';

function getAllScssFiles(directory) {
    let files = [];
    fs.readdirSync(directory).forEach(file => {
        const absolute = resolve(directory, file);
        if (fs.statSync(absolute).isDirectory()) {
            files = files.concat(getAllScssFiles(absolute));
        } else if(file.endsWith('.scss')) {
            files.push(absolute);
        }
    });
    return files;
}

export default defineConfig({
    plugins: [
        {
            name: 'watch-external',
            buildStart() {
                const scssFiles = getAllScssFiles(resolve(__dirname, 'assets/styles'));
                scssFiles.forEach(file => {
                    this.addWatchFile(file);
                });
            }
        }
    ],
    build: {
        outDir: './dist',
        assetsDir: '',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'assets/scripts/main.js'),
                main_css: resolve(__dirname, 'assets/styles/main.scss')
            },
            output: {
                entryFileNames: `[name].js`,
                chunkFileNames: `[name].js`,
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name === 'main_css.css') {
                        return 'main.css';
                    }
                    return '[name].[ext]';
                }
            }
        },
        watch: {
            include: ['assets/**/*.js', 'assets/**/*.scss', 'assets/**/*.css']
        }
    }
});