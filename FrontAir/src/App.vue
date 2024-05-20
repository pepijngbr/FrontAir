<template>
    <header class="flex items-center px-8 py-2 shadow-md h-[64px]">

        <RouterLink to="/" class="mr-12">
            <img src="../src/assets/images/FrontAir.png" alt="FrontAir Logo" class="h-14">
        </RouterLink>
        <nav class="[&>*]:mx-4">
            <RouterLink to="/">Home</RouterLink>
            <RouterLink to="/flights">Flight Schedule</RouterLink>
            <RouterLink to="/about">About</RouterLink>
            <RouterLink to="/contact">Contact</RouterLink>
            <RouterLink to="/dashboard">Dashboard</RouterLink>
            <!-- <RouterLink :to="{ name: 'dashboard.overview' }">Dashboard</RouterLink> -->
        </nav>
        <div class="flex flex-1 justify-end">
            <div class="dropdown dropdown-end dropdown-hover">
                <div tabindex="0" role="button" class="btn">Account</div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><RouterLink to="/login">Login</RouterLink></li>
                    <li><RouterLink to="/register">Register</RouterLink></li>
                    <li><RouterLink to="/profile">Profile</RouterLink></li>
                    <li><a href="#">Themes</a></li>
                </ul>
            </div>
        </div>
    </header>
    <RouterView />
</template>

<script setup lang="ts">
    import { RouterLink, RouterView } from 'vue-router'
</script>