import './styles/app.css' // tailwindcss

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
// import store from './store'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'

createApp(App).use(router).use(VueAxios, axios).use(createPinia()).mount('#app')
// createApp(App).use(store).use(router).mount('#app')
