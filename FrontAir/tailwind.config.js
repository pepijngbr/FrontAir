/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('daisyui'),
    ],
    // https://daisyui.com/docs/config/
    // https://components.willpinha.link/
    daisyui: {
        themes: [
            {
                // https://daisyui.com/theme-generator/
                mytheme: {
                    "primary": "#0778F0",
                    "secondary": "#f6d860",
                    "accent": "#37cdbe",
                    "neutral": "#3d4451",
                    "base-100": "#ffffff",
                },
                // mytheme: {
                //     "primary": "#ff007f",
                //     "secondary": "#0081ff",
                //     "accent": "#875d00",
                //     "neutral": "#0c0913",
                //     "base-100": "#f3f4f6",
                //     "info": "#00adff",
                //     "success": "#22c55e",
                //     "warning": "#be123c",
                //     "error": "#e11d48",
                // },
            },
            "light",
            "dark",
            "nord",


            "retro",
            "cyberpunk",
            "valentine",
            "aqua",
        ],
    },
}

