import './styles/app.css'; // tailwindcss
import 'bootstrap-icons/font/bootstrap-icons.css';

import { createApp } from 'vue'; // vue 3
import { createPinia } from 'pinia'; // state management
import { useUserStore } from '@/stores/user.js';

import App from './App.vue'; // main component
import router from './router/index.js'; // vue-router

import axios from 'axios';
import VueAxios from 'vue-axios';

const app = createApp(App);
// app.config.globalProperties.apiUrl = 'http://127.0.0.1:8000/api';
app.use(router);
app.use(VueAxios, axios);
app.use(createPinia());
app.mount('#app');

const userStore = useUserStore();
userStore.loadUser();

// createApp(App).use(router).use(VueAxios, axios).use(createPinia()).mount('#app')
