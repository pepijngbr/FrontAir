// Pinia state management for site theme
import { defineStore } from 'pinia';

export const useSiteThemeStore = defineStore('siteTheme', {
    state: () => ({
        siteTheme: '',
    }),
    actions: {
        toggleTheme() {
            this.siteTheme = !this.siteTheme;
        },
        setTheme(value: string) {
            this.siteTheme = value;
        },
    },
});
