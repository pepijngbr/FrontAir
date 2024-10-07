<template>
    <div class="drawer">
        <input
            id="my-drawer-3"
            v-model="isDrawerOpen"
            type="checkbox"
            class="drawer-toggle"
        />
        <div class="drawer-content">
            <!-- Header -->
            <header
                v-if="
                    currentRoute() != '/login' &&
                    currentRoute() != '/register' &&
                    currentRoute() != '/reset-password'
                "
                class="sticky top-0 flex h-[63px] flex-row-reverse items-center bg-base-100 px-8 py-2 shadow-md sm:flex-row"
                :class="theme == 'frontair' ? '' : 'shadow-white/30'"
            >
                <div class="flex-none lg:hidden">
                    <label
                        for="my-drawer-3"
                        aria-label="open sidebar"
                        class="btn btn-square btn-ghost"
                    >
                        <i
                            class="bi bi-list flex h-[30px] items-center text-3xl"
                        />
                    </label>
                </div>
                <RouterLink
                    to="/"
                    class="mr-auto h-auto w-24 transition-none hover:scale-100 active:scale-100 sm:ml-4 sm:mr-0 lg:ml-0 lg:mr-12 lg:transition-transform lg:hover:scale-110 lg:active:scale-105"
                >
                    <img
                        :src="
                            '/src/assets/images/FrontAir' +
                            (theme == 'frontair' ? '.webp' : '_White.webp')
                        "
                        alt="FrontAir Logo"
                    />
                </RouterLink>
                <nav class="hidden lg:block [&>*]:mx-4">
                    <RouterLink
                        :to="{ name: 'home' }"
                        :title="'Homepage'"
                        :class="
                            currentRoute() == '/'
                                ? 'text-primary' +
                                  ' ' +
                                  (theme == 'frontairDark'
                                      ? 'shadow-white drop-shadow-lg'
                                      : '')
                                : ''
                        "
                    >
                        Home
                    </RouterLink>
                    <RouterLink
                        :to="{ name: 'flights' }"
                        :title="'Flight schedule'"
                        :class="
                            currentRoute() == '/flights' ? 'text-primary' : ''
                        "
                    >
                        Flights
                    </RouterLink>
                    <RouterLink
                        :to="{ name: 'about' }"
                        :title="'About us'"
                        :class="
                            currentRoute() == '/about' ? 'text-primary' : ''
                        "
                    >
                        About
                    </RouterLink>
                    <RouterLink
                        :to="{ name: 'contact' }"
                        :title="'Contact us'"
                        :class="
                            currentRoute() == '/contact' ? 'text-primary' : ''
                        "
                    >
                        Contact
                    </RouterLink>
                </nav>
                <div
                    class="hidden flex-1 items-center justify-end gap-4 sm:flex"
                >
                    <p v-if="isLoggedIn">
                        {{ user.loyalty_points }} Loyalty Points
                    </p>
                    <RouterLink
                        :to="{ name: 'store' }"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-shop" /> Store
                    </RouterLink>
                    <div class="dropdown dropdown-end dropdown-hover">
                        <div tabindex="0" role="button" class="btn">
                            <i v-if="isLoggedIn" class="bi bi-person-gear" />
                            <i v-else class="bi bi-person-circle" /> Account
                        </div>
                        <ul
                            tabindex="0"
                            class="menu dropdown-content z-[1] w-60 rounded-box bg-base-100 p-2 shadow"
                        >
                            <div
                                v-if="isLoggedIn"
                                class="my-2 ml-4 flex flex-col"
                            >
                                <p class="font-bold">
                                    {{ user.name }}
                                </p>
                                <p class="opacity-75">
                                    {{ user.email }}
                                </p>
                            </div>
                            <li v-if="isLoggedIn">
                                <RouterLink :to="{ name: 'wallet' }">
                                    <i class="bi bi-wallet" /> Wallet: €{{
                                        user.wallet
                                    }}
                                </RouterLink>
                            </li>
                            <li v-if="isLoggedIn">
                                <RouterLink :to="{ name: 'bookings.index' }">
                                    <i class="bi bi-ticket" /> My Bookings
                                </RouterLink>
                            </li>
                            <li v-if="isLoggedIn">
                                <RouterLink :to="{ name: 'profile' }">
                                    <i class="bi bi-person-circle" /> Profile
                                </RouterLink>
                            </li>
                            <li>
                                <RouterLink :to="{ name: 'reset-password' }">
                                    <i class="bi bi-arrow-counterclockwise" />
                                    Reset Password
                                </RouterLink>
                            </li>
                            <li v-if="isLoggedIn">
                                <button
                                    class="bg-red-400 hover:bg-red-500"
                                    @click="logout()"
                                >
                                    <i class="bi bi-box-arrow-left" /> Logout
                                </button>
                            </li>
                            <li v-if="!isLoggedIn">
                                <RouterLink :to="{ name: 'login' }">
                                    <i class="bi bi-box-arrow-in-right" />
                                    Login
                                </RouterLink>
                            </li>
                            <li v-if="!isLoggedIn">
                                <RouterLink :to="{ name: 'register' }">
                                    <i class="bi bi-person-plus" /> Register
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <!-- Content -->
            <RouterView :is-logged-in="isLoggedIn" />
            <MainFooter
                v-if="
                    currentRoute() != '/login' &&
                    currentRoute() != '/register' &&
                    currentRoute() != '/reset-password' &&
                    currentRoute() != '/profile' &&
                    currentRoute() != '/wallet' &&
                    currentRoute() != '/dashboard' &&
                    currentRoute() != '/bookings'
                "
            />
        </div>
        <div class="drawer-side">
            <label
                for="my-drawer-3"
                aria-label="close sidebar"
                class="drawer-overlay"
            />
            <div class="z-2 menu min-h-full w-80 bg-base-200 p-4">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <img
                        :src="
                            '/src/assets/images/FrontAir' +
                            (theme == 'frontair' ? '.webp' : '_White.webp')
                        "
                        class="h-24"
                        alt="FrontAir Logo"
                    />
                    <label
                        for="my-drawer-3"
                        aria-label="close sidebar"
                        class="btn btn-square btn-ghost"
                    >
                        <i
                            class="bi bi-x-lg flex h-[30px] items-center text-3xl"
                        />
                    </label>
                </div>
                <b class="mb-2 text-2xl">Navigation</b>
                <ul>
                    <li>
                        <RouterLink
                            :to="{ name: 'home' }"
                            @click="toggleDrawer"
                        >
                            <i class="bi bi-house" /> Home
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink
                            :to="{ name: 'flights' }"
                            @click="toggleDrawer"
                        >
                            <i class="bi bi-airplane" /> Flights
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink
                            :to="{ name: 'about' }"
                            @click="toggleDrawer"
                        >
                            <i class="bi bi-question-lg" /> About
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink
                            :to="{ name: 'contact' }"
                            @click="toggleDrawer"
                        >
                            <i class="bi bi-pen" /> Contact
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink
                            :to="{ name: 'store' }"
                            @click="toggleDrawer"
                        >
                            <i class="bi bi-shop" /> Store
                        </RouterLink>
                    </li>
                    <div class="divider sm:hidden" />
                    <b class="mb-2 block text-2xl sm:hidden"
                        ><i class="bi bi-person-circle" /> Account</b
                    >
                    <ul class="sm:hidden">
                        <li v-if="isLoggedIn">
                            <RouterLink
                                :to="{ name: 'wallet' }"
                                @click="toggleDrawer"
                            >
                                <i class="bi bi-wallet" /> Wallet: €{{
                                    user.wallet
                                }}
                            </RouterLink>
                        </li>
                        <li v-if="isLoggedIn">
                            <RouterLink
                                :to="{ name: 'bookings.index' }"
                                @click="toggleDrawer"
                            >
                                <i class="bi bi-ticket" /> My Bookings
                            </RouterLink>
                        </li>
                        <li v-if="isLoggedIn">
                            <RouterLink
                                :to="{ name: 'profile' }"
                                @click="toggleDrawer"
                            >
                                <i class="bi bi-person-circle" /> Profile
                            </RouterLink>
                        </li>
                        <li v-if="!isLoggedIn">
                            <RouterLink
                                :to="{ name: 'login' }"
                                @click="toggleDrawer"
                            >
                                <i class="bi bi-box-arrow-in-right" /> Login
                            </RouterLink>
                        </li>
                        <li v-if="!isLoggedIn">
                            <RouterLink
                                :to="{ name: 'register' }"
                                @click="toggleDrawer"
                            >
                                <i class="bi bi-person-plus" /> Register
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                :to="{ name: 'reset-password' }"
                                @click="toggleDrawer"
                            >
                                <i class="bi bi-arrow-counterclockwise" />
                                Reset Password
                            </RouterLink>
                        </li>
                        <li v-if="isLoggedIn">
                            <button
                                class="bg-red-400 hover:bg-red-500"
                                @click="
                                    logout();
                                    toggleDrawer();
                                "
                            >
                                <i class="bi bi-box-arrow-left" /> Logout
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { RouterLink, RouterView, useRoute, useRouter } from 'vue-router';
import MainFooter from '@/components/MainFooter.vue';
import { useUserStore } from '@/stores/user.js';
import { useSiteThemeStore } from '@/stores/siteTheme.js';
import { useHead } from '@vueuse/head';

