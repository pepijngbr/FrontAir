<template>
    <div
        class="flex min-h-screen w-screen flex-col justify-center md:h-screen md:flex-row"
    >
        <form
            class="flex w-full flex-col items-center justify-center p-6 md:w-[600px] md:p-10 [&>*]:w-full"
            @submit.prevent="resetPassword"
        >
            <img
                :src="
                    '../src/assets/images/FrontAir' +
                    (theme == 'frontair' ? '.webp' : '_White.webp')
                "
                alt="FrontAir Logo"
                class="mx-auto h-40 w-auto object-contain lg:mx-0"
            />
            <h1 class="my-4 text-2xl font-extralight lg:text-3xl">
                Reset Password
            </h1>
            <p class="mb-4 text-sm font-extralight">
                Enter your email address to reset your password.
            </p>
            <div class="form-control mb-4">
                <input
                    id="email"
                    v-model="email"
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                    :disabled="time > 0"
                />
            </div>
            <div v-show="time > 0" class="mb-4">
                Try again in {{ time }} seconds.
            </div>
            <button
                type="submit"
                class="btn btn-primary h-14 w-full text-white lg:w-auto"
            >
                Submit
            </button>
            <p class="mt-4 text-center font-extralight">
                Remember your password?
                <RouterLink
                    to="/login"
                    class="font-bold text-primary hover:underline"
                >
                    Login
                </RouterLink>
            </p>
            <p class="mt-2 text-center font-extralight">
                New to FrontAir?
                <RouterLink
                    to="/register"
                    class="font-bold text-secondary hover:underline"
                >
                    Register
                </RouterLink>
            </p>
            <RouterLink
                :to="{ name: 'home' }"
                class="mt-4 text-center font-bold hover:underline"
            >
                Enter as Guest
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

export default {
    name: 'ResetPasswordView',
    components: {
        RouterLink,
    },
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;

        useHead({
            title: 'Reset Password - FrontAir',
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
                        'The reset password page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'reset password, account flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Reset Password - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The reset password page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
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
            email: '',
            time: 0,
            theme: '',
        };
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
    watch: {
        time: {
            handler(value) {
                if (value > 0) {
                    setTimeout(() => {
                        this.time--;
                    }, 1000);
                }
            },
        },
    },
    mounted() {
        useSiteThemeStore().loadTheme();
    },
    methods: {
        resetPassword() {
            if (this.email === '') {
                alert('Enter a valid email address.');
            } else {
                if (this.time > 0) {
                    return alert('Please wait before trying again.');
                }
                alert('E-mail sent!');
                this.time = 59;
            }
        },
    },
};
</script>
