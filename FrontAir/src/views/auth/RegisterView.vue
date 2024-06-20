<template>
    <div
        class="flex min-h-screen w-screen flex-col justify-center md:h-screen md:flex-row"
    >
        <form
            @submit.prevent="register"
            class="flex w-full flex-col items-center justify-center p-6 md:w-[600px] md:p-10 [&>*]:w-full"
        >
            <img
                :src="
                    '../src/assets/images/FrontAir' +
                    (theme == 'frontair' ? '.webp' : '_White.webp')
                "
                alt="FrontAir Logo"
                class="mx-auto h-40 w-auto object-contain lg:mx-0"
            />
            <h1 class="my-4 text-2xl font-extralight lg:text-3xl">Register</h1>
            <label class="form-control mb-4">
                <input
                    v-model="name"
                    type="text"
                    placeholder="Name"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                />
            </label>
            <label class="form-control mb-4">
                <input
                    v-model="this.email"
                    type="text"
                    placeholder="Email Address"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                />
            </label>
            <label class="form-control mb-4">
                <input
                    v-model="this.password"
                    type="password"
                    placeholder="Password"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                />
            </label>
            <label class="form-control mb-4">
                <input
                    v-model="this.confirmPassword"
                    type="password"
                    placeholder="Confirm Password"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                />
            </label>
            <button class="btn btn-primary h-14 w-full text-white lg:w-auto">
                Register
            </button>
            <p class="mt-4 text-center font-extralight">
                Already have an account?
                <RouterLink
                    to="/login"
                    class="font-bold text-primary hover:underline"
                    >Login
                </RouterLink>
            </p>
            <RouterLink
                :to="{ name: 'home' }"
                class="mt-4 text-center font-bold hover:underline"
                >Enter as Guest
            </RouterLink>
        </form>
        <img
            src="/src/assets/images/unsplash_q_1aQ_jXLr0.webp"
            alt="Airplane Background With Sunset"
            class="left-0 hidden h-full w-[calc(100vw-500px)] object-cover object-left md:block"
        />
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { RouterLink } from 'vue-router';
import { useHead } from '@vueuse/head';
import { useRoute } from 'vue-router';

import axios from 'axios';
const apiUrl = 'http://127.0.0.1:8000/api';

export default {
    name: 'RegisterView',
    components: {
        RouterLink,
    },
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;

        useHead({
            title: 'Register - FrontAir',
            link: [
                {
                    rel: 'canonical',
                    href: canonicalUrl,
                },
            ],
            meta: [
                {
                    name: 'description',
                    content:
                        'The register page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'register, account, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Register - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The register page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    property: 'og:type',
                    content: 'website',
                },
                {
                    property: 'og:url',
                    content: 'https://www.frontair.nl',
                },
                {
                    property: 'og:image',
                    content:
                        'https://www.frontair.nl/images/frontair_logo.webp',
                },
            ],
        });
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            confirmPassword: '',
            theme: '',
        };
    },
    methods: {
        register() {
            if (this.password !== this.confirmPassword) {
                alert('Confirm password does not match password.');
            } else {
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
                            'Registration successful, you can now login using the credentials! You will now be redirected to the login page.',
                        );
                        console.log(response.data);

                        // Redirect User to login page
                        this.$router.push('/login').then(() => {
                            window.location.reload();
                        });
                    })
                    .catch((error) => {
                        alert('Registration failed, please try again!');
                        console.error(
                            'An error has occurred during registration: ',
                            error,
                        );
                    });
            }
        },
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
    mounted() {
        useSiteThemeStore().loadTheme();
    },
};
</script>
