<template>
    <h1>Profile</h1>
    <p>View and edit your profile.</p>
    <!-- <section>
        <h2>Profile Information</h2>
        <p>Username: {{ $store.state.user.username }}</p>
        <p>Email: {{ $store.state.user.email }}</p>
        <p>First Name: {{ $store.state.user.first_name }}</p>
        <p>Last Name: {{ $store.state.user.last_name }}</p>
    </section> -->
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
            <input type="radio" name="theme-buttons" class="btn theme-controller join-item" aria-label="Light"
                value="light" @click="changeTheme('light')" />
            <input type="radio" name="theme-buttons" class="btn theme-controller join-item" aria-label="Dark"
                value="dark" @click="changeTheme('dark')" />
        </div>
    </section>

</template>

<script lang="ts">
    export default {
        name: 'ProfileView',
        data() {
            return {
                theme: '',
            }
        },
        methods: {
            changeTheme($theme: string) {
                console.log('Theme changed!');
                this.theme = $theme;
                localStorage.setItem('theme', JSON.stringify($theme));
                document.documentElement.setAttribute('data-theme', this.theme);
            },
        },
        mounted() {
            this.theme = JSON.parse(localStorage.getItem('theme') || 'default');
            document.documentElement.setAttribute('data-theme', this.theme);
        },
    }
</script>