import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    // server: {
    //     host: "0.0.0.0", // Agar dapat diakses di semua jaringan
    //     port: 5173, // Port default Vite, bisa disesuaikan
    //     hmr: {
    //         host: "192.168.1.58", // Ganti dengan IP LAN Anda
    //     },
    // },
});
// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: ["resources/routes/**", "routes/**", "resources/views/**"],
//         }),
//     ],
// });
