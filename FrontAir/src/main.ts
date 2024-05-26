import './styles/app.css' // tailwindcss

import { createApp } from 'vue' // vue 3
import { createPinia } from 'pinia' // state management
import { useUserStore } from '@/stores/user';

import App from './App.vue' // main component
import router from './router' // vue-router

import axios from 'axios'
import VueAxios from 'vue-axios'

// App.config.performance = true

const app = createApp(App);
app.use(router);
app.use(VueAxios, axios);
app.use(createPinia());
app.mount('#app');

const userStore = useUserStore();
userStore.loadUser();

// createApp(App).use(router).use(VueAxios, axios).use(createPinia()).mount('#app')
