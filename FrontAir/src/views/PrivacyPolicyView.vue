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
import { useRoute } from 'vue-router';

export default {
    name: 'PrivacyPolicyView',
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;
        useHead({
            title: 'Privacy Policy - FrontAir',
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
                        'The privacy policy page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'privacy, privacy policy, policy, flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Privacy Policy - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'The privacy policy page of FrontAir, a flight booking web application. Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
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
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
};
</script>
