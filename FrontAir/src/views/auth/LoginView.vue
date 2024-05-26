<template>
    <!-- TODO: without header (Auth layout, via index.ts vue-router) -->
    <img :src="'../src/assets/images/FrontAir.png'" alt="FrontAir Logo" class="h-40">
    <h1>Login</h1>
    <p>Log in to your account.</p>

    <label class="form-control">
        <div class="label">
            <span class="label-text">Email</span>
        </div>
        <input v-model="this.email" type="email" placeholder="Enter your email address"
            class="input input-bordered w-full max-w-xs" />
    </label>
    <label class="form-control">
        <div class="label">
            <span class="label-text">Password</span>
        </div>
        <input v-model="this.password" type="password" placeholder="Enter your password"
            class="input input-bordered w-full max-w-xs" />
    </label>
    <button class="btn btn-primary" @click="login()">Login</button>
    <p>Don't have an account? <RouterLink to="/register" class="text-primary font-bold">Register</RouterLink>
    </p>
    <p>Forgot your password? <RouterLink to="/reset-password" class="text-secondary font-bold">Reset Password
        </RouterLink>
    </p>
</template>

<script lang="ts">
    import axios from 'axios';

    const apiUrl = 'http://127.0.0.1:8000/api';

    import { useUserStore } from '@/stores/user';

    export default {
        name: 'LoginView',
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
            login() {
                const returningUser = {
                    email: this.email,
                    password: this.password,
                }
                axios.post(apiUrl + '/login', returningUser)
                    .then(response => {
                        console.log('Login successful!');
                        this.email = '';
                        this.password = '';
                        console.log(response.data);

                        // store logged in user in pinia store
                        const userStore = useUserStore();
                        userStore.setUser(response.data);
                    })
                    .catch(error => {
                        console.error('An error has occurred', error);
                    });
            },
        },
        components: {
            // #
        },
    }
</script>