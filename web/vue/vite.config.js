import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

// https://vite.dev/config/
export default defineConfig(({ command }) => ({
  base: command === 'build' ? '/vue/dist/' : '/',
  plugins: [
    vue(),
    vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
  build: {
    minify: true,
    outDir: './dist',
    rollupOptions: {
      output: {
        manualChunks: undefined,
        inlineDynamicImports: true,
        // Tách CSS thành file riêng
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith('.css')) {
            return '[name][extname]';
          }
          // Giữ nguyên cấu trúc cho images và các assets khác
          return 'assets/[name][extname]';
        },
        // Cấu hình cho file JS
        entryFileNames: 'index.js',
        chunkFileNames: '[name].js'
      },
    },
    assetsInlineLimit: 0,
    cssCodeSplit: true,
  },
  css: {
    extract: true,
  }
}))
