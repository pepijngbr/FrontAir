import { defineStore } from 'pinia';

export const useSiteThemeStore = defineStore('siteTheme', {
    state: () => ({
        siteTheme: '',
    }),
    actions: {
        setTheme(value) {
            this.siteTheme = value;
            localStorage.setItem('theme', value);
        },
        loadTheme() {
            const theme = localStorage.getItem('theme') || 'frontair';
            if (theme) {
                this.siteTheme = theme;
                document.documentElement.setAttribute('data-theme', theme);
            }
        },
    },
    mounted() {
        this.loadTheme();
    },
});
