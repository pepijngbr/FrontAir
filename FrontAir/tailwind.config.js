/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    theme: {
        extend: {},
    },
    plugins: [require('daisyui')],
    // https://daisyui.com/docs/config/
    // https://components.willpinha.link/
    daisyui: {
        themes: [
            {
                // https://daisyui.com/theme-generator/
                frontair: {
                    'color-scheme': 'light',
                    primary: '#0778F0',
                    secondary: '#C084FC',
                    accent: '#99F6E4',
                    neutral: '#3D4451',
                    'base-100': '#FFFFFF',
                    info: '#38BDF8',
                    success: '#22C55E',
                    warning: '#FF8800',
                    error: '#F43F5E',
                },
                frontairDark: {
                    'color-scheme': 'dark',
                    primary: '#ff007f',
                    secondary: '#0081ff',
                    accent: '#875d00',
                    neutral: '#0c0913',
                    'base-100': '#e11d48',
                    info: '#00adff',
                    success: '#22c55e',
                    warning: '#be123c',
                    error: '#e11d48',
                },
            },
            'light',
            'dark',
            'nord',

            'retro',
            'cyberpunk',
            'valentine',
            'aqua',
        ],
    },
};
