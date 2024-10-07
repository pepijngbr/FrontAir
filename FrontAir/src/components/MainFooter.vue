<template>
    <footer
        class="relative bg-gradient-to-b from-base-100 to-sky-400 pt-20 lg:pt-56"
    >
        <div class="relative">
            <div class="container relative z-[1] mx-auto pb-20">
                <div
                    class="grid grid-cols-1 gap-8 rounded-lg bg-base-100 p-10 shadow-lg md:grid-cols-2 lg:grid-cols-4"
                >
                    <!-- FrontAir Logo -->
                    <div>
                        <img
                            :src="
                                '../src/assets/images/FrontAir' +
                                (theme == 'frontair' ? '.webp' : '_White.webp')
                            "
                            alt="FrontAir Logo"
                        />
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-lg font-semibold">Support Hours</h3>
                        <ul class="[&>*]:mb-2">
                            <li>Monday - Friday: 9:00 AM - 5:00 PM</li>
                            <li>Saturday: 10:00 AM - 4:00 PM</li>
                            <li>Sunday: Closed</li>
                        </ul>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-lg font-semibold">FAQ</h3>
                        <ul class="[&>*]:mb-2">
                            <li>
                                <a
                                    href="#"
                                    :class="
                                        (theme == 'frontair'
                                            ? 'text-blue-600'
                                            : 'text-blue-400') +
                                        ' hover:underline'
                                    "
                                >
                                    How do I book a flight?</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    :class="
                                        (theme == 'frontair'
                                            ? 'text-blue-600'
                                            : 'text-blue-400') +
                                        ' hover:underline'
                                    "
                                >
                                    Can I change my booking?</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    :class="
                                        (theme == 'frontair'
                                            ? 'text-blue-600'
                                            : 'text-blue-400') +
                                        ' hover:underline'
                                    "
                                >
                                    What is the cancellation policy?</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-lg font-semibold">Policies</h3>
                        <ul class="[&>*]:mb-2">
                            <li>
                                <RouterLink
                                    :to="{ name: 'policy.privacy' }"
                                    :class="
                                        (theme == 'frontair'
                                            ? 'text-blue-600'
                                            : 'text-blue-400') +
                                        ' hover:underline'
                                    "
                                >
                                    Privacy Policy
                                </RouterLink>
                            </li>
                            <li>
                                <RouterLink
                                    :to="{ name: 'tos.index' }"
                                    :class="
                                        (theme == 'frontair'
                                            ? 'text-blue-600'
                                            : 'text-blue-400') +
                                        ' hover:underline'
                                    "
                                >
                                    Terms of Service
                                </RouterLink>
                            </li>
                            <li>
                                <RouterLink
                                    :to="{ name: 'policy.refund' }"
                                    :class="
                                        (theme == 'frontair'
                                            ? 'text-blue-600'
                                            : 'text-blue-400') +
                                        ' hover:underline'
                                    "
                                >
                                    Refund Policy
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="mt-8 rounded-lg bg-base-100 py-4 text-center shadow-lg"
                >
                    <p class="text-sm opacity-75">
                        &copy; 2024 FrontAir. All rights reserved.
                    </p>
                </div>
            </div>
            <div
                class="bg-clouds absolute inset-0 z-0 h-full w-full bg-cover bg-no-repeat opacity-50"
            />
        </div>
    </footer>
</template>

<script>
import { RouterLink } from 'vue-router';
import { useSiteThemeStore } from '@/stores/siteTheme.js';

export default {
    name: 'MainFooter',
    components: {
        RouterLink,
    },
    data() {
        return {
            // theme: '',
        };
    },
    computed: {
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
};
</script>

<style>
.bg-clouds {
    background-image: url('~@/assets/images/clouds.webp');
}
</style>
