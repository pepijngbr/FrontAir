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
                    secondary: '#C86DDF',
                    accent: '#FF6DB2',
                    neutral: '#3D4451',
                    'base-100': '#FFFFFF',
                    info: '#38BDF8',
                    success: '#22C55E',
                    warning: '#FF8800',
                    error: '#F43F5E',
                },
                frontairDark: {
                    'color-scheme': 'dark',
                    primary: '#005FD2',
                    secondary: '#DC0064',
                    accent: '#D7478F',
                    neutral: '#5F6674',
                    'base-100': '#222222',
                    info: '#0096CF',
                    success: '#009E3B',
                    warning: '#D36400',
                    error: '#D00E44',
                },
            },
        ],
    },
};
