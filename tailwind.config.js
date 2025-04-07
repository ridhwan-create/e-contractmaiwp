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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'glow-blue': '0 0 20px rgba(59, 130, 246, 0.6)',    // blue-600
                'glow-green': '0 0 20px rgba(34, 197, 94, 0.6)',    // green-600
                'glow-cyan': '0 0 20px rgba(6, 182, 212, 0.6)',     // cyan-600
                'glow-purple': '0 0 20px rgba(128, 0, 128, 0.6)',   // purple
            },

            animation: {
                'pulse-glow-blue': 'pulseGlowBlue 2s ease-in-out infinite',
                'pulse-glow-green': 'pulseGlowGreen 2s ease-in-out infinite',
                'pulse-glow-cyan': 'pulseGlowCyan 2s ease-in-out infinite',
            },

            keyframes: {
                pulseGlowBlue: {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.3)' },
                    '50%': { boxShadow: '0 0 25px rgba(59, 130, 246, 0.7)' },
                },
                pulseGlowGreen: {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(34, 197, 94, 0.3)' },
                    '50%': { boxShadow: '0 0 25px rgba(34, 197, 94, 0.7)' },
                },
                pulseGlowCyan: {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(6, 182, 212, 0.3)' },
                    '50%': { boxShadow: '0 0 25px rgba(6, 182, 212, 0.7)' },
                },
            },
        }
    },

    plugins: [forms],
};