export default {
    name: 'App',
    components: {
        RouterLink,
        RouterView,
        MainFooter,
    },
    setup() {
        const route = useRoute();
        const canonicalUrl = 'https://www.frontair.nl' + route.path;
        useHead({
            title: 'FrontAir',
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
                        'Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
                },
                {
                    name: 'keywords',
                    content:
                        'flights, flight booking, cheap flights, airline tickets, travel, FrontAir, flight deals, international flights, domestic flights',
                },
                {
                    name: 'author',
                    content: 'FrontAir',
                },
                // og: = Open Graph, for sharing using social media, reference: https://ogp.me/
                {
                    property: 'og:title',
                    content: 'Home - FrontAir',
                },
                {
                    property: 'og:description',
                    content:
                        'Welcome to FrontAir, your one-stop destination for booking flights at the best prices. Find deals on international and domestic flights, compare airlines, and plan your perfect trip.',
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

        const isLoggedIn = useUserStore().isLoggedIn;
        return {
            isLoggedIn, // boolean
        };
    },
    data() {
        return {
            // theme: '',
            isDrawerOpen: false,
        };
    },
    computed: {
        user() {
            return useUserStore().user;
        },
        theme() {
            return useSiteThemeStore().siteTheme;
        },
    },
    mounted() {
        useSiteThemeStore().loadTheme();
    },
    methods: {
        async logout() {
            if (this.isLoggedIn) {
                const userStore = useUserStore();
                await userStore.logout();
            }
            const router = useRouter();
            router.push('/').then(() => {
                useSiteThemeStore().setTheme('frontair');
                window.location.reload();
            });
        },
        currentRoute() {
            return this.$router.currentRoute.value.path;
        },
        toggleDrawer() {
            this.isDrawerOpen = !this.isDrawerOpen;
        },
    },
};
</script>
