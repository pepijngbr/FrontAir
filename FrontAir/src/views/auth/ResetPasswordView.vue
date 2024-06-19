<template>
    <div
        class="flex min-h-screen w-screen flex-col justify-center md:h-screen md:flex-row"
    >
        <form
            @submit.prevent="resetPassword"
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
            <h1 class="my-4 text-2xl font-extralight lg:text-3xl">
                Reset Password
            </h1>
            <p class="mb-4 text-sm font-extralight">
                Enter your email address to reset your password.
            </p>
            <div class="form-control mb-4">
                <input
                    v-model="email"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email Address"
                    class="input input-bordered w-full border caret-primary outline-none transition-colors focus:border-primary focus:outline-none"
                    :disabled="this.time > 0"
                />
            </div>
            <div v-show="this.time > 0" class="mb-4">
                Try again in {{ this.time }} seconds.
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
                    >Login
                </RouterLink>
            </p>
            <p class="mt-2 text-center font-extralight">
                New to FrontAir?
                <RouterLink
                    to="/register"
                    class="font-bold text-secondary hover:underline"
                    >Register
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
        <!-- image: hidden h-full w-[calc(100vw-500px)] object-cover object-left lg:block -->
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { RouterLink } from 'vue-router';
import { useHead } from '@vueuse/head';

export default {
    name: 'ResetPasswordView',
    components: {
        RouterLink,
    },
    setup() {
        useHead({
            title: 'Reset Password - FrontAir',
            meta: [
                {
                    name: 'description',
                    content:
                        'The reset password page of FrontAir, a flight booking web application',
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
