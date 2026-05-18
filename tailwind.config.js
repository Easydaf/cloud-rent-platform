import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                midnight: "#111827",
                "soft-slate": "#1F2937",
                sunset: "#F97316",
                peach: "#FDBA74",
                coral: "#FB7185",
                "off-white": "#F9FAFB",
            },
        },
    },

    plugins: [forms],
};
