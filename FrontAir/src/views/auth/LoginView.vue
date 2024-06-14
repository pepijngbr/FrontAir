<template>
    <!-- h-[calc(100vh-63px)] -->
    <div class="flex h-screen w-screen flex-col md:flex-row">
        <form
            @submit.prevent="login"
            class="mt-40 flex w-full flex-col items-center p-6 md:w-[600px] md:p-10 lg:mt-20 [&>*]:w-full"
        >
            <img
                :src="
                    '../src/assets/images/FrontAir' +
                    (theme == 'frontair' ? '.webp' : '_White.webp')
                "
                alt="FrontAir Logo"
                class="mx-auto h-40 w-auto object-contain lg:mx-0"
            />
            <h1 class="my-4 text-2xl font-extralight lg:text-3xl">Login</h1>
            <label class="form-control mb-4">
                <input
                    v-model="this.email"
                    type="email"
                    placeholder="Email Address"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                />
            </label>
            <label class="form-control">
                <input
                    v-model="this.password"
                    type="password"
                    placeholder="Password"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                />
            </label>
            <RouterLink
                to="/reset-password"
                class="mb-4 text-right font-bold text-secondary"
                >Forgot your password?
            </RouterLink>
            <button class="btn btn-primary h-14 w-full text-white lg:w-auto">
                Login
            </button>
            <p class="mt-4 text-center font-extralight">
                New to FrontAir?
                <RouterLink to="/register" class="font-bold text-primary">
                    Register
                </RouterLink>
            </p>
            <RouterLink
                :to="{ name: 'home' }"
                class="mt-12 text-center font-bold text-primary"
                >Enter as Guest
            </RouterLink>
        </form>
        <img
            src="@/assets/images/unsplash_q_1aQ_jXLr0.webp"
            alt="Airplane Background With Sunset"
            class="left-0 hidden h-full w-[calc(100vw-500px)] object-cover object-left md:block"
        />
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useUserStore } from '@/stores/user.js';
import { RouterLink } from 'vue-router';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'LoginView',
    components: {
        RouterLink,
    },
    data() {
        return {
            email: '',
            password: '',
            theme: '',
        };
    },
    methods: {
        login() {
            const user = {
                email: this.email,
                password: this.password,
            };
            axios
                .post(apiUrl + '/login', user)
                .then((response) => {
                    console.log('Login successful!');
                    this.email = '';
                    this.password = '';
                    console.log(response.data);

                    // store logged in user in pinia store
                    const userStore = useUserStore();
                    userStore.setUser(response.data);

                    this.$router.push('/').then(() => {
                        window.location.reload();
                    });
                })
                .catch((error) => {
                    console.error('An error has occurred', error);
                });
        },
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
    mounted() {
        // document.documentElement.setAttribute('data-theme', 'frontair');
        useSiteThemeStore().loadTheme();
    },
};
</script>
