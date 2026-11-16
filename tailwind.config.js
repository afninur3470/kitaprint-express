import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'SF Pro Display', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#10B981',
                accent: '#E1F529',
                dark: '#111827',
                secondary: '#6B7280',
                border: '#E5E7EB',
                danger: '#EF4444',
                warning: '#F59E0B',
            },
            borderRadius: {
                'card': '16px',
                'btn': '12px',
            },
            boxShadow: {
                'soft': '0 4px 20px rgba(0, 0, 0, 0.05)',
            }
        },
    },
    plugins: [forms],
};