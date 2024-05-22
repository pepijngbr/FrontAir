<template>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <!-- hier zat eerst "flex flex-col" op -->
        <div class="drawer-content">
            <header class="sticky top-0 flex items-center px-8 py-2 shadow-md h-[63px] bg-base-100">
                <!-- https://en.wikipedia.org/wiki/List_of_airlines_of_the_Netherlands -->
                <!-- https://iata.codes/airlines/ -->
                <!-- https://iata.codes/airline/jetnetherlands-jnl-nl -->
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <!-- TODO: add icons -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <RouterLink to="/"
                    class="ml-4 mr-0 lg:ml-0 lg:mr-12 transition-transform active:scale-105 hover:scale-110">
                    <img :src="'../src/assets/images/FrontAir' + (this.theme == 'light' ? '.png' : '_White.png')"
                        alt="FrontAir Logo" class="h-14">
                </RouterLink>
                <nav class="[&>*]:mx-4 hidden lg:block">
                    <RouterLink class="transition-colors hover:text-accent" to="/">Home</RouterLink>
                    <RouterLink class="transition-colors hover:text-accent" to="/flights">Flights</RouterLink>
                    <RouterLink class="transition-colors hover:text-accent" to="/about">About</RouterLink>
                    <RouterLink class="transition-colors hover:text-accent" to="/contact">Contact</RouterLink>
                    <RouterLink class="transition-colors hover:text-accent" to="/dashboard">Dashboard</RouterLink>
                </nav>
                <div class="flex flex-1 justify-end items-center gap-4">
                    <!-- TODO: make user saved in $store & add authentication to elements -->
                    <p>180 Loyalty Points</p>
                    <!-- <div class="dropdown dropdown-end dropdown-hover" v-if="$store.state.user != null">
                        <div tabindex="0" role="button" class="btn">Account</div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <RouterLink to="/profile">Profile</RouterLink>
                            </li>
                            <li>
                                <RouterLink to="/logout">Logout</RouterLink>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-end dropdown-hover" v-else>
                        <div tabindex="0" role="button" class="btn">Account</div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <RouterLink to="/login">Login</RouterLink>
                            </li>
                            <li>
                                <RouterLink to="/register">Register</RouterLink>
                            </li>
                        </ul>
                    </div> -->
                    <RouterLink to="/store" class="btn">Store</RouterLink>
                    <div class="dropdown dropdown-end dropdown-hover">
                        <div tabindex="0" role="button" class="btn">Account</div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <RouterLink to="/login">Login</RouterLink>
                            </li>
                            <li>
                                <RouterLink to="/register">Register</RouterLink>
                            </li>
                            <li>
                                <RouterLink to="/profile">Profile</RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <RouterView />
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200 z-2">
                <b class="text-2xl mb-4">Navigation</b>
                <li>
                    <RouterLink class="transition-colors hover:text-accent" to="/">Home</RouterLink>
                </li>
                <li>
                    <RouterLink class="transition-colors hover:text-accent" to="/flights">Flights</RouterLink>
                </li>
                <li>
                    <RouterLink class="transition-colors hover:text-accent" to="/about">About</RouterLink>
                </li>
                <li>
                    <RouterLink class="transition-colors hover:text-accent" to="/contact">Contact</RouterLink>
                </li>
                <li>
                    <RouterLink class="transition-colors hover:text-accent" to="/dashboard">Dashboard</RouterLink>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { RouterLink, RouterView } from 'vue-router'
</script>

<script lang="ts">
    import axios from 'axios';

    const apiUrl = 'http://127.0.0.1:8000/api/';

    export default {
        name: 'App',
        components: {
            // #
        },
        data() {
            return {
                theme: 'light',
            }
        },
        async created() {
            // #
        },
        methods: {
            // #
        },
    }
</script>
