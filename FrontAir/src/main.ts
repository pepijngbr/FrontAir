import './styles/app.css' // tailwindcss

import { createApp } from 'vue' // vue 3
import { createPinia } from 'pinia' // state management

import App from './App.vue' // main component
import router from './router' // vue-router

import axios from 'axios'
import VueAxios from 'vue-axios'

createApp(App).use(router).use(VueAxios, axios).use(createPinia()).mount('#app')
