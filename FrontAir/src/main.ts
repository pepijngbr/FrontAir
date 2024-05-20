import './styles/app.css' // tailwindcss

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
// import store from './store'
import router from './router'

createApp(App).use(router).use(createPinia()).mount('#app')
// createApp(App).use(store).use(router).mount('#app')
