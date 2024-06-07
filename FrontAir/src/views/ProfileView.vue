<template>
    <h1><i class="bi bi-person-circle"></i> Profile</h1>
    <p>View and edit your profile.</p>
    <div class="divider"></div>
    <section>
        <b>Profile Information</b>
        <p>Name: {{ this.user.first_name }}</p>
        <p>Email: {{ this.user.email }}</p>
    </section>
    <div class="divider"></div>
    <section>
        <b>Change Password</b>
        <form>
            <label for="old-password">Old Password</label>
            <input type="password" id="old-password" name="old-password" />
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new-password" />
            <label for="confirm-password">Confirm Password</label>
            <input
                type="password"
                id="confirm-password"
                name="confirm-password"
            />
            <button type="submit">Change Password</button>
        </form>
    </section>
    <div class="divider"></div>
    <section>
        <b>Change Theme</b>
        <p>Change the theme of the website.</p>
        <div class="join join-vertical">
            <input
                type="radio"
                name="theme-buttons"
                class="theme-controller btn join-item"
                aria-label="Light"
                value="light"
                @click="changeTheme('light')"
            />
            <input
                type="radio"
                name="theme-buttons"
                class="theme-controller btn join-item"
                aria-label="Dark"
                value="dark"
                @click="changeTheme('dark')"
            />
        </div>
    </section>
</template>

<script lang="ts">
import { useUserStore } from '@/stores/user';

export default {
    name: 'ProfileView',
    mounted() {
        this.setTheme();
    },
    data() {
        return {
            theme: '',
            user: {
                first_name: useUserStore().user.name,
                email: useUserStore().user.email,
            },
        };
    },
    methods: {
        changeTheme($theme: string) {
            console.log('Theme changed!');
            this.theme = $theme;
            localStorage.setItem('theme', JSON.stringify($theme));
            document.documentElement.setAttribute('data-theme', this.theme);
        },
        setTheme() {
            this.theme = JSON.parse(localStorage.getItem('theme') || 'light');
            document.documentElement.setAttribute('data-theme', this.theme);
        },
    },
};
</script>
