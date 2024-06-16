<template>
    <div class="mx-auto max-w-[800px] px-4 py-20">
        <div class="mb-8 text-center">
            <img
                :src="
                    '../src/assets/images/FrontAir' +
                    (theme == 'frontair' ? '.webp' : '_White.webp')
                "
                alt="FrontAir Logo"
                class="mx-auto mb-4"
            />
            <h1 class="text-3xl font-bold">Privacy Policy</h1>
        </div>
        <div class="rounded-lg bg-white p-8 shadow-lg">
            <p class="text-gray-700">
                Your privacy is important to us. It is FrontAir's policy to
                respect your privacy regarding any information we may collect
                from you across our website, https://www.frontair.nl, and other
                sites we own and operate.
            </p>
        </div>
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useHead } from '@vueuse/head';

export default {
    name: 'PrivacyPolicyView',
    setup() {
        useHead({
            title: 'Privacy Policy - FrontAir',
            meta: [],
        });
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
};
</script>
