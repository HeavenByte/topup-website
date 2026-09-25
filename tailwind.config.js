import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/View/ComponentViews',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

theme: {
    extend: {
        fontFamily: {
            // Font khusus judul biar sangar & berenergi luar angkasa
            'space-title': ['Orbitron', 'sans-serif'],
            // Font khusus tulisan teks biasa agar tetap mudah dibaca
            'space-body': ['Space Grotesk', 'sans-serif'],
        },
        // Update animasi di sini
        animation: {
            'shooting-star': 'shooting 6s linear infinite',
        },
        keyframes: {
            shooting: {
                '0%': { 
                    transform: 'translateX(0) translateY(0) rotate(45deg)', 
                    opacity: '0', 
                    width: '0px' 
                },
                '5%': { 
                    opacity: '1', 
                    width: '80px' 
                },
                '20%': { 
                    transform: 'translateX(-600px) translateY(600px) rotate(45deg)', 
                    opacity: '0', 
                    width: '0px' 
                },
                '100%': { 
                    transform: 'translateX(-600px) translateY(600px) rotate(45deg)', 
                    opacity: '0', 
                    width: '0px' 
                }
            }
        }
    },
},

    plugins: [forms],
};
