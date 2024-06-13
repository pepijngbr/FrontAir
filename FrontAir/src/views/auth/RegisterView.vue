<template>
    <div class="flex h-[calc(100vh-63px)] w-screen flex-col lg:flex-row">
        <form
            @submit.prevent="register"
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
            <h1 class="my-4 text-2xl font-bold lg:text-3xl">Register</h1>
            <p class="mb-4">Register for an account.</p>
            <label class="form-control mb-4">
                <div class="label">
                    <span class="label-text"><b>What is your name?</b></span>
                </div>
                <input
                    v-model="this.name"
                    type="text"
                    placeholder="Daisy"
                    class="input input-bordered w-full"
                />
            </label>
            <label class="form-control mb-4">
                <div class="label">
                    <span class="label-text"
                        ><b>Where can we send your emails to?</b></span
                    >
                </div>
                <input
                    v-model="this.email"
                    type="text"
                    placeholder="daisy@gmail.com"
                    class="input input-bordered w-full"
                />
            </label>
            <label class="form-control mb-4">
                <div class="label">
                    <span class="label-text"><b>Create a password</b></span>
                </div>
                <input
                    v-model="this.password"
                    type="password"
                    placeholder="Enter your password"
                    class="input input-bordered w-full"
                />
            </label>
            <button class="btn btn-primary w-full lg:w-auto">Register</button>
            <p class="mt-4 text-center">
                Already have an account?
                <RouterLink to="/login" class="font-bold text-primary"
                    >Login</RouterLink
                >
            </p>
            <p class="mt-2 text-center">
                Forgot your password?
                <RouterLink
                    to="/reset-password"
                    class="font-bold text-secondary"
                    >Reset Password</RouterLink
                >
            </p>
        </form>
        <img
            src="@/assets/images/unsplash_q_1aQ_jXLr0.png"
            class="hidden h-full w-[calc(100vw-500px)] object-cover lg:block"
        />
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'RegisterView',
    data() {
        return {
            name: '',
            email: '',
            password: '',
            theme: '',
        };
    },
    methods: {
        register() {
            const newUser = {
                name: this.name,
                email: this.email,
                password: this.password,
            };
            axios
                .post(apiUrl + '/register', newUser)
                .then((response) => {
                    console.log('Registration successful!');
                    this.name = '';
                    this.email = '';
                    this.password = '';
                    alert(
                        'Registration successful, you are now able to login!',
                    );
                    console.log(response.data);

                    // Redirect User to login page
                    this.$router.push('/login').then(() => {
                        window.location.reload();
                    });
                })
                .catch((error) => {
                    console.error(error);
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
