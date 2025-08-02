import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/hwkui.css"],
      refresh: true,
    }),
    tailwindcss(),
  ],
  build: {
    emptyOutDir: true,
    outDir: "dist",
    assetsDir: "./dist",
    minify: true,
    rollupOptions: {
      output: {
        assetFileNames: (assetInfo) => {
          if (assetInfo.name === "hwkui.css") {
            return "hwkui.min.css";
          }
          return assetInfo.name;
        },
      },
    },
  },
  server: {
    cors: true,
  },
});
