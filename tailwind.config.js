import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
              "./resources/**/*.blade.php",
    ],

    darkMode: false,

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                pagination: {
                    light: {
                        active: '#3b82f6',
                        inactive: '#6b7280',
                        bg: '#ffffff',
                        border: '#e5e7eb',
                        hover: '#f3f4f6',
                    }
                }
            }
        },
    },

    plugins: [forms],
};
