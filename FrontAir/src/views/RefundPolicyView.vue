<template>
    <div class="container mx-auto max-w-[800px] px-4 py-20">
        <div class="mb-8 text-center">
            <img
                :src="
                    '../src/assets/images/FrontAir' +
                    (theme == 'frontair' ? '.webp' : '_White.webp')
                "
                alt="FrontAir Logo"
                class="mx-auto mb-4"
            />
            <h1 class="text-3xl font-bold">Refund Policy</h1>
        </div>
        <div class="rounded-lg bg-white p-8 shadow-lg">
            <p class="text-gray-700">
                If you are not entirely satisfied with your purchase, we're here
                to help. Our refund policy lasts 30 days. If 30 days have gone
                by since your purchase, unfortunately we can’t offer you a
                refund or exchange.
            </p>
        </div>
    </div>
</template>

<script>
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useHead } from '@vueuse/head';

export default {
    name: 'RefundPolicyView',
    setup() {
        useHead({
            title: 'Refund Policy - FrontAir',
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
