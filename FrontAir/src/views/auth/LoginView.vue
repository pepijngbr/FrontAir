<template>
    <div class="flex h-[calc(100vh-63px)] w-screen flex-col lg:flex-row">
        <form
            @submit.prevent="login"
            class="flex w-full flex-col items-center p-6 lg:w-[600px] lg:p-10 [&>*]:w-full"
        >
            <img
                :src="
                    '../src/assets/images/FrontAir' +
                    (theme == 'frontair' ? '.webp' : '_White.webp')
                "
                alt="FrontAir Logo"
                class="mx-auto h-20 w-auto object-contain lg:mx-0 lg:h-40"
            />
            <h1 class="my-4 text-2xl font-bold lg:text-3xl">Login</h1>
            <p class="mb-4">Log in to your account, welcome back!</p>
            <label class="form-control mb-4">
                <div class="label">
                    <span class="label-text"><b>Email</b></span>
                </div>
                <input
                    v-model="this.email"
                    type="email"
                    placeholder="Enter your email address"
                    class="input input-bordered w-full"
                />
            </label>
            <label class="form-control mb-4">
                <div class="label">
                    <span class="label-text"><b>Password</b></span>
                </div>
                <input
                    v-model="this.password"
                    type="password"
                    placeholder="Enter your password"
                    class="input input-bordered w-full"
                />
            </label>
            <button class="btn btn-primary w-full lg:w-auto">Login</button>
            <div class="mt-4 text-center">
                <p>
                    New to FrontAir?
                    <RouterLink to="/register" class="font-bold text-primary">
                        Register
                    </RouterLink>
                </p>
                <p>
                    Forgot your password?
                    <RouterLink
                        to="/reset-password"
                        class="font-bold text-secondary"
                    >
                        Reset Password
                    </RouterLink>
                </p>
            </div>
        </form>
        <img
            src="@/assets/images/unsplash_q_1aQ_jXLr0.png"
            class="hidden h-full w-[calc(100vw-500px)] object-cover lg:block"
        />
    </div>
</template>

<script>
import { useUserStore } from '@/stores/user.js';
import { useSiteThemeStore } from '@/stores/siteTheme.js';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'LoginView',
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
