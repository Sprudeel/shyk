const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/@protonemedia/inertiajs-tables-laravel-query-builder/**/*.{js,vue}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                flash: "flash 1s forwards 3s",
            },
            keyframes: (theme) => ({
                flash: {
                    "20%": { transform: "translateX(-10%)" },
                    "60%": { transform: "translateX(200%)" },
                    "90%": { opacity: 0 },
                    "100%": { transform: "translateX(0%)", opacity: 0 },
                },
            }),
        },
        screens: {
            ph: "320px",
            lph: "495px",
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1440px",
            "2xl": "1536px",
            "o-ph": [{ min: "320px", max: "494px" }],
            "o-lph": [{ min: "495px", max: "639px" }],
            "o-sm": [{ min: "640px", max: "767px" }],
            "o-md": [{ min: "768px", max: "1023px" }],
            "o-lg": [{ min: "1024px", max: "1439px" }],
            "o-xl": [{ min: "1440px", max: "1535px" }],
            "o-2xl": [{ min: "1536px" }],
        },
        container: {
            center: true,
        },
        backgroundImage: {
            authbg: "url('@/Components/svg/bg/AuthBG.svg')",
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
