import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/View/Resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'cloud-bg': '#F9FAFB',      // Off White (Dominan Latar Belakang)
                'cloud-card': '#FFFFFF',    // Putih Bersih untuk Container/Card
                'cloud-orange': '#F97316',  // Sunset Orange (Warna Utama Aplikasi)
                'cloud-peach': '#FDBA74',   // Peach Glow (Aksen Lembut)
                'cloud-dark': '#111827',    // Midnight Navy (Fokus untuk Teks Utama)
                'cloud-slate': '#1F2937',   // Soft Slate (Untuk Teks Sekunder)
                'cloud-coral': '#FB7185',   // Soft Coral (Untuk Status/Error)
            },
        },
    },

    plugins: [forms],
};