<template>
    <!-- TODO: without header (Auth layout, via index.ts vue-router) -->
    <!-- TODO: don't load footer -->
    <section class='flex flex-col'>
        <img :src="'../src/assets/images/FrontAir.png'" class='px-8 mt-4' alt='FrontAir Logo' />
        <div class='flex flex-col justify-start w-full'>
            <h1>Login</h1>
            <p>Log in to your account.</p>
        </div>
        <div class='py-4'>
            <label class='form-control'>
                <div class='label'>
                    <span class='label-text'><b>Email</b></span>
                </div>
                <input v-model='this.email' type='email' placeholder='Enter your email address' class='input input-bordered w-full md:max-w-xs' />
            </label>
            <label class='form-control'>
                <div class='label'>
                    <span class='label-text'><b>Password</b></span>
                </div>
                <input v-model='this.password' type='password' placeholder='Enter your password' class='input input-bordered w-full md:max-w-xs' />
            </label>
        </div>
        <button class='btn btn-primary' @click='login()'>Login</button>
        <div class='text-center mt-4'>
            <p>
                Don't have an account?
                <RouterLink to='/register' class='text-primary font-bold'>
                    Register
                </RouterLink>
            </p>
            <p>
                Forgot your password?
                <RouterLink to='/reset-password' class='text-secondary font-bold'>
                    Reset Password
                </RouterLink>
            </p>
        </div>
    </section>
</template>

<script lang='ts'>
import axios from 'axios';

const apiUrl = 'http://127.0.0.1:8000/api';

import { useUserStore } from '@/stores/user';

export default {
    name: 'LoginView',
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        login() {
            const user = {
                email: this.email,
                password: this.password
            };
            axios
                .post(apiUrl + '/login', user)
                .then((response) => {
                    console.log('Login successful!');
                    this.email = '';
                    this.password = '';
                    console.log(response.data);

                    // store logged in user in pinia store
                    const userStore = useUserStore();
                    userStore.setUser(response.data);
                })
                .catch((error) => {
                    console.error('An error has occurred', error);
                });
        }
    }
};
</script>
