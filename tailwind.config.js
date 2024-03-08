import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php' ,
        './resources/views/**/*.blade.php' ,
        './resources/js/**/*.jsx' ,
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            height: {
                "10v": "10vh",
                "65v": "65vh",
                "15v": "15vh",
            },
            colors: {
                "header": "#750D37",
                "footer": "#a39da0",
                "main": "#E5FCF5",
                "nav": "#B3DEC1",
            }

        },
    },

    plugins: [forms,require("daisyui")],
};
