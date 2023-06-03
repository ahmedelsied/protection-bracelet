import { defineConfig } from 'vite'
import path from 'path'
import react from '@vitejs/plugin-react'
import Laravel from 'laravel-vite-plugin'

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    outDir: path.join(__dirname, '../../public/vendor/bracelet/child/statistics/build'),
    emptyOutDir: true,
  },
  plugins: [
    Laravel({
      input: ['src/main.jsx'],
      publicDirectory: '../../public/vendor/bracelet/child/statistics/build'
    }),
    react()
  ],

})
