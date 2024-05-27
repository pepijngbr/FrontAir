<template>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- header -->
            <header class="sticky top-0 flex items-center px-8 py-2 shadow-md h-[63px] bg-base-100">
                <!-- https://en.wikipedia.org/wiki/List_of_airlines_of_the_Netherlands -->
                <!-- https://iata.codes/airlines/ -->
                <!-- https://iata.codes/airline/jetnetherlands-jnl-nl -->
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <!-- TODO: add icons -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <RouterLink to="/" class="ml-4 sm:ml-4 sm:mr-0 lg:ml-0 lg:mr-12 transition-none hover:scale-100 active:scale-100 lg:transition-transform lg:active:scale-105 lg:hover:scale-110">
                    <img :src="'../src/assets/images/FrontAir' + (this.theme == 'light' ? '.png' : '_White.png')" alt="FrontAir Logo" class="h-14">
                </RouterLink>
                <nav class="[&>*]:mx-4 hidden lg:block">
                    <RouterLink :to="{ name: 'home' }" :class="currentRoute() == '/' ? 'text-primary' : ''">Home</RouterLink>
                    <RouterLink :to="{ name: 'flights' }" :class="currentRoute() == '/flights' ? 'text-primary' : ''">Flights</RouterLink>
                    <RouterLink :to="{ name: 'about' }" :class="currentRoute() == '/about' ? 'text-primary' : ''">About</RouterLink>
                    <RouterLink :to="{ name: 'contact' }" :class="currentRoute() == '/contact' ? 'text-primary' : ''">Contact</RouterLink>
                    <RouterLink :to="{ name: 'dashboard.overview' }" :class="currentRoute() == '/dashboard' ? 'text-primary' : ''">Dashboard</RouterLink>
                </nav>
                <div class="hidden flex-1 justify-end items-center gap-4 sm:flex">
                    <p v-if="isLoggedIn">{{ user.loyalty_points }} Loyalty Points</p>
                    <RouterLink :to="{ name: 'store' }" class="btn btn-secondary"><i class="bi bi-shop"></i> Store</RouterLink>
                    <div class="dropdown dropdown-end dropdown-hover">
                        <div tabindex="0" role="button" class="btn"><i class="bi bi-person-gear" v-if="isLoggedIn"></i><i v-else class="bi bi-person-circle"></i> Account</div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li v-if="isLoggedIn"><p><i class="bi bi-wallet"></i> Wallet: €{{ user.wallet }}</p></li>
                            <li v-if="isLoggedIn"><RouterLink :to="{ name: 'bookings' }"><i class="bi bi-ticket"></i> My Bookings</RouterLink></li>
                            <li v-if="isLoggedIn"><RouterLink :to="{ name: 'profile' }"><i class="bi bi-person-circle"></i> Profile</RouterLink></li>
                            <li v-if="isLoggedIn"><button @click="logout()" class="bg-red-400 hover:bg-red-500"><i class="bi bi-box-arrow-left"></i> Logout</button></li>
                            <li v-if="!isLoggedIn"><RouterLink :to="{ name: 'login' }"><i class="bi bi-box-arrow-in-right"></i> Login</RouterLink></li>
                            <li v-if="!isLoggedIn"><RouterLink :to="{ name: 'register' }">Register</RouterLink></li>
                        </ul>
                    </div>
                </div>
            </header>
            <!-- site content -->
            <RouterView :theme="this.theme" :apiUrl="this.apiUrl" />
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200 z-2">
                <div class="flex items-center gap-4 mt-2 mb-12">
                    <img src="./assets/images/FrontAir_Aeroplane_V2.png" class="h-8" alt="FrontAir Airplane">
                    <h2>FrontAir</h2>
                </div>
                <b class="text-2xl mb-2"><i class="bi bi-hexagon"></i> Navigation</b>
                <li><RouterLink :to="{ name: 'home' }"><i class="bi bi-house"></i> Home</RouterLink></li>
                <li><RouterLink :to="{ name: 'flights' }"><i class="bi bi-airplane"></i> Flights</RouterLink></li>
                <li><RouterLink :to="{ name: 'about' }"><i class="bi bi-question-lg"></i> About Us</RouterLink></li>
                <li><RouterLink :to="{ name: 'contact' }"><i class="bi bi-pen"></i> Contact</RouterLink></li>
                <li><RouterLink :to="{ name: 'store' }"><i class="bi bi-shop"></i> Store</RouterLink></li>
                <!-- <div class="divider after:bg-red-400 before:bg-red-400"></div> -->
                <div class="divider"></div>
                <b class="text-2xl mb-2"><i class="bi bi-person-circle"></i> Account</b>
                <ul>
                    <li v-if="isLoggedIn"><RouterLink :to="{ name: 'dashboard.overview' }"><i class="bi bi-tools-fill"></i> Dashboard</RouterLink></li>
                    <li v-if="isLoggedIn"><RouterLink :to="{ name: 'profile' }"><i class="bi bi-person-circle"></i> Profile</RouterLink></li>
                    <li v-if="!isLoggedIn"><RouterLink :to="{ name: 'login' }"><i class="bi bi-box-arrow-in-right"></i> Login</RouterLink></li>
                    <li v-if="!isLoggedIn"><RouterLink :to="{ name: 'register' }"><i class="bi bi-person-plus"></i> Register</RouterLink></li>
                    <li><RouterLink :to="{ name: 'reset-password' }"><i class="bi bi-arrow-counterclockwise"></i> Reset Password</RouterLink></li>
                </ul>
            </ul>
        </div>
    </div>
</template>

<script lang="ts">
    import { RouterLink, RouterView } from 'vue-router'
    import { useUserStore } from '@/stores/user';

    import axios from 'axios';

    const apiUrl = 'http://127.0.0.1:8000/api/';

    export default {
        name: 'App',
        components: {
            RouterLink,
            RouterView
        },
        data() {
            return {
                theme: '',
                apiUrl: apiUrl, // TODO: send apiUrl to RouterView/child components
            }
        },
        mounted() {
            // this.$watch('theme', (newVal) => {
            //     localStorage.setItem('theme', JSON.stringify(newVal));
            // });
            this.theme = JSON.parse(localStorage.getItem('theme') || 'light');
        },
        setup() {
            // Access state directly
            const userStore = useUserStore();

            const user = userStore.user;
            const isLoggedIn = userStore.isLoggedIn;

            return {
                user,
                isLoggedIn
            }
        },
        async created() {
            // #
        },
        methods: {
            async logout() {
                const userStore = useUserStore();
                await userStore.logout();
            },
            currentRoute() {
                return this.$router.currentRoute.value.path;
            }
        },
    };
</script>
