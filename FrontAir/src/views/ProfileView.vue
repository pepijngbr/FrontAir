<template>
    <h1><i class="bi bi-person-circle"></i> Profile</h1>
    <p>View and edit your profile.</p>
    <section>
        <h2>Profile Information</h2>
        <p>Name: {{ this.user.first_name }}</p>
        <p>Email: {{ this.user.email }}</p>
    </section>
    <section>
        <h2>Change Password</h2>
        <form>
            <label for="old-password">Old Password</label>
            <input type="password" id="old-password" name="old-password" />
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new-password" />
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" />
            <button type="submit">Change Password</button>
        </form>
    </section>
    <section>
        <h2>Change Theme</h2>
        <p>Change the theme of the website.</p>
        <div class="join join-vertical">
            <input type="radio" name="theme-buttons" class="btn theme-controller join-item" aria-label="Light" value="light" @click="changeTheme('light')" />
            <input type="radio" name="theme-buttons" class="btn theme-controller join-item" aria-label="Dark" value="dark" @click="changeTheme('dark')" />
        </div>
    </section>
    <br><br><br><br><br>
    <button class="btn btn-primary">primary</button>
    <button class="btn btn-secondary">secondary</button>
    <button class="btn btn-accent">accent</button>
    <button class="btn btn-neutral">neutral</button>
    <button class="btn btn-base-100">base-100</button>
    <button class="btn btn-info">info</button>
    <button class="btn btn-success">success</button>
    <button class="btn btn-warning">warning</button>
    <button class="btn btn-error">error</button>
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
            }
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
            }
        },
    }
</script>